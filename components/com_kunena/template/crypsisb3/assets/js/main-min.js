<<<<<<< HEAD
function kunenatableOrdering(a,c,b,d){var d=document.getElementById(d);d.filter_order.value=a;d.filter_order_Dir.value=c;d.submit(b);}jQuery(document).ready(function(b){b("input.kcheckall").click(function(){b(".kcheck").prop("checked",b(this).prop("checked"));});b("#kchecktask").change(function(){var c=b("select#kchecktask").val();if(c==="move"){b("#kchecktarget").attr("disabled",false).trigger("liszt:updated");}else{b("#kchecktarget").attr("disabled",true);}});b("input.kcatcheckall").click(function(){b("input.kcatcheckall:checkbox").not(this).prop("checked",this.checked);});b("input.kcheckallcategories").click(function(){b("input.kcheckallcategory:checkbox").not(this).prop("checked",this.checked);});b(document).ready(function(){b("[rel=popover]").popover();});b("#avatar_gallery_select").change(function(){var d=b("select#avatar_gallery_select").val();var c=b("#gallery_list");c.empty();b.ajax({dataType:"json",url:b("#kunena_url_avatargallery").val(),data:"gallery_name="+d}).done(function(e){b.each(e,function(f,g){c.append('<li class="span2"><input id="radio'+d+"/"+g.filename+'" type="radio" value="gallery/'+d+"/"+g.filename+'" name="avatar_gallery"><label class=" radio thumbnail" for="radio'+d+"/"+g.filename+'"><img alt="" src="'+g.url+'"></label></li>');});}).fail(function(e){});});if(b.fn.datepicker!==undefined){b(".input-group.date").datepicker({orientation:"top auto",format:"yyyy-mm-dd",language:"kunena"});}var a=b("#clearcache");a.on("click",function(c){c.preventDefault();a.addClass("btn-success");a.html('<span class="glyphicon glyphicon-ok-sign"></span> '+Joomla.JText._("COM_KUNENA_CLEARED"));});});
=======
function kunenatableOrdering(a,c,b,d){var d=document.getElementById(d);d.filter_order.value=a;d.filter_order_Dir.value=c;d.submit(b);}jQuery(document).ready(function(b){b("input.kcheckall").click(function(){b(".kcheck").prop("checked",b(this).prop("checked"));});b("#kchecktask").change(function(){var c=b("select#kchecktask").val();if(c==="move"){b("#kchecktarget").attr("disabled",false).trigger("liszt:updated");}else{b("#kchecktarget").attr("disabled",true);}});b("input.kcatcheckall").click(function(){b("input.kcatcheckall:checkbox").not(this).prop("checked",this.checked);});b("input.kcheckallcategories").click(function(){b("input.kcheckallcategory:checkbox").not(this).prop("checked",this.checked);});b(document).ready(function(){b("[rel=popover]").popover();});b("#avatar_gallery_select").change(function(){var d=b("select#avatar_gallery_select").val();var c=b("#gallery_list");c.empty();b.ajax({dataType:"json",url:b("#kunena_url_avatargallery").val(),data:"gallery_name="+d}).done(function(e){b.each(e,function(f,g){c.append('<li class="span2"><input id="radio'+d+"/"+g.filename+'" type="radio" value="gallery/'+d+"/"+g.filename+'" name="avatar_gallery"><label class=" radio thumbnail" for="radio'+d+"/"+g.filename+'"><img alt="" src="'+g.url+'"></label></li>');});}).fail(function(e){});});if(b.fn.datepicker!==undefined){b("#ann-date .input-group.date").datepicker({orientation:"top auto",format:"yyyy-mm-dd"});b("#ann-date2 .input-group.date").datepicker({orientation:"top auto",format:"yyyy-mm-dd"});b("#ann-date3 .input-group.date").datepicker({orientation:"top auto",format:"yyyy-mm-dd"});}var a=b("#clearcache");a.on("click",function(c){c.preventDefault();a.addClass("btn-success");a.html('<span class="glyphicon glyphicon-ok-sign"></span> '+Joomla.JText._("COM_KUNENA_CLEARED"));});});
>>>>>>> master
