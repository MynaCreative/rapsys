import{o as e,D as a,w as s,b as r,W as t,g as o}from"./app-891c8d04.js";const i=r("i",{class:"ri-refresh-line align-bottom me-1"},null,-1),n={__name:"Reload",props:{page:{required:!0}},setup(r){const n=r,l=()=>{t.visit(route(`${n.page.module}.${n.page.name}.index`))};return(r,t)=>{const n=o;return e(),a(n,{variant:"soft-primary",onClick:l,title:"Reload"},{default:s((()=>[i])),_:1})}}};export{n as _};