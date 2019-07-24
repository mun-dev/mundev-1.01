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
	protected $newUrls = array();

	protected $_urlCount = 0;
	protected $_newUrlCount = 0;
	protected $_isLocked = false;


	/**
	 * Used to register shutdown function.
	 *
	 * @since	3.1.5
	 * @access	public
	 */
	public function __construct() 
	{
		register_shutdown_function(array( $this, 'writeCache'));
	}

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
	 * This method is used to refresh the cache file
	 * or prevent the cache file from being 'cached'
	 * when using php include
	 *
	 * @since	3.1.5
	 * @access	public
	 */
	public function refreshCacheFile()
	{
		$check = true;
		$filename = $this->getFilePath();

		// in any case if the cache file already refreshed, 
		// then we should skip the subsequence processing.

		if ($check && function_exists('opcache_invalidate')) {
			opcache_invalidate($filename);
			$check = false;
		}

		if ($check && function_exists('apc_compile_file')) {
			apc_compile_file($filename);
			$check = false;
		}
		
		if ($check && function_exists('wincache_refresh_if_changed')) {
			wincache_refresh_if_changed(array($filename));
			$check = false;
		}

		if ($check && function_exists('xcache_asm')) {
			xcache_asm($filename);
			$check = false;
		}

		return true;
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
		static $loaded = false;

		if (!$loaded) {

			// get cache file
			$file = $this->getFilePath();

			if (JFile::exists($file)) {

				$this->_urls = array();

				// acquire lock.
				$this->acquireLock();

				// attemp to refresh the cache file before we include.
				$this->refreshCacheFile();

				include($file);

				$loaded = !empty($this->_urls);
				$this->_urlCount = !empty($this->_urls) ? count($this->_urls) : 0;

			} else {

				if ($this->acquireLock()) {

					// regenerate the header for saving.
					$content = $this->generateHeader();

					$fp = fopen($file,'ab');
					if ($fp) {
						fwrite($fp, $content);
						fclose($fp);
					}
				}

				$this->_urls = array();
				$loaded = true;
				$this->_urlCount = 0;
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

		if (count($newUrls) && $this->_isLocked) {

			// need to reload the urls
			$this->loadCache();

			// cache file content
			$content = '';

			// get cache file
			$filepath = $this->getFilePath();
			$isNewCache = false;

			if (!JFile::exists($filepath)) {
				$content = $this->generateHeader();
				$isNewCache = true;
			}

			// in an event where cache file include might be 'cached' by php cache, e.g. opcache
			// and if this happen, this might cause duplicate urls being written into cache file 
			// and causing the filesize to increase drastrically.
			// To solve this, we need to check if the file size above the allowed size or not.
			$resetCacheFile = false;

			if (!$isNewCache) {
				$filesize = @filesize($filepath);
				$filesize = (int) $filesize;

				if ($filesize > 1024) {
					$inKB = $filesize / 1024;
					if ($inKB >= SOCIAL_SEF_FILESIZE) {
						$resetCacheFile = true;
					}
				}
			}

			if (!$isNewCache && ($this->_urlCount + $this->_newUrlCount >= SOCIAL_SEF_LIMIT)) {
				// the number of urls reach the threshold. let remove all urls in the cache file.
				$resetCacheFile = true;
			}

			if ($resetCacheFile) {
				JFile::delete($filepath);

				// regenerate the header for saving.
				$content = $this->generateHeader();
				$isNewCache = true;
			}

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
				$fp = fopen($filepath, "ab");
				if ($fp) {
					fwrite($fp, $content);
				}
			}

			// lets unset from newurls
			foreach ($newUrls as $key => $row) {
				unset($this->newUrls[$key]);
			}
		}

		// lets release the lock
		$this->releaseLock();

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
		$check = false;
		$lockFile = $this->getFilePath(true);
		$now = time();

		do {

			// try open the lock file with x mode. if the file is there, fopen should return false with a warning.
			// lets supress that warning
			$fp = @fopen($lockFile, "x");

			if ($fp) {

				$state = fwrite($fp, $now);
				$closed = fclose($fp);

				$this->_isLocked = !empty($state) && $closed;

			} else {

				// incase the previoue writing did not remove the lock properly.
				// let check for the previous stored time in the lock file.
				// if more than 5 secs, mean someting not right.
				// let release the lock

				$time = @file_get_contents($lockFile);
				$time = (int) trim($time);

				if (($now - $time) > 5) {
					$this->_isLocked = $this->releaseLock(true);
					$check = true;
				} else {
					// stop the lock acquaring. this will also  prevent the cache writing from writing
					// since we failed to acquire the lock. This also mean, the page will be displayed faster
					// and at later time, we can always rewrite again.
					$check = false;
				}
			}

		} while (!$this->_isLocked && $check);

		return $this->_isLocked;
	}

	/**
	 * Release the lock
	 *
	 * @since	3.1
	 * @access	private
	 */
	private function releaseLock($force = false)
	{
		$lockFile = $this->getFilePath(true);

		if ($this->_isLocked || $force) {
			if (JFile::exists($lockFile)) {
				$this->_isLocked = !JFile::delete($lockFile);
			}
		}

		return $this->_isLocked;
	}

}
