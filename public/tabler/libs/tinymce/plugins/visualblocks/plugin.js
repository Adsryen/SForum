(function(){"use strict";const s=e=>{let t=e;const n=()=>t,s=e=>{t=e};return{get:n,set:s}};var n,o=tinymce.util.Tools.resolve("tinymce.PluginManager");const i=(e,t)=>{e.dispatch("VisualBlocks",{state:t})},e=(e,t,n)=>{const s=e.dom;s.toggleClass(e.getBody(),"mce-visualblocks"),n.set(!n.get()),i(e,n.get())},a=(t,n,s)=>{t.addCommand("mceVisualBlocks",()=>{e(t,n,s)})},r=e=>t=>t.options.get(e),c=e=>{const t=e.options.register;t("visualblocks_default_state",{processor:"boolean",default:!1})},l=r("visualblocks_default_state"),d=(t,n,s)=>{t.on("PreviewFormats AfterPreviewFormats",e=>{s.get()&&t.dom.toggleClass(t.getBody(),"mce-visualblocks",e.type==="afterpreviewformats")}),t.on("init",()=>{l(t)&&e(t,n,s)})},t=(e,t)=>n=>{n.setActive(t.get());const s=e=>n.setActive(e.state);return e.on("VisualBlocks",s),()=>e.off("VisualBlocks",s)},u=(e,n)=>{const s=()=>e.execCommand("mceVisualBlocks");e.ui.registry.addToggleButton("visualblocks",{icon:"visualblocks",tooltip:"Show blocks",onAction:s,onSetup:t(e,n)}),e.ui.registry.addToggleMenuItem("visualblocks",{text:"Show blocks",icon:"visualblocks",onAction:s,onSetup:t(e,n)})};n=()=>{o.add("visualblocks",(e,t)=>{c(e);const n=s(!1);a(e,t,n),u(e,n),d(e,t,n)})},n()})()