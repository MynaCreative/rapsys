import e from"./ManualUpdate-D8oXUluW.js";import{v as a,r as t,o as r,c as o,b as s,t as l,n,a as i,F as u}from"./app-DSTM3SJ3.js";import"./Modal-1mpmqj-q.js";import"./ManualForm-CTxR-2Y-.js";import"./v-money3-DJeuOA-S.js";import"./vue-select-BtwHA1xE.js";const c={__name:"ManualItem",props:["formData","itemData","references","index"],emits:["update:formData","update:itemData"],setup(c,{emit:d}){const v=c,m=d,p=a({get:()=>v.formData,set(e){m("update:formData",e)}}),g=a({get:()=>v.itemData,set(e){m("update:itemData",e)}}),x=()=>{p.value.items.splice(v.index,1)},f=t(!1);return(a,t)=>(r(),o(u,null,[s("tr",null,[s("td",{class:"text-center cursor-pointer"},[s("i",{class:"ri-close-line text-danger",title:"Remove",onClick:x})]),s("td",{onClick:t[0]||(t[0]=e=>f.value=!0),class:"cursor-pointer text-center"},l(c.index+1),1),s("td",{onClick:t[1]||(t[1]=e=>f.value=!0),class:n(["cursor-pointer"])},l(g.value.dist),1),s("td",{onClick:t[2]||(t[2]=e=>f.value=!0),class:n(["cursor-pointer",{"bg-soft-danger":p.value.errors[`items.${c.index}.code`]}])},l(g.value.code),3),s("td",{onClick:t[3]||(t[3]=e=>f.value=!0),class:n(["cursor-pointer text-end",{"bg-soft-danger":p.value.errors[`items.${c.index}.amount`]}])},l(g.value.amount?g.value.amount.toLocaleString():0),3),s("td",{onClick:t[4]||(t[4]=e=>f.value=!0),class:n(["cursor-pointer text-end",{"bg-soft-danger":p.value.errors[`items.${c.index}.weight`]}])},l(g.value.weight?g.value.weight.toLocaleString():""),3),s("td",{onClick:t[5]||(t[5]=e=>f.value=!0),class:n(["cursor-pointer",{"bg-soft-danger":p.value.errors[`items.${c.index}.cost_center_id`]}])},l(g.value.cost_center?g.value.cost_center?.name:""),3),s("td",{onClick:t[6]||(t[6]=e=>f.value=!0),class:n(["cursor-pointer",{"bg-soft-danger":p.value.errors[`items.${c.index}.expense_coa`]}])},l(g.value.expense_coa??""),3),s("td",{onClick:t[7]||(t[7]=e=>f.value=!0),class:n(["cursor-pointer",{"bg-soft-danger":p.value.errors[`items.${c.index}.withholding_id`]}])},l(g.value.withholding?g.value.withholding?.name:""),3),s("td",{onClick:t[8]||(t[8]=e=>f.value=!0),class:n(["cursor-pointer",{"bg-soft-danger":p.value.errors[`items.${c.index}.tax_id`]}])},l(g.value.tax?g.value.tax?.name:""),3),s("td",{onClick:t[9]||(t[9]=e=>f.value=!0),class:n(["cursor-pointer",{"bg-soft-danger":p.value.errors[`items.${c.index}.area_id`]}])},l(g.value.area?g.value.area?.name:""),3),s("td",{onClick:t[10]||(t[10]=e=>f.value=!0),class:n(["cursor-pointer",{"bg-soft-danger":p.value.errors[`items.${c.index}.product_id`]}])},l(g.value.area?g.value.product?.name:""),3)]),i(e,{show:f.value,"onUpdate:show":t[11]||(t[11]=e=>f.value=e),formData:p.value,"onUpdate:formData":t[12]||(t[12]=e=>p.value=e),itemData:g.value,"onUpdate:itemData":t[13]||(t[13]=e=>g.value=e),references:c.references},null,8,["show","formData","itemData","references"])],64))}};export{c as default};
