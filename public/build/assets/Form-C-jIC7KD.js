import{T as a,r as e,N as s,o as t,D as o,w as l,b as r,t as i,u as n,a as d,e as m,U as u,n as p,d as c,A as f,O as b,h as v}from"./app-DSTM3SJ3.js";import{_ as h}from"./Modal-1mpmqj-q.js";import w from"./Form-Xb6NbsWF.js";import{e as g}from"./entity-CC1RBiXM.js";import{s as y}from"./service-ClYyo29M.js";import"./sweetalert2.all-BaCSOYxu.js";const _={class:"modal-header p-3 bg-soft-primary"},j={class:"modal-title"},D={class:"modal-body"},C={class:"modal-footer justify-content-between"},U=r("i",{class:"ri-close-line align-bottom me-1"},null,-1),F={__name:"Form",props:["show","id"],emits:["update:show","update:id"],setup(F,{emit:k}){const M=g().page,S=F,V=k,x=a(g().form),A=()=>{y.submitData(x,S.id,V)},E=e(!1);return s(S,(async a=>{x.reset(),a.id?(E.value=!0,await y.showData(x,a.id),E.value=!1):(V("update:id",null),x.reset(),x.clearErrors())})),(a,e)=>{const s=f,g=b,y=v;return t(),o(h,{visible:F.show,"onUpdate:visible":e[3]||(e[3]=a=>F.show=a)},{default:l((()=>[r("div",_,[r("h5",j,"Form "+i(F.id?"Update":"Create")+" - "+i(n(M).title),1),r("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:e[0]||(e[0]=a=>V("update:show",!1))})]),r("form",{onSubmit:c(A,["prevent"])},[d(g,{show:E.value,opacity:.25,"spinner-small":"",rounded:"sm"},{default:l((()=>[r("div",D,[d(s,{modelValue:!!n(x).errors.error,variant:"danger"},{default:l((()=>[m(i(n(x).errors.error),1)])),_:1},8,["modelValue"]),d(w,{formData:n(x),"onUpdate:formData":e[1]||(e[1]=a=>u(x)?x.value=a:null)},null,8,["formData"])])])),_:1},8,["show"]),r("div",C,[d(y,{variant:"light",onClick:e[2]||(e[2]=a=>V("update:show",!1))},{default:l((()=>[U,m(" Close ")])),_:1}),d(y,{type:"submit",variant:"primary",class:"btn-label waves-effect waves-light",disabled:n(x).processing},{default:l((()=>[r("i",{class:p(["label-icon align-middle fs-16 me-2",n(x).processing?"ri-refresh-line":"ri-save-line"])},null,2),m(" "+i(n(x).processing?"Processing":"Save"),1)])),_:1},8,["disabled"])])],32)])),_:1},8,["visible"])}}};export{F as default};
