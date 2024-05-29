import{r as e,T as a,C as t,D as s,w as l,E as r,o as i,a as n,u as o,Z as d,b as c,e as m,t as u,c as p,m as f,F as b,G as v,v as g,n as _,i as h,ad as j,A as x,g as y}from"./app-4fa61095.js";import{_ as k}from"./Main-f90a679c.js";import{_ as D}from"./PageHeader-41edaff7.js";import w from"./Header-5ae8e7c3.js";import M from"./Line-a884f499.js";import U from"./Dist-b6b26dfb.js";import{e as V,s as C}from"./service-21b81677.js";import"./logo-light-68509ea3.js";import"./sweetalert2.all-47788bf1.js";import"./_plugin-vue_export-helper-1b428a4d.js";import"./Footer-909bdcdd.js";import"./v-money3-b3e6ec75.js";import"./_baseIteratee-a336095c.js";import"./multiselect-15ad7a83.js";import"./Manual-7c28aa73.js";import"./ManualCreate-6b7cd011.js";import"./Modal-6f5881bc.js";import"./ManualForm-10a3424e.js";import"./ManualItem-276e414c.js";import"./ManualUpdate-f22525d7.js";import"./Upload-6ea79b15.js";import"./UploadItem-13354433.js";import"./SmuPreview-68ba1fa1.js";import"./sumBy-c2d1d6a2.js";import"./UploadForm-6466749c.js";import"./UploadModal-c845f73c.js";const F={class:"card"},P={class:"card-header align-items-center d-flex"},I={class:"flex-grow-1 oveflow-hidden"},z={class:"modal-title"},Y=c("div",{class:"flex-shrink-0 ms-2"},[c("ul",{class:"nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0",role:"tablist"},[c("li",{class:"nav-item"},[c("a",{class:"nav-link active","data-bs-toggle":"tab",href:"#header",role:"tab"}," Header ")]),c("li",{class:"nav-item"},[c("a",{class:"nav-link","data-bs-toggle":"tab",href:"#line",role:"tab"}," Line ")]),c("li",{class:"nav-item"},[c("a",{class:"nav-link","data-bs-toggle":"tab",href:"#dist",role:"tab"}," Dist ")])])],-1),$={key:0,class:"ps-3 pt-3"},E=c("i",{class:"ri-error-warning-line me-3 align-middle fs-16 text-danger"},null,-1),H={class:"tab-content text-muted"},S={class:"tab-pane active",id:"header",role:"tabpanel"},B={class:"tab-content text-muted"},G={class:"tab-pane",id:"line",role:"tabpanel"},L={class:"tab-content text-muted"},q={class:"tab-pane",id:"dist",role:"tabpanel"},A={class:"card-footer d-flex justify-content-between"},K=c("i",{class:"ri-arrow-go-forward-line align-bottom me-1"},null,-1),O={__name:"Form",props:["references","model"],setup(O){const T=O,J=e(null),N=V().page,Q=r().appContext.config.globalProperties.$dayjs,R=[{text:"Dashboard",to:route("dashboard")},{text:"Transaction"},{text:"Invoice",to:route("transaction.invoices.index")},{text:"Form",active:!0}],W=a(T.model?{...T.model}:V().form);t((()=>{if(!W.id){let e=Q().format("YYYY-MM-DD");W.invoice_date=e,W.posting_date=e,W.term_date=e,W.due_date=e,W.invoice_receipt_date=e,W.supplier_tax_invoice_date=e}}));const X=()=>{C.submitData(W,W.id)},Z=e=>{C.saveData(W,e)},ee=()=>{C.validateData(W)};return(e,a)=>{const t=j,r=x,V=y;return i(),s(k,null,{header:l((()=>[n(D,{title:o(N).title,breadcrumbs:R},null,8,["title"])])),default:l((()=>[n(o(d),{title:o(N).title},null,8,["title"]),c("div",F,[c("div",P,[c("div",I,[c("h5",z,[m(" Form "+u(o(W).id?"Update":"Create")+" - "+u(o(N).title)+" "+u(o(W).invoice_number?` [${o(W).invoice_number}]`:"")+" ",1),o(W).id?(i(),p(b,{key:0},["draft"==o(W).document_status?(i(),s(t,{key:0,variant:"light",class:"text-capitalize"},{default:l((()=>[m(u(o(W).document_status),1)])),_:1})):f("",!0),"published"==o(W).document_status?(i(),s(t,{key:1,variant:"soft-primary",class:"text-primary text-capitalize"},{default:l((()=>[m(u(o(W).document_status),1)])),_:1})):f("",!0),"cancelled"==o(W).document_status?(i(),s(t,{key:2,variant:"soft-danger",class:"text-danger text-capitalize"},{default:l((()=>[m(u(o(W).document_status),1)])),_:1})):f("",!0),"closed"==o(W).document_status?(i(),s(t,{key:3,variant:"soft-success",class:"text-success text-capitalize"},{default:l((()=>[m(u(o(W).document_status),1)])),_:1})):f("",!0)],64)):f("",!0)])]),Y]),c("form",{ref_key:"formElement",ref:J},[Object.keys(o(W).errors).length?(i(),p("div",$,[n(r,{modelValue:!!o(W).errors.error,variant:"danger"},{default:l((()=>[m(u(o(W).errors.error),1)])),_:1},8,["modelValue"]),n(r,{modelValue:!!o(W).errors.exception,variant:"danger"},{default:l((()=>[m(u(o(W).errors.exception),1)])),_:1},8,["modelValue"]),n(r,{modelValue:!!o(W).errors,variant:"danger",class:"alert-top-border"},{default:l((()=>[(i(!0),p(b,null,v(o(W).errors,((e,a)=>(i(),p("div",{key:a,class:"mb-1"},[E,m(" "+u(e),1)])))),128))])),_:1},8,["modelValue"])])):f("",!0),c("div",H,[c("div",S,[n(w,{formData:o(W),"onUpdate:formData":a[0]||(a[0]=e=>g(W)?W.value=e:null),references:O.references},null,8,["formData","references"])])]),c("div",B,[c("div",G,[n(M,{formData:o(W),"onUpdate:formData":a[1]||(a[1]=e=>g(W)?W.value=e:null),references:O.references},null,8,["formData","references"])])]),c("div",L,[c("div",q,[n(U,{formData:o(W),"onUpdate:formData":a[2]||(a[2]=e=>g(W)?W.value=e:null),references:O.references},null,8,["formData","references"])])]),c("div",A,[c("div",null,[o(W).id&&!["published","closed","cancelled"].includes(o(W).document_status)?(i(),s(V,{key:0,onClick:X,variant:"primary",class:"btn-label waves-effect waves-light me-1",disabled:o(W).processing},{default:l((()=>[c("i",{class:_(["label-icon align-middle fs-16 me-2",o(W).processing?"ri-refresh-line":"ri-save-line"])},null,2),m(" "+u(o(W).processing?"Processing":"Submit"),1)])),_:1},8,["disabled"])):f("",!0),o(W).id&&!["published","closed","cancelled"].includes(o(W).document_status)?(i(),s(V,{key:1,onClick:ee,type:"submit",variant:"warning",class:"btn-label waves-effect waves-light right me-1",disabled:o(W).processing},{default:l((()=>[c("i",{class:_(["label-icon align-middle fs-16 ms-2",o(W).processing?"ri-refresh-line":"ri-check-line"])},null,2),m(" "+u(o(W).processing?"Validating":"Validate"),1)])),_:1},8,["disabled"])):f("",!0),o(W).id&&["published","closed","cancelled"].includes(o(W).document_status)?f("",!0):(i(),s(V,{key:2,onClick:a[3]||(a[3]=e=>Z("draft")),type:"submit",variant:"light",class:"btn-label waves-effect waves-light right",disabled:o(W).processing},{default:l((()=>[c("i",{class:_(["label-icon align-middle fs-16 ms-2",o(W).processing?"ri-refresh-line":"ri-save-2-line"])},null,2),m(" "+u(o(W).processing?"Processing":"Save as Draft"),1)])),_:1},8,["disabled"])),"closed"==o(W).document_status?(i(),s(V,{key:3,onClick:a[4]||(a[4]=e=>Z("void")),type:"submit",variant:"danger",class:"btn-label waves-effect waves-light right",disabled:o(W).processing},{default:l((()=>[c("i",{class:_(["label-icon align-middle fs-16 ms-2",o(W).processing?"ri-refresh-line":"ri-close-line"])},null,2),m(" "+u(o(W).processing?"Processing":"Void"),1)])),_:1},8,["disabled"])):f("",!0)]),n(o(h),{href:e.route(`${o(N).module}.${o(N).name}.index`),class:"btn btn-info me-1"},{default:l((()=>[K,m(" Back ")])),_:1},8,["href"])])],512)])])),_:1})}}};export{O as default};