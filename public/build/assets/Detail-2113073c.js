import{T as t,r as a,N as e,D as l,w as s,o as d,b as o,t as i,u as r,a as n,e as u,O as m,g as c}from"./app-4fa61095.js";import{_ as p}from"./Modal-6f5881bc.js";import{_ as b}from"./UserName-ff67b14b.js";import{_ as h}from"./Timestamp-fd1462d2.js";import{e as w}from"./entity-8103fdfd.js";import{s as f}from"./service-37d69c5a.js";import"./sweetalert2.all-47788bf1.js";const g={class:"modal-header p-3 bg-soft-warning"},_={class:"modal-title"},v={class:"table table-bordered"},x=o("td",{class:"text-muted table-light",width:"100"},"Code",-1),y={colspan:"3"},j=o("td",{class:"text-muted table-light"},"Name",-1),C={colspan:"3"},D=o("td",{class:"text-muted table-light"},"COA",-1),U={colspan:"3"},N=o("td",{class:"text-muted table-light"},"Description",-1),O={colspan:"3",class:"text-wrap"},T=o("td",{class:"text-muted table-light"},"Created By",-1),k=o("td",{class:"text-muted table-light"},"Time",-1),B={width:"150"},A=o("td",{class:"text-muted table-light"},"Updated By",-1),I=o("td",{class:"text-muted table-light"},"Time",-1),L={class:"modal-footer"},M=o("i",{class:"ri-close-line align-bottom me-1"},null,-1),V={__name:"Detail",props:["show","id"],emits:["update:show","update:id"],setup(V,{emit:q}){const z=V,E=w().page,F=t(w().form),G=a(!1);return e(z,(async t=>{F.reset(),t.id?(G.value=!0,await f.showData(F,t.id),G.value=!1):q("update:id",null)})),(t,a)=>{const e=m,w=c;return d(),l(p,{visible:V.show,"onUpdate:visible":a[2]||(a[2]=t=>V.show=t)},{default:s((()=>[o("div",g,[o("h5",_,"Detail View - "+i(r(E).title),1),o("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:a[0]||(a[0]=t=>q("update:show",!1))})]),n(e,{show:G.value,opacity:.25,"spinner-small":"",rounded:"sm"},{default:s((()=>[o("table",v,[o("tbody",null,[o("tr",null,[x,o("td",y,i(r(F).code),1)]),o("tr",null,[j,o("td",C,i(r(F).name),1)]),o("tr",null,[D,o("td",U,i(r(F).coa),1)]),o("tr",null,[N,o("td",O,i(r(F).description),1)]),o("tr",null,[T,o("td",null,[n(b,{data:r(F).created_user?.name},null,8,["data"])]),k,o("td",B,[n(h,{data:r(F).created_at},null,8,["data"])])]),o("tr",null,[A,o("td",null,[n(b,{data:r(F).updated_user?.name},null,8,["data"])]),I,o("td",null,[n(h,{data:r(F).updated_at},null,8,["data"])])])])])])),_:1},8,["show","opacity"]),o("div",L,[n(w,{variant:"light",onClick:a[1]||(a[1]=t=>q("update:show",!1))},{default:s((()=>[M,u(" Close ")])),_:1})])])),_:1},8,["visible"])}}};export{V as default};