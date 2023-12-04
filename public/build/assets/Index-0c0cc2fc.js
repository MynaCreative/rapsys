import{T as l,Q as e,r as a,D as t,w as s,o as i,a as o,u as r,Z as d,b as n,e as c,m as u,d as m,H as p,I as v,c as f,G as b,t as h,F as w,g,M as j}from"./app-30e0783b.js";import{_}from"./Main-7c4d393d.js";import{_ as k}from"./PageHeader-5f27e6fb.js";import{_ as x,a as y}from"./PerPage-fb32db7c.js";import{_ as C}from"./UserName-f3c46ade.js";import{_ as U}from"./Timestamp-26024741.js";import{_ as D}from"./Active-9c1bbe54.js";import{_ as A}from"./Reload-fc77effc.js";import{_ as F}from"./Sort-8f4c5b09.js";import{e as I}from"./entity-993c329d.js";import{s as M}from"./service-a5bef63d.js";import S from"./Form-ca950875.js";import E from"./Import-ebf959dd.js";import H from"./Export-7daf945e.js";import P from"./Detail-d9cfbc75.js";import"./logo-light-68509ea3.js";import"./sweetalert2.all-aaaa6da5.js";import"./_plugin-vue_export-helper-1b428a4d.js";import"./Footer-61ce5cc7.js";import"./Modal-36df24f3.js";import"./Form-f70b0e5f.js";const R={class:"card"},V={class:"card-header border-0"},$={class:"row g-4"},G={class:"col-sm-auto"},N=n("i",{class:"ri-add-line label-icon align-middle fs-16 me-2"},null,-1),T=n("i",{class:"bx bx-import label-icon align-middle fs-16"},null,-1),q=n("i",{class:"bx bx-export label-icon align-middle fs-16"},null,-1),z={class:"col-sm"},B={class:"d-flex justify-content-sm-end"},J={class:"card-body p-0 border-2 border-top border-bottom"},W=["placeholder"],Y=n("i",{class:"ri-search-line search-icon"},null,-1),Z={class:"card-body pb-0"},K={class:"table-responsive table-card mb-0"},L={class:"table table-hover table-nowrap align-middle mb-0"},O={class:"table-light text-muted"},Q=n("th",{width:"60"},"#",-1),X=n("th",{width:"140"},"Created By",-1),ll=n("th",{width:"70"},"Active",-1),el=n("th",{width:"120",class:"text-center"},"Action",-1),al={class:"date"},tl={class:"list-inline gap-2 mb-0 text-center"},sl=["onClick"],il=[n("a",{href:"javascript:void(0);",class:"text-warning d-inline-block"},[n("i",{class:"ri-eye-fill fs-16"})],-1)],ol=["onClick"],rl=[n("a",{href:"javascript:void(0);",class:"text-primary d-inline-block"},[n("i",{class:"ri-pencil-fill fs-16"})],-1)],dl={class:"list-inline-item",title:"Remove"},nl=["onClick"],cl=[n("i",{class:"ri-delete-bin-5-fill fs-16"},null,-1)],ul={key:1,class:"list-inline-item",title:"Restore"},ml=["onClick"],pl=[n("i",{class:"ri-refresh-fill fs-16"},null,-1)],vl={class:"card-footer p-0"},fl={__name:"Index",props:["collection","filters"],setup(fl){const bl=I().page,hl=[{text:"Dashboard",to:route("dashboard")},{text:"Master"},{text:bl.title,active:!0}],wl=l({keyword:e().props.ziggy.query.keyword??null}),gl=a(null),jl=a(!1),_l=a(!1),kl=a(!1),xl=a(!1);return(l,e)=>{const a=g,I=j;return i(),t(_,null,{header:s((()=>[o(k,{title:r(bl).title,breadcrumbs:hl},null,8,["title"])])),default:s((()=>[o(r(d),{title:r(bl).title},null,8,["title"]),n("div",R,[n("div",V,[n("div",$,[n("div",G,[o(I,null,{default:s((()=>[o(a,{variant:"primary",class:"btn-label waves-effect waves-light",onClick:e[0]||(e[0]=l=>(jl.value=!0,gl.value=null))},{default:s((()=>[N,c(" Create ")])),_:1}),o(a,{variant:"success",class:"btn-label waves-effect waves-light right",onClick:e[1]||(e[1]=l=>_l.value=!0)},{default:s((()=>[T,c(" Import ")])),_:1}),o(a,{variant:"warning",class:"btn-label waves-effect waves-light right",onClick:e[2]||(e[2]=l=>kl.value=!0)},{default:s((()=>[q,c(" Export ")])),_:1})])),_:1})]),n("div",z,[n("div",B,[o(I,null,{default:s((()=>[o(A,{page:r(bl)},null,8,["page"]),fl.collection.links.length>3?(i(),t(x,{key:0})):u("",!0)])),_:1})])])])]),n("div",J,[n("form",{onSubmit:e[4]||(e[4]=m((e=>r(wl).get(l.route(`${r(bl).module}.${r(bl).name}.index`))),["prevent"])),class:"search-box"},[p(n("input",{type:"search",class:"form-control search border-0 py-3",placeholder:`Search for ${r(bl).title} ...`,"onUpdate:modelValue":e[3]||(e[3]=l=>r(wl).keyword=l)},null,8,W),[[v,r(wl).keyword]]),Y],32)]),n("div",Z,[n("div",K,[n("table",L,[n("thead",O,[n("tr",null,[Q,o(F,{label:"Code",attribute:"code"}),o(F,{label:"Name",attribute:"name"}),o(F,{width:"140",label:"Created At",attribute:"created_at"}),X,ll,el])]),n("tbody",null,[(i(!0),f(w,null,b(fl.collection.data,((l,e)=>(i(),f("tr",{key:l.id},[n("td",null,h((fl.collection.current_page-1)*fl.collection.per_page+e+1),1),n("td",null,h(l.code),1),n("td",null,h(l.name),1),n("td",al,[o(U,{data:l.created_at},null,8,["data"])]),n("td",null,[o(C,{data:l.created_user?.name},null,8,["data"])]),n("td",null,[o(D,{data:l.deleted_at},null,8,["data"])]),n("td",null,[n("ul",tl,[l.deleted_at?(i(),f("li",ul,[n("a",{href:"javascript:void(0);",class:"text-info d-inline-block",onClick:e=>r(M).deleteData(l.id,!0)},pl,8,ml)])):(i(),f(w,{key:0},[n("li",{class:"list-inline-item",title:"View",onClick:()=>{gl.value=l.id,xl.value=!0}},il,8,sl),n("li",{class:"list-inline-item edit",title:"Edit",onClick:()=>{gl.value=l.id,jl.value=!0}},rl,8,ol),n("li",dl,[n("a",{href:"javascript:void(0);",class:"text-danger d-inline-block",onClick:e=>r(M).deleteData(l.id)},cl,8,nl)])],64))])])])))),128))])])])]),n("div",vl,[o(y,{data:fl.collection},null,8,["data"])])]),o(S,{show:jl.value,"onUpdate:show":e[5]||(e[5]=l=>jl.value=l),id:gl.value,"onUpdate:id":e[6]||(e[6]=l=>gl.value=l)},null,8,["show","id"]),o(E,{show:_l.value,"onUpdate:show":e[7]||(e[7]=l=>_l.value=l)},null,8,["show"]),o(H,{show:kl.value,"onUpdate:show":e[8]||(e[8]=l=>kl.value=l)},null,8,["show"]),o(P,{show:xl.value,"onUpdate:show":e[9]||(e[9]=l=>xl.value=l),id:gl.value,"onUpdate:id":e[10]||(e[10]=l=>gl.value=l)},null,8,["show","id"])])),_:1})}}};export{fl as default};
