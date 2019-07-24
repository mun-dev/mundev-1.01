/*!
 * Datepicker for Bootstrap v1.9.0 (https://github.com/uxsolutions/bootstrap-datepicker)
 *
 * Licensed under the Apache License v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 */
(function(a){if(typeof define==="function"&&define.amd){define(["jquery"],a);}else{if(typeof exports==="object"){a(require("jquery"));}else{a(jQuery);}}}(function(c,g){function n(){return new Date(Date.UTC.apply(Date,arguments));}function b(){var s=new Date();return n(s.getFullYear(),s.getMonth(),s.getDate());}function o(t,s){return(t.getUTCFullYear()===s.getUTCFullYear()&&t.getUTCMonth()===s.getUTCMonth()&&t.getUTCDate()===s.getUTCDate());}function l(t,s){return function(){if(s!==g){c.fn.datepicker.deprecated(s);}return this[t].apply(this,arguments);};}function d(s){return s&&!isNaN(s.getTime());}var m=(function(){var s={get:function(t){return this.slice(t)[0];},contains:function(w){var v=w&&w.valueOf();for(var u=0,t=this.length;u<t;u++){if(0<=this[u].valueOf()-v&&this[u].valueOf()-v<1000*60*60*24){return u;}}return -1;},remove:function(t){this.splice(t,1);},replace:function(t){if(!t){return;}if(!c.isArray(t)){t=[t];}this.clear();this.push.apply(this,t);},clear:function(){this.length=0;},copy:function(){var t=new m();t.replace(this);return t;}};return function(){var t=[];t.push.apply(t,arguments);c.extend(t,s);return t;};})();var q=function(t,s){c.data(t,"datepicker",this);this._events=[];this._secondaryEvents=[];this._process_options(s);this.dates=new m();this.viewDate=this.o.defaultViewDate;this.focusDate=null;this.element=c(t);this.isInput=this.element.is("input");this.inputField=this.isInput?this.element:this.element.find("input");this.component=this.element.hasClass("date")?this.element.find(".add-on, .input-group-addon, .input-group-append, .input-group-prepend, .btn"):false;if(this.component&&this.component.length===0){this.component=false;}this.isInline=!this.component&&this.element.is("div");this.picker=c(h.template);if(this._check_template(this.o.templates.leftArrow)){this.picker.find(".prev").html(this.o.templates.leftArrow);}if(this._check_template(this.o.templates.rightArrow)){this.picker.find(".next").html(this.o.templates.rightArrow);}this._buildEvents();this._attachEvents();if(this.isInline){this.picker.addClass("datepicker-inline").appendTo(this.element);}else{this.picker.addClass("datepicker-dropdown dropdown-menu");}if(this.o.rtl){this.picker.addClass("datepicker-rtl");}if(this.o.calendarWeeks){this.picker.find(".datepicker-days .datepicker-switch, thead .datepicker-title, tfoot .today, tfoot .clear").attr("colspan",function(u,v){return Number(v)+1;});}this._process_options({startDate:this._o.startDate,endDate:this._o.endDate,daysOfWeekDisabled:this.o.daysOfWeekDisabled,daysOfWeekHighlighted:this.o.daysOfWeekHighlighted,datesDisabled:this.o.datesDisabled});this._allow_update=false;this.setViewMode(this.o.startView);this._allow_update=true;this.fillDow();this.fillMonths();this.update();if(this.isInline){this.show();}};q.prototype={constructor:q,_resolveViewName:function(s){c.each(h.viewModes,function(u,t){if(s===u||c.inArray(s,t.names)!==-1){s=u;return false;}});return s;},_resolveDaysOfWeek:function(s){if(!c.isArray(s)){s=s.split(/[,\s]*/);}return c.map(s,Number);},_check_template:function(t){try{if(t===g||t===""){return false;}if((t.match(/[<>]/g)||[]).length<=0){return true;}var u=c(t);return u.length>0;}catch(s){return false;}},_process_options:function(s){this._o=c.extend({},this._o,s);var t=this.o=c.extend({},this._o);var u=t.language;if(!f[u]){u=u.split("-")[0];if(!f[u]){u=i.language;}}t.language=u;t.startView=this._resolveViewName(t.startView);t.minViewMode=this._resolveViewName(t.minViewMode);t.maxViewMode=this._resolveViewName(t.maxViewMode);t.startView=Math.max(this.o.minViewMode,Math.min(this.o.maxViewMode,t.startView));if(t.multidate!==true){t.multidate=Number(t.multidate)||false;if(t.multidate!==false){t.multidate=Math.max(0,t.multidate);}}t.multidateSeparator=String(t.multidateSeparator);t.weekStart%=7;t.weekEnd=(t.weekStart+6)%7;var A=h.parseFormat(t.format);if(t.startDate!==-Infinity){if(!!t.startDate){if(t.startDate instanceof Date){t.startDate=this._local_to_utc(this._zero_time(t.startDate));}else{t.startDate=h.parseDate(t.startDate,A,t.language,t.assumeNearbyYear);}}else{t.startDate=-Infinity;}}if(t.endDate!==Infinity){if(!!t.endDate){if(t.endDate instanceof Date){t.endDate=this._local_to_utc(this._zero_time(t.endDate));}else{t.endDate=h.parseDate(t.endDate,A,t.language,t.assumeNearbyYear);}}else{t.endDate=Infinity;}}t.daysOfWeekDisabled=this._resolveDaysOfWeek(t.daysOfWeekDisabled||[]);t.daysOfWeekHighlighted=this._resolveDaysOfWeek(t.daysOfWeekHighlighted||[]);t.datesDisabled=t.datesDisabled||[];if(!c.isArray(t.datesDisabled)){t.datesDisabled=t.datesDisabled.split(",");}t.datesDisabled=c.map(t.datesDisabled,function(B){return h.parseDate(B,A,t.language,t.assumeNearbyYear);});var v=String(t.orientation).toLowerCase().split(/\s+/g),x=t.orientation.toLowerCase();v=c.grep(v,function(B){return/^auto|left|right|top|bottom$/.test(B);});t.orientation={x:"auto",y:"auto"};if(!x||x==="auto"){}else{if(v.length===1){switch(v[0]){case"top":case"bottom":t.orientation.y=v[0];break;case"left":case"right":t.orientation.x=v[0];break;}}else{x=c.grep(v,function(B){return/^left|right$/.test(B);});t.orientation.x=x[0]||"auto";x=c.grep(v,function(B){return/^top|bottom$/.test(B);});t.orientation.y=x[0]||"auto";}}if(t.defaultViewDate instanceof Date||typeof t.defaultViewDate==="string"){t.defaultViewDate=h.parseDate(t.defaultViewDate,A,t.language,t.assumeNearbyYear);}else{if(t.defaultViewDate){var y=t.defaultViewDate.year||new Date().getFullYear();var w=t.defaultViewDate.month||0;var z=t.defaultViewDate.day||1;t.defaultViewDate=n(y,w,z);}else{t.defaultViewDate=b();}}},_applyEvents:function(s){for(var t=0,v,u,w;t<s.length;t++){v=s[t][0];if(s[t].length===2){u=g;w=s[t][1];}else{if(s[t].length===3){u=s[t][1];w=s[t][2];}}v.on(w,u);}},_unapplyEvents:function(s){for(var t=0,v,w,u;t<s.length;t++){v=s[t][0];if(s[t].length===2){u=g;w=s[t][1];}else{if(s[t].length===3){u=s[t][1];w=s[t][2];}}v.off(w,u);}},_buildEvents:function(){var s={keyup:c.proxy(function(t){if(c.inArray(t.keyCode,[27,37,39,38,40,32,13,9])===-1){this.update();}},this),keydown:c.proxy(this.keydown,this),paste:c.proxy(this.paste,this)};if(this.o.showOnFocus===true){s.focus=c.proxy(this.show,this);}if(this.isInput){this._events=[[this.element,s]];}else{if(this.component&&this.inputField.length){this._events=[[this.inputField,s],[this.component,{click:c.proxy(this.show,this)}]];}else{this._events=[[this.element,{click:c.proxy(this.show,this),keydown:c.proxy(this.keydown,this)}]];}}this._events.push([this.element,"*",{blur:c.proxy(function(t){this._focused_from=t.target;},this)}],[this.element,{blur:c.proxy(function(t){this._focused_from=t.target;},this)}]);if(this.o.immediateUpdates){this._events.push([this.element,{"changeYear changeMonth":c.proxy(function(t){this.update(t.date);},this)}]);}this._secondaryEvents=[[this.picker,{click:c.proxy(this.click,this)}],[this.picker,".prev, .next",{click:c.proxy(this.navArrowsClick,this)}],[this.picker,".day:not(.disabled)",{click:c.proxy(this.dayCellClick,this)}],[c(window),{resize:c.proxy(this.place,this)}],[c(document),{"mousedown touchstart":c.proxy(function(t){if(!(this.element.is(t.target)||this.element.find(t.target).length||this.picker.is(t.target)||this.picker.find(t.target).length||this.isInline)){this.hide();}},this)}]];},_attachEvents:function(){this._detachEvents();this._applyEvents(this._events);},_detachEvents:function(){this._unapplyEvents(this._events);},_attachSecondaryEvents:function(){this._detachSecondaryEvents();this._applyEvents(this._secondaryEvents);},_detachSecondaryEvents:function(){this._unapplyEvents(this._secondaryEvents);},_trigger:function(u,v){var t=v||this.dates.get(-1),s=this._utc_to_local(t);this.element.trigger({type:u,date:s,viewMode:this.viewMode,dates:c.map(this.dates,this._utc_to_local),format:c.proxy(function(w,y){if(arguments.length===0){w=this.dates.length-1;y=this.o.format;}else{if(typeof w==="string"){y=w;w=this.dates.length-1;}}y=y||this.o.format;var x=this.dates.get(w);return h.formatDate(x,y,this.o.language);},this)});},show:function(){if(this.inputField.is(":disabled")||(this.inputField.prop("readonly")&&this.o.enableOnReadonly===false)){return;}if(!this.isInline){this.picker.appendTo(this.o.container);}this.place();this.picker.show();this._attachSecondaryEvents();this._trigger("show");if((window.navigator.msMaxTouchPoints||"ontouchstart" in document)&&this.o.disableTouchKeyboard){c(this.element).blur();}return this;},hide:function(){if(this.isInline||!this.picker.is(":visible")){return this;}this.focusDate=null;this.picker.hide().detach();this._detachSecondaryEvents();this.setViewMode(this.o.startView);if(this.o.forceParse&&this.inputField.val()){this.setValue();}this._trigger("hide");return this;},destroy:function(){this.hide();this._detachEvents();this._detachSecondaryEvents();this.picker.remove();delete this.element.data().datepicker;if(!this.isInput){delete this.element.data().date;}return this;},paste:function(t){var s;if(t.originalEvent.clipboardData&&t.originalEvent.clipboardData.types&&c.inArray("text/plain",t.originalEvent.clipboardData.types)!==-1){s=t.originalEvent.clipboardData.getData("text/plain");}else{if(window.clipboardData){s=window.clipboardData.getData("Text");}else{return;}}this.setDate(s);this.update();t.preventDefault();},_utc_to_local:function(t){if(!t){return t;}var s=new Date(t.getTime()+(t.getTimezoneOffset()*60000));if(s.getTimezoneOffset()!==t.getTimezoneOffset()){s=new Date(t.getTime()+(s.getTimezoneOffset()*60000));}return s;},_local_to_utc:function(s){return s&&new Date(s.getTime()-(s.getTimezoneOffset()*60000));},_zero_time:function(s){return s&&new Date(s.getFullYear(),s.getMonth(),s.getDate());},_zero_utc_time:function(s){return s&&n(s.getUTCFullYear(),s.getUTCMonth(),s.getUTCDate());},getDates:function(){return c.map(this.dates,this._utc_to_local);},getUTCDates:function(){return c.map(this.dates,function(s){return new Date(s);});},getDate:function(){return this._utc_to_local(this.getUTCDate());},getUTCDate:function(){var s=this.dates.get(-1);if(s!==g){return new Date(s);}else{return null;}},clearDates:function(){this.inputField.val("");this.update();this._trigger("changeDate");if(this.o.autoclose){this.hide();}},setDates:function(){var s=c.isArray(arguments[0])?arguments[0]:arguments;this.update.apply(this,s);this._trigger("changeDate");this.setValue();return this;},setUTCDates:function(){var s=c.isArray(arguments[0])?arguments[0]:arguments;this.setDates.apply(this,c.map(s,this._utc_to_local));return this;},setDate:l("setDates"),setUTCDate:l("setUTCDates"),remove:l("destroy","Method `remove` is deprecated and will be removed in version 2.0. Use `destroy` instead"),setValue:function(){var s=this.getFormattedDate();this.inputField.val(s);return this;},getFormattedDate:function(s){if(s===g){s=this.o.format;}var t=this.o.language;return c.map(this.dates,function(u){return h.formatDate(u,s,t);}).join(this.o.multidateSeparator);},getStartDate:function(){return this.o.startDate;},setStartDate:function(s){this._process_options({startDate:s});this.update();this.updateNavArrows();return this;},getEndDate:function(){return this.o.endDate;},setEndDate:function(s){this._process_options({endDate:s});this.update();this.updateNavArrows();return this;},setDaysOfWeekDisabled:function(s){this._process_options({daysOfWeekDisabled:s});this.update();return this;},setDaysOfWeekHighlighted:function(s){this._process_options({daysOfWeekHighlighted:s});this.update();return this;},setDatesDisabled:function(s){this._process_options({datesDisabled:s});this.update();return this;},place:function(){if(this.isInline){return this;}var I=this.picker.outerWidth(),D=this.picker.outerHeight(),w=10,u=c(this.o.container),y=u.width(),x=this.o.container==="body"?c(document).scrollTop():u.scrollTop(),A=u.offset();var C=[0];this.element.parents().each(function(){var J=c(this).css("z-index");if(J!=="auto"&&Number(J)!==0){C.push(Number(J));}});var F=Math.max.apply(Math,C)+this.o.zIndexOffset;var B=this.component?this.component.parent().offset():this.element.offset();var H=this.component?this.component.outerHeight(true):this.element.outerHeight(false);var v=this.component?this.component.outerWidth(true):this.element.outerWidth(false);var z=B.left-A.left;var E=B.top-A.top;if(this.o.container!=="body"){E+=x;}this.picker.removeClass("datepicker-orient-top datepicker-orient-bottom datepicker-orient-right datepicker-orient-left");if(this.o.orientation.x!=="auto"){this.picker.addClass("datepicker-orient-"+this.o.orientation.x);if(this.o.orientation.x==="right"){z-=I-v;}}else{if(B.left<0){this.picker.addClass("datepicker-orient-left");z-=B.left-w;}else{if(z+I>y){this.picker.addClass("datepicker-orient-right");z+=v-I;}else{if(this.o.rtl){this.picker.addClass("datepicker-orient-right");}else{this.picker.addClass("datepicker-orient-left");}}}}var s=this.o.orientation.y,t;if(s==="auto"){t=-x+E-D;s=t<0?"bottom":"top";}this.picker.addClass("datepicker-orient-"+s);if(s==="top"){E-=D+parseInt(this.picker.css("padding-top"));}else{E+=H;}if(this.o.rtl){var G=y-(z+v);this.picker.css({top:E,right:G,zIndex:F});}else{this.picker.css({top:E,left:z,zIndex:F});}return this;},_allow_update:true,update:function(){if(!this._allow_update){return this;}var t=this.dates.copy(),u=[],s=false;if(arguments.length){c.each(arguments,c.proxy(function(w,v){if(v instanceof Date){v=this._local_to_utc(v);}u.push(v);},this));s=true;}else{u=this.isInput?this.element.val():this.element.data("date")||this.inputField.val();if(u&&this.o.multidate){u=u.split(this.o.multidateSeparator);}else{u=[u];}delete this.element.data().date;}u=c.map(u,c.proxy(function(v){return h.parseDate(v,this.o.format,this.o.language,this.o.assumeNearbyYear);},this));u=c.grep(u,c.proxy(function(v){return(!this.dateWithinRange(v)||!v);},this),true);this.dates.replace(u);if(this.o.updateViewDate){if(this.dates.length){this.viewDate=new Date(this.dates.get(-1));}else{if(this.viewDate<this.o.startDate){this.viewDate=new Date(this.o.startDate);}else{if(this.viewDate>this.o.endDate){this.viewDate=new Date(this.o.endDate);}else{this.viewDate=this.o.defaultViewDate;}}}}if(s){this.setValue();this.element.change();}else{if(this.dates.length){if(String(t)!==String(this.dates)&&s){this._trigger("changeDate");this.element.change();}}}if(!this.dates.length&&t.length){this._trigger("clearDate");this.element.change();}this.fill();return this;},fillDow:function(){if(this.o.showWeekDays){var s=this.o.weekStart,t="<tr>";if(this.o.calendarWeeks){t+='<th class="cw">&#160;</th>';}while(s<this.o.weekStart+7){t+='<th class="dow';if(c.inArray(s,this.o.daysOfWeekDisabled)!==-1){t+=" disabled";}t+='">'+f[this.o.language].daysMin[(s++)%7]+"</th>";}t+="</tr>";this.picker.find(".datepicker-days thead").append(t);}},fillMonths:function(){var s=this._utc_to_local(this.viewDate);var u="";var v;for(var t=0;t<12;t++){v=s&&s.getMonth()===t?" focused":"";u+='<span class="month'+v+'">'+f[this.o.language].monthsShort[t]+"</span>";}this.picker.find(".datepicker-months td").html(u);},setRange:function(s){if(!s||!s.length){delete this.range;}else{this.range=c.map(s,function(t){return t.valueOf();});}this.fill();},getClassNames:function(u){var s=[],v=this.viewDate.getUTCFullYear(),w=this.viewDate.getUTCMonth(),t=b();if(u.getUTCFullYear()<v||(u.getUTCFullYear()===v&&u.getUTCMonth()<w)){s.push("old");}else{if(u.getUTCFullYear()>v||(u.getUTCFullYear()===v&&u.getUTCMonth()>w)){s.push("new");}}if(this.focusDate&&u.valueOf()===this.focusDate.valueOf()){s.push("focused");}if(this.o.todayHighlight&&o(u,t)){s.push("today");}if(this.dates.contains(u)!==-1){s.push("active");}if(!this.dateWithinRange(u)){s.push("disabled");}if(this.dateIsDisabled(u)){s.push("disabled","disabled-date");}if(c.inArray(u.getUTCDay(),this.o.daysOfWeekHighlighted)!==-1){s.push("highlighted");}if(this.range){if(u>this.range[0]&&u<this.range[this.range.length-1]){s.push("range");}if(c.inArray(u.valueOf(),this.range)!==-1){s.push("selected");}if(u.valueOf()===this.range[0]){s.push("range-start");}if(u.valueOf()===this.range[this.range.length-1]){s.push("range-end");}}return s;},_fill_yearsView:function(I,y,D,A,H,w,u){var z="";var v=D/10;var B=this.picker.find(I);var G=Math.floor(A/D)*D;var x=G+v*9;var F=Math.floor(this.viewDate.getFullYear()/v)*v;var E=c.map(this.dates,function(K){return Math.floor(K.getUTCFullYear()/v)*v;});var J,t,C;for(var s=G-v;s<=x+v;s+=v){J=[y];t=null;if(s===G-v){J.push("old");}else{if(s===x+v){J.push("new");}}if(c.inArray(s,E)!==-1){J.push("active");}if(s<H||s>w){J.push("disabled");}if(s===F){J.push("focused");}if(u!==c.noop){C=u(new Date(s,0,1));if(C===g){C={};}else{if(typeof C==="boolean"){C={enabled:C};}else{if(typeof C==="string"){C={classes:C};}}}if(C.enabled===false){J.push("disabled");}if(C.classes){J=J.concat(C.classes.split(/\s+/));}if(C.tooltip){t=C.tooltip;}}z+='<span class="'+J.join(" ")+'"'+(t?' title="'+t+'"':"")+">"+s+"</span>";}B.find(".datepicker-switch").text(G+"-"+x);B.find("td").html(z);},fill:function(){var Q=new Date(this.viewDate),E=Q.getUTCFullYear(),S=Q.getUTCMonth(),L=this.o.startDate!==-Infinity?this.o.startDate.getUTCFullYear():-Infinity,O=this.o.startDate!==-Infinity?this.o.startDate.getUTCMonth():-Infinity,A=this.o.endDate!==Infinity?this.o.endDate.getUTCFullYear():Infinity,M=this.o.endDate!==Infinity?this.o.endDate.getUTCMonth():Infinity,B=f[this.o.language].today||f.en.today||"",u=f[this.o.language].clear||f.en.clear||"",J=f[this.o.language].titleFormat||f.en.titleFormat,R=b(),G=(this.o.todayBtn===true||this.o.todayBtn==="linked")&&R>=this.o.startDate&&R<=this.o.endDate&&!this.weekOfDateIsDisabled(R),w,I;if(isNaN(E)||isNaN(S)){return;}this.picker.find(".datepicker-days .datepicker-switch").text(h.formatDate(Q,J,this.o.language));this.picker.find("tfoot .today").text(B).css("display",G?"table-cell":"none");this.picker.find("tfoot .clear").text(u).css("display",this.o.clearBtn===true?"table-cell":"none");this.picker.find("thead .datepicker-title").text(this.o.title).css("display",typeof this.o.title==="string"&&this.o.title!==""?"table-cell":"none");this.updateNavArrows();this.fillMonths();var T=n(E,S,0),N=T.getUTCDate();T.setUTCDate(N-(T.getUTCDay()-this.o.weekStart+7)%7);var s=new Date(T);if(T.getUTCFullYear()<100){s.setUTCFullYear(T.getUTCFullYear());}s.setUTCDate(s.getUTCDate()+42);s=s.valueOf();var C=[];var D,H;while(T.valueOf()<s){D=T.getUTCDay();if(D===this.o.weekStart){C.push("<tr>");if(this.o.calendarWeeks){var t=new Date(+T+(this.o.weekStart-D-7)%7*86400000),x=new Date(Number(t)+(7+4-t.getUTCDay())%7*86400000),v=new Date(Number(v=n(x.getUTCFullYear(),0,1))+(7+4-v.getUTCDay())%7*86400000),F=(x-v)/86400000/7+1;C.push('<td class="cw">'+F+"</td>");}}H=this.getClassNames(T);H.push("day");var K=T.getUTCDate();if(this.o.beforeShowDay!==c.noop){I=this.o.beforeShowDay(this._utc_to_local(T));if(I===g){I={};}else{if(typeof I==="boolean"){I={enabled:I};}else{if(typeof I==="string"){I={classes:I};}}}if(I.enabled===false){H.push("disabled");}if(I.classes){H=H.concat(I.classes.split(/\s+/));}if(I.tooltip){w=I.tooltip;}if(I.content){K=I.content;}}if(c.isFunction(c.uniqueSort)){H=c.uniqueSort(H);}else{H=c.unique(H);}C.push('<td class="'+H.join(" ")+'"'+(w?' title="'+w+'"':"")+' data-date="'+T.getTime().toString()+'">'+K+"</td>");w=null;if(D===this.o.weekEnd){C.push("</tr>");}T.setUTCDate(T.getUTCDate()+1);}this.picker.find(".datepicker-days tbody").html(C.join(""));var P=f[this.o.language].monthsTitle||f.en.monthsTitle||"Months";var z=this.picker.find(".datepicker-months").find(".datepicker-switch").text(this.o.maxViewMode<2?P:E).end().find("tbody span").removeClass("active");c.each(this.dates,function(U,V){if(V.getUTCFullYear()===E){z.eq(V.getUTCMonth()).addClass("active");}});if(E<L||E>A){z.addClass("disabled");}if(E===L){z.slice(0,O).addClass("disabled");}if(E===A){z.slice(M+1).addClass("disabled");}if(this.o.beforeShowMonth!==c.noop){var y=this;c.each(z,function(U,W){var X=new Date(E,U,1);var V=y.o.beforeShowMonth(X);if(V===g){V={};}else{if(typeof V==="boolean"){V={enabled:V};}else{if(typeof V==="string"){V={classes:V};}}}if(V.enabled===false&&!c(W).hasClass("disabled")){c(W).addClass("disabled");}if(V.classes){c(W).addClass(V.classes);}if(V.tooltip){c(W).prop("title",V.tooltip);}});}this._fill_yearsView(".datepicker-years","year",10,E,L,A,this.o.beforeShowYear);this._fill_yearsView(".datepicker-decades","decade",100,E,L,A,this.o.beforeShowDecade);this._fill_yearsView(".datepicker-centuries","century",1000,E,L,A,this.o.beforeShowCentury);},updateNavArrows:function(){if(!this._allow_update){return;}var v=new Date(this.viewDate),y=v.getUTCFullYear(),t=v.getUTCMonth(),u=this.o.startDate!==-Infinity?this.o.startDate.getUTCFullYear():-Infinity,A=this.o.startDate!==-Infinity?this.o.startDate.getUTCMonth():-Infinity,B=this.o.endDate!==Infinity?this.o.endDate.getUTCFullYear():Infinity,s=this.o.endDate!==Infinity?this.o.endDate.getUTCMonth():Infinity,w,z,x=1;switch(this.viewMode){case 4:x*=10;case 3:x*=10;case 2:x*=10;case 1:w=Math.floor(y/x)*x<=u;z=Math.floor(y/x)*x+x>B;break;case 0:w=y<=u&&t<=A;z=y>=B&&t>=s;break;}this.picker.find(".prev").toggleClass("disabled",w);this.picker.find(".next").toggleClass("disabled",z);},click:function(x){x.preventDefault();x.stopPropagation();var w,t,s,u,v;w=c(x.target);if(w.hasClass("datepicker-switch")&&this.viewMode!==this.o.maxViewMode){this.setViewMode(this.viewMode+1);}if(w.hasClass("today")&&!w.hasClass("day")){this.setViewMode(0);this._setDate(b(),this.o.todayBtn==="linked"?null:"view");}if(w.hasClass("clear")){this.clearDates();}if(!w.hasClass("disabled")){if(w.hasClass("month")||w.hasClass("year")||w.hasClass("decade")||w.hasClass("century")){this.viewDate.setUTCDate(1);s=1;if(this.viewMode===1){v=w.parent().find("span").index(w);u=this.viewDate.getUTCFullYear();this.viewDate.setUTCMonth(v);}else{v=0;u=Number(w.text());this.viewDate.setUTCFullYear(u);}this._trigger(h.viewModes[this.viewMode-1].e,this.viewDate);if(this.viewMode===this.o.minViewMode){this._setDate(n(u,v,s));}else{this.setViewMode(this.viewMode-1);this.fill();}}}if(this.picker.is(":visible")&&this._focused_from){this._focused_from.focus();}delete this._focused_from;},dayCellClick:function(v){var s=c(v.currentTarget);var u=s.data("date");var t=new Date(u);if(this.o.updateViewDate){if(t.getUTCFullYear()!==this.viewDate.getUTCFullYear()){this._trigger("changeYear",this.viewDate);}if(t.getUTCMonth()!==this.viewDate.getUTCMonth()){this._trigger("changeMonth",this.viewDate);}}this._setDate(t);},navArrowsClick:function(u){var s=c(u.currentTarget);var t=s.hasClass("prev")?-1:1;if(this.viewMode!==0){t*=h.viewModes[this.viewMode].navStep*12;}this.viewDate=this.moveMonth(this.viewDate,t);this._trigger(h.viewModes[this.viewMode].e,this.viewDate);this.fill();},_toggle_multidate:function(t){var s=this.dates.contains(t);if(!t){this.dates.clear();}if(s!==-1){if(this.o.multidate===true||this.o.multidate>1||this.o.toggleActive){this.dates.remove(s);}}else{if(this.o.multidate===false){this.dates.clear();this.dates.push(t);}else{this.dates.push(t);}}if(typeof this.o.multidate==="number"){while(this.dates.length>this.o.multidate){this.dates.remove(0);}}},_setDate:function(s,t){if(!t||t==="date"){this._toggle_multidate(s&&new Date(s));}if((!t&&this.o.updateViewDate)||t==="view"){this.viewDate=s&&new Date(s);}this.fill();this.setValue();if(!t||t!=="view"){this._trigger("changeDate");}this.inputField.trigger("change");if(this.o.autoclose&&(!t||t==="date")){this.hide();}},moveDay:function(u,t){var s=new Date(u);s.setUTCDate(u.getUTCDate()+t);return s;},moveWeek:function(t,s){return this.moveDay(t,s*7);},moveMonth:function(s,t){if(!d(s)){return this.o.defaultViewDate;}if(!t){return s;}var w=new Date(s.valueOf()),A=w.getUTCDate(),x=w.getUTCMonth(),v=Math.abs(t),z,y;t=t>0?1:-1;if(v===1){y=t===-1?function(){return w.getUTCMonth()===x;}:function(){return w.getUTCMonth()!==z;};z=x+t;w.setUTCMonth(z);z=(z+12)%12;}else{for(var u=0;u<v;u++){w=this.moveMonth(w,t);}z=w.getUTCMonth();w.setUTCDate(A);y=function(){return z!==w.getUTCMonth();};}while(y()){w.setUTCDate(--A);w.setUTCMonth(z);}return w;},moveYear:function(t,s){return this.moveMonth(t,s*12);},moveAvailableDate:function(t,s,u){do{t=this[u](t,s);if(!this.dateWithinRange(t)){return false;}u="moveDay";}while(this.dateIsDisabled(t));return t;},weekOfDateIsDisabled:function(s){return c.inArray(s.getUTCDay(),this.o.daysOfWeekDisabled)!==-1;},dateIsDisabled:function(s){return(this.weekOfDateIsDisabled(s)||c.grep(this.o.datesDisabled,function(t){return o(s,t);}).length>0);},dateWithinRange:function(s){return s>=this.o.startDate&&s<=this.o.endDate;},keydown:function(w){if(!this.picker.is(":visible")){if(w.keyCode===40||w.keyCode===27){this.show();w.stopPropagation();}return;}var t=false,s,u,v=this.focusDate||this.viewDate;switch(w.keyCode){case 27:if(this.focusDate){this.focusDate=null;this.viewDate=this.dates.get(-1)||this.viewDate;this.fill();}else{this.hide();}w.preventDefault();w.stopPropagation();break;case 37:case 38:case 39:case 40:if(!this.o.keyboardNavigation||this.o.daysOfWeekDisabled.length===7){break;}s=w.keyCode===37||w.keyCode===38?-1:1;if(this.viewMode===0){if(w.ctrlKey){u=this.moveAvailableDate(v,s,"moveYear");if(u){this._trigger("changeYear",this.viewDate);}}else{if(w.shiftKey){u=this.moveAvailableDate(v,s,"moveMonth");if(u){this._trigger("changeMonth",this.viewDate);}}else{if(w.keyCode===37||w.keyCode===39){u=this.moveAvailableDate(v,s,"moveDay");}else{if(!this.weekOfDateIsDisabled(v)){u=this.moveAvailableDate(v,s,"moveWeek");}}}}}else{if(this.viewMode===1){if(w.keyCode===38||w.keyCode===40){s=s*4;}u=this.moveAvailableDate(v,s,"moveMonth");}else{if(this.viewMode===2){if(w.keyCode===38||w.keyCode===40){s=s*4;}u=this.moveAvailableDate(v,s,"moveYear");}}}if(u){this.focusDate=this.viewDate=u;this.setValue();this.fill();w.preventDefault();}break;case 13:if(!this.o.forceParse){break;}v=this.focusDate||this.dates.get(-1)||this.viewDate;if(this.o.keyboardNavigation){this._toggle_multidate(v);t=true;}this.focusDate=null;this.viewDate=this.dates.get(-1)||this.viewDate;this.setValue();this.fill();if(this.picker.is(":visible")){w.preventDefault();w.stopPropagation();if(this.o.autoclose){this.hide();}}break;case 9:this.focusDate=null;this.viewDate=this.dates.get(-1)||this.viewDate;this.fill();this.hide();break;}if(t){if(this.dates.length){this._trigger("changeDate");}else{this._trigger("clearDate");}this.inputField.trigger("change");}},setViewMode:function(s){this.viewMode=s;this.picker.children("div").hide().filter(".datepicker-"+h.viewModes[this.viewMode].clsName).show();this.updateNavArrows();this._trigger("changeViewMode",new Date(this.viewDate));}};var j=function(t,s){c.data(t,"datepicker",this);this.element=c(t);this.inputs=c.map(s.inputs,function(u){return u.jquery?u[0]:u;});delete s.inputs;this.keepEmptyValues=s.keepEmptyValues;delete s.keepEmptyValues;r.call(c(this.inputs),s).on("changeDate",c.proxy(this.dateUpdated,this));this.pickers=c.map(this.inputs,function(u){return c.data(u,"datepicker");});this.updateDates();};j.prototype={updateDates:function(){this.dates=c.map(this.pickers,function(s){return s.getUTCDate();});this.updateRanges();},updateRanges:function(){var s=c.map(this.dates,function(t){return t.valueOf();});c.each(this.pickers,function(t,u){u.setRange(s);});},clearDates:function(){c.each(this.pickers,function(s,t){t.clearDates();});},dateUpdated:function(y){if(this.updating){return;}this.updating=true;var z=c.data(y.target,"datepicker");if(z===g){return;}var x=z.getUTCDate(),v=this.keepEmptyValues,w=c.inArray(y.target,this.inputs),u=w-1,t=w+1,s=this.inputs.length;if(w===-1){return;}c.each(this.pickers,function(A,B){if(!B.getUTCDate()&&(B===z||!v)){B.setUTCDate(x);}});if(x<this.dates[u]){while(u>=0&&x<this.dates[u]){this.pickers[u--].setUTCDate(x);}}else{if(x>this.dates[t]){while(t<s&&x>this.dates[t]){this.pickers[t++].setUTCDate(x);}}}this.updateDates();delete this.updating;},destroy:function(){c.map(this.pickers,function(s){s.destroy();});c(this.inputs).off("changeDate",this.dateUpdated);delete this.element.data().datepicker;},remove:l("destroy","Method `remove` is deprecated and will be removed in version 2.0. Use `destroy` instead")};function k(v,y){var x=c(v).data(),s={},w,u=new RegExp("^"+y.toLowerCase()+"([A-Z])");y=new RegExp("^"+y.toLowerCase());function z(B,A){return A.toLowerCase();}for(var t in x){if(y.test(t)){w=t.replace(u,z);s[w]=x[t];}}return s;}function p(u){var s={};if(!f[u]){u=u.split("-")[0];if(!f[u]){return;}}var t=f[u];c.each(e,function(w,v){if(v in t){s[v]=t[v];}});return s;}var a=c.fn.datepicker;var r=function(u){var s=Array.apply(null,arguments);s.shift();var t;this.each(function(){var B=c(this),A=B.data("datepicker"),w=typeof u==="object"&&u;if(!A){var y=k(this,"date"),v=c.extend({},i,y,w),x=p(v.language),z=c.extend({},i,x,y,w);if(B.hasClass("input-daterange")||z.inputs){c.extend(z,{inputs:z.inputs||B.find("input").toArray()});A=new j(this,z);}else{A=new q(this,z);}B.data("datepicker",A);}if(typeof u==="string"&&typeof A[u]==="function"){t=A[u].apply(A,s);}});if(t===g||t instanceof q||t instanceof j){return this;}if(this.length>1){throw new Error("Using only allowed for the collection of a single element ("+u+" function)");}else{return t;}};c.fn.datepicker=r;var i=c.fn.datepicker.defaults={assumeNearbyYear:false,autoclose:false,beforeShowDay:c.noop,beforeShowMonth:c.noop,beforeShowYear:c.noop,beforeShowDecade:c.noop,beforeShowCentury:c.noop,calendarWeeks:false,clearBtn:false,toggleActive:false,daysOfWeekDisabled:[],daysOfWeekHighlighted:[],datesDisabled:[],endDate:Infinity,forceParse:true,format:"mm/dd/yyyy",keepEmptyValues:false,keyboardNavigation:true,language:"en",minViewMode:0,maxViewMode:4,multidate:false,multidateSeparator:",",orientation:"auto",rtl:false,startDate:-Infinity,startView:0,todayBtn:false,todayHighlight:false,updateViewDate:true,weekStart:0,disableTouchKeyboard:false,enableOnReadonly:true,showOnFocus:true,zIndexOffset:10,container:"body",immediateUpdates:false,title:"",templates:{leftArrow:"&#x00AB;",rightArrow:"&#x00BB;"},showWeekDays:true};var e=c.fn.datepicker.locale_opts=["format","rtl","weekStart"];c.fn.datepicker.Constructor=q;var f=c.fn.datepicker.dates={en:{days:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],daysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],daysMin:["Su","Mo","Tu","We","Th","Fr","Sa"],months:["January","February","March","April","May","June","July","August","September","October","November","December"],monthsShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],today:"Today",clear:"Clear",titleFormat:"MM yyyy"}};var h={viewModes:[{names:["days","month"],clsName:"days",e:"changeMonth"},{names:["months","year"],clsName:"months",e:"changeYear",navStep:1},{names:["years","decade"],clsName:"years",e:"changeDecade",navStep:10},{names:["decades","century"],clsName:"decades",e:"changeCentury",navStep:100},{names:["centuries","millennium"],clsName:"centuries",e:"changeMillennium",navStep:1000}],validParts:/dd?|DD?|mm?|MM?|yy(?:yy)?/g,nonpunctuation:/[^ -\/:-@\u5e74\u6708\u65e5\[-`{-~\t\n\r]+/g,parseFormat:function(u){if(typeof u.toValue==="function"&&typeof u.toDisplay==="function"){return u;}var s=u.replace(this.validParts,"\0").split("\0"),t=u.match(this.validParts);if(!s||!s.length||!t||t.length===0){throw new Error("Invalid date format.");}return{separators:s,parts:t};},parseDate:function(M,J,G,t){if(!M){return g;}if(M instanceof Date){return M;}if(typeof J==="string"){J=h.parseFormat(J);}if(J.toValue){return J.toValue(M,J,G);}var y={d:"moveDay",m:"moveMonth",w:"moveWeek",y:"moveYear"},N={yesterday:"-1d",today:"+0d",tomorrow:"+1d"},E,F,D,I,x;if(M in N){M=N[M];}if(/^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/i.test(M)){E=M.match(/([\-+]\d+)([dmwy])/gi);M=new Date();for(I=0;I<E.length;I++){F=E[I].match(/([\-+]\d+)([dmwy])/i);D=Number(F[1]);x=y[F[2].toLowerCase()];M=q.prototype[x](M,D);}return q.prototype._zero_utc_time(M);}E=M&&M.match(this.nonpunctuation)||[];function v(P,s){if(s===true){s=10;}if(P<100){P+=2000;if(P>((new Date()).getFullYear()+s)){P-=100;}}return P;}var z={},L=["yyyy","yy","M","MM","m","mm","d","dd"],C={yyyy:function(P,s){return P.setUTCFullYear(t?v(s,t):s);},m:function(P,s){if(isNaN(P)){return P;}s-=1;while(s<0){s+=12;}s%=12;P.setUTCMonth(s);while(P.getUTCMonth()!==s){P.setUTCDate(P.getUTCDate()-1);}return P;},d:function(P,s){return P.setUTCDate(s);}},O,w;C.yy=C.yyyy;C.M=C.MM=C.mm=C.m;C.dd=C.d;M=b();var u=J.parts.slice();if(E.length!==u.length){u=c(u).filter(function(s,P){return c.inArray(P,L)!==-1;}).toArray();}function K(){var s=this.slice(0,E[I].length),P=E[I].slice(0,s.length);return s.toLowerCase()===P.toLowerCase();}if(E.length===u.length){var H;for(I=0,H=u.length;I<H;I++){O=parseInt(E[I],10);F=u[I];if(isNaN(O)){switch(F){case"MM":w=c(f[G].months).filter(K);O=c.inArray(w[0],f[G].months)+1;break;case"M":w=c(f[G].monthsShort).filter(K);O=c.inArray(w[0],f[G].monthsShort)+1;break;}}z[F]=O;}var A,B;for(I=0;I<L.length;I++){B=L[I];if(B in z&&!isNaN(z[B])){A=new Date(M);C[B](A,z[B]);if(!isNaN(A)){M=A;}}}}return M;},formatDate:function(s,w,y){if(!s){return"";}if(typeof w==="string"){w=h.parseFormat(w);}if(w.toDisplay){return w.toDisplay(s,w,y);}var x={d:s.getUTCDate(),D:f[y].daysShort[s.getUTCDay()],DD:f[y].days[s.getUTCDay()],m:s.getUTCMonth()+1,M:f[y].monthsShort[s.getUTCMonth()],MM:f[y].months[s.getUTCMonth()],yy:s.getUTCFullYear().toString().substring(2),yyyy:s.getUTCFullYear()};x.dd=(x.d<10?"0":"")+x.d;x.mm=(x.m<10?"0":"")+x.m;s=[];var v=c.extend([],w.separators);for(var u=0,t=w.parts.length;u<=t;u++){if(v.length){s.push(v.shift());}s.push(x[w.parts[u]]);}return s.join("");},headTemplate:'<thead><tr><th colspan="7" class="datepicker-title"></th></tr><tr><th class="prev">'+i.templates.leftArrow+'</th><th colspan="5" class="datepicker-switch"></th><th class="next">'+i.templates.rightArrow+"</th></tr></thead>",contTemplate:'<tbody><tr><td colspan="7"></td></tr></tbody>',footTemplate:'<tfoot><tr><th colspan="7" class="today"></th></tr><tr><th colspan="7" class="clear"></th></tr></tfoot>'};h.template='<div class="datepicker"><div class="datepicker-days"><table class="table-condensed">'+h.headTemplate+"<tbody></tbody>"+h.footTemplate+'</table></div><div class="datepicker-months"><table class="table-condensed">'+h.headTemplate+h.contTemplate+h.footTemplate+'</table></div><div class="datepicker-years"><table class="table-condensed">'+h.headTemplate+h.contTemplate+h.footTemplate+'</table></div><div class="datepicker-decades"><table class="table-condensed">'+h.headTemplate+h.contTemplate+h.footTemplate+'</table></div><div class="datepicker-centuries"><table class="table-condensed">'+h.headTemplate+h.contTemplate+h.footTemplate+"</table></div></div>";c.fn.datepicker.DPGlobal=h;c.fn.datepicker.noConflict=function(){c.fn.datepicker=a;return this;};c.fn.datepicker.version="1.9.0";c.fn.datepicker.deprecated=function(t){var s=window.console;if(s&&s.warn){s.warn("DEPRECATED: "+t);}};c(document).on("focus.datepicker.data-api click.datepicker.data-api",'[data-provide="datepicker"]',function(t){var s=c(this);if(s.data("datepicker")){return;}t.preventDefault();r.call(s,"show");});c(function(){r.call(c('[data-provide="datepicker-inline"]'));});}));