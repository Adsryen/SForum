(function(){for(var n=0,t=["webkit","moz","ms","o"],e=0;e<t.length&&!window.requestAnimationFrame;++e)window.requestAnimationFrame=window[t[e]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[t[e]+"CancelAnimationFrame"]||window[t[e]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(e){var t=(new Date).getTime(),s=Math.max(0,16-(t-n)),o=window.setTimeout(function(){return e(t+s)},s);return n=t+s,o}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(e){clearTimeout(e)})})()