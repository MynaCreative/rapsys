import{T as e,Q as l,r as a,D as t,w as i,o as s,a as o,u as r,Z as d,b as n,e as c,m as u,d as m,H as p,I as v,c as b,G as f,t as h,F as w,g,M as _}from"./app-30e0783b.js";import{_ as j}from"./Main-7c4d393d.js";import{_ as x}from"./PageHeader-5f27e6fb.js";import{_ as k,a as y}from"./PerPage-fb32db7c.js";import{_ as C}from"./UserName-f3c46ade.js";import{_ as U}from"./Timestamp-26024741.js";import{_ as D}from"./Active-9c1bbe54.js";import{_ as A}from"./Reload-fc77effc.js";import{_ as F}from"./Sort-8f4c5b09.js";import{e as I}from"./entity-ff05e0f9.js";import{s as M}from"./service-03c7b754.js";import $ from"./Form-60f95416.js";import E from"./Import-a8694322.js";import H from"./Export-2cab8947.js";import P from"./Detail-54bbe3dd.js";import"./logo-light-68509ea3.js";import"./sweetalert2.all-aaaa6da5.js";import"./_plugin-vue_export-helper-1b428a4d.js";import"./Footer-61ce5cc7.js";import"./Modal-36df24f3.js";import"./Form-c7b238f3.js";const R={class:"card"},S={class:"card-header border-0"},G={class:"row g-4"},N={class:"col-sm-auto"},V=n("i",{class:"ri-add-line label-icon align-middle fs-16 me-2"},null,-1),q=n("i",{class:"bx bx-import label-icon align-middle fs-16"},null,-1),z=n("i",{class:"bx bx-export label-icon align-middle fs-16"},null,-1),B={class:"col-sm"},J={class:"d-flex justify-content-sm-end"},T={class:"card-body p-0 border-2 border-top border-bottom"},Y=["placeholder"],Z=n("i",{class:"ri-search-line search-icon"},null,-1),K={class:"card-body pb-0"},L={class:"table-responsive table-card mb-0"},O={class:"table table-hover table-nowrap align-middle mb-0"},Q={class:"table-light text-muted"},W=n("th",{width:"60"},"#",-1),X=n("th",{width:"140"},"Created By",-1),ee=n("th",{width:"70"},"Active",-1),le=n("th",{width:"120",class:"text-center"},"Action",-1),ae={class:"text-wrap"},te={class:"date"},ie={class:"list-inline gap-2 mb-0 text-center"},se=["onClick"],oe=[n("a",{href:"javascript:void(0);",class:"text-warning d-inline-block"},[n("i",{class:"ri-eye-fill fs-16"})],-1)],re=["onClick"],de=[n("a",{href:"javascript:void(0);",class:"text-primary d-inline-block"},[n("i",{class:"ri-pencil-fill fs-16"})],-1)],ne={class:"list-inline-item",title:"Remove"},ce=["onClick"],ue=[n("i",{class:"ri-delete-bin-5-fill fs-16"},null,-1)],me={key:1,class:"list-inline-item",title:"Restore"},pe=["onClick"],ve=[n("i",{class:"ri-refresh-fill fs-16"},null,-1)],be={class:"card-footer p-0"},fe={__name:"Index",props:["collection","filters"],setup(fe){const he=I().page,we=[{text:"Dashboard",to:route("dashboard")},{text:"Master"},{text:he.title,active:!0}],ge=e({keyword:l().props.ziggy.query.keyword??null}),_e=a(null),je=a(!1),xe=a(!1),ke=a(!1),ye=a(!1);return(e,l)=>{const a=g,I=_;return s(),t(j,null,{header:i((()=>[o(x,{title:r(he).title,breadcrumbs:we},null,8,["title"])])),default:i((()=>[o(r(d),{title:r(he).title},null,8,["title"]),n("div",R,[n("div",S,[n("div",G,[n("div",N,[o(I,null,{default:i((()=>[o(a,{variant:"primary",class:"btn-label waves-effect waves-light",onClick:l[0]||(l[0]=e=>(je.value=!0,_e.value=null))},{default:i((()=>[V,c(" Create ")])),_:1}),o(a,{variant:"success",class:"btn-label waves-effect waves-light right",onClick:l[1]||(l[1]=e=>xe.value=!0)},{default:i((()=>[q,c(" Import ")])),_:1}),o(a,{variant:"warning",class:"btn-label waves-effect waves-light right",onClick:l[2]||(l[2]=e=>ke.value=!0)},{default:i((()=>[z,c(" Export ")])),_:1})])),_:1})]),n("div",B,[n("div",J,[o(I,null,{default:i((()=>[o(A,{page:r(he)},null,8,["page"]),fe.collection.links.length>3?(s(),t(k,{key:0})):u("",!0)])),_:1})])])])]),n("div",T,[n("form",{onSubmit:l[4]||(l[4]=m((l=>r(ge).get(e.route(`${r(he).module}.${r(he).name}.index`))),["prevent"])),class:"search-box"},[p(n("input",{type:"search",class:"form-control search border-0 py-3",placeholder:`Search for ${r(he).title} ...`,"onUpdate:modelValue":l[3]||(l[3]=e=>r(ge).keyword=e)},null,8,Y),[[v,r(ge).keyword]]),Z],32)]),n("div",K,[n("div",L,[n("table",O,[n("thead",Q,[n("tr",null,[W,o(F,{label:"Code",attribute:"code"}),o(F,{label:"Name",attribute:"name"}),o(F,{label:"Description",attribute:"description"}),o(F,{width:"140",label:"Created At",attribute:"created_at"}),X,ee,le])]),n("tbody",null,[(s(!0),b(w,null,f(fe.collection.data,((e,l)=>(s(),b("tr",{key:e.id},[n("td",null,h((fe.collection.current_page-1)*fe.collection.per_page+l+1),1),n("td",null,h(e.code),1),n("td",null,h(e.name),1),n("td",ae,h(e.description),1),n("td",te,[o(U,{data:e.created_at},null,8,["data"])]),n("td",null,[o(C,{data:e.created_user?.name},null,8,["data"])]),n("td",null,[o(D,{data:e.deleted_at},null,8,["data"])]),n("td",null,[n("ul",ie,[e.deleted_at?(s(),b("li",me,[n("a",{href:"javascript:void(0);",class:"text-info d-inline-block",onClick:l=>r(M).deleteData(e.id,!0)},ve,8,pe)])):(s(),b(w,{key:0},[n("li",{class:"list-inline-item",title:"View",onClick:()=>{_e.value=e.id,ye.value=!0}},oe,8,se),n("li",{class:"list-inline-item edit",title:"Edit",onClick:()=>{_e.value=e.id,je.value=!0}},de,8,re),n("li",ne,[n("a",{href:"javascript:void(0);",class:"text-danger d-inline-block",onClick:l=>r(M).deleteData(e.id)},ue,8,ce)])],64))])])])))),128))])])])]),n("div",be,[o(y,{data:fe.collection},null,8,["data"])])]),o($,{show:je.value,"onUpdate:show":l[5]||(l[5]=e=>je.value=e),id:_e.value,"onUpdate:id":l[6]||(l[6]=e=>_e.value=e)},null,8,["show","id"]),o(E,{show:xe.value,"onUpdate:show":l[7]||(l[7]=e=>xe.value=e)},null,8,["show"]),o(H,{show:ke.value,"onUpdate:show":l[8]||(l[8]=e=>ke.value=e)},null,8,["show"]),o(P,{show:ye.value,"onUpdate:show":l[9]||(l[9]=e=>ye.value=e),id:_e.value,"onUpdate:id":l[10]||(l[10]=e=>_e.value=e)},null,8,["show","id"])])),_:1})}}};export{fe as default};
