import{T as t,r as a,N as e,D as l,w as s,o as d,b as i,t as o,u as r,a as n,e as u,O as m,g as p}from"./app-30e0783b.js";import{_ as c}from"./Modal-36df24f3.js";import{_ as b}from"./UserName-f3c46ade.js";import{_ as h}from"./Timestamp-26024741.js";import{e as w}from"./entity-ff05e0f9.js";import{s as f}from"./service-03c7b754.js";import"./sweetalert2.all-aaaa6da5.js";const g={class:"modal-header p-3 bg-soft-warning"},_={class:"modal-title"},v={class:"table table-bordered"},x=i("td",{class:"text-muted table-light",width:"100"},"Code",-1),y={colspan:"3"},j=i("td",{class:"text-muted table-light"},"Name",-1),C={colspan:"3"},D=i("td",{class:"text-muted table-light"},"Description",-1),N={colspan:"3",class:"text-wrap"},T=i("td",{class:"text-muted table-light"},"Created By",-1),U=i("td",{class:"text-muted table-light"},"Time",-1),k={width:"150"},B=i("td",{class:"text-muted table-light"},"Updated By",-1),M=i("td",{class:"text-muted table-light"},"Time",-1),A={class:"modal-footer"},G=i("i",{class:"ri-close-line align-bottom me-1"},null,-1),O={__name:"Detail",props:["show","id"],emits:["update:show","update:id"],setup(O,{emit:V}){const $=O,q=w().page,z=t(w().form),E=a(!1);return e($,(async t=>{z.reset(),t.id?(E.value=!0,await f.showData(z,t.id),E.value=!1):V("update:id",null)})),(t,a)=>{const e=m,w=p;return d(),l(c,{visible:O.show,"onUpdate:visible":a[2]||(a[2]=t=>O.show=t)},{default:s((()=>[i("div",g,[i("h5",_,"Detail View - "+o(r(q).title),1),i("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:a[0]||(a[0]=t=>V("update:show",!1))})]),n(e,{show:E.value,opacity:.25,"spinner-small":"",rounded:"sm"},{default:s((()=>[i("table",v,[i("tbody",null,[i("tr",null,[x,i("td",y,o(r(z).code),1)]),i("tr",null,[j,i("td",C,o(r(z).name),1)]),i("tr",null,[D,i("td",N,o(r(z).description),1)]),i("tr",null,[T,i("td",null,[n(b,{data:r(z).created_user?.name},null,8,["data"])]),U,i("td",k,[n(h,{data:r(z).created_at},null,8,["data"])])]),i("tr",null,[B,i("td",null,[n(b,{data:r(z).updated_user?.name},null,8,["data"])]),M,i("td",null,[n(h,{data:r(z).updated_at},null,8,["data"])])])])])])),_:1},8,["show","opacity"]),i("div",A,[n(w,{variant:"light",onClick:a[1]||(a[1]=t=>V("update:show",!1))},{default:s((()=>[G,u(" Close ")])),_:1})])])),_:1},8,["visible"])}}};export{O as default};
