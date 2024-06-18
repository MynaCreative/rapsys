import{s as e}from"./service-BxplQAEh.js";import{r as t,x as a,z as n,o,c as s,a as r,B as l}from"./app-C9OX3ezV.js";const i={class:"w-full"},c={__name:"InvoiceDepartment",setup(c){const d=t(),u=async()=>{const t=p.value.chart;t.showLoading("Loading ..."),d.value=await e.fetchData("chart","invoice-department"),t.update({series:[{data:l(d.value)}]}),t.hideLoading()};a((()=>{u()}));const p=t(null),f=t({title:{text:"Top 10 Invoice by Department",align:"center"},colors:["#37d2ff"],chart:{type:"bar"},series:[{name:"User",dataLabels:{inside:!0,enabled:!0,format:"{point.y:.0f}"},tooltip:{pointFormat:"Documents: <b>{point.y}</b>"},borderRadius:5,colorByPoint:!0,data:null}],xAxis:{type:"category",labels:{formatter:function(){return m(this.value)}}},yAxis:{title:!1,labels:{enabled:!1}},exporting:{buttons:{refreshButton:{symbol:"url(https://api.iconify.design/ic/baseline-refresh.svg?color=%23666)",symbolSize:24,symbolX:27,symbolY:27,x:0,align:"right",theme:{fill:"transparent"},onclick:function(e){e.preventDefault(),u()}},contextButton:{symbol:"menu",align:"left",menuItems:["viewFullscreen","printChart","separator","downloadPNG","downloadJPEG","downloadPDF","downloadSVG","separator","downloadCSV","downloadXLS","viewData"]}}},legend:{enabled:!1},credits:{enabled:!1}}),m=(e,t=3)=>{const a=e.split(/\s+/);if(a.length<=t)return e;return a.slice(0,t).join(" ")+"..."};return(e,t)=>{const a=n("highcharts");return o(),s("div",i,[r(a,{ref_key:"chartRef",ref:p,options:f.value},null,8,["options"])])}}};export{c as default};