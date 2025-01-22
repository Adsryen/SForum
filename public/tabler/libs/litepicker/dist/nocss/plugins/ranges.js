/*!
 * 
 * plugins/ranges.js
 * Litepicker v2.0.12 (https://github.com/wakirin/Litepicker)
 * Package: litepicker (https://www.npmjs.com/package/litepicker)
 * License: MIT (https://github.com/wakirin/Litepicker/blob/master/LICENCE.md)
 * Copyright 2019-2021 Rinat G.
 *     
 * Hash: fc3887e0bb19d54c36db
 * 
 */!function(e){var n={};function t(s){if(n[s])return n[s].exports;var o=n[s]={i:s,l:!1,exports:{}};return e[s].call(o.exports,o,o.exports,t),o.l=!0,o.exports}t.m=e,t.c=n,t.d=function(e,n,s){t.o(e,n)||Object.defineProperty(e,n,{enumerable:!0,get:s})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,n){if(1&n&&(e=t(e)),8&n)return e;if(4&n&&"object"==typeof e&&e&&e.__esModule)return e;var o,s=Object.create(null);if(t.r(s),Object.defineProperty(s,"default",{enumerable:!0,value:e}),2&n&&"string"!=typeof e)for(o in e)t.d(s,o,function(t){return e[t]}.bind(null,o));return s},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="",t(t.s=4)}({4:function(e,t,n){"use strict";n.r(t),n(5);function o(e,t){var n,s=Object.keys(e);return Object.getOwnPropertySymbols&&(n=Object.getOwnPropertySymbols(e),t&&(n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),s.push.apply(s,n)),s}function i(e){for(var t,n=1;n<arguments.length;n++)t=null!=arguments[n]?arguments[n]:{},n%2?o(Object(t),!0).forEach(function(n){s(e,n,t[n])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(t)):o(Object(t)).forEach(function(n){Object.defineProperty(e,n,Object.getOwnPropertyDescriptor(t,n))});return e}function s(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}Litepicker.add("ranges",{init:function(e){var t,n,o,a={position:"left",customRanges:{},customRangesLabels:["Today","Yesterday","Last 7 Days","Last 30 Days","This Month","Last Month"],force:!1,autoApply:e.options.autoApply};e.options.ranges=i(i({},a),e.options.ranges),e.options.singleMode=!1,t=e.options.ranges,Object.keys(t.customRanges).length||(n=e.DateTime(),t.customRanges=(s(o={},t.customRangesLabels[0],[n.clone(),n.clone()]),s(o,t.customRangesLabels[1],[n.clone().subtract(1,"day"),n.clone().subtract(1,"day")]),s(o,t.customRangesLabels[2],[n.clone().subtract(6,"day"),n]),s(o,t.customRangesLabels[3],[n.clone().subtract(29,"day"),n]),s(o,t.customRangesLabels[4],function(e){var t=e.clone();return t.setDate(1),[t,new Date(e.getFullYear(),e.getMonth()+1,0)]}(n)),s(o,t.customRangesLabels[5],function(e){var t=e.clone();return t.setDate(1),t.setMonth(e.getMonth()-1),[t,new Date(e.getFullYear(),e.getMonth(),0)]}(n)),o)),e.on("render",function(n){var s=document.createElement("div");s.className="container__predefined-ranges",e.ui.dataset.rangesPosition=t.position,Object.keys(t.customRanges).forEach(function(o){var a=t.customRanges[o],i=document.createElement("button");i.innerText=o,i.tabIndex=n.dataset.plugins.indexOf("keyboardnav")>=0?1:-1,i.dataset.start=a[0].getTime(),i.dataset.end=a[1].getTime(),i.addEventListener("click",function(n){if(o=n.target,o){var o,s=e.DateTime(Number(o.dataset.start)),i=e.DateTime(Number(o.dataset.end));t.autoApply?(e.setDateRange(s,i,t.force),e.emit("ranges.selected",s,i),e.hide()):(e.datePicked=[s,i],e.emit("ranges.preselect",s,i)),!e.options.inlineMode&&t.autoApply||e.gotoDate(s)}}),s.appendChild(i)}),n.querySelector(".container__main").prepend(s)})}})},5:function(e){e.exports={litepicker:"litepicker",containerMain:"container__main",containerPredefinedRanges:"container__predefined-ranges"}}})