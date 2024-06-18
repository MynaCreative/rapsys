import{o as a,c as e,t as s,C as l,T as t,x as d,D as i,w as c,a as o,u as r,Z as n,b as m,e as p,i as u,E as v,q as b,F as f,d as g,G as h,H as x,I as w}from"./app-DSTM3SJ3.js";import{_}from"./Main-B6b0oP4E.js";import{_ as y}from"./PageHeader-BsnaedmG.js";import{_ as k}from"./Timestamp-CtxzEmuD.js";import{e as D}from"./entity-Dbtd7mEM.js";import"./sweetalert2.all-BaCSOYxu.js";import"./logo-light-fEv4Yehr.js";import"./_plugin-vue_export-helper-BCo6x5W8.js";import"./Footer-Dv8wUYbi.js";const j={key:0},T={key:1},C={__name:"Date",props:{data:{required:!0}},setup:l=>(t,d)=>l.data?(a(),e("span",j,s(t.$dayjs(l.data).format("DD MMM, YYYY")),1)):(a(),e("span",T," -- "))},I=D().page,M={async showData(a,e){const{data:s}=await l.get(route(`${I.name}.show`,e));Object.keys(s).forEach((e=>{a[e]=s[e]}))},submitData(a,e,s){let l=route(`${I.name}.update`,a.id);a.submit("patch",l,{onSuccess:()=>{a.reset(),a.clearErrors()}})}},S={class:"row"},Y={class:"col-lg-12"},A={class:"tab-content text-muted"},F={class:"tab-pane fade show active",id:"project-overview",role:"tabpanel"},z={class:"row"},E={class:"col-xl-8 col-lg-8"},P={class:"card"},$={class:"card-body"},L={class:"text-muted"},U={class:"pt-3 border-top border-top-dashed mt-4"},V={class:"row"},B={class:"col-lg-3 col-sm-6 mb-4"},G=m("p",{class:"mb-2 text-uppercase fw-medium"},"Created Date",-1),H={class:"fs-15 mb-0"},q={class:"col-lg-3 col-sm-6 mb-4"},N=m("p",{class:"mb-2 text-uppercase fw-medium"},"Updated Date",-1),O={class:"fs-15 mb-0"},R={class:"col-lg-3 col-sm-6 mb-4"},J=m("p",{class:"mb-2 text-uppercase fw-medium"},"Invoice Date",-1),Q={class:"fs-15 mb-0"},Z={class:"col-lg-3 col-sm-6 mb-4"},K=m("p",{class:"mb-2 text-uppercase fw-medium"},"Posting Date",-1),W={class:"fs-15 mb-0"},X={class:"col-lg-3 col-sm-6 mb-4"},aa=m("p",{class:"mb-2 text-uppercase fw-medium"},"Term Date",-1),ea={class:"fs-15 mb-0"},sa={class:"col-lg-3 col-sm-6 mb-4"},la=m("p",{class:"mb-2 text-uppercase fw-medium"},"Due Date",-1),ta={class:"fs-15 mb-0"},da={class:"col-lg-3 col-sm-6 mb-4"},ia=m("p",{class:"mb-2 text-uppercase fw-medium"},"Supplier Inv Date",-1),ca={class:"fs-15 mb-0"},oa={class:"col-lg-3 col-sm-6 mb-4"},ra=m("p",{class:"mb-2 text-uppercase fw-medium"},"Receipt Date",-1),na={class:"fs-15 mb-0"},ma={class:"col-lg-3 col-sm-6 mb-4"},pa=m("p",{class:"mb-2 text-uppercase fw-medium"},"Term",-1),ua={class:"badge text-bg-warning fs-12"},va={class:"col-lg-3 col-sm-6 mb-4"},ba=m("p",{class:"mb-2 text-uppercase fw-medium"},"Invoice Type",-1),fa={class:"badge text-bg-info fs-12"},ga={class:"col-lg-3 col-sm-6 mb-4"},ha=m("p",{class:"mb-2 text-uppercase fw-medium"},"Currency",-1),xa={class:"badge text-bg-secondary fs-12"},wa=m("h6",{class:"mb-3 fw-semibold text-uppercase"},"Note",-1),_a={class:"pt-3 border-top border-top-dashed mt-4"},ya=m("h6",{class:"mb-3 fw-semibold text-uppercase"},"Attachments",-1),ka={class:"row g-3"},Da={class:"border rounded border-dashed p-2"},ja={class:"d-flex align-items-center"},Ta={class:"flex-shrink-0 me-3"},Ca={key:0,class:"avatar-title bg-light rounded fs-24 shadow shadow",style:{color:"#bf2718"}},Ia=[m("i",{class:"ri-file-text-line"},null,-1)],Ma={key:1,class:"avatar-title bg-light text-primary rounded fs-24 shadow shadow"},Sa=[m("i",{class:"ri-file-word-line"},null,-1)],Ya={key:2,class:"avatar-title bg-light text-success rounded fs-24 shadow shadow"},Aa=[m("i",{class:"ri-file-excel-line"},null,-1)],Fa={key:3,class:"avatar-title bg-light text-warning rounded fs-24 shadow shadow"},za=[m("i",{class:"ri-image-line"},null,-1)],Ea={key:4,class:"avatar-title bg-light rounded fs-24 shadow shadow",style:{color:"#3a3ca1"}},Pa=[m("i",{class:"ri-file-zip-line"},null,-1)],$a={class:"flex-grow-1 overflow-hidden"},La={class:"fs-13 mb-1"},Ua=["href"],Va={class:"flex-shrink-0 ms-2"},Ba={class:"d-flex gap-1"},Ga=["href"],Ha=[m("i",{class:"ri-download-2-line"},null,-1)],qa={class:"card"},Na=m("div",{class:"card-header align-items-center d-flex"},[m("h4",{class:"card-title mb-0 flex-grow-1"},"Approver Action")],-1),Oa={class:"card-body"},Ra={class:"row g-3"},Ja={class:"col-12"},Qa=m("label",{for:"exampleFormControlTextarea1",class:"form-label text-body"},"Note",-1),Za={class:"col-12 text-end"},Ka={class:"col-xl-4 col-lg-4"},Wa={class:"card"},Xa={class:"card-body p-4"},ae={class:"mt-4 text-center"},ee={class:"mb-1"},se={class:"text-muted"},le={class:"table-responsive"},te={class:"table mb-0 table-borderless"},de=m("th",null,[m("span",{class:"fw-medium"},"SBU")],-1),ie=m("th",null,[m("span",{class:"fw-medium"},"Interco")],-1),ce=m("th",null,[m("span",{class:"fw-medium"},"Vendor")],-1),oe=m("th",null,[m("span",{class:"fw-medium"},"Vendor Site")],-1),re=m("th",null,[m("span",{class:"fw-medium"},"Invoice Type")],-1),ne=m("th",null,[m("span",{class:"fw-medium"},"Currency")],-1),me=m("th",null,[m("span",{class:"fw-medium"},"Supplier Tax Inv")],-1),pe={class:"card-body p-4 border-top border-top-dashed"},ue=m("h6",{class:"text-muted text-uppercase fw-semibold mb-4"},"Amount After Tax",-1),ve={class:"table-responsive"},be={class:"table mb-0 table-borderless"},fe=m("th",null,[m("span",{class:"fw-medium"},"Total")],-1),ge={class:"text-end"},he=m("th",null,[m("span",{class:"fw-medium"},"Total Valid")],-1),xe={class:"text-end"},we=m("th",null,[m("span",{class:"fw-medium"},"Total Invalid")],-1),_e={class:"text-end"},ye=m("div",{class:"card"},[m("div",{class:"card-body"},[m("h5",{class:"card-title mb-4"},"Expenses"),m("div",{class:"d-flex flex-wrap gap-2 fs-16"},[m("div",{class:"badge fw-medium badge-soft-secondary"},"SMU")])])],-1),ke={class:"card"},De=m("div",{class:"card-header align-items-center d-flex border-bottom-dashed"},[m("h4",{class:"card-title mb-0 flex-grow-1"},"Approvers")],-1),je={class:"card-body"},Te={"data-simplebar":"",style:{height:"150px"},class:"mx-n3 px-3"},Ce={class:"vstack gap-3"},Ie={class:"avatar-xs flex-shrink-0 me-3"},Me=["src"],Se={class:"flex-grow-1"},Ye={class:"fs-13 mb-0"},Ae={href:"#",class:"text-body d-block"},Fe={__name:"Form",props:["references","model"],setup(l){const j=D().page,T=w().appContext.config.globalProperties.$dayjs,I=[{text:"Dashboard",to:route("dashboard")},{text:j.title,active:!0}],Fe=l,ze=t(Fe.model?{...Fe.model}:D().form);d((()=>{if(!ze.id){let a=T().format("YYYY-MM-DD");ze.invoice_date=a,ze.posting_date=a,ze.term_date=a,ze.due_date=a,ze.invoice_receipt_date=a,ze.supplier_tax_invoice_date=a}}));const Ee=()=>{M.submitData(ze,ze.id)},Pe=a=>a.url?"/"+a.url+"/"+a.storage:"javascript:void(0)";return(l,t)=>(a(),i(_,null,{header:c((()=>[o(y,{title:r(j).title,breadcrumbs:I},null,8,["title"])])),default:c((()=>[o(r(n),{title:r(j).title},null,8,["title"]),m("div",S,[m("div",Y,[m("div",A,[m("div",F,[m("div",z,[m("div",E,[m("div",P,[m("div",$,[m("div",L,[m("div",U,[m("div",V,[m("div",B,[m("div",null,[G,m("h5",H,[o(k,{data:r(ze).created_at},null,8,["data"])])])]),m("div",q,[m("div",null,[N,m("h5",O,[o(k,{data:r(ze).updated_at},null,8,["data"])])])]),m("div",R,[m("div",null,[J,m("h5",Q,[o(C,{data:r(ze).invoice_date},null,8,["data"])])])]),m("div",Z,[m("div",null,[K,m("h5",W,[o(C,{data:r(ze).posting_date},null,8,["data"])])])]),m("div",X,[m("div",null,[aa,m("h5",ea,[o(C,{data:r(ze).term_date},null,8,["data"])])])]),m("div",sa,[m("div",null,[la,m("h5",ta,[o(C,{data:r(ze).due_date},null,8,["data"])])])]),m("div",da,[m("div",null,[ia,m("h5",ca,[o(C,{data:r(ze).supplier_tax_invoice_date},null,8,["data"])])])]),m("div",oa,[m("div",null,[ra,m("h5",na,[o(C,{data:r(ze).invoice_receipt_date},null,8,["data"])])])]),m("div",ma,[m("div",null,[pa,m("div",ua,s(r(ze).term?.name),1)])]),m("div",va,[m("div",null,[ba,m("div",fa,s(r(ze).invoice_type?.name),1)])]),m("div",ga,[m("div",null,[ha,m("div",xa,s(r(ze).currency?.name),1)])])])]),wa,m("p",null,s(r(ze).note),1),m("div",null,[o(r(u),{href:l.route("transaction.invoices.edit",r(ze).id),class:"btn btn-link link-success p-0 shadow-none"},{default:c((()=>[p("Detail Invoice")])),_:1},8,["href"])]),m("div",_a,[ya,m("div",ka,[(a(!0),e(f,null,v(r(ze).attachments,((l,t)=>{return a(),e("div",{class:"col-xxl-4 col-lg-6",key:t},[m("div",Da,[m("div",ja,[m("div",Ta,["application/pdf"==l.type?(a(),e("div",Ca,Ia)):b("",!0),"application/vnd.openxmlformats-officedocument.wordprocessingml.document"==l.type?(a(),e("div",Ma,Sa)):b("",!0),"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"==l.type?(a(),e("div",Ya,Aa)):b("",!0),["image/jpg","image/jpeg","image/png"].includes(l.type)?(a(),e("div",Fa,za)):b("",!0),["application/zip","application/x-zip-compressed","multipart/x-zip","application/vnd.rar","application/x-rar-compressed",""].includes(l.type)?(a(),e("div",Ea,Pa)):b("",!0)]),m("div",$a,[m("h5",La,[m("a",{href:Pe(l),target:"_blank",class:"text-body text-truncate d-block"},s(l.name),9,Ua)]),m("div",null,s((d=l.size,(i=Math,c=i.log,o=c(d)/c(1e3)|0,d/i.pow(1e3,o)).toFixed(2)+" "+(o?"kMGTPEZY"[--o]+"B":"Bytes"))),1)]),m("div",Va,[m("div",Ba,[r(ze).id?(a(),e("a",{key:0,class:"btn btn-icon text-muted btn-sm fs-18 shadow-none",href:Pe(l),target:"_blank"},Ha,8,Ga)):b("",!0)])])])])]);var d,i,c,o})),128))])])])])]),m("div",qa,[Na,m("div",Oa,[m("form",{onSubmit:g(Ee,["prevent"]),class:"mt-4"},[m("div",Ra,[m("div",Ja,[Qa,h(m("textarea",{class:"form-control bg-light border-light",id:"exampleFormControlTextarea1",rows:"3","onUpdate:modelValue":t[0]||(t[0]=a=>r(ze).approval_note=a)},null,512),[[x,r(ze).approval_note]])]),m("div",Za,[m("button",{type:"submit",onClick:t[1]||(t[1]=a=>r(ze).approval_status="rejected"),class:"btn btn-danger mx-2"},"Reject"),m("button",{type:"submit",onClick:t[2]||(t[2]=a=>r(ze).approval_status="approved"),class:"btn btn-success"},"Approve")])])],32)])])]),m("div",Ka,[m("div",Wa,[m("div",Xa,[m("div",ae,[m("h5",ee,s(r(ze).code),1),m("p",se,s(r(ze).department?.name),1)]),m("div",le,[m("table",te,[m("tbody",null,[m("tr",null,[de,m("td",null,s(r(ze).sbu?.name),1)]),m("tr",null,[ie,m("td",null,s(r(ze).interco?.name),1)]),m("tr",null,[ce,m("td",null,s(r(ze).vendor?.name),1)]),m("tr",null,[oe,m("td",null,s(r(ze).vendor_site?.name),1)]),m("tr",null,[re,m("td",null,s(r(ze).invoice_type?.name),1)]),m("tr",null,[ne,m("td",null,s(r(ze).currency?.name),1)]),m("tr",null,[me,m("td",null,s(r(ze).supplier_tax_invoice),1)])])])])]),m("div",pe,[ue,m("div",ve,[m("table",be,[m("tbody",null,[m("tr",null,[fe,m("td",ge,s(r(ze).total_amount_after_tax.toLocaleString()),1)]),m("tr",null,[he,m("td",xe,s(r(ze).total_amount_valid.toLocaleString()),1)]),m("tr",null,[we,m("td",_e,s(r(ze).total_amount_invalid.toLocaleString()),1)])])])])])]),ye,m("div",ke,[De,m("div",je,[m("div",Te,[m("div",Ce,[(a(!0),e(f,null,v(r(ze).approvals,(l=>(a(),e("div",{class:"d-flex align-items-center",key:l.id},[m("div",Ie,[m("img",{src:`/img/initials/${l.user?.name.charAt(0).toLowerCase()}.png`,class:"img-fluid rounded-circle shadow"},null,8,Me)]),m("div",Se,[m("h5",Ye,[m("a",Ae,s(l.user?.name),1)])])])))),128))])])])])])])])])])])])),_:1}))}};export{Fe as default};
