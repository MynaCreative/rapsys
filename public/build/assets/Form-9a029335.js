import{T as a,r as e,N as s,D as t,w as o,o as l,b as r,t as i,u as n,a as d,e as m,v as u,n as p,d as c,A as f,O as b,g as v}from"./app-30e0783b.js";import{_ as w}from"./Modal-36df24f3.js";import h from"./Form-5169df1f.js";import{e as g}from"./entity-495a992a.js";import{s as y}from"./service-55e885c2.js";import"./sweetalert2.all-aaaa6da5.js";const _={class:"modal-header p-3 bg-soft-primary"},j={class:"modal-title"},D=["onSubmit"],C={class:"modal-body"},F={class:"modal-footer justify-content-between"},S=r("i",{class:"ri-close-line align-bottom me-1"},null,-1),U={__name:"Form",props:["show","id"],emits:["update:show","update:id"],setup(U,{emit:k}){const A=U,M=g().page,V=a(g().form),x=()=>{y.submitData(V,A.id,k)},E=e(!1);return s(A,(async a=>{V.reset(),a.id?(E.value=!0,await y.showData(V,a.id),E.value=!1):(k("update:id",null),V.reset(),V.clearErrors())})),(a,e)=>{const s=f,g=b,y=v;return l(),t(w,{visible:U.show,"onUpdate:visible":e[3]||(e[3]=a=>U.show=a)},{default:o((()=>[r("div",_,[r("h5",j,"Form "+i(U.id?"Update":"Create")+" - "+i(n(M).title),1),r("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:e[0]||(e[0]=a=>k("update:show",!1))})]),r("form",{onSubmit:c(x,["prevent"])},[d(g,{show:E.value,opacity:.25,"spinner-small":"",rounded:"sm"},{default:o((()=>[r("div",C,[d(s,{modelValue:!!n(V).errors.error,variant:"danger"},{default:o((()=>[m(i(n(V).errors.error),1)])),_:1},8,["modelValue"]),d(h,{formData:n(V),"onUpdate:formData":e[1]||(e[1]=a=>u(V)?V.value=a:null)},null,8,["formData"])])])),_:1},8,["show","opacity"]),r("div",F,[d(y,{variant:"light",onClick:e[2]||(e[2]=a=>k("update:show",!1))},{default:o((()=>[S,m(" Close ")])),_:1}),d(y,{type:"submit",variant:"primary",class:"btn-label waves-effect waves-light",disabled:n(V).processing},{default:o((()=>[r("i",{class:p(["label-icon align-middle fs-16 me-2",n(V).processing?"ri-refresh-line":"ri-save-line"])},null,2),m(" "+i(n(V).processing?"Processing":"Save"),1)])),_:1},8,["disabled"])])],40,D)])),_:1},8,["visible"])}}};export{U as default};