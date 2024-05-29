import{T as s,Q as e,D as a,w as l,o as r,a as t,u as o,Z as i,c as d,b as n,t as c,m,d as u,H as p,I as b,e as f}from"./app-4fa61095.js";import{_ as h}from"./Main-f90a679c.js";import{_ as g}from"./PageHeader-41edaff7.js";import{J as v}from"./JsonTreeView-3bb18f83.js";import"./logo-light-68509ea3.js";import"./sweetalert2.all-47788bf1.js";import"./_plugin-vue_export-helper-1b428a4d.js";import"./Footer-909bdcdd.js";const w={key:0,class:"alert alert-danger alert-dismissible alert-additional shadow fade show",role:"alert"},y={class:"alert-body"},x=n("button",{type:"button",class:"btn-close","data-bs-dismiss":"alert","aria-label":"Close"},null,-1),S={class:"d-flex"},j=n("div",{class:"flex-shrink-0 me-3"},[n("i",{class:"ri-error-warning-line fs-16 align-middle"})],-1),D={class:"flex-grow-1"},k=n("h5",{class:"alert-heading"},"Something is wrong!",-1),_={class:"mb-0"},C={class:"alert-content"},O={class:"mb-0"},I={class:"card"},N=n("i",{class:"ri-search-line search-icon"},null,-1),P={class:"card"},R={class:"card-body"},$={key:1,class:"text-muted fw-medium"},J=n("code",null,"817690638322",-1),U={key:1,class:"card"},A=n("div",{class:"card-header"},[n("h5",{class:"mb-0"},"API Detail - REST")],-1),E={class:"card-body"},F={class:"table-responsive table-card"},H={class:"table mb-0"},K=n("td",{class:"fw-medium",width:"120"},[n("i",{class:"ri-link"}),f(" URL")],-1),T=n("td",{class:"fw-medium"},[n("i",{class:"ri-user-follow-line"}),f(" Username")],-1),V=n("td",{class:"fw-medium"},[n("i",{class:"ri-admin-line"}),f(" Password")],-1),q={__name:"ConsInfo",props:["result","information"],setup(q){const z=q,G={module:"setting.racos"},L=[{text:"Dashboard",to:route("dashboard")},{text:"Setting"},{text:"Racos"},{text:"CONS Detail",active:!0}],M=s({code:e().props.ziggy.query.code??null});return(s,e)=>(r(),a(h,null,{header:l((()=>[t(g,{title:"CONS Detail",breadcrumbs:L})])),default:l((()=>[t(o(i),{title:"CONS Detail"}),Object.keys(s.$page.props.errors).length?(r(),d("div",w,[n("div",y,[x,n("div",S,[j,n("div",D,[k,n("p",_,c(s.$page.props.errors.exception),1)])])]),n("div",C,[n("p",O,c(s.$page.props.errors.error),1)])])):m("",!0),n("div",I,[n("form",{onSubmit:e[1]||(e[1]=u((e=>o(M).get(s.route(`${o(G).module}.info`))),["prevent"])),class:"search-box"},[p(n("input",{type:"search",class:"form-control search border-0 py-3","onUpdate:modelValue":e[0]||(e[0]=s=>o(M).code=s),placeholder:"Search CONS code here ...",autofocus:""},null,512),[[b,o(M).code]]),N],32)]),n("div",P,[n("div",R,[z.result?(r(),a(o(v),{key:0,data:JSON.stringify(z.result),rootKey:"API Result",maxDepth:10},null,8,["data"])):(r(),d("div",$,[f("example : "),J]))])]),z.information?(r(),d("div",U,[A,n("div",E,[n("div",F,[n("table",H,[n("tbody",null,[n("tr",null,[K,n("td",null,c(z.information.url),1)]),n("tr",null,[T,n("td",null,c(z.information.username),1)]),n("tr",null,[V,n("td",null,c(z.information.password),1)])])])])])])):m("",!0)])),_:1}))}};export{q as default};