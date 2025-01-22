ace.define("ace/ext/rtl",["require","exports","module","ace/editor","ace/config"],function(e){"use strict";var n=[{name:"leftToRight",bindKey:{win:"Ctrl-Alt-Shift-L",mac:"Command-Alt-Shift-L"},exec:function(e){e.session.$bidiHandler.setRtlDirection(e,!1)},readOnly:!0},{name:"rightToLeft",bindKey:{win:"Ctrl-Alt-Shift-R",mac:"Command-Alt-Shift-R"},exec:function(e){e.session.$bidiHandler.setRtlDirection(e,!0)},readOnly:!0}],r=e("../editor").Editor;e("../config").defineOptions(r.prototype,"editor",{rtlText:{set:function(e){e?(this.on("change",i),this.on("changeSelection",s),this.renderer.on("afterRender",t),this.commands.on("exec",o),this.commands.addCommands(n)):(this.off("change",i),this.off("changeSelection",s),this.renderer.off("afterRender",t),this.commands.off("exec",o),this.commands.removeCommands(n),a(this.renderer)),this.renderer.updateFull()}},rtl:{set:function(e){this.session.$bidiHandler.$isRtl=e,e?(this.setOption("rtlText",!1),this.renderer.on("afterRender",t),this.session.$bidiHandler.seenBidi=!0):(this.renderer.off("afterRender",t),a(this.renderer)),this.renderer.updateFull()}}});function s(e,t){var n=t.getSelection().lead;t.session.$bidiHandler.isRtlLine(n.row)&&n.column===0&&(t.session.$bidiHandler.isMoveLeftOperation&&n.row>0?t.getSelection().moveCursorTo(n.row-1,t.session.getLine(n.row-1).length):t.getSelection().isEmpty()?n.column+=1:n.setPosition(n.row,n.column+1))}function o(e){e.editor.session.$bidiHandler.isMoveLeftOperation=/gotoleft|selectleft|backspace|removewordleft/.test(e.command.name)}function i(e,t){var s,n=t.session;if(n.$bidiHandler.currentRow=null,n.$bidiHandler.isRtlLine(e.start.row)&&e.action==="insert"&&e.lines.length>1)for(s=e.start.row;s<e.end.row;s++)n.getLine(s+1).charAt(0)!==n.$bidiHandler.RLE&&(n.doc.$lines[s+1]=n.$bidiHandler.RLE+n.getLine(s+1))}function t(e,t){var s=t.session,n=s.$bidiHandler,o=t.$textLayer.$lines.cells,i=t.layerConfig.width-t.layerConfig.padding+"px";o.forEach(function(e){var t=e.element.style;n&&n.isRtlLine(e.row)?(t.direction="rtl",t.textAlign="right",t.width=i):(t.direction="",t.textAlign="",t.width="")})}function a(e){var t=e.$textLayer.$lines;t.cells.forEach(n),t.cellCache.forEach(n);function n(e){var t=e.element.style;t.direction=t.textAlign=t.width=""}}}),function(){ace.require(["ace/ext/rtl"],function(e){typeof module=="object"&&typeof exports=="object"&&module&&(module.exports=e)})}()