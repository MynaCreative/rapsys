import{T as t,Q as e,r as a,o as l,D as s,w as i,a as r,u as o,Z as n,b as d,i as c,e as u,q as p,d as m,G as v,H as _,c as f,E as b,t as h,F as x,M as g,a5 as k,ak as y}from"./app-DSTM3SJ3.js";import{_ as w}from"./Main-B6b0oP4E.js";import{_ as j}from"./PageHeader-BsnaedmG.js";import{_ as C,a as z}from"./PerPage-BVET7Bh5.js";import{_ as $}from"./Timestamp-CtxzEmuD.js";import{_ as D}from"./Reload-Vvu4JrXY.js";import{_ as M}from"./Sort-B1j3uqbD.js";import S from"./Approval-DmlgMPUB.js";import{s as A,e as I}from"./service-bYEantlz.js";import"./logo-light-fEv4Yehr.js";import"./sweetalert2.all-BaCSOYxu.js";import"./_plugin-vue_export-helper-BCo6x5W8.js";import"./Footer-Dv8wUYbi.js";import"./Modal-1mpmqj-q.js";import"./UserName-B1eWDQBk.js";const Y={class:"card"},P={class:"card-header border-0"},U={class:"row g-4"},E={class:"col-sm-auto"},H=d("i",{class:"ri-add-line label-icon align-middle fs-16 me-2"},null,-1),R={class:"col-sm"},T={class:"d-flex justify-content-sm-end"},V={class:"card-body p-0 border-2 border-top border-bottom"},q=["placeholder"],F=d("i",{class:"ri-search-line search-icon"},null,-1),G={class:"card-body pb-0"},N={class:"table-responsive table-card mb-0"},J={class:"table table-hover table-nowrap table-sm align-middle mb-0"},L={class:"table-light text-muted"},O=d("th",{width:"60",rowspan:"2",class:"align-middle"},"#",-1),B=d("th",{class:"text-center",colspan:"3"},"Status",-1),K=d("th",{class:"text-center",colspan:"2"},"Date",-1),Q=d("th",{width:"100",class:"text-center align-middle",rowspan:"2"},"Action",-1),W=d("th",{class:"text-center"},"Document",-1),X=d("th",{class:"text-center"},"Checking",-1),Z=d("th",{class:"text-center"},"Approval",-1),tt={class:"fw-medium"},et={class:"text-end"},at={class:"text-primary fs-11 mb-0"},lt=d("i",{class:"ri-wallet-line align-middle"},null,-1),st={class:"text-center"},it={class:"text-center"},rt={class:"text-center"},ot={class:"text-center date"},nt={class:"text-center date"},dt={class:"list-inline gap-2 mb-0 text-center"},ct=["onClick"],ut=d("i",{class:"ri-pencil-fill fs-16"},null,-1),pt={key:0,class:"list-inline-item",title:"Remove"},mt=["onClick"],vt=[d("i",{class:"ri-delete-bin-5-fill fs-16"},null,-1)],_t={class:"card-footer p-0"},ft={__name:"Index",props:["collection","filters"],setup(ft){const bt=I().page,ht=[{text:"Dashboard",to:route("dashboard")},{text:"Transaction"},{text:bt.title,active:!0}],xt=t({keyword:e().props.ziggy.query.keyword??null}),gt=a(null),kt=a(!1),yt=a(!1);return(t,e)=>{const a=g,I=k,wt=y;return l(),s(w,null,{header:i((()=>[r(j,{title:o(bt).title,breadcrumbs:ht},null,8,["title"])])),default:i((()=>[r(o(n),{title:o(bt).title},null,8,["title"]),d("div",Y,[d("div",P,[d("div",U,[d("div",E,[r(a,null,{default:i((()=>[r(o(c),{href:t.route(`${o(bt).module}.${o(bt).name}.create`),class:"btn btn-primary btn-label waves-effect waves-light"},{default:i((()=>[H,u(" Create ")])),_:1},8,["href"])])),_:1})]),d("div",R,[d("div",T,[r(a,null,{default:i((()=>[r(D,{page:o(bt)},null,8,["page"]),ft.collection.links.length>3?(l(),s(C,{key:0})):p("",!0)])),_:1})])])])]),d("div",V,[d("form",{onSubmit:e[1]||(e[1]=m((e=>o(xt).get(t.route(`${o(bt).module}.${o(bt).name}.index`))),["prevent"])),class:"search-box"},[v(d("input",{type:"search",class:"form-control search border-0 py-3",placeholder:`Search for ${o(bt).title} ...`,"onUpdate:modelValue":e[0]||(e[0]=t=>o(xt).keyword=t)},null,8,q),[[_,o(xt).keyword]]),F],32)]),d("div",G,[d("div",N,[d("table",J,[d("thead",L,[d("tr",null,[O,r(M,{label:"Invoice Number",attribute:"invoice_number",rowspan:"2",class:"align-middle"}),r(M,{label:"Vendor",attribute:"vendor_id",rowspan:"2",class:"align-middle"}),r(M,{label:"Invoice Amount",attribute:"total_amount",rowspan:"2",class:"text-center align-middle"}),B,K,Q]),d("tr",null,[W,X,Z,r(M,{width:"110",label:"Invoice",attribute:"invoice_date",class:"text-center"}),r(M,{width:"140",label:"Created",attribute:"created_at",class:"text-center"})])]),d("tbody",null,[(l(!0),f(x,null,b(ft.collection.data,((e,a)=>(l(),f("tr",{key:e.id},[d("td",null,h((ft.collection.current_page-1)*ft.collection.per_page+a+1),1),d("td",tt,h(e.invoice_number?e.invoice_number:"--"),1),d("td",null,h(e.vendor?`${e.vendor.code} - ${e.vendor.name}`:"--"),1),d("td",et,[d("h6",at,[u(h(e.total_amount_after_tax.toLocaleString())+" ",1),lt])]),d("td",st,["draft"==e.document_status?(l(),s(I,{key:0,variant:"light",class:"rounded-pill text-capitalize"},{default:i((()=>[u(h(e.document_status),1)])),_:2},1024)):p("",!0),"published"==e.document_status?(l(),s(I,{key:1,variant:"primary",class:"rounded-pill text-capitalize"},{default:i((()=>[u(h(e.document_status),1)])),_:2},1024)):p("",!0),"cancelled"==e.document_status?(l(),s(I,{key:2,variant:"danger",class:"rounded-pill text-capitalize"},{default:i((()=>[u(h(e.document_status),1)])),_:2},1024)):p("",!0),"void"==e.document_status?(l(),s(I,{key:3,variant:"danger",class:"rounded-pill text-capitalize"},{default:i((()=>[u(h(e.document_status),1)])),_:2},1024)):p("",!0),"closed"==e.document_status?(l(),s(I,{key:4,variant:"success",class:"rounded-pill text-capitalize"},{default:i((()=>[u(h(e.document_status),1)])),_:2},1024)):p("",!0)]),d("td",it,[e.items!=e.validated_items?(l(),s(wt,{key:0,value:e.validated_items,max:e.items,height:"15px","show-progress":"",animated:""},null,8,["value","max"])):(l(),s(I,{key:1,variant:"success",class:"rounded-pill text-capitalize"},{default:i((()=>[u("done")])),_:1}))]),d("td",rt,["none"==e.approval_status?(l(),s(I,{key:0,variant:"light",class:"text-capitalize"},{default:i((()=>[u(h(e.approval_status),1)])),_:2},1024)):p("",!0),"pending"==e.approval_status?(l(),s(I,{key:1,variant:"soft-primary",class:"text-primary text-capitalize cursor-pointer",onClick:()=>{gt.value=e.id,yt.value=!0}},{default:i((()=>[u(h(e.approval_status),1)])),_:2},1032,["onClick"])):p("",!0),"approved"==e.approval_status?(l(),s(I,{key:2,variant:"soft-success",class:"text-success text-capitalize cursor-pointer",onClick:()=>{gt.value=e.id,yt.value=!0}},{default:i((()=>[u(h(e.approval_status),1)])),_:2},1032,["onClick"])):p("",!0),"rejected"==e.approval_status?(l(),s(I,{key:3,variant:"soft-danger",class:"text-danger text-capitalize cursor-pointer",onClick:()=>{gt.value=e.id,yt.value=!0}},{default:i((()=>[u(h(e.approval_status),1)])),_:2},1032,["onClick"])):p("",!0)]),d("td",ot,h(t.$dayjs(e.invoice_date).format("DD MMM, YYYY")),1),d("td",nt,[r($,{data:e.created_at},null,8,["data"])]),d("td",null,[d("ul",dt,[d("li",{class:"list-inline-item edit",title:"Edit",onClick:()=>{gt.value=e.id,kt.value=!0}},[r(o(c),{href:t.route(`${o(bt).module}.${o(bt).name}.edit`,e.id),class:"text-primary d-inline-block",title:"Edit"},{default:i((()=>[ut])),_:2},1032,["href"])],8,ct),"draft"==e.document_status?(l(),f("li",pt,[d("a",{href:"javascript:void(0);",class:"text-danger d-inline-block",onClick:t=>o(A).deleteData(e.id)},vt,8,mt)])):p("",!0)])])])))),128))])])])]),d("div",_t,[r(z,{data:ft.collection},null,8,["data"])])]),r(S,{show:yt.value,"onUpdate:show":e[2]||(e[2]=t=>yt.value=t),id:gt.value,"onUpdate:id":e[3]||(e[3]=t=>gt.value=t)},null,8,["show","id"])])),_:1})}}};export{ft as default};
