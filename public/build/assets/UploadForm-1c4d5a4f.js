import{s as e,r as l,c as a,b as t,n as o,u as i,a as n,e as s,t as c,F as r,J as d,o as u}from"./app-30e0783b.js";import{P as p}from"./multiselect-31bf4223.js";const f={class:"row g-2"},m={class:"col-lg-6 p-4"},b=t("label",{for:"excel_file",class:"form-label"},"File",-1),x={class:"input-group"},h=[t("i",{class:"ri-delete-bin-5-line align-bottom me-1"},null,-1)],_={class:"form-text mt-4"},g=["href"],v=t("i",{class:"ri-attachment-2 align-bottom"},null,-1),D=["href"],k=t("i",{class:"ri-attachment-2 align-bottom"},null,-1),w=t("br",null,null,-1),V=["href"],y=t("i",{class:"ri-attachment-2 align-bottom"},null,-1),S={class:"col-lg-6 p-4"},j=t("label",{for:"cost_center_upload",class:"form-label"},"Cost Center",-1),C={class:"col-lg-6 px-4"},U=t("label",{for:"withholding",class:"form-label"},"Withholding",-1),F={class:"col-lg-6 px-4"},P=t("label",{for:"tax",class:"form-label"},"Tax",-1),T={__name:"UploadForm",props:["formData","expenseData","references"],emits:["update:formData","update:expenseData"],setup(T,{emit:H}){const L=T,M=e({get:()=>L.formData,set(e){H("update:formData",e)}}),A=e({get:()=>L.expenseData,set(e){H("update:expenseData",e)}}),E=l(null),I=()=>{A.value.excel_file=null,E.value.value=null};return(e,l)=>{const H=d;return u(),a("div",f,[t("div",m,[b,t("div",x,[t("input",{id:"excel_file",ref_key:"excel_file",ref:E,type:"file",class:o(["form-control",{"is-invalid":i(M).errors.excel_file}]),onChange:l[0]||(l[0]=e=>{var l;(l=e).target.files?A.value.excel_file=l.target.files[0]:(A.value.excel_file=null,E.value.value=null)}),accept:".xlsx","aria-describedby":"input-excel_file-feedback"},null,34),t("a",{href:"#",class:"btn btn-light",onClick:I},h)]),n(H,{id:"input-excel_file-feedback",innerHTML:i(A).excel_file},null,8,["innerHTML"]),t("div",_,[i(M).id?(u(),a(r,{key:1},[t("a",{href:e.route("transaction.invoices.revision",{invoice:i(M).id,expense:i(A).id}),target:"_blank"},[k,s(" Download Invalid Data ["+c(i(A).expense.code)+"] ",1)],8,D),w,t("a",{href:e.route("transaction.invoices.revision",{invoice:i(M).id,expense:i(A).id,all:!0}),target:"_blank"},[y,s(" Download All Data ["+c(i(A).expense.code)+"] ",1)],8,V)],64)):(u(),a("a",{key:0,href:e.route("transaction.invoices.import-sample",i(A).expense.code??""),target:"_blank"},[v,s(" Download Excel template ["+c(i(A).expense.code)+"] ",1)],8,g))])]),t("div",S,[j,n(i(p),{id:"cost_center_upload",modelValue:i(A).cost_center,"onUpdate:modelValue":l[1]||(l[1]=e=>i(A).cost_center=e),searchable:!0,onSelect:l[2]||(l[2]=e=>i(A).cost_center_id=e.id),object:!0,label:"name",valueProp:"id","aria-describedby":"input-cost_center-feedback",options:T.references.cost_centers,placeholder:"Select data"},null,8,["modelValue","options"])]),t("div",C,[U,n(i(p),{id:"withholding",modelValue:i(A).withholding,"onUpdate:modelValue":l[3]||(l[3]=e=>i(A).withholding=e),searchable:!0,onSelect:l[4]||(l[4]=e=>i(A).withholding_id=e.id),object:!0,label:"name",valueProp:"id","aria-describedby":"input-withholding-feedback",options:T.references.withholdings,placeholder:"Select data"},null,8,["modelValue","options"])]),t("div",F,[P,n(i(p),{id:"tax",modelValue:i(A).tax,"onUpdate:modelValue":l[5]||(l[5]=e=>i(A).tax=e),searchable:!0,onSelect:l[6]||(l[6]=e=>i(A).tax_id=e.id),object:!0,label:"name",valueProp:"id","aria-describedby":"input-tax-feedback",options:T.references.taxes,placeholder:"Select data"},null,8,["modelValue","options"])])])}}};export{T as default};