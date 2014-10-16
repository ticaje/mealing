!function(e){function s(s,l){this.element=s,this.settings=e.extend({},t,l),this._defaults=t,this._name=n,this._serverDate=null,this._javaScriptDate=null,this.currentDate=null,this.targetDate=null,this.days=null,this.hours=null,this.minutes=null,this.seconds=null,this.deciseconds=null,this.milliseconds=null,this.daysLabel=null,this.hoursLabel=null,this.minutesLabel=null,this.secondsLabel=null,this.decisecondsLabel=null,this.millisecondsLabel=null,this._intervalId=null,this._wrapsExists={},this._oldValues={},this._changed=!1,this.init()}var n="countDown",t={day:1,month:1,year:2050,hour:0,minute:0,second:0,millisecond:0,timeZone:!1,daysWrapper:".ce-days",hoursWrapper:".ce-hours",minutesWrapper:".ce-minutes",secondsWrapper:".ce-seconds",decisecondsWrapper:".ce-dseconds",millisecondsWrapper:".ce-mseconds",daysLabelWrapper:".ce-days-label",hoursLabelWrapper:".ce-hours-label",minutesLabelWrapper:".ce-minutes-label",secondsLabelWrapper:".ce-seconds-label",decisecondsLabelWrapper:".ce-dseconds-label",millisecondsLabelWrapper:".ce-mseconds-label",daysLabel:"Days",dayLabel:"Day",hoursLabel:"Hours",hourLabel:"Hour",minutesLabel:"Minutes",minuteLabel:"Minute",secondsLabel:"Seconds",secondLabel:"Second",decisecondsLabel:"Deciseconds",decisecondLabel:"Decisecond",millisecondsLabel:"Milliseconds",millisecondLabel:"Millisecond",timeout:1e3,highspeedTimeout:4,leftHandZeros:!0,wrapDigits:!0,wrapDigitsTag:"span",dayInMilliseconds:864e5,hourInMilliseconds:36e5,minuteInMilliseconds:6e4,secondInMilliseconds:1e3,decisecondInMilliseconds:100,onInit:null,beforeCalculation:null,afterCalculation:null,onCalculation:null,onChange:null,onComplete:null};s.prototype={init:function(){var s=this,n=s.element,t=s.settings;(e(n).find(t.decisecondsWrapper).length>0||e(n).find(t.millisecondsWrapper).length>0)&&(t.timeout=t.highspeedTimeout),e.isFunction(t.onInit)&&t.onInit.call(s),s._intervalId=setInterval(function(){s.calculate()},t.timeout),s.calculate()},calculate:function(){var s=this,n=s.settings,t=n.dayInMilliseconds,l=n.hourInMilliseconds,i=n.minuteInMilliseconds,a=n.secondInMilliseconds,o=n.decisecondInMilliseconds,r=!1;s.setTargetDate(new Date(n.year,n.month-1,n.day,n.hour,n.minute,n.second));var c=s.getCurrentDate(),d=s.getTargetDate(),u=c.getTime(),h=n.timeZone===!1?0:(d.getTimezoneOffset()/60+n.timeZone)*n.hourInMilliseconds,m=d.getTime()-h,g=m-u,p=g;e.isFunction(n.beforeCalculation)&&n.beforeCalculation.call(s),s._changed=!1;var f=Math.floor(p/t);p%=t;var b=Math.floor(p/l);p%=l;var L=Math.floor(p/i);p%=i;var D=Math.floor(p/a),v=p%a,_=Math.floor(v/o);f=s.naturalNum(f),b=s.naturalNum(b),L=s.naturalNum(L),D=s.naturalNum(D),v=s.naturalNum(v),_=s.naturalNum(_),s.days=f,s.hours=b,s.minutes=L,s.seconds=D,s.milliseconds=v,s.deciseconds=_,s.format(),s.output(),Math.floor(g/n.timeout)<=0&&(r=!0,(null!=n.millisecondsWrapper||null!=n.decisecondsWrapper)&&(r=0>=g?!0:!1)),1==r&&(e.isFunction(n.onComplete)&&n.onComplete.call(s),clearInterval(s._intervalId)),e.isFunction(n.onCalculation)&&n.onCalculation.call(s),e.isFunction(n.afterCalculation)&&n.afterCalculation.call(s)},format:function(){var e=this,s=e.settings,n=e.days,t=e.hours,l=e.minutes,i=e.seconds,a=e.deciseconds,o=e.milliseconds,r=s.dayLabel,c=s.hourLabel,d=s.minuteLabel,u=s.secondLabel,h=s.decisecondLabel,m=s.millisecondsLabel;1==s.leftHandZeros&&(e.days=e.strPad(n,2),e.hours=e.strPad(t,2),e.minutes=e.strPad(l,2),e.seconds=e.strPad(i,2),e.milliseconds=e.strPad(o,3)),e.daysLabel=1==n&&null!==r?r:s.daysLabel,e.hoursLabel=1==t&&null!==c?c:s.hoursLabel,e.minutesLabel=1==l&&null!==d?d:s.minutesLabel,e.secondsLabel=1==i&&null!==u?u:s.secondsLabel,e.decisecondsLabel=1==a&&null!==h?h:s.decisecondsLabel,e.millisecondsLabel=1==o&&null!==m?m:s.millisecondsLabel},output:function(){var s=this,n=s.settings;s.writeLabelToDom(n.daysLabelWrapper,s.daysLabel),s.writeLabelToDom(n.hoursLabelWrapper,s.hoursLabel),s.writeLabelToDom(n.minutesLabelWrapper,s.minutesLabel),s.writeLabelToDom(n.secondsLabelWrapper,s.secondsLabel),s.writeLabelToDom(n.decisecondsLabelWrapper,s.decisecondsLabel),s.writeLabelToDom(n.millisecondsLabelWrapper,s.millisecondsLabel),s.writeDigitsToDom(n.daysWrapper,s.days,"ce-days-digit"),s.writeDigitsToDom(n.hoursWrapper,s.hours,"ce-hours-digit"),s.writeDigitsToDom(n.minutesWrapper,s.minutes,"ce-minutes-digit"),s.writeDigitsToDom(n.secondsWrapper,s.seconds,"ce-seconds-digit"),s.writeDigitsToDom(n.decisecondsWrapper,s.deciseconds,"ce-dseconds-digit"),s.writeDigitsToDom(n.millisecondsWrapper,s.milliseconds,"ce-mseconds-digit"),e.isFunction(n.onChange)&&1==s._changed&&n.onChange.call(s)},pause:function(){var e=this,s=e._intervalId;s&&clearInterval(s)},resume:function(){var e=this,s=e.settings;e._intervalId=setInterval(function(){e.calculate()},s.timeout)},destroy:function(){var s=this,n=s._intervalId;e(s.element),n&&clearInterval(n)},getOption:function(e){return this.settings[e]},setOption:function(e,s){this.settings[e]=s},setTargetDate:function(e){this.targetDate=e},getTargetDate:function(){return this.targetDate},setCurrentDate:function(e){this.currentDate=e},getCurrentDate:function(){return new Date},getOptions:function(){return this.settings},naturalNum:function(e){return 0>e?0:e},strPad:function(e,s,n){var t=e.toString();for(n||(n="0");t.length<s;)t=n+t;return t},writeLabelToDom:function(s,n){var t=this,l=e(t.element);null==t._wrapsExists[s]&&(t._wrapsExists[s]=l.find(s).length>0?!0:!1),t._oldValues[s]!=n&&t._wrapsExists[s]&&(t._oldValues[s]=n,l.find(s).text(n),t._changed=!0)},writeDigitsToDom:function(s,n,t){var l,i,a=this,o=a.settings,r=o.wrapDigitsTag,c=e(a.element),d=c.find(s),n=n.toString(),u=[];if(null==a._wrapsExists[s]&&(a._wrapsExists[s]=d.length>0?!0:!1),0==a._wrapsExists[s])return!1;if(1==o.wrapDigits)for(var h=0;h<n.length;h++)u[h]=n[h];else u[0]=n;if("undefined"==typeof a._oldValues[s]&&(a._oldValues[s]=[]),a._oldValues[s].length>u.length){i=a._oldValues[s].length-u.length,l=d.find(r),l.slice(0,i).remove(),l=d.find(r);for(var h=0;h<u.length;h++)l.eq(h).addClass("test").text(u[h]);a._changed=!0}if(a._oldValues[s].length<u.length){if(0==o.wrapDigits)d.text(u[0]);else{0==a._oldValues[s].length&&d.text("");for(var m="",h=0;h<u.length;h++)i=u.length-a._oldValues[s].length,i>h?m+="<"+r+' class="'+t+'">'+u[h]+"</"+r+">":(l=d.find(r),l.eq(h-i).text(u[h]));d.prepend(m)}a._changed=!0}if(a._oldValues[s].length==u.length)if(0==o.wrapDigits)a._oldValues[s][0]!=u[0]&&(d.text(u[0]),a._changed=!0);else for(var h=0;h<u.length;h++)a._oldValues[s][h]!=u[h]&&(l=d.find(r),l.eq(h).text(u[h]),a._changed=!0);a._oldValues[s]=[];for(var h=0;h<u.length;h++)a._oldValues[s][h]=u[h]}},e.fn[n]=function(t,l,i){var a=null,o=this.each(function(){var o="plugin_",r=null;if(e.data(this,o+n)){if(r=e.data(this,o+n),"destroy"===t)return r.destroy(),e.data(this,o+n,null),void 0;var c=r[t];return"function"==typeof c&&(a=c.call(r,l,i)),!1}r=new s(this,t),e.data(this,o+n,r)});return a?a:o}}(jQuery,window,document);
