import{T as a,r as e,N as s,D as t,w as o,o as l,b as r,t as i,u as n,a as d,e as m,v as u,n as p,d as c,A as f,O as b,g as v}from"./app-fcd4ac94.js";import{_ as w}from"./Modal-2334fec4.js";import h from"./Form-a68b737b.js";import{e as g}from"./entity-ea7026f7.js";import{s as y}from"./service-cc577330.js";import"./sweetalert2.all-6f2ad051.js";const _={class:"modal-header p-3 bg-soft-primary"},j={class:"modal-title"},D=["onSubmit"],C={class:"modal-body"},U={class:"modal-footer justify-content-between"},F=r("i",{class:"ri-close-line align-bottom me-1"},null,-1),S={__name:"Form",props:["show","id"],emits:["update:show","update:id"],setup(S,{emit:k}){const V=S,x=g().page,A=a(g().form),E=()=>{y.submitData(A,V.id,k)},I=e(!1);return s(V,(async a=>{A.reset(),a.id?(I.value=!0,await y.showData(A,a.id),I.value=!1):(k("update:id",null),A.reset(),A.clearErrors())})),(a,e)=>{const s=f,g=b,y=v;return l(),t(w,{visible:S.show,"onUpdate:visible":e[3]||(e[3]=a=>S.show=a)},{default:o((()=>[r("div",_,[r("h5",j,"Form "+i(S.id?"Update":"Create")+" - "+i(n(x).title),1),r("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:e[0]||(e[0]=a=>k("update:show",!1))})]),r("form",{onSubmit:c(E,["prevent"])},[d(g,{show:I.value,opacity:.25,"spinner-small":"",rounded:"sm"},{default:o((()=>[r("div",C,[d(s,{modelValue:!!n(A).errors.error,variant:"danger"},{default:o((()=>[m(i(n(A).errors.error),1)])),_:1},8,["modelValue"]),d(h,{formData:n(A),"onUpdate:formData":e[1]||(e[1]=a=>u(A)?A.value=a:null)},null,8,["formData"])])])),_:1},8,["show","opacity"]),r("div",U,[d(y,{variant:"light",onClick:e[2]||(e[2]=a=>k("update:show",!1))},{default:o((()=>[F,m(" Close ")])),_:1}),d(y,{type:"submit",variant:"primary",class:"btn-label waves-effect waves-light",disabled:n(A).processing},{default:o((()=>[r("i",{class:p(["label-icon align-middle fs-16 me-2",n(A).processing?"ri-refresh-line":"ri-save-line"])},null,2),m(" "+i(n(A).processing?"Processing":"Save"),1)])),_:1},8,["disabled"])])],40,D)])),_:1},8,["visible"])}}};export{S as default};
