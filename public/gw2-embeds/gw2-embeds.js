!function(){"use strict";var e,t,n,r,o={},a={};function i(e){var t=a[e];if(void 0!==t)return t.exports;var n=a[e]={exports:{}};return o[e](n,n.exports,i),n.exports}i.m=o,i.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(t,{a:t}),t},i.d=function(e,t){for(var n in t)i.o(t,n)&&!i.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},i.f={},i.e=function(e){return Promise.all(Object.keys(i.f).reduce((function(t,n){return i.f[n](e,t),t}),[]))},i.u=function(e){return e+"."+{10:"27cbfdb625146d2c",12:"d5dd702a03c35a2e",21:"f9680b546725373c",36:"7be9184a175492b5",134:"87ba04d7c1d393e5",292:"f4470d09ab9a8821",295:"db91ca8108b9bc02",313:"0c7fd344859ba7b7",361:"8d567a8810f2060b",362:"01b997d55ab520cc",450:"61592eda91a3d148",462:"968158421133125b",529:"9d981d1a9a1c7572",578:"614ba5a5fce44cdb",605:"561c72e87a445940",668:"c1799094a8150460",713:"88d29168443da172"}[e]+".js"},i.miniCssF=function(e){return e+".9af3c289cbb7613a.css"},i.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"==typeof window)return window}}(),i.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},e={},t="gw2-embeds:",i.l=function(n,r,o,a){if(e[n])e[n].push(r);else{var u,c;if(void 0!==o)for(var d=document.getElementsByTagName("script"),f=0;f<d.length;f++){var l=d[f];if(l.getAttribute("src")==n||l.getAttribute("data-webpack")==t+o){u=l;break}}u||(c=!0,(u=document.createElement("script")).charset="utf-8",u.timeout=120,i.nc&&u.setAttribute("nonce",i.nc),u.setAttribute("data-webpack",t+o),u.src=n),e[n]=[r];var s=function(t,r){u.onerror=u.onload=null,clearTimeout(b);var o=e[n];if(delete e[n],u.parentNode&&u.parentNode.removeChild(u),o&&o.forEach((function(e){return e(r)})),t)return t(r)},b=setTimeout(s.bind(null,void 0,{type:"timeout",target:u}),12e4);u.onerror=s.bind(null,u.onerror),u.onload=s.bind(null,u.onload),c&&document.head.appendChild(u)}},i.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){var e;i.g.importScripts&&(e=i.g.location+"");var t=i.g.document;if(!e&&t&&(t.currentScript&&(e=t.currentScript.src),!e)){var n=t.getElementsByTagName("script");n.length&&(e=n[n.length-1].src)}if(!e)throw new Error("Automatic publicPath is not supported in this browser");e=e.replace(/#.*$/,"").replace(/\?.*$/,"").replace(/\/[^\/]+$/,"/"),i.p=e}(),n=function(e){return new Promise((function(t,n){var r=i.miniCssF(e),o=i.p+r;if(function(e,t){for(var n=document.getElementsByTagName("link"),r=0;r<n.length;r++){var o=(i=n[r]).getAttribute("data-href")||i.getAttribute("href");if("stylesheet"===i.rel&&(o===e||o===t))return i}var a=document.getElementsByTagName("style");for(r=0;r<a.length;r++){var i;if((o=(i=a[r]).getAttribute("data-href"))===e||o===t)return i}}(r,o))return t();!function(e,t,n,r){var o=document.createElement("link");o.rel="stylesheet",o.type="text/css",o.onerror=o.onload=function(a){if(o.onerror=o.onload=null,"load"===a.type)n();else{var i=a&&("load"===a.type?"missing":a.type),u=a&&a.target&&a.target.href||t,c=new Error("Loading CSS chunk "+e+" failed.\n("+u+")");c.code="CSS_CHUNK_LOAD_FAILED",c.type=i,c.request=u,o.parentNode.removeChild(o),r(c)}},o.href=t,document.head.appendChild(o)}(e,o,t,n)}))},r={179:0},i.f.miniCss=function(e,t){r[e]?t.push(r[e]):0!==r[e]&&{713:1}[e]&&t.push(r[e]=n(e).then((function(){r[e]=0}),(function(t){throw delete r[e],t})))},function(){var e={179:0};i.f.j=function(t,n){var r=i.o(e,t)?e[t]:void 0;if(0!==r)if(r)n.push(r[2]);else{var o=new Promise((function(n,o){r=e[t]=[n,o]}));n.push(r[2]=o);var a=i.p+i.u(t),u=new Error;i.l(a,(function(n){if(i.o(e,t)&&(0!==(r=e[t])&&(e[t]=void 0),r)){var o=n&&("load"===n.type?"missing":n.type),a=n&&n.target&&n.target.src;u.message="Loading chunk "+t+" failed.\n("+o+": "+a+")",u.name="ChunkLoadError",u.type=o,u.request=a,r[1](u)}}),"chunk-"+t,t)}};var t=function(t,n){var r,o,a=n[0],u=n[1],c=n[2],d=0;if(a.some((function(t){return 0!==e[t]}))){for(r in u)i.o(u,r)&&(i.m[r]=u[r]);c&&c(i)}for(t&&t(n);d<a.length;d++)o=a[d],i.o(e,o)&&e[o]&&e[o][0](),e[o]=0},n=self.webpackChunkgw2_embeds=self.webpackChunkgw2_embeds||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))}();var u=function(){Promise.all([i.e(713),i.e(578)]).then(i.bind(i,578)).then((function(e){return e.default()}))};"loading"===document.readyState?document.addEventListener("DOMContentLoaded",u):setTimeout(u,1)}();