import{T as t,r as a,N as e,D as l,w as s,o as d,b as i,t as o,u as r,a as n,e as u,O as m,g as p}from"./app-fcd4ac94.js";import{_ as c}from"./Modal-2334fec4.js";import{_ as b}from"./UserName-dd292877.js";import{_ as h}from"./Timestamp-ebdcea1d.js";import{e as w}from"./entity-ff05e0f9.js";import{s as f}from"./service-9e322ba6.js";import"./sweetalert2.all-6f2ad051.js";const g={class:"modal-header p-3 bg-soft-warning"},_={class:"modal-title"},v={class:"table table-bordered"},x=i("td",{class:"text-muted table-light",width:"100"},"Code",-1),y={colspan:"3"},j=i("td",{class:"text-muted table-light"},"Name",-1),C={colspan:"3"},D=i("td",{class:"text-muted table-light"},"Description",-1),U={colspan:"3",class:"text-wrap"},N=i("td",{class:"text-muted table-light"},"Created By",-1),T=i("td",{class:"text-muted table-light"},"Time",-1),k={width:"150"},B=i("td",{class:"text-muted table-light"},"Updated By",-1),O=i("td",{class:"text-muted table-light"},"Time",-1),I={class:"modal-footer"},L=i("i",{class:"ri-close-line align-bottom me-1"},null,-1),M={__name:"Detail",props:["show","id"],emits:["update:show","update:id"],setup(M,{emit:V}){const q=M,z=w().page,A=t(w().form),E=a(!1);return e(q,(async t=>{A.reset(),t.id?(E.value=!0,await f.showData(A,t.id),E.value=!1):V("update:id",null)})),(t,a)=>{const e=m,w=p;return d(),l(c,{visible:M.show,"onUpdate:visible":a[2]||(a[2]=t=>M.show=t)},{default:s((()=>[i("div",g,[i("h5",_,"Detail View - "+o(r(z).title),1),i("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:a[0]||(a[0]=t=>V("update:show",!1))})]),n(e,{show:E.value,opacity:.25,"spinner-small":"",rounded:"sm"},{default:s((()=>[i("table",v,[i("tbody",null,[i("tr",null,[x,i("td",y,o(r(A).code),1)]),i("tr",null,[j,i("td",C,o(r(A).name),1)]),i("tr",null,[D,i("td",U,o(r(A).description),1)]),i("tr",null,[N,i("td",null,[n(b,{data:r(A).created_user?.name},null,8,["data"])]),T,i("td",k,[n(h,{data:r(A).created_at},null,8,["data"])])]),i("tr",null,[B,i("td",null,[n(b,{data:r(A).updated_user?.name},null,8,["data"])]),O,i("td",null,[n(h,{data:r(A).updated_at},null,8,["data"])])])])])])),_:1},8,["show","opacity"]),i("div",I,[n(w,{variant:"light",onClick:a[1]||(a[1]=t=>V("update:show",!1))},{default:s((()=>[L,u(" Close ")])),_:1})])])),_:1},8,["visible"])}}};export{M as default};
