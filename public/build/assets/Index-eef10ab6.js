import{T as e,Q as l,r as t,D as a,w as i,o as s,a as o,u as r,Z as d,b as n,e as c,m as u,d as m,H as p,I as v,c as b,G as f,t as h,F as w,g,M as j}from"./app-891c8d04.js";import{_}from"./Main-292273c6.js";import{_ as k}from"./PageHeader-2bee4ef0.js";import{_ as x,a as y}from"./PerPage-e4d306f5.js";import{_ as C}from"./UserName-bf87c315.js";import{_ as D}from"./Timestamp-4502638c.js";import{_ as U}from"./Active-c4405180.js";import{_ as I}from"./Reload-2ac69993.js";import{_ as M}from"./Sort-81996e4f.js";import{e as A}from"./entity-52ae4211.js";import{s as F}from"./service-88f3002c.js";import E from"./Form-0757f256.js";import H from"./Import-6c3dc30a.js";import P from"./Export-02b321de.js";import R from"./Detail-d531fec9.js";import"./logo-light-68509ea3.js";import"./sweetalert2.all-3ba2fbff.js";import"./_plugin-vue_export-helper-1b428a4d.js";import"./Footer-8715fbbc.js";import"./Modal-9511757c.js";import"./Form-dda6d670.js";const S={class:"card"},$={class:"card-header border-0"},G={class:"row g-4"},J={class:"col-sm-auto"},N=n("i",{class:"ri-add-line label-icon align-middle fs-16 me-2"},null,-1),V=n("i",{class:"bx bx-import label-icon align-middle fs-16"},null,-1),q=n("i",{class:"bx bx-export label-icon align-middle fs-16"},null,-1),z={class:"col-sm"},B={class:"d-flex justify-content-sm-end"},K={class:"card-body p-0 border-2 border-top border-bottom"},L=["placeholder"],T=n("i",{class:"ri-search-line search-icon"},null,-1),O={class:"card-body pb-0"},Q={class:"table-responsive table-card mb-0"},W={class:"table table-hover table-nowrap align-middle mb-0"},X={class:"table-light text-muted"},Y=n("th",{width:"60"},"#",-1),Z=n("th",{width:"140"},"Created By",-1),ee=n("th",{width:"70"},"Active",-1),le=n("th",{width:"120",class:"text-center"},"Action",-1),te={class:"date"},ae={class:"list-inline gap-2 mb-0 text-center"},ie=["onClick"],se=[n("a",{href:"javascript:void(0);",class:"text-warning d-inline-block"},[n("i",{class:"ri-eye-fill fs-16"})],-1)],oe=["onClick"],re=[n("a",{href:"javascript:void(0);",class:"text-primary d-inline-block"},[n("i",{class:"ri-pencil-fill fs-16"})],-1)],de={class:"list-inline-item",title:"Remove"},ne=["onClick"],ce=[n("i",{class:"ri-delete-bin-5-fill fs-16"},null,-1)],ue={key:1,class:"list-inline-item",title:"Restore"},me=["onClick"],pe=[n("i",{class:"ri-refresh-fill fs-16"},null,-1)],ve={class:"card-footer p-0"},be={__name:"Index",props:["collection","filters"],setup(be){const fe=A().page,he=[{text:"Dashboard",to:route("dashboard")},{text:"Master"},{text:fe.title,active:!0}],we=e({keyword:l().props.ziggy.query.keyword??null}),ge=t(null),je=t(!1),_e=t(!1),ke=t(!1),xe=t(!1);return(e,l)=>{const t=g,A=j;return s(),a(_,null,{header:i((()=>[o(k,{title:r(fe).title,breadcrumbs:he},null,8,["title"])])),default:i((()=>[o(r(d),{title:r(fe).title},null,8,["title"]),n("div",S,[n("div",$,[n("div",G,[n("div",J,[o(A,null,{default:i((()=>[o(t,{variant:"primary",class:"btn-label waves-effect waves-light",onClick:l[0]||(l[0]=e=>(je.value=!0,ge.value=null))},{default:i((()=>[N,c(" Create ")])),_:1}),o(t,{variant:"success",class:"btn-label waves-effect waves-light right",onClick:l[1]||(l[1]=e=>_e.value=!0)},{default:i((()=>[V,c(" Import ")])),_:1}),o(t,{variant:"warning",class:"btn-label waves-effect waves-light right",onClick:l[2]||(l[2]=e=>ke.value=!0)},{default:i((()=>[q,c(" Export ")])),_:1})])),_:1})]),n("div",z,[n("div",B,[o(A,null,{default:i((()=>[o(I,{page:r(fe)},null,8,["page"]),be.collection.links.length>3?(s(),a(x,{key:0})):u("",!0)])),_:1})])])])]),n("div",K,[n("form",{onSubmit:l[4]||(l[4]=m((l=>r(we).get(e.route(`${r(fe).module}.${r(fe).name}.index`))),["prevent"])),class:"search-box"},[p(n("input",{type:"search",class:"form-control search border-0 py-3",placeholder:`Search for ${r(fe).title} ...`,"onUpdate:modelValue":l[3]||(l[3]=e=>r(we).keyword=e)},null,8,L),[[v,r(we).keyword]]),T],32)]),n("div",O,[n("div",Q,[n("table",W,[n("thead",X,[n("tr",null,[Y,o(M,{label:"Code",attribute:"code"}),o(M,{label:"Name",attribute:"name"}),o(M,{label:"Deduction",attribute:"deduction"}),o(M,{label:"Description",attribute:"description"}),o(M,{width:"140",label:"Created At",attribute:"created_at"}),Z,ee,le])]),n("tbody",null,[(s(!0),b(w,null,f(be.collection.data,((e,l)=>(s(),b("tr",{key:e.id},[n("td",null,h((be.collection.current_page-1)*be.collection.per_page+l+1),1),n("td",null,h(e.code),1),n("td",null,h(e.name),1),n("td",null,h(e.deduction),1),n("td",null,h(e.description),1),n("td",te,[o(D,{data:e.created_at},null,8,["data"])]),n("td",null,[o(C,{data:e.created_user?.name},null,8,["data"])]),n("td",null,[o(U,{data:e.deleted_at},null,8,["data"])]),n("td",null,[n("ul",ae,[e.deleted_at?(s(),b("li",ue,[n("a",{href:"javascript:void(0);",class:"text-info d-inline-block",onClick:l=>r(F).deleteData(e.id,!0)},pe,8,me)])):(s(),b(w,{key:0},[n("li",{class:"list-inline-item",title:"View",onClick:()=>{ge.value=e.id,xe.value=!0}},se,8,ie),n("li",{class:"list-inline-item edit",title:"Edit",onClick:()=>{ge.value=e.id,je.value=!0}},re,8,oe),n("li",de,[n("a",{href:"javascript:void(0);",class:"text-danger d-inline-block",onClick:l=>r(F).deleteData(e.id)},ce,8,ne)])],64))])])])))),128))])])])]),n("div",ve,[o(y,{data:be.collection},null,8,["data"])])]),o(E,{show:je.value,"onUpdate:show":l[5]||(l[5]=e=>je.value=e),id:ge.value,"onUpdate:id":l[6]||(l[6]=e=>ge.value=e)},null,8,["show","id"]),o(H,{show:_e.value,"onUpdate:show":l[7]||(l[7]=e=>_e.value=e)},null,8,["show"]),o(P,{show:ke.value,"onUpdate:show":l[8]||(l[8]=e=>ke.value=e)},null,8,["show"]),o(R,{show:xe.value,"onUpdate:show":l[9]||(l[9]=e=>xe.value=e),id:ge.value,"onUpdate:id":l[10]||(l[10]=e=>ge.value=e)},null,8,["show","id"])])),_:1})}}};export{be as default};