import{s as a,c as e,b as l,a as s,u as o,n as d,H as r,I as n,f as i,J as c,o as t}from"./app-891c8d04.js";const m={class:"row g-2"},u={class:"col-lg-12"},f=l("label",{for:"code",class:"form-label"},"Code",-1),p={class:"col-lg-12"},b=l("label",{for:"name",class:"form-label"},"Name",-1),y={class:"col-lg-12"},V=l("label",{for:"day",class:"form-label"},"Day",-1),v={class:"col-lg-12"},H=l("label",{class:"form-label"},"Description",-1),g={__name:"Form",props:["formData"],emits:["update:formData"],setup(g,{emit:k}){const D=g,L=a({get:()=>D.formData,set(a){k("update:formData",a)}});return(a,g)=>{const k=i,D=c;return t(),e("div",m,[l("div",u,[f,s(k,{id:"code",modelValue:o(L).code,"onUpdate:modelValue":g[0]||(g[0]=a=>o(L).code=a),class:d({"is-invalid":o(L).errors.code}),"aria-describedby":"input-code-feedback"},null,8,["modelValue","class"]),s(D,{id:"input-code-feedback",innerHTML:o(L).errors.code},null,8,["innerHTML"])]),l("div",p,[b,s(k,{id:"name",modelValue:o(L).name,"onUpdate:modelValue":g[1]||(g[1]=a=>o(L).name=a),class:d({"is-invalid":o(L).errors.name}),"aria-describedby":"input-name-feedback",autofocus:""},null,8,["modelValue","class"]),s(D,{id:"input-name-feedback",innerHTML:o(L).errors.name},null,8,["innerHTML"])]),l("div",y,[V,s(k,{id:"day",modelValue:o(L).day,"onUpdate:modelValue":g[2]||(g[2]=a=>o(L).day=a),class:d({"is-invalid":o(L).errors.day}),"aria-describedby":"input-day-feedback"},null,8,["modelValue","class"]),s(D,{id:"input-day-feedback",innerHTML:o(L).errors.day},null,8,["innerHTML"])]),l("div",v,[H,r(l("textarea",{class:"form-control","onUpdate:modelValue":g[3]||(g[3]=a=>o(L).description=a),rows:"4"},null,512),[[n,o(L).description]])])])}}};export{g as default};