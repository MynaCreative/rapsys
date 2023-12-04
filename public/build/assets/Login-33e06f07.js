import{r as e,T as s,c as a,a as r,u as t,b as l,w as o,d as i,n,m as d,e as c,F as u,A as p,f as m,J as v,g as w,q as b,o as g,Z as f,i as h,t as x,p as y,h as k}from"./app-30e0783b.js";import{_}from"./logo-light-68509ea3.js";import{F as V}from"./Footer-61ce5cc7.js";import{_ as L}from"./_plugin-vue_export-helper-1b428a4d.js";const S=e=>(y("data-v-f8e6a571"),e=e(),k(),e),R={class:"auth-page-wrapper pt-5"},j=S((()=>l("div",{class:"auth-one-bg-position auth-one-bg",id:"auth-particles"},[l("div",{class:"bg-overlay"}),l("div",{class:"shape"},[l("svg",{xmlns:"http://www.w3.org/2000/svg",version:"1.1","xmlns:xlink":"http://www.w3.org/1999/xlink",viewBox:"0 0 1440 120"},[l("path",{d:"M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"})])])],-1))),F={class:"auth-page-content"},M={class:"container"},P={class:"row"},q={class:"col-lg-12"},B={class:"text-center mt-sm-5 mb-4 text-white-50"},H=S((()=>l("img",{src:_,alt:"RAPsys"},null,-1))),T={class:"row justify-content-center"},U={class:"col-md-8 col-lg-6 col-xl-5"},A={class:"card mt-4"},C={class:"card-body p-4"},E=S((()=>l("div",{class:"text-center mt-2"},[l("h5",{class:"text-primary"},"Welcome Back!"),l("p",{class:"text-muted"},"Sign in to continue using RAPsys.")],-1))),I={class:"p-2 mt-4"},z=["onSubmit"],D={class:"mb-3"},J=S((()=>l("label",{for:"username",class:"form-label"},"Username",-1))),W={class:"mb-3"},G={key:0,class:"float-end"},K=S((()=>l("label",{class:"form-label",for:"password"},"Password",-1))),N={class:"position-relative auth-pass-inputgroup mb-3"},O=S((()=>l("i",{class:"ri-eye-fill align-middle"},null,-1))),Q={class:"mt-4"},X={key:0,class:"mt-4 text-center"},Y={class:"mb-0"},Z=L({__name:"Login",props:{canResetPassword:Boolean,canRegister:Boolean,laravelVersion:String,phpVersion:String,status:String},setup(y){let k=e("password");const _=s({username:"",password:"",remember:!1}),L=()=>{_.post(route("login"),{onFinish:()=>_.reset("password")})},S=()=>{k.value="password"===k.value?"text":"password"};return(e,s)=>{const Z=p,$=m,ee=v,se=w,ae=b;return g(),a(u,null,[r(t(f),{title:"Log in"}),l("div",R,[j,l("div",F,[l("div",M,[l("div",P,[l("div",q,[l("div",B,[r(t(h),{href:"/",class:"d-inline-block auth-logo"},{default:o((()=>[H])),_:1})])])]),l("div",T,[l("div",U,[l("div",A,[l("div",C,[E,l("div",I,[r(Z,{modelValue:!!y.status,variant:"warning",class:"mt-3",dismissible:""},{default:o((()=>[c(x(y.status),1)])),_:1},8,["modelValue"]),l("form",{onSubmit:i(L,["prevent"])},[l("div",D,[J,r($,{id:"username",modelValue:t(_).username,"onUpdate:modelValue":s[0]||(s[0]=e=>t(_).username=e),class:n({"is-invalid":t(_).errors.username}),"aria-describedby":"input-username-feedback",placeholder:"Enter email or username",autocomplete:"username",required:"",autofocus:"",trim:""},null,8,["modelValue","class"]),r(ee,{id:"input-username-feedback",innerHTML:t(_).errors.username},null,8,["innerHTML"])]),l("div",W,[y.canResetPassword?(g(),a("div",G,[r(t(h),{href:e.route("password.request"),class:"text-muted"},{default:o((()=>[c("Forgot password?")])),_:1},8,["href"])])):d("",!0),K,l("div",N,[r($,{id:"password",modelValue:t(_).password,"onUpdate:modelValue":s[1]||(s[1]=e=>t(_).password=e),class:n(["pe-5",{"is-invalid":t(_).errors.password}]),"aria-describedby":"input-password-feedback",placeholder:"Enter password",type:t(k),autocomplete:"current-password",required:""},null,8,["modelValue","class","type"]),r(se,{onClick:S,variant:"link",class:"position-absolute end-0 top-0 text-decoration-none text-muted"},{default:o((()=>[O])),_:1}),r(ee,{id:"input-password-feedback",innerHTML:t(_).errors.password},null,8,["innerHTML"])])]),r(ae,{checked:t(_).remember,"onUpdate:checked":s[2]||(s[2]=e=>t(_).remember=e)},{default:o((()=>[c("Remember me")])),_:1},8,["checked"]),l("div",Q,[r(se,{class:"w-100",variant:"primary",type:"submit",disabled:t(_).processing},{default:o((()=>[c("Sign In")])),_:1},8,["disabled"])])],40,z)])])]),y.canRegister?(g(),a("div",X,[l("p",Y,[c(" Don't have an account ? "),r(t(h),{href:e.route("register"),class:"fw-semibold text-primary text-decoration-underline"},{default:o((()=>[c("Signup")])),_:1},8,["href"])])])):d("",!0)])])])]),r(V)])],64)}}},[["__scopeId","data-v-f8e6a571"]]);export{Z as default};
