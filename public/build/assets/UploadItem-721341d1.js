import t from"./SmuPreview-83d16976.js";import{s as e,r as a,c as i,b as n,n as l,t as o,a as s,F as m,o as d}from"./app-30e0783b.js";import"./sumBy-51908caf.js";import"./_baseIteratee-99fb9f0f.js";import"./Modal-36df24f3.js";import"./service-8a332ed7.js";import"./sweetalert2.all-aaaa6da5.js";const r={class:"row"},c={class:"col-lg-12 p-4"},u={class:"table table-sm"},p=n("thead",{class:"table-light text-muted"},[n("tr",null,[n("th",null,"Item"),n("th",null,"Validation"),n("th",null,"Reason"),n("th",{class:"text-end"},"Count of Item"),n("th",{class:"text-end"},"Count of Weight (kg)")])],-1),g=n("td",null,"Validation Code",-1),x=n("td",null,"Data not found",-1),_={class:"text-end"},v={class:"text-end"},D=n("td",null,"Validation Bill",-1),h=n("td",null,"Already Billed",-1),F={class:"text-end"},b={class:"text-end"},f=n("td",null,"Validation Weight",-1),w=n("td",null,"Weight Not Match",-1),S={class:"text-end"},L={class:"text-end"},j=n("td",null,"Validation Scan Compliance",-1),V=n("td",null,"Scan Not Found",-1),C={class:"text-end"},I={class:"text-end"},W=n("td",null,"Validation Ops Plan",-1),y=n("td",null,"Warning RPX Area",-1),A={class:"text-end"},B={class:"text-end"},M={__name:"UploadItem",props:["formData","expense","references"],emits:["update:formData"],setup(M,{emit:P}){const U=M;e({get:()=>U.formData,set(t){P("update:formData",t)}});const N=a(null),R=a(!1);return(e,a)=>(d(),i(m,null,[n("div",r,[n("div",c,[n("table",u,[p,n("tbody",null,[n("tr",{class:l([{"table-danger":M.expense.total_validation_reference>0}])},[n("td",null,o(M.expense.expense.name),1),g,x,n("td",_,o(M.expense.total_validation_reference.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),n("td",v,o(M.expense.total_weight_validation_reference.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1)],2),n("tr",{class:l([{"table-danger":M.expense.total_validation_bill>0}])},[n("td",null,o(M.expense.expense.name),1),D,h,n("td",F,o(M.expense.total_validation_bill.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),n("td",b,o(M.expense.total_weight_validation_bill.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1)],2),n("tr",{class:l([{"table-danger":M.expense.total_validation_weight>0}])},[n("td",null,o(M.expense.expense.name),1),f,w,n("td",S,o(M.expense.total_validation_weight.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),n("td",L,o(M.expense.total_weight_validation_weight.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1)],2),n("tr",{class:l([{"table-danger":M.expense.total_validation_scan_compliance>0}])},[n("td",null,o(M.expense.expense.name),1),j,V,n("td",C,o(M.expense.total_validation_scan_compliance.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),n("td",I,o(M.expense.total_weight_validation_scan_compliance.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1)],2),n("tr",{class:l([{"table-danger":M.expense.total_validation_ops_plan>0}])},[n("td",null,o(M.expense.expense.name),1),W,y,n("td",A,o(M.expense.total_validation_ops_plan.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),n("td",B,o(M.expense.total_weight_validation_ops_plan.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1)],2)])])])]),s(t,{show:R.value,"onUpdate:show":a[0]||(a[0]=t=>R.value=t),item:N.value,"onUpdate:item":a[1]||(a[1]=t=>N.value=t)},null,8,["show","item"])],64))}};export{M as default};