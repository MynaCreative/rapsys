import{T as e,Q as s,D as a,w as l,o as r,a as t,u as o,Z as i,c as d,b as n,t as c,m,d as u,H as p,I as b,e as f}from"./app-4fa61095.js";import{_ as h}from"./Main-f90a679c.js";import{_ as v}from"./PageHeader-41edaff7.js";import{J as g}from"./JsonTreeView-3bb18f83.js";import{e as y}from"./entity-b7578e14.js";import"./logo-light-68509ea3.js";import"./sweetalert2.all-47788bf1.js";import"./_plugin-vue_export-helper-1b428a4d.js";import"./Footer-909bdcdd.js";const w={key:0,class:"alert alert-danger alert-dismissible alert-additional shadow fade show",role:"alert"},x={class:"alert-body"},j=n("button",{type:"button",class:"btn-close","data-bs-dismiss":"alert","aria-label":"Close"},null,-1),k={class:"d-flex"},D=n("div",{class:"flex-shrink-0 me-3"},[n("i",{class:"ri-error-warning-line fs-16 align-middle"})],-1),S={class:"flex-grow-1"},_=n("h5",{class:"alert-heading"},"Something is wrong!",-1),R={class:"mb-0"},A={class:"alert-content"},I={class:"mb-0"},P={class:"card"},$=n("i",{class:"ri-search-line search-icon"},null,-1),B={class:"card"},C={class:"card-body"},J={key:1,class:"text-muted fw-medium"},O=n("code",null,"700020452244",-1),U={key:1,class:"card"},W=n("div",{class:"card-header"},[n("h5",{class:"mb-0"},"API Detail - REST")],-1),E={class:"card-body"},F={class:"table-responsive table-card"},H={class:"table mb-0"},K=n("td",{class:"fw-medium",width:"120"},[n("i",{class:"ri-link"}),f(" URL")],-1),N=n("td",{class:"fw-medium"},[n("i",{class:"ri-user-follow-line"}),f(" Username")],-1),T=n("td",{class:"fw-medium"},[n("i",{class:"ri-admin-line"}),f(" Password")],-1),V={__name:"ConsDetail",props:["result","information"],setup(V){const q=V,z=y().page,G=[{text:"Dashboard",to:route("dashboard")},{text:"Setting"},{text:"Delta"},{text:"Revenue AWB",active:!0}],L=e({code:s().props.ziggy.query.code??null});return(e,s)=>(r(),a(h,null,{header:l((()=>[t(v,{title:"Revenue AWB",breadcrumbs:G})])),default:l((()=>[t(o(i),{title:"Revenue AWB"}),Object.keys(e.$page.props.errors).length?(r(),d("div",w,[n("div",x,[j,n("div",k,[D,n("div",S,[_,n("p",R,c(e.$page.props.errors.exception),1)])])]),n("div",A,[n("p",I,c(e.$page.props.errors.error),1)])])):m("",!0),n("div",P,[n("form",{onSubmit:s[1]||(s[1]=u((s=>o(L).get(e.route(`${o(z).module}.cons-detail`))),["prevent"])),class:"search-box"},[p(n("input",{type:"search",class:"form-control search border-0 py-3","onUpdate:modelValue":s[0]||(s[0]=e=>o(L).code=e),placeholder:"Search CONS code here ...",autofocus:""},null,512),[[b,o(L).code]]),$],32)]),n("div",B,[n("div",C,[q.result?(r(),a(o(g),{key:0,data:JSON.stringify(q.result),rootKey:"API Result",maxDepth:10},null,8,["data"])):(r(),d("div",J,[f("example : "),O]))])]),q.information?(r(),d("div",U,[W,n("div",E,[n("div",F,[n("table",H,[n("tbody",null,[n("tr",null,[K,n("td",null,c(q.information.url),1)]),n("tr",null,[N,n("td",null,c(q.information.username),1)]),n("tr",null,[T,n("td",null,c(q.information.password),1)])])])])])])):m("",!0)])),_:1}))}};export{V as default};