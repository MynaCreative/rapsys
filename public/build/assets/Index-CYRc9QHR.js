import{r as s,T as a,o as e,D as r,w as l,a as o,u as t,Z as i,b as d,t as n,c,e as u,F as p,E as m,n as b,q as f,d as w,K as v,A as g,g as h,J as _}from"./app-DSTM3SJ3.js";import{a as y}from"./vue-feather-icons.es-0PqJZq1H.js";import{_ as x}from"./Main-B6b0oP4E.js";import{_ as k}from"./PageHeader-BsnaedmG.js";import{_ as P}from"./Timestamp-CtxzEmuD.js";import"./logo-light-fEv4Yehr.js";import"./sweetalert2.all-BaCSOYxu.js";import"./_plugin-vue_export-helper-BCo6x5W8.js";import"./Footer-Dv8wUYbi.js";const j={class:"row"},H={class:"col-xxl-3"},L={class:"card"},V={class:"card-body p-4"},$={class:"text-center"},M={class:"profile-user position-relative d-inline-block mx-auto mb-4"},T=["src"],C={class:"fs-16 mb-1"},F={class:"text-muted mb-1"},S={class:"text-muted mb-0"},A={class:"card shadow-none"},E={class:"card-body bg-soft-info rounded"},I={class:"d-flex"},D={class:"flex-shrink-0"},U={class:"flex-grow-1 ms-3"},Y={class:"fs-15"},J={class:"text-muted mb-0"},K={class:"col-xxl-9"},q={class:"card"},G=d("div",{class:"card-header"},[d("ul",{class:"nav nav-tabs-custom rounded card-header-tabs border-bottom-0",role:"tablist"},[d("li",{class:"nav-item"},[d("a",{class:"nav-link active","data-bs-toggle":"tab",href:"#loginHistories",role:"tab"},[d("i",{class:"fas fa-home"}),u(" Login History ")])]),d("li",{class:"nav-item"},[d("a",{class:"nav-link","data-bs-toggle":"tab",href:"#changePassword",role:"tab"},[d("i",{class:"far fa-user"}),u(" Change Password ")])])])],-1),N={class:"card-body p-4"},O={class:"tab-content"},z={class:"tab-pane active",id:"loginHistories",role:"tabpanel"},B=d("div",{class:"mb-3 border-bottom pb-2"},[d("h5",{class:"card-title"},"Last 10 authentications")],-1),Q={class:"flex-shrink-0 avatar-sm"},R=["title"],W={key:0,class:"ri-smartphone-line"},X={key:1,class:"ri-tablet-line"},Z={key:2,class:"ri-macbook-line"},ss={class:"flex-grow-1 ms-3"},as={class:"text-muted mb-0"},es={class:"text-muted"},rs={class:"tab-pane",id:"changePassword",role:"tabpanel"},ls={class:"row g-2"},os={class:"col-lg-4"},ts=d("label",{for:"current_password",class:"form-label"},"Current Password*",-1),is={class:"col-lg-4"},ds=d("label",{for:"password",class:"form-label"},"New Password*",-1),ns={class:"col-lg-4"},cs=d("label",{for:"password_confirmation",class:"form-label"},"Confirm Password*",-1),us={class:"col-lg-12"},ps={class:"text-end"},ms=["disabled"],bs={__name:"Index",props:["authentications"],setup(bs){const fs={module:"general",name:"Profile",title:"Profile"},ws=[{text:"Dashboard",to:route("dashboard")},{text:fs.title,active:!0}],vs=s=>{if(s)return s.join(", ")},gs=s(null),hs=s(null),_s=a({current_password:"",password:"",password_confirmation:""}),ys=()=>{_s.put(route("password.update"),{preserveScroll:!0,onSuccess:()=>_s.reset(),onError:()=>{_s.errors.password&&(_s.reset("password","password_confirmation"),gs.value.focus()),_s.errors.current_password&&(_s.reset("current_password"),hs.value.focus())}})};return(s,a)=>{const xs=g,ks=h,Ps=_;return e(),r(x,null,{header:l((()=>[o(k,{title:t(fs).title,breadcrumbs:ws},null,8,["title"])])),default:l((()=>{return[o(t(i),{title:t(fs).title},null,8,["title"]),d("div",j,[d("div",H,[d("div",L,[d("div",V,[d("div",$,[d("div",M,[d("img",{src:`/img/initials/${s.$page.props.auth.user.name.charAt(0).toLowerCase()}.png`,class:"rounded-circle avatar-xl img-thumbnail user-profile-image shadow",alt:"user-profile-image"},null,8,T)]),d("h5",C,n(s.$page.props.auth.user.name),1),d("p",F,n(s.$page.props.auth.user.email),1),d("p",S,n(s.$page.props.auth.department.name),1)])])]),d("div",A,[d("div",E,[d("div",I,[d("div",D,[o(t(y),{class:"text-info icon-dual-info"})]),d("div",U,[d("h6",Y,"Your role is "+n((r=s.$page.props.auth.user.roles,r.map((s=>s.name)).join(", "))),1),d("p",J,[s.$page.props.auth.roles.includes("Administrator")?(e(),c(p,{key:0},[u("You have ability to access all")],64)):(e(),c(p,{key:1},[u("You have ability to access : "+n(vs(s.$page.props.auth.permissions)),1)],64))])])])])])]),d("div",K,[d("div",q,[G,d("div",N,[d("div",O,[d("div",z,[B,(e(!0),c(p,null,m(bs.authentications,(s=>(e(),c("div",{class:"d-flex align-items-center mb-3",key:s.id},[d("div",Q,[d("div",{class:b(["avatar-title rounded-3 fs-18 shadow bg-light",{"text-primary":s.login_successful,"text-danger":!s.login_successful}]),title:`${s.login_successful?"Login Success":"Login Failed"} : ${s.user_agent.userAgent}`},[s.user_agent.isMobile?(e(),c("i",W)):f("",!0),s.user_agent.isTablet?(e(),c("i",X)):f("",!0),s.user_agent.isDesktop?(e(),c("i",Z)):f("",!0)],10,R)]),d("div",ss,[d("h6",null,n(s.user_agent.platformFamily)+" - "+n(s.user_agent.browserFamily),1),d("p",as,n(s.location.city)+", "+n(s.location.country)+" - "+n(s.ip_address),1)]),d("div",es,[o(P,{data:s.login_at},null,8,["data"]),u(),s.logout_at?(e(),c(p,{key:0},[u("- "),o(P,{data:s.logout_at},null,8,["data"])],64)):f("",!0)])])))),128))]),d("div",rs,[d("form",{onSubmit:w(ys,["prevent"])},[d("div",ls,[o(v,{"enter-from-class":"opacity-0","leave-to-class":"opacity-0",class:"transition ease-in-out"},{default:l((()=>[o(xs,{modelValue:t(_s).recentlySuccessful,variant:"success"},{default:l((()=>[u("Password has been changed")])),_:1},8,["modelValue"])])),_:1}),d("div",os,[d("div",null,[ts,o(ks,{type:"password",id:"current_password",ref_key:"currentPasswordInput",ref:hs,modelValue:t(_s).current_password,"onUpdate:modelValue":a[0]||(a[0]=s=>t(_s).current_password=s),class:b({"is-invalid":t(_s).errors.current_password}),"aria-describedby":"input-current_password-feedback",placeholder:"Enter current password",autocomplete:"current-password",autofocus:""},null,8,["modelValue","class"]),o(Ps,{id:"input-current_password-feedback",innerHTML:t(_s).errors.current_password},null,8,["innerHTML"])])]),d("div",is,[d("div",null,[ds,o(ks,{type:"password",id:"password",ref_key:"passwordInput",ref:gs,modelValue:t(_s).password,"onUpdate:modelValue":a[1]||(a[1]=s=>t(_s).password=s),class:b({"is-invalid":t(_s).errors.password}),"aria-describedby":"input-password-feedback",placeholder:"Enter new password",autocomplete:"new-password"},null,8,["modelValue","class"]),o(Ps,{id:"input-password-feedback",innerHTML:t(_s).errors.password},null,8,["innerHTML"])])]),d("div",ns,[d("div",null,[cs,o(ks,{type:"password",id:"password_confirmation",modelValue:t(_s).password_confirmation,"onUpdate:modelValue":a[2]||(a[2]=s=>t(_s).password_confirmation=s),class:b({"is-invalid":t(_s).errors.password}),"aria-describedby":"input-password_confirmation-feedback",placeholder:"Confirm password",autocomplete:"new-password"},null,8,["modelValue","class"]),o(Ps,{id:"input-password_confirmation-feedback",innerHTML:t(_s).errors.password},null,8,["innerHTML"])])]),d("div",us,[d("div",ps,[d("button",{type:"submit",class:"btn btn-success",disabled:t(_s).processing}," Change Password ",8,ms)])])])],32)])])])])])])];var r})),_:1})}}};export{bs as default};
