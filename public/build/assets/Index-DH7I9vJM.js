import{T as e,Q as l,r as t,o as a,D as i,w as s,a as o,u as r,Z as d,b as n,e as c,q as u,d as m,G as p,H as v,c as b,E as f,t as h,F as w,h as g,M as j}from"./app-C9OX3ezV.js";import{_}from"./Main-B4LZWlbw.js";import{_ as k}from"./PageHeader-Dv06cU1A.js";import{_ as x,a as y}from"./PerPage-D3MyK7FG.js";import{_ as C}from"./UserName-CLPh0nW6.js";import{_ as U}from"./Timestamp-gyLU_dFM.js";import{_ as D}from"./Active-C2equTVR.js";import{_ as M}from"./Reload-DJ9kwFC9.js";import{_ as P}from"./Sort-DDnwWrVP.js";import{e as A}from"./entity-DOS18pl2.js";import{s as E}from"./service-DCGLJnov.js";import F from"./Form-B1Zlk3W9.js";import I from"./Import-BvSga2eO.js";import R from"./Export-CaSR-fss.js";import S from"./Detail-DhWCw9eV.js";import"./logo-light-fEv4Yehr.js";import"./sweetalert2.all-BBb44_lw.js";import"./_plugin-vue_export-helper-BCo6x5W8.js";import"./Footer-CmAIFNML.js";import"./Modal-C-7wPC8u.js";import"./Form-Dx5MBaLu.js";const q={class:"card"},H={class:"card-header border-0"},N={class:"row g-4"},V={class:"col-sm-auto"},$=n("i",{class:"ri-add-line label-icon align-middle fs-16 me-2"},null,-1),G=n("i",{class:"bx bx-import label-icon align-middle fs-16"},null,-1),O=n("i",{class:"bx bx-export label-icon align-middle fs-16"},null,-1),T={class:"col-sm"},z={class:"d-flex justify-content-sm-end"},B={class:"card-body p-0 border-2 border-top border-bottom"},J=["placeholder"],L=n("i",{class:"ri-search-line search-icon"},null,-1),Y={class:"card-body pb-0"},K={class:"table-responsive table-card mb-0"},Q={class:"table table-hover table-nowrap align-middle mb-0"},W={class:"table-light text-muted"},X=n("th",{width:"60"},"#",-1),Z=n("th",{width:"140"},"Created By",-1),ee=n("th",{width:"70"},"Active",-1),le=n("th",{width:"120",class:"text-center"},"Action",-1),te={class:"date"},ae={class:"list-inline gap-2 mb-0 text-center"},ie=["onClick"],se=[n("a",{href:"javascript:void(0);",class:"text-warning d-inline-block"},[n("i",{class:"ri-eye-fill fs-16"})],-1)],oe=["onClick"],re=[n("a",{href:"javascript:void(0);",class:"text-primary d-inline-block"},[n("i",{class:"ri-pencil-fill fs-16"})],-1)],de={class:"list-inline-item",title:"Remove"},ne=["onClick"],ce=[n("i",{class:"ri-delete-bin-5-fill fs-16"},null,-1)],ue={key:1,class:"list-inline-item",title:"Restore"},me=["onClick"],pe=[n("i",{class:"ri-refresh-fill fs-16"},null,-1)],ve={class:"card-footer p-0"},be={__name:"Index",props:["collection","filters"],setup(be){const fe=A().page,he=[{text:"Dashboard",to:route("dashboard")},{text:"Master"},{text:fe.title,active:!0}],we=e({keyword:l().props.ziggy.query.keyword??null}),ge=t(null),je=t(!1),_e=t(!1),ke=t(!1),xe=t(!1);return(e,l)=>{const t=g,A=j;return a(),i(_,null,{header:s((()=>[o(k,{title:r(fe).title,breadcrumbs:he},null,8,["title"])])),default:s((()=>[o(r(d),{title:r(fe).title},null,8,["title"]),n("div",q,[n("div",H,[n("div",N,[n("div",V,[o(A,null,{default:s((()=>[o(t,{variant:"primary",class:"btn-label waves-effect waves-light",onClick:l[0]||(l[0]=e=>(je.value=!0,ge.value=null))},{default:s((()=>[$,c(" Create ")])),_:1}),o(t,{variant:"success",class:"btn-label waves-effect waves-light right",onClick:l[1]||(l[1]=e=>_e.value=!0)},{default:s((()=>[G,c(" Import ")])),_:1}),o(t,{variant:"warning",class:"btn-label waves-effect waves-light right",onClick:l[2]||(l[2]=e=>ke.value=!0)},{default:s((()=>[O,c(" Export ")])),_:1})])),_:1})]),n("div",T,[n("div",z,[o(A,null,{default:s((()=>[o(M,{page:r(fe)},null,8,["page"]),be.collection.links.length>3?(a(),i(x,{key:0})):u("",!0)])),_:1})])])])]),n("div",B,[n("form",{onSubmit:l[4]||(l[4]=m((l=>r(we).get(e.route(`${r(fe).module}.${r(fe).name}.index`))),["prevent"])),class:"search-box"},[p(n("input",{type:"search",class:"form-control search border-0 py-3",placeholder:`Search for ${r(fe).title} ...`,"onUpdate:modelValue":l[3]||(l[3]=e=>r(we).keyword=e)},null,8,J),[[v,r(we).keyword]]),L],32)]),n("div",Y,[n("div",K,[n("table",Q,[n("thead",W,[n("tr",null,[X,o(P,{label:"Code",attribute:"code"}),o(P,{label:"Name",attribute:"name"}),o(P,{label:"Deduction",attribute:"deduction"}),o(P,{label:"Description",attribute:"description"}),o(P,{width:"140",label:"Created At",attribute:"created_at"}),Z,ee,le])]),n("tbody",null,[(a(!0),b(w,null,f(be.collection.data,((e,l)=>(a(),b("tr",{key:e.id},[n("td",null,h((be.collection.current_page-1)*be.collection.per_page+l+1),1),n("td",null,h(e.code),1),n("td",null,h(e.name),1),n("td",null,h(e.deduction),1),n("td",null,h(e.description),1),n("td",te,[o(U,{data:e.created_at},null,8,["data"])]),n("td",null,[o(C,{data:e.created_user?.name},null,8,["data"])]),n("td",null,[o(D,{data:e.deleted_at},null,8,["data"])]),n("td",null,[n("ul",ae,[e.deleted_at?(a(),b("li",ue,[n("a",{href:"javascript:void(0);",class:"text-info d-inline-block",onClick:l=>r(E).deleteData(e.id,!0)},pe,8,me)])):(a(),b(w,{key:0},[n("li",{class:"list-inline-item",title:"View",onClick:()=>{ge.value=e.id,xe.value=!0}},se,8,ie),n("li",{class:"list-inline-item edit",title:"Edit",onClick:()=>{ge.value=e.id,je.value=!0}},re,8,oe),n("li",de,[n("a",{href:"javascript:void(0);",class:"text-danger d-inline-block",onClick:l=>r(E).deleteData(e.id)},ce,8,ne)])],64))])])])))),128))])])])]),n("div",ve,[o(y,{data:be.collection},null,8,["data"])])]),o(F,{show:je.value,"onUpdate:show":l[5]||(l[5]=e=>je.value=e),id:ge.value,"onUpdate:id":l[6]||(l[6]=e=>ge.value=e)},null,8,["show","id"]),o(I,{show:_e.value,"onUpdate:show":l[7]||(l[7]=e=>_e.value=e)},null,8,["show"]),o(R,{show:ke.value,"onUpdate:show":l[8]||(l[8]=e=>ke.value=e)},null,8,["show"]),o(S,{show:xe.value,"onUpdate:show":l[9]||(l[9]=e=>xe.value=e),id:ge.value,"onUpdate:id":l[10]||(l[10]=e=>ge.value=e)},null,8,["show","id"])])),_:1})}}};export{be as default};