import e from"./UploadItem-BDqZM73t.js";import a from"./UploadForm-DRqO7S9l.js";import{v as r,o as s,D as t,c as o,a as p,F as m,b as n}from"./app-C9OX3ezV.js";import"./SmuPreview-BSxe4mbJ.js";import"./sumBy-D8RWVrkp.js";import"./_baseIteratee-DO6jvHPo.js";import"./Modal-C-7wPC8u.js";import"./service-De3zA6zd.js";import"./sweetalert2.all-BBb44_lw.js";import"./vue-select-BhTkIImE.js";const f=n("div",{class:"mb-4"},null,-1),l={__name:"Upload",props:["formData","references","expense"],emits:["update:formData"],setup(n,{emit:l}){const i=n,c=l,u=r({get:()=>i.formData,set(e){c("update:formData",e)}});return(r,l)=>u.value.id?(s(),o(m,{key:1},[p(e,{formData:u.value,expense:n.expense,references:n.references},null,8,["formData","expense","references"]),p(a,{formData:u.value,expenseData:n.expense,references:n.references},null,8,["formData","expenseData","references"]),f],64)):(s(),t(a,{key:0,formData:u.value,expenseData:n.expense,references:n.references},null,8,["formData","expenseData","references"]))}};export{l as default};