import{v as a,o as e,c as l,b as o,a as s,n as r,G as c,H as d,g as n,J as i}from"./app-DSTM3SJ3.js";const u={class:"row g-2"},t={class:"col-lg-12"},m=o("label",{for:"code",class:"form-label"},"Code",-1),v={class:"col-lg-12"},f=o("label",{for:"name",class:"form-label"},"Name",-1),p={class:"col-lg-12"},b=o("label",{for:"coa",class:"form-label"},"COA",-1),V={class:"col-lg-12"},g=o("label",{class:"form-label"},"Description",-1),H={__name:"Form",props:["formData"],emits:["update:formData"],setup(H,{emit:k}){const L=H,M=k,T=a({get:()=>L.formData,set(a){M("update:formData",a)}});return(a,H)=>{const k=n,L=i;return e(),l("div",u,[o("div",t,[m,s(k,{id:"code",modelValue:T.value.code,"onUpdate:modelValue":H[0]||(H[0]=a=>T.value.code=a),class:r({"is-invalid":T.value.errors.code}),"aria-describedby":"input-code-feedback"},null,8,["modelValue","class"]),s(L,{id:"input-code-feedback",innerHTML:T.value.errors.code},null,8,["innerHTML"])]),o("div",v,[f,s(k,{id:"name",modelValue:T.value.name,"onUpdate:modelValue":H[1]||(H[1]=a=>T.value.name=a),class:r({"is-invalid":T.value.errors.name}),"aria-describedby":"input-name-feedback",autofocus:""},null,8,["modelValue","class"]),s(L,{id:"input-name-feedback",innerHTML:T.value.errors.name},null,8,["innerHTML"])]),o("div",p,[b,s(k,{id:"coa",modelValue:T.value.coa,"onUpdate:modelValue":H[2]||(H[2]=a=>T.value.coa=a),class:r({"is-invalid":T.value.errors.coa}),"aria-describedby":"input-coa-feedback",autofocus:""},null,8,["modelValue","class"]),s(L,{id:"input-coa-feedback",innerHTML:T.value.errors.coa},null,8,["innerHTML"])]),o("div",V,[g,c(o("textarea",{class:"form-control","onUpdate:modelValue":H[3]||(H[3]=a=>T.value.description=a),rows:"4"},null,512),[[d,T.value.description]])])])}}};export{H as default};
