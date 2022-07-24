!function(){"use strict";var e,t,n,r,o={},i={};function a(e){var t=i[e];if(void 0!==t)return t.exports;var n=i[e]={exports:{}};return o[e](n,n.exports,a),n.exports}a.m=o,a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,{a:t}),t},a.d=function(e,t){for(var n in t)a.o(t,n)&&!a.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},a.f={},a.e=function(e){return Promise.all(Object.keys(a.f).reduce((function(t,n){return a.f[n](e,t),t}),[]))},a.u=function(e){return e+"."+{10:"27cbfdb625146d2c",12:"d5dd702a03c35a2e",21:"1eb7fd4394ec4d14",36:"6926fe5cbd27c435",134:"ac296cd3c8120740",292:"f4470d09ab9a8821",295:"db91ca8108b9bc02",313:"0c7fd344859ba7b7",361:"8d567a8810f2060b",362:"86beae1d9d281e83",450:"61592eda91a3d148",462:"968158421133125b",578:"9729bf5fb0037336",605:"1c629334abdc0618",649:"5e84f2b6178ef107",668:"c1799094a8150460",713:"88d29168443da172"}[e]+".js"},a.miniCssF=function(e){return e+".9af3c289cbb7613a.css"},a.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"==typeof window)return window}}(),a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},e={},t="gw2-embeds:",a.l=function(n,r,o,i){if(e[n])e[n].push(r);else{var u,c;if(void 0!==o)for(var f=document.getElementsByTagName("script"),d=0;d<f.length;d++){var l=f[d];if(l.getAttribute("src")==n||l.getAttribute("data-webpack")==t+o){u=l;break}}u||(c=!0,(u=document.createElement("script")).charset="utf-8",u.timeout=120,a.nc&&u.setAttribute("nonce",a.nc),u.setAttribute("data-webpack",t+o),u.src=n),e[n]=[r];var s=function(t,r){u.onerror=u.onload=null,clearTimeout(b);var o=e[n];if(delete e[n],u.parentNode&&u.parentNode.removeChild(u),o&&o.forEach((function(e){return e(r)})),t)return t(r)},b=setTimeout(s.bind(null,void 0,{type:"timeout",target:u}),12e4);u.onerror=s.bind(null,u.onerror),u.onload=s.bind(null,u.onload),c&&document.head.appendChild(u)}},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){var e;a.g.importScripts&&(e=a.g.location+"");var t=a.g.document;if(!e&&t&&(t.currentScript&&(e=t.currentScript.src),!e)){var n=t.getElementsByTagName("script");n.length&&(e=n[n.length-1].src)}if(!e)throw new Error("Automatic publicPath is not supported in this browser");e=e.replace(/#.*$/,"").replace(/\?.*$/,"").replace(/\/[^\/]+$/,"/"),a.p=e}(),n=function(e){return new Promise((function(t,n){var r=a.miniCssF(e),o=a.p+r;if(function(e,t){for(var n=document.getElementsByTagName("link"),r=0;r<n.length;r++){var o=(a=n[r]).getAttribute("data-href")||a.getAttribute("href");if("stylesheet"===a.rel&&(o===e||o===t))return a}var i=document.getElementsByTagName("style");for(r=0;r<i.length;r++){var a;if((o=(a=i[r]).getAttribute("data-href"))===e||o===t)return a}}(r,o))return t();!function(e,t,n,r){var o=document.createElement("link");o.rel="stylesheet",o.type="text/css",o.onerror=o.onload=function(i){if(o.onerror=o.onload=null,"load"===i.type)n();else{var a=i&&("load"===i.type?"missing":i.type),u=i&&i.target&&i.target.href||t,c=new Error("Loading CSS chunk "+e+" failed.\n("+u+")");c.code="CSS_CHUNK_LOAD_FAILED",c.type=a,c.request=u,o.parentNode.removeChild(o),r(c)}},o.href=t,document.head.appendChild(o)}(e,o,t,n)}))},r={179:0},a.f.miniCss=function(e,t){r[e]?t.push(r[e]):0!==r[e]&&{713:1}[e]&&t.push(r[e]=n(e).then((function(){r[e]=0}),(function(t){throw delete r[e],t})))},function(){var e={179:0};a.f.j=function(t,n){var r=a.o(e,t)?e[t]:void 0;if(0!==r)if(r)n.push(r[2]);else{var o=new Promise((function(n,o){r=e[t]=[n,o]}));n.push(r[2]=o);var i=a.p+a.u(t),u=new Error;a.l(i,(function(n){if(a.o(e,t)&&(0!==(r=e[t])&&(e[t]=void 0),r)){var o=n&&("load"===n.type?"missing":n.type),i=n&&n.target&&n.target.src;u.message="Loading chunk "+t+" failed.\n("+o+": "+i+")",u.name="ChunkLoadError",u.type=o,u.request=i,r[1](u)}}),"chunk-"+t,t)}};var t=function(t,n){var r,o,i=n[0],u=n[1],c=n[2],f=0;if(i.some((function(t){return 0!==e[t]}))){for(r in u)a.o(u,r)&&(a.m[r]=u[r]);c&&c(a)}for(t&&t(n);f<i.length;f++)o=i[f],a.o(e,o)&&e[o]&&e[o][0](),e[o]=0},n=self.webpackChunkgw2_embeds=self.webpackChunkgw2_embeds||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))}();var u=function(){Promise.all([a.e(713),a.e(578)]).then(a.bind(a,578)).then((function(e){return e.default()}))};"loading"===document.readyState?document.addEventListener("DOMContentLoaded",u):setTimeout(u,1)}();