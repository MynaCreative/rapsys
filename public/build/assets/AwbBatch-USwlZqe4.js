import{T as e,Q as s,o as a,D as l,w as r,a as t,u as o,Z as i,c as d,b as c,t as n,q as m,d as u,G as p,H as b,e as h}from"./app-DSTM3SJ3.js";import{_ as f}from"./Main-B6b0oP4E.js";import{_ as g}from"./PageHeader-BsnaedmG.js";import{J as v}from"./JsonTreeView-DI6xFqX1.js";import{e as w}from"./entity-BoJ_ksIf.js";import"./logo-light-fEv4Yehr.js";import"./sweetalert2.all-BaCSOYxu.js";import"./_plugin-vue_export-helper-BCo6x5W8.js";import"./Footer-Dv8wUYbi.js";const y={key:0,class:"alert alert-danger alert-dismissible alert-additional shadow fade show",role:"alert"},x={class:"alert-body"},j=c("button",{type:"button",class:"btn-close","data-bs-dismiss":"alert","aria-label":"Close"},null,-1),B={class:"d-flex"},k=c("div",{class:"flex-shrink-0 me-3"},[c("i",{class:"ri-error-warning-line fs-16 align-middle"})],-1),A={class:"flex-grow-1"},_=c("h5",{class:"alert-heading"},"Something is wrong!",-1),S={class:"mb-0"},D={class:"alert-content"},J={class:"mb-0"},P={class:"card"},W=c("i",{class:"ri-search-line search-icon"},null,-1),$={class:"card"},H={class:"card-body"},I={key:1,class:"text-muted fw-medium"},O=c("code",null,"717661005051,700001770020",-1),R={key:1,class:"card"},U=c("div",{class:"card-header"},[c("h5",{class:"mb-0"},"API Detail - REST")],-1),q={class:"card-body"},z={class:"table-responsive table-card"},G={class:"table mb-0"},M=c("td",{class:"fw-medium",width:"120"},[c("i",{class:"ri-link"}),h(" URL")],-1),T=c("td",{class:"fw-medium"},[c("i",{class:"ri-user-follow-line"}),h(" Username")],-1),V=c("td",{class:"fw-medium"},[c("i",{class:"ri-admin-line"}),h(" Password")],-1),C={__name:"AwbBatch",props:["result","information"],setup(C){const E=w().page,F=[{text:"Dashboard",to:route("dashboard")},{text:"Setting"},{text:"Delta"},{text:"AWB Batch",active:!0}],K=C,L=e({code:s().props.ziggy.query.code??null});return(e,s)=>(a(),l(f,null,{header:r((()=>[t(g,{title:"AWB Batch",breadcrumbs:F})])),default:r((()=>[t(o(i),{title:"AWB Batch"}),Object.keys(e.$page.props.errors).length?(a(),d("div",y,[c("div",x,[j,c("div",B,[k,c("div",A,[_,c("p",S,n(e.$page.props.errors.exception),1)])])]),c("div",D,[c("p",J,n(e.$page.props.errors.error),1)])])):m("",!0),c("div",P,[c("form",{onSubmit:s[1]||(s[1]=u((s=>o(L).get(e.route(`${o(E).module}.awb-batch`))),["prevent"])),class:"search-box"},[p(c("input",{type:"search",class:"form-control search border-0 py-3","onUpdate:modelValue":s[0]||(s[0]=e=>o(L).code=e),placeholder:"Search AWB code here, for multiple code separeted using comma ','",autofocus:""},null,512),[[b,o(L).code]]),W],32)]),c("div",$,[c("div",H,[K.result?(a(),l(o(v),{key:0,data:JSON.stringify(K.result),rootKey:"API Result",maxDepth:3},null,8,["data"])):(a(),d("div",I,[h("example : "),O]))])]),K.information?(a(),d("div",R,[U,c("div",q,[c("div",z,[c("table",G,[c("tbody",null,[c("tr",null,[M,c("td",null,n(K.information.url),1)]),c("tr",null,[T,c("td",null,n(K.information.username),1)]),c("tr",null,[V,c("td",null,n(K.information.password),1)])])])])])])):m("",!0)])),_:1}))}};export{C as default};
