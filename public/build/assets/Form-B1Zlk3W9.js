import{T as a,r as e,N as s,o as t,D as o,w as r,b as l,t as i,u as n,a as d,e as m,U as u,n as p,d as c,A as f,O as b,h as v}from"./app-C9OX3ezV.js";import{_ as h}from"./Modal-C-7wPC8u.js";import w from"./Form-Dx5MBaLu.js";import{e as g}from"./entity-DOS18pl2.js";import{s as y}from"./service-DCGLJnov.js";import"./sweetalert2.all-BBb44_lw.js";const _={class:"modal-header p-3 bg-soft-primary"},j={class:"modal-title"},D={class:"modal-body"},C={class:"modal-footer justify-content-between"},U=l("i",{class:"ri-close-line align-bottom me-1"},null,-1),F={__name:"Form",props:["show","id"],emits:["update:show","update:id"],setup(F,{emit:k}){const M=g().page,P=F,S=k,V=a(g().form),q=()=>{y.submitData(V,P.id,S)},x=e(!1);return s(P,(async a=>{V.reset(),a.id?(x.value=!0,await y.showData(V,a.id),x.value=!1):(S("update:id",null),V.reset(),V.clearErrors())})),(a,e)=>{const s=f,g=b,y=v;return t(),o(h,{visible:F.show,"onUpdate:visible":e[3]||(e[3]=a=>F.show=a)},{default:r((()=>[l("div",_,[l("h5",j,"Form "+i(F.id?"Update":"Create")+" - "+i(n(M).title),1),l("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:e[0]||(e[0]=a=>S("update:show",!1))})]),l("form",{onSubmit:c(q,["prevent"])},[d(g,{show:x.value,opacity:.25,"spinner-small":"",rounded:"sm"},{default:r((()=>[l("div",D,[d(s,{modelValue:!!n(V).errors.error,variant:"danger"},{default:r((()=>[m(i(n(V).errors.error),1)])),_:1},8,["modelValue"]),d(w,{formData:n(V),"onUpdate:formData":e[1]||(e[1]=a=>u(V)?V.value=a:null)},null,8,["formData"])])])),_:1},8,["show"]),l("div",C,[d(y,{variant:"light",onClick:e[2]||(e[2]=a=>S("update:show",!1))},{default:r((()=>[U,m(" Close ")])),_:1}),d(y,{type:"submit",variant:"primary",class:"btn-label waves-effect waves-light",disabled:n(V).processing},{default:r((()=>[l("i",{class:p(["label-icon align-middle fs-16 me-2",n(V).processing?"ri-refresh-line":"ri-save-line"])},null,2),m(" "+i(n(V).processing?"Processing":"Save"),1)])),_:1},8,["disabled"])])],32)])),_:1},8,["visible"])}}};export{F as default};