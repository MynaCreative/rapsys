import{r as s,T as e,c as a,a as o,u as r,b as l,w as t,d as i,n,e as d,F as p,f as c,J as m,g as u,o as w,Z as f,i as v,p as b,h as g}from"./app-30e0783b.js";import{_ as h}from"./logo-light-68509ea3.js";import{F as x}from"./Footer-61ce5cc7.js";import{_}from"./_plugin-vue_export-helper-1b428a4d.js";const k=s=>(b("data-v-bf5706a2"),s=s(),g(),s),y={class:"auth-page-wrapper pt-5"},V=k((()=>l("div",{class:"auth-one-bg-position auth-one-bg",id:"auth-particles"},[l("div",{class:"bg-overlay"}),l("div",{class:"shape"},[l("svg",{xmlns:"http://www.w3.org/2000/svg",version:"1.1","xmlns:xlink":"http://www.w3.org/1999/xlink",viewBox:"0 0 1440 120"},[l("path",{d:"M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"})])])],-1))),L={class:"auth-page-content"},C={class:"container"},M={class:"row"},H={class:"col-lg-12"},P={class:"text-center mt-sm-5 mb-4 text-white-50"},T=k((()=>l("img",{src:h,alt:"RAPsys"},null,-1))),j={class:"row justify-content-center"},E={class:"col-md-8 col-lg-6 col-xl-5"},F={class:"card mt-4"},R={class:"card-body p-4"},S=k((()=>l("div",{class:"text-center mt-2"},[l("h5",{class:"text-primary"},"Create new password"),l("p",{class:"text-muted"},"Your new password must be different from previous used password.")],-1))),q={class:"p-2"},U=["onSubmit"],I={class:"mb-4"},z=k((()=>l("label",{for:"username",class:"form-label"},"Email",-1))),A={class:"mb-3"},B=k((()=>l("label",{class:"form-label",for:"password"},"Password",-1))),J={class:"position-relative auth-pass-inputgroup mb-3"},W=k((()=>l("i",{class:"ri-eye-fill align-middle"},null,-1))),Y={class:"mb-3"},D=k((()=>l("label",{class:"form-label",for:"password_confirmation"},"Confirm Password",-1))),G={class:"position-relative auth-pass-inputgroup mb-3"},K=k((()=>l("i",{class:"ri-eye-fill align-middle"},null,-1))),N={class:"text-center mt-4"},O={class:"mt-4 text-center"},Q={class:"mb-0"},X=_({__name:"ResetPassword",props:{email:String,token:String},setup(b){const g=b;let h=s("password"),_=s("password");const k=e({token:g.token,email:g.email,password:"",password_confirmation:""}),X=()=>{k.post(route("password.update"),{onFinish:()=>k.reset("password","password_confirmation")})},Z=(s=null)=>{"confirmation"==s?_.value="password"===_.value?"text":"password":h.value="password"===h.value?"text":"password"};return(s,e)=>{const b=c,g=m,$=u;return w(),a(p,null,[o(r(f),{title:"Reset Password"}),l("div",y,[V,l("div",L,[l("div",C,[l("div",M,[l("div",H,[l("div",P,[o(r(v),{href:"/",class:"d-inline-block auth-logo"},{default:t((()=>[T])),_:1})])])]),l("div",j,[l("div",E,[l("div",F,[l("div",R,[S,l("div",q,[l("form",{onSubmit:i(X,["prevent"])},[l("div",I,[z,o(b,{id:"username",modelValue:r(k).email,"onUpdate:modelValue":e[0]||(e[0]=s=>r(k).email=s),class:n({"is-invalid":r(k).errors.email}),"aria-describedby":"input-username-feedback",placeholder:"Enter email",autocomplete:"username",required:"",autofocus:"",trim:"",disabled:""},null,8,["modelValue","class"]),o(g,{id:"input-username-feedback",innerHTML:r(k).errors.email},null,8,["innerHTML"])]),l("div",A,[B,l("div",J,[o(b,{id:"password",modelValue:r(k).password,"onUpdate:modelValue":e[1]||(e[1]=s=>r(k).password=s),class:n(["pe-5",{"is-invalid":r(k).errors.password}]),"aria-describedby":"input-password-feedback",placeholder:"Enter new password",type:r(h),autocomplete:"new-password",required:""},null,8,["modelValue","class","type"]),o($,{onClick:Z,variant:"link",class:"position-absolute end-0 top-0 text-decoration-none text-muted"},{default:t((()=>[W])),_:1}),o(g,{id:"input-password-feedback",innerHTML:r(k).errors.password},null,8,["innerHTML"])])]),l("div",Y,[D,l("div",G,[o(b,{id:"password_confirmation",modelValue:r(k).password_confirmation,"onUpdate:modelValue":e[2]||(e[2]=s=>r(k).password_confirmation=s),class:n(["pe-5",{"is-invalid":r(k).errors.password_confirmation}]),"aria-describedby":"input-password-confirmation-feedback",placeholder:"Enter confirm password",type:r(_),autocomplete:"new-password",required:""},null,8,["modelValue","class","type"]),o($,{onClick:e[3]||(e[3]=s=>Z("confirmation")),variant:"link",class:"position-absolute end-0 top-0 text-decoration-none text-muted"},{default:t((()=>[K])),_:1}),o(g,{id:"input-password-confirmation-feedback",innerHTML:r(k).errors.password_confirmation},null,8,["innerHTML"])])]),l("div",N,[o($,{class:"w-100",variant:"success",type:"submit",disabled:r(k).processing},{default:t((()=>[d("Reset Password")])),_:1},8,["disabled"])])],40,U)])])]),l("div",O,[l("p",Q,[d(" Wait, I remember my password... "),o(r(v),{href:s.route("login"),class:"fw-semibold text-primary text-decoration-underline"},{default:t((()=>[d("Click here")])),_:1},8,["href"])])])])])])]),o(x)])],64)}}},[["__scopeId","data-v-bf5706a2"]]);export{X as default};
