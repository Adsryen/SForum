(function(){"use strict";var n,o,i,d=tinymce.util.Tools.resolve("tinymce.PluginManager");const g=e=>t=>typeof t===e,s=g("function");o=tinymce.util.Tools.resolve("tinymce.dom.DOMUtils"),i=tinymce.util.Tools.resolve("tinymce.util.Tools");const e=e=>t=>t.options.get(e),f=e=>{const t=e.options.register;t("save_enablewhendirty",{processor:"boolean",default:!0}),t("save_onsavecallback",{processor:"function"}),t("save_oncancelcallback",{processor:"function"})},r=e("save_enablewhendirty"),c=e("save_onsavecallback"),l=e("save_oncancelcallback"),t=(e,t)=>{e.notificationManager.open({text:t,type:"error"})},u=e=>{const n=o.DOM.getParent(e.id,"form");if(r(e)&&!e.isDirty())return;e.save();const i=c(e);if(s(i)){i.call(e,e),e.nodeChanged();return}n?(e.setDirty(!1),(!n.onsubmit||n.onsubmit())&&(typeof n.submit=="function"?n.submit():t(e,"Error: Form submit field collision.")),e.nodeChanged()):t(e,"Error: No form element found.")},h=e=>{const n=i.trim(e.startContent),t=l(e);if(s(t)){t.call(e,e);return}e.resetContent(n)},m=e=>{e.addCommand("mceSave",()=>{u(e)}),e.addCommand("mceCancel",()=>{h(e)})},a=e=>t=>{const n=()=>{t.setEnabled(!r(e)||e.isDirty())};return n(),e.on("NodeChange dirty",n),()=>e.off("NodeChange dirty",n)},p=e=>{e.ui.registry.addButton("save",{icon:"save",tooltip:"Save",enabled:!1,onAction:()=>e.execCommand("mceSave"),onSetup:a(e)}),e.ui.registry.addButton("cancel",{icon:"cancel",tooltip:"Cancel",enabled:!1,onAction:()=>e.execCommand("mceCancel"),onSetup:a(e)}),e.addShortcut("Meta+S","","mceSave")};n=()=>{d.add("save",e=>{f(e),p(e),m(e)})},n()})()