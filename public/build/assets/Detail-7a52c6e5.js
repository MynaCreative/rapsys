import{T as t,r as a,N as e,D as l,w as s,o as d,b as i,t as o,u as r,a as n,e as u,O as m,g as p}from"./app-fcd4ac94.js";import{_ as c}from"./Modal-2334fec4.js";import{_ as b}from"./UserName-dd292877.js";import{_ as h}from"./Timestamp-ebdcea1d.js";import{e as w}from"./entity-303f2e5c.js";import{s as g}from"./service-e95783b8.js";import"./sweetalert2.all-6f2ad051.js";const f={class:"modal-header p-3 bg-soft-warning"},_={class:"modal-title"},v={class:"table table-bordered"},x=i("td",{class:"text-muted table-light",width:"100"},"Code",-1),y={colspan:"3"},j=i("td",{class:"text-muted table-light"},"Name",-1),C={colspan:"3"},D=i("td",{class:"text-muted table-light"},"Day",-1),U={colspan:"3"},N=i("td",{class:"text-muted table-light"},"Description",-1),T={colspan:"3",class:"text-wrap"},k=i("td",{class:"text-muted table-light"},"Created By",-1),B=i("td",{class:"text-muted table-light"},"Time",-1),O={width:"150"},I=i("td",{class:"text-muted table-light"},"Updated By",-1),L=i("td",{class:"text-muted table-light"},"Time",-1),M={class:"modal-footer"},V=i("i",{class:"ri-close-line align-bottom me-1"},null,-1),q={__name:"Detail",props:["show","id"],emits:["update:show","update:id"],setup(q,{emit:z}){const A=q,E=w().page,F=t(w().form),G=a(!1);return e(A,(async t=>{F.reset(),t.id?(G.value=!0,await g.showData(F,t.id),G.value=!1):z("update:id",null)})),(t,a)=>{const e=m,w=p;return d(),l(c,{visible:q.show,"onUpdate:visible":a[2]||(a[2]=t=>q.show=t)},{default:s((()=>[i("div",f,[i("h5",_,"Detail View - "+o(r(E).title),1),i("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:a[0]||(a[0]=t=>z("update:show",!1))})]),n(e,{show:G.value,opacity:.25,"spinner-small":"",rounded:"sm"},{default:s((()=>[i("table",v,[i("tbody",null,[i("tr",null,[x,i("td",y,o(r(F).code),1)]),i("tr",null,[j,i("td",C,o(r(F).name),1)]),i("tr",null,[D,i("td",U,o(r(F).day),1)]),i("tr",null,[N,i("td",T,o(r(F).description),1)]),i("tr",null,[k,i("td",null,[n(b,{data:r(F).created_user?.name},null,8,["data"])]),B,i("td",O,[n(h,{data:r(F).created_at},null,8,["data"])])]),i("tr",null,[I,i("td",null,[n(b,{data:r(F).updated_user?.name},null,8,["data"])]),L,i("td",null,[n(h,{data:r(F).updated_at},null,8,["data"])])])])])])),_:1},8,["show","opacity"]),i("div",M,[n(w,{variant:"light",onClick:a[1]||(a[1]=t=>z("update:show",!1))},{default:s((()=>[V,u(" Close ")])),_:1})])])),_:1},8,["visible"])}}};export{q as default};
