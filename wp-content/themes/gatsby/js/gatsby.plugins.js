
/*
 * Copyright (C) 2009 Joel Sutherland
 * Licenced under the MIT license
 * http://www.newmediacampaigns.com/page/jquery-flickr-plugin
 *
 * Available tags for templates:
 * title, link, date_taken, description, published, author, author_id, tags, image*
 */
(function($){$.fn.jflickrfeed=function(settings,callback){settings=$.extend(true,{flickrbase:'http://api.flickr.com/services/feeds/',feedapi:'photos_public.gne',limit:20,qstrings:{lang:'en-us',format:'json',jsoncallback:'?'},cleanDescription:true,useTemplate:true,itemTemplate:'',itemCallback:function(){}},settings);var url=settings.flickrbase+settings.feedapi+'?';var first=true;for(var key in settings.qstrings){if(!first)
	url+='&';url+=key+'='+settings.qstrings[key];first=false;}
	return $(this).each(function(){var $container=$(this);var container=this;$.getJSON(url,function(data){$.each(data.items,function(i,item){if(i<settings.limit){if(settings.cleanDescription){var regex=/<p>(.*?)<\/p>/g;var input=item.description;if(regex.test(input)){item.description=input.match(regex)[2]
		if(item.description!=undefined)
			item.description=item.description.replace('<p>','').replace('</p>','');}}
		item['image_s']=item.media.m.replace('_m','_s');item['image_t']=item.media.m.replace('_m','_t');item['image_m']=item.media.m.replace('_m','_m');item['image']=item.media.m.replace('_m','');item['image_b']=item.media.m.replace('_m','_b');delete item.media;if(settings.useTemplate){var template=settings.itemTemplate;for(var key in item){var rgx=new RegExp('{{'+key+'}}','g');template=template.replace(rgx,item[key]);}
			$container.append(template)}
		settings.itemCallback.call(container,item);}});if($.isFunction(callback)){callback.call(container,data);}});});}})(jQuery);


!function(b,c){"object"==typeof exports&&"object"==typeof module?module.exports=c():"function"==typeof define&&define.amd?define([],c):"object"==typeof exports?exports.Handlebars=c():b.Handlebars=c()}(this,function(){return function(a){function c(d){if(b[d])return b[d].exports;var e=b[d]={exports:{},id:d,loaded:!1};return a[d].call(e.exports,e,e.exports,c),e.loaded=!0,e.exports}var b={};return c.m=a,c.c=b,c.p="",c(0)}([function(a,b,c){"use strict";function r(){var a=q();return a.compile=function(b,c){return j.compile(b,c,a)},a.precompile=function(b,c){return j.precompile(b,c,a)},a.AST=h.default,a.Compiler=j.Compiler,a.JavaScriptCompiler=l.default,a.Parser=i.parser,a.parse=i.parse,a}var d=c(1).default;b.__esModule=!0;var e=c(2),f=d(e),g=c(21),h=d(g),i=c(22),j=c(27),k=c(28),l=d(k),m=c(25),n=d(m),o=c(20),p=d(o),q=f.default.create,s=r();s.create=r,p.default(s),s.Visitor=n.default,s.default=s,b.default=s,a.exports=b.default},function(a,b){"use strict";b.default=function(a){return a&&a.__esModule?a:{default:a}},b.__esModule=!0},function(a,b,c){"use strict";function r(){var a=new g.HandlebarsEnvironment;return m.extend(a,g),a.SafeString=i.default,a.Exception=k.default,a.Utils=m,a.escapeExpression=m.escapeExpression,a.VM=o,a.template=function(b){return o.template(b,a)},a}var d=c(3).default,e=c(1).default;b.__esModule=!0;var f=c(4),g=d(f),h=c(18),i=e(h),j=c(6),k=e(j),l=c(5),m=d(l),n=c(19),o=d(n),p=c(20),q=e(p),s=r();s.create=r,q.default(s),s.default=s,b.default=s,a.exports=b.default},function(a,b){"use strict";b.default=function(a){if(a&&a.__esModule)return a;var b={};if(null!=a)for(var c in a)Object.prototype.hasOwnProperty.call(a,c)&&(b[c]=a[c]);return b.default=a,b},b.__esModule=!0},function(a,b,c){"use strict";function p(a,b,c){this.helpers=a||{},this.partials=b||{},this.decorators=c||{},h.registerDefaultHelpers(this),i.registerDefaultDecorators(this)}var d=c(1).default;b.__esModule=!0,b.HandlebarsEnvironment=p;var e=c(5),f=c(6),g=d(f),h=c(7),i=c(15),j=c(17),k=d(j),l="4.0.5";b.VERSION=l;var m=7;b.COMPILER_REVISION=m;var n={1:"<= 1.0.rc.2",2:"== 1.0.0-rc.3",3:"== 1.0.0-rc.4",4:"== 1.x.x",5:"== 2.0.0-alpha.x",6:">= 2.0.0-beta.1",7:">= 4.0.0"};b.REVISION_CHANGES=n;var o="[object Object]";p.prototype={constructor:p,logger:k.default,log:k.default.log,registerHelper:function(b,c){if(e.toString.call(b)===o){if(c)throw new g.default("Arg not supported with multiple helpers");e.extend(this.helpers,b)}else this.helpers[b]=c},unregisterHelper:function(b){delete this.helpers[b]},registerPartial:function(b,c){if(e.toString.call(b)===o)e.extend(this.partials,b);else{if("undefined"==typeof c)throw new g.default('Attempting to register a partial called "'+b+'" as undefined');this.partials[b]=c}},unregisterPartial:function(b){delete this.partials[b]},registerDecorator:function(b,c){if(e.toString.call(b)===o){if(c)throw new g.default("Arg not supported with multiple decorators");e.extend(this.decorators,b)}else this.decorators[b]=c},unregisterDecorator:function(b){delete this.decorators[b]}};var q=k.default.log;b.log=q,b.createFrame=e.createFrame,b.logger=k.default},function(a,b){"use strict";function f(a){return c[a]}function g(a){for(var b=1;b<arguments.length;b++)for(var c in arguments[b])Object.prototype.hasOwnProperty.call(arguments[b],c)&&(a[c]=arguments[b][c]);return a}function k(a,b){for(var c=0,d=a.length;c<d;c++)if(a[c]===b)return c;return-1}function l(a){if("string"!=typeof a){if(a&&a.toHTML)return a.toHTML();if(null==a)return"";if(!a)return a+"";a=""+a}return e.test(a)?a.replace(d,f):a}function m(a){return!a&&0!==a||!(!j(a)||0!==a.length)}function n(a){var b=g({},a);return b._parent=a,b}function o(a,b){return a.path=b,a}function p(a,b){return(a?a+".":"")+b}b.__esModule=!0,b.extend=g,b.indexOf=k,b.escapeExpression=l,b.isEmpty=m,b.createFrame=n,b.blockParams=o,b.appendContextPath=p;var c={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","`":"&#x60;","=":"&#x3D;"},d=/[&<>"'`=]/g,e=/[&<>"'`=]/,h=Object.prototype.toString;b.toString=h;var i=function(b){return"function"==typeof b};i(/x/)&&(b.isFunction=i=function(a){return"function"==typeof a&&"[object Function]"===h.call(a)}),b.isFunction=i;var j=Array.isArray||function(a){return!(!a||"object"!=typeof a)&&"[object Array]"===h.call(a)};b.isArray=j},function(a,b){"use strict";function d(a,b){var e=b&&b.loc,f=void 0,g=void 0;e&&(f=e.start.line,g=e.start.column,a+=" - "+f+":"+g);for(var h=Error.prototype.constructor.call(this,a),i=0;i<c.length;i++)this[c[i]]=h[c[i]];Error.captureStackTrace&&Error.captureStackTrace(this,d),e&&(this.lineNumber=f,this.column=g)}b.__esModule=!0;var c=["description","fileName","lineNumber","message","name","number","stack"];d.prototype=new Error,b.default=d,a.exports=b.default},function(a,b,c){"use strict";function s(a){f.default(a),h.default(a),j.default(a),l.default(a),n.default(a),p.default(a),r.default(a)}var d=c(1).default;b.__esModule=!0,b.registerDefaultHelpers=s;var e=c(8),f=d(e),g=c(9),h=d(g),i=c(10),j=d(i),k=c(11),l=d(k),m=c(12),n=d(m),o=c(13),p=d(o),q=c(14),r=d(q)},function(a,b,c){"use strict";b.__esModule=!0;var d=c(5);b.default=function(a){a.registerHelper("blockHelperMissing",function(b,c){var e=c.inverse,f=c.fn;if(b===!0)return f(this);if(b===!1||null==b)return e(this);if(d.isArray(b))return b.length>0?(c.ids&&(c.ids=[c.name]),a.helpers.each(b,c)):e(this);if(c.data&&c.ids){var g=d.createFrame(c.data);g.contextPath=d.appendContextPath(c.data.contextPath,c.name),c={data:g}}return f(b,c)})},a.exports=b.default},function(a,b,c){"use strict";var d=c(1).default;b.__esModule=!0;var e=c(5),f=c(6),g=d(f);b.default=function(a){a.registerHelper("each",function(a,b){function k(b,d,f){i&&(i.key=b,i.index=d,i.first=0===d,i.last=!!f,j&&(i.contextPath=j+b)),h+=c(a[b],{data:i,blockParams:e.blockParams([a[b],b],[j+b,null])})}if(!b)throw new g.default("Must pass iterator to #each");var c=b.fn,d=b.inverse,f=0,h="",i=void 0,j=void 0;if(b.data&&b.ids&&(j=e.appendContextPath(b.data.contextPath,b.ids[0])+"."),e.isFunction(a)&&(a=a.call(this)),b.data&&(i=e.createFrame(b.data)),a&&"object"==typeof a)if(e.isArray(a))for(var l=a.length;f<l;f++)f in a&&k(f,f,f===a.length-1);else{var m=void 0;for(var n in a)a.hasOwnProperty(n)&&(void 0!==m&&k(m,f-1),m=n,f++);void 0!==m&&k(m,f-1,!0)}return 0===f&&(h=d(this)),h})},a.exports=b.default},function(a,b,c){"use strict";var d=c(1).default;b.__esModule=!0;var e=c(6),f=d(e);b.default=function(a){a.registerHelper("helperMissing",function(){if(1!==arguments.length)throw new f.default('Missing helper: "'+arguments[arguments.length-1].name+'"')})},a.exports=b.default},function(a,b,c){"use strict";b.__esModule=!0;var d=c(5);b.default=function(a){a.registerHelper("if",function(a,b){return d.isFunction(a)&&(a=a.call(this)),!b.hash.includeZero&&!a||d.isEmpty(a)?b.inverse(this):b.fn(this)}),a.registerHelper("unless",function(b,c){return a.helpers.if.call(this,b,{fn:c.inverse,inverse:c.fn,hash:c.hash})})},a.exports=b.default},function(a,b){"use strict";b.__esModule=!0,b.default=function(a){a.registerHelper("log",function(){for(var b=[void 0],c=arguments[arguments.length-1],d=0;d<arguments.length-1;d++)b.push(arguments[d]);var e=1;null!=c.hash.level?e=c.hash.level:c.data&&null!=c.data.level&&(e=c.data.level),b[0]=e,a.log.apply(a,b)})},a.exports=b.default},function(a,b){"use strict";b.__esModule=!0,b.default=function(a){a.registerHelper("lookup",function(a,b){return a&&a[b]})},a.exports=b.default},function(a,b,c){"use strict";b.__esModule=!0;var d=c(5);b.default=function(a){a.registerHelper("with",function(a,b){d.isFunction(a)&&(a=a.call(this));var c=b.fn;if(d.isEmpty(a))return b.inverse(this);var e=b.data;return b.data&&b.ids&&(e=d.createFrame(b.data),e.contextPath=d.appendContextPath(b.data.contextPath,b.ids[0])),c(a,{data:e,blockParams:d.blockParams([a],[e&&e.contextPath])})})},a.exports=b.default},function(a,b,c){"use strict";function g(a){f.default(a)}var d=c(1).default;b.__esModule=!0,b.registerDefaultDecorators=g;var e=c(16),f=d(e)},function(a,b,c){"use strict";b.__esModule=!0;var d=c(5);b.default=function(a){a.registerDecorator("inline",function(a,b,c,e){var f=a;return b.partials||(b.partials={},f=function(e,f){var g=c.partials;c.partials=d.extend({},g,b.partials);var h=a(e,f);return c.partials=g,h}),b.partials[e.args[0]]=e.fn,f})},a.exports=b.default},function(a,b,c){"use strict";b.__esModule=!0;var d=c(5),e={methodMap:["debug","info","warn","error"],level:"info",lookupLevel:function(b){if("string"==typeof b){var c=d.indexOf(e.methodMap,b.toLowerCase());b=c>=0?c:parseInt(b,10)}return b},log:function(b){if(b=e.lookupLevel(b),"undefined"!=typeof console&&e.lookupLevel(e.level)<=b){var c=e.methodMap[b];console[c]||(c="log");for(var d=arguments.length,f=Array(d>1?d-1:0),g=1;g<d;g++)f[g-1]=arguments[g];console[c].apply(console,f)}}};b.default=e,a.exports=b.default},function(a,b){"use strict";function c(a){this.string=a}b.__esModule=!0,c.prototype.toString=c.prototype.toHTML=function(){return""+this.string},b.default=c,a.exports=b.default},function(a,b,c){"use strict";function k(a){var b=a&&a[0]||1,c=j.COMPILER_REVISION;if(b!==c){if(b<c){var d=j.REVISION_CHANGES[c],e=j.REVISION_CHANGES[b];throw new i.default("Template was precompiled with an older version of Handlebars than the current runtime. Please update your precompiler to a newer version ("+d+") or downgrade your runtime to an older version ("+e+").")}throw new i.default("Template was precompiled with a newer version of Handlebars than the current runtime. Please update your runtime to a newer version ("+a[1]+").")}}function l(a,b){function c(c,d,e){e.hash&&(d=g.extend({},d,e.hash),e.ids&&(e.ids[0]=!0)),c=b.VM.resolvePartial.call(this,c,d,e);var f=b.VM.invokePartial.call(this,c,d,e);if(null==f&&b.compile&&(e.partials[e.name]=b.compile(c,a.compilerOptions,b),f=e.partials[e.name](d,e)),null!=f){if(e.indent){for(var h=f.split("\n"),j=0,k=h.length;j<k&&(h[j]||j+1!==k);j++)h[j]=e.indent+h[j];f=h.join("\n")}return f}throw new i.default("The partial "+e.name+" could not be compiled when running in runtime-only mode")}function e(b){function i(b){return""+a.main(d,b,d.helpers,d.partials,f,h,g)}var c=arguments.length<=1||void 0===arguments[1]?{}:arguments[1],f=c.data;e._setup(c),!c.partial&&a.useData&&(f=q(b,f));var g=void 0,h=a.useBlockParams?[]:void 0;return a.useDepths&&(g=c.depths?b!==c.depths[0]?[b].concat(c.depths):c.depths:[b]),(i=r(a.main,i,d,c.depths||[],f,h))(b,c)}if(!b)throw new i.default("No environment passed to template");if(!a||!a.main)throw new i.default("Unknown template object: "+typeof a);a.main.decorator=a.main_d,b.VM.checkRevision(a.compiler);var d={strict:function(b,c){if(!(c in b))throw new i.default('"'+c+'" not defined in '+b);return b[c]},lookup:function(b,c){for(var d=b.length,e=0;e<d;e++)if(b[e]&&null!=b[e][c])return b[e][c]},lambda:function(b,c){return"function"==typeof b?b.call(c):b},escapeExpression:g.escapeExpression,invokePartial:c,fn:function(c){var d=a[c];return d.decorator=a[c+"_d"],d},programs:[],program:function(b,c,d,e,f){var g=this.programs[b],h=this.fn(b);return c||f||e||d?g=m(this,b,h,c,d,e,f):g||(g=this.programs[b]=m(this,b,h)),g},data:function(b,c){for(;b&&c--;)b=b._parent;return b},merge:function(b,c){var d=b||c;return b&&c&&b!==c&&(d=g.extend({},c,b)),d},noop:b.VM.noop,compilerInfo:a.compiler};return e.isTop=!0,e._setup=function(c){c.partial?(d.helpers=c.helpers,d.partials=c.partials,d.decorators=c.decorators):(d.helpers=d.merge(c.helpers,b.helpers),a.usePartial&&(d.partials=d.merge(c.partials,b.partials)),(a.usePartial||a.useDecorators)&&(d.decorators=d.merge(c.decorators,b.decorators)))},e._child=function(b,c,e,f){if(a.useBlockParams&&!e)throw new i.default("must pass block params");if(a.useDepths&&!f)throw new i.default("must pass parent depths");return m(d,b,a[b],c,0,e,f)},e}function m(a,b,c,d,e,f,g){function h(b){var e=arguments.length<=1||void 0===arguments[1]?{}:arguments[1],h=g;return g&&b!==g[0]&&(h=[b].concat(g)),c(a,b,a.helpers,a.partials,e.data||d,f&&[e.blockParams].concat(f),h)}return h=r(c,h,a,g,d,f),h.program=b,h.depth=g?g.length:0,h.blockParams=e||0,h}function n(a,b,c){return a?a.call||c.name||(c.name=a,a=c.partials[a]):a="@partial-block"===c.name?c.data["partial-block"]:c.partials[c.name],a}function o(a,b,c){c.partial=!0,c.ids&&(c.data.contextPath=c.ids[0]||c.data.contextPath);var d=void 0;if(c.fn&&c.fn!==p&&(c.data=j.createFrame(c.data),d=c.data["partial-block"]=c.fn,d.partials&&(c.partials=g.extend({},c.partials,d.partials))),void 0===a&&d&&(a=d),void 0===a)throw new i.default("The partial "+c.name+" could not be found");if(a instanceof Function)return a(b,c)}function p(){return""}function q(a,b){return b&&"root"in b||(b=b?j.createFrame(b):{},b.root=a),b}function r(a,b,c,d,e,f){if(a.decorator){var h={};b=a.decorator(b,h,c,d&&d[0],e,f,d),g.extend(b,h)}return b}var d=c(3).default,e=c(1).default;b.__esModule=!0,b.checkRevision=k,b.template=l,b.wrapProgram=m,b.resolvePartial=n,b.invokePartial=o,b.noop=p;var f=c(5),g=d(f),h=c(6),i=e(h),j=c(4)},function(a,b){(function(c){"use strict";b.__esModule=!0,b.default=function(a){var b="undefined"!=typeof c?c:window,d=b.Handlebars;a.noConflict=function(){return b.Handlebars===a&&(b.Handlebars=d),a}},a.exports=b.default}).call(b,function(){return this}())},function(a,b){"use strict";b.__esModule=!0;var c={helpers:{helperExpression:function(b){return"SubExpression"===b.type||("MustacheStatement"===b.type||"BlockStatement"===b.type)&&!!(b.params&&b.params.length||b.hash)},scopedId:function(b){return/^\.|this\b/.test(b.original)},simpleId:function(b){return 1===b.parts.length&&!c.helpers.scopedId(b)&&!b.depth}}};b.default=c,a.exports=b.default},function(a,b,c){"use strict";function n(a,b){if("Program"===a.type)return a;g.default.yy=m,m.locInfo=function(a){return new m.SourceLocation(b&&b.srcName,a)};var c=new i.default(b);return c.accept(g.default.parse(a))}var d=c(1).default,e=c(3).default;b.__esModule=!0,b.parse=n;var f=c(23),g=d(f),h=c(24),i=d(h),j=c(26),k=e(j),l=c(5);b.parser=g.default;var m={};l.extend(m,k)},function(a,b){"use strict";var c=function(){function c(){this.yy={}}var a={trace:function(){},yy:{},symbols_:{error:2,root:3,program:4,EOF:5,program_repetition0:6,statement:7,mustache:8,block:9,rawBlock:10,partial:11,partialBlock:12,content:13,COMMENT:14,CONTENT:15,openRawBlock:16,rawBlock_repetition_plus0:17,END_RAW_BLOCK:18,OPEN_RAW_BLOCK:19,helperName:20,openRawBlock_repetition0:21,openRawBlock_option0:22,CLOSE_RAW_BLOCK:23,openBlock:24,block_option0:25,closeBlock:26,openInverse:27,block_option1:28,OPEN_BLOCK:29,openBlock_repetition0:30,openBlock_option0:31,openBlock_option1:32,CLOSE:33,OPEN_INVERSE:34,openInverse_repetition0:35,openInverse_option0:36,openInverse_option1:37,openInverseChain:38,OPEN_INVERSE_CHAIN:39,openInverseChain_repetition0:40,openInverseChain_option0:41,openInverseChain_option1:42,inverseAndProgram:43,INVERSE:44,inverseChain:45,inverseChain_option0:46,OPEN_ENDBLOCK:47,OPEN:48,mustache_repetition0:49,mustache_option0:50,OPEN_UNESCAPED:51,mustache_repetition1:52,mustache_option1:53,CLOSE_UNESCAPED:54,OPEN_PARTIAL:55,partialName:56,partial_repetition0:57,partial_option0:58,openPartialBlock:59,OPEN_PARTIAL_BLOCK:60,openPartialBlock_repetition0:61,openPartialBlock_option0:62,param:63,sexpr:64,OPEN_SEXPR:65,sexpr_repetition0:66,sexpr_option0:67,CLOSE_SEXPR:68,hash:69,hash_repetition_plus0:70,hashSegment:71,ID:72,EQUALS:73,blockParams:74,OPEN_BLOCK_PARAMS:75,blockParams_repetition_plus0:76,CLOSE_BLOCK_PARAMS:77,path:78,dataName:79,STRING:80,NUMBER:81,BOOLEAN:82,UNDEFINED:83,NULL:84,DATA:85,pathSegments:86,SEP:87,$accept:0,$end:1},terminals_:{2:"error",5:"EOF",14:"COMMENT",15:"CONTENT",18:"END_RAW_BLOCK",19:"OPEN_RAW_BLOCK",23:"CLOSE_RAW_BLOCK",29:"OPEN_BLOCK",33:"CLOSE",34:"OPEN_INVERSE",39:"OPEN_INVERSE_CHAIN",44:"INVERSE",47:"OPEN_ENDBLOCK",48:"OPEN",51:"OPEN_UNESCAPED",54:"CLOSE_UNESCAPED",55:"OPEN_PARTIAL",60:"OPEN_PARTIAL_BLOCK",65:"OPEN_SEXPR",68:"CLOSE_SEXPR",72:"ID",73:"EQUALS",75:"OPEN_BLOCK_PARAMS",77:"CLOSE_BLOCK_PARAMS",80:"STRING",81:"NUMBER",82:"BOOLEAN",83:"UNDEFINED",84:"NULL",85:"DATA",87:"SEP"},productions_:[0,[3,2],[4,1],[7,1],[7,1],[7,1],[7,1],[7,1],[7,1],[7,1],[13,1],[10,3],[16,5],[9,4],[9,4],[24,6],[27,6],[38,6],[43,2],[45,3],[45,1],[26,3],[8,5],[8,5],[11,5],[12,3],[59,5],[63,1],[63,1],[64,5],[69,1],[71,3],[74,3],[20,1],[20,1],[20,1],[20,1],[20,1],[20,1],[20,1],[56,1],[56,1],[79,2],[78,1],[86,3],[86,1],[6,0],[6,2],[17,1],[17,2],[21,0],[21,2],[22,0],[22,1],[25,0],[25,1],[28,0],[28,1],[30,0],[30,2],[31,0],[31,1],[32,0],[32,1],[35,0],[35,2],[36,0],[36,1],[37,0],[37,1],[40,0],[40,2],[41,0],[41,1],[42,0],[42,1],[46,0],[46,1],[49,0],[49,2],[50,0],[50,1],[52,0],[52,2],[53,0],[53,1],[57,0],[57,2],[58,0],[58,1],[61,0],[61,2],[62,0],[62,1],[66,0],[66,2],[67,0],[67,1],[70,1],[70,2],[76,1],[76,2]],performAction:function(b,c,d,e,f,g,h){var i=g.length-1;switch(f){case 1:return g[i-1];case 2:this.$=e.prepareProgram(g[i]);break;case 3:this.$=g[i];break;case 4:this.$=g[i];break;case 5:this.$=g[i];break;case 6:this.$=g[i];break;case 7:this.$=g[i];break;case 8:this.$=g[i];break;case 9:this.$={type:"CommentStatement",value:e.stripComment(g[i]),strip:e.stripFlags(g[i],g[i]),loc:e.locInfo(this._$)};break;case 10:this.$={type:"ContentStatement",original:g[i],value:g[i],loc:e.locInfo(this._$)};break;case 11:this.$=e.prepareRawBlock(g[i-2],g[i-1],g[i],this._$);break;case 12:this.$={path:g[i-3],params:g[i-2],hash:g[i-1]};break;case 13:this.$=e.prepareBlock(g[i-3],g[i-2],g[i-1],g[i],!1,this._$);break;case 14:this.$=e.prepareBlock(g[i-3],g[i-2],g[i-1],g[i],!0,this._$);break;case 15:this.$={open:g[i-5],path:g[i-4],params:g[i-3],hash:g[i-2],blockParams:g[i-1],strip:e.stripFlags(g[i-5],g[i])};break;case 16:this.$={path:g[i-4],params:g[i-3],hash:g[i-2],blockParams:g[i-1],strip:e.stripFlags(g[i-5],g[i])};break;case 17:this.$={path:g[i-4],params:g[i-3],hash:g[i-2],blockParams:g[i-1],strip:e.stripFlags(g[i-5],g[i])};break;case 18:this.$={strip:e.stripFlags(g[i-1],g[i-1]),program:g[i]};break;case 19:var j=e.prepareBlock(g[i-2],g[i-1],g[i],g[i],!1,this._$),k=e.prepareProgram([j],g[i-1].loc);k.chained=!0,this.$={strip:g[i-2].strip,program:k,chain:!0};break;case 20:this.$=g[i];break;case 21:this.$={path:g[i-1],strip:e.stripFlags(g[i-2],g[i])};break;case 22:this.$=e.prepareMustache(g[i-3],g[i-2],g[i-1],g[i-4],e.stripFlags(g[i-4],g[i]),this._$);break;case 23:this.$=e.prepareMustache(g[i-3],g[i-2],g[i-1],g[i-4],e.stripFlags(g[i-4],g[i]),this._$);break;case 24:this.$={type:"PartialStatement",name:g[i-3],params:g[i-2],hash:g[i-1],indent:"",strip:e.stripFlags(g[i-4],g[i]),loc:e.locInfo(this._$)};break;case 25:this.$=e.preparePartialBlock(g[i-2],g[i-1],g[i],this._$);break;case 26:this.$={path:g[i-3],params:g[i-2],hash:g[i-1],strip:e.stripFlags(g[i-4],g[i])};break;case 27:this.$=g[i];break;case 28:this.$=g[i];break;case 29:this.$={type:"SubExpression",path:g[i-3],params:g[i-2],hash:g[i-1],loc:e.locInfo(this._$)};break;case 30:this.$={type:"Hash",pairs:g[i],loc:e.locInfo(this._$)};break;case 31:this.$={type:"HashPair",key:e.id(g[i-2]),value:g[i],loc:e.locInfo(this._$)};break;case 32:this.$=e.id(g[i-1]);break;case 33:this.$=g[i];break;case 34:this.$=g[i];break;case 35:this.$={type:"StringLiteral",value:g[i],original:g[i],loc:e.locInfo(this._$)};break;case 36:this.$={type:"NumberLiteral",value:Number(g[i]),original:Number(g[i]),loc:e.locInfo(this._$)};break;case 37:this.$={type:"BooleanLiteral",value:"true"===g[i],original:"true"===g[i],loc:e.locInfo(this._$)};break;case 38:this.$={type:"UndefinedLiteral",original:void 0,value:void 0,loc:e.locInfo(this._$)};break;case 39:this.$={type:"NullLiteral",original:null,value:null,loc:e.locInfo(this._$)};break;case 40:this.$=g[i];break;case 41:this.$=g[i];break;case 42:this.$=e.preparePath(!0,g[i],this._$);break;case 43:this.$=e.preparePath(!1,g[i],this._$);break;case 44:g[i-2].push({part:e.id(g[i]),original:g[i],separator:g[i-1]}),this.$=g[i-2];break;case 45:this.$=[{part:e.id(g[i]),original:g[i]}];break;case 46:this.$=[];break;case 47:g[i-1].push(g[i]);break;case 48:this.$=[g[i]];break;case 49:g[i-1].push(g[i]);break;case 50:this.$=[];break;case 51:g[i-1].push(g[i]);break;case 58:this.$=[];break;case 59:g[i-1].push(g[i]);break;case 64:this.$=[];break;case 65:g[i-1].push(g[i]);break;case 70:this.$=[];break;case 71:g[i-1].push(g[i]);break;case 78:this.$=[];break;case 79:g[i-1].push(g[i]);break;case 82:this.$=[];break;case 83:g[i-1].push(g[i]);break;case 86:this.$=[];break;case 87:g[i-1].push(g[i]);break;case 90:this.$=[];break;case 91:g[i-1].push(g[i]);break;case 94:this.$=[];break;case 95:g[i-1].push(g[i]);break;case 98:this.$=[g[i]];break;case 99:g[i-1].push(g[i]);break;case 100:this.$=[g[i]];break;case 101:g[i-1].push(g[i])}},table:[{3:1,4:2,5:[2,46],6:3,14:[2,46],15:[2,46],19:[2,46],29:[2,46],34:[2,46],48:[2,46],51:[2,46],55:[2,46],60:[2,46]},{1:[3]},{5:[1,4]},{5:[2,2],7:5,8:6,9:7,10:8,11:9,12:10,13:11,14:[1,12],15:[1,20],16:17,19:[1,23],24:15,27:16,29:[1,21],34:[1,22],39:[2,2],44:[2,2],47:[2,2],48:[1,13],51:[1,14],55:[1,18],59:19,60:[1,24]},{1:[2,1]},{5:[2,47],14:[2,47],15:[2,47],19:[2,47],29:[2,47],34:[2,47],39:[2,47],44:[2,47],47:[2,47],48:[2,47],51:[2,47],55:[2,47],60:[2,47]},{5:[2,3],14:[2,3],15:[2,3],19:[2,3],29:[2,3],34:[2,3],39:[2,3],44:[2,3],47:[2,3],48:[2,3],51:[2,3],55:[2,3],60:[2,3]},{5:[2,4],14:[2,4],15:[2,4],19:[2,4],29:[2,4],34:[2,4],39:[2,4],44:[2,4],47:[2,4],48:[2,4],51:[2,4],55:[2,4],60:[2,4]},{5:[2,5],14:[2,5],15:[2,5],19:[2,5],29:[2,5],34:[2,5],39:[2,5],44:[2,5],47:[2,5],48:[2,5],51:[2,5],55:[2,5],60:[2,5]},{5:[2,6],14:[2,6],15:[2,6],19:[2,6],29:[2,6],34:[2,6],39:[2,6],44:[2,6],47:[2,6],48:[2,6],51:[2,6],55:[2,6],60:[2,6]},{5:[2,7],14:[2,7],15:[2,7],19:[2,7],29:[2,7],34:[2,7],39:[2,7],44:[2,7],47:[2,7],48:[2,7],51:[2,7],55:[2,7],60:[2,7]},{5:[2,8],14:[2,8],15:[2,8],19:[2,8],29:[2,8],34:[2,8],39:[2,8],44:[2,8],47:[2,8],48:[2,8],51:[2,8],55:[2,8],60:[2,8]},{5:[2,9],14:[2,9],15:[2,9],19:[2,9],29:[2,9],34:[2,9],39:[2,9],44:[2,9],47:[2,9],48:[2,9],51:[2,9],55:[2,9],60:[2,9]},{20:25,72:[1,35],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{20:36,72:[1,35],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{4:37,6:3,14:[2,46],15:[2,46],19:[2,46],29:[2,46],34:[2,46],39:[2,46],44:[2,46],47:[2,46],48:[2,46],51:[2,46],55:[2,46],60:[2,46]},{4:38,6:3,14:[2,46],15:[2,46],19:[2,46],29:[2,46],34:[2,46],44:[2,46],47:[2,46],48:[2,46],51:[2,46],55:[2,46],60:[2,46]},{13:40,15:[1,20],17:39},{20:42,56:41,64:43,65:[1,44],72:[1,35],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{4:45,6:3,14:[2,46],15:[2,46],19:[2,46],29:[2,46],34:[2,46],47:[2,46],48:[2,46],51:[2,46],55:[2,46],60:[2,46]},{5:[2,10],14:[2,10],15:[2,10],18:[2,10],19:[2,10],29:[2,10],34:[2,10],39:[2,10],44:[2,10],47:[2,10],48:[2,10],51:[2,10],55:[2,10],60:[2,10]},{20:46,72:[1,35],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{20:47,72:[1,35],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{20:48,72:[1,35],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{20:42,56:49,64:43,65:[1,44],72:[1,35],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{33:[2,78],49:50,65:[2,78],72:[2,78],80:[2,78],81:[2,78],82:[2,78],83:[2,78],84:[2,78],85:[2,78]},{23:[2,33],33:[2,33],54:[2,33],65:[2,33],68:[2,33],72:[2,33],75:[2,33],80:[2,33],81:[2,33],82:[2,33],83:[2,33],84:[2,33],85:[2,33]},{23:[2,34],33:[2,34],54:[2,34],65:[2,34],68:[2,34],72:[2,34],75:[2,34],80:[2,34],81:[2,34],82:[2,34],83:[2,34],84:[2,34],85:[2,34]},{23:[2,35],33:[2,35],54:[2,35],65:[2,35],68:[2,35],72:[2,35],75:[2,35],80:[2,35],81:[2,35],82:[2,35],83:[2,35],84:[2,35],85:[2,35]},{23:[2,36],33:[2,36],54:[2,36],65:[2,36],68:[2,36],72:[2,36],75:[2,36],80:[2,36],81:[2,36],82:[2,36],83:[2,36],84:[2,36],85:[2,36]},{23:[2,37],33:[2,37],54:[2,37],65:[2,37],68:[2,37],72:[2,37],75:[2,37],80:[2,37],81:[2,37],82:[2,37],83:[2,37],84:[2,37],85:[2,37]},{23:[2,38],33:[2,38],54:[2,38],65:[2,38],68:[2,38],72:[2,38],75:[2,38],80:[2,38],81:[2,38],82:[2,38],83:[2,38],84:[2,38],85:[2,38]},{23:[2,39],33:[2,39],54:[2,39],65:[2,39],68:[2,39],72:[2,39],75:[2,39],80:[2,39],81:[2,39],82:[2,39],83:[2,39],84:[2,39],85:[2,39]},{23:[2,43],33:[2,43],54:[2,43],65:[2,43],68:[2,43],72:[2,43],75:[2,43],80:[2,43],81:[2,43],82:[2,43],83:[2,43],84:[2,43],85:[2,43],87:[1,51]},{72:[1,35],86:52},{23:[2,45],33:[2,45],54:[2,45],65:[2,45],68:[2,45],72:[2,45],75:[2,45],80:[2,45],81:[2,45],82:[2,45],83:[2,45],84:[2,45],85:[2,45],87:[2,45]},{52:53,54:[2,82],65:[2,82],72:[2,82],80:[2,82],81:[2,82],82:[2,82],83:[2,82],84:[2,82],85:[2,82]},{25:54,38:56,39:[1,58],43:57,44:[1,59],45:55,47:[2,54]},{28:60,43:61,44:[1,59],47:[2,56]},{13:63,15:[1,20],18:[1,62]},{15:[2,48],18:[2,48]},{33:[2,86],57:64,65:[2,86],72:[2,86],80:[2,86],81:[2,86],82:[2,86],83:[2,86],84:[2,86],85:[2,86]},{33:[2,40],65:[2,40],72:[2,40],80:[2,40],81:[2,40],82:[2,40],83:[2,40],84:[2,40],85:[2,40]},{33:[2,41],65:[2,41],72:[2,41],80:[2,41],81:[2,41],82:[2,41],83:[2,41],84:[2,41],85:[2,41]},{20:65,72:[1,35],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{26:66,47:[1,67]},{30:68,33:[2,58],65:[2,58],72:[2,58],75:[2,58],80:[2,58],81:[2,58],82:[2,58],83:[2,58],84:[2,58],85:[2,58]},{33:[2,64],35:69,65:[2,64],72:[2,64],75:[2,64],80:[2,64],81:[2,64],82:[2,64],83:[2,64],84:[2,64],85:[2,64]},{21:70,23:[2,50],65:[2,50],72:[2,50],80:[2,50],81:[2,50],82:[2,50],83:[2,50],84:[2,50],85:[2,50]},{33:[2,90],61:71,65:[2,90],72:[2,90],80:[2,90],81:[2,90],82:[2,90],83:[2,90],84:[2,90],85:[2,90]},{20:75,33:[2,80],50:72,63:73,64:76,65:[1,44],69:74,70:77,71:78,72:[1,79],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{72:[1,80]},{23:[2,42],33:[2,42],54:[2,42],65:[2,42],68:[2,42],72:[2,42],75:[2,42],80:[2,42],81:[2,42],82:[2,42],83:[2,42],84:[2,42],85:[2,42],87:[1,51]},{20:75,53:81,54:[2,84],63:82,64:76,65:[1,44],69:83,70:77,71:78,72:[1,79],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{26:84,47:[1,67]},{47:[2,55]},{4:85,6:3,14:[2,46],15:[2,46],19:[2,46],29:[2,46],34:[2,46],39:[2,46],44:[2,46],47:[2,46],48:[2,46],51:[2,46],55:[2,46],60:[2,46]},{47:[2,20]},{20:86,72:[1,35],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{4:87,6:3,14:[2,46],15:[2,46],19:[2,46],29:[2,46],34:[2,46],47:[2,46],48:[2,46],51:[2,46],55:[2,46],60:[2,46]},{26:88,47:[1,67]},{47:[2,57]},{5:[2,11],14:[2,11],15:[2,11],19:[2,11],29:[2,11],34:[2,11],39:[2,11],44:[2,11],47:[2,11],48:[2,11],51:[2,11],55:[2,11],60:[2,11]},{15:[2,49],18:[2,49]},{20:75,33:[2,88],58:89,63:90,64:76,65:[1,44],69:91,70:77,71:78,72:[1,79],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{65:[2,94],66:92,68:[2,94],72:[2,94],80:[2,94],81:[2,94],82:[2,94],83:[2,94],84:[2,94],85:[2,94]},{5:[2,25],14:[2,25],15:[2,25],19:[2,25],29:[2,25],34:[2,25],39:[2,25],44:[2,25],47:[2,25],48:[2,25],51:[2,25],55:[2,25],60:[2,25]},{20:93,72:[1,35],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{20:75,31:94,33:[2,60],63:95,64:76,65:[1,44],69:96,70:77,71:78,72:[1,79],75:[2,60],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{20:75,33:[2,66],36:97,63:98,64:76,65:[1,44],69:99,70:77,71:78,72:[1,79],75:[2,66],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{20:75,22:100,23:[2,52],63:101,64:76,65:[1,44],69:102,70:77,71:78,72:[1,79],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{20:75,33:[2,92],62:103,63:104,64:76,65:[1,44],69:105,70:77,71:78,72:[1,79],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{33:[1,106]},{33:[2,79],65:[2,79],72:[2,79],80:[2,79],81:[2,79],82:[2,79],83:[2,79],84:[2,79],85:[2,79]},{33:[2,81]},{23:[2,27],33:[2,27],54:[2,27],65:[2,27],68:[2,27],72:[2,27],75:[2,27],80:[2,27],81:[2,27],82:[2,27],83:[2,27],84:[2,27],85:[2,27]},{23:[2,28],33:[2,28],54:[2,28],65:[2,28],68:[2,28],72:[2,28],75:[2,28],80:[2,28],81:[2,28],82:[2,28],83:[2,28],84:[2,28],85:[2,28]},{23:[2,30],33:[2,30],54:[2,30],68:[2,30],71:107,72:[1,108],75:[2,30]},{23:[2,98],33:[2,98],54:[2,98],68:[2,98],72:[2,98],75:[2,98]},{23:[2,45],33:[2,45],54:[2,45],65:[2,45],68:[2,45],72:[2,45],73:[1,109],75:[2,45],80:[2,45],81:[2,45],82:[2,45],83:[2,45],84:[2,45],85:[2,45],87:[2,45]},{23:[2,44],33:[2,44],54:[2,44],65:[2,44],68:[2,44],72:[2,44],75:[2,44],80:[2,44],81:[2,44],82:[2,44],83:[2,44],84:[2,44],85:[2,44],87:[2,44]},{54:[1,110]},{54:[2,83],65:[2,83],72:[2,83],80:[2,83],81:[2,83],82:[2,83],83:[2,83],84:[2,83],85:[2,83]},{54:[2,85]},{5:[2,13],14:[2,13],15:[2,13],19:[2,13],29:[2,13],34:[2,13],39:[2,13],44:[2,13],47:[2,13],48:[2,13],51:[2,13],55:[2,13],60:[2,13]},{38:56,39:[1,58],43:57,44:[1,59],45:112,46:111,47:[2,76]},{33:[2,70],40:113,65:[2,70],72:[2,70],75:[2,70],80:[2,70],81:[2,70],82:[2,70],83:[2,70],84:[2,70],85:[2,70]},{47:[2,18]},{5:[2,14],14:[2,14],15:[2,14],19:[2,14],29:[2,14],34:[2,14],39:[2,14],44:[2,14],47:[2,14],48:[2,14],51:[2,14],55:[2,14],60:[2,14]},{33:[1,114]},{33:[2,87],65:[2,87],72:[2,87],80:[2,87],81:[2,87],82:[2,87],83:[2,87],84:[2,87],85:[2,87]},{33:[2,89]},{20:75,63:116,64:76,65:[1,44],67:115,68:[2,96],69:117,70:77,71:78,72:[1,79],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{33:[1,118]},{32:119,33:[2,62],74:120,75:[1,121]},{33:[2,59],65:[2,59],72:[2,59],75:[2,59],80:[2,59],81:[2,59],82:[2,59],83:[2,59],84:[2,59],85:[2,59]},{33:[2,61],75:[2,61]},{33:[2,68],37:122,74:123,75:[1,121]},{33:[2,65],65:[2,65],72:[2,65],75:[2,65],80:[2,65],81:[2,65],82:[2,65],83:[2,65],84:[2,65],85:[2,65]},{33:[2,67],75:[2,67]},{23:[1,124]},{23:[2,51],65:[2,51],72:[2,51],80:[2,51],81:[2,51],82:[2,51],83:[2,51],84:[2,51],85:[2,51]},{23:[2,53]},{33:[1,125]},{33:[2,91],65:[2,91],72:[2,91],80:[2,91],81:[2,91],82:[2,91],83:[2,91],84:[2,91],85:[2,91]},{33:[2,93]},{5:[2,22],14:[2,22],15:[2,22],19:[2,22],29:[2,22],34:[2,22],39:[2,22],44:[2,22],47:[2,22],48:[2,22],51:[2,22],55:[2,22],60:[2,22]},{23:[2,99],33:[2,99],54:[2,99],68:[2,99],72:[2,99],75:[2,99]},{73:[1,109]},{20:75,63:126,64:76,65:[1,44],72:[1,35],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{5:[2,23],14:[2,23],15:[2,23],19:[2,23],29:[2,23],34:[2,23],39:[2,23],44:[2,23],47:[2,23],48:[2,23],51:[2,23],55:[2,23],60:[2,23]},{47:[2,19]},{47:[2,77]},{20:75,33:[2,72],41:127,63:128,64:76,65:[1,44],69:129,70:77,71:78,72:[1,79],75:[2,72],78:26,79:27,80:[1,28],81:[1,29],82:[1,30],83:[1,31],84:[1,32],85:[1,34],86:33},{5:[2,24],14:[2,24],15:[2,24],19:[2,24],29:[2,24],34:[2,24],39:[2,24],44:[2,24],47:[2,24],48:[2,24],51:[2,24],55:[2,24],60:[2,24]},{68:[1,130]},{65:[2,95],68:[2,95],72:[2,95],80:[2,95],81:[2,95],82:[2,95],83:[2,95],84:[2,95],85:[2,95]},{68:[2,97]},{5:[2,21],14:[2,21],15:[2,21],19:[2,21],29:[2,21],34:[2,21],39:[2,21],44:[2,21],47:[2,21],48:[2,21],51:[2,21],55:[2,21],60:[2,21]},{33:[1,131]},{33:[2,63]},{72:[1,133],76:132},{33:[1,134]},{33:[2,69]},{15:[2,12]},{14:[2,26],15:[2,26],19:[2,26],29:[2,26],34:[2,26],47:[2,26],48:[2,26],51:[2,26],55:[2,26],60:[2,26]},{23:[2,31],33:[2,31],54:[2,31],68:[2,31],72:[2,31],75:[2,31]},{33:[2,74],42:135,74:136,75:[1,121]},{33:[2,71],65:[2,71],72:[2,71],75:[2,71],80:[2,71],81:[2,71],82:[2,71],83:[2,71],84:[2,71],85:[2,71]},{33:[2,73],75:[2,73]},{23:[2,29],33:[2,29],54:[2,29],65:[2,29],68:[2,29],72:[2,29],75:[2,29],80:[2,29],81:[2,29],82:[2,29],83:[2,29],84:[2,29],85:[2,29]},{14:[2,15],15:[2,15],19:[2,15],29:[2,15],34:[2,15],39:[2,15],44:[2,15],47:[2,15],48:[2,15],51:[2,15],55:[2,15],60:[2,15]},{72:[1,138],77:[1,137]},{72:[2,100],77:[2,100]},{14:[2,16],15:[2,16],19:[2,16],29:[2,16],34:[2,16],44:[2,16],47:[2,16],48:[2,16],51:[2,16],55:[2,16],60:[2,16]},{33:[1,139]},{33:[2,75]},{33:[2,32]},{72:[2,101],77:[2,101]},{14:[2,17],15:[2,17],19:[2,17],29:[2,17],34:[2,17],39:[2,17],44:[2,17],47:[2,17],48:[2,17],51:[2,17],55:[2,17],60:[2,17]}],defaultActions:{4:[2,1],55:[2,55],
	57:[2,20],61:[2,57],74:[2,81],83:[2,85],87:[2,18],91:[2,89],102:[2,53],105:[2,93],111:[2,19],112:[2,77],117:[2,97],120:[2,63],123:[2,69],124:[2,12],136:[2,75],137:[2,32]},parseError:function(b,c){throw new Error(b)},parse:function(b){function q(){var a;return a=c.lexer.lex()||1,"number"!=typeof a&&(a=c.symbols_[a]||a),a}var c=this,d=[0],e=[null],f=[],g=this.table,h="",i=0,j=0,k=0;this.lexer.setInput(b),this.lexer.yy=this.yy,this.yy.lexer=this.lexer,this.yy.parser=this,"undefined"==typeof this.lexer.yylloc&&(this.lexer.yylloc={});var n=this.lexer.yylloc;f.push(n);var o=this.lexer.options&&this.lexer.options.ranges;"function"==typeof this.yy.parseError&&(this.parseError=this.yy.parseError);for(var r,s,t,u,w,y,z,A,B,x={};;){if(t=d[d.length-1],this.defaultActions[t]?u=this.defaultActions[t]:(null!==r&&"undefined"!=typeof r||(r=q()),u=g[t]&&g[t][r]),"undefined"==typeof u||!u.length||!u[0]){var C="";if(!k){B=[];for(y in g[t])this.terminals_[y]&&y>2&&B.push("'"+this.terminals_[y]+"'");C=this.lexer.showPosition?"Parse error on line "+(i+1)+":\n"+this.lexer.showPosition()+"\nExpecting "+B.join(", ")+", got '"+(this.terminals_[r]||r)+"'":"Parse error on line "+(i+1)+": Unexpected "+(1==r?"end of input":"'"+(this.terminals_[r]||r)+"'"),this.parseError(C,{text:this.lexer.match,token:this.terminals_[r]||r,line:this.lexer.yylineno,loc:n,expected:B})}}if(u[0]instanceof Array&&u.length>1)throw new Error("Parse Error: multiple actions possible at state: "+t+", token: "+r);switch(u[0]){case 1:d.push(r),e.push(this.lexer.yytext),f.push(this.lexer.yylloc),d.push(u[1]),r=null,s?(r=s,s=null):(j=this.lexer.yyleng,h=this.lexer.yytext,i=this.lexer.yylineno,n=this.lexer.yylloc,k>0&&k--);break;case 2:if(z=this.productions_[u[1]][1],x.$=e[e.length-z],x._$={first_line:f[f.length-(z||1)].first_line,last_line:f[f.length-1].last_line,first_column:f[f.length-(z||1)].first_column,last_column:f[f.length-1].last_column},o&&(x._$.range=[f[f.length-(z||1)].range[0],f[f.length-1].range[1]]),w=this.performAction.call(x,h,j,i,this.yy,u[1],e,f),"undefined"!=typeof w)return w;z&&(d=d.slice(0,-1*z*2),e=e.slice(0,-1*z),f=f.slice(0,-1*z)),d.push(this.productions_[u[1]][0]),e.push(x.$),f.push(x._$),A=g[d[d.length-2]][d[d.length-1]],d.push(A);break;case 3:return!0}}return!0}},b=function(){var a={EOF:1,parseError:function(b,c){if(!this.yy.parser)throw new Error(b);this.yy.parser.parseError(b,c)},setInput:function(b){return this._input=b,this._more=this._less=this.done=!1,this.yylineno=this.yyleng=0,this.yytext=this.matched=this.match="",this.conditionStack=["INITIAL"],this.yylloc={first_line:1,first_column:0,last_line:1,last_column:0},this.options.ranges&&(this.yylloc.range=[0,0]),this.offset=0,this},input:function(){var b=this._input[0];this.yytext+=b,this.yyleng++,this.offset++,this.match+=b,this.matched+=b;var c=b.match(/(?:\r\n?|\n).*/g);return c?(this.yylineno++,this.yylloc.last_line++):this.yylloc.last_column++,this.options.ranges&&this.yylloc.range[1]++,this._input=this._input.slice(1),b},unput:function(b){var c=b.length,d=b.split(/(?:\r\n?|\n)/g);this._input=b+this._input,this.yytext=this.yytext.substr(0,this.yytext.length-c-1),this.offset-=c;var e=this.match.split(/(?:\r\n?|\n)/g);this.match=this.match.substr(0,this.match.length-1),this.matched=this.matched.substr(0,this.matched.length-1),d.length-1&&(this.yylineno-=d.length-1);var f=this.yylloc.range;return this.yylloc={first_line:this.yylloc.first_line,last_line:this.yylineno+1,first_column:this.yylloc.first_column,last_column:d?(d.length===e.length?this.yylloc.first_column:0)+e[e.length-d.length].length-d[0].length:this.yylloc.first_column-c},this.options.ranges&&(this.yylloc.range=[f[0],f[0]+this.yyleng-c]),this},more:function(){return this._more=!0,this},less:function(b){this.unput(this.match.slice(b))},pastInput:function(){var b=this.matched.substr(0,this.matched.length-this.match.length);return(b.length>20?"...":"")+b.substr(-20).replace(/\n/g,"")},upcomingInput:function(){var b=this.match;return b.length<20&&(b+=this._input.substr(0,20-b.length)),(b.substr(0,20)+(b.length>20?"...":"")).replace(/\n/g,"")},showPosition:function(){var b=this.pastInput(),c=new Array(b.length+1).join("-");return b+this.upcomingInput()+"\n"+c+"^"},next:function(){if(this.done)return this.EOF;this._input||(this.done=!0);var b,c,d,e,g;this._more||(this.yytext="",this.match="");for(var h=this._currentRules(),i=0;i<h.length&&(d=this._input.match(this.rules[h[i]]),!d||c&&!(d[0].length>c[0].length)||(c=d,e=i,this.options.flex));i++);return c?(g=c[0].match(/(?:\r\n?|\n).*/g),g&&(this.yylineno+=g.length),this.yylloc={first_line:this.yylloc.last_line,last_line:this.yylineno+1,first_column:this.yylloc.last_column,last_column:g?g[g.length-1].length-g[g.length-1].match(/\r?\n?/)[0].length:this.yylloc.last_column+c[0].length},this.yytext+=c[0],this.match+=c[0],this.matches=c,this.yyleng=this.yytext.length,this.options.ranges&&(this.yylloc.range=[this.offset,this.offset+=this.yyleng]),this._more=!1,this._input=this._input.slice(c[0].length),this.matched+=c[0],b=this.performAction.call(this,this.yy,this,h[e],this.conditionStack[this.conditionStack.length-1]),this.done&&this._input&&(this.done=!1),b?b:void 0):""===this._input?this.EOF:this.parseError("Lexical error on line "+(this.yylineno+1)+". Unrecognized text.\n"+this.showPosition(),{text:"",token:null,line:this.yylineno})},lex:function(){var b=this.next();return"undefined"!=typeof b?b:this.lex()},begin:function(b){this.conditionStack.push(b)},popState:function(){return this.conditionStack.pop()},_currentRules:function(){return this.conditions[this.conditionStack[this.conditionStack.length-1]].rules},topState:function(){return this.conditionStack[this.conditionStack.length-2]},pushState:function(b){this.begin(b)}};return a.options={},a.performAction=function(b,c,d,e){function f(a,b){return c.yytext=c.yytext.substr(a,c.yyleng-b)}switch(d){case 0:if("\\\\"===c.yytext.slice(-2)?(f(0,1),this.begin("mu")):"\\"===c.yytext.slice(-1)?(f(0,1),this.begin("emu")):this.begin("mu"),c.yytext)return 15;break;case 1:return 15;case 2:return this.popState(),15;case 3:return this.begin("raw"),15;case 4:return this.popState(),"raw"===this.conditionStack[this.conditionStack.length-1]?15:(c.yytext=c.yytext.substr(5,c.yyleng-9),"END_RAW_BLOCK");case 5:return 15;case 6:return this.popState(),14;case 7:return 65;case 8:return 68;case 9:return 19;case 10:return this.popState(),this.begin("raw"),23;case 11:return 55;case 12:return 60;case 13:return 29;case 14:return 47;case 15:return this.popState(),44;case 16:return this.popState(),44;case 17:return 34;case 18:return 39;case 19:return 51;case 20:return 48;case 21:this.unput(c.yytext),this.popState(),this.begin("com");break;case 22:return this.popState(),14;case 23:return 48;case 24:return 73;case 25:return 72;case 26:return 72;case 27:return 87;case 28:break;case 29:return this.popState(),54;case 30:return this.popState(),33;case 31:return c.yytext=f(1,2).replace(/\\"/g,'"'),80;case 32:return c.yytext=f(1,2).replace(/\\'/g,"'"),80;case 33:return 85;case 34:return 82;case 35:return 82;case 36:return 83;case 37:return 84;case 38:return 81;case 39:return 75;case 40:return 77;case 41:return 72;case 42:return c.yytext=c.yytext.replace(/\\([\\\]])/g,"$1"),72;case 43:return"INVALID";case 44:return 5}},a.rules=[/^(?:[^\x00]*?(?=(\{\{)))/,/^(?:[^\x00]+)/,/^(?:[^\x00]{2,}?(?=(\{\{|\\\{\{|\\\\\{\{|$)))/,/^(?:\{\{\{\{(?=[^\/]))/,/^(?:\{\{\{\{\/[^\s!"#%-,\.\/;->@\[-\^`\{-~]+(?=[=}\s\/.])\}\}\}\})/,/^(?:[^\x00]*?(?=(\{\{\{\{)))/,/^(?:[\s\S]*?--(~)?\}\})/,/^(?:\()/,/^(?:\))/,/^(?:\{\{\{\{)/,/^(?:\}\}\}\})/,/^(?:\{\{(~)?>)/,/^(?:\{\{(~)?#>)/,/^(?:\{\{(~)?#\*?)/,/^(?:\{\{(~)?\/)/,/^(?:\{\{(~)?\^\s*(~)?\}\})/,/^(?:\{\{(~)?\s*else\s*(~)?\}\})/,/^(?:\{\{(~)?\^)/,/^(?:\{\{(~)?\s*else\b)/,/^(?:\{\{(~)?\{)/,/^(?:\{\{(~)?&)/,/^(?:\{\{(~)?!--)/,/^(?:\{\{(~)?![\s\S]*?\}\})/,/^(?:\{\{(~)?\*?)/,/^(?:=)/,/^(?:\.\.)/,/^(?:\.(?=([=~}\s\/.)|])))/,/^(?:[\/.])/,/^(?:\s+)/,/^(?:\}(~)?\}\})/,/^(?:(~)?\}\})/,/^(?:"(\\["]|[^"])*")/,/^(?:'(\\[']|[^'])*')/,/^(?:@)/,/^(?:true(?=([~}\s)])))/,/^(?:false(?=([~}\s)])))/,/^(?:undefined(?=([~}\s)])))/,/^(?:null(?=([~}\s)])))/,/^(?:-?[0-9]+(?:\.[0-9]+)?(?=([~}\s)])))/,/^(?:as\s+\|)/,/^(?:\|)/,/^(?:([^\s!"#%-,\.\/;->@\[-\^`\{-~]+(?=([=~}\s\/.)|]))))/,/^(?:\[(\\\]|[^\]])*\])/,/^(?:.)/,/^(?:$)/],a.conditions={mu:{rules:[7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44],inclusive:!1},emu:{rules:[2],inclusive:!1},com:{rules:[6],inclusive:!1},raw:{rules:[3,4,5],inclusive:!1},INITIAL:{rules:[0,1,44],inclusive:!0}},a}();return a.lexer=b,c.prototype=a,a.Parser=c,new c}();b.__esModule=!0,b.default=c},function(a,b,c){"use strict";function g(){var a=arguments.length<=0||void 0===arguments[0]?{}:arguments[0];this.options=a}function h(a,b,c){void 0===b&&(b=a.length);var d=a[b-1],e=a[b-2];return d?"ContentStatement"===d.type?(e||!c?/\r?\n\s*?$/:/(^|\r?\n)\s*?$/).test(d.original):void 0:c}function i(a,b,c){void 0===b&&(b=-1);var d=a[b+1],e=a[b+2];return d?"ContentStatement"===d.type?(e||!c?/^\s*?\r?\n/:/^\s*?(\r?\n|$)/).test(d.original):void 0:c}function j(a,b,c){var d=a[null==b?0:b+1];if(d&&"ContentStatement"===d.type&&(c||!d.rightStripped)){var e=d.value;d.value=d.value.replace(c?/^\s+/:/^[ \t]*\r?\n?/,""),d.rightStripped=d.value!==e}}function k(a,b,c){var d=a[null==b?a.length-1:b-1];if(d&&"ContentStatement"===d.type&&(c||!d.leftStripped)){var e=d.value;return d.value=d.value.replace(c?/\s+$/:/[ \t]+$/,""),d.leftStripped=d.value!==e,d.leftStripped}}var d=c(1).default;b.__esModule=!0;var e=c(25),f=d(e);g.prototype=new f.default,g.prototype.Program=function(a){var b=!this.options.ignoreStandalone,c=!this.isRootSeen;this.isRootSeen=!0;for(var d=a.body,e=0,f=d.length;e<f;e++){var g=d[e],l=this.accept(g);if(l){var m=h(d,e,c),n=i(d,e,c),o=l.openStandalone&&m,p=l.closeStandalone&&n,q=l.inlineStandalone&&m&&n;l.close&&j(d,e,!0),l.open&&k(d,e,!0),b&&q&&(j(d,e),k(d,e)&&"PartialStatement"===g.type&&(g.indent=/([ \t]+$)/.exec(d[e-1].original)[1])),b&&o&&(j((g.program||g.inverse).body),k(d,e)),b&&p&&(j(d,e),k((g.inverse||g.program).body))}}return a},g.prototype.BlockStatement=g.prototype.DecoratorBlock=g.prototype.PartialBlockStatement=function(a){this.accept(a.program),this.accept(a.inverse);var b=a.program||a.inverse,c=a.program&&a.inverse,d=c,e=c;if(c&&c.chained)for(d=c.body[0].program;e.chained;)e=e.body[e.body.length-1].program;var f={open:a.openStrip.open,close:a.closeStrip.close,openStandalone:i(b.body),closeStandalone:h((d||b).body)};if(a.openStrip.close&&j(b.body,null,!0),c){var g=a.inverseStrip;g.open&&k(b.body,null,!0),g.close&&j(d.body,null,!0),a.closeStrip.open&&k(e.body,null,!0),!this.options.ignoreStandalone&&h(b.body)&&i(d.body)&&(k(b.body),j(d.body))}else a.closeStrip.open&&k(b.body,null,!0);return f},g.prototype.Decorator=g.prototype.MustacheStatement=function(a){return a.strip},g.prototype.PartialStatement=g.prototype.CommentStatement=function(a){var b=a.strip||{};return{inlineStandalone:!0,open:b.open,close:b.close}},b.default=g,a.exports=b.default},function(a,b,c){"use strict";function g(){this.parents=[]}function h(a){this.acceptRequired(a,"path"),this.acceptArray(a.params),this.acceptKey(a,"hash")}function i(a){h.call(this,a),this.acceptKey(a,"program"),this.acceptKey(a,"inverse")}function j(a){this.acceptRequired(a,"name"),this.acceptArray(a.params),this.acceptKey(a,"hash")}var d=c(1).default;b.__esModule=!0;var e=c(6),f=d(e);g.prototype={constructor:g,mutating:!1,acceptKey:function(b,c){var d=this.accept(b[c]);if(this.mutating){if(d&&!g.prototype[d.type])throw new f.default('Unexpected node type "'+d.type+'" found when accepting '+c+" on "+b.type);b[c]=d}},acceptRequired:function(b,c){if(this.acceptKey(b,c),!b[c])throw new f.default(b.type+" requires "+c)},acceptArray:function(b){for(var c=0,d=b.length;c<d;c++)this.acceptKey(b,c),b[c]||(b.splice(c,1),c--,d--)},accept:function(b){if(b){if(!this[b.type])throw new f.default("Unknown type: "+b.type,b);this.current&&this.parents.unshift(this.current),this.current=b;var c=this[b.type](b);return this.current=this.parents.shift(),!this.mutating||c?c:c!==!1?b:void 0}},Program:function(b){this.acceptArray(b.body)},MustacheStatement:h,Decorator:h,BlockStatement:i,DecoratorBlock:i,PartialStatement:j,PartialBlockStatement:function(b){j.call(this,b),this.acceptKey(b,"program")},ContentStatement:function(){},CommentStatement:function(){},SubExpression:h,PathExpression:function(){},StringLiteral:function(){},NumberLiteral:function(){},BooleanLiteral:function(){},UndefinedLiteral:function(){},NullLiteral:function(){},Hash:function(b){this.acceptArray(b.pairs)},HashPair:function(b){this.acceptRequired(b,"value")}},b.default=g,a.exports=b.default},function(a,b,c){"use strict";function g(a,b){if(b=b.path?b.path.original:b,a.path.original!==b){var c={loc:a.path.loc};throw new f.default(a.path.original+" doesn't match "+b,c)}}function h(a,b){this.source=a,this.start={line:b.first_line,column:b.first_column},this.end={line:b.last_line,column:b.last_column}}function i(a){return/^\[.*\]$/.test(a)?a.substr(1,a.length-2):a}function j(a,b){return{open:"~"===a.charAt(2),close:"~"===b.charAt(b.length-3)}}function k(a){return a.replace(/^\{\{~?\!-?-?/,"").replace(/-?-?~?\}\}$/,"")}function l(a,b,c){c=this.locInfo(c);for(var d=a?"@":"",e=[],g=0,h="",i=0,j=b.length;i<j;i++){var k=b[i].part,l=b[i].original!==k;if(d+=(b[i].separator||"")+k,l||".."!==k&&"."!==k&&"this"!==k)e.push(k);else{if(e.length>0)throw new f.default("Invalid path: "+d,{loc:c});".."===k&&(g++,h+="../")}}return{type:"PathExpression",data:a,depth:g,parts:e,original:d,loc:c}}function m(a,b,c,d,e,f){var g=d.charAt(3)||d.charAt(2),h="{"!==g&&"&"!==g,i=/\*/.test(d);return{type:i?"Decorator":"MustacheStatement",path:a,params:b,hash:c,escaped:h,strip:e,loc:this.locInfo(f)}}function n(a,b,c,d){g(a,c),d=this.locInfo(d);var e={type:"Program",body:b,strip:{},loc:d};return{type:"BlockStatement",path:a.path,params:a.params,hash:a.hash,program:e,openStrip:{},inverseStrip:{},closeStrip:{},loc:d}}function o(a,b,c,d,e,h){d&&d.path&&g(a,d);var i=/\*/.test(a.open);b.blockParams=a.blockParams;var j=void 0,k=void 0;if(c){if(i)throw new f.default("Unexpected inverse block on decorator",c);c.chain&&(c.program.body[0].closeStrip=d.strip),k=c.strip,j=c.program}return e&&(e=j,j=b,b=e),{type:i?"DecoratorBlock":"BlockStatement",path:a.path,params:a.params,hash:a.hash,program:b,inverse:j,openStrip:a.strip,inverseStrip:k,closeStrip:d&&d.strip,loc:this.locInfo(h)}}function p(a,b){if(!b&&a.length){var c=a[0].loc,d=a[a.length-1].loc;c&&d&&(b={source:c.source,start:{line:c.start.line,column:c.start.column},end:{line:d.end.line,column:d.end.column}})}return{type:"Program",body:a,strip:{},loc:b}}function q(a,b,c,d){return g(a,c),{type:"PartialBlockStatement",name:a.path,params:a.params,hash:a.hash,program:b,openStrip:a.strip,closeStrip:c&&c.strip,loc:this.locInfo(d)}}var d=c(1).default;b.__esModule=!0,b.SourceLocation=h,b.id=i,b.stripFlags=j,b.stripComment=k,b.preparePath=l,b.prepareMustache=m,b.prepareRawBlock=n,b.prepareBlock=o,b.prepareProgram=p,b.preparePartialBlock=q;var e=c(6),f=d(e)},function(a,b,c){"use strict";function k(){}function l(a,b,c){if(null==a||"string"!=typeof a&&"Program"!==a.type)throw new f.default("You must pass a string or Handlebars AST to Handlebars.precompile. You passed "+a);b=b||{},"data"in b||(b.data=!0),b.compat&&(b.useDepths=!0);var d=c.parse(a,b),e=(new c.Compiler).compile(d,b);return(new c.JavaScriptCompiler).compile(e,b)}function m(a,b,c){function e(){var d=c.parse(a,b),e=(new c.Compiler).compile(d,b),f=(new c.JavaScriptCompiler).compile(e,b,void 0,!0);return c.template(f)}function g(a,b){return d||(d=e()),d.call(this,a,b)}if(void 0===b&&(b={}),null==a||"string"!=typeof a&&"Program"!==a.type)throw new f.default("You must pass a string or Handlebars AST to Handlebars.compile. You passed "+a);"data"in b||(b.data=!0),b.compat&&(b.useDepths=!0);var d=void 0;return g._setup=function(a){return d||(d=e()),d._setup(a)},g._child=function(a,b,c,f){return d||(d=e()),d._child(a,b,c,f)},g}function n(a,b){if(a===b)return!0;if(g.isArray(a)&&g.isArray(b)&&a.length===b.length){for(var c=0;c<a.length;c++)if(!n(a[c],b[c]))return!1;return!0}}function o(a){if(!a.path.parts){var b=a.path;a.path={type:"PathExpression",data:!1,depth:0,parts:[b.original+""],original:b.original+"",loc:b.loc}}}var d=c(1).default;b.__esModule=!0,b.Compiler=k,b.precompile=l,b.compile=m;var e=c(6),f=d(e),g=c(5),h=c(21),i=d(h),j=[].slice;k.prototype={compiler:k,equals:function(b){var c=this.opcodes.length;if(b.opcodes.length!==c)return!1;for(var d=0;d<c;d++){var e=this.opcodes[d],f=b.opcodes[d];if(e.opcode!==f.opcode||!n(e.args,f.args))return!1}c=this.children.length;for(var d=0;d<c;d++)if(!this.children[d].equals(b.children[d]))return!1;return!0},guid:0,compile:function(b,c){this.sourceNode=[],this.opcodes=[],this.children=[],this.options=c,this.stringParams=c.stringParams,this.trackIds=c.trackIds,c.blockParams=c.blockParams||[];var d=c.knownHelpers;if(c.knownHelpers={helperMissing:!0,blockHelperMissing:!0,each:!0,if:!0,unless:!0,with:!0,log:!0,lookup:!0},d)for(var e in d)e in d&&(c.knownHelpers[e]=d[e]);return this.accept(b)},compileProgram:function(b){var c=new this.compiler,d=c.compile(b,this.options),e=this.guid++;return this.usePartial=this.usePartial||d.usePartial,this.children[e]=d,this.useDepths=this.useDepths||d.useDepths,e},accept:function(b){if(!this[b.type])throw new f.default("Unknown type: "+b.type,b);this.sourceNode.unshift(b);var c=this[b.type](b);return this.sourceNode.shift(),c},Program:function(b){this.options.blockParams.unshift(b.blockParams);for(var c=b.body,d=c.length,e=0;e<d;e++)this.accept(c[e]);return this.options.blockParams.shift(),this.isSimple=1===d,this.blockParams=b.blockParams?b.blockParams.length:0,this},BlockStatement:function(b){o(b);var c=b.program,d=b.inverse;c=c&&this.compileProgram(c),d=d&&this.compileProgram(d);var e=this.classifySexpr(b);"helper"===e?this.helperSexpr(b,c,d):"simple"===e?(this.simpleSexpr(b),this.opcode("pushProgram",c),this.opcode("pushProgram",d),this.opcode("emptyHash"),this.opcode("blockValue",b.path.original)):(this.ambiguousSexpr(b,c,d),this.opcode("pushProgram",c),this.opcode("pushProgram",d),this.opcode("emptyHash"),this.opcode("ambiguousBlockValue")),this.opcode("append")},DecoratorBlock:function(b){var c=b.program&&this.compileProgram(b.program),d=this.setupFullMustacheParams(b,c,void 0),e=b.path;this.useDecorators=!0,this.opcode("registerDecorator",d.length,e.original)},PartialStatement:function(b){this.usePartial=!0;var c=b.program;c&&(c=this.compileProgram(b.program));var d=b.params;if(d.length>1)throw new f.default("Unsupported number of partial arguments: "+d.length,b);d.length||(this.options.explicitPartialContext?this.opcode("pushLiteral","undefined"):d.push({type:"PathExpression",parts:[],depth:0}));var e=b.name.original,g="SubExpression"===b.name.type;g&&this.accept(b.name),this.setupFullMustacheParams(b,c,void 0,!0);var h=b.indent||"";this.options.preventIndent&&h&&(this.opcode("appendContent",h),h=""),this.opcode("invokePartial",g,e,h),this.opcode("append")},PartialBlockStatement:function(b){this.PartialStatement(b)},MustacheStatement:function(b){this.SubExpression(b),b.escaped&&!this.options.noEscape?this.opcode("appendEscaped"):this.opcode("append")},Decorator:function(b){this.DecoratorBlock(b)},ContentStatement:function(b){b.value&&this.opcode("appendContent",b.value)},CommentStatement:function(){},SubExpression:function(b){o(b);var c=this.classifySexpr(b);"simple"===c?this.simpleSexpr(b):"helper"===c?this.helperSexpr(b):this.ambiguousSexpr(b)},ambiguousSexpr:function(b,c,d){var e=b.path,f=e.parts[0],g=null!=c||null!=d;this.opcode("getContext",e.depth),this.opcode("pushProgram",c),this.opcode("pushProgram",d),e.strict=!0,this.accept(e),this.opcode("invokeAmbiguous",f,g)},simpleSexpr:function(b){var c=b.path;c.strict=!0,this.accept(c),this.opcode("resolvePossibleLambda")},helperSexpr:function(b,c,d){var e=this.setupFullMustacheParams(b,c,d),g=b.path,h=g.parts[0];if(this.options.knownHelpers[h])this.opcode("invokeKnownHelper",e.length,h);else{if(this.options.knownHelpersOnly)throw new f.default("You specified knownHelpersOnly, but used the unknown helper "+h,b);g.strict=!0,g.falsy=!0,this.accept(g),this.opcode("invokeHelper",e.length,g.original,i.default.helpers.simpleId(g))}},PathExpression:function(b){this.addDepth(b.depth),this.opcode("getContext",b.depth);var c=b.parts[0],d=i.default.helpers.scopedId(b),e=!b.depth&&!d&&this.blockParamIndex(c);e?this.opcode("lookupBlockParam",e,b.parts):c?b.data?(this.options.data=!0,this.opcode("lookupData",b.depth,b.parts,b.strict)):this.opcode("lookupOnContext",b.parts,b.falsy,b.strict,d):this.opcode("pushContext")},StringLiteral:function(b){this.opcode("pushString",b.value)},NumberLiteral:function(b){this.opcode("pushLiteral",b.value)},BooleanLiteral:function(b){this.opcode("pushLiteral",b.value)},UndefinedLiteral:function(){this.opcode("pushLiteral","undefined")},NullLiteral:function(){this.opcode("pushLiteral","null")},Hash:function(b){var c=b.pairs,d=0,e=c.length;for(this.opcode("pushHash");d<e;d++)this.pushParam(c[d].value);for(;d--;)this.opcode("assignToHash",c[d].key);this.opcode("popHash")},opcode:function(b){this.opcodes.push({opcode:b,args:j.call(arguments,1),loc:this.sourceNode[0].loc})},addDepth:function(b){b&&(this.useDepths=!0)},classifySexpr:function(b){var c=i.default.helpers.simpleId(b.path),d=c&&!!this.blockParamIndex(b.path.parts[0]),e=!d&&i.default.helpers.helperExpression(b),f=!d&&(e||c);if(f&&!e){var g=b.path.parts[0],h=this.options;h.knownHelpers[g]?e=!0:h.knownHelpersOnly&&(f=!1)}return e?"helper":f?"ambiguous":"simple"},pushParams:function(b){for(var c=0,d=b.length;c<d;c++)this.pushParam(b[c])},pushParam:function(b){var c=null!=b.value?b.value:b.original||"";if(this.stringParams)c.replace&&(c=c.replace(/^(\.?\.\/)*/g,"").replace(/\//g,".")),b.depth&&this.addDepth(b.depth),this.opcode("getContext",b.depth||0),this.opcode("pushStringParam",c,b.type),"SubExpression"===b.type&&this.accept(b);else{if(this.trackIds){var d=void 0;if(!b.parts||i.default.helpers.scopedId(b)||b.depth||(d=this.blockParamIndex(b.parts[0])),d){var e=b.parts.slice(1).join(".");this.opcode("pushId","BlockParam",d,e)}else c=b.original||c,c.replace&&(c=c.replace(/^this(?:\.|$)/,"").replace(/^\.\//,"").replace(/^\.$/,"")),this.opcode("pushId",b.type,c)}this.accept(b)}},setupFullMustacheParams:function(b,c,d,e){var f=b.params;return this.pushParams(f),this.opcode("pushProgram",c),this.opcode("pushProgram",d),b.hash?this.accept(b.hash):this.opcode("emptyHash",e),f},blockParamIndex:function(b){for(var c=0,d=this.options.blockParams.length;c<d;c++){var e=this.options.blockParams[c],f=e&&g.indexOf(e,b);if(e&&f>=0)return[c,f]}}}},function(a,b,c){"use strict";function k(a){this.value=a}function l(){}function m(a,b,c,d){var e=b.popStack(),f=0,g=c.length;for(a&&g--;f<g;f++)e=b.nameLookup(e,c[f],d);return a?[b.aliasable("container.strict"),"(",e,", ",b.quotedString(c[f]),")"]:e}var d=c(1).default;b.__esModule=!0;var e=c(4),f=c(6),g=d(f),h=c(5),i=c(29),j=d(i);l.prototype={nameLookup:function(b,c){return l.isValidJavaScriptVariableName(c)?[b,".",c]:[b,"[",JSON.stringify(c),"]"]},depthedLookup:function(b){return[this.aliasable("container.lookup"),'(depths, "',b,'")']},compilerInfo:function(){var b=e.COMPILER_REVISION,c=e.REVISION_CHANGES[b];return[b,c]},appendToBuffer:function(b,c,d){return h.isArray(b)||(b=[b]),b=this.source.wrap(b,c),this.environment.isSimple?["return ",b,";"]:d?["buffer += ",b,";"]:(b.appendToBuffer=!0,b)},initializeBuffer:function(){return this.quotedString("")},compile:function(b,c,d,e){this.environment=b,this.options=c,this.stringParams=this.options.stringParams,this.trackIds=this.options.trackIds,this.precompile=!e,this.name=this.environment.name,this.isChild=!!d,this.context=d||{decorators:[],programs:[],environments:[]},this.preamble(),this.stackSlot=0,this.stackVars=[],this.aliases={},this.registers={list:[]},this.hashes=[],this.compileStack=[],this.inlineStack=[],this.blockParams=[],this.compileChildren(b,c),this.useDepths=this.useDepths||b.useDepths||b.useDecorators||this.options.compat,this.useBlockParams=this.useBlockParams||b.useBlockParams;var f=b.opcodes,h=void 0,i=void 0,j=void 0,k=void 0;for(j=0,k=f.length;j<k;j++)h=f[j],this.source.currentLocation=h.loc,i=i||h.loc,this[h.opcode].apply(this,h.args);if(this.source.currentLocation=i,this.pushSource(""),this.stackSlot||this.inlineStack.length||this.compileStack.length)throw new g.default("Compile completed with content left on stack");this.decorators.isEmpty()?this.decorators=void 0:(this.useDecorators=!0,this.decorators.prepend("var decorators = container.decorators;\n"),this.decorators.push("return fn;"),e?this.decorators=Function.apply(this,["fn","props","container","depth0","data","blockParams","depths",this.decorators.merge()]):(this.decorators.prepend("function(fn, props, container, depth0, data, blockParams, depths) {\n"),this.decorators.push("}\n"),this.decorators=this.decorators.merge()));var l=this.createFunctionContext(e);if(this.isChild)return l;var m={compiler:this.compilerInfo(),main:l};this.decorators&&(m.main_d=this.decorators,m.useDecorators=!0);var n=this.context,o=n.programs,p=n.decorators;for(j=0,k=o.length;j<k;j++)o[j]&&(m[j]=o[j],p[j]&&(m[j+"_d"]=p[j],m.useDecorators=!0));return this.environment.usePartial&&(m.usePartial=!0),this.options.data&&(m.useData=!0),this.useDepths&&(m.useDepths=!0),this.useBlockParams&&(m.useBlockParams=!0),this.options.compat&&(m.compat=!0),e?m.compilerOptions=this.options:(m.compiler=JSON.stringify(m.compiler),this.source.currentLocation={start:{line:1,column:0}},m=this.objectLiteral(m),c.srcName?(m=m.toStringWithSourceMap({file:c.destName}),m.map=m.map&&m.map.toString()):m=m.toString()),m},preamble:function(){this.lastContext=0,this.source=new j.default(this.options.srcName),this.decorators=new j.default(this.options.srcName)},createFunctionContext:function(b){var c="",d=this.stackVars.concat(this.registers.list);d.length>0&&(c+=", "+d.join(", "));var e=0;for(var f in this.aliases){var g=this.aliases[f];this.aliases.hasOwnProperty(f)&&g.children&&g.referenceCount>1&&(c+=", alias"+ ++e+"="+f,g.children[0]="alias"+e)}var h=["container","depth0","helpers","partials","data"];(this.useBlockParams||this.useDepths)&&h.push("blockParams"),this.useDepths&&h.push("depths");var i=this.mergeSource(c);return b?(h.push(i),Function.apply(this,h)):this.source.wrap(["function(",h.join(","),") {\n  ",i,"}"])},mergeSource:function(b){var c=this.environment.isSimple,d=!this.forceBuffer,e=void 0,f=void 0,g=void 0,h=void 0;return this.source.each(function(a){a.appendToBuffer?(g?a.prepend("  + "):g=a,h=a):(g&&(f?g.prepend("buffer += "):e=!0,h.add(";"),g=h=void 0),f=!0,c||(d=!1))}),d?g?(g.prepend("return "),h.add(";")):f||this.source.push('return "";'):(b+=", buffer = "+(e?"":this.initializeBuffer()),g?(g.prepend("return buffer + "),h.add(";")):this.source.push("return buffer;")),b&&this.source.prepend("var "+b.substring(2)+(e?"":";\n")),this.source.merge()},blockValue:function(b){var c=this.aliasable("helpers.blockHelperMissing"),d=[this.contextName(0)];this.setupHelperArgs(b,0,d);var e=this.popStack();d.splice(1,0,e),this.push(this.source.functionCall(c,"call",d))},ambiguousBlockValue:function(){var b=this.aliasable("helpers.blockHelperMissing"),c=[this.contextName(0)];this.setupHelperArgs("",0,c,!0),this.flushInline();var d=this.topStack();c.splice(1,0,d),this.pushSource(["if (!",this.lastHelper,") { ",d," = ",this.source.functionCall(b,"call",c),"}"])},appendContent:function(b){this.pendingContent?b=this.pendingContent+b:this.pendingLocation=this.source.currentLocation,this.pendingContent=b},append:function(){if(this.isInline())this.replaceStack(function(a){return[" != null ? ",a,' : ""']}),this.pushSource(this.appendToBuffer(this.popStack()));else{var b=this.popStack();this.pushSource(["if (",b," != null) { ",this.appendToBuffer(b,void 0,!0)," }"]),this.environment.isSimple&&this.pushSource(["else { ",this.appendToBuffer("''",void 0,!0)," }"])}},appendEscaped:function(){this.pushSource(this.appendToBuffer([this.aliasable("container.escapeExpression"),"(",this.popStack(),")"]))},getContext:function(b){this.lastContext=b},pushContext:function(){this.pushStackLiteral(this.contextName(this.lastContext))},lookupOnContext:function(b,c,d,e){var f=0;e||!this.options.compat||this.lastContext?this.pushContext():this.push(this.depthedLookup(b[f++])),this.resolvePath("context",b,f,c,d)},lookupBlockParam:function(b,c){this.useBlockParams=!0,this.push(["blockParams[",b[0],"][",b[1],"]"]),this.resolvePath("context",c,1)},lookupData:function(b,c,d){b?this.pushStackLiteral("container.data(data, "+b+")"):this.pushStackLiteral("data"),this.resolvePath("data",c,0,!0,d)},resolvePath:function(b,c,d,e,f){var g=this;if(this.options.strict||this.options.assumeObjects)return void this.push(m(this.options.strict&&f,this,c,b));for(var h=c.length;d<h;d++)this.replaceStack(function(a){var f=g.nameLookup(a,c[d],b);return e?[" && ",f]:[" != null ? ",f," : ",a]})},resolvePossibleLambda:function(){this.push([this.aliasable("container.lambda"),"(",this.popStack(),", ",this.contextName(0),")"])},pushStringParam:function(b,c){this.pushContext(),this.pushString(c),"SubExpression"!==c&&("string"==typeof b?this.pushString(b):this.pushStackLiteral(b))},emptyHash:function(b){this.trackIds&&this.push("{}"),this.stringParams&&(this.push("{}"),this.push("{}")),this.pushStackLiteral(b?"undefined":"{}")},pushHash:function(){this.hash&&this.hashes.push(this.hash),this.hash={values:[],types:[],contexts:[],ids:[]}},popHash:function(){var b=this.hash;this.hash=this.hashes.pop(),this.trackIds&&this.push(this.objectLiteral(b.ids)),this.stringParams&&(this.push(this.objectLiteral(b.contexts)),this.push(this.objectLiteral(b.types))),this.push(this.objectLiteral(b.values))},pushString:function(b){this.pushStackLiteral(this.quotedString(b))},pushLiteral:function(b){this.pushStackLiteral(b)},pushProgram:function(b){null!=b?this.pushStackLiteral(this.programExpression(b)):this.pushStackLiteral(null)},registerDecorator:function(b,c){var d=this.nameLookup("decorators",c,"decorator"),e=this.setupHelperArgs(c,b);this.decorators.push(["fn = ",this.decorators.functionCall(d,"",["fn","props","container",e])," || fn;"])},invokeHelper:function(b,c,d){var e=this.popStack(),f=this.setupHelper(b,c),g=d?[f.name," || "]:"",h=["("].concat(g,e);this.options.strict||h.push(" || ",this.aliasable("helpers.helperMissing")),h.push(")"),this.push(this.source.functionCall(h,"call",f.callParams))},invokeKnownHelper:function(b,c){var d=this.setupHelper(b,c);this.push(this.source.functionCall(d.name,"call",d.callParams))},invokeAmbiguous:function(b,c){this.useRegister("helper");var d=this.popStack();this.emptyHash();var e=this.setupHelper(0,b,c),f=this.lastHelper=this.nameLookup("helpers",b,"helper"),g=["(","(helper = ",f," || ",d,")"];this.options.strict||(g[0]="(helper = ",g.push(" != null ? helper : ",this.aliasable("helpers.helperMissing"))),this.push(["(",g,e.paramsInit?["),(",e.paramsInit]:[],"),","(typeof helper === ",this.aliasable('"function"')," ? ",this.source.functionCall("helper","call",e.callParams)," : helper))"])},invokePartial:function(b,c,d){var e=[],f=this.setupParams(c,1,e);b&&(c=this.popStack(),delete f.name),d&&(f.indent=JSON.stringify(d)),f.helpers="helpers",f.partials="partials",f.decorators="container.decorators",b?e.unshift(c):e.unshift(this.nameLookup("partials",c,"partial")),this.options.compat&&(f.depths="depths"),f=this.objectLiteral(f),e.push(f),this.push(this.source.functionCall("container.invokePartial","",e))},assignToHash:function(b){var c=this.popStack(),d=void 0,e=void 0,f=void 0;this.trackIds&&(f=this.popStack()),this.stringParams&&(e=this.popStack(),d=this.popStack());var g=this.hash;d&&(g.contexts[b]=d),e&&(g.types[b]=e),f&&(g.ids[b]=f),g.values[b]=c},pushId:function(b,c,d){
	"BlockParam"===b?this.pushStackLiteral("blockParams["+c[0]+"].path["+c[1]+"]"+(d?" + "+JSON.stringify("."+d):"")):"PathExpression"===b?this.pushString(c):"SubExpression"===b?this.pushStackLiteral("true"):this.pushStackLiteral("null")},compiler:l,compileChildren:function(b,c){for(var d=b.children,e=void 0,f=void 0,g=0,h=d.length;g<h;g++){e=d[g],f=new this.compiler;var i=this.matchExistingProgram(e);null==i?(this.context.programs.push(""),i=this.context.programs.length,e.index=i,e.name="program"+i,this.context.programs[i]=f.compile(e,c,this.context,!this.precompile),this.context.decorators[i]=f.decorators,this.context.environments[i]=e,this.useDepths=this.useDepths||f.useDepths,this.useBlockParams=this.useBlockParams||f.useBlockParams):(e.index=i,e.name="program"+i,this.useDepths=this.useDepths||e.useDepths,this.useBlockParams=this.useBlockParams||e.useBlockParams)}},matchExistingProgram:function(b){for(var c=0,d=this.context.environments.length;c<d;c++){var e=this.context.environments[c];if(e&&e.equals(b))return c}},programExpression:function(b){var c=this.environment.children[b],d=[c.index,"data",c.blockParams];return(this.useBlockParams||this.useDepths)&&d.push("blockParams"),this.useDepths&&d.push("depths"),"container.program("+d.join(", ")+")"},useRegister:function(b){this.registers[b]||(this.registers[b]=!0,this.registers.list.push(b))},push:function(b){return b instanceof k||(b=this.source.wrap(b)),this.inlineStack.push(b),b},pushStackLiteral:function(b){this.push(new k(b))},pushSource:function(b){this.pendingContent&&(this.source.push(this.appendToBuffer(this.source.quotedString(this.pendingContent),this.pendingLocation)),this.pendingContent=void 0),b&&this.source.push(b)},replaceStack:function(b){var c=["("],d=void 0,e=void 0,f=void 0;if(!this.isInline())throw new g.default("replaceStack on non-inline");var h=this.popStack(!0);if(h instanceof k)d=[h.value],c=["(",d],f=!0;else{e=!0;var i=this.incrStack();c=["((",this.push(i)," = ",h,")"],d=this.topStack()}var j=b.call(this,d);f||this.popStack(),e&&this.stackSlot--,this.push(c.concat(j,")"))},incrStack:function(){return this.stackSlot++,this.stackSlot>this.stackVars.length&&this.stackVars.push("stack"+this.stackSlot),this.topStackName()},topStackName:function(){return"stack"+this.stackSlot},flushInline:function(){var b=this.inlineStack;this.inlineStack=[];for(var c=0,d=b.length;c<d;c++){var e=b[c];if(e instanceof k)this.compileStack.push(e);else{var f=this.incrStack();this.pushSource([f," = ",e,";"]),this.compileStack.push(f)}}},isInline:function(){return this.inlineStack.length},popStack:function(b){var c=this.isInline(),d=(c?this.inlineStack:this.compileStack).pop();if(!b&&d instanceof k)return d.value;if(!c){if(!this.stackSlot)throw new g.default("Invalid stack pop");this.stackSlot--}return d},topStack:function(){var b=this.isInline()?this.inlineStack:this.compileStack,c=b[b.length-1];return c instanceof k?c.value:c},contextName:function(b){return this.useDepths&&b?"depths["+b+"]":"depth"+b},quotedString:function(b){return this.source.quotedString(b)},objectLiteral:function(b){return this.source.objectLiteral(b)},aliasable:function(b){var c=this.aliases[b];return c?(c.referenceCount++,c):(c=this.aliases[b]=this.source.wrap(b),c.aliasable=!0,c.referenceCount=1,c)},setupHelper:function(b,c,d){var e=[],f=this.setupHelperArgs(c,b,e,d),g=this.nameLookup("helpers",c,"helper"),h=this.aliasable(this.contextName(0)+" != null ? "+this.contextName(0)+" : {}");return{params:e,paramsInit:f,name:g,callParams:[h].concat(e)}},setupParams:function(b,c,d){var e={},f=[],g=[],h=[],i=!d,j=void 0;i&&(d=[]),e.name=this.quotedString(b),e.hash=this.popStack(),this.trackIds&&(e.hashIds=this.popStack()),this.stringParams&&(e.hashTypes=this.popStack(),e.hashContexts=this.popStack());var k=this.popStack(),l=this.popStack();(l||k)&&(e.fn=l||"container.noop",e.inverse=k||"container.noop");for(var m=c;m--;)j=this.popStack(),d[m]=j,this.trackIds&&(h[m]=this.popStack()),this.stringParams&&(g[m]=this.popStack(),f[m]=this.popStack());return i&&(e.args=this.source.generateArray(d)),this.trackIds&&(e.ids=this.source.generateArray(h)),this.stringParams&&(e.types=this.source.generateArray(g),e.contexts=this.source.generateArray(f)),this.options.data&&(e.data="data"),this.useBlockParams&&(e.blockParams="blockParams"),e},setupHelperArgs:function(b,c,d,e){var f=this.setupParams(b,c,d);return f=this.objectLiteral(f),e?(this.useRegister("options"),d.push("options"),["options=",f]):d?(d.push(f),""):f}},function(){for(var a="break else new var case finally return void catch for switch while continue function this with default if throw delete in try do instanceof typeof abstract enum int short boolean export interface static byte extends long super char final native synchronized class float package throws const goto private transient debugger implements protected volatile double import public let yield await null true false".split(" "),b=l.RESERVED_WORDS={},c=0,d=a.length;c<d;c++)b[a[c]]=!0}(),l.isValidJavaScriptVariableName=function(a){return!l.RESERVED_WORDS[a]&&/^[a-zA-Z_$][0-9a-zA-Z_$]*$/.test(a)},b.default=l,a.exports=b.default},function(a,b,c){"use strict";function g(a,b,c){if(d.isArray(a)){for(var e=[],f=0,g=a.length;f<g;f++)e.push(b.wrap(a[f],c));return e}return"boolean"==typeof a||"number"==typeof a?a+"":a}function h(a){this.srcFile=a,this.source=[]}b.__esModule=!0;var d=c(5),e=void 0;try{}catch(a){}e||(e=function(a,b,c,d){this.src="",d&&this.add(d)},e.prototype={add:function(b){d.isArray(b)&&(b=b.join("")),this.src+=b},prepend:function(b){d.isArray(b)&&(b=b.join("")),this.src=b+this.src},toStringWithSourceMap:function(){return{code:this.toString()}},toString:function(){return this.src}}),h.prototype={isEmpty:function(){return!this.source.length},prepend:function(b,c){this.source.unshift(this.wrap(b,c))},push:function(b,c){this.source.push(this.wrap(b,c))},merge:function(){var b=this.empty();return this.each(function(a){b.add(["  ",a,"\n"])}),b},each:function(b){for(var c=0,d=this.source.length;c<d;c++)b(this.source[c])},empty:function(){var b=this.currentLocation||{start:{}};return new e(b.start.line,b.start.column,this.srcFile)},wrap:function(b){var c=arguments.length<=1||void 0===arguments[1]?this.currentLocation||{start:{}}:arguments[1];return b instanceof e?b:(b=g(b,this,c),new e(c.start.line,c.start.column,this.srcFile,b))},functionCall:function(b,c,d){return d=this.generateList(d),this.wrap([b,c?"."+c+"(":"(",d,")"])},quotedString:function(b){return'"'+(b+"").replace(/\\/g,"\\\\").replace(/"/g,'\\"').replace(/\n/g,"\\n").replace(/\r/g,"\\r").replace(/\u2028/g,"\\u2028").replace(/\u2029/g,"\\u2029")+'"'},objectLiteral:function(b){var c=[];for(var d in b)if(b.hasOwnProperty(d)){var e=g(b[d],this);"undefined"!==e&&c.push([this.quotedString(d),":",e])}var f=this.generateList(c);return f.prepend("{"),f.add("}"),f},generateList:function(b){for(var c=this.empty(),d=0,e=b.length;d<e;d++)d&&c.add(","),c.add(g(b[d],this));return c},generateArray:function(b){var c=this.generateList(b);return c.prepend("["),c.add("]"),c}},b.default=h,a.exports=b.default}])});

/*!
 * anim
 * MIT License
 */
(function(u,r){"function"===typeof define&&define.amd?define([],r):"object"===typeof module&&module.exports?module.exports=r():u.anime=r()})(this,function(){var u={duration:1E3,delay:0,loop:!1,autoplay:!0,direction:"normal",easing:"easeOutElastic",elasticity:400,round:!1,begin:void 0,update:void 0,complete:void 0},r="translateX translateY translateZ rotate rotateX rotateY rotateZ scale scaleX scaleY scaleZ skewX skewY".split(" "),y,f={arr:function(a){return Array.isArray(a)},obj:function(a){return-1<
		Object.prototype.toString.call(a).indexOf("Object")},svg:function(a){return a instanceof SVGElement},dom:function(a){return a.nodeType||f.svg(a)},num:function(a){return!isNaN(parseInt(a))},str:function(a){return"string"===typeof a},fnc:function(a){return"function"===typeof a},und:function(a){return"undefined"===typeof a},nul:function(a){return"null"===typeof a},hex:function(a){return/(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(a)},rgb:function(a){return/^rgb/.test(a)},hsl:function(a){return/^hsl/.test(a)},
		col:function(a){return f.hex(a)||f.rgb(a)||f.hsl(a)}},D=function(){var a={},b={Sine:function(a){return 1-Math.cos(a*Math.PI/2)},Circ:function(a){return 1-Math.sqrt(1-a*a)},Elastic:function(a,b){if(0===a||1===a)return a;var d=1-Math.min(b,998)/1E3,g=a/1-1;return-(Math.pow(2,10*g)*Math.sin(2*(g-d/(2*Math.PI)*Math.asin(1))*Math.PI/d))},Back:function(a){return a*a*(3*a-2)},Bounce:function(a){for(var b,d=4;a<((b=Math.pow(2,--d))-1)/11;);return 1/Math.pow(4,3-d)-7.5625*Math.pow((3*b-2)/22-a,2)}};["Quad",
		"Cubic","Quart","Quint","Expo"].forEach(function(a,e){b[a]=function(a){return Math.pow(a,e+2)}});Object.keys(b).forEach(function(c){var e=b[c];a["easeIn"+c]=e;a["easeOut"+c]=function(a,b){return 1-e(1-a,b)};a["easeInOut"+c]=function(a,b){return.5>a?e(2*a,b)/2:1-e(-2*a+2,b)/2};a["easeOutIn"+c]=function(a,b){return.5>a?(1-e(1-2*a,b))/2:(e(2*a-1,b)+1)/2}});a.linear=function(a){return a};return a}(),z=function(a){return f.str(a)?a:a+""},E=function(a){return a.replace(/([a-z])([A-Z])/g,"$1-$2").toLowerCase()},
	F=function(a){if(f.col(a))return!1;try{return document.querySelectorAll(a)}catch(b){return!1}},A=function(a){return a.reduce(function(a,c){return a.concat(f.arr(c)?A(c):c)},[])},t=function(a){if(f.arr(a))return a;f.str(a)&&(a=F(a)||a);return a instanceof NodeList||a instanceof HTMLCollection?[].slice.call(a):[a]},G=function(a,b){return a.some(function(a){return a===b})},R=function(a,b){var c={};a.forEach(function(a){var d=JSON.stringify(b.map(function(b){return a[b]}));c[d]=c[d]||[];c[d].push(a)});
		return Object.keys(c).map(function(a){return c[a]})},H=function(a){return a.filter(function(a,c,e){return e.indexOf(a)===c})},B=function(a){var b={},c;for(c in a)b[c]=a[c];return b},v=function(a,b){for(var c in b)a[c]=f.und(a[c])?b[c]:a[c];return a},S=function(a){a=a.replace(/^#?([a-f\d])([a-f\d])([a-f\d])$/i,function(a,b,c,m){return b+b+c+c+m+m});var b=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(a);a=parseInt(b[1],16);var c=parseInt(b[2],16),b=parseInt(b[3],16);return"rgb("+a+","+c+","+b+")"},
	T=function(a){a=/hsl\((\d+),\s*([\d.]+)%,\s*([\d.]+)%\)/g.exec(a);var b=parseInt(a[1])/360,c=parseInt(a[2])/100,e=parseInt(a[3])/100;a=function(a,b,c){0>c&&(c+=1);1<c&&--c;return c<1/6?a+6*(b-a)*c:.5>c?b:c<2/3?a+(b-a)*(2/3-c)*6:a};if(0==c)c=e=b=e;else var d=.5>e?e*(1+c):e+c-e*c,g=2*e-d,c=a(g,d,b+1/3),e=a(g,d,b),b=a(g,d,b-1/3);return"rgb("+255*c+","+255*e+","+255*b+")"},p=function(a){return/([\+\-]?[0-9|auto\.]+)(%|px|pt|em|rem|in|cm|mm|ex|pc|vw|vh|deg)?/.exec(a)[2]},I=function(a,b,c){return p(b)?
		b:-1<a.indexOf("translate")?p(c)?b+p(c):b+"px":-1<a.indexOf("rotate")||-1<a.indexOf("skew")?b+"deg":b},w=function(a,b){if(b in a.style)return getComputedStyle(a).getPropertyValue(E(b))||"0"},U=function(a,b){var c=-1<b.indexOf("scale")?1:0,e=a.style.transform;if(!e)return c;for(var d=/(\w+)\((.+?)\)/g,g=[],m=[],f=[];g=d.exec(e);)m.push(g[1]),f.push(g[2]);e=f.filter(function(a,c){return m[c]===b});return e.length?e[0]:c},J=function(a,b){if(f.dom(a)&&G(r,b))return"transform";if(f.dom(a)&&(a.getAttribute(b)||
		f.svg(a)&&a[b]))return"attribute";if(f.dom(a)&&"transform"!==b&&w(a,b))return"css";if(!f.nul(a[b])&&!f.und(a[b]))return"object"},K=function(a,b){switch(J(a,b)){case "transform":return U(a,b);case "css":return w(a,b);case "attribute":return a.getAttribute(b)}return a[b]||0},L=function(a,b,c){if(f.col(b))return b=f.rgb(b)?b:f.hex(b)?S(b):f.hsl(b)?T(b):void 0,b;if(p(b))return b;a=p(a.to)?p(a.to):p(a.from);!a&&c&&(a=p(c));return a?b+a:b},M=function(a){var b=/-?\d*\.?\d+/g;return{original:a,numbers:z(a).match(b)?
		z(a).match(b).map(Number):[0],strings:z(a).split(b)}},V=function(a,b,c){return b.reduce(function(b,d,g){d=d?d:c[g-1];return b+a[g-1]+d})},W=function(a){a=a?A(f.arr(a)?a.map(t):t(a)):[];return a.map(function(a,c){return{target:a,id:c}})},N=function(a,b,c,e){"transform"===c?(c=a+"("+I(a,b.from,b.to)+")",b=a+"("+I(a,b.to)+")"):(a="css"===c?w(e,a):void 0,c=L(b,b.from,a),b=L(b,b.to,a));return{from:M(c),to:M(b)}},X=function(a,b){var c=[];a.forEach(function(e,d){var g=e.target;return b.forEach(function(b){var l=
		J(g,b.name);if(l){var q;q=b.name;var h=b.value,h=t(f.fnc(h)?h(g,d):h);q={from:1<h.length?h[0]:K(g,q),to:1<h.length?h[1]:h[0]};h=B(b);h.animatables=e;h.type=l;h.from=N(b.name,q,h.type,g).from;h.to=N(b.name,q,h.type,g).to;h.round=f.col(q.from)||h.round?1:0;h.delay=(f.fnc(h.delay)?h.delay(g,d,a.length):h.delay)/k.speed;h.duration=(f.fnc(h.duration)?h.duration(g,d,a.length):h.duration)/k.speed;c.push(h)}})});return c},Y=function(a,b){var c=X(a,b);return R(c,["name","from","to","delay","duration"]).map(function(a){var b=
		B(a[0]);b.animatables=a.map(function(a){return a.animatables});b.totalDuration=b.delay+b.duration;return b})},C=function(a,b){a.tweens.forEach(function(c){var e=c.from,d=a.duration-(c.delay+c.duration);c.from=c.to;c.to=e;b&&(c.delay=d)});a.reversed=a.reversed?!1:!0},Z=function(a){if(a.length)return Math.max.apply(Math,a.map(function(a){return a.totalDuration}))},O=function(a){var b=[],c=[];a.tweens.forEach(function(a){if("css"===a.type||"transform"===a.type)b.push("css"===a.type?E(a.name):"transform"),
		a.animatables.forEach(function(a){c.push(a.target)})});return{properties:H(b).join(", "),elements:H(c)}},aa=function(a){var b=O(a);b.elements.forEach(function(a){a.style.willChange=b.properties})},ba=function(a){O(a).elements.forEach(function(a){a.style.removeProperty("will-change")})},ca=function(a,b){var c=a.path,e=a.value*b,d=function(d){d=d||0;return c.getPointAtLength(1<b?a.value+d:e+d)},g=d(),f=d(-1),d=d(1);switch(a.name){case "translateX":return g.x;case "translateY":return g.y;case "rotate":return 180*
		Math.atan2(d.y-f.y,d.x-f.x)/Math.PI}},da=function(a,b){var c=Math.min(Math.max(b-a.delay,0),a.duration)/a.duration,e=a.to.numbers.map(function(b,e){var f=a.from.numbers[e],l=D[a.easing](c,a.elasticity),f=a.path?ca(a,l):f+l*(b-f);return f=a.round?Math.round(f*a.round)/a.round:f});return V(e,a.to.strings,a.from.strings)},P=function(a,b){var c;a.currentTime=b;a.progress=b/a.duration*100;for(var e=0;e<a.tweens.length;e++){var d=a.tweens[e];d.currentValue=da(d,b);for(var f=d.currentValue,m=0;m<d.animatables.length;m++){var l=
		d.animatables[m],k=l.id,l=l.target,h=d.name;switch(d.type){case "css":l.style[h]=f;break;case "attribute":l.setAttribute(h,f);break;case "object":l[h]=f;break;case "transform":c||(c={}),c[k]||(c[k]=[]),c[k].push(f)}}}if(c)for(e in y||(y=(w(document.body,"transform")?"":"-webkit-")+"transform"),c)a.animatables[e].target.style[y]=c[e].join(" ");a.settings.update&&a.settings.update(a)},Q=function(a){var b={};b.animatables=W(a.targets);b.settings=v(a,u);var c=b.settings,e=[],d;for(d in a)if(!u.hasOwnProperty(d)&&
		"targets"!==d){var g=f.obj(a[d])?B(a[d]):{value:a[d]};g.name=d;e.push(v(g,c))}b.properties=e;b.tweens=Y(b.animatables,b.properties);b.duration=Z(b.tweens)||a.duration;b.currentTime=0;b.progress=0;b.ended=!1;return b},n=[],x=0,ea=function(){var a=function(){x=requestAnimationFrame(b)},b=function(b){if(n.length){for(var e=0;e<n.length;e++)n[e].tick(b);a()}else cancelAnimationFrame(x),x=0};return a}(),k=function(a){var b=Q(a),c={};b.tick=function(a){b.ended=!1;c.start||(c.start=a);c.current=Math.min(Math.max(c.last+
		a-c.start,0),b.duration);P(b,c.current);var d=b.settings;d.begin&&c.current>=d.delay&&(d.begin(b),d.begin=void 0);c.current>=b.duration&&(d.loop?(c.start=a,"alternate"===d.direction&&C(b,!0),f.num(d.loop)&&d.loop--):(b.ended=!0,b.pause(),d.complete&&d.complete(b)),c.last=0)};b.seek=function(a){P(b,a/100*b.duration)};b.pause=function(){ba(b);var a=n.indexOf(b);-1<a&&n.splice(a,1)};b.play=function(a){b.pause();a&&(b=v(Q(v(a,b.settings)),b));c.start=0;c.last=b.ended?0:b.currentTime;a=b.settings;"reverse"===
	a.direction&&C(b);"alternate"!==a.direction||a.loop||(a.loop=1);aa(b);n.push(b);x||ea()};b.restart=function(){b.reversed&&C(b);b.pause();b.seek(0);b.play()};b.settings.autoplay&&b.play();return b};k.version="1.1.1";k.speed=1;k.list=n;k.remove=function(a){a=A(f.arr(a)?a.map(t):t(a));for(var b=n.length-1;0<=b;b--)for(var c=n[b],e=c.tweens,d=e.length-1;0<=d;d--)for(var g=e[d].animatables,k=g.length-1;0<=k;k--)G(a,g[k].target)&&(g.splice(k,1),g.length||e.splice(d,1),e.length||c.pause())};k.easings=D;
	k.getValue=K;k.path=function(a){a=f.str(a)?F(a)[0]:a;return{path:a,value:a.getTotalLength()}};k.random=function(a,b){return Math.floor(Math.random()*(b-a+1))+a};return k});

/** Abstract base class for collection plugins v1.0.1.
 Written by Keith Wood (kbwood{at}iinet.com.au) December 2013.
 Licensed under the MIT (http://keith-wood.name/licence.html) license. */
(function(){var j=false;window.JQClass=function(){};JQClass.classes={};JQClass.extend=function extender(f){var g=this.prototype;j=true;var h=new this();j=false;for(var i in f){h[i]=typeof f[i]=='function'&&typeof g[i]=='function'?(function(d,e){return function(){var b=this._super;this._super=function(a){return g[d].apply(this,a||[])};var c=e.apply(this,arguments);this._super=b;return c}})(i,f[i]):f[i]}function JQClass(){if(!j&&this._init){this._init.apply(this,arguments)}}JQClass.prototype=h;JQClass.prototype.constructor=JQClass;JQClass.extend=extender;return JQClass}})();(function($){JQClass.classes.JQPlugin=JQClass.extend({name:'plugin',defaultOptions:{},regionalOptions:{},_getters:[],_getMarker:function(){return'is-'+this.name},_init:function(){$.extend(this.defaultOptions,(this.regionalOptions&&this.regionalOptions[''])||{});var c=camelCase(this.name);$[c]=this;$.fn[c]=function(a){var b=Array.prototype.slice.call(arguments,1);if($[c]._isNotChained(a,b)){return $[c][a].apply($[c],[this[0]].concat(b))}return this.each(function(){if(typeof a==='string'){if(a[0]==='_'||!$[c][a]){throw'Unknown method: '+a;}$[c][a].apply($[c],[this].concat(b))}else{$[c]._attach(this,a)}})}},setDefaults:function(a){$.extend(this.defaultOptions,a||{})},_isNotChained:function(a,b){if(a==='option'&&(b.length===0||(b.length===1&&typeof b[0]==='string'))){return true}return $.inArray(a,this._getters)>-1},_attach:function(a,b){a=$(a);if(a.hasClass(this._getMarker())){return}a.addClass(this._getMarker());b=$.extend({},this.defaultOptions,this._getMetadata(a),b||{});var c=$.extend({name:this.name,elem:a,options:b},this._instSettings(a,b));a.data(this.name,c);this._postAttach(a,c);this.option(a,b)},_instSettings:function(a,b){return{}},_postAttach:function(a,b){},_getMetadata:function(d){try{var f=d.data(this.name.toLowerCase())||'';f=f.replace(/'/g,'"');f=f.replace(/([a-zA-Z0-9]+):/g,function(a,b,i){var c=f.substring(0,i).match(/"/g);return(!c||c.length%2===0?'"'+b+'":':b+':')});f=$.parseJSON('{'+f+'}');for(var g in f){var h=f[g];if(typeof h==='string'&&h.match(/^new Date\((.*)\)$/)){f[g]=eval(h)}}return f}catch(e){return{}}},_getInst:function(a){return $(a).data(this.name)||{}},option:function(a,b,c){a=$(a);var d=a.data(this.name);if(!b||(typeof b==='string'&&c==null)){var e=(d||{}).options;return(e&&b?e[b]:e)}if(!a.hasClass(this._getMarker())){return}var e=b||{};if(typeof b==='string'){e={};e[b]=c}this._optionsChanged(a,d,e);$.extend(d.options,e)},_optionsChanged:function(a,b,c){},destroy:function(a){a=$(a);if(!a.hasClass(this._getMarker())){return}this._preDestroy(a,this._getInst(a));a.removeData(this.name).removeClass(this._getMarker())},_preDestroy:function(a,b){}});function camelCase(c){return c.replace(/-([a-z])/g,function(a,b){return b.toUpperCase()})}$.JQPlugin={createPlugin:function(a,b){if(typeof a==='object'){b=a;a='JQPlugin'}a=camelCase(a);var c=camelCase(b.name);JQClass.classes[c]=JQClass.classes[a].extend(b);new JQClass.classes[c]()}}})(jQuery);

/* http://keith-wood.name/countdown.html
 Countdown for jQuery v2.0.2.
 Written by Keith Wood (kbwood{at}iinet.com.au) January 2008.
 Available under the MIT (http://keith-wood.name/licence.html) license.
 Please attribute the author if you use it. */
(function($){var w='countdown';var Y=0;var O=1;var W=2;var D=3;var H=4;var M=5;var S=6;$.JQPlugin.createPlugin({name:w,defaultOptions:{until:null,since:null,timezone:null,serverSync:null,format:'dHMS',layout:'',compact:false,padZeroes:false,significant:0,description:'',expiryUrl:'',expiryText:'',alwaysExpire:false,onExpiry:null,onTick:null,tickInterval:1},regionalOptions:{'':{labels:['Years','Months','Weeks','Days','Hours','Minutes','Seconds'],labels1:['Year','Month','Week','Day','Hour','Minute','Second'],compactLabels:['y','m','w','d'],whichLabels:null,digits:['0','1','2','3','4','5','6','7','8','9'],timeSeparator:':',isRTL:false}},_getters:['getTimes'],_rtlClass:w+'-rtl',_sectionClass:w+'-section',_amountClass:w+'-amount',_periodClass:w+'-period',_rowClass:w+'-row',_holdingClass:w+'-holding',_showClass:w+'-show',_descrClass:w+'-descr',_timerElems:[],_init:function(){var c=this;this._super();this._serverSyncs=[];var d=(typeof Date.now=='function'?Date.now:function(){return new Date().getTime()});var e=(window.performance&&typeof window.performance.now=='function');function timerCallBack(a){var b=(a<1e12?(e?(performance.now()+performance.timing.navigationStart):d()):a||d());if(b-g>=1000){c._updateElems();g=b}f(timerCallBack)}var f=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||null;var g=0;if(!f||$.noRequestAnimationFrame){$.noRequestAnimationFrame=null;setInterval(function(){c._updateElems()},980)}else{g=window.animationStartTime||window.webkitAnimationStartTime||window.mozAnimationStartTime||window.oAnimationStartTime||window.msAnimationStartTime||d();f(timerCallBack)}},UTCDate:function(a,b,c,e,f,g,h,i){if(typeof b=='object'&&b.constructor==Date){i=b.getMilliseconds();h=b.getSeconds();g=b.getMinutes();f=b.getHours();e=b.getDate();c=b.getMonth();b=b.getFullYear()}var d=new Date();d.setUTCFullYear(b);d.setUTCDate(1);d.setUTCMonth(c||0);d.setUTCDate(e||1);d.setUTCHours(f||0);d.setUTCMinutes((g||0)-(Math.abs(a)<30?a*60:a));d.setUTCSeconds(h||0);d.setUTCMilliseconds(i||0);return d},periodsToSeconds:function(a){return a[0]*31557600+a[1]*2629800+a[2]*604800+a[3]*86400+a[4]*3600+a[5]*60+a[6]},resync:function(){var d=this;$('.'+this._getMarker()).each(function(){var a=$.data(this,d.name);if(a.options.serverSync){var b=null;for(var i=0;i<d._serverSyncs.length;i++){if(d._serverSyncs[i][0]==a.options.serverSync){b=d._serverSyncs[i];break}}if(b[2]==null){var c=($.isFunction(a.options.serverSync)?a.options.serverSync.apply(this,[]):null);b[2]=(c?new Date().getTime()-c.getTime():0)-b[1]}if(a._since){a._since.setMilliseconds(a._since.getMilliseconds()+b[2])}a._until.setMilliseconds(a._until.getMilliseconds()+b[2])}});for(var i=0;i<d._serverSyncs.length;i++){if(d._serverSyncs[i][2]!=null){d._serverSyncs[i][1]+=d._serverSyncs[i][2];delete d._serverSyncs[i][2]}}},_instSettings:function(a,b){return{_periods:[0,0,0,0,0,0,0]}},_addElem:function(a){if(!this._hasElem(a)){this._timerElems.push(a)}},_hasElem:function(a){return($.inArray(a,this._timerElems)>-1)},_removeElem:function(b){this._timerElems=$.map(this._timerElems,function(a){return(a==b?null:a)})},_updateElems:function(){for(var i=this._timerElems.length-1;i>=0;i--){this._updateCountdown(this._timerElems[i])}},_optionsChanged:function(a,b,c){if(c.layout){c.layout=c.layout.replace(/&lt;/g,'<').replace(/&gt;/g,'>')}this._resetExtraLabels(b.options,c);var d=(b.options.timezone!=c.timezone);$.extend(b.options,c);this._adjustSettings(a,b,c.until!=null||c.since!=null||d);var e=new Date();if((b._since&&b._since<e)||(b._until&&b._until>e)){this._addElem(a[0])}this._updateCountdown(a,b)},_updateCountdown:function(a,b){a=a.jquery?a:$(a);b=b||this._getInst(a);if(!b){return}a.html(this._generateHTML(b)).toggleClass(this._rtlClass,b.options.isRTL);if($.isFunction(b.options.onTick)){var c=b._hold!='lap'?b._periods:this._calculatePeriods(b,b._show,b.options.significant,new Date());if(b.options.tickInterval==1||this.periodsToSeconds(c)%b.options.tickInterval==0){b.options.onTick.apply(a[0],[c])}}var d=b._hold!='pause'&&(b._since?b._now.getTime()<b._since.getTime():b._now.getTime()>=b._until.getTime());if(d&&!b._expiring){b._expiring=true;if(this._hasElem(a[0])||b.options.alwaysExpire){this._removeElem(a[0]);if($.isFunction(b.options.onExpiry)){b.options.onExpiry.apply(a[0],[])}if(b.options.expiryText){var e=b.options.layout;b.options.layout=b.options.expiryText;this._updateCountdown(a[0],b);b.options.layout=e}if(b.options.expiryUrl){window.location=b.options.expiryUrl}}b._expiring=false}else if(b._hold=='pause'){this._removeElem(a[0])}},_resetExtraLabels:function(a,b){for(var n in b){if(n.match(/[Ll]abels[02-9]|compactLabels1/)){a[n]=b[n]}}for(var n in a){if(n.match(/[Ll]abels[02-9]|compactLabels1/)&&typeof b[n]==='undefined'){a[n]=null}}},_adjustSettings:function(a,b,c){var d=null;for(var i=0;i<this._serverSyncs.length;i++){if(this._serverSyncs[i][0]==b.options.serverSync){d=this._serverSyncs[i][1];break}}if(d!=null){var e=(b.options.serverSync?d:0);var f=new Date()}else{var g=($.isFunction(b.options.serverSync)?b.options.serverSync.apply(a[0],[]):null);var f=new Date();var e=(g?f.getTime()-g.getTime():0);this._serverSyncs.push([b.options.serverSync,e])}var h=b.options.timezone;h=(h==null?-f.getTimezoneOffset():h);if(c||(!c&&b._until==null&&b._since==null)){b._since=b.options.since;if(b._since!=null){b._since=this.UTCDate(h,this._determineTime(b._since,null));if(b._since&&e){b._since.setMilliseconds(b._since.getMilliseconds()+e)}}b._until=this.UTCDate(h,this._determineTime(b.options.until,f));if(e){b._until.setMilliseconds(b._until.getMilliseconds()+e)}}b._show=this._determineShow(b)},_preDestroy:function(a,b){this._removeElem(a[0]);a.empty()},pause:function(a){this._hold(a,'pause')},lap:function(a){this._hold(a,'lap')},resume:function(a){this._hold(a,null)},toggle:function(a){var b=$.data(a,this.name)||{};this[!b._hold?'pause':'resume'](a)},toggleLap:function(a){var b=$.data(a,this.name)||{};this[!b._hold?'lap':'resume'](a)},_hold:function(a,b){var c=$.data(a,this.name);if(c){if(c._hold=='pause'&&!b){c._periods=c._savePeriods;var d=(c._since?'-':'+');c[c._since?'_since':'_until']=this._determineTime(d+c._periods[0]+'y'+d+c._periods[1]+'o'+d+c._periods[2]+'w'+d+c._periods[3]+'d'+d+c._periods[4]+'h'+d+c._periods[5]+'m'+d+c._periods[6]+'s');this._addElem(a)}c._hold=b;c._savePeriods=(b=='pause'?c._periods:null);$.data(a,this.name,c);this._updateCountdown(a,c)}},getTimes:function(a){var b=$.data(a,this.name);return(!b?null:(b._hold=='pause'?b._savePeriods:(!b._hold?b._periods:this._calculatePeriods(b,b._show,b.options.significant,new Date()))))},_determineTime:function(k,l){var m=this;var n=function(a){var b=new Date();b.setTime(b.getTime()+a*1000);return b};var o=function(a){a=a.toLowerCase();var b=new Date();var c=b.getFullYear();var d=b.getMonth();var e=b.getDate();var f=b.getHours();var g=b.getMinutes();var h=b.getSeconds();var i=/([+-]?[0-9]+)\s*(s|m|h|d|w|o|y)?/g;var j=i.exec(a);while(j){switch(j[2]||'s'){case's':h+=parseInt(j[1],10);break;case'm':g+=parseInt(j[1],10);break;case'h':f+=parseInt(j[1],10);break;case'd':e+=parseInt(j[1],10);break;case'w':e+=parseInt(j[1],10)*7;break;case'o':d+=parseInt(j[1],10);e=Math.min(e,m._getDaysInMonth(c,d));break;case'y':c+=parseInt(j[1],10);e=Math.min(e,m._getDaysInMonth(c,d));break}j=i.exec(a)}return new Date(c,d,e,f,g,h,0)};var p=(k==null?l:(typeof k=='string'?o(k):(typeof k=='number'?n(k):k)));if(p)p.setMilliseconds(0);return p},_getDaysInMonth:function(a,b){return 32-new Date(a,b,32).getDate()},_normalLabels:function(a){return a},_generateHTML:function(c){var d=this;c._periods=(c._hold?c._periods:this._calculatePeriods(c,c._show,c.options.significant,new Date()));var e=false;var f=0;var g=c.options.significant;var h=$.extend({},c._show);for(var i=Y;i<=S;i++){e|=(c._show[i]=='?'&&c._periods[i]>0);h[i]=(c._show[i]=='?'&&!e?null:c._show[i]);f+=(h[i]?1:0);g-=(c._periods[i]>0?1:0)}var j=[false,false,false,false,false,false,false];for(var i=S;i>=Y;i--){if(c._show[i]){if(c._periods[i]){j[i]=true}else{j[i]=g>0;g--}}}var k=(c.options.compact?c.options.compactLabels:c.options.labels);var l=c.options.whichLabels||this._normalLabels;var m=function(a){var b=c.options['compactLabels'+l(c._periods[a])];return(h[a]?d._translateDigits(c,c._periods[a])+(b?b[a]:k[a])+' ':'')};var n=(c.options.padZeroes?2:1);var o=function(a){var b=c.options['labels'+l(c._periods[a])];return((!c.options.significant&&h[a])||(c.options.significant&&j[a])?'<span class="'+d._sectionClass+'">'+'<span class="'+d._amountClass+'">'+d._minDigits(c,c._periods[a],n)+'</span>'+'<span class="'+d._periodClass+'">'+(b?b[a]:k[a])+'</span></span>':'')};return(c.options.layout?this._buildLayout(c,h,c.options.layout,c.options.compact,c.options.significant,j):((c.options.compact?'<span class="'+this._rowClass+' '+this._amountClass+(c._hold?' '+this._holdingClass:'')+'">'+m(Y)+m(O)+m(W)+m(D)+(h[H]?this._minDigits(c,c._periods[H],2):'')+(h[M]?(h[H]?c.options.timeSeparator:'')+this._minDigits(c,c._periods[M],2):'')+(h[S]?(h[H]||h[M]?c.options.timeSeparator:'')+this._minDigits(c,c._periods[S],2):''):'<span class="'+this._rowClass+' '+this._showClass+(c.options.significant||f)+(c._hold?' '+this._holdingClass:'')+'">'+o(Y)+o(O)+o(W)+o(D)+o(H)+o(M)+o(S))+'</span>'+(c.options.description?'<span class="'+this._rowClass+' '+this._descrClass+'">'+c.options.description+'</span>':'')))},_buildLayout:function(c,d,e,f,g,h){var j=c.options[f?'compactLabels':'labels'];var k=c.options.whichLabels||this._normalLabels;var l=function(a){return(c.options[(f?'compactLabels':'labels')+k(c._periods[a])]||j)[a]};var m=function(a,b){return c.options.digits[Math.floor(a/b)%10]};var o={desc:c.options.description,sep:c.options.timeSeparator,yl:l(Y),yn:this._minDigits(c,c._periods[Y],1),ynn:this._minDigits(c,c._periods[Y],2),ynnn:this._minDigits(c,c._periods[Y],3),y1:m(c._periods[Y],1),y10:m(c._periods[Y],10),y100:m(c._periods[Y],100),y1000:m(c._periods[Y],1000),ol:l(O),on:this._minDigits(c,c._periods[O],1),onn:this._minDigits(c,c._periods[O],2),onnn:this._minDigits(c,c._periods[O],3),o1:m(c._periods[O],1),o10:m(c._periods[O],10),o100:m(c._periods[O],100),o1000:m(c._periods[O],1000),wl:l(W),wn:this._minDigits(c,c._periods[W],1),wnn:this._minDigits(c,c._periods[W],2),wnnn:this._minDigits(c,c._periods[W],3),w1:m(c._periods[W],1),w10:m(c._periods[W],10),w100:m(c._periods[W],100),w1000:m(c._periods[W],1000),dl:l(D),dn:this._minDigits(c,c._periods[D],1),dnn:this._minDigits(c,c._periods[D],2),dnnn:this._minDigits(c,c._periods[D],3),d1:m(c._periods[D],1),d10:m(c._periods[D],10),d100:m(c._periods[D],100),d1000:m(c._periods[D],1000),hl:l(H),hn:this._minDigits(c,c._periods[H],1),hnn:this._minDigits(c,c._periods[H],2),hnnn:this._minDigits(c,c._periods[H],3),h1:m(c._periods[H],1),h10:m(c._periods[H],10),h100:m(c._periods[H],100),h1000:m(c._periods[H],1000),ml:l(M),mn:this._minDigits(c,c._periods[M],1),mnn:this._minDigits(c,c._periods[M],2),mnnn:this._minDigits(c,c._periods[M],3),m1:m(c._periods[M],1),m10:m(c._periods[M],10),m100:m(c._periods[M],100),m1000:m(c._periods[M],1000),sl:l(S),sn:this._minDigits(c,c._periods[S],1),snn:this._minDigits(c,c._periods[S],2),snnn:this._minDigits(c,c._periods[S],3),s1:m(c._periods[S],1),s10:m(c._periods[S],10),s100:m(c._periods[S],100),s1000:m(c._periods[S],1000)};var p=e;for(var i=Y;i<=S;i++){var q='yowdhms'.charAt(i);var r=new RegExp('\\{'+q+'<\\}([\\s\\S]*)\\{'+q+'>\\}','g');p=p.replace(r,((!g&&d[i])||(g&&h[i])?'$1':''))}$.each(o,function(n,v){var a=new RegExp('\\{'+n+'\\}','g');p=p.replace(a,v)});return p},_minDigits:function(a,b,c){b=''+b;if(b.length>=c){return this._translateDigits(a,b)}b='0000000000'+b;return this._translateDigits(a,b.substr(b.length-c))},_translateDigits:function(b,c){return(''+c).replace(/[0-9]/g,function(a){return b.options.digits[a]})},_determineShow:function(a){var b=a.options.format;var c=[];c[Y]=(b.match('y')?'?':(b.match('Y')?'!':null));c[O]=(b.match('o')?'?':(b.match('O')?'!':null));c[W]=(b.match('w')?'?':(b.match('W')?'!':null));c[D]=(b.match('d')?'?':(b.match('D')?'!':null));c[H]=(b.match('h')?'?':(b.match('H')?'!':null));c[M]=(b.match('m')?'?':(b.match('M')?'!':null));c[S]=(b.match('s')?'?':(b.match('S')?'!':null));return c},_calculatePeriods:function(c,d,e,f){c._now=f;c._now.setMilliseconds(0);var g=new Date(c._now.getTime());if(c._since){if(f.getTime()<c._since.getTime()){c._now=f=g}else{f=c._since}}else{g.setTime(c._until.getTime());if(f.getTime()>c._until.getTime()){c._now=f=g}}var h=[0,0,0,0,0,0,0];if(d[Y]||d[O]){var i=this._getDaysInMonth(f.getFullYear(),f.getMonth());var j=this._getDaysInMonth(g.getFullYear(),g.getMonth());var k=(g.getDate()==f.getDate()||(g.getDate()>=Math.min(i,j)&&f.getDate()>=Math.min(i,j)));var l=function(a){return(a.getHours()*60+a.getMinutes())*60+a.getSeconds()};var m=Math.max(0,(g.getFullYear()-f.getFullYear())*12+g.getMonth()-f.getMonth()+((g.getDate()<f.getDate()&&!k)||(k&&l(g)<l(f))?-1:0));h[Y]=(d[Y]?Math.floor(m/12):0);h[O]=(d[O]?m-h[Y]*12:0);f=new Date(f.getTime());var n=(f.getDate()==i);var o=this._getDaysInMonth(f.getFullYear()+h[Y],f.getMonth()+h[O]);if(f.getDate()>o){f.setDate(o)}f.setFullYear(f.getFullYear()+h[Y]);f.setMonth(f.getMonth()+h[O]);if(n){f.setDate(o)}}var p=Math.floor((g.getTime()-f.getTime())/1000);var q=function(a,b){h[a]=(d[a]?Math.floor(p/b):0);p-=h[a]*b};q(W,604800);q(D,86400);q(H,3600);q(M,60);q(S,1);if(p>0&&!c._since){var r=[1,12,4.3482,7,24,60,60];var s=S;var t=1;for(var u=S;u>=Y;u--){if(d[u]){if(h[s]>=t){h[s]=0;p=1}if(p>0){h[u]++;p=0;s=u;t=1}}t*=r[u]}}if(e){for(var u=Y;u<=S;u++){if(e&&h[u]){e--}else if(!e){h[u]=0}}}return h}})})(jQuery);

;(function(window) {

	'use strict';

	// Helper vars and functions.
	function extend( a, b ) {
		for( var key in b ) {
			if( b.hasOwnProperty( key ) ) {
				a[key] = b[key];
			}
		}
		return a;
	}

	// from http://www.quirksmode.org/js/events_properties.html#position
	function getMousePos(e) {
		var posx = 0, posy = 0;
		if (!e) var e = window.event;
		if (e.pageX || e.pageY) 	{
			posx = e.pageX;
			posy = e.pageY;
		}
		else if (e.clientX || e.clientY) 	{
			posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
			posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
		}
		return { x : posx, y : posy }
	}

	/**
	 * gatsby_tiltfx obj.
	 */
	function gatsby_tiltfx(el, options) {
		this.DOM = {};
		this.DOM.el = el;
		this.options = extend({}, this.options);
		extend(this.options, options);
		this._init();
	}

	gatsby_tiltfx.prototype.options = {
		movement: {
			imgWrapper : {
				translation : {x: 0, y: 0, z: 0},
				rotation : {x: -5, y: 5, z: 0},
				reverseAnimation : {
					duration : 1200,
					easing : 'easeOutElastic',
					elasticity : 600
				}
			},
			lines : {
				translation : {x: 10, y: 10, z: [0,10]},
				reverseAnimation : {
					duration : 1000,
					easing : 'easeOutExpo',
					elasticity : 600
				}
			},
			caption : {
				translation : {x: 20, y: 20, z: 0},
				rotation : {x: 0, y: 0, z: 0},
				reverseAnimation : {
					duration : 1500,
					easing : 'easeOutElastic',
					elasticity : 600
				}
			}
		}
	};

	/**
	 * Init.
	 */
	gatsby_tiltfx.prototype._init = function() {
		this.DOM.animatable = {};
		this.DOM.animatable.imgWrapper = this.DOM.el.querySelector('.gt-tilter-figure');
		this.DOM.animatable.lines = this.DOM.el.querySelector('.gt-tilter-deco-lines');
		this.DOM.animatable.caption = this.DOM.el.querySelector('.gt-tilter-caption');
		this._initEvents();
	};

	/**
	 * Init/Bind events.
	 */
	gatsby_tiltfx.prototype._initEvents = function() {
		var self = this;

		this.mouseenterFn = function() {
			for(var key in self.DOM.animatable) {
				anime.remove(self.DOM.animatable[key]);
			}
		};

		this.mousemoveFn = function(ev) {
			requestAnimationFrame(function() { self._layout(ev); });
		};

		this.mouseleaveFn = function(ev) {
			requestAnimationFrame(function() {
				for(var key in self.DOM.animatable) {
					if( self.options.movement[key] == undefined ) {continue;}
					anime({
						targets: self.DOM.animatable[key],
						duration: self.options.movement[key].reverseAnimation != undefined ? self.options.movement[key].reverseAnimation.duration || 0 : 1,
						easing: self.options.movement[key].reverseAnimation != undefined ? self.options.movement[key].reverseAnimation.easing || 'linear' : 'linear',
						elasticity: self.options.movement[key].reverseAnimation != undefined ? self.options.movement[key].reverseAnimation.elasticity || null : null,
						scaleX: 1,
						scaleY: 1,
						scaleZ: 1,
						translateX: 0,
						translateY: 0,
						translateZ: 0,
						rotateX: 0,
						rotateY: 0,
						rotateZ: 0
					});
				}
			});
		};

		this.DOM.el.addEventListener('mousemove', this.mousemoveFn);
		this.DOM.el.addEventListener('mouseleave', this.mouseleaveFn);
		this.DOM.el.addEventListener('mouseenter', this.mouseenterFn);
	};

	gatsby_tiltfx.prototype._layout = function(ev) {
		// Mouse position relative to the document.
		var mousepos = getMousePos(ev),
		// Document scrolls.
			docScrolls = {left : document.body.scrollLeft + document.documentElement.scrollLeft, top : document.body.scrollTop + document.documentElement.scrollTop},
			bounds = this.DOM.el.getBoundingClientRect(),
		// Mouse position relative to the main element (this.DOM.el).
			relmousepos = { x : mousepos.x - bounds.left - docScrolls.left, y : mousepos.y - bounds.top - docScrolls.top };

		// Movement settings for the animatable elements.
		for(var key in this.DOM.animatable) {
			if( this.DOM.animatable[key] == undefined || this.options.movement[key] == undefined ) {
				continue;
			}
			var t = this.options.movement[key] != undefined ? this.options.movement[key].translation || {x:0,y:0,z:0} : {x:0,y:0,z:0},
				r = this.options.movement[key] != undefined ? this.options.movement[key].rotation || {x:0,y:0,z:0} : {x:0,y:0,z:0},
				setRange = function (obj) {
					for(var k in obj) {
						if( obj[k] == undefined ) {
							obj[k] = [0,0];
						}
						else if( typeof obj[k] === 'number' ) {
							obj[k] = [-1*obj[k],obj[k]];
						}
					}
				};

			setRange(t);
			setRange(r);

			var transforms = {
				translation : {
					x: (t.x[1]-t.x[0])/bounds.width*relmousepos.x + t.x[0],
					y: (t.y[1]-t.y[0])/bounds.height*relmousepos.y + t.y[0],
					z: (t.z[1]-t.z[0])/bounds.height*relmousepos.y + t.z[0],
				},
				rotation : {
					x: (r.x[1]-r.x[0])/bounds.height*relmousepos.y + r.x[0],
					y: (r.y[1]-r.y[0])/bounds.width*relmousepos.x + r.y[0],
					z: (r.z[1]-r.z[0])/bounds.width*relmousepos.x + r.z[0]
				}
			};

			this.DOM.animatable[key].style.WebkitTransform = this.DOM.animatable[key].style.transform = 'translateX(' + transforms.translation.x + 'px) translateY(' + transforms.translation.y + 'px) translateZ(' + transforms.translation.z + 'px) rotateX(' + transforms.rotation.x + 'deg) rotateY(' + transforms.rotation.y + 'deg) rotateZ(' + transforms.rotation.z + 'deg)';
		}
	};

	window.gatsby_tiltfx = gatsby_tiltfx;

})(window);

;(function($){
	'use strict';

	function gatsby_accordion(element, options){

		this.el = element;

		this.config = {
			toggle: false,
			easing: 'linear',
			speed: 350,
			afterOpen: function(){},
			afterClose: function(){},
			cssPrefix: ''
		};

		options = options || {};

		$.extend(this.config, options);

		this.titleClass = this.config.toggle ? this.config.cssPrefix + 'accordion-title' : this.config.cssPrefix + 'accordion-title';
		this.defClass = this.config.toggle ? this.config.cssPrefix + 'accordion-definition' : this.config.cssPrefix + 'accordion-definition';
		this.activeClass = this.config.cssPrefix + 'active';

		this.toDefaultState();
		this.bindEvents();

	}

	gatsby_accordion.prototype.toDefaultState = function(){

		var active = this.el.find('.' + this.activeClass);

		if(!active.length){
			active = this.el.find('.' + this.titleClass).eq(0).addClass(this.activeClass);
		}

		if(this.config.toggle){

			this.el.find('.' + this.titleClass)
				.next('.' + this.defClass)
				.hide();

			active
				.next('.' + this.defClass)
				.show();

			return false;
		}

		active
			.next('.' + this.defClass)
			.siblings('.' + this.defClass)
			.hide();

	}

	gatsby_accordion.prototype.bindEvents = function(){

		var self = this;

		this.el.on('click', '.' + self.titleClass, function(e){

			var title = $(this);

			e.preventDefault();

			if(self.config.toggle){
				self.toggleHandler(title);
			}
			else{
				self.accordionHandler(title);
			}

		});

	}

	gatsby_accordion.prototype.accordionHandler = function(title){

		var $this = title,
			self = this;

		if($this.hasClass(self.activeClass)){

			$this
				.removeClass(self.activeClass)
				.next('.'+ self.defClass)
				.stop()
				.slideUp({
					duration: self.config.speed,
					easing: self.config.easing,
					complete: self.config.afterClose.bind($this.next('.' + self.defClass))
				});

			return false;
		}

		$this
			.addClass(self.activeClass)
			.next('.' + self.defClass)
			.stop()
			.slideDown({
				duration: self.config.speed,
				easing: self.config.easing,
				complete: self.config.afterOpen.bind($this.next('.' + self.defClass))
			})
			.siblings('.' + self.defClass)
			.stop()
			.slideUp({
				duration: self.config.speed,
				easing: self.config.easing,
				complete: self.config.afterClose.bind($this.next('.' + self.defClass))
			})
			.prev('.' + self.titleClass)
			.removeClass(self.activeClass);

	}

	gatsby_accordion.prototype.toggleHandler = function(title){

		var $this = title,
			self = this;

		if($this.hasClass(self.activeClass)){

			$this
				.removeClass(self.activeClass)
				.next('.' + self.defClass)
				.stop()
				.slideUp({
					duration: self.config.speed,
					easing: self.config.easing,
					complete: self.config.afterClose.bind($this.next('.' + self.defClass))
				});

		}
		else{
			$this
				.addClass(self.activeClass)
				.next('.' + self.defClass)
				.stop()
				.slideDown({
					duration: self.config.speed,
					easing: self.config.easing,
					complete: self.config.afterOpen.bind($this.next(self.defClass))
				});
		}

	}

	$.fn.gatsby_accordion = function(options){

		return this.each(function(){

			var $this = $(this);

			if(!$this.data('accordion')){
				$this.data('accordion', new gatsby_accordion($this, options));
			}

		});

	}

}(jQuery));

/**
 * WTAudio
 * @author WingArt team
 * @version 1.0.0
 * @license The MIT License (MIT)
 */

;(function($, window, document){

	"use strict";

	/**
	 * Creates a player.
	 * @class The WTAudio.
	 * @public
	 * @param {HTMLElement|jQuery} element - The element to create the player for.
	 * @param {Object} [options] - The options
	 */
	function WTAudio(element, options){

		/**
		 * Current options set by the caller including defaults.
		 * @public
		 */
		this.options = $.extend({}, WTAudio.defaults, options);

		this.ISRTL = getComputedStyle(document.body).direction === "rtl";

		/**
		 * Plugin element.
		 * @public
		 */
		this.$element = $(element);

		this.AudioEl = this.$element['context'];

		this.controls = {};

		this.setup();

	}

	/**
	 * Default options for the player.
	 * @public
	 */
	WTAudio.defaults = {

		controls: {
			playPause: true,
			currentTime: true,
			fullTime: true,
			muteButton: true,
			volumeBar: true
		},
		autoplay: false,
		loop: false

	}

	/**
	 * Setups the current settings.
	 * @public
	 */
	WTAudio.prototype.setup = function(){

		this.generateMarkup();
		this.eventsCall();

	}

	/**
	 * Create HTML Markup for the player
	 * @public
	 */
	WTAudio.prototype.generateMarkup = function(){

		var markup = [];

		var self = this;

		markup.push("<div class='wt_container'>");

		if(this.options.controls.playPause){
			markup.push("<div class='wt_section wt_play_btn_section' style='width: 28px;'><button class='wt_play_pause'></button></div>");
		}
		if(this.options.controls.currentTime){
			markup.push("<div class='wt_section wt_current_time_section' style='width: 42px;'><div class='wt_current_time'>00:00</div></div>");
		}

		markup.push("<div class='wt_section wt_timebar_section'><div class='wt_timebar'><div class='wt_indicator'></div></div></div>");

		if(this.options.controls.fullTime){
			markup.push("<div class='wt_section wt_full_time_section' style='width: 45px;'><div class='wt_full_time'>"+this.formattingTime(this.AudioEl.duration)+"</div></div>");
		}

		if(this.options.controls.muteButton){
			markup.push("<div class='wt_section wt_mute_btn_section' style='width: 30px;'><button class='wt_mute'></button></div>");
		}

		if(this.options.controls.volumeBar){
			markup.push("<div class='wt_section wt_volumebar_section' style='width: 48px;'><div class='wt_volumebar'><div class='wt_indicator' style='width:" + this.AudioEl.volume * 100 + "%;'></div></div></div>")
		}

		markup.push("</div>");

		this.$element.before(markup.join(""));
		this.$element.hide();

		this.storeControls();

	}

	WTAudio.prototype.storeControls = function(){

		this.$container = this.$element.prev('.wt_container');

		this.controls.playPauseBtn = this.$container.find('.wt_play_pause');
		this.controls.muteBtn = this.$container.find('.wt_mute');
		this.controls.timeBar = this.$container.find('.wt_timebar');
		this.controls.currentTimeBar = this.$container.find('.wt_current_time');
		this.controls.timeBarIndicator = this.controls.timeBar.find('.wt_indicator');
		this.controls.volumeBar = this.$container.find('.wt_volumebar');
		this.controls.volumeBarIndicator = this.controls.volumeBar.find('.wt_indicator');

	}

	/**
	 * Save internal event references and add event based functions.
	 * @protected
	 */
	WTAudio.prototype.eventsCall = function(){

		if(this.options.controls.playPause){
			this.controls.playPauseBtn.on('click.play_pause', this.onPlayPause.bind(this));
		}
		if(this.options.controls.muteButton){
			this.controls.muteBtn.on('click.mute', this.onMute.bind(this));
		}
		if(this.options.controls.volumeBar){
			this.controls.volumeBar.on('click.volume', this.onChangeVolume.bind(this));
		}

		this.controls.timeBar.on('click.changecurrenttime', this.onChangeCurrentTime.bind(this));

	};

	/**
	 * Handles the play/pause event.
	 * @todo Simplify
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
	WTAudio.prototype.onPlayPause = function(e){

		if(this.AudioEl.paused){
			this.AudioEl.play();
			this.fillCurrentTime();
			this.$container.addClass('playing');
		}
		else{
			this.AudioEl.pause();
			this.stopCurrentTime();
			this.$container.removeClass('playing');
		}

	}

	/**
	 * Handles the mute event.
	 * @todo Simplify
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
	WTAudio.prototype.onMute = function(e){

		if(this.AudioEl.muted){

			this.AudioEl.muted = false;
			this.controls.muteBtn.removeClass('muted');
			this.controls.volumeBarIndicator.css('width', this.volumeState * 100 + '%');

		}
		else{

			this.volumeState = this.AudioEl.volume;
			this.controls.volumeBarIndicator.css('width','0%');

			this.AudioEl.muted = true;
			this.controls.muteBtn.addClass('muted');

		}

	}

	/**
	 * Handles the change current time event.
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
	WTAudio.prototype.onChangeCurrentTime = function(e){

		var ePosition = this.ISRTL ?
			this.controls.timeBar.offset().left + this.controls.timeBar.outerWidth() - e.pageX :
			e.pageX - this.controls.timeBar.offset().left,
			tBWidth = this.controls.timeBar.outerWidth(),
			percent = ePosition / tBWidth * 100,
			resultTime = this.AudioEl.duration * percent / 100;

		this.AudioEl.currentTime = resultTime;
		this.fillCurrentTime();

	}

	/**
	 * Handles the change volume event.
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
	WTAudio.prototype.onChangeVolume = function(e){

		var ePosition = this.ISRTL ?
			this.controls.volumeBar.offset().left + this.controls.volumeBar.outerWidth() - e.pageX :
			e.pageX - this.controls.volumeBar.offset().left,
			vBWidth = this.controls.volumeBar.outerWidth(),
			percent = ePosition / vBWidth * 100;

		this.AudioEl.volume = percent / 100;
		this.controls.volumeBarIndicator.css('width', percent + '%');

	}

	/**
	 * Formatting current time for the timebar
	 * @protected
	 * @param Number seconds - the current time of audi track in seconds.
	 */
	WTAudio.prototype.formattingTime = function(seconds){

		var fMinutes = new Number(0),
			fSeconds = new Number(0);

		if(seconds > 60){
			fMinutes = Math.floor(seconds / 60);
			fSeconds = Math.floor(seconds % 60);
		}
		else fSeconds = Math.floor(seconds);

		if(fMinutes < 10) return "0" + fMinutes.toString() + ":" + (fSeconds < 10 ? "0" + fSeconds.toString() : fSeconds);

		return fMinutes.toString() + ":" + (fSeconds < 10 ? "0" + fSeconds.toString() : fSeconds);

	}


	/**
	 * Calculates current time for the timebar
	 * @protected
	 */
	WTAudio.prototype.fillCurrentTime = function(){

		var self = this,
			elWidth = self.controls.timeBar.outerWidth(),
			percent;

		self.currentTimeInterval = setInterval(function(){

			percent = self.AudioEl.currentTime / self.AudioEl.duration * 100;

			self.controls.currentTimeBar.text(self.formattingTime(self.AudioEl.currentTime));
			self.controls.timeBarIndicator.css('width', percent + '%');

			if(self.AudioEl.ended && !self.options.loop){
				self.controls.currentTimeBar.text("00:00");
				self.controls.timeBarIndicator.css('width', '0%');
				self.$container.removeClass('playing');
			}

		},10);

	}


	/**
	 * Stop calculates current time for the timebar
	 * @protected
	 */
	WTAudio.prototype.stopCurrentTime = function(){

		if(this.currentTimeInterval) clearInterval(this.currentTimeInterval);

	}

	/**
	 * The jQuery Plugin for the WTAudio Player
	 * @public
	 */
	$.fn.WTAudio = function(options){

		return this.each(function(){

			if(!$(this).data('WTAudio')){
				$(this).data('WTAudio', new WTAudio(this, options));
			}

		});

	}

})(window.jQuery, window, document);

!function(a,b,c,d){function e(b,c){this.settings=null,this.options=a.extend({},e.Defaults,c),this.$element=a(b),this.drag=a.extend({},m),this.state=a.extend({},n),this.e=a.extend({},o),this._plugins={},this._supress={},this._current=null,this._speed=null,this._coordinates=[],this._breakpoint=null,this._width=null,this._items=[],this._clones=[],this._mergers=[],this._invalidated={},this._pipe=[],a.each(e.Plugins,a.proxy(function(a,b){this._plugins[a[0].toLowerCase()+a.slice(1)]=new b(this)},this)),a.each(e.Pipe,a.proxy(function(b,c){this._pipe.push({filter:c.filter,run:a.proxy(c.run,this)})},this)),this.setup(),this.initialize()}function f(a){if(a.touches!==d)return{x:a.touches[0].pageX,y:a.touches[0].pageY};if(a.touches===d){if(a.pageX!==d)return{x:a.pageX,y:a.pageY};if(a.pageX===d)return{x:a.clientX,y:a.clientY}}}function g(a){var b,d,e=c.createElement("div"),f=a;for(b in f)if(d=f[b],"undefined"!=typeof e.style[d])return e=null,[d,b];return[!1]}function h(){return g(["transition","WebkitTransition","MozTransition","OTransition"])[1]}function i(){return g(["transform","WebkitTransform","MozTransform","OTransform","msTransform"])[0]}function j(){return g(["perspective","webkitPerspective","MozPerspective","OPerspective","MsPerspective"])[0]}function k(){return"ontouchstart"in b||!!navigator.msMaxTouchPoints}function l(){return b.navigator.msPointerEnabled}var m,n,o;m={start:0,startX:0,startY:0,current:0,currentX:0,currentY:0,offsetX:0,offsetY:0,distance:null,startTime:0,endTime:0,updatedX:0,targetEl:null},n={isTouch:!1,isScrolling:!1,isSwiping:!1,direction:!1,inMotion:!1},o={_onDragStart:null,_onDragMove:null,_onDragEnd:null,_transitionEnd:null,_resizer:null,_responsiveCall:null,_goToLoop:null,_checkVisibile:null},e.Defaults={items:3,loop:!1,center:!1,mouseDrag:!0,touchDrag:!0,pullDrag:!0,freeDrag:!1,margin:0,stagePadding:0,merge:!1,mergeFit:!0,autoWidth:!1,startPosition:0,rtl:!1,smartSpeed:250,fluidSpeed:!1,dragEndSpeed:!1,responsive:{},responsiveRefreshRate:200,responsiveBaseElement:b,responsiveClass:!1,fallbackEasing:"swing",info:!1,nestedItemSelector:!1,itemElement:"div",stageElement:"div",themeClass:"owl-theme",baseClass:"owl-carousel",itemClass:"owl-item",centerClass:"center",activeClass:"active"},e.Width={Default:"default",Inner:"inner",Outer:"outer"},e.Plugins={},e.Pipe=[{filter:["width","items","settings"],run:function(a){a.current=this._items&&this._items[this.relative(this._current)]}},{filter:["items","settings"],run:function(){var a=this._clones,b=this.$stage.children(".cloned");(b.length!==a.length||!this.settings.loop&&a.length>0)&&(this.$stage.children(".cloned").remove(),this._clones=[])}},{filter:["items","settings"],run:function(){var a,b,c=this._clones,d=this._items,e=this.settings.loop?c.length-Math.max(2*this.settings.items,4):0;for(a=0,b=Math.abs(e/2);b>a;a++)e>0?(this.$stage.children().eq(d.length+c.length-1).remove(),c.pop(),this.$stage.children().eq(0).remove(),c.pop()):(c.push(c.length/2),this.$stage.append(d[c[c.length-1]].clone().addClass("cloned")),c.push(d.length-1-(c.length-1)/2),this.$stage.prepend(d[c[c.length-1]].clone().addClass("cloned")))}},{filter:["width","items","settings"],run:function(){var a,b,c,d=this.settings.rtl?1:-1,e=(this.width()/this.settings.items).toFixed(3),f=0;for(this._coordinates=[],b=0,c=this._clones.length+this._items.length;c>b;b++)a=this._mergers[this.relative(b)],a=this.settings.mergeFit&&Math.min(a,this.settings.items)||a,f+=(this.settings.autoWidth?this._items[this.relative(b)].width()+this.settings.margin:e*a)*d,this._coordinates.push(f)}},{filter:["width","items","settings"],run:function(){var b,c,d=(this.width()/this.settings.items).toFixed(3),e={width:Math.abs(this._coordinates[this._coordinates.length-1])+2*this.settings.stagePadding,"padding-left":this.settings.stagePadding||"","padding-right":this.settings.stagePadding||""};if(this.$stage.css(e),e={width:this.settings.autoWidth?"auto":d-this.settings.margin},e[this.settings.rtl?"margin-left":"margin-right"]=this.settings.margin,!this.settings.autoWidth&&a.grep(this._mergers,function(a){return a>1}).length>0)for(b=0,c=this._coordinates.length;c>b;b++)e.width=Math.abs(this._coordinates[b])-Math.abs(this._coordinates[b-1]||0)-this.settings.margin,this.$stage.children().eq(b).css(e);else this.$stage.children().css(e)}},{filter:["width","items","settings"],run:function(a){a.current&&this.reset(this.$stage.children().index(a.current))}},{filter:["position"],run:function(){this.animate(this.coordinates(this._current))}},{filter:["width","position","items","settings"],run:function(){var a,b,c,d,e=this.settings.rtl?1:-1,f=2*this.settings.stagePadding,g=this.coordinates(this.current())+f,h=g+this.width()*e,i=[];for(c=0,d=this._coordinates.length;d>c;c++)a=this._coordinates[c-1]||0,b=Math.abs(this._coordinates[c])+f*e,(this.op(a,"<=",g)&&this.op(a,">",h)||this.op(b,"<",g)&&this.op(b,">",h))&&i.push(c);this.$stage.children("."+this.settings.activeClass).removeClass(this.settings.activeClass),this.$stage.children(":eq("+i.join("), :eq(")+")").addClass(this.settings.activeClass),this.settings.center&&(this.$stage.children("."+this.settings.centerClass).removeClass(this.settings.centerClass),this.$stage.children().eq(this.current()).addClass(this.settings.centerClass))}}],e.prototype.initialize=function(){if(this.trigger("initialize"),this.$element.addClass(this.settings.baseClass).addClass(this.settings.themeClass).toggleClass("owl-rtl",this.settings.rtl),this.browserSupport(),this.settings.autoWidth&&this.state.imagesLoaded!==!0){var b,c,e;if(b=this.$element.find("img"),c=this.settings.nestedItemSelector?"."+this.settings.nestedItemSelector:d,e=this.$element.children(c).width(),b.length&&0>=e)return this.preloadAutoWidthImages(b),!1}this.$element.addClass("owl-loading"),this.$stage=a("<"+this.settings.stageElement+' class="owl-stage"/>').wrap('<div class="owl-stage-outer">'),this.$element.append(this.$stage.parent()),this.replace(this.$element.children().not(this.$stage.parent())),this._width=this.$element.width(),this.refresh(),this.$element.removeClass("owl-loading").addClass("owl-loaded"),this.eventsCall(),this.internalEvents(),this.addTriggerableEvents(),this.trigger("initialized")},e.prototype.setup=function(){var b=this.viewport(),c=this.options.responsive,d=-1,e=null;c?(a.each(c,function(a){b>=a&&a>d&&(d=Number(a))}),e=a.extend({},this.options,c[d]),delete e.responsive,e.responsiveClass&&this.$element.attr("class",function(a,b){return b.replace(/\b owl-responsive-\S+/g,"")}).addClass("owl-responsive-"+d)):e=a.extend({},this.options),(null===this.settings||this._breakpoint!==d)&&(this.trigger("change",{property:{name:"settings",value:e}}),this._breakpoint=d,this.settings=e,this.invalidate("settings"),this.trigger("changed",{property:{name:"settings",value:this.settings}}))},e.prototype.optionsLogic=function(){this.$element.toggleClass("owl-center",this.settings.center),this.settings.loop&&this._items.length<this.settings.items&&(this.settings.loop=!1),this.settings.autoWidth&&(this.settings.stagePadding=!1,this.settings.merge=!1)},e.prototype.prepare=function(b){var c=this.trigger("prepare",{content:b});return c.data||(c.data=a("<"+this.settings.itemElement+"/>").addClass(this.settings.itemClass).append(b)),this.trigger("prepared",{content:c.data}),c.data},e.prototype.update=function(){for(var b=0,c=this._pipe.length,d=a.proxy(function(a){return this[a]},this._invalidated),e={};c>b;)(this._invalidated.all||a.grep(this._pipe[b].filter,d).length>0)&&this._pipe[b].run(e),b++;this._invalidated={}},e.prototype.width=function(a){switch(a=a||e.Width.Default){case e.Width.Inner:case e.Width.Outer:return this._width;default:return this._width-2*this.settings.stagePadding+this.settings.margin}},e.prototype.refresh=function(){if(0===this._items.length)return!1;(new Date).getTime();this.trigger("refresh"),this.setup(),this.optionsLogic(),this.$stage.addClass("owl-refresh"),this.update(),this.$stage.removeClass("owl-refresh"),this.state.orientation=b.orientation,this.watchVisibility(),this.trigger("refreshed")},e.prototype.eventsCall=function(){this.e._onDragStart=a.proxy(function(a){this.onDragStart(a)},this),this.e._onDragMove=a.proxy(function(a){this.onDragMove(a)},this),this.e._onDragEnd=a.proxy(function(a){this.onDragEnd(a)},this),this.e._onResize=a.proxy(function(a){this.onResize(a)},this),this.e._transitionEnd=a.proxy(function(a){this.transitionEnd(a)},this),this.e._preventClick=a.proxy(function(a){this.preventClick(a)},this)},e.prototype.onThrottledResize=function(){b.clearTimeout(this.resizeTimer),this.resizeTimer=b.setTimeout(this.e._onResize,this.settings.responsiveRefreshRate)},e.prototype.onResize=function(){return this._items.length?this._width===this.$element.width()?!1:this.trigger("resize").isDefaultPrevented()?!1:(this._width=this.$element.width(),this.invalidate("width"),this.refresh(),void this.trigger("resized")):!1},e.prototype.eventsRouter=function(a){var b=a.type;"mousedown"===b||"touchstart"===b?this.onDragStart(a):"mousemove"===b||"touchmove"===b?this.onDragMove(a):"mouseup"===b||"touchend"===b?this.onDragEnd(a):"touchcancel"===b&&this.onDragEnd(a)},e.prototype.internalEvents=function(){var c=(k(),l());this.settings.mouseDrag?(this.$stage.on("mousedown",a.proxy(function(a){this.eventsRouter(a)},this)),this.$stage.on("dragstart",function(){return!1}),this.$stage.get(0).onselectstart=function(){return!1}):this.$element.addClass("owl-text-select-on"),this.settings.touchDrag&&!c&&this.$stage.on("touchstart touchcancel",a.proxy(function(a){this.eventsRouter(a)},this)),this.transitionEndVendor&&this.on(this.$stage.get(0),this.transitionEndVendor,this.e._transitionEnd,!1),this.settings.responsive!==!1&&this.on(b,"resize",a.proxy(this.onThrottledResize,this))},e.prototype.onDragStart=function(d){var e,g,h,i;if(e=d.originalEvent||d||b.event,3===e.which||this.state.isTouch)return!1;if("mousedown"===e.type&&this.$stage.addClass("owl-grab"),this.trigger("drag"),this.drag.startTime=(new Date).getTime(),this.speed(0),this.state.isTouch=!0,this.state.isScrolling=!1,this.state.isSwiping=!1,this.drag.distance=0,g=f(e).x,h=f(e).y,this.drag.offsetX=this.$stage.position().left,this.drag.offsetY=this.$stage.position().top,this.settings.rtl&&(this.drag.offsetX=this.$stage.position().left+this.$stage.width()-this.width()+this.settings.margin),this.state.inMotion&&this.support3d)i=this.getTransformProperty(),this.drag.offsetX=i,this.animate(i),this.state.inMotion=!0;else if(this.state.inMotion&&!this.support3d)return this.state.inMotion=!1,!1;this.drag.startX=g-this.drag.offsetX,this.drag.startY=h-this.drag.offsetY,this.drag.start=g-this.drag.startX,this.drag.targetEl=e.target||e.srcElement,this.drag.updatedX=this.drag.start,("IMG"===this.drag.targetEl.tagName||"A"===this.drag.targetEl.tagName)&&(this.drag.targetEl.draggable=!1),a(c).on("mousemove.owl.dragEvents mouseup.owl.dragEvents touchmove.owl.dragEvents touchend.owl.dragEvents",a.proxy(function(a){this.eventsRouter(a)},this))},e.prototype.onDragMove=function(a){var c,e,g,h,i,j;this.state.isTouch&&(this.state.isScrolling||(c=a.originalEvent||a||b.event,e=f(c).x,g=f(c).y,this.drag.currentX=e-this.drag.startX,this.drag.currentY=g-this.drag.startY,this.drag.distance=this.drag.currentX-this.drag.offsetX,this.drag.distance<0?this.state.direction=this.settings.rtl?"right":"left":this.drag.distance>0&&(this.state.direction=this.settings.rtl?"left":"right"),this.settings.loop?this.op(this.drag.currentX,">",this.coordinates(this.minimum()))&&"right"===this.state.direction?this.drag.currentX-=(this.settings.center&&this.coordinates(0))-this.coordinates(this._items.length):this.op(this.drag.currentX,"<",this.coordinates(this.maximum()))&&"left"===this.state.direction&&(this.drag.currentX+=(this.settings.center&&this.coordinates(0))-this.coordinates(this._items.length)):(h=this.coordinates(this.settings.rtl?this.maximum():this.minimum()),i=this.coordinates(this.settings.rtl?this.minimum():this.maximum()),j=this.settings.pullDrag?this.drag.distance/5:0,this.drag.currentX=Math.max(Math.min(this.drag.currentX,h+j),i+j)),(this.drag.distance>8||this.drag.distance<-8)&&(c.preventDefault!==d?c.preventDefault():c.returnValue=!1,this.state.isSwiping=!0),this.drag.updatedX=this.drag.currentX,(this.drag.currentY>16||this.drag.currentY<-16)&&this.state.isSwiping===!1&&(this.state.isScrolling=!0,this.drag.updatedX=this.drag.start),this.animate(this.drag.updatedX)))},e.prototype.onDragEnd=function(b){var d,e,f;if(this.state.isTouch){if("mouseup"===b.type&&this.$stage.removeClass("owl-grab"),this.trigger("dragged"),this.drag.targetEl.removeAttribute("draggable"),this.state.isTouch=!1,this.state.isScrolling=!1,this.state.isSwiping=!1,0===this.drag.distance&&this.state.inMotion!==!0)return this.state.inMotion=!1,!1;this.drag.endTime=(new Date).getTime(),d=this.drag.endTime-this.drag.startTime,e=Math.abs(this.drag.distance),(e>3||d>300)&&this.removeClick(this.drag.targetEl),f=this.closest(this.drag.updatedX),this.speed(this.settings.dragEndSpeed||this.settings.smartSpeed),this.current(f),this.invalidate("position"),this.update(),this.settings.pullDrag||this.drag.updatedX!==this.coordinates(f)||this.transitionEnd(),this.drag.distance=0,a(c).off(".owl.dragEvents")}},e.prototype.removeClick=function(c){this.drag.targetEl=c,a(c).on("click.preventClick",this.e._preventClick),b.setTimeout(function(){a(c).off("click.preventClick")},300)},e.prototype.preventClick=function(b){b.preventDefault?b.preventDefault():b.returnValue=!1,b.stopPropagation&&b.stopPropagation(),a(b.target).off("click.preventClick")},e.prototype.getTransformProperty=function(){var a,c;return a=b.getComputedStyle(this.$stage.get(0),null).getPropertyValue(this.vendorName+"transform"),a=a.replace(/matrix(3d)?\(|\)/g,"").split(","),c=16===a.length,c!==!0?a[4]:a[12]},e.prototype.closest=function(b){var c=-1,d=30,e=this.width(),f=this.coordinates();return this.settings.freeDrag||a.each(f,a.proxy(function(a,g){return b>g-d&&g+d>b?c=a:this.op(b,"<",g)&&this.op(b,">",f[a+1]||g-e)&&(c="left"===this.state.direction?a+1:a),-1===c},this)),this.settings.loop||(this.op(b,">",f[this.minimum()])?c=b=this.minimum():this.op(b,"<",f[this.maximum()])&&(c=b=this.maximum())),c},e.prototype.animate=function(b){this.trigger("translate"),this.state.inMotion=this.speed()>0,this.support3d?this.$stage.css({transform:"translate3d("+b+"px,0px, 0px)",transition:this.speed()/1e3+"s"}):this.state.isTouch?this.$stage.css({left:b+"px"}):this.$stage.animate({left:b},this.speed()/1e3,this.settings.fallbackEasing,a.proxy(function(){this.state.inMotion&&this.transitionEnd()},this))},e.prototype.current=function(a){if(a===d)return this._current;if(0===this._items.length)return d;if(a=this.normalize(a),this._current!==a){var b=this.trigger("change",{property:{name:"position",value:a}});b.data!==d&&(a=this.normalize(b.data)),this._current=a,this.invalidate("position"),this.trigger("changed",{property:{name:"position",value:this._current}})}return this._current},e.prototype.invalidate=function(a){this._invalidated[a]=!0},e.prototype.reset=function(a){a=this.normalize(a),a!==d&&(this._speed=0,this._current=a,this.suppress(["translate","translated"]),this.animate(this.coordinates(a)),this.release(["translate","translated"]))},e.prototype.normalize=function(b,c){var e=c?this._items.length:this._items.length+this._clones.length;return!a.isNumeric(b)||1>e?d:b=this._clones.length?(b%e+e)%e:Math.max(this.minimum(c),Math.min(this.maximum(c),b))},e.prototype.relative=function(a){return a=this.normalize(a),a-=this._clones.length/2,this.normalize(a,!0)},e.prototype.maximum=function(a){var b,c,d,e=0,f=this.settings;if(a)return this._items.length-1;if(!f.loop&&f.center)b=this._items.length-1;else if(f.loop||f.center)if(f.loop||f.center)b=this._items.length+f.items;else{if(!f.autoWidth&&!f.merge)throw"Can not detect maximum absolute position.";for(revert=f.rtl?1:-1,c=this.$stage.width()-this.$element.width();(d=this.coordinates(e))&&!(d*revert>=c);)b=++e}else b=this._items.length-f.items;return b},e.prototype.minimum=function(a){return a?0:this._clones.length/2},e.prototype.items=function(a){return a===d?this._items.slice():(a=this.normalize(a,!0),this._items[a])},e.prototype.mergers=function(a){return a===d?this._mergers.slice():(a=this.normalize(a,!0),this._mergers[a])},e.prototype.clones=function(b){var c=this._clones.length/2,e=c+this._items.length,f=function(a){return a%2===0?e+a/2:c-(a+1)/2};return b===d?a.map(this._clones,function(a,b){return f(b)}):a.map(this._clones,function(a,c){return a===b?f(c):null})},e.prototype.speed=function(a){return a!==d&&(this._speed=a),this._speed},e.prototype.coordinates=function(b){var c=null;return b===d?a.map(this._coordinates,a.proxy(function(a,b){return this.coordinates(b)},this)):(this.settings.center?(c=this._coordinates[b],c+=(this.width()-c+(this._coordinates[b-1]||0))/2*(this.settings.rtl?-1:1)):c=this._coordinates[b-1]||0,c)},e.prototype.duration=function(a,b,c){return Math.min(Math.max(Math.abs(b-a),1),6)*Math.abs(c||this.settings.smartSpeed)},e.prototype.to=function(c,d){if(this.settings.loop){var e=c-this.relative(this.current()),f=this.current(),g=this.current(),h=this.current()+e,i=0>g-h?!0:!1,j=this._clones.length+this._items.length;h<this.settings.items&&i===!1?(f=g+this._items.length,this.reset(f)):h>=j-this.settings.items&&i===!0&&(f=g-this._items.length,this.reset(f)),b.clearTimeout(this.e._goToLoop),this.e._goToLoop=b.setTimeout(a.proxy(function(){this.speed(this.duration(this.current(),f+e,d)),this.current(f+e),this.update()},this),30)}else this.speed(this.duration(this.current(),c,d)),this.current(c),this.update()},e.prototype.next=function(a){a=a||!1,this.to(this.relative(this.current())+1,a)},e.prototype.prev=function(a){a=a||!1,this.to(this.relative(this.current())-1,a)},e.prototype.transitionEnd=function(a){return a!==d&&(a.stopPropagation(),(a.target||a.srcElement||a.originalTarget)!==this.$stage.get(0))?!1:(this.state.inMotion=!1,void this.trigger("translated"))},e.prototype.viewport=function(){var d;if(this.options.responsiveBaseElement!==b)d=a(this.options.responsiveBaseElement).width();else if(b.innerWidth)d=b.innerWidth;else{if(!c.documentElement||!c.documentElement.clientWidth)throw"Can not detect viewport width.";d=c.documentElement.clientWidth}return d},e.prototype.replace=function(b){this.$stage.empty(),this._items=[],b&&(b=b instanceof jQuery?b:a(b)),this.settings.nestedItemSelector&&(b=b.find("."+this.settings.nestedItemSelector)),b.filter(function(){return 1===this.nodeType}).each(a.proxy(function(a,b){b=this.prepare(b),this.$stage.append(b),this._items.push(b),this._mergers.push(1*b.find("[data-merge]").andSelf("[data-merge]").attr("data-merge")||1)},this)),this.reset(a.isNumeric(this.settings.startPosition)?this.settings.startPosition:0),this.invalidate("items")},e.prototype.add=function(a,b){b=b===d?this._items.length:this.normalize(b,!0),this.trigger("add",{content:a,position:b}),0===this._items.length||b===this._items.length?(this.$stage.append(a),this._items.push(a),this._mergers.push(1*a.find("[data-merge]").andSelf("[data-merge]").attr("data-merge")||1)):(this._items[b].before(a),this._items.splice(b,0,a),this._mergers.splice(b,0,1*a.find("[data-merge]").andSelf("[data-merge]").attr("data-merge")||1)),this.invalidate("items"),this.trigger("added",{content:a,position:b})},e.prototype.remove=function(a){a=this.normalize(a,!0),a!==d&&(this.trigger("remove",{content:this._items[a],position:a}),this._items[a].remove(),this._items.splice(a,1),this._mergers.splice(a,1),this.invalidate("items"),this.trigger("removed",{content:null,position:a}))},e.prototype.addTriggerableEvents=function(){var b=a.proxy(function(b,c){return a.proxy(function(a){a.relatedTarget!==this&&(this.suppress([c]),b.apply(this,[].slice.call(arguments,1)),this.release([c]))},this)},this);a.each({next:this.next,prev:this.prev,to:this.to,destroy:this.destroy,refresh:this.refresh,replace:this.replace,add:this.add,remove:this.remove},a.proxy(function(a,c){this.$element.on(a+".owl.carousel",b(c,a+".owl.carousel"))},this))},e.prototype.watchVisibility=function(){function c(a){return a.offsetWidth>0&&a.offsetHeight>0}function d(){c(this.$element.get(0))&&(this.$element.removeClass("owl-hidden"),this.refresh(),b.clearInterval(this.e._checkVisibile))}c(this.$element.get(0))||(this.$element.addClass("owl-hidden"),b.clearInterval(this.e._checkVisibile),this.e._checkVisibile=b.setInterval(a.proxy(d,this),500))},e.prototype.preloadAutoWidthImages=function(b){var c,d,e,f;c=0,d=this,b.each(function(g,h){e=a(h),f=new Image,f.onload=function(){c++,e.attr("src",f.src),e.css("opacity",1),c>=b.length&&(d.state.imagesLoaded=!0,d.initialize())},f.src=e.attr("src")||e.attr("data-src")||e.attr("data-src-retina")})},e.prototype.destroy=function(){this.$element.hasClass(this.settings.themeClass)&&this.$element.removeClass(this.settings.themeClass),this.settings.responsive!==!1&&a(b).off("resize.owl.carousel"),this.transitionEndVendor&&this.off(this.$stage.get(0),this.transitionEndVendor,this.e._transitionEnd);for(var d in this._plugins)this._plugins[d].destroy();(this.settings.mouseDrag||this.settings.touchDrag)&&(this.$stage.off("mousedown touchstart touchcancel"),a(c).off(".owl.dragEvents"),this.$stage.get(0).onselectstart=function(){},this.$stage.off("dragstart",function(){return!1})),this.$element.off(".owl"),this.$stage.children(".cloned").remove(),this.e=null,this.$element.removeData("owlCarousel"),this.$stage.children().contents().unwrap(),this.$stage.children().unwrap(),this.$stage.unwrap()},e.prototype.op=function(a,b,c){var d=this.settings.rtl;switch(b){case"<":return d?a>c:c>a;case">":return d?c>a:a>c;case">=":return d?c>=a:a>=c;case"<=":return d?a>=c:c>=a}},e.prototype.on=function(a,b,c,d){a.addEventListener?a.addEventListener(b,c,d):a.attachEvent&&a.attachEvent("on"+b,c)},e.prototype.off=function(a,b,c,d){a.removeEventListener?a.removeEventListener(b,c,d):a.detachEvent&&a.detachEvent("on"+b,c)},e.prototype.trigger=function(b,c,d){var e={item:{count:this._items.length,index:this.current()}},f=a.camelCase(a.grep(["on",b,d],function(a){return a}).join("-").toLowerCase()),g=a.Event([b,"owl",d||"carousel"].join(".").toLowerCase(),a.extend({relatedTarget:this},e,c));return this._supress[b]||(a.each(this._plugins,function(a,b){b.onTrigger&&b.onTrigger(g)}),this.$element.trigger(g),this.settings&&"function"==typeof this.settings[f]&&this.settings[f].apply(this,g)),g},e.prototype.suppress=function(b){a.each(b,a.proxy(function(a,b){this._supress[b]=!0},this))},e.prototype.release=function(b){a.each(b,a.proxy(function(a,b){delete this._supress[b]},this))},e.prototype.browserSupport=function(){if(this.support3d=j(),this.support3d){this.transformVendor=i();var a=["transitionend","webkitTransitionEnd","transitionend","oTransitionEnd"];this.transitionEndVendor=a[h()],this.vendorName=this.transformVendor.replace(/Transform/i,""),this.vendorName=""!==this.vendorName?"-"+this.vendorName.toLowerCase()+"-":""}this.state.orientation=b.orientation},a.fn.owlCarousel=function(b){return this.each(function(){a(this).data("owlCarousel")||a(this).data("owlCarousel",new e(this,b))})},a.fn.owlCarousel.Constructor=e}(window.Zepto||window.jQuery,window,document),function(a,b){var c=function(b){this._core=b,this._loaded=[],this._handlers={"initialized.owl.carousel change.owl.carousel":a.proxy(function(b){if(b.namespace&&this._core.settings&&this._core.settings.lazyLoad&&(b.property&&"position"==b.property.name||"initialized"==b.type))for(var c=this._core.settings,d=c.center&&Math.ceil(c.items/2)||c.items,e=c.center&&-1*d||0,f=(b.property&&b.property.value||this._core.current())+e,g=this._core.clones().length,h=a.proxy(function(a,b){this.load(b)},this);e++<d;)this.load(g/2+this._core.relative(f)),g&&a.each(this._core.clones(this._core.relative(f++)),h)},this)},this._core.options=a.extend({},c.Defaults,this._core.options),this._core.$element.on(this._handlers)};c.Defaults={lazyLoad:!1},c.prototype.load=function(c){var d=this._core.$stage.children().eq(c),e=d&&d.find(".owl-lazy");!e||a.inArray(d.get(0),this._loaded)>-1||(e.each(a.proxy(function(c,d){var e,f=a(d),g=b.devicePixelRatio>1&&f.attr("data-src-retina")||f.attr("data-src");this._core.trigger("load",{element:f,url:g},"lazy"),f.is("img")?f.one("load.owl.lazy",a.proxy(function(){f.css("opacity",1),this._core.trigger("loaded",{element:f,url:g},"lazy")},this)).attr("src",g):(e=new Image,e.onload=a.proxy(function(){f.css({"background-image":"url("+g+")",opacity:"1"}),this._core.trigger("loaded",{element:f,url:g},"lazy")},this),e.src=g)},this)),this._loaded.push(d.get(0)))},c.prototype.destroy=function(){var a,b;for(a in this.handlers)this._core.$element.off(a,this.handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.owlCarousel.Constructor.Plugins.Lazy=c}(window.Zepto||window.jQuery,window,document),function(a){var b=function(c){this._core=c,this._handlers={"initialized.owl.carousel":a.proxy(function(){this._core.settings.autoHeight&&this.update()},this),"changed.owl.carousel":a.proxy(function(a){this._core.settings.autoHeight&&"position"==a.property.name&&this.update()},this),"loaded.owl.lazy":a.proxy(function(a){this._core.settings.autoHeight&&a.element.closest("."+this._core.settings.itemClass)===this._core.$stage.children().eq(this._core.current())&&this.update()},this)},this._core.options=a.extend({},b.Defaults,this._core.options),this._core.$element.on(this._handlers)};b.Defaults={autoHeight:!1,autoHeightClass:"owl-height"},b.prototype.update=function(){this._core.$stage.parent().height(this._core.$stage.children().eq(this._core.current()).height()).addClass(this._core.settings.autoHeightClass)},b.prototype.destroy=function(){var a,b;for(a in this._handlers)this._core.$element.off(a,this._handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.owlCarousel.Constructor.Plugins.AutoHeight=b}(window.Zepto||window.jQuery,window,document),function(a,b,c){var d=function(b){this._core=b,this._videos={},this._playing=null,this._fullscreen=!1,this._handlers={"resize.owl.carousel":a.proxy(function(a){this._core.settings.video&&!this.isInFullScreen()&&a.preventDefault()},this),"refresh.owl.carousel changed.owl.carousel":a.proxy(function(){this._playing&&this.stop()},this),"prepared.owl.carousel":a.proxy(function(b){var c=a(b.content).find(".owl-video");c.length&&(c.css("display","none"),this.fetch(c,a(b.content)))},this)},this._core.options=a.extend({},d.Defaults,this._core.options),this._core.$element.on(this._handlers),this._core.$element.on("click.owl.video",".owl-video-play-icon",a.proxy(function(a){this.play(a)},this))};d.Defaults={video:!1,videoHeight:!1,videoWidth:!1},d.prototype.fetch=function(a,b){var c=a.attr("data-vimeo-id")?"vimeo":"youtube",d=a.attr("data-vimeo-id")||a.attr("data-youtube-id"),e=a.attr("data-width")||this._core.settings.videoWidth,f=a.attr("data-height")||this._core.settings.videoHeight,g=a.attr("href");if(!g)throw new Error("Missing video URL.");if(d=g.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/),d[3].indexOf("youtu")>-1)c="youtube";else{if(!(d[3].indexOf("vimeo")>-1))throw new Error("Video URL not supported.");c="vimeo"}d=d[6],this._videos[g]={type:c,id:d,width:e,height:f},b.attr("data-video",g),this.thumbnail(a,this._videos[g])},d.prototype.thumbnail=function(b,c){var d,e,f,g=c.width&&c.height?'style="width:'+c.width+"px;height:"+c.height+'px;"':"",h=b.find("img"),i="src",j="",k=this._core.settings,l=function(a){e='<div class="owl-video-play-icon"></div>',d=k.lazyLoad?'<div class="owl-video-tn '+j+'" '+i+'="'+a+'"></div>':'<div class="owl-video-tn" style="opacity:1;background-image:url('+a+')"></div>',b.after(d),b.after(e)};return b.wrap('<div class="owl-video-wrapper"'+g+"></div>"),this._core.settings.lazyLoad&&(i="data-src",j="owl-lazy"),h.length?(l(h.attr(i)),h.remove(),!1):void("youtube"===c.type?(f="http://img.youtube.com/vi/"+c.id+"/hqdefault.jpg",l(f)):"vimeo"===c.type&&a.ajax({type:"GET",url:"http://vimeo.com/api/v2/video/"+c.id+".json",jsonp:"callback",dataType:"jsonp",success:function(a){f=a[0].thumbnail_large,l(f)}}))},d.prototype.stop=function(){this._core.trigger("stop",null,"video"),this._playing.find(".owl-video-frame").remove(),this._playing.removeClass("owl-video-playing"),this._playing=null},d.prototype.play=function(b){this._core.trigger("play",null,"video"),this._playing&&this.stop();var c,d,e=a(b.target||b.srcElement),f=e.closest("."+this._core.settings.itemClass),g=this._videos[f.attr("data-video")],h=g.width||"100%",i=g.height||this._core.$stage.height();"youtube"===g.type?c='<iframe width="'+h+'" height="'+i+'" src="http://www.youtube.com/embed/'+g.id+"?autoplay=1&v="+g.id+'" frameborder="0" allowfullscreen></iframe>':"vimeo"===g.type&&(c='<iframe src="http://player.vimeo.com/video/'+g.id+'?autoplay=1" width="'+h+'" height="'+i+'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'),f.addClass("owl-video-playing"),this._playing=f,d=a('<div style="height:'+i+"px; width:"+h+'px" class="owl-video-frame">'+c+"</div>"),e.after(d)},d.prototype.isInFullScreen=function(){var d=c.fullscreenElement||c.mozFullScreenElement||c.webkitFullscreenElement;return d&&a(d).parent().hasClass("owl-video-frame")&&(this._core.speed(0),this._fullscreen=!0),d&&this._fullscreen&&this._playing?!1:this._fullscreen?(this._fullscreen=!1,!1):this._playing&&this._core.state.orientation!==b.orientation?(this._core.state.orientation=b.orientation,!1):!0},d.prototype.destroy=function(){var a,b;this._core.$element.off("click.owl.video");for(a in this._handlers)this._core.$element.off(a,this._handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.owlCarousel.Constructor.Plugins.Video=d}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){var e=function(b){this.core=b,this.core.options=a.extend({},e.Defaults,this.core.options),this.swapping=!0,this.previous=d,this.next=d,this.handlers={"change.owl.carousel":a.proxy(function(a){"position"==a.property.name&&(this.previous=this.core.current(),this.next=a.property.value)},this),"drag.owl.carousel dragged.owl.carousel translated.owl.carousel":a.proxy(function(a){this.swapping="translated"==a.type},this),"translate.owl.carousel":a.proxy(function(){this.swapping&&(this.core.options.animateOut||this.core.options.animateIn)&&this.swap()},this)},this.core.$element.on(this.handlers)};e.Defaults={animateOut:!1,animateIn:!1},e.prototype.swap=function(){if(1===this.core.settings.items&&this.core.support3d){this.core.speed(0);var b,c=a.proxy(this.clear,this),d=this.core.$stage.children().eq(this.previous),e=this.core.$stage.children().eq(this.next),f=this.core.settings.animateIn,g=this.core.settings.animateOut;this.core.current()!==this.previous&&(g&&(b=this.core.coordinates(this.previous)-this.core.coordinates(this.next),d.css({left:b+"px"}).addClass("animated owl-animated-out").addClass(g).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",c)),f&&e.addClass("animated owl-animated-in").addClass(f).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",c))}},e.prototype.clear=function(b){a(b.target).css({left:""}).removeClass("animated owl-animated-out owl-animated-in").removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut),this.core.transitionEnd()},e.prototype.destroy=function(){var a,b;for(a in this.handlers)this.core.$element.off(a,this.handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.owlCarousel.Constructor.Plugins.Animate=e}(window.Zepto||window.jQuery,window,document),function(a,b,c){var d=function(b){this.core=b,this.core.options=a.extend({},d.Defaults,this.core.options),this.handlers={"translated.owl.carousel refreshed.owl.carousel":a.proxy(function(){this.autoplay()
},this),"play.owl.autoplay":a.proxy(function(a,b,c){this.play(b,c)},this),"stop.owl.autoplay":a.proxy(function(){this.stop()},this),"mouseover.owl.autoplay":a.proxy(function(){this.core.settings.autoplayHoverPause&&this.pause()},this),"mouseleave.owl.autoplay":a.proxy(function(){this.core.settings.autoplayHoverPause&&this.autoplay()},this)},this.core.$element.on(this.handlers)};d.Defaults={autoplay:!1,autoplayTimeout:5e3,autoplayHoverPause:!1,autoplaySpeed:!1},d.prototype.autoplay=function(){this.core.settings.autoplay&&!this.core.state.videoPlay?(b.clearInterval(this.interval),this.interval=b.setInterval(a.proxy(function(){this.play()},this),this.core.settings.autoplayTimeout)):b.clearInterval(this.interval)},d.prototype.play=function(){return c.hidden===!0||this.core.state.isTouch||this.core.state.isScrolling||this.core.state.isSwiping||this.core.state.inMotion?void 0:this.core.settings.autoplay===!1?void b.clearInterval(this.interval):void this.core.next(this.core.settings.autoplaySpeed)},d.prototype.stop=function(){b.clearInterval(this.interval)},d.prototype.pause=function(){b.clearInterval(this.interval)},d.prototype.destroy=function(){var a,c;b.clearInterval(this.interval);for(a in this.handlers)this.core.$element.off(a,this.handlers[a]);for(c in Object.getOwnPropertyNames(this))"function"!=typeof this[c]&&(this[c]=null)},a.fn.owlCarousel.Constructor.Plugins.autoplay=d}(window.Zepto||window.jQuery,window,document),function(a){"use strict";var b=function(c){this._core=c,this._initialized=!1,this._pages=[],this._controls={},this._templates=[],this.$element=this._core.$element,this._overrides={next:this._core.next,prev:this._core.prev,to:this._core.to},this._handlers={"prepared.owl.carousel":a.proxy(function(b){this._core.settings.dotsData&&this._templates.push(a(b.content).find("[data-dot]").andSelf("[data-dot]").attr("data-dot"))},this),"add.owl.carousel":a.proxy(function(b){this._core.settings.dotsData&&this._templates.splice(b.position,0,a(b.content).find("[data-dot]").andSelf("[data-dot]").attr("data-dot"))},this),"remove.owl.carousel prepared.owl.carousel":a.proxy(function(a){this._core.settings.dotsData&&this._templates.splice(a.position,1)},this),"change.owl.carousel":a.proxy(function(a){if("position"==a.property.name&&!this._core.state.revert&&!this._core.settings.loop&&this._core.settings.navRewind){var b=this._core.current(),c=this._core.maximum(),d=this._core.minimum();a.data=a.property.value>c?b>=c?d:c:a.property.value<d?c:a.property.value}},this),"changed.owl.carousel":a.proxy(function(a){"position"==a.property.name&&this.draw()},this),"refreshed.owl.carousel":a.proxy(function(){this._initialized||(this.initialize(),this._initialized=!0),this._core.trigger("refresh",null,"navigation"),this.update(),this.draw(),this._core.trigger("refreshed",null,"navigation")},this)},this._core.options=a.extend({},b.Defaults,this._core.options),this.$element.on(this._handlers)};b.Defaults={nav:!1,navRewind:!0,navText:["prev","next"],navSpeed:!1,navElement:"div",navContainer:!1,navContainerClass:"owl-nav",navClass:["owl-prev","owl-next"],slideBy:1,dotClass:"owl-dot",dotsClass:"owl-dots",dots:!0,dotsEach:!1,dotData:!1,dotsSpeed:!1,dotsContainer:!1,controlsClass:"owl-controls"},b.prototype.initialize=function(){var b,c,d=this._core.settings;d.dotsData||(this._templates=[a("<div>").addClass(d.dotClass).append(a("<span>")).prop("outerHTML")]),d.navContainer&&d.dotsContainer||(this._controls.$container=a("<div>").addClass(d.controlsClass).appendTo(this.$element)),this._controls.$indicators=d.dotsContainer?a(d.dotsContainer):a("<div>").hide().addClass(d.dotsClass).appendTo(this._controls.$container),this._controls.$indicators.on("click","div",a.proxy(function(b){var c=a(b.target).parent().is(this._controls.$indicators)?a(b.target).index():a(b.target).parent().index();b.preventDefault(),this.to(c,d.dotsSpeed)},this)),b=d.navContainer?a(d.navContainer):a("<div>").addClass(d.navContainerClass).prependTo(this._controls.$container),this._controls.$next=a("<"+d.navElement+">"),this._controls.$previous=this._controls.$next.clone(),this._controls.$previous.addClass(d.navClass[0]).html(d.navText[0]).hide().prependTo(b).on("click",a.proxy(function(){this.prev(d.navSpeed)},this)),this._controls.$next.addClass(d.navClass[1]).html(d.navText[1]).hide().appendTo(b).on("click",a.proxy(function(){this.next(d.navSpeed)},this));for(c in this._overrides)this._core[c]=a.proxy(this[c],this)},b.prototype.destroy=function(){var a,b,c,d;for(a in this._handlers)this.$element.off(a,this._handlers[a]);for(b in this._controls)this._controls[b].remove();for(d in this.overides)this._core[d]=this._overrides[d];for(c in Object.getOwnPropertyNames(this))"function"!=typeof this[c]&&(this[c]=null)},b.prototype.update=function(){var a,b,c,d=this._core.settings,e=this._core.clones().length/2,f=e+this._core.items().length,g=d.center||d.autoWidth||d.dotData?1:d.dotsEach||d.items;if("page"!==d.slideBy&&(d.slideBy=Math.min(d.slideBy,d.items)),d.dots||"page"==d.slideBy)for(this._pages=[],a=e,b=0,c=0;f>a;a++)(b>=g||0===b)&&(this._pages.push({start:a-e,end:a-e+g-1}),b=0,++c),b+=this._core.mergers(this._core.relative(a))},b.prototype.draw=function(){var b,c,d="",e=this._core.settings,f=(this._core.$stage.children(),this._core.relative(this._core.current()));if(!e.nav||e.loop||e.navRewind||(this._controls.$previous.toggleClass("disabled",0>=f),this._controls.$next.toggleClass("disabled",f>=this._core.maximum())),this._controls.$previous.toggle(e.nav),this._controls.$next.toggle(e.nav),e.dots){if(b=this._pages.length-this._controls.$indicators.children().length,e.dotData&&0!==b){for(c=0;c<this._controls.$indicators.children().length;c++)d+=this._templates[this._core.relative(c)];this._controls.$indicators.html(d)}else b>0?(d=new Array(b+1).join(this._templates[0]),this._controls.$indicators.append(d)):0>b&&this._controls.$indicators.children().slice(b).remove();this._controls.$indicators.find(".active").removeClass("active"),this._controls.$indicators.children().eq(a.inArray(this.current(),this._pages)).addClass("active")}this._controls.$indicators.toggle(e.dots)},b.prototype.onTrigger=function(b){var c=this._core.settings;b.page={index:a.inArray(this.current(),this._pages),count:this._pages.length,size:c&&(c.center||c.autoWidth||c.dotData?1:c.dotsEach||c.items)}},b.prototype.current=function(){var b=this._core.relative(this._core.current());return a.grep(this._pages,function(a){return a.start<=b&&a.end>=b}).pop()},b.prototype.getPosition=function(b){var c,d,e=this._core.settings;return"page"==e.slideBy?(c=a.inArray(this.current(),this._pages),d=this._pages.length,b?++c:--c,c=this._pages[(c%d+d)%d].start):(c=this._core.relative(this._core.current()),d=this._core.items().length,b?c+=e.slideBy:c-=e.slideBy),c},b.prototype.next=function(b){a.proxy(this._overrides.to,this._core)(this.getPosition(!0),b)},b.prototype.prev=function(b){a.proxy(this._overrides.to,this._core)(this.getPosition(!1),b)},b.prototype.to=function(b,c,d){var e;d?a.proxy(this._overrides.to,this._core)(b,c):(e=this._pages.length,a.proxy(this._overrides.to,this._core)(this._pages[(b%e+e)%e].start,c))},a.fn.owlCarousel.Constructor.Plugins.Navigation=b}(window.Zepto||window.jQuery,window,document),function(a,b){"use strict";var c=function(d){this._core=d,this._hashes={},this.$element=this._core.$element,this._handlers={"initialized.owl.carousel":a.proxy(function(){"URLHash"==this._core.settings.startPosition&&a(b).trigger("hashchange.owl.navigation")},this),"prepared.owl.carousel":a.proxy(function(b){var c=a(b.content).find("[data-hash]").andSelf("[data-hash]").attr("data-hash");this._hashes[c]=b.content},this)},this._core.options=a.extend({},c.Defaults,this._core.options),this.$element.on(this._handlers),a(b).on("hashchange.owl.navigation",a.proxy(function(){var a=b.location.hash.substring(1),c=this._core.$stage.children(),d=this._hashes[a]&&c.index(this._hashes[a])||0;return a?void this._core.to(d,!1,!0):!1},this))};c.Defaults={URLhashListener:!1},c.prototype.destroy=function(){var c,d;a(b).off("hashchange.owl.navigation");for(c in this._handlers)this._core.$element.off(c,this._handlers[c]);for(d in Object.getOwnPropertyNames(this))"function"!=typeof this[d]&&(this[d]=null)},a.fn.owlCarousel.Constructor.Plugins.Hash=c}(window.Zepto||window.jQuery,window,document);

/*
 Plugin: jQuery Parallax
 Version 1.1.3
 Author: Ian Lunn
 Twitter: @IanLunn
 Author URL: http://www.ianlunn.co.uk/
 Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

 Dual licensed under the MIT and GPL licenses:
 http://www.opensource.org/licenses/mit-license.php
 http://www.gnu.org/licenses/gpl.html
 */

(function( $ ){
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function(xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;

		//get the starting position of each element to have parallax applied to it
		$this.each(function(){
			firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo) {
				return jqo.height();
			};
		}

		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;

		// function to be called whenever the window is scrolled or resized
		function update(){
			var pos = $window.scrollTop();

			$this.each(function(){
				var $element = $(this);
				var top = $element.offset().top;
				var height = getHeight($element);

				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}

				$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
			});
		}

		$window.bind('scroll', update).resize(update);
		update();
	};
})(jQuery);


/**
 * Clientside validator module
 * @author WingArt team
 * @version 1.0
 **/
; var Validator = (function(){

	'use strict';

	function extend(firstObj, secondObj){

		for(var key in secondObj){

			if(!secondObj.hasOwnProperty(key)) continue;

			firstObj[key] = secondObj[key];

		}

		return firstObj;

	}

	function addClass(element, classN){

		if(element.classList){
			element.classList.add(classN);
		}
		else{
			element.className += ' ' + classN;
		}

	}

	function removeClass(element, classN){

		if(element.classList){
			element.classList.remove(classN)
		}
		else{
			element.className = element.className.replace(' ' + classN, '');
		}

	}

	function Validator(config){

		this.errors = [];

		this.defOptions = {
			form: null,
			cssPrefix: null,
			incorrectClass: 'incorrect',
			correctClass: 'valid',
			showValid: true,
			rules: null,
			ajax: true
		}

		this.options = extend(this.defOptions, config);

		Object.defineProperties(this, {

			iClass: {

				get: function(){

					return this.options.cssPrefix ? this.options.cssPrefix + this.options.incorrectClass : this.options.incorrectClass;

				}

			},

			vClass: {

				get: function(){

					return this.options.cssPrefix ? this.options.cssPrefix + this.options.correctClass : this.options.correctClass;

				}

			}

		});

		Object.defineProperty(this, 'form', {

			get: function(){

				return this.options.form;

			}

		});

		/**
		 * Return to the default state
		 * @return undefined;
		 **/
		Object.defineProperty(this, 'reset', {

			value: function(){

				this.errors = [];
				this.unbindErrors();

			}

		});


		/**
		 * Starts process of fields validation
		 * @return Boolean;
		 **/
		Object.defineProperty(this, 'test', {

			value: function(){

				var rules = this.options.rules,
					valid = true;

				for(var i = 0; i < rules.length; i++){

					var methods = rules[i]['rules'];

					for(var rule in methods){

						var mName = 'test' + rule,
							param = methods[rule];

						if(!this[mName](rules[i]['element'], param)) valid = false;

					}

				}

				return valid;

			}

		});

		/**
		 * Appends error messages to form elements
		 * @return undefined;
		 **/
		Object.defineProperty(this, 'bindErrors', {

			value: function(){

				for(var i = 0; i < this.errors.length; i++){

					var error = this.errors[i];

					addClass(error['element'], this.iClass);

				}

			}

		});

		/**
		 * Removes error messages from form elements
		 * @return undefined;
		 **/
		Object.defineProperty(this, 'unbindErrors', {

			value: function(){

				var incorrectFields = this.form.querySelectorAll('.' + this.iClass);

				for(var i = 0; i < incorrectFields.length; i++){

					removeClass(incorrectFields[i], this.iClass);

				}

			}

		});

		/**
		 * Binds necessary events to form
		 * @protected
		 * @return undefined;
		 **/
		Object.defineProperty(this, 'bindEvents', {

			value: function(){

				var self = this;

				if(!this.form || !(this.form instanceof HTMLFormElement)){

					throw new Error(' \'form\' property in config object should be specified and should be instance of HTMLFormElement class');

				}

				this.form.addEventListener('submit', function(e){

					self.reset();

					if(self.options.ajax) e.preventDefault();

					if(!self.test()){

						self.bindErrors();
						self.options.onIncorrect.call(self.form, self.errorsList);

						e.preventDefault();
						e.stopPropagation();
						return false;

					}
					else self.options.onCorrect.call(self.form);

				}, false);

			},

			configurable: false,
			writable: false

		});

		this.bindEvents();

	}

	/**
	 * Detects empty field
	 * @param HTMLInputElement | HTMLTextAreaElement input
	 * @return Boolean;
	 **/
	Object.defineProperty(Validator.prototype, 'testempty', {

		value: function(input){

			if(!input.value.length){

				this.errors.push({
					element: input,
					message: 'Field \'' + input.name + '\' should be filled!'
				});

				return false;

			}

			return true;

		}

	});

	/**
	 * Detects fields, which don't match specified pattern
	 * @param HTMLInputElement | HTMLTextAreaElement input
	 * @param String pattern
	 * @return Boolean;
	 **/
	Object.defineProperty(Validator.prototype, 'testpattern', {

		value: function(input, pattern){

			var rE = new RegExp(pattern);

			if(!rE.test(input.value)){

				this.errors.push({
					element: input,
					message: 'The value of field \'' +input.name+ '\' is incorrect!'
				});

				return false;

			}

			return true;

		}

	});

	/**
	 * Detects fields, which don't contain specified amount of symbols
	 * @param HTMLInputElement | HTMLTextAreaElement input
	 * @param Number min
	 * @return Boolean;
	 **/
	Object.defineProperty(Validator.prototype, 'testmin', {

		value: function(input, min){

			if(input.value.length < min){

				this.errors.push({
					element: input,
					message: 'The amount of characters in \'' + input.name + '\' field should be grater than ' + min +'!'
				});

				return false;

			}

			return true;

		}

	});

	/**
	 * Returns list of errors
	 * @return String;
	 **/
	Object.defineProperty(Validator.prototype, 'errorsList', {

		get: function(){

			var errors = '';

			this.errors.forEach(function(el, i, arr){

				errors += el.message + "\r\n";

			});

			return errors === '' ? null : errors;

		}

	});

	return Validator;

})();

/*!
 * jQuery Mousewheel 3.1.13
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 */(function(c){"function"===typeof define&&define.amd?define(["jquery"],c):"object"===typeof exports?module.exports=c:c(jQuery)})(function(c){function l(a){var b=a||window.event,k=r.call(arguments,1),f=0,e=0,d=0,g=0,l=0,n=0;a=c.event.fix(b);a.type="mousewheel";"detail"in b&&(d=-1*b.detail);"wheelDelta"in b&&(d=b.wheelDelta);"wheelDeltaY"in b&&(d=b.wheelDeltaY);"wheelDeltaX"in b&&(e=-1*b.wheelDeltaX);"axis"in b&&b.axis===b.HORIZONTAL_AXIS&&(e=-1*d,d=0);f=0===d?e:d;"deltaY"in b&&(f=d=-1*b.deltaY);"deltaX"in
b&&(e=b.deltaX,0===d&&(f=-1*e));if(0!==d||0!==e){1===b.deltaMode?(g=c.data(this,"mousewheel-line-height"),f*=g,d*=g,e*=g):2===b.deltaMode&&(g=c.data(this,"mousewheel-page-height"),f*=g,d*=g,e*=g);g=Math.max(Math.abs(d),Math.abs(e));if(!h||g<h)h=g,m.settings.adjustOldDeltas&&"mousewheel"===b.type&&0===g%120&&(h/=40);m.settings.adjustOldDeltas&&"mousewheel"===b.type&&0===g%120&&(f/=40,e/=40,d/=40);f=Math[1<=f?"floor":"ceil"](f/h);e=Math[1<=e?"floor":"ceil"](e/h);d=Math[1<=d?"floor":"ceil"](d/h);m.settings.normalizeOffset&&
this.getBoundingClientRect&&(b=this.getBoundingClientRect(),l=a.clientX-b.left,n=a.clientY-b.top);a.deltaX=e;a.deltaY=d;a.deltaFactor=h;a.offsetX=l;a.offsetY=n;a.deltaMode=0;k.unshift(a,f,e,d);p&&clearTimeout(p);p=setTimeout(t,200);return(c.event.dispatch||c.event.handle).apply(this,k)}}function t(){h=null}var n=["wheel","mousewheel","DOMMouseScroll","MozMousePixelScroll"],k="onwheel"in document||9<=document.documentMode?["wheel"]:["mousewheel","DomMouseScroll","MozMousePixelScroll"],r=Array.prototype.slice,
	p,h;if(c.event.fixHooks)for(var q=n.length;q;)c.event.fixHooks[n[--q]]=c.event.mouseHooks;var m=c.event.special.mousewheel={version:"3.1.12",setup:function(){if(this.addEventListener)for(var a=k.length;a;)this.addEventListener(k[--a],l,!1);else this.onmousewheel=l;c.data(this,"mousewheel-line-height",m.getLineHeight(this));c.data(this,"mousewheel-page-height",m.getPageHeight(this))},teardown:function(){if(this.removeEventListener)for(var a=k.length;a;)this.removeEventListener(k[--a],l,!1);else this.onmousewheel=
	null;c.removeData(this,"mousewheel-line-height");c.removeData(this,"mousewheel-page-height")},getLineHeight:function(a){a=c(a);var b=a["offsetParent"in c.fn?"offsetParent":"parent"]();b.length||(b=c("body"));return parseInt(b.css("fontSize"),10)||parseInt(a.css("fontSize"),10)||16},getPageHeight:function(a){return c(a).height()},settings:{adjustOldDeltas:!0,normalizeOffset:!0}};c.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",
	a)}})});


/*
 * jQuery.appear
 * https://github.com/bas2k/jquery.appear/
 * http://code.google.com/p/jquery-appear/
 * http://bas2k.ru/
 *
 * Copyright (c) 2009 Michael Hixson
 * Copyright (c) 2012-2014 Alexander Brovikov
 * Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
 */(function(a){a.fn.appear=function(e,b){var d=a.extend({data:void 0,one:!0,accX:0,accY:0},b);return this.each(function(){var c=a(this);c.appeared=!1;if(e){var g=a(window),f=function(){if(c.is(":visible")){var a=g.scrollLeft(),e=g.scrollTop(),b=c.offset(),f=b.left,b=b.top,h=d.accX,k=d.accY,l=c.height(),m=g.height(),n=c.width(),p=g.width();b+l+k>=e&&b<=e+m+k&&f+n+h>=a&&f<=a+p+h?c.appeared||c.trigger("appear",d.data):c.appeared=!1}else c.appeared=!1},b=function(){c.appeared=!0;if(d.one){g.unbind("scroll",
	f);var b=a.inArray(f,a.fn.appear.checks);0<=b&&a.fn.appear.checks.splice(b,1)}e.apply(this,arguments)};if(d.one)c.one("appear",d.data,b);else c.bind("appear",d.data,b);g.scroll(f);a.fn.appear.checks.push(f);f()}else c.trigger("appear",d.data)})};a.extend(a.fn.appear,{checks:[],timeout:null,checkAll:function(){var e=a.fn.appear.checks.length;if(0<e)for(;e--;)a.fn.appear.checks[e]()},run:function(){a.fn.appear.timeout&&clearTimeout(a.fn.appear.timeout);a.fn.appear.timeout=setTimeout(a.fn.appear.checkAll,
	20)}});a.each("append prepend after before attr removeAttr addClass removeClass toggleClass remove css show hide".split(" "),function(e,b){var d=a.fn[b];d&&(a.fn[b]=function(){var b=d.apply(this,arguments);a.fn.appear.run();return b})})})(jQuery);

;(function($){
	'use strict';

	/**
	 * Constructor
	 * @param jQuery element
	 * @param Object options
	 * @return undefined;
	 **/
	function gatsby_tabs(element, options){

		this.el = element;

		this.config = {
			speed: $.fx.speed,
			easing: 'linear',
			cssPrefix: '',
			afterOpen: function(){},
			afterClose: function(){}
		}

		options = options || {};

		$.extend(this.config, options);

		this.activeClass = this.config.cssPrefix + 'active';

		this.nav = this.el.find('.' + this.config.cssPrefix + 'tabs-nav');
		this.tabsContainer = this.el.find('.' + this.config.cssPrefix + 'tabs-container');
		this.tabs = this.tabsContainer.find('.' + this.config.cssPrefix + 'tab');

		this.toDefaultState();
		this.bindEvents();

	}

	gatsby_tabs.prototype.toDefaultState = function(){

		var active = this.nav.find('.' + this.activeClass);

		if(!active.length){
			active = this.nav.find('a').first();
			active.addClass(this.activeClass);
		}

		var tab = $(active.attr('href'));

		if(tab.length){

			this.tabsContainer.css({
				'position': 'relative'
			});

			this.tabs.css({
				'position': 'absolute',
				'top': 0,
				'left': 0,
				'width': '100%'
			});

			this.tabs.not(tab).css({
				'opacity': 0,
				'visibility': 'hidden'
			});

			this.openTab(tab);

		}

	}

	gatsby_tabs.prototype.bindEvents = function(){

		this.nav.on('click', 'a[href]', {self: this}, function(e){

			e.preventDefault();
			var $this = $(this),
				self = e.data.self,
				tab = $($this.attr('href'));

			if($this.hasClass(self.activeClass)) return false;

			$this
				.addClass(self.activeClass)
				.parent()
				.siblings()
				.children('a')
				.removeClass(self.activeClass);

			if(tab.length) self.openTab(tab);

		});

		$(window).on('resize.tabs', this.updateContainer.bind(this));

	}

	gatsby_tabs.prototype.updateContainer = function(){

		var self = this;
		if(self.timeOutId) clearTimeout(self.timeOutId);

		self.timeOutId = setTimeout(function(){

			var tabHeight = self.tabsContainer.find('.' + self.activeClass).outerHeight();

			self.tabsContainer.stop().animate({
				'height': tabHeight
			}, {
				complete: function(){
					clearTimeout(self.timeOutId);
				},
				duration: self.config.speed,
				easing: self.config.easing
			});

		}, 100);

	}

	gatsby_tabs.prototype.openTab = function(tab){

		var self = this,
			tabHeight = tab.outerHeight(),
			currentTab = tab.siblings('.' + this.activeClass);

		if(currentTab.length) this.closeTab(currentTab);

		tab
			.addClass(this.activeClass)
			.siblings()
			.removeClass(this.activeClass);

		this.tabsContainer.stop().animate({
			'height': tabHeight
		}, {
			duration: self.config.speed,
			easing: self.config.easing
		});

		tab.css('visibility', 'visible').stop().animate({
			'opacity': 1
		}, {
			complete: function(){
				self.config.afterOpen.call($(this));
			},
			duration: self.config.speed,
			easing: self.config.easing
		});

	}

	gatsby_tabs.prototype.closeTab = function(tab){

		var self = this;

		tab.stop().animate({
			'opacity': 0
		}, {
			complete: function(){
				var $this = $(this);

				$this.css('visibility', 'hidden');
				self.config.afterClose.call($this);

			},
			duration: self.config.speed,
			easing: self.config.easing
		});

	}

	$.fn.gatsby_tabs = function(options){

		return this.each(function(){

			var $this = $(this);

			if(!$this.data('tabs')){

				$this.data('tabs', new gatsby_tabs($this, options));
			}

		});

	}

})(jQuery);

/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 *
 * Open source under the BSD License.
 *
 * Copyright � 2008 George McGinley Smith
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this list of
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list
 * of conditions and the following disclaimer in the documentation and/or other materials
 * provided with the distribution.
 *
 * Neither the name of the author nor the names of contributors may be used to endorse
 * or promote products derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
 * OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
	{
		def: 'easeOutQuad',
		swing: function (x, t, b, c, d) {
			//alert(jQuery.easing.default);
			return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
		},
		easeInQuad: function (x, t, b, c, d) {
			return c*(t/=d)*t + b;
		},
		easeOutQuad: function (x, t, b, c, d) {
			return -c *(t/=d)*(t-2) + b;
		},
		easeInOutQuad: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) return c/2*t*t + b;
			return -c/2 * ((--t)*(t-2) - 1) + b;
		},
		easeInCubic: function (x, t, b, c, d) {
			return c*(t/=d)*t*t + b;
		},
		easeOutCubic: function (x, t, b, c, d) {
			return c*((t=t/d-1)*t*t + 1) + b;
		},
		easeInOutCubic: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) return c/2*t*t*t + b;
			return c/2*((t-=2)*t*t + 2) + b;
		},
		easeInQuart: function (x, t, b, c, d) {
			return c*(t/=d)*t*t*t + b;
		},
		easeOutQuart: function (x, t, b, c, d) {
			return -c * ((t=t/d-1)*t*t*t - 1) + b;
		},
		easeInOutQuart: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
			return -c/2 * ((t-=2)*t*t*t - 2) + b;
		},
		easeInQuint: function (x, t, b, c, d) {
			return c*(t/=d)*t*t*t*t + b;
		},
		easeOutQuint: function (x, t, b, c, d) {
			return c*((t=t/d-1)*t*t*t*t + 1) + b;
		},
		easeInOutQuint: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
			return c/2*((t-=2)*t*t*t*t + 2) + b;
		},
		easeInSine: function (x, t, b, c, d) {
			return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
		},
		easeOutSine: function (x, t, b, c, d) {
			return c * Math.sin(t/d * (Math.PI/2)) + b;
		},
		easeInOutSine: function (x, t, b, c, d) {
			return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
		},
		easeInExpo: function (x, t, b, c, d) {
			return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
		},
		easeOutExpo: function (x, t, b, c, d) {
			return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
		},
		easeInOutExpo: function (x, t, b, c, d) {
			if (t==0) return b;
			if (t==d) return b+c;
			if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
			return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
		},
		easeInCirc: function (x, t, b, c, d) {
			return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
		},
		easeOutCirc: function (x, t, b, c, d) {
			return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
		},
		easeInOutCirc: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
			return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
		},
		easeInElastic: function (x, t, b, c, d) {
			var s=1.70158;var p=0;var a=c;
			if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
			if (a < Math.abs(c)) { a=c; var s=p/4; }
			else var s = p/(2*Math.PI) * Math.asin (c/a);
			return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		},
		easeOutElastic: function (x, t, b, c, d) {
			var s=1.70158;var p=0;var a=c;
			if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
			if (a < Math.abs(c)) { a=c; var s=p/4; }
			else var s = p/(2*Math.PI) * Math.asin (c/a);
			return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
		},
		easeInOutElastic: function (x, t, b, c, d) {
			var s=1.70158;var p=0;var a=c;
			if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
			if (a < Math.abs(c)) { a=c; var s=p/4; }
			else var s = p/(2*Math.PI) * Math.asin (c/a);
			if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
			return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
		},
		easeInBack: function (x, t, b, c, d, s) {
			if (s == undefined) s = 1.70158;
			return c*(t/=d)*t*((s+1)*t - s) + b;
		},
		easeOutBack: function (x, t, b, c, d, s) {
			if (s == undefined) s = 1.70158;
			return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
		},
		easeInOutBack: function (x, t, b, c, d, s) {
			if (s == undefined) s = 1.70158;
			if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
			return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
		},
		easeInBounce: function (x, t, b, c, d) {
			return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
		},
		easeOutBounce: function (x, t, b, c, d) {
			if ((t/=d) < (1/2.75)) {
				return c*(7.5625*t*t) + b;
			} else if (t < (2/2.75)) {
				return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
			} else if (t < (2.5/2.75)) {
				return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
			} else {
				return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
			}
		},
		easeInOutBounce: function (x, t, b, c, d) {
			if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
			return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
		}
	});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 *
 * Open source under the BSD License.
 *
 * Copyright � 2001 Robert Penner
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this list of
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list
 * of conditions and the following disclaimer in the documentation and/or other materials
 * provided with the distribution.
 *
 * Neither the name of the author nor the names of contributors may be used to endorse
 * or promote products derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
 * OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

;(function($){
	'use strict';

	/**
	 * gatsby_custom_select construct function
	 * @return undefined;
	 **/
	function gatsby_custom_select(element, options){

		this.el = element;
		this.config = {
			cssPrefix: 'gt-'
		}

		$.extend(this.config, options);

		if ( element.children('select').length ) {
			this.select = element.find('select');
			this.select.hide();
		}

		this.build();
		this.bindEvents();

	}

	/**
	 * Creates necessary select elements and adds them to container element
	 * @return undefined;
	 **/
	gatsby_custom_select.prototype.build = function() {

		var self = this,
			//options = this.select.children(),
			selectedFlag = false;

		if ( self.el.children('.' + self.config.cssPrefix + 'selected-option').length ) {
			self.selectedOption = self.el.children('.' + self.config.cssPrefix + 'selected-option');
		} else {
			self.selectedOption = $('<div></div>', {
				'class': self.config.cssPrefix + 'selected-option',
				'text': self.select.data('default-text')
			});
		}

		if ( self.el.children('ul.' + self.config.cssPrefix + 'options-list').length ) {
			self.optionsList = self.el.children('ul.' + self.config.cssPrefix + 'options-list');
		} else {
			self.optionsList = $('<ul></ul>', {
				class: self.config.cssPrefix + 'options-list'
			});
		}

		//for(var i = 0, l = options.length; i < l; i++) {
		//
		//	var option = options.eq(i);
		//
		//	var li = $('<li></li>', {
		//		'text': option.text(),
		//		'data-value': option.val()
		//	});
		//
		//	if (option.attr('selected')) {
		//		li.addClass(self.config.cssPrefix + 'active');
		//		this.selectedOption.text(option.text());
		//		selectedFlag = true;
		//	}
		//
		//	this.optionsList.append(li);
		//
		//}

		//if(!self.select.data('default-text') && !selectedFlag){
		//
		//	this.selectedOption.text(options.eq(0).text());
		//	this.optionsList.children('li').eq(0).addClass(self.config.cssPrefix + 'active');
		//
		//}

		//this.el.append(this.selectedOption);
		//this.el.append(this.optionsList);

	}

	gatsby_custom_select.prototype.toDefaultState = function(e){

		e.preventDefault();
		e.stopPropagation();

		var container = $(this),
			self = e.data.self;

		if (!container.hasClass(self.config.cssPrefix + 'opened')) {
			container.removeClass(self.config.cssPrefix + 'over');
		}

	}

	/**
	 * Binds events to select elements
	 * @return undefined;
	 **/
	gatsby_custom_select.prototype.bindEvents = function(){

		var self = this;

		this.selectedOption.on('click', function() {

			self.el.addClass(self.config.cssPrefix + 'over');
			self.el.toggleClass(self.config.cssPrefix + 'opened');

		});

		//this.select.on('focus', function(e){
		//
		//	e.preventDefault();
		//	self.el.addClass(self.config.cssPrefix + 'opened');
		//
		//});

		this.optionsList.on('click', 'li', function(){

			var $this = $(this),
				value = $this.data('value');

			$this.addClass(self.config.cssPrefix + 'active').siblings().removeClass(self.config.cssPrefix + 'active');

			self.selectedOption.text($this.text());

			self.select.val(value);
			self.select.trigger('change');
			self.el.removeClass(self.config.cssPrefix + 'opened');

		});

		$(document).on('click.selectFocusOut', function(e){

			if(!$(e.target).closest('.' + self.config.cssPrefix + 'custom-select').length) $('.' + self.config.cssPrefix +  'custom-select').removeClass(self.config.cssPrefix + 'opened');

		});

		this.optionsList.on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', {self: this},  this.toDefaultState.bind(this.el));

	}

	$.fn.gatsby_custom_select = function(options) {

		return this.each(function() {
			if (!$(this).data('customSelect')) {
				$(this).data('customSelect', new gatsby_custom_select($(this), options));
			}
		});

	};

})(jQuery);

;(function($){

	'use strict';

	$(function(){

		/* ------------------------------------------------
				Fancybox
		------------------------------------------------ */

			if ( $.fancybox ) {

				$('body').on('click', ".gt-photography-holder .gt-project-description, .gt-portfolio-holder.gt-type-2 .gt-project-description", function(e) {
					var element = e.target || e.srcElement;

					console.log(e.which);

					if ( e.which != 2 ) {
						if ( element.attributes.class.nodeValue.indexOf('title') < 0 ) {
							$.fancybox({
								href: $(this).attr('data-src')
							});
						}
					}
				});

				var $fancyBox = $('.fancybox');

				$.fancybox.defaults.padding = 0;
				$.fancybox.defaults.wrapCSS = 'gt-custom-lightbox';

				$.fancybox.defaults.helpers.thumbs = {
					width: 80,
					height: 80
				}

				$.fancybox.defaults.beforeShow = function () {
					var className = '';

			        if ( this.title ) {
			            this.title += '<br />';
			            this.title += '<div class="fancybox-share-buttons">';
			        }  else {
			        	this.title += '<div class="fancybox-share-buttons only">';
			        }

        			this.title += '<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-url="' + this.href + '">Tweet</a> ';

        			this.title += '<iframe src="//www.facebook.com/plugins/like.php?href=http://fancyapps.com/fancybox/demo/1_b.jpg&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:23px;" allowtransparency="true"></iframe>';
        			this.title += '</div>';
    			};

    			$.fancybox.defaults.afterShow = function() { };

				$.fancybox.defaults.helpers.title = {
					type: 'inside'
				}

				if ( $fancyBox.length ) {
					$fancyBox.fancybox();
				}

				var fancyboxMedia = $('.fancybox-media');

				if ( fancyboxMedia.length ) {
					fancyboxMedia.fancybox({
						openEffect  : 'none',
						closeEffect : 'none',
						helpers : {
							media : {}
						}
					});

				}

			}

		/* ------------------------------------------------
				End of Fancybox
		------------------------------------------------ */

		/* ------------------------------------------------
				Custom Select
		------------------------------------------------ */

			var select = $('.gt-custom-select');

			if ( select.length ) {
				select.gatsby_custom_select();
			}

		/* ------------------------------------------------
				End of Custom Select
		------------------------------------------------ */

		/* ------------------------------------------------
				Accordion & toggles
		------------------------------------------------ */

			var accordions = $('.gt-accordion');

			if ( accordions.length ) {

				accordions.each(function () {

					var $this = $(this),
						obj = {
							toggle: $this.data('toggle') == 1 ? true : false,
							easing: 'easeInOutCubic',
							speed: 500,
							cssPrefix: 'gt-'
						};

					$this.gatsby_accordion(obj);


				});

			}

		/* ------------------------------------------------
				End of Accordion & toggles
		------------------------------------------------ */

		/* ------------------------------------------------
				Countdown
		------------------------------------------------ */

			var $countdown = $('.gt-countdown-holder');

			if ( $countdown.length ) {

				$countdown.each(function() {

					var $this = $(this),
						endDate = $this.data('terminal-date');

					$this.countdown({
						until: new Date(endDate),
						format: 'dHMS',
						labels: ['years', 'months', 'weeks', 'days', 'hours', 'minutes', 'seconds'],
						labels1: ['year', 'month', 'week', 'day', 'hour', 'minute', 'second'],
						isRTL: $.gatsbyCore.ISRTL ? false : true
					});

				});

			}

			//var $countdown = $('.gt-countdown-holder');
			//
			//if($countdown.length){
			//
			//	$countdown.each(function(){
			//
			//		var $this = $(this),
			//			endDate = $this.data(),
			//			until = new Date(
			//				endDate.year,
			//				endDate.month || 0,
			//				endDate.day || 1,
			//				endDate.hours || 0,
			//				endDate.minutes || 0,
			//				endDate.seconds || 0
			//			);
			//
			//		// initialize
			//		$this.countdown({
			//			until : until,
			//			format : 'dHMS',
			//			labels : ['Years', 'Month', 'Weeks', 'Days', 'Hours', 'Minutes', 'Seconds']
			//		});
			//
			//	});
			//
			//}

		/* ------------------------------------------------
				End countdown
		------------------------------------------------ */

		/* ------------------------------------------------
				WTAudio
		------------------------------------------------ */

			var audio = $('audio');

			if ( audio.length ) {
				audio.WTAudio();
			}

		/* ------------------------------------------------
				End of WTAudio
		------------------------------------------------ */

		/* ------------------------------------------------
				Range Slider
		------------------------------------------------ */

			var slider = $('#gt-slider');

			if(slider.length){

				slider.slider({
					range : true,
					min : 0,
					max : 150,
					values : [14,89],
					slide : function(event, ui){
						$(this).siblings('.gt-slider-min').text('$' + ui.values[0])
								.siblings('.gt-slider-max').text('$' + ui.values[1])
								.siblings('.gt-slider-min-input').val(ui.values[0])
								.siblings('.gt-slider-max-input').val(ui.values[1]);
					},
					create : function(event, ui){

						var $this = $(this),
							leftValue = $this.slider( "values", 0 ),
							rightValue = $this.slider( "values", 1 );

						$this.siblings('.gt-slider-min').text('$' + leftValue)
							.siblings('.gt-slider-max').text('$' + rightValue)
							.siblings('.gt-slider-min-input').val(leftValue)
							.siblings('.gt-slider-max-input').val(rightValue);
					}
				});

			}

		/* ------------------------------------------------
				End of Range Slider
		------------------------------------------------ */

	});

	$(window).load(function(){

		/* ------------------------------------------------
				Tabs
		------------------------------------------------ */

			var tabs = $('.gt-tabs-holder');

			if ( tabs.length ) {

				tabs.gatsby_tabs({
					easing: 'easeInOutCubic',
					speed: 500,
					cssPrefix: 'gt-'
				});

			}

		/* ------------------------------------------------
				End of Tabs
		------------------------------------------------ */

		/* ------------------------------------------------
				Tour Sections
		------------------------------------------------ */

			var tourSections = $('.gt-tour-sections-holder');

			if ( tourSections.length ) {

				tourSections.gatsby_tabs({
					easing: 'easeInOutCubic',
					speed: 500,
					cssPrefix: 'gt-'
				});

			}

		/* ------------------------------------------------
				End of TourSections
		------------------------------------------------ */

		/* ------------------------------------------------
				Parallax
		------------------------------------------------ */

			var mediaHolder = $('.gt-no-touchevents .gt-media-holder[data-bg]');

			if(mediaHolder.length && !$.gatsbyCore.ISTOUCH){

				setTimeout(function(){

					mediaHolder.each(function(){

						$(this).parallax("50%", 0.1);

					});

				}, 1000);

			}

			//var fwParallax = $('.gt-no-touchevents .gt-parallax-section .gt-bg-element, .gt-no-touchevents .gt-call-out .gt-bg-element');
			var fwParallax = $('.gt-no-touchevents .vc_parallax-inner');

			if ( fwParallax.length && !$.gatsbyCore.ISTOUCH ) {

				setTimeout(function(){

					fwParallax.each(function(){
						$(this).parallax("50%", 0.1);
					});

				}, 1000);

			}

		/* ------------------------------------------------
				End of Parallax
		------------------------------------------------ */


	});

})(jQuery);