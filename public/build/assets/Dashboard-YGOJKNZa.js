import{_ as s,a}from"./Main-B6b0oP4E.js";import{U as l,A as e,C as t,E as i}from"./vue-feather-icons.es-0PqJZq1H.js";import{o as r,c as d,a as c,u as n,Z as o,w as m,b as u,e as f,F as v}from"./app-DSTM3SJ3.js";import{C as p}from"./vue3-count-to.esm-BGD6ZuNU.js";import b from"./InvoiceUser-B4DdV2eQ.js";import g from"./InvoiceVendor-CfDpBTNk.js";import x from"./InvoiceDepartment-Buz2gtA9.js";import h from"./Approval-BUhusgvn.js";import w from"./DocumentStatus-CW_MZmMV.js";import y from"./Staging-D8Y_j2Yz.js";import"./logo-light-fEv4Yehr.js";import"./sweetalert2.all-BaCSOYxu.js";import"./_plugin-vue_export-helper-BCo6x5W8.js";import"./Footer-Dv8wUYbi.js";import"./service-B6pP6wM8.js";const j={class:"row dash-nft"},V={class:"col-xxl-12"},_={class:"row"},k=u("div",{class:"col-xl-4"},[u("div",{class:"card overflow-hidden"},[u("div",{class:"card-body bg-InvoiceValidationDistribution d-flex"},[u("div",{class:"flex-grow-1"},[u("h4",{class:"fs-18 lh-base fw-bold mb-0"},[f("RPX AP Invoice System "),u("span",{class:"text-primary"},"RAPsys.")]),u("p",{class:"mb-0 mt-2 pt-1 text-muted"},"If you are just starting out, please learn the link below."),u("div",{class:"d-flex gap-3 mt-4"},[u("a",{href:"/storage/user-manuals/user-manual.pdf",target:"_blank",class:"btn btn-success btn-label rounded-pill waves-effect waves-light"},[u("i",{class:"ri-book-open-line label-icon align-middle rounded-pill fs-16 me-2"}),f(" User Manual ")])])]),u("img",{src:a,alt:"",class:"img-fluid",style:{width:"15%",height:"15%"}})])])],-1),I={class:"col-xl-2 col-md-6"},D={class:"card card-height-100"},A={class:"card-body"},C={class:"d-flex justify-content-between"},U=u("p",{class:"fw-medium text-muted mb-0"},"Users",-1),M={class:"mt-4 ff-secondary fw-semibold"},P=u("p",{class:"mb-0 text-muted"}," Count all users ",-1),R={class:"avatar-sm flex-shrink-0"},S={class:"avatar-title bg-primary rounded-circle fs-2"},F={class:"col-xl-2 col-md-6"},G={class:"card card-height-100"},L={class:"card-body"},E={class:"d-flex justify-content-between"},H=u("p",{class:"fw-medium text-muted mb-0"},"Online",-1),J={class:"mt-4 ff-secondary fw-semibold"},K=u("p",{class:"mb-0 text-muted"}," Count online users ",-1),N={class:"avatar-sm flex-shrink-0"},O={class:"avatar-title bg-danger rounded-circle fs-2"},X={class:"col-xl-2 col-md-6"},q={class:"card card-height-100"},z={class:"card-body"},B={class:"d-flex justify-content-between"},Q=u("p",{class:"fw-medium text-muted mb-0"},"AVG Duration",-1),T={class:"mt-4 ff-secondary fw-semibold"},W=u("p",{class:"mb-0 text-muted"},[u("span",{class:"badge bg-soft-primary text-primary mb-0 me-1"},[u("i",{class:"ri-arrow-left-right-line align-middle"}),f(" 0 % ")]),f(" vs. prev month ")],-1),Y={class:"avatar-sm flex-shrink-0"},Z={class:"avatar-title bg-warning rounded-circle fs-2"},$={class:"col-xl-2 col-md-6"},ss={class:"card card-height-100"},as={class:"card-body"},ls={class:"d-flex justify-content-between"},es=u("p",{class:"fw-medium text-muted mb-0"},"Login Rate",-1),ts={class:"mt-4 ff-secondary fw-semibold"},is=u("p",{class:"mb-0 text-muted"},[u("span",{class:"badge bg-soft-primary text-primary mb-0 me-1"},[u("i",{class:"ri-arrow-left-right-line align-middle"}),f(" 0 % ")]),f(" vs. prev month ")],-1),rs={class:"avatar-sm flex-shrink-0"},ds={class:"avatar-title bg-success rounded-circle fs-2"},cs={class:"col-xl-4 mb-4"},ns={class:"col-xl-4 mb-4"},os={class:"col-xl-4 mb-4"},ms={class:"col-xl-4 mb-4"},us={class:"col-xl-4 mb-4"},fs={class:"col-xl-4 mb-4"},vs={__name:"Dashboard",props:["references"],setup:a=>(vs,ps)=>(r(),d(v,null,[c(n(o),{title:"Dashboard"}),c(s,null,{default:m((()=>[u("div",j,[u("div",V,[u("div",_,[k,u("div",I,[u("div",D,[u("div",A,[u("div",C,[u("div",null,[U,u("h2",M,[c(n(p),{startVal:0,endVal:a.references.total_user,duration:5e3},null,8,["endVal"])]),P]),u("div",null,[u("div",R,[u("span",S,[c(n(l))])])])])])])]),u("div",F,[u("div",G,[u("div",L,[u("div",E,[u("div",null,[H,u("h2",J,[c(n(p),{startVal:0,endVal:a.references.online.length,duration:5e3},null,8,["endVal"])]),K]),u("div",null,[u("div",N,[u("span",O,[c(n(e),{name:"activity"})])])])])])])]),u("div",X,[u("div",q,[u("div",z,[u("div",B,[u("div",null,[Q,u("h2",T,[c(n(p),{startVal:0,endVal:a.references.login_duration.minute,duration:3e3},null,8,["endVal"]),f("m "),c(n(p),{startVal:0,endVal:a.references.login_duration.second,duration:3e3},null,8,["endVal"]),f("sec ")]),W]),u("div",null,[u("div",Y,[u("span",Z,[c(n(t),{name:"clock"})])])])])])])]),u("div",$,[u("div",ss,[u("div",as,[u("div",ls,[u("div",null,[es,u("h2",ts,[c(n(p),{startVal:0,endVal:a.references.total_login,duration:5e3},null,8,["endVal"])]),is]),u("div",null,[u("div",rs,[u("span",ds,[c(n(i))])])])])])])]),u("div",cs,[c(h)]),u("div",ns,[c(w)]),u("div",os,[c(y)]),u("div",ms,[c(g)]),u("div",us,[c(x)]),u("div",fs,[c(b)])])])])])),_:1})],64))};export{vs as default};
