import{T as t,N as a,D as e,w as l,o as s,b as d,t as i,u as o,a as r,e as n,g as u}from"./app-30e0783b.js";import{_ as m}from"./Modal-36df24f3.js";import{_ as c}from"./UserName-f3c46ade.js";import{_ as p}from"./Timestamp-26024741.js";import{s as b,e as h}from"./service-de8f827a.js";import"./sweetalert2.all-aaaa6da5.js";const w={class:"modal-header p-3 bg-soft-warning"},g={class:"modal-title"},f={class:"table table-bordered"},_=d("td",{class:"text-muted table-light",width:"100"},"Code",-1),x={colspan:"3"},v=d("td",{class:"text-muted table-light"},"Name",-1),j={colspan:"3"},C=d("td",{class:"text-muted table-light"},"Description",-1),D={colspan:"3",class:"text-wrap"},y=d("td",{class:"text-muted table-light"},"Created By",-1),N=d("td",{class:"text-muted table-light"},"Time",-1),T={width:"150"},U=d("td",{class:"text-muted table-light"},"Updated By",-1),k=d("td",{class:"text-muted table-light"},"Time",-1),B={class:"modal-footer"},M=d("i",{class:"ri-close-line align-bottom me-1"},null,-1),A={__name:"Detail",props:["show","id"],emits:["update:show","update:id"],setup(A,{emit:G}){const V=A,q=h().page,z=t(h().form);return a(V,(async t=>{t.id?b.showData(z,t.id):G("update:id",null)})),(t,a)=>{const b=u;return s(),e(m,{visible:A.show,"onUpdate:visible":a[2]||(a[2]=t=>A.show=t)},{default:l((()=>[d("div",w,[d("h5",g,"Detail View - "+i(o(q).title),1),d("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:a[0]||(a[0]=t=>G("update:show",!1))})]),d("table",f,[d("tbody",null,[d("tr",null,[_,d("td",x,i(o(z).code),1)]),d("tr",null,[v,d("td",j,i(o(z).name),1)]),d("tr",null,[C,d("td",D,i(o(z).description),1)]),d("tr",null,[y,d("td",null,[r(c,{data:o(z).created_user?.name},null,8,["data"])]),N,d("td",T,[r(p,{data:o(z).created_at},null,8,["data"])])]),d("tr",null,[U,d("td",null,[r(c,{data:o(z).updated_user?.name},null,8,["data"])]),k,d("td",null,[r(p,{data:o(z).updated_at},null,8,["data"])])])])]),d("div",B,[r(b,{variant:"light",onClick:a[1]||(a[1]=t=>G("update:show",!1))},{default:l((()=>[M,n(" Close ")])),_:1})])])),_:1},8,["visible"])}}};export{A as default};
