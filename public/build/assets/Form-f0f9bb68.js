import{T as a,N as e,D as s,w as t,o,b as l,t as r,u as i,a as n,e as d,v as m,n as p,d as u,A as c,g as b}from"./app-4fa61095.js";import{_ as f}from"./Modal-6f5881bc.js";import v from"./Form-68487eb3.js";import{s as g,e as h}from"./service-e2f3aaba.js";import"./sweetalert2.all-47788bf1.js";const w={class:"modal-header p-3 bg-soft-primary"},y={class:"modal-title"},_=["onSubmit"],j={class:"modal-body"},D={class:"modal-footer justify-content-between"},C=l("i",{class:"ri-close-line align-bottom me-1"},null,-1),U={__name:"Form",props:["show","id"],emits:["update:show","update:id"],setup(U,{emit:F}){const S=U,k=h().page,V=a(h().form),x=()=>{g.submitData(V,S.id,F)};return e(S,(async a=>{a.id?g.showData(V,a.id):(F("update:id",null),V.reset(),V.clearErrors())})),(a,e)=>{const g=c,h=b;return o(),s(f,{visible:U.show,"onUpdate:visible":e[3]||(e[3]=a=>U.show=a)},{default:t((()=>[l("div",w,[l("h5",y,"Form "+r(U.id?"Update":"Create")+" - "+r(i(k).title),1),l("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:e[0]||(e[0]=a=>F("update:show",!1))})]),l("form",{onSubmit:u(x,["prevent"])},[l("div",j,[n(g,{modelValue:!!i(V).errors.error,variant:"danger"},{default:t((()=>[d(r(i(V).errors.error),1)])),_:1},8,["modelValue"]),n(v,{formData:i(V),"onUpdate:formData":e[1]||(e[1]=a=>m(V)?V.value=a:null)},null,8,["formData"])]),l("div",D,[n(h,{variant:"light",onClick:e[2]||(e[2]=a=>F("update:show",!1))},{default:t((()=>[C,d(" Close ")])),_:1}),n(h,{type:"submit",variant:"primary",class:"btn-label waves-effect waves-light",disabled:i(V).processing},{default:t((()=>[l("i",{class:p(["label-icon align-middle fs-16 me-2",i(V).processing?"ri-refresh-line":"ri-save-line"])},null,2),d(" "+r(i(V).processing?"Processing":"Save"),1)])),_:1},8,["disabled"])])],40,_)])),_:1},8,["visible"])}}};export{U as default};