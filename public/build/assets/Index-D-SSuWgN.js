import{T as l,Q as e,r as a,o as t,D as s,w as i,a as o,u as r,Z as d,b as n,e as c,q as u,d as m,G as p,H as v,c as b,E as f,t as h,F as w,h as g,M as j}from"./app-DSTM3SJ3.js";import{_}from"./Main-B6b0oP4E.js";import{_ as k}from"./PageHeader-BsnaedmG.js";import{_ as y,a as x}from"./PerPage-BVET7Bh5.js";import{_ as C}from"./UserName-B1eWDQBk.js";import{_ as U}from"./Timestamp-CtxzEmuD.js";import{_ as D}from"./Active-kFjrOewo.js";import{_ as A}from"./Reload-Vvu4JrXY.js";import{_ as M}from"./Sort-B1j3uqbD.js";import{e as E}from"./entity-BYvgtDJI.js";import{s as F}from"./service-BaeGi3DW.js";import I from"./Form-C9x4oGC8.js";import P from"./Import-N4INq-oJ.js";import R from"./Export-u4YNen6P.js";import S from"./Detail-ZU8qBYYw.js";import"./logo-light-fEv4Yehr.js";import"./sweetalert2.all-BaCSOYxu.js";import"./_plugin-vue_export-helper-BCo6x5W8.js";import"./Footer-Dv8wUYbi.js";import"./Modal-1mpmqj-q.js";import"./Form-bbRBB6pI.js";const H={class:"card"},V={class:"card-header border-0"},$={class:"row g-4"},q={class:"col-sm-auto"},z=n("i",{class:"ri-add-line label-icon align-middle fs-16 me-2"},null,-1),B=n("i",{class:"bx bx-import label-icon align-middle fs-16"},null,-1),G=n("i",{class:"bx bx-export label-icon align-middle fs-16"},null,-1),N={class:"col-sm"},T={class:"d-flex justify-content-sm-end"},J={class:"card-body p-0 border-2 border-top border-bottom"},O=["placeholder"],Y=n("i",{class:"ri-search-line search-icon"},null,-1),K={class:"card-body pb-0"},L={class:"table-responsive table-card mb-0"},Q={class:"table table-hover table-nowrap align-middle mb-0"},W={class:"table-light text-muted"},X=n("th",{width:"60"},"#",-1),Z=n("th",{width:"140"},"Created By",-1),ll=n("th",{width:"70"},"Active",-1),el=n("th",{width:"120",class:"text-center"},"Action",-1),al={class:"date"},tl={class:"list-inline gap-2 mb-0 text-center"},sl=["onClick"],il=[n("a",{href:"javascript:void(0);",class:"text-warning d-inline-block"},[n("i",{class:"ri-eye-fill fs-16"})],-1)],ol=["onClick"],rl=[n("a",{href:"javascript:void(0);",class:"text-primary d-inline-block"},[n("i",{class:"ri-pencil-fill fs-16"})],-1)],dl={class:"list-inline-item",title:"Remove"},nl=["onClick"],cl=[n("i",{class:"ri-delete-bin-5-fill fs-16"},null,-1)],ul={key:1,class:"list-inline-item",title:"Restore"},ml=["onClick"],pl=[n("i",{class:"ri-refresh-fill fs-16"},null,-1)],vl={class:"card-footer p-0"},bl={__name:"Index",props:["collection","filters"],setup(bl){const fl=E().page,hl=[{text:"Dashboard",to:route("dashboard")},{text:"Master"},{text:fl.title,active:!0}],wl=l({keyword:e().props.ziggy.query.keyword??null}),gl=a(null),jl=a(!1),_l=a(!1),kl=a(!1),yl=a(!1);return(l,e)=>{const a=g,E=j;return t(),s(_,null,{header:i((()=>[o(k,{title:r(fl).title,breadcrumbs:hl},null,8,["title"])])),default:i((()=>[o(r(d),{title:r(fl).title},null,8,["title"]),n("div",H,[n("div",V,[n("div",$,[n("div",q,[o(E,null,{default:i((()=>[o(a,{variant:"primary",class:"btn-label waves-effect waves-light",onClick:e[0]||(e[0]=l=>(jl.value=!0,gl.value=null))},{default:i((()=>[z,c(" Create ")])),_:1}),o(a,{variant:"success",class:"btn-label waves-effect waves-light right",onClick:e[1]||(e[1]=l=>_l.value=!0)},{default:i((()=>[B,c(" Import ")])),_:1}),o(a,{variant:"warning",class:"btn-label waves-effect waves-light right",onClick:e[2]||(e[2]=l=>kl.value=!0)},{default:i((()=>[G,c(" Export ")])),_:1})])),_:1})]),n("div",N,[n("div",T,[o(E,null,{default:i((()=>[o(A,{page:r(fl)},null,8,["page"]),bl.collection.links.length>3?(t(),s(y,{key:0})):u("",!0)])),_:1})])])])]),n("div",J,[n("form",{onSubmit:e[4]||(e[4]=m((e=>r(wl).get(l.route(`${r(fl).module}.${r(fl).name}.index`))),["prevent"])),class:"search-box"},[p(n("input",{type:"search",class:"form-control search border-0 py-3",placeholder:`Search for ${r(fl).title} ...`,"onUpdate:modelValue":e[3]||(e[3]=l=>r(wl).keyword=l)},null,8,O),[[v,r(wl).keyword]]),Y],32)]),n("div",K,[n("div",L,[n("table",Q,[n("thead",W,[n("tr",null,[X,o(M,{label:"Code",attribute:"code"}),o(M,{label:"Name",attribute:"name"}),o(M,{label:"Day",attribute:"day"}),o(M,{width:"140",label:"Created At",attribute:"created_at"}),Z,ll,el])]),n("tbody",null,[(t(!0),b(w,null,f(bl.collection.data,((l,e)=>(t(),b("tr",{key:l.id},[n("td",null,h((bl.collection.current_page-1)*bl.collection.per_page+e+1),1),n("td",null,h(l.code),1),n("td",null,h(l.name),1),n("td",null,h(l.day),1),n("td",al,[o(U,{data:l.created_at},null,8,["data"])]),n("td",null,[o(C,{data:l.created_user?.name},null,8,["data"])]),n("td",null,[o(D,{data:l.deleted_at},null,8,["data"])]),n("td",null,[n("ul",tl,[l.deleted_at?(t(),b("li",ul,[n("a",{href:"javascript:void(0);",class:"text-info d-inline-block",onClick:e=>r(F).deleteData(l.id,!0)},pl,8,ml)])):(t(),b(w,{key:0},[n("li",{class:"list-inline-item",title:"View",onClick:()=>{gl.value=l.id,yl.value=!0}},il,8,sl),n("li",{class:"list-inline-item edit",title:"Edit",onClick:()=>{gl.value=l.id,jl.value=!0}},rl,8,ol),n("li",dl,[n("a",{href:"javascript:void(0);",class:"text-danger d-inline-block",onClick:e=>r(F).deleteData(l.id)},cl,8,nl)])],64))])])])))),128))])])])]),n("div",vl,[o(x,{data:bl.collection},null,8,["data"])])]),o(I,{show:jl.value,"onUpdate:show":e[5]||(e[5]=l=>jl.value=l),id:gl.value,"onUpdate:id":e[6]||(e[6]=l=>gl.value=l)},null,8,["show","id"]),o(P,{show:_l.value,"onUpdate:show":e[7]||(e[7]=l=>_l.value=l)},null,8,["show"]),o(R,{show:kl.value,"onUpdate:show":e[8]||(e[8]=l=>kl.value=l)},null,8,["show"]),o(S,{show:yl.value,"onUpdate:show":e[9]||(e[9]=l=>yl.value=l),id:gl.value,"onUpdate:id":e[10]||(e[10]=l=>gl.value=l)},null,8,["show","id"])])),_:1})}}};export{bl as default};
