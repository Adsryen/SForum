ace.define("ace/mode/vhdl_highlight_rules",["require","exports","module","ace/lib/oop","ace/mode/text_highlight_rules"],function(e,t){"use strict";var s=e("../lib/oop"),o=e("./text_highlight_rules").TextHighlightRules,n=function(){var e="access|after|ailas|all|architecture|assert|attribute|begin|block|buffer|bus|case|component|configuration|disconnect|downto|else|elsif|end|entity|file|for|function|generate|generic|guarded|if|impure|in|inertial|inout|is|label|linkage|literal|loop|mapnew|next|of|on|open|others|out|port|process|pure|range|record|reject|report|return|select|severity|shared|signal|subtype|then|to|transport|type|unaffected|united|until|wait|when|while|with",t="bit|bit_vector|boolean|character|integer|line|natural|positive|real|register|signed|std_logic|std_logic_vector|string||text|time|unsigned|variable",n="array|constant",s="abs|and|mod|nand|nor|not|rem|rol|ror|sla|sll|srasrl|xnor|xor",o="true|false|null",i=this.createKeywordMapper({"keyword.operator":s,keyword:e,"constant.language":o,"storage.modifier":n,"storage.type":t},"identifier",!0);this.$rules={start:[{token:"comment",regex:"--.*$"},{token:"string",regex:'".*?"'},{token:"string",regex:"'.*?'"},{token:"constant.numeric",regex:"[+-]?\\d+(?:(?:\\.\\d*)?(?:[eE][+-]?\\d+)?)?\\b"},{token:"keyword",regex:"\\s*(?:library|package|use)\\b"},{token:i,regex:"[a-zA-Z_$][a-zA-Z0-9_$]*\\b"},{token:"keyword.operator",regex:"&|\\*|\\+|\\-|\\/|<|=|>|\\||=>|\\*\\*|:=|\\/=|>=|<=|<>"},{token:"punctuation.operator",regex:"\\'|\\:|\\,|\\;|\\."},{token:"paren.lparen",regex:"[[(]"},{token:"paren.rparen",regex:"[\\])]"},{token:"text",regex:"\\s+"}]}};s.inherits(n,o),t.VHDLHighlightRules=n}),ace.define("ace/mode/vhdl",["require","exports","module","ace/lib/oop","ace/mode/text","ace/mode/vhdl_highlight_rules"],function(e,t){"use strict";var s=e("../lib/oop"),o=e("./text").Mode,i=e("./vhdl_highlight_rules").VHDLHighlightRules,n=function(){this.HighlightRules=i,this.$behaviour=this.$defaultBehaviour};s.inherits(n,o),function(){this.lineCommentStart="--",this.$id="ace/mode/vhdl"}.call(n.prototype),t.Mode=n}),function(){ace.require(["ace/mode/vhdl"],function(e){typeof module=="object"&&typeof exports=="object"&&module&&(module.exports=e)})}()