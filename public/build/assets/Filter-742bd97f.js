import{D as s,w as a,o as e,b as o,a as t,e as l,g as i}from"./app-30e0783b.js";import{_ as r}from"./Modal-36df24f3.js";const p={class:"modal-header p-3 bg-soft-primary"},d=o("h5",{class:"modal-title"},"Report Filter - Invoice Header",-1),n={class:"modal-footer"},m=o("i",{class:"ri-close-line align-bottom me-1"},null,-1),c={__name:"Filter",props:["show"],emits:["update:show"],setup:(c,{emit:u})=>(b,h)=>{const f=i;return e(),s(r,{visible:c.show,"onUpdate:visible":h[2]||(h[2]=s=>c.show=s)},{default:a((()=>[o("div",p,[d,o("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:h[0]||(h[0]=s=>u("update:show",!1))})]),o("div",n,[t(f,{variant:"light",onClick:h[1]||(h[1]=s=>u("update:show",!1))},{default:a((()=>[m,l(" Close ")])),_:1})])])),_:1},8,["visible"])}};export{c as default};
