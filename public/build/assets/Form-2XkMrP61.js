import{v as e,o as l,c as a,b as t,D as s,n as o,u as n,a as r,F as d,E as i,G as c,H as u,ac as m,t as p,L as f,J as v,g as b}from"./app-DSTM3SJ3.js";import{d as g}from"./v-money3-DJeuOA-S.js";import{C as V}from"./vue-select-BtwHA1xE.js";const x={class:"row g-2"},_={class:"col-lg-12"},h=t("label",{for:"department",class:"form-label"},"Department",-1),U=["value"],k={class:"col-lg-6"},w=t("label",{for:"code",class:"form-label"},"Code",-1),y={class:"col-lg-6"},D=t("label",{for:"name",class:"form-label"},"Name",-1),M={class:"col-lg-12"},H={class:"table table-sm table-bordered table-hover table-nowrap"},L={class:"table-light"},T={class:"align-middle text-center",rowspan:"2"},C={href:"#"},j=t("th",{class:"align-middle text-center",width:"50",rowspan:"2"},"Step",-1),q=t("th",{class:"align-middle text-center",rowspan:"2"},"User",-1),F=t("th",{class:"align-middle text-center",colspan:"2"},"Range",-1),R=t("th",{class:"align-middle text-center",rowspan:"2"},"Description",-1),S=t("tr",null,[t("th",{class:"text-center",width:"120"},"From"),t("th",{class:"text-center",width:"120"},"To")],-1),A={class:"text-center align-middle"},E=["onClick"],G={class:"text-center"},J=["onUpdate:modelValue"],N=["onUpdate:modelValue"],z=t("option",{value:""},"Select user",-1),B=["value"],I={class:"text-end"},K={class:"text-end"},O={class:"text-center"},P=["onUpdate:modelValue"],Q={class:"col-lg-12"},W=t("label",{class:"form-label"},"Description",-1),X={__name:"Form",props:["formData","references"],emits:["update:formData"],setup(X,{emit:Y}){const Z=X,$=Y,ee=e({get:()=>Z.formData,set(e){$("update:formData",e)}}),le={precision:0,masked:!1};return(e,Y)=>{const Z=v,$=b;return l(),a("div",x,[t("div",_,[h,ee.value.id?(l(),a("input",{key:1,class:"form-control",value:ee.value.department?.name,disabled:""},null,8,U)):(l(),s(n(V),{key:0,modelValue:ee.value.department_id,"onUpdate:modelValue":Y[0]||(Y[0]=e=>ee.value.department_id=e),class:o({"is-invalid":ee.value.errors.department_id}),options:X.references.departments,reduce:e=>e.id,label:"name"},null,8,["modelValue","class","options","reduce"])),r(Z,{id:"input-department-feedback",innerHTML:ee.value.errors.department_id},null,8,["innerHTML"])]),t("div",k,[w,r($,{id:"code",modelValue:ee.value.code,"onUpdate:modelValue":Y[1]||(Y[1]=e=>ee.value.code=e),class:o({"is-invalid":ee.value.errors.code}),"aria-describedby":"input-code-feedback"},null,8,["modelValue","class"]),r(Z,{id:"input-code-feedback",innerHTML:ee.value.errors.code},null,8,["innerHTML"])]),t("div",y,[D,r($,{id:"name",modelValue:ee.value.name,"onUpdate:modelValue":Y[2]||(Y[2]=e=>ee.value.name=e),class:o({"is-invalid":ee.value.errors.name}),"aria-describedby":"input-name-feedback",autofocus:""},null,8,["modelValue","class"]),r(Z,{id:"input-name-feedback",innerHTML:ee.value.errors.name},null,8,["innerHTML"])]),t("div",M,[t("table",H,[t("thead",L,[t("tr",null,[t("th",T,[t("a",C,[t("i",{class:"ri-add-fill align-bottom cursor-pointer",title:"Add",onClick:Y[3]||(Y[3]=e=>{ee.value.items.push({user_id:null,sequence:null,range_from:0,range_to:0})})})])]),j,q,F,R]),S]),t("tbody",null,[(l(!0),a(d,null,i(ee.value.items,((e,s)=>(l(),a("tr",{key:s},[t("td",A,[t("i",{class:"ri-close-line text-danger cursor-pointer",title:"Remove",onClick:e=>(e=>{ee.value.items.splice(e,1)})(s)},null,8,E)]),t("td",G,[c(t("input",{type:"number","onUpdate:modelValue":l=>e.sequence=l,class:"form-control text-end"},null,8,J),[[u,e.sequence,void 0,{number:!0}]])]),t("td",null,[c(t("select",{class:"form-select","onUpdate:modelValue":l=>e.user_id=l},[z,(l(!0),a(d,null,i(X.references.users,((e,t)=>(l(),a("option",{value:t},p(e),9,B)))),256))],8,N),[[m,e.user_id]])]),t("td",I,[r(n(g),f({modelValue:e.range_from,"onUpdate:modelValue":l=>e.range_from=l,modelModifiers:{number:!0},ref_for:!0},le,{class:"form-control text-end"}),null,16,["modelValue","onUpdate:modelValue"])]),t("td",K,[r(n(g),f({modelValue:e.range_to,"onUpdate:modelValue":l=>e.range_to=l,modelModifiers:{number:!0},ref_for:!0},le,{class:"form-control text-end"}),null,16,["modelValue","onUpdate:modelValue"])]),t("td",O,[c(t("input",{type:"text","onUpdate:modelValue":l=>e.description=l,class:"form-control"},null,8,P),[[u,e.description]])])])))),128))])])]),t("div",Q,[W,c(t("textarea",{class:"form-control","onUpdate:modelValue":Y[4]||(Y[4]=e=>ee.value.description=e),rows:"4"},null,512),[[u,ee.value.description]])])])}}};export{X as default};
