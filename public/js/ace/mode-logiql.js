ace.define("ace/mode/logiql_highlight_rules",["require","exports","module","ace/lib/oop","ace/mode/text_highlight_rules"],function(e,t){"use strict";var s=e("../lib/oop"),o=e("./text_highlight_rules").TextHighlightRules,n=function(){this.$rules={start:[{token:"comment.block",regex:"/\\*",push:[{token:"comment.block",regex:"\\*/",next:"pop"},{defaultToken:"comment.block"}]},{token:"comment.single",regex:"//.*"},{token:"constant.numeric",regex:"\\d+(?:\\.\\d+)?(?:[eE][+-]?\\d+)?[fd]?"},{token:"string",regex:'"',push:[{token:"string",regex:'"',next:"pop"},{defaultToken:"string"}]},{token:"constant.language",regex:"\\b(true|false)\\b"},{token:"entity.name.type.logicblox",regex:"`[a-zA-Z_:]+(\\d|\\a)*\\b"},{token:"keyword.start",regex:"->",comment:"Constraint"},{token:"keyword.start",regex:"-->",comment:"Level 1 Constraint"},{token:"keyword.start",regex:"<-",comment:"Rule"},{token:"keyword.start",regex:"<--",comment:"Level 1 Rule"},{token:"keyword.end",regex:"\\.",comment:"Terminator"},{token:"keyword.other",regex:"!",comment:"Negation"},{token:"keyword.other",regex:",",comment:"Conjunction"},{token:"keyword.other",regex:";",comment:"Disjunction"},{token:"keyword.operator",regex:"<=|>=|!=|<|>",comment:"Equality"},{token:"keyword.other",regex:"@",comment:"Equality"},{token:"keyword.operator",regex:"\\+|-|\\*|/",comment:"Arithmetic operations"},{token:"keyword",regex:"::",comment:"Colon colon"},{token:"support.function",regex:"\\b(agg\\s*<<)",push:[{include:"$self"},{token:"support.function",regex:">>",next:"pop"}]},{token:"storage.modifier",regex:"\\b(lang:[\\w:]*)"},{token:["storage.type","text"],regex:"(export|sealed|clauses|block|alias|alias_all)(\\s*\\()(?=`)"},{token:"entity.name",regex:"[a-zA-Z_][a-zA-Z_0-9:]*(@prev|@init|@final)?(?=(\\(|\\[))"},{token:"variable.parameter",regex:"([a-zA-Z][a-zA-Z_0-9]*|_)\\s*(?=(,|\\.|<-|->|\\)|\\]|=))"}]},this.normalizeRules()};s.inherits(n,o),t.LogiQLHighlightRules=n}),ace.define("ace/mode/folding/coffee",["require","exports","module","ace/lib/oop","ace/mode/folding/fold_mode","ace/range"],function(e,t){"use strict";var s=e("../../lib/oop"),o=e("./fold_mode").FoldMode,i=e("../../range").Range,n=t.FoldMode=function(){};s.inherits(n,o),function(){this.getFoldWidgetRange=function(e,t,n){var s,o,a,r,c,l,d,u,h,m=this.indentationBlock(e,n);if(m)return m;if(a=/\S/,s=e.getLine(n),r=s.search(a),r==-1||s[r]!="#")return;for(d=s.length,u=e.getLength(),c=n,o=n;++n<u;){if(s=e.getLine(n),l=s.search(a),l==-1)continue;if(s[l]!="#")break;o=n}if(o>c)return h=e.getLine(o).length,new i(c,d,o,h)},this.getFoldWidget=function(e,t,n){var i=e.getLine(n),s=i.search(/\S/),r=e.getLine(n+1),c=e.getLine(n-1),o=c.search(/\S/),a=r.search(/\S/);if(s==-1)return e.foldWidgets[n-1]=o!=-1&&o<a?"start":"","";if(o==-1){if(s==a&&i[s]=="#"&&r[s]=="#")return e.foldWidgets[n-1]="",e.foldWidgets[n+1]="","start"}else if(o==s&&i[s]=="#"&&c[s]=="#"&&e.getLine(n-2).search(/\S/)==-1)return e.foldWidgets[n-1]="start",e.foldWidgets[n+1]="","";return o!=-1&&o<s?e.foldWidgets[n-1]="start":e.foldWidgets[n-1]="",s<a?"start":""}}.call(n.prototype)}),ace.define("ace/mode/matching_brace_outdent",["require","exports","module","ace/range"],function(e,t){"use strict";var s=e("../range").Range,n=function(){};(function(){this.checkOutdent=function(e,t){return!!/^\s+$/.test(e)&&/^\s*\}/.test(t)},this.autoOutdent=function(e,t){var n,o,i,r=e.getLine(t),a=r.match(/^(\s*\})/);if(!a)return 0;if(o=a[1].length,n=e.findMatchingBracket({row:t,column:o}),!n||n.row==t)return 0;i=this.$getIndent(e.getLine(n.row)),e.replace(new s(t,0,t,o-1),i)},this.$getIndent=function(e){return e.match(/^\s*/)[0]}}).call(n.prototype),t.MatchingBraceOutdent=n}),ace.define("ace/mode/logiql",["require","exports","module","ace/lib/oop","ace/mode/text","ace/mode/logiql_highlight_rules","ace/mode/folding/coffee","ace/token_iterator","ace/range","ace/mode/behaviour/cstyle","ace/mode/matching_brace_outdent"],function(e,t){"use strict";var i=e("../lib/oop"),a=e("./text").Mode,r=e("./logiql_highlight_rules").LogiQLHighlightRules,c=e("./folding/coffee").FoldMode,s=e("../token_iterator").TokenIterator,o=e("../range").Range,l=e("./behaviour/cstyle").CstyleBehaviour,d=e("./matching_brace_outdent").MatchingBraceOutdent,n=function(){this.HighlightRules=r,this.foldingRules=new c,this.$outdent=new d,this.$behaviour=new l};i.inherits(n,a),function(){this.lineCommentStart="//",this.blockComment={start:"/*",end:"*/"},this.getNextLineIndent=function(e,t,n){var a,s=this.$getIndent(t),i=this.getTokenizer().getLineTokens(t,e),o=i.tokens,r=i.state;return/comment|string/.test(r)?s:o.length&&o[o.length-1].type=="comment.single"?s:(a=t.match(),/(-->|<--|<-|->|{)\s*$/.test(t)&&(s+=n),s)},this.checkOutdent=function(e,t,n){return!!this.$outdent.checkOutdent(t,n)||(n===`
`||n===`
`)&&!!/^\s+/.test(t)},this.autoOutdent=function(e,t,n){if(this.$outdent.autoOutdent(t,n))return;var s,a,l,r=t.getLine(n),c=r.match(/^\s+/),i=r.lastIndexOf(".")+1;if(!c||!n||!i)return 0;if(l=t.getLine(n+1),s=this.getMatching(t,{row:n,column:i}),!s||s.start.row==n)return 0;i=c[0].length,a=this.$getIndent(t.getLine(s.start.row)),t.replace(new o(n+1,0,n+1,i),a)},this.getMatching=function(e,t,n){t==null&&(t=e.selection.lead),typeof t=="object"&&(n=t.column,t=t.row);var t,i,a,c,r=e.getTokenAt(t,n),l="keyword.start",d="keyword.end";if(!r)return;if(r.type==l)i=new s(e,t,n),i.step=i.stepForward;else if(r.type==d)i=new s(e,t,n),i.step=i.stepBackward;else return;for(;a=i.step();)if(a.type==l||a.type==d)break;if(!a||a.type==r.type)return;return c=i.getCurrentTokenColumn(),t=i.getCurrentTokenRow(),new o(t,c,t,c+a.value.length)},this.$id="ace/mode/logiql"}.call(n.prototype),t.Mode=n}),function(){ace.require(["ace/mode/logiql"],function(e){typeof module=="object"&&typeof exports=="object"&&module&&(module.exports=e)})}()