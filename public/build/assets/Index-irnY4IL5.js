import{T as e,Q as l,r as t,o as a,D as s,w as i,a as r,u as o,Z as d,b as n,e as c,q as u,d as m,G as p,H as v,c as b,E as f,t as h,F as g,h as j,M as w}from"./app-C9OX3ezV.js";import{_}from"./Main-B4LZWlbw.js";import{_ as y}from"./PageHeader-Dv06cU1A.js";import{_ as k,a as x}from"./PerPage-D3MyK7FG.js";import{_ as C}from"./UserName-CLPh0nW6.js";import{_ as U}from"./Timestamp-gyLU_dFM.js";import{_ as D}from"./Active-C2equTVR.js";import{_ as S}from"./Reload-DJ9kwFC9.js";import{_ as A}from"./Sort-DDnwWrVP.js";import{s as F,e as M}from"./service-BnQBiDZu.js";import P from"./Form-e2uv_9Tl.js";import H from"./Detail-B1YO0cyb.js";import"./logo-light-fEv4Yehr.js";import"./sweetalert2.all-BBb44_lw.js";import"./_plugin-vue_export-helper-BCo6x5W8.js";import"./Footer-CmAIFNML.js";import"./Modal-C-7wPC8u.js";import"./Form-CoaIvIFf.js";import"./v-money3-x7_rWlX1.js";import"./vue-select-BhTkIImE.js";const R={class:"card"},V={class:"card-header border-0"},$={class:"row g-4"},q={class:"col-sm-auto"},E=n("i",{class:"ri-add-line label-icon align-middle fs-16 me-2"},null,-1),G={class:"col-sm"},I={class:"d-flex justify-content-sm-end"},N={class:"card-body p-0 border-2 border-top border-bottom"},T=["placeholder"],z=n("i",{class:"ri-search-line search-icon"},null,-1),B={class:"card-body pb-0"},J={class:"table-responsive table-card mb-0"},O={class:"table table-hover table-nowrap align-middle mb-0"},Y={class:"table-light text-muted"},K=n("th",{width:"60"},"#",-1),L=n("th",{width:"140"},"Created By",-1),Q=n("th",{width:"70"},"Active",-1),W=n("th",{width:"120",class:"text-center"},"Action",-1),X={class:"date"},Z={class:"list-inline gap-2 mb-0 text-center"},ee=["onClick"],le=[n("a",{href:"javascript:void(0);",class:"text-warning d-inline-block"},[n("i",{class:"ri-eye-fill fs-16"})],-1)],te=["onClick"],ae=[n("a",{href:"javascript:void(0);",class:"text-primary d-inline-block"},[n("i",{class:"ri-pencil-fill fs-16"})],-1)],se={class:"list-inline-item",title:"Remove"},ie=["onClick"],re=[n("i",{class:"ri-delete-bin-5-fill fs-16"},null,-1)],oe={class:"card-footer p-0"},de={__name:"Index",props:["collection","filters","references"],setup(de){const ne=M().page,ce=[{text:"Dashboard",to:route("dashboard")},{text:"Setting"},{text:"Configuration"},{text:ne.title,active:!0}],ue=e({keyword:l().props.ziggy.query.keyword??null}),me=t(null),pe=t(!1),ve=t(!1);return(e,l)=>{const t=j,M=w;return a(),s(_,null,{header:i((()=>[r(y,{title:o(ne).title,breadcrumbs:ce},null,8,["title"])])),default:i((()=>[r(o(d),{title:o(ne).title},null,8,["title"]),n("div",R,[n("div",V,[n("div",$,[n("div",q,[r(M,null,{default:i((()=>[r(t,{variant:"primary",class:"btn-label waves-effect waves-light",onClick:l[0]||(l[0]=e=>(pe.value=!0,me.value=null))},{default:i((()=>[E,c(" Create ")])),_:1})])),_:1})]),n("div",G,[n("div",I,[r(M,null,{default:i((()=>[r(S,{page:o(ne)},null,8,["page"]),de.collection.links.length>3?(a(),s(k,{key:0})):u("",!0)])),_:1})])])])]),n("div",N,[n("form",{onSubmit:l[2]||(l[2]=m((l=>o(ue).get(e.route(`${o(ne).module}.${o(ne).name}.index`))),["prevent"])),class:"search-box"},[p(n("input",{type:"search",class:"form-control search border-0 py-3",placeholder:`Search for ${o(ne).title} ...`,"onUpdate:modelValue":l[1]||(l[1]=e=>o(ue).keyword=e)},null,8,T),[[v,o(ue).keyword]]),z],32)]),n("div",B,[n("div",J,[n("table",O,[n("thead",Y,[n("tr",null,[K,r(A,{label:"Code",attribute:"code"}),r(A,{label:"Department",attribute:"department_id"}),r(A,{label:"Name",attribute:"name"}),r(A,{width:"140",label:"Created At",attribute:"created_at"}),L,Q,W])]),n("tbody",null,[(a(!0),b(g,null,f(de.collection.data,((e,l)=>(a(),b("tr",{key:e.id},[n("td",null,h((de.collection.current_page-1)*de.collection.per_page+l+1),1),n("td",null,h(e.code),1),n("td",null,h(e.department?.name),1),n("td",null,h(e.name),1),n("td",X,[r(U,{data:e.created_at},null,8,["data"])]),n("td",null,[r(C,{data:e.created_user?.name},null,8,["data"])]),n("td",null,[r(D,{data:e.deleted_at},null,8,["data"])]),n("td",null,[n("ul",Z,[e.deleted_at?u("",!0):(a(),b(g,{key:0},[n("li",{class:"list-inline-item",title:"View",onClick:()=>{me.value=e.id,ve.value=!0}},le,8,ee),n("li",{class:"list-inline-item edit",title:"Edit",onClick:()=>{me.value=e.id,pe.value=!0}},ae,8,te),n("li",se,[n("a",{href:"javascript:void(0);",class:"text-danger d-inline-block",onClick:l=>o(F).deleteData(e.id)},re,8,ie)])],64))])])])))),128))])])])]),n("div",oe,[r(x,{data:de.collection},null,8,["data"])])]),r(P,{show:pe.value,"onUpdate:show":l[3]||(l[3]=e=>pe.value=e),id:me.value,"onUpdate:id":l[4]||(l[4]=e=>me.value=e),references:de.references},null,8,["show","id","references"]),r(H,{show:ve.value,"onUpdate:show":l[5]||(l[5]=e=>ve.value=e),id:me.value,"onUpdate:id":l[6]||(l[6]=e=>me.value=e)},null,8,["show","id"])])),_:1})}}};export{de as default};