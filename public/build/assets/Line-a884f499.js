import e from"./Manual-7c28aa73.js";import a from"./Upload-6ea79b15.js";import s from"./UploadModal-c845f73c.js";import{s as t,r as l,c as n,b as o,F as r,G as i,u as p,e as m,m as c,a as d,o as u,n as f,t as v,D as b}from"./app-4fa61095.js";import"./ManualCreate-6b7cd011.js";import"./Modal-6f5881bc.js";import"./ManualForm-10a3424e.js";import"./v-money3-b3e6ec75.js";import"./multiselect-15ad7a83.js";import"./ManualItem-276e414c.js";import"./ManualUpdate-f22525d7.js";import"./UploadItem-13354433.js";import"./SmuPreview-68ba1fa1.js";import"./sumBy-c2d1d6a2.js";import"./_baseIteratee-a336095c.js";import"./service-21b81677.js";import"./sweetalert2.all-47788bf1.js";import"./UploadForm-6466749c.js";const x={class:"nav nav-tabs nav-tabs-custom nav-success",id:"nav-tab",role:"tablist"},j=["id","title","href","aria-controls","aria-selected"],M={key:0,class:"nav-item"},D=o("i",{class:"me-1 align-bottom ri-upload-fill"},null,-1),y=o("i",{class:"ri-add-fill align-bottom"},null,-1),h={class:"tab-content"},k=["id","aria-labelledby"],U={__name:"Line",props:["formData","references"],emits:["update:formData"],setup(U,{emit:$}){const g=U,w=t({get:()=>g.formData,set(e){$("update:formData",e)}}),L=l(!1);return(t,l)=>(u(),n(r,null,[o("div",null,[o("nav",null,[o("ul",x,[(u(!0),n(r,null,i(p(w).expenses,(e=>(u(),n("li",{class:"nav-item",key:`nav-item-${e.expense_id}`},[o("a",{class:f(["nav-link",{active:"MNL"==e.expense.code}]),id:`nav-${e.expense.code}-tab`,title:e.expense.name,"data-bs-toggle":"tab",href:`#nav-${e.expense.code}`,role:"tab","aria-controls":`nav-${e.expense.code}`,"aria-selected":"MNL"==e.expense.code},[o("i",{class:f(`me-1 align-bottom ${e.expense.icon}`)},null,2),m(" "+v(e.expense.name)+" ",1)],10,j)])))),128)),!p(w).id&&p(w).expenses.length<6&&!["published","closed","cancelled"].includes(p(w).document_status)?(u(),n("li",M,[o("a",{class:"nav-link",href:"javascript:void(0);",onClick:l[0]||(l[0]=e=>L.value=!0)},[D,m(" Upload "),y])])):c("",!0)])]),o("div",h,[(u(!0),n(r,null,i(p(w).expenses,(s=>(u(),n("div",{key:`tab-item-${s.expense.id}`,class:f(["tab-pane fade",{show:"MNL"==s.expense.code,active:"MNL"==s.expense.code}]),id:`nav-${s.expense.code}`,role:"tabpanel","aria-labelledby":`nav-${s.expense.code}-tab`},["MNL"==s.expense.code?(u(),b(e,{key:0,formData:p(w),references:U.references},null,8,["formData","references"])):c("",!0),"MNL"!=s.expense.code?(u(),b(a,{key:1,formData:p(w),references:U.references,expense:s},null,8,["formData","references","expense"])):c("",!0)],10,k)))),128))])]),d(s,{show:L.value,"onUpdate:show":l[1]||(l[1]=e=>L.value=e),formData:p(w),"onUpdate:formData":l[2]||(l[2]=e=>w.value=e),references:U.references},null,8,["show","formData","references"])],64))}};export{U as default};