import{r as e,x as a,c as t,b as s,a as i,y as r,z as l,o as d}from"./app-30e0783b.js";const c={class:"card card-height-100"},o={class:"card-header border-0 pb-0"},n=s("h6",{class:"card-title mb-0"},"Invoice Validation Popularity",-1),p=r('<div class="card-body"><div class="mt-3 pt-2"><div class="d-flex mb-2"><div class="flex-grow-1"><p class="text-truncate text-muted fs-14 mb-0"><i class="mdi mdi-circle align-middle text-primary me-2"></i>Valid </p></div><div class="flex-shrink-0"><p class="mb-0">0%</p></div></div><div class="d-flex"><div class="flex-grow-1"><p class="text-truncate text-muted fs-14 mb-0"><i class="mdi mdi-circle align-middle text-danger me-2"></i>Invalid </p></div><div class="flex-shrink-0"><p class="mb-0">0%</p></div></div></div><div class="mt-2 text-center"><a href="javascript:void(0);" class="text-muted text-decoration-underline">Show All</a></div></div>',1),m={__name:"ValidationPopularity",setup(r){const m=e([]);a((()=>{m.value=[{name:"Valid",data:[0]},{name:"Invalid",data:[0]}]}));const u={chart:{type:"bar",height:260,stacked:!0,toolbar:{show:!1}},stroke:{colors:"#000"},plotOptions:{bar:{columnWidth:"20%",borderRadius:[4,4]}},colors:(v='["--vz-success", "--vz-danger"]',(v=JSON.parse(v)).map((function(e){var a=e.replace(" ","");if(-1===a.indexOf(",")){var t=getComputedStyle(document.documentElement).getPropertyValue(a);return t?t=t.replace(" ",""):a}var s=e.split(",");if(2==s.length){var i=getComputedStyle(document.documentElement).getPropertyValue(s[0]);return i="rgba("+i+","+s[1]+")"}return a}))),fill:{opacity:1},dataLabels:{enabled:!1,textAnchor:"top"},yaxis:{labels:{show:!1,formatter:function(e){return e.toFixed(0)+"%"}}},legend:{position:"top",horizontalAlign:"right"},xaxis:{categories:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug"],labels:{rotate:-90}}};var v;return(e,a)=>{const r=l("apexchart");return d(),t("div",c,[s("div",o,[n,i(r,{class:"apex-charts",height:"240",dir:"ltr",series:m.value,options:u},null,8,["series"])]),p])}}};export{m as default};