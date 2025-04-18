import{k as b,r as g,i as y,o as t,w as i,b as f,a as m,c as s,F as l,q as v,d as n,t as d,f as C,l as u,g as R,z as B,K as $}from"./app-DDXL6oZX.js";import{_ as w}from"./AuthenticatedLayout-B2jBwfyH.js";import{_ as z}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{S as T,B as A}from"./index-CgaGMzJC.js";import{S as L,a as V,_ as F}from"./index-BipCLzYG.js";import"./index-Dz0eR27p.js";import"./CheckOutlined-s3dAU8HO.js";const E=b({name:"OsxPeriodo",components:{AuthenticatedLayout:w},setup(){const o=u([]),a=u(new Date().getFullYear()),I=u((new Date().getMonth()+1).toString().padStart(2,"0")),k=u([2023,2024,2025]),D=u(["01","02","03","04","05","06","07","08","09","10","11","12"]),S=u([{title:"ID Documento",dataIndex:"IdDoc",key:"IdDoc"},{title:"Número Documento Identidad",dataIndex:"NroDI",key:"NroDI"},{title:"Razón Social",dataIndex:"Rz_Social",key:"Rz_Social"},{title:"Documento",dataIndex:"Documento",key:"Documento"},{title:"Número MR",dataIndex:"NroMR",key:"NroMR"},{title:"Moneda",dataIndex:"sMnd",key:"sMnd"},{title:"Total",dataIndex:"Total",key:"Total"},{title:"Saldo",dataIndex:"Saldo",key:"Saldo"}]),_=R(()=>`${a.value}${I.value}`),c=async()=>{try{const p=await $.get("/api/clientes/osxperiodo",{params:{anio_mes:_.value}});o.value=p.data}catch(p){console.error("Error al obtener los clientes:",p)}};return B(()=>{c()}),{clientes:o,columns:S,anio:a,mes:I,aniosDisponibles:k,mesesDisponibles:D,getClientes:c}}});function K(o,a,I,k,D,S){const _=V,c=L,p=A,x=T,M=F,N=g("AuthenticatedLayout");return t(),y(N,null,{header:i(()=>a[2]||(a[2]=[f("h1",null,"Clientes por Periodo",-1)])),default:i(()=>[f("div",null,[m(x,null,{default:i(()=>[m(c,{value:o.anio,"onUpdate:value":a[0]||(a[0]=e=>o.anio=e),placeholder:"Seleccione Año"},{default:i(()=>[(t(!0),s(l,null,v(o.aniosDisponibles,e=>(t(),y(_,{key:e,value:e},{default:i(()=>[n(d(e),1)]),_:2},1032,["value"]))),128))]),_:1},8,["value"]),m(c,{value:o.mes,"onUpdate:value":a[1]||(a[1]=e=>o.mes=e),placeholder:"Seleccione Mes"},{default:i(()=>[(t(!0),s(l,null,v(o.mesesDisponibles,e=>(t(),y(_,{key:e,value:e},{default:i(()=>[n(d(e),1)]),_:2},1032,["value"]))),128))]),_:1},8,["value"]),m(p,{type:"primary",onClick:o.getClientes},{default:i(()=>a[3]||(a[3]=[n("Buscar")])),_:1},8,["onClick"])]),_:1}),m(M,{dataSource:o.clientes,columns:o.columns,rowKey:"IdDoc",bordered:""},{bodyCell:i(({column:e,record:r})=>[e.dataIndex==="IdDoc"?(t(),s(l,{key:0},[n(d(r.IdDoc),1)],64)):e.dataIndex==="NroDI"?(t(),s(l,{key:1},[n(d(r.NroDI),1)],64)):e.dataIndex==="Rz_Social"?(t(),s(l,{key:2},[n(d(r.Rz_Social),1)],64)):e.dataIndex==="Documento"?(t(),s(l,{key:3},[n(d(r.Documento),1)],64)):e.dataIndex==="NroMR"?(t(),s(l,{key:4},[n(d(r.NroMR),1)],64)):e.dataIndex==="sMnd"?(t(),s(l,{key:5},[n(d(r.sMnd),1)],64)):e.dataIndex==="Total"?(t(),s(l,{key:6},[n(d(r.Total),1)],64)):e.dataIndex==="Saldo"?(t(),s(l,{key:7},[n(d(r.Saldo),1)],64)):C("",!0)]),_:1},8,["dataSource","columns"])])]),_:1})}const G=z(E,[["render",K]]);export{G as default};
