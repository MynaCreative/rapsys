import{T as t,N as e,o as a,D as l,w as s,b as d,t as n,u as i,c as o,E as r,F as c,a as m,e as u,h as p}from"./app-DSTM3SJ3.js";import{_ as b}from"./Modal-1mpmqj-q.js";import{_ as h}from"./UserName-B1eWDQBk.js";import{_ as g}from"./Timestamp-CtxzEmuD.js";import{e as x,s as w}from"./service-DGcV1OVQ.js";import"./sweetalert2.all-BaCSOYxu.js";const _={class:"modal-header p-3 bg-soft-warning"},f={class:"modal-title"},v={class:"table table-bordered"},y=d("td",{class:"text-muted table-light",width:"100"},"Code",-1),j={colspan:"3"},C=d("td",{class:"text-muted table-light"},"Department",-1),D={colspan:"3"},T=d("td",{class:"text-muted table-light"},"Name",-1),U={colspan:"3"},k=d("td",{class:"text-muted table-light"},"Items",-1),N={colspan:"3",class:"p-0"},S={class:"table table-sm table-bordered table-nowrap m-0"},B=d("thead",{class:"table-light"},[d("tr",null,[d("th",{class:"align-middle text-center"},"#"),d("th",{class:"align-middle"},"User"),d("th",{class:"align-middle text-center"},"Range From"),d("th",{class:"align-middle text-center"},"Range To")])],-1),F={class:"text-center"},L={class:"text-end"},M={class:"text-end"},R=d("td",{class:"text-muted table-light"},"Description",-1),q={colspan:"3",class:"text-wrap"},z=d("td",{class:"text-muted table-light"},"Created By",-1),E=d("td",{class:"text-muted table-light"},"Time",-1),I={width:"150"},P=d("td",{class:"text-muted table-light"},"Updated By",-1),V=d("td",{class:"text-muted table-light"},"Time",-1),Y={class:"modal-footer"},A=d("i",{class:"ri-close-line align-bottom me-1"},null,-1),G={__name:"Detail",props:["show","id"],emits:["update:show","update:id"],setup(G,{emit:H}){const J=x().page,K=G,O=H,Q=t(x().form);return e(K,(async t=>{t.id?w.showData(Q,t.id):O("update:id",null)})),(t,e)=>{const x=p;return a(),l(b,{visible:G.show,"onUpdate:visible":e[2]||(e[2]=t=>G.show=t),size:"modal-lg"},{default:s((()=>[d("div",_,[d("h5",f,"Detail View - "+n(i(J).title),1),d("button",{type:"button",class:"btn-close","aria-label":"Close",onClick:e[0]||(e[0]=t=>O("update:show",!1))})]),d("table",v,[d("tbody",null,[d("tr",null,[y,d("td",j,n(i(Q).code),1)]),d("tr",null,[C,d("td",D,n(i(Q).department?.name),1)]),d("tr",null,[T,d("td",U,n(i(Q).name),1)]),d("tr",null,[k,d("td",N,[d("table",S,[B,d("tbody",null,[(a(!0),o(c,null,r(i(Q).items,((t,e)=>(a(),o("tr",{key:e},[d("td",F,n(t.sequence),1),d("td",null,n(t.user?.name),1),d("td",L,n(t.range_from.toLocaleString()),1),d("td",M,n(t.range_to.toLocaleString()),1)])))),128))])])])]),d("tr",null,[R,d("td",q,n(i(Q).description),1)]),d("tr",null,[z,d("td",null,[m(h,{data:i(Q).created_user?.name},null,8,["data"])]),E,d("td",I,[m(g,{data:i(Q).created_at},null,8,["data"])])]),d("tr",null,[P,d("td",null,[m(h,{data:i(Q).updated_user?.name},null,8,["data"])]),V,d("td",null,[m(g,{data:i(Q).updated_at},null,8,["data"])])])])]),d("div",Y,[m(x,{variant:"light",onClick:e[1]||(e[1]=t=>O("update:show",!1))},{default:s((()=>[A,u(" Close ")])),_:1})])])),_:1},8,["visible"])}}};export{G as default};
