<?php
/**
* @package		EasyBlog
* @copyright	Copyright (C) 2010 - 2014 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');


class SocialFileCache
{
	public $storage = null;
	public $_urls = null;
	public $newUrls = array();

	private $_urlCount = 0;
	private $_newUrlCount = 0;

	/**
	 * Object initialisation for the class to fetch the appropriate user
	 * object.
	 *
	 * @since	3.1
	 * @access	public
	 */
	public static function getInstance()
	{
		static $obj = null;

		if (is_null($obj)) {
			$obj = new self();
		}

		return $obj;
	}

	/**
	 * @since	1.4
	 * @access	public
	 * @param   null
	 * @return  SocialFileCache
	 */
	public static function factory()
	{
		return new self();
	}

	/**
	 * Get sef url from cache
	 *
	 * @since	3.1
	 * @access	public
	 */
	public function getSefUrl($oriUrl, $skipNew = false)
	{
		$this->loadCache();

		$key = md5($oriUrl);

		if (isset($this->_urls[$key])) {
			return $this->_urls[$key];
		}

		if (!$skipNew && isset($this->newUrls[$key])) {
			$data = implode('||', $this->newUrls[$key]);
			return $data;
		}

		return false;
	}

	/**
	 * Get non sef url from cache
	 *
	 * @since	3.1
	 * @access	public
	 */
	public function getNonSefUrl($sef, $skipNew = false)
	{
		$this->loadCache();

		$url = null;

		// check in cached urls;
		if ($this->_urls) {
			foreach ($this->_urls as $key => $value) {
				$data = explode('||', $value);

				$sefurl = $data[1];

				if ($sefurl == $sef) {
					$url = $value;
					break;
				}
			}
		}

		// check in new urls;
		if (!$skipNew && $this->newUrls) {
			foreach ($this->newUrls as $key => $data) {

				$sefurl = $data[1];

				if ($sefurl == $sef) {
					$url = implode('||', $data);
					break;
				}
			}
		}


		// okay we found the url, let format the data and return.
		if ($url) {

			$data = explode('||', $url);

			$nonsef = $data[0];
			$sefurl = $data[1];

			$obj = new stdClass();
			$obj->sefurl = $sefurl;
			$obj->rawurl = $nonsef;

			return $obj;
		}


		// nothing found.
		return false;

	}

	/**
	 * Get new urls that need to be process
	 *
	 * @since	3.1
	 * @access	public
	 */
	public function getNewUrls()
	{
		return $this->newUrls;
	}

	/**
	 * Add new urls into container for later processing
	 *
	 * @since	3.1
	 * @access	public
	 */
	public function addNewUrls($oriUrl, $data)
	{
		if (($this->_urlCount + $this->_newUrlCount) >= SOCIAL_SEF_LIMIT) {
			return;
		}

		$key = md5($oriUrl);

		if (!isset($this->newUrls[$key])) {
			$this->newUrls[$key] = $data;
			$this->_newUrlCount++;
		}

	}

	/**
	 * Load urls from cache file
	 *
	 * @since	3.1
	 * @access	public
	 */
	public function loadCache()
	{
		static $loaded = null;

		if (is_null($loaded) && is_null($this->_urls)) {

			$this->_urls = array();

			// get cache file
			$file = $this->getFilePath();

			if (JFile::exists($file)) {

				$fp = fopen($file, 'a');

				if (flock($fp, LOCK_EX)) {
					include($file);
					$loaded = true;

					$this->_urlCount = count($this->_urls);
				}

				flock($fp, LOCK_UN);
				fclose($fp);
			}
		}
	}

	/**
	 * Write new urls into cache file
	 * Currently this method is being called by system plugin :: onAfterRender()
	 *
	 * @since	3.1
	 * @access	public
	 */
	public function writeCache()
	{
		// check if cache folder exist or not
		if (!JFolder::exists(SOCIAL_FILE_CACHE_DIR)) {
			JFolder::create(SOCIAL_FILE_CACHE_DIR);
		}

		$newUrls = $this->getNewUrls();

		if (!$newUrls) {
			// nothing to process
			return true;
		}

		// $lock = $this->acquireLock();

		// need to reload the urls
		$this->loadCache();

		// cache file content
		$content = '';

		// get cache file
		$filepath = $this->getFilePath();
		$isNewCache = false;

		if (! JFile::exists($filepath)) {
			$content = $this->generateHeader();
			$isNewCache = true;
		}

		if (!$isNewCache && ($this->_urlCount + $this->_newUrlCount >= SOCIAL_SEF_LIMIT)) {
			// the number of urls reach the threshold. let remove all urls in the cache file.
			if (JFile::exists($filepath)) {
				JFile::delete($filepath);

				// regenerate the header for saving.
				$content = $this->generateHeader();
			}
		}

		$fp = fopen($filepath, "a+");

		if (!$fp) {
			// canot open file for writing. stop here.
			return true;
		}

		// acquire file lock.
		$lock = flock($fp, LOCK_EX);

		if ($lock) {
			foreach ($newUrls as $key => $row) {

				// further check if key really not exists
				if (isset($this->_urls[$key])) {
					// dont write.
					continue;
				}

				$nonSef = $row[0];
				$sef = $row[1];

				$value = addslashes($nonSef) . '||' . $sef;

				$this->_urls[$key] = $value;

				$content .= "\n" . '$this->_urls[\'' . $key . '\']=\'' . $value . '\';';
			}

			if ($content) {
				// JFile::append($filepath, $content);
				fwrite($fp, $content);
			}
		}

		// lets release the lock
		// $this->releaseLock();
		flock($fp, LOCK_UN);
		fclose($fp);

		// lets unset from newurls
		foreach ($newUrls as $key => $row) {
			unset($this->newUrls[$key]);
		}

		return true;
	}

	/**
	 * Return cache file path
	 *
	 * @since	3.1
	 * @access	public
	 */
	public function getFilePath($lock = false)
	{
		if ($lock) {
			$filename = md5(SOCIAL_FILE_CACHE_FILENAME);
			$filepath = SOCIAL_FILE_CACHE_DIR . '/' . $filename . '-lock.php';
			return $filepath;
		}

		$filename = md5(SOCIAL_FILE_CACHE_FILENAME);
		$filepath = SOCIAL_FILE_CACHE_DIR . '/' . $filename . '-cache.php';

		return $filepath;
	}

	/**
	 * remove cache file.
	 *
	 * @since	3.1
	 * @access	public
	 */
	public function purge($customUrls = array())
	{
		$container = array();

		if ($customUrls) {

			// load cache urls
			$this->loadCache();

			foreach ($customUrls as $custom) {
				$sef = $custom->sefurl;

				// check in cached urls;
				if ($this->_urls) {
					foreach ($this->_urls as $key => $value) {
						$data = explode('||', $value);

						$sefurl = $data[1];

						if ($sefurl == $sef) {
							$container[$key] = $value;
							break;
						}
					}
				}
			}
		}

		$filepath = $this->getFilePath();

		if (JFile::exists($filepath)) {
			JFile::delete($filepath);
		}

		// if there is custom urls, we need to wwrite into cache file again
		if ($container) {

			// content header
			$content = "<?php \n";
			$content .= "if (!defined('_JEXEC')) die('Unauthorized Access');" . "\n";

			foreach ($container as $key => $value) {
				$content .= "\n" . '$this->_urls[\'' . $key . '\']=\'' . $value . '\';';
			}

			// save new file
			JFile::write($filepath, $content);
		}

		return;
	}


	/**
	 * update single item in cache file.
	 *
	 * @since	3.1
	 * @access	public
	 */
	public function updateCacheItem($newSef, $oldSef)
	{
		$filepath = $this->getFilePath();

		$contents = JFile::read($filepath);

		// replace old sef with new sef in the cached content.
		$contents = str_replace('||' . $oldSef . '\';', '||' . $newSef . '\';', $contents);

		if (!$contents) {
			// if content is empty, we need to add the header.
			$contents = $this->generateHeader();
		}

		// now save to cache file.
		JFile::write($filepath, $contents);

		return true;
	}

	/**
	 * remove entries from cache file.
	 *
	 * @since	3.1
	 * @access	public
	 */
	public function removeCacheItems($urls = array())
	{
		if (!$urls) {
			return true;
		}

		$in = array();

		$filepath = $this->getFilePath();
		$contents = JFile::read($filepath);

		foreach ($urls as $row) {

			$pattern = array('/', '-');
			$replace = array('\/', '\-');

			// clean up string for reg usage
			$nonsef = $row->rawurl;
			$nonsef = str_replace($pattern, $replace, $nonsef);

			$sef = $row->sefurl;
			$sef = str_replace($pattern, $replace, $sef);

			// $in[] = '/\$this\-\>_urls\[\'[\da-z]+\'\]\=\'' . $nonsef . '\|\|' . $sef . '\';\n/is';
			// $in[] = '/\$this\-\>_urls\[\'[\da-z]+\'\]\=\'' . $nonsef . '\|\|' . $sef . '\';/is';

			$in[] = '/\$this\-\>_urls\[\'[\da-z]+\'\]\=\'.[^\$]+\|\|' . $sef . '\';\n?/is';
		}

		// // replace the deleted entries from cache file.
		$contents = preg_replace($in, '', $contents);

		if (!$contents) {
			// if content is empty, we need to add the header.
			$contents = $this->generateHeader();
		}

		// now save to cache file.
		JFile::write($filepath, $contents);

		return true;
	}

	/**
	 * Generate header content used in cache file.
	 *
	 * @since	3.1
	 * @access	private
	 */
	private function generateHeader()
	{
		$content = "<?php \n";
		$content .= "if (!defined('_JEXEC')) die('Unauthorized Access');" . "\n";

		return $content;
	}

	/**
	 * Acquire lock for writing new urls into cache file
	 *
	 * @since	3.1
	 * @access	private
	 */
	private function acquireLock()
	{
		$state = false;
		$now = time();

		do {
			$lockFile = $this->getFilePath(true);

			// try open the lock file with x mode. if the file is there, fopen should return false with a warning.
			// lets supress that warning
			$fp = @fopen($lockFile, "x");

			if ($fp) {

				fwrite($fp, $now);
				fclose($fp);

				$state = true;

			} else {

				// $time = JFile::read($lockFile);
				$time = JFile::exists($lockFile) ? @file_get_contents($lockFile) : 0;
				$time = (int) trim($time);

				// if more than 5 secs, mean someting not right.
				// let release the lock
				if (($now - $time) > 5) {
					$this->releaseLock();
					$state = true;
				}
			}

		} while ($state == false);

		return true;
	}

	/**
	 * Acquire lock for writing new urls into cache file
	 *
	 * @since	3.1
	 * @access	private
	 */
	private function releaseLock()
	{
		$lockFile = $this->getFilePath(true);

		if (JFile::exists($lockFile)) {
			$state = JFile::delete($lockFile);
			return $state;
		}

		return true;
	}

}
