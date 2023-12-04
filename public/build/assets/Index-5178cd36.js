import{T as e,Q as l,r as t,D as a,w as r,o as s,a as i,u as o,Z as d,b as n,m as c,d as u,H as p,I as m,c as b,G as v,t as h,F as f,M as g}from"./app-30e0783b.js";import{_}from"./Main-7c4d393d.js";import{_ as j}from"./PageHeader-5f27e6fb.js";import{_ as w,a as y}from"./PerPage-fb32db7c.js";import{_ as x}from"./Timestamp-26024741.js";import{_ as k}from"./Reload-fc77effc.js";import{_ as C}from"./Sort-8f4c5b09.js";import{e as F}from"./service-d89e48a4.js";import"./sweetalert2.all-aaaa6da5.js";import U from"./Form-62b84c39.js";import A from"./Detail-58647231.js";import"./logo-light-68509ea3.js";import"./_plugin-vue_export-helper-1b428a4d.js";import"./Footer-61ce5cc7.js";import"./Modal-36df24f3.js";import"./Form-0c6a2005.js";import"./multiselect-31bf4223.js";const D={class:"card"},M={class:"card-header border-0"},P={class:"row g-4"},S={class:"col-sm"},G={class:"d-flex justify-content-sm-end"},H={class:"card-body p-0 border-2 border-top border-bottom"},V=["placeholder"],$=n("i",{class:"ri-search-line search-icon"},null,-1),I={class:"card-body pb-0"},q={class:"table-responsive table-card mb-0"},z={class:"table table-hover table-nowrap align-middle mb-0"},E={class:"table-light text-muted"},J=n("th",{width:"60"},"#",-1),L=n("th",{width:"120",class:"text-center"},"Action",-1),N={class:"date"},O={class:"list-inline gap-2 mb-0 text-center"},Q=["onClick"],R=[n("a",{href:"javascript:void(0);",class:"text-warning d-inline-block"},[n("i",{class:"ri-eye-fill fs-16"})],-1)],T=["onClick"],B=[n("a",{href:"javascript:void(0);",class:"text-primary d-inline-block"},[n("i",{class:"ri-pencil-fill fs-16"})],-1)],K={class:"card-footer p-0"},W={__name:"Index",props:["collection","filters","references"],setup(W){const X=F().page,Y=[{text:"Dashboard",to:route("dashboard")},{text:"Setting"},{text:"Administrator"},{text:X.title,active:!0}],Z=e({keyword:l().props.ziggy.query.keyword??null}),ee=t(null),le=t(!1),te=t(!1);return(e,l)=>{const t=g;return s(),a(_,null,{header:r((()=>[i(j,{title:o(X).title,breadcrumbs:Y},null,8,["title"])])),default:r((()=>[i(o(d),{title:o(X).title},null,8,["title"]),n("div",D,[n("div",M,[n("div",P,[n("div",S,[n("div",G,[i(t,null,{default:r((()=>[i(k,{page:o(X)},null,8,["page"]),W.collection.links.length>3?(s(),a(w,{key:0})):c("",!0)])),_:1})])])])]),n("div",H,[n("form",{onSubmit:l[1]||(l[1]=u((l=>o(Z).get(e.route(`${o(X).module}.${o(X).name}.index`))),["prevent"])),class:"search-box"},[p(n("input",{type:"search",class:"form-control search border-0 py-3",placeholder:`Search for ${o(X).title} ...`,"onUpdate:modelValue":l[0]||(l[0]=e=>o(Z).keyword=e)},null,8,V),[[m,o(Z).keyword]]),$],32)]),n("div",I,[n("div",q,[n("table",z,[n("thead",E,[n("tr",null,[J,i(C,{label:"Name",attribute:"name"}),i(C,{label:"Label",attribute:"label"}),i(C,{label:"Group",attribute:"permission_group_id"}),i(C,{label:"Guard",attribute:"guard_name"}),i(C,{width:"140",label:"Created At",attribute:"created_at"}),L])]),n("tbody",null,[(s(!0),b(f,null,v(W.collection.data,((e,l)=>(s(),b("tr",{key:e.id},[n("td",null,h((W.collection.current_page-1)*W.collection.per_page+l+1),1),n("td",null,h(e.name),1),n("td",null,h(e.label),1),n("td",null,h(e.permission_group.name),1),n("td",null,h(e.guard_name),1),n("td",N,[i(x,{data:e.created_at},null,8,["data"])]),n("td",null,[n("ul",O,[n("li",{class:"list-inline-item",title:"View",onClick:()=>{ee.value=e.id,te.value=!0}},R,8,Q),n("li",{class:"list-inline-item edit",title:"Edit",onClick:()=>{ee.value=e.id,le.value=!0}},B,8,T)])])])))),128))])])])]),n("div",K,[i(y,{data:W.collection},null,8,["data"])])]),i(U,{show:le.value,"onUpdate:show":l[2]||(l[2]=e=>le.value=e),id:ee.value,"onUpdate:id":l[3]||(l[3]=e=>ee.value=e),references:W.references},null,8,["show","id","references"]),i(A,{show:te.value,"onUpdate:show":l[4]||(l[4]=e=>te.value=e),id:ee.value,"onUpdate:id":l[5]||(l[5]=e=>ee.value=e)},null,8,["show","id"])])),_:1})}}};export{W as default};