import{T as s,Q as e,D as a,w as l,o as r,a as t,u as o,Z as i,c as d,b as n,t as c,m,d as u,H as p,I as b,e as f}from"./app-30e0783b.js";import{_ as h}from"./Main-7c4d393d.js";import{_ as g}from"./PageHeader-5f27e6fb.js";import{J as v,e as y}from"./entity-83ac41d5.js";import"./logo-light-68509ea3.js";import"./sweetalert2.all-aaaa6da5.js";import"./_plugin-vue_export-helper-1b428a4d.js";import"./Footer-61ce5cc7.js";const w={key:0,class:"alert alert-danger alert-dismissible alert-additional shadow fade show",role:"alert"},x={class:"alert-body"},S=n("button",{type:"button",class:"btn-close","data-bs-dismiss":"alert","aria-label":"Close"},null,-1),j={class:"d-flex"},k=n("div",{class:"flex-shrink-0 me-3"},[n("i",{class:"ri-error-warning-line fs-16 align-middle"})],-1),U={class:"flex-grow-1"},_=n("h5",{class:"alert-heading"},"Something is wrong!",-1),D={class:"mb-0"},M={class:"alert-content"},P={class:"mb-0"},$={class:"card"},A=n("i",{class:"ri-search-line search-icon"},null,-1),I={class:"card"},R={class:"card-body"},C={key:1,class:"text-muted fw-medium"},H=n("code",null,"12662562183",-1),J={key:1,class:"card"},O=n("div",{class:"card-header"},[n("h5",{class:"mb-0"},"API Detail - REST")],-1),q={class:"card-body"},z={class:"table-responsive table-card"},E={class:"table mb-0"},F=n("td",{class:"fw-medium",width:"120"},[n("i",{class:"ri-link"}),f(" URL")],-1),K=n("td",{class:"fw-medium"},[n("i",{class:"ri-user-follow-line"}),f(" Username")],-1),L=n("td",{class:"fw-medium"},[n("i",{class:"ri-admin-line"}),f(" Password")],-1),N={__name:"Smu",props:["result","information"],setup(N){const T=N,V=y().page,B=[{text:"Dashboard",to:route("dashboard")},{text:"Setting"},{text:"Delta"},{text:"SMU",active:!0}],G=s({code:e().props.ziggy.query.code??null});return(s,e)=>(r(),a(h,null,{header:l((()=>[t(g,{title:"SMU",breadcrumbs:B})])),default:l((()=>[t(o(i),{title:"SMU"}),Object.keys(s.$page.props.errors).length?(r(),d("div",w,[n("div",x,[S,n("div",j,[k,n("div",U,[_,n("p",D,c(s.$page.props.errors.exception),1)])])]),n("div",M,[n("p",P,c(s.$page.props.errors.error),1)])])):m("",!0),n("div",$,[n("form",{onSubmit:e[1]||(e[1]=u((e=>o(G).get(s.route(`${o(V).module}.smu`))),["prevent"])),class:"search-box"},[p(n("input",{type:"search",class:"form-control search border-0 py-3","onUpdate:modelValue":e[0]||(e[0]=s=>o(G).code=s),placeholder:"Search SMU code here ...",autofocus:""},null,512),[[b,o(G).code]]),A],32)]),n("div",I,[n("div",R,[T.result?(r(),a(o(v),{key:0,data:JSON.stringify(T.result),rootKey:"API Result",maxDepth:10},null,8,["data"])):(r(),d("div",C,[f("example : "),H]))])]),T.information?(r(),d("div",J,[O,n("div",q,[n("div",z,[n("table",E,[n("tbody",null,[n("tr",null,[F,n("td",null,c(T.information.url),1)]),n("tr",null,[K,n("td",null,c(T.information.username),1)]),n("tr",null,[L,n("td",null,c(T.information.password),1)])])])])])])):m("",!0)])),_:1}))}};export{N as default};
