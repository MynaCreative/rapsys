import{T as t,N as a,D as l,w as e,o as s,b as d,t as i,u as o,a as r,e as n,g as u}from"./app-891c8d04.js";import{_ as m}from"./Modal-9511757c.js";import{_ as p}from"./Timestamp-4502638c.js";import{s as c,e as b}from"./service-d5d626c5.js";import"./sweetalert2.all-3ba2fbff.js";const h={class:"modal-header p-3 bg-soft-warning"},w={class:"modal-title"},g={class:"table table-bordered"},f=d("td",{class:"text-muted table-light",width:"100"},"Name",-1),_=d("td",{class:"text-muted table-light"},"Guard",-1),v=d("td",{class:"text-muted table-light"},"Created At",-1),j=d("td",{class:"text-muted table-light"},"Updated At",-1),x={class:"modal-footer"},C=d("i",{class:"ri-close-line align-bottom me-1"},null,-1),D={__name:"Detail",props:["show","id"],emits:["update:show","update:id"],setup(D,{emit:y}){const A=D,k=b().page,M=t(b().form);return a(A,(async t=>{t.id?c.showData(M,t.id):y("update:id",null)})),(t,a)=>{const c=u;return s(),l(m,{visible:D.show,"onUpdate:visible":a[2]||(a[2]=t=>D.show=t)},{default:e((()=>[d("div",h,[d("h5",w,"Detail View - "+i(o(k).title),1),d("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:a[0]||(a[0]=t=>y("update:show",!1))})]),d("table",g,[d("tbody",null,[d("tr",null,[f,d("td",null,i(o(M).name),1)]),d("tr",null,[_,d("td",null,i(o(M).guard_name),1)]),d("tr",null,[v,d("td",null,[r(p,{data:o(M).created_at},null,8,["data"])])]),d("tr",null,[j,d("td",null,[r(p,{data:o(M).created_at},null,8,["data"])])])])]),d("div",x,[r(c,{variant:"light",onClick:a[1]||(a[1]=t=>y("update:show",!1))},{default:e((()=>[C,n(" Close ")])),_:1})])])),_:1},8,["visible"])}}};export{D as default};