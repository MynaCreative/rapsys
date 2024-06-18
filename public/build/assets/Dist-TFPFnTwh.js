import{s as t}from"./sumBy-D8RWVrkp.js";import{v as i,o as a,c as s,b as e,F as n,E as o,t as m,u as l,q as d}from"./app-C9OX3ezV.js";import"./_baseIteratee-DO6jvHPo.js";const c={key:0},r={class:"table table-sm table-bordered table-hover"},u=e("thead",{class:"bg-light"},[e("tr",null,[e("th",{class:"text-center"},"#"),e("th",null,"Dist"),e("th",null,"Description"),e("th",{class:"text-end"},"Amount"),e("th",{class:"text-center"},"WHT Code"),e("th",{class:"text-end"},"WHT Amount (-)"),e("th",{class:"text-center"},"VAT Code"),e("th",{class:"text-end"},"VAT Amount (+)"),e("th",{class:"text-end"},"Total")])],-1),g={class:"text-center"},x={class:"text-end"},D={class:"text-center"},h={class:"text-end"},v={class:"text-center"},p={class:"text-end"},F={class:"text-end"},b={key:0},_=e("td",{class:"text-end fw-bold",colspan:"3"},"Total",-1),f={class:"text-end fw-bold"},w=e("td",null,null,-1),L={class:"text-end fw-bold"},S=e("td",null,null,-1),y={class:"text-end fw-bold"},T={class:"text-end fw-bold"},A={__name:"Dist",props:["formData","references"],emits:["update:formData"],setup(A,{emit:j}){const k=A,C=j,B=i({get:()=>k.formData,set(t){C("update:formData",t)}});return(i,A)=>B.value.dists?.items?.length>0?(a(),s("div",c,[e("table",r,[u,e("tbody",null,[(a(!0),s(n,null,o(B.value.dists.items,((t,i)=>(a(),s("tr",{key:i},[e("td",g,m(i+1),1),e("td",null,m(t.dist_code_concat),1),e("td",null,m(t.description),1),e("td",x,m(t.amount.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),e("td",D,m(t.awt_group_name),1),e("td",h,m(t.amount_withholding.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),e("td",v,m(t.ppn_code),1),e("td",p,m(t.amount_tax.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),e("td",F,m(t.amount_after_tax.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1)])))),128))]),e("tbody",null,[B.value.dists.items.length>0?(a(),s("tr",b,[_,e("td",f,m(l(t)(B.value.dists.items,(t=>t.amount)).toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),w,e("td",L,m(l(t)(B.value.dists.items,(t=>t.amount_withholding)).toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),S,e("td",y,m(l(t)(B.value.dists.items,(t=>t.amount_tax)).toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),e("td",T,m(l(t)(B.value.dists.items,(t=>t.amount_after_tax)).toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1)])):d("",!0)])])])):d("",!0)}};export{A as default};