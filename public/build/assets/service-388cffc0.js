import{B as e,W as t}from"./app-30e0783b.js";import{S as o}from"./sweetalert2.all-aaaa6da5.js";import{e as r}from"./entity-ea7026f7.js";const a=r().page,s={async showData(t,o){const{data:r}=await e.get(route(`${a.module}.${a.name}.show`,o));Object.keys(r).forEach((e=>{t[e]=r[e]}))},submitData(e,t,o){let r=e.id?"patch":"post",s=e.id?route(`${a.module}.${a.name}.update`,e.id):route(`${a.module}.${a.name}.store`);e.submit(r,s,{onSuccess:()=>{e.reset(),e.clearErrors(),o("update:show",!1)}})},importData(e,t){e.submit("post",route(`${a.module}.${a.name}.import`),{onSuccess:()=>{e.reset(),e.clearErrors(),t("update:show",!1)}})},deleteData(e,r=!1){o.fire({title:`Are you sure you want to ${r?"Restore":"Delete"} this item?`,text:!r&&"Don't worry, you can restore it again.",icon:"warning",showCancelButton:!0,confirmButtonColor:"#34c38f",cancelButtonColor:"#f46a6a",confirmButtonText:`Yes, ${r?"restore":"delete"} it!`}).then((o=>{o.value&&t.delete(route(`${a.module}.${a.name}.${r?"restore":"destroy"}`,e))}))}};export{s};
