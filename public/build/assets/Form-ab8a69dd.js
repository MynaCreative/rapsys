import{s as e,c as a,b as l,a as s,u as o,n as i,H as n,I as c,f as r,J as d,R as t,o as u}from"./app-30e0783b.js";import"./multiselect-31bf4223.js";const m={class:"row g-2"},p={class:"col-lg-6"},b=l("label",{for:"name",class:"form-label"},"Name",-1),f={class:"col-lg-6"},V=l("label",{for:"code",class:"form-label"},"Code",-1),_={class:"col-lg-6"},v=l("label",{for:"coa",class:"form-label"},"COA",-1),H={class:"col-lg-6"},M=l("label",{for:"coa_description",class:"form-label"},"COA Description",-1),T={class:"col-lg-6"},k=l("label",{for:"icon",class:"form-label"},"Icon",-1),y={class:"col-lg-6"},L=l("label",{for:"type",class:"form-label"},"Type",-1),g={class:"col-lg-6"},w=l("label",{for:"with_scan",class:"form-label"},"With Scan",-1),U={class:"col-lg-6"},h=l("label",{for:"or_scan",class:"form-label"},"Or Scan",-1),D={class:"col-lg-12"},x=l("label",{class:"form-label"},"Description",-1),A={__name:"Form",props:["formData"],emits:["update:formData"],setup(A,{emit:C}){const O=A,S=e({get:()=>O.formData,set(e){C("update:formData",e)}});return(e,A)=>{const C=r,O=d,j=t;return u(),a("div",m,[l("div",p,[b,s(C,{id:"name",modelValue:o(S).name,"onUpdate:modelValue":A[0]||(A[0]=e=>o(S).name=e),class:i({"is-invalid":o(S).errors.name}),"aria-describedby":"input-name-feedback"},null,8,["modelValue","class"]),s(O,{id:"input-name-feedback",innerHTML:o(S).errors.name},null,8,["innerHTML"])]),l("div",f,[V,s(C,{id:"code",modelValue:o(S).code,"onUpdate:modelValue":A[1]||(A[1]=e=>o(S).code=e),class:i({"is-invalid":o(S).errors.code}),"aria-describedby":"input-code-feedback",autofocus:""},null,8,["modelValue","class"]),s(O,{id:"input-code-feedback",innerHTML:o(S).errors.code},null,8,["innerHTML"])]),l("div",_,[v,s(C,{id:"coa",modelValue:o(S).coa,"onUpdate:modelValue":A[2]||(A[2]=e=>o(S).coa=e),class:i({"is-invalid":o(S).errors.coa}),"aria-describedby":"input-coa-feedback"},null,8,["modelValue","class"]),s(O,{id:"input-coa-feedback",innerHTML:o(S).errors.coa},null,8,["innerHTML"])]),l("div",H,[M,s(C,{id:"coa_description",modelValue:o(S).coa_description,"onUpdate:modelValue":A[3]||(A[3]=e=>o(S).coa_description=e),class:i({"is-invalid":o(S).errors.coa_description}),"aria-describedby":"input-coa_description-feedback"},null,8,["modelValue","class"]),s(O,{id:"input-coa_description-feedback",innerHTML:o(S).errors.coa_description},null,8,["innerHTML"])]),l("div",T,[k,s(C,{id:"icon",modelValue:o(S).icon,"onUpdate:modelValue":A[4]||(A[4]=e=>o(S).icon=e),class:i({"is-invalid":o(S).errors.icon}),"aria-describedby":"input-icon-feedback"},null,8,["modelValue","class"]),s(O,{id:"input-icon-feedback",innerHTML:o(S).errors.icon},null,8,["innerHTML"])]),l("div",y,[L,s(j,{class:i({"is-invalid":o(S).errors.type}),modelValue:o(S).type,"onUpdate:modelValue":A[5]||(A[5]=e=>o(S).type=e),options:[{text:"None",value:null},{text:"SMU",value:1},{text:"AWB",value:2}],"aria-describedby":"input-type-feedback"},null,8,["class","modelValue"]),s(O,{id:"input-type-feedback",innerHTML:o(S).errors.type},null,8,["innerHTML"])]),l("div",g,[w,s(C,{id:"with_scan",modelValue:o(S).with_scan,"onUpdate:modelValue":A[6]||(A[6]=e=>o(S).with_scan=e),class:i({"is-invalid":o(S).errors.with_scan}),"aria-describedby":"input-with_scan-feedback"},null,8,["modelValue","class"]),s(O,{id:"input-with_scan-feedback",innerHTML:o(S).errors.with_scan},null,8,["innerHTML"])]),l("div",U,[h,s(C,{id:"or_scan",modelValue:o(S).or_scan,"onUpdate:modelValue":A[7]||(A[7]=e=>o(S).or_scan=e),class:i({"is-invalid":o(S).errors.or_scan}),"aria-describedby":"input-or_scan-feedback"},null,8,["modelValue","class"]),s(O,{id:"input-or_scan-feedback",innerHTML:o(S).errors.or_scan},null,8,["innerHTML"])]),l("div",D,[x,n(l("textarea",{class:"form-control","onUpdate:modelValue":A[8]||(A[8]=e=>o(S).description=e),rows:"4"},null,512),[[c,o(S).description]])])])}}};export{A as default};