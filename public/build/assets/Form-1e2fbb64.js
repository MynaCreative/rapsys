import{T as e,r as s,N as a,D as r,w as t,o,b as l,t as i,u as n,a as d,e as m,v as u,n as p,d as c,A as f,O as b,g as v}from"./app-fcd4ac94.js";import{_ as w}from"./Modal-2334fec4.js";import h from"./Form-a355e6ba.js";import{e as g}from"./entity-5640715f.js";import{s as y}from"./service-a92b152d.js";import"./multiselect-202337d9.js";import"./sweetalert2.all-6f2ad051.js";const j={class:"modal-header p-3 bg-soft-primary"},_={class:"modal-title"},D=["onSubmit"],C={class:"modal-body"},U={class:"modal-footer justify-content-between"},k=l("i",{class:"ri-close-line align-bottom me-1"},null,-1),F={__name:"Form",props:["show","id","references"],emits:["update:show","update:id"],setup(F,{emit:S}){const V=F,x=g().page,A=e(g().form),E=()=>{y.submitData(A,V.id,S)},G=s(!1);return a(V,(async e=>{A.reset(),e.id?(G.value=!0,await y.showData(A,e.id),G.value=!1):(S("update:id",null),A.reset(),A.clearErrors())})),(e,s)=>{const a=f,g=b,y=v;return o(),r(w,{visible:F.show,"onUpdate:visible":s[3]||(s[3]=e=>F.show=e)},{default:t((()=>[l("div",j,[l("h5",_,"Form "+i(F.id?"Update":"Create")+" - "+i(n(x).title),1),l("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:s[0]||(s[0]=e=>S("update:show",!1))})]),l("form",{onSubmit:c(E,["prevent"])},[d(g,{show:G.value,opacity:.25,"spinner-small":"",rounded:"sm"},{default:t((()=>[l("div",C,[d(a,{modelValue:!!n(A).errors.error,variant:"danger"},{default:t((()=>[m(i(n(A).errors.error),1)])),_:1},8,["modelValue"]),d(h,{formData:n(A),"onUpdate:formData":s[1]||(s[1]=e=>u(A)?A.value=e:null),references:F.references},null,8,["formData","references"])])])),_:1},8,["show","opacity"]),l("div",U,[d(y,{variant:"light",onClick:s[2]||(s[2]=e=>S("update:show",!1))},{default:t((()=>[k,m(" Close ")])),_:1}),d(y,{type:"submit",variant:"primary",class:"btn-label waves-effect waves-light",disabled:n(A).processing},{default:t((()=>[l("i",{class:p(["label-icon align-middle fs-16 me-2",n(A).processing?"ri-refresh-line":"ri-save-line"])},null,2),m(" "+i(n(A).processing?"Processing":"Save"),1)])),_:1},8,["disabled"])])],40,D)])),_:1},8,["visible"])}}};export{F as default};
