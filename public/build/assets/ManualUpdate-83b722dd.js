import{s as a,D as e,w as t,o as s,b as o,a as l,u as i,e as m,d as r,g as n}from"./app-30e0783b.js";import{_ as u}from"./Modal-36df24f3.js";import d from"./ManualForm-a9339eae.js";import"./v-money3-eb747145.js";import"./multiselect-31bf4223.js";const p={class:"modal-header p-3 bg-soft-primary"},f=o("h5",{class:"modal-title"},"Line - Manual Detail",-1),c={class:"modal-body"},b={class:"modal-footer justify-content-between"},D=o("i",{class:"ri-close-line align-bottom me-1"},null,-1),v={__name:"ManualUpdate",props:["show","formData","itemData","references"],emits:["update:show","update:formData"],setup(v,{emit:h}){const w=v,g=a({get:()=>w.formData,set(a){h("update:formData",a)}}),j=a({get:()=>w.itemData,set(a){h("update:itemData",a)}});return(a,w)=>{const y=n;return s(),e(u,{visible:v.show,"onUpdate:visible":w[5]||(w[5]=a=>v.show=a),size:"modal-lg"},{default:t((()=>[o("div",p,[f,o("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:w[0]||(w[0]=a=>h("update:show",!1))})]),o("form",{onSubmit:w[4]||(w[4]=r(((...e)=>a.submit&&a.submit(...e)),["prevent"]))},[o("div",c,[l(d,{formData:i(g),"onUpdate:formData":w[1]||(w[1]=a=>g.value=a),itemData:i(j),"onUpdate:itemData":w[2]||(w[2]=a=>j.value=a),references:v.references},null,8,["formData","itemData","references"])]),o("div",b,[l(y,{variant:"light",onClick:w[3]||(w[3]=a=>h("update:show",!1))},{default:t((()=>[D,m(" Close ")])),_:1})])],32)])),_:1},8,["visible"])}}};export{v as default};
