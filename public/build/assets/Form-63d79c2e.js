import{T as e,N as s,D as a,w as r,o as t,b as o,t as l,u as i,a as n,e as d,v as m,n as c,d as p,A as u,g as f}from"./app-fcd4ac94.js";import{_ as b}from"./Modal-2334fec4.js";import v from"./Form-70f978d4.js";import{s as g,e as h}from"./service-ef1a1aea.js";import"./multiselect-202337d9.js";import"./sweetalert2.all-6f2ad051.js";const w={class:"modal-header p-3 bg-soft-primary"},j={class:"modal-title"},y=["onSubmit"],_={class:"modal-body"},D={class:"modal-footer justify-content-between"},C=o("i",{class:"ri-close-line align-bottom me-1"},null,-1),U={__name:"Form",props:["show","id","references"],emits:["update:show","update:id"],setup(U,{emit:F}){const S=U,k=h().page,V=e(h().form),x=()=>{g.submitData(V,S.id,F)};return s(S,(async e=>{e.id?g.showData(V,e.id):(F("update:id",null),V.reset(),V.clearErrors())})),(e,s)=>{const g=u,h=f;return t(),a(b,{visible:U.show,"onUpdate:visible":s[3]||(s[3]=e=>U.show=e)},{default:r((()=>[o("div",w,[o("h5",j,"Form "+l(U.id?"Update":"Create")+" - "+l(i(k).title),1),o("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:s[0]||(s[0]=e=>F("update:show",!1))})]),o("form",{onSubmit:p(x,["prevent"])},[o("div",_,[n(g,{modelValue:!!i(V).errors.error,variant:"danger"},{default:r((()=>[d(l(i(V).errors.error),1)])),_:1},8,["modelValue"]),n(v,{formData:i(V),"onUpdate:formData":s[1]||(s[1]=e=>m(V)?V.value=e:null),references:U.references},null,8,["formData","references"])]),o("div",D,[n(h,{variant:"light",onClick:s[2]||(s[2]=e=>F("update:show",!1))},{default:r((()=>[C,d(" Close ")])),_:1}),n(h,{type:"submit",variant:"primary",class:"btn-label waves-effect waves-light",disabled:i(V).processing},{default:r((()=>[o("i",{class:c(["label-icon align-middle fs-16 me-2",i(V).processing?"ri-refresh-line":"ri-save-line"])},null,2),d(" "+l(i(V).processing?"Processing":"Save"),1)])),_:1},8,["disabled"])])],40,y)])),_:1},8,["visible"])}}};export{U as default};
