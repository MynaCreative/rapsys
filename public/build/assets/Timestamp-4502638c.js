import{o as a,c as s,e as t,t as e,b as m}from"./app-891c8d04.js";const p={key:0},d={class:"text-muted"},o={key:1},r={__name:"Timestamp",props:{data:{required:!0}},setup:r=>(n,y)=>r.data?(a(),s("span",p,[t(e(n.$dayjs(r.data).format("DD MMM, YYYY"))+" ",1),m("small",d,e(n.$dayjs(r.data).format("HH:mm")),1)])):(a(),s("span",o," -- "))};export{r as _};