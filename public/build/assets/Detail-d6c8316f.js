import{T as t,r as a,N as e,D as l,w as s,o as d,b as o,t as i,u as r,a as n,e as u,O as m,g as c}from"./app-891c8d04.js";import{_ as p}from"./Modal-9511757c.js";import{_ as b}from"./UserName-bf87c315.js";import{_ as h}from"./Timestamp-4502638c.js";import{e as w}from"./entity-1b790db8.js";import{s as g}from"./service-1490e3b1.js";import"./sweetalert2.all-3ba2fbff.js";const f={class:"modal-header p-3 bg-soft-warning"},_={class:"modal-title"},v={class:"table table-bordered"},x=o("td",{class:"text-muted table-light",width:"100"},"Code",-1),y={colspan:"3"},j=o("td",{class:"text-muted table-light"},"Name",-1),C={colspan:"3"},D=o("td",{class:"text-muted table-light"},"COA",-1),N={colspan:"3"},T=o("td",{class:"text-muted table-light"},"Description",-1),U={colspan:"3",class:"text-wrap"},k=o("td",{class:"text-muted table-light"},"Created By",-1),A=o("td",{class:"text-muted table-light"},"Time",-1),B={width:"150"},M=o("td",{class:"text-muted table-light"},"Updated By",-1),O=o("td",{class:"text-muted table-light"},"Time",-1),G={class:"modal-footer"},V=o("i",{class:"ri-close-line align-bottom me-1"},null,-1),W={__name:"Detail",props:["show","id"],emits:["update:show","update:id"],setup(W,{emit:X}){const q=W,z=w().page,E=t(w().form),F=a(!1);return e(q,(async t=>{E.reset(),t.id?(F.value=!0,await g.showData(E,t.id),F.value=!1):X("update:id",null)})),(t,a)=>{const e=m,w=c;return d(),l(p,{visible:W.show,"onUpdate:visible":a[2]||(a[2]=t=>W.show=t)},{default:s((()=>[o("div",f,[o("h5",_,"Detail View - "+i(r(z).title),1),o("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:a[0]||(a[0]=t=>X("update:show",!1))})]),n(e,{show:F.value,opacity:.25,"spinner-small":"",rounded:"sm"},{default:s((()=>[o("table",v,[o("tbody",null,[o("tr",null,[x,o("td",y,i(r(E).code),1)]),o("tr",null,[j,o("td",C,i(r(E).name),1)]),o("tr",null,[D,o("td",N,i(r(E).coa),1)]),o("tr",null,[T,o("td",U,i(r(E).description),1)]),o("tr",null,[k,o("td",null,[n(b,{data:r(E).created_user?.name},null,8,["data"])]),A,o("td",B,[n(h,{data:r(E).created_at},null,8,["data"])])]),o("tr",null,[M,o("td",null,[n(b,{data:r(E).updated_user?.name},null,8,["data"])]),O,o("td",null,[n(h,{data:r(E).updated_at},null,8,["data"])])])])])])),_:1},8,["show","opacity"]),o("div",G,[n(w,{variant:"light",onClick:a[1]||(a[1]=t=>X("update:show",!1))},{default:s((()=>[V,u(" Close ")])),_:1})])])),_:1},8,["visible"])}}};export{W as default};