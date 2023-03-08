import{a as E,o as c,c as p,b as e,d as W,e as b,f as w,u as M,r as $,g,w as m,h as k,F as C,i as B,j as t,t as y,v as N,k as _,D as L,n as f,Y as x,m as T,_ as ne,l as ie,p as le,E as ae,q,s as de,x as V,y as H,z as re,T as ce,A as F,B as I,C as pe,G as ue,H as he,S as ge,I as P,N as me,J as _e,$ as ye,K as we,L as fe,M as xe,O as be}from"./vendor-9cfce2be.js";let ve=document.head.querySelector('meta[name="csrf-token"]').content;E.defaults.headers.common["X-CSRF-TOKEN"]=ve.textContent;E.defaults.headers.common["X-Requested-With"]="XMLHttpRequest";window.axios=E;const ke="Dashboard",$e="List",Se="Edit",Ce="Delete",Be="Remove",Te="Name",Me="Description",je="Count",Ne="Speichern",Le="Stornieren",De="Vorname",Ae="Nachname",Ve="Email",Ee="Zurück",We={"Good day":"Guten Tag",Dashboard:ke,"All Lists":"All Lists",List:$e,Edit:Se,Delete:Ce,Remove:Be,Name:Te,Description:Me,Count:je,Save:Ne,Cancel:Le,"Message Body":"Nachrichtentext",Firstname:De,Lastname:Ae,"Add message placeholders":"Nachrichtenplatzhalter hinzufügen",Email:Ve,Back:Ee};const He={class:"bg-light h-100 shadow-lg"},Oe=b('<h5 class="sidebar-heading py-3 px-2"><span class="d-flex align-items-center justify-content-center fw-lighter text-center"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move align-middle me-2"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>You can drag these nodes to the pane</span></h5>',1),Ue={class:"d-flex flex-column gap-2"},Re={class:"d-flex flex-wrap gap-2 align-items-center my-3 px-4"},ze={class:"action-box px-3 justify-content-center"},qe={class:"condition-box__icon"},Fe={style:{transform:"rotate(315deg)"},xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",stroke:"currentColor","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round",class:"feather feather-help-circle"},Ie=e("circle",{cx:"12",cy:"12",r:"10"},null,-1),Pe=e("path",{d:"M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"},null,-1),Ge=e("line",{x1:"12",y1:"17",x2:"12.01",y2:"17"},null,-1),Xe=[Ie,Pe,Ge],Ye=b('<div class="bg-white shadow-sm px-3 py-2"><h6 class="mb-0"><span class="d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-git-pull-request align-middle me-2"><circle cx="18" cy="18" r="3"></circle><circle cx="6" cy="6" r="3"></circle><path d="M13 6h3a2 2 0 0 1 2 2v7"></path><line x1="6" y1="9" x2="6" y2="21"></line></svg> Conditions</span></h6></div>',1),Ke={class:"d-flex flex-wrap gap-4 align-items-center my-3 px-4"},Je=b('<span class="condition-box pe-2 justify-content-end"><span class="condition-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw align-middle"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></span> Stage Changed</span>',1),Qe=[Je],Ze=b('<span class="condition-box pe-2 justify-content-end"><span class="condition-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw align-middle"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></span> Message Opened </span>',1),et=[Ze],tt=b('<div class="bg-white shadow-sm px-3 py-2"><h6 class="mb-0"><span class="d-flex align-items-center"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-repeat align-middle me-2"><polyline points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg> Actions</span></h6></div>',1),ot={class:"d-flex flex-wrap gap-4 align-items-center my-3 px-4"},st=b('<span class="action-box pe-2 justify-content-end"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail align-middle"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></span> Send Message </span>',1),nt=[st],it=b('<span class="action-box px-3 justify-content-center"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock align-middle"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></span> Wait </span>',1),lt=[it],at=b('<span class="action-box ps-2 justify-content-center"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag align-middle"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg></span> Add Tag </span>',1),dt=[at],rt=b('<span class="action-box ps-2 justify-content-center"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list align-middle"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg></span> Move To List </span>',1),ct=[rt],pt=b('<span class="action-box ps-2 justify-content-center"><span class="action-box__icon"><svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg></span> A/B Split </span>',1),ut=[pt],ht={__name:"Sidebar",setup(o){const s=(i,l,n)=>{i.dataTransfer&&(i.dataTransfer.setData("application/vueflow",l),i.dataTransfer.effectAllowed="move")};return(i,l)=>(c(),p("aside",He,[Oe,e("div",Ue,[e("div",Re,[e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:l[0]||(l[0]=n=>s(n,"action.start"))},[e("span",ze,[e("span",qe,[(c(),p("svg",Fe,Xe))]),W(" If published ")])],32)]),Ye,e("div",Ke,[e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:l[1]||(l[1]=n=>s(n,"condition.stage.changed"))},Qe,32),e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:l[2]||(l[2]=n=>s(n,"condition.message.opened"))},et,32)]),tt,e("div",ot,[e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:l[3]||(l[3]=n=>s(n,"action.message.sent"))},nt,32),e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:l[4]||(l[4]=n=>s(n,"action.wait"))},lt,32),e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:l[5]||(l[5]=n=>s(n,"action.add.tag"))},dt,32),e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:l[6]||(l[6]=n=>s(n,"action.move.to.list"))},ct,32),e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:l[7]||(l[7]=n=>s(n,"action.ab.split"))},ut,32)])])]))}},gt={class:"vue-flow__node-input shadow-sm"},mt=["value"],_t=b('<span class="condition-box pe-2 justify-content-end"><span class="condition-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw align-middle"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></span> Stage Changed</span>',1),yt=e("span",{class:"circle"},null,-1),wt=e("span",{class:"circle"},null,-1),ft={__name:"StageChanged",props:{id:String,label:String,type:String},setup(o){const s=o,i=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",top:"-7px"})),l=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",bottom:"-7px"}));let n=window.stages;const{findNode:u}=M(),d=$(u(s.id));return(r,h)=>(c(),p("div",gt,[g(t(L),{style:{display:"flex",gap:"0.5rem","align-items":"center"},"is-visible":!0,"node-id":o.id,position:t(_).Right},{default:m(()=>[k(e("select",{name:"argument",class:"form-select","onUpdate:modelValue":h[0]||(h[0]=a=>d.value.data=a)},[(c(!0),p(C,null,B(t(n),a=>(c(),p("option",{value:a},y(a.title),9,mt))),256))],512),[[N,d.value.data]])]),_:1},8,["node-id","position"]),_t,g(t(x),{id:`state.stage.changed.target.${o.id}`,type:"target",position:t(_).Top,style:f(t(i)),class:"handle"},{default:m(()=>[yt]),_:1},8,["id","position","style"]),g(t(x),{id:`state.stage.changed.${o.id}`,type:"source",position:t(_).Bottom,style:f(t(l)),class:"handle"},{default:m(()=>[wt]),_:1},8,["id","position","style"])]))}},xt={class:"vue-flow__node-input shadow-sm"},bt=["value"],vt=b('<span class="action-box pe-2 justify-content-end"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail align-middle"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></span> Send Message </span>',1),kt=e("span",{class:"circle"},null,-1),$t=e("span",{class:"circle"},null,-1),St={__name:"SendMessage",props:{id:String,label:String,type:String},setup(o){const s=o,i=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",top:"-7px"})),l=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",bottom:"-7px"}));let n=window.messages;const{findNode:u}=M(),d=$(u(s.id));return(r,h)=>(c(),p("div",xt,[g(t(L),{style:{display:"flex",gap:"0.5rem","align-items":"center"},"is-visible":!0,"node-id":o.id,position:t(_).Right},{default:m(()=>[k(e("select",{name:"argument",class:"form-select","onUpdate:modelValue":h[0]||(h[0]=a=>d.value.data=a)},[(c(!0),p(C,null,B(t(n),a=>(c(),p("option",{value:a},y(a.title),9,bt))),256))],512),[[N,d.value.data]])]),_:1},8,["node-id","position"]),vt,g(t(x),{id:`state.message.sent.${o.id}`,type:"source",position:t(_).Bottom,style:f(t(l)),class:"handle"},{default:m(()=>[kt]),_:1},8,["id","position","style"]),g(t(x),{id:`state.message.sent.target.${o.id}`,type:"target",position:t(_).Top,style:f(t(i)),class:"handle"},{default:m(()=>[$t]),_:1},8,["id","position","style"])]))}},Ct={class:"vue-flow__node-input shadow-sm"},Bt=["value"],Tt=b('<span class="action-box pe-2 justify-content-center"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock align-middle"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></span> Wait </span>',1),Mt=e("span",{class:"circle"},null,-1),jt=e("span",{class:"circle"},null,-1),Nt={__name:"Wait",props:{id:String,label:String,type:String},setup(o){const s=o,i=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",top:"-7px"})),l=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",bottom:"-7px"}));let n=window.waitOptions;const{findNode:u}=M(),d=$(u(s.id));return(r,h)=>(c(),p("div",Ct,[g(t(L),{style:{display:"flex",gap:"0.5rem","align-items":"center"},"is-visible":!0,"node-id":o.id,position:t(_).Right},{default:m(()=>[k(e("select",{name:"argument",class:"form-select","onUpdate:modelValue":h[0]||(h[0]=a=>d.value.data=a)},[(c(!0),p(C,null,B(t(n),a=>(c(),p("option",{value:a},y(a.title),9,Bt))),256))],512),[[N,d.value.data]])]),_:1},8,["node-id","position"]),Tt,g(t(x),{id:`state.wait.target.${o.id}`,type:"target",position:t(_).Top,style:f(t(i)),class:"handle"},{default:m(()=>[Mt]),_:1},8,["id","position","style"]),g(t(x),{id:`state.wait.${o.id}`,type:"source",position:t(_).Bottom,style:f(t(l)),class:"handle"},{default:m(()=>[jt]),_:1},8,["id","position","style"])]))}},Lt={class:"vue-flow__node-input shadow-sm"},Dt={class:"action-box pe-2 justify-content-center"},At={class:"condition-box__icon"},Vt={style:{transform:"rotate(315deg)"},xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",stroke:"currentColor","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round",class:"feather feather-help-circle"},Et=e("circle",{cx:"12",cy:"12",r:"10"},null,-1),Wt=e("path",{d:"M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"},null,-1),Ht=e("line",{x1:"12",y1:"17",x2:"12.01",y2:"17"},null,-1),Ot=[Et,Wt,Ht],Ut=e("span",{class:"circle"},null,-1),Rt={__name:"Start",props:{id:String,label:String,type:String},setup(o){const s=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",bottom:"-6px"}));return(i,l)=>(c(),p("div",Lt,[e("span",Dt,[e("span",At,[(c(),p("svg",Vt,Ot))]),W(" If published ")]),g(t(x),{id:"start",type:"source",position:t(_).Bottom,style:f(t(s)),class:"handle"},{default:m(()=>[Ut]),_:1},8,["position","style"])]))}},zt={class:"vue-flow__node-input shadow-sm"},qt=["value"],Ft=b('<span class="action-box pe-2 justify-content-center"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag align-middle"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg></span> AddTag </span>',1),It=e("span",{class:"circle"},null,-1),Pt=e("span",{class:"circle"},null,-1),Gt={__name:"AddTag",props:{id:String,label:String,type:String},setup(o){const s=o,i=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",top:"-7px"})),l=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",bottom:"-7px"}));let n=window.tags;const{findNode:u}=M(),d=$(u(s.id));return(r,h)=>(c(),p("div",zt,[g(t(L),{style:{display:"flex",gap:"0.5rem","align-items":"center"},"is-visible":!0,"node-id":o.id,position:t(_).Right},{default:m(()=>[k(e("select",{name:"argument",class:"form-select","onUpdate:modelValue":h[0]||(h[0]=a=>d.value.data=a)},[(c(!0),p(C,null,B(t(n),a=>(c(),p("option",{value:a},y(a.title),9,qt))),256))],512),[[N,d.value.data]])]),_:1},8,["node-id","position"]),Ft,g(t(x),{id:`state.tag.add.${o.id}`,type:"source",position:t(_).Bottom,style:f(t(l)),class:"handle"},{default:m(()=>[It]),_:1},8,["id","position","style"]),g(t(x),{id:`state.tag.add.target.${o.id}`,type:"target",position:t(_).Top,style:f(t(i)),class:"handle"},{default:m(()=>[Pt]),_:1},8,["id","position","style"])]))}},Xt={class:"vue-flow__node-input shadow-sm"},Yt=["value"],Kt=b('<span class="condition-box pe-2 justify-content-end"><span class="condition-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw align-middle"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></span> Message Opened </span>',1),Jt=e("span",{class:"circle"},null,-1),Qt=e("svg",{width:"10",height:"10",fill:"none",viewBox:"0 0 24 24","stroke-width":"2",stroke:"white"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M4.5 12.75l6 6 9-13.5"})],-1),Zt=e("svg",{width:"10",height:"10",fill:"none",viewBox:"0 0 24 24","stroke-width":"2",stroke:"white"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M6 18L18 6M6 6l12 12"})],-1),eo={__name:"MessageOpened",props:{id:String,label:String,type:String},setup(o){const s=o,i=w(()=>({backgroundColor:"green",left:"48px",width:"14px",height:"14px",right:"auto",bottom:"-7px"})),l=w(()=>({backgroundColor:"red",width:"14px",height:"14px",right:"40px",left:"auto",bottom:"-7px"})),n=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",top:"-6px"}));let u=window.messagesOpened;const{findNode:d}=M(),r=$(d(s.id));return(h,a)=>(c(),p("div",Xt,[g(t(L),{style:{display:"flex",gap:"0.5rem","align-items":"center"},"is-visible":!0,"node-id":o.id,position:t(_).Right},{default:m(()=>[k(e("select",{name:"argument",class:"form-select","onUpdate:modelValue":a[0]||(a[0]=S=>r.value.data=S)},[(c(!0),p(C,null,B(t(u),S=>(c(),p("option",{value:S},y(S.title),9,Yt))),256))],512),[[N,r.value.data]])]),_:1},8,["node-id","position"]),Kt,g(t(x),{id:`state.message.opened.target.${o.id}`,type:"target",position:t(_).Top,style:f(t(n)),class:"handle"},{default:m(()=>[Jt]),_:1},8,["id","position","style"]),g(t(x),{id:`state.message.opened.${o.id}`,type:"source",position:t(_).Bottom,style:f(t(i)),class:"handle"},{default:m(()=>[Qt]),_:1},8,["id","position","style"]),g(t(x),{id:`state.message.not_opened.${o.id}`,type:"source",position:t(_).Bottom,style:f(t(l)),class:"handle"},{default:m(()=>[Zt]),_:1},8,["id","position","style"])]))}},to={class:"vue-flow__node-input shadow-sm"},oo=["value"],so=b('<span class="action-box pe-2 justify-content-center"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list align-middle"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg></span> Move To List </span>',1),no=e("span",{class:"circle"},null,-1),io=e("span",{class:"circle"},null,-1),lo={__name:"MoveToList",props:{id:String,label:String,type:String},setup(o){const s=o,i=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",top:"-7px"})),l=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",bottom:"-7px"}));let n=window.contactLists;const{findNode:u}=M(),d=$(u(s.id));return(r,h)=>(c(),p("div",to,[g(t(L),{style:{display:"flex",gap:"0.5rem","align-items":"center"},"is-visible":!0,"node-id":o.id,position:t(_).Right},{default:m(()=>[k(e("select",{name:"argument",class:"form-select","onUpdate:modelValue":h[0]||(h[0]=a=>d.value.data=a)},[(c(!0),p(C,null,B(t(n),a=>(c(),p("option",{value:a},y(a.title),9,oo))),256))],512),[[N,d.value.data]])]),_:1},8,["node-id","position"]),so,g(t(x),{id:`state.move_to_list.${o.id}`,type:"source",position:t(_).Bottom,style:f(t(l)),class:"handle"},{default:m(()=>[no]),_:1},8,["id","position","style"]),g(t(x),{id:`state.move_to_list.target.${o.id}`,type:"target",position:t(_).Top,style:f(t(i)),class:"handle"},{default:m(()=>[io]),_:1},8,["id","position","style"])]))}},ao={class:"vue-flow__node-input shadow-sm"},ro=["value"],co=b('<span class="action-box ps-2 justify-content-center"><span class="action-box__icon"><svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg></span> A/B Split </span>',1),po=e("span",{class:"circle"},null,-1),uo=e("span",{class:"circle"},null,-1),ho=e("span",{class:"circle"},null,-1),go={__name:"ABSplit",props:{id:String,label:String,type:String},setup(o){const s=o,i=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",top:"-7px"})),l=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",left:"48px",right:"auto",bottom:"-7px"})),n=w(()=>({backgroundColor:"white",borderColor:"#dcdbdb",borderStyle:"solid",borderWidth:"1px",width:"14px",height:"14px",right:"40px",left:"auto",bottom:"-7px"}));let u=window.abSplit;const{findNode:d}=M(),r=$(d(s.id));return(h,a)=>(c(),p("div",ao,[g(t(L),{style:{display:"flex",gap:"0.5rem","align-items":"center"},"is-visible":!0,"node-id":o.id,position:t(_).Right},{default:m(()=>[k(e("select",{name:"argument",class:"form-select","onUpdate:modelValue":a[0]||(a[0]=S=>r.value.data=S)},[(c(!0),p(C,null,B(t(u),S=>(c(),p("option",{value:S},y(S.title),9,ro))),256))],512),[[N,r.value.data]])]),_:1},8,["node-id","position"]),co,g(t(x),{id:`state.abSplit.target.${o.id}`,type:"target",position:t(_).Top,style:f(t(i)),class:"handle"},{default:m(()=>[po]),_:1},8,["id","position","style"]),g(t(x),{id:`state.abSplit.left.${o.id}`,type:"source",position:t(_).Bottom,style:f(t(l)),class:"handle"},{default:m(()=>[uo]),_:1},8,["id","position","style"]),g(t(x),{id:`state.abSplit.right.${o.id}`,type:"source",position:t(_).Bottom,style:f(t(n)),class:"handle"},{default:m(()=>[ho]),_:1},8,["id","position","style"])]))}};const mo={class:"col-lg-7 col-xl-8 col-xxl-9 pe-0"},_o={class:"d-flex gap-2"},yo=["href"],wo=e("svg",{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",stroke:"currentColor","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round",class:"feather feather-arrow-left-circle align-middle me-2"},[e("circle",{cx:"12",cy:"12",r:"10"}),e("polyline",{points:"12 8 8 12 12 16"}),e("line",{x1:"16",y1:"12",x2:"8",y2:"12"})],-1),fo={class:"h3 mb-3 px-4 py-2 bg-white"},xo={class:"d-flex gap-2"},bo={class:"d-flex align-items-center"},vo=e("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",stroke:"currentColor","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round",class:"feather feather-save align-middle me-2"},[e("path",{d:"M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"}),e("polyline",{points:"17 21 17 13 7 13 7 21"}),e("polyline",{points:"7 3 7 8 15 8"})],-1),ko={class:"col-lg-5 col-xl-4 col-xxl-3 px-0"},$o={__name:"WorkFlow",props:{workflowName:{type:String,default:"Untitled"},saveUrl:{type:String,default:"/automation/workflow/save"},elementsData:{type:Array,default:[]},messages:{type:Array,default:[{argument:3,action:"Message 3",title:"Message 3"}]},messagesOpened:{type:Array,default:[{argument:3,action:"Message 3",title:"Message 3"}]},stages:{type:Array,default:[{argument:"50/50",action:"ABSplit",title:"50/50"}]},tags:{type:Array,default:[{argument:"default",action:"default",title:"default",type:"default"}]},abSplit:{type:Array,default:[{argument:"50/50",action:"ABSplit",title:"50/50"}]},contactLists:{type:Array,default:[{argument:2,action:"contactList 2",title:"contactList 2"}]},waitOptions:{type:Array,default:[{argument:2,action:"contactList 2",title:"contactList 2"}]},backUrl:{type:String,default:"/"}},setup(o){const s=o,i={"condition.stage.changed":T(ft),"condition.message.opened":T(eo),"action.message.sent":T(St),"action.wait":T(Nt),"action.start":T(Rt),"action.add.tag":T(Gt),"action.move.to.list":T(lo),"action.ab.split":T(go)},l=$(s.elementsData),n=$(s.workflowName);let u=0;const d=()=>Math.floor(Math.random()*1e4+1)+`_${u++}`,{findNode:r,onConnect:h,nodes:a,edges:S,onNodeClick:cs,addEdges:X,addNodes:Y,viewport:ps,project:K,vueFlowRef:J}=M({nodes:[]});window.messages=s.messages,window.messagesOpened=s.messagesOpened,window.contactLists=s.contactLists,window.waitOptions=s.waitOptions,window.abSplit=s.abSplit,window.stages=s.stages,window.tags=s.tags;const Q=v=>{v.preventDefault(),v.dataTransfer&&(v.dataTransfer.dropEffect="move")};h(v=>X([v]));const Z=v=>{var R;const j=(R=v.dataTransfer)==null?void 0:R.getData("application/vueflow"),{left:A,top:te}=J.value.getBoundingClientRect(),oe=K({x:v.clientX-A,y:v.clientY-te}),U={id:d(),type:j,position:oe,label:`${j} node`};Y([U]),ie(()=>{const D=r(U.id),se=le(()=>D.dimensions,z=>{z.width>0&&z.height>0&&(D.position={x:D.position.x-D.dimensions.width/2,y:D.position.y-D.dimensions.height/2},se())},{deep:!0,flush:"post"})})},ee=function(){axios.post(s.saveUrl,{elements:l.value,title:n.value}).then(function(v){console.log(v),window.notyf.open({type:"success",message:"Workflow successfully saved!",duration:"5000",ripple:!0,dismissible:!0})}).catch(function(v){console.log(v),window.notyf.open({type:"warning",message:"Something went wrong!",duration:"5000",ripple:!0,dismissible:!0})})};return(v,j)=>(c(),p("div",{class:"row w-100 h-100 mx-0",onDrop:Z},[e("div",mo,[g(t(ne),{onDragover:Q,modelValue:l.value,"onUpdate:modelValue":j[1]||(j[1]=A=>l.value=A),"node-types":i},{default:m(()=>[g(t(ae)),g(t(q),null,{default:m(()=>[e("div",_o,[e("a",{class:"d-flex align-items-center h4 mb-3 px-4 py-2 text-white bg-info text-decoration-none",href:o.backUrl},[wo,e("span",null,y(v.$t("Back")),1)],8,yo),e("h1",fo,y(n.value),1)])]),_:1}),g(t(q),{position:t(de).BottomRight},{default:m(()=>[e("div",xo,[k(e("input",{type:"text",class:"form-control","onUpdate:modelValue":j[0]||(j[0]=A=>n.value=A),style:{"min-width":"200px"}},null,512),[[V,n.value]]),e("button",{class:"btn btn-success text-uppercase px-4",onClick:ee},[e("span",bo,[vo,W(" "+y(v.$t("Save")),1)])])])]),_:1},8,["position"])]),_:1},8,["modelValue"])]),e("div",ko,[g(ht)])],32))}};const So={class:"row p-3"},Co={class:"d-flex justify-content-between"},Bo=["onClick"],To=e("i",{class:"align-middle fas fa-fw fa-minus-circle"},null,-1),Mo=[To],jo=["onClick"],No=e("i",{class:"align-middle ms-2 fas fa-fw fa-plus-circle"},null,-1),Lo=[No],Do={class:"col-md-4"},Ao={class:"mb-3"},Vo=e("label",{for:"stage_name",class:"form-label"},"Stage name",-1),Eo=["name","onUpdate:modelValue"],Wo={class:"col-md-5"},Ho={class:"mb-3"},Oo=e("label",{for:"stage_description",class:"form-label"},"Stage description",-1),Uo=["name","onUpdate:modelValue"],Ro={class:"col-md-3"},zo={class:"d-flex flex-column mb-3"},qo=e("label",{for:"stage_color",class:"form-label"},"Stage color",-1),Fo={class:"d-flex align-items-center"},Io=["name","onUpdate:modelValue"],Po={class:"fs-4 ms-3"},Go=["name","value"],Xo={__name:"PipelineStageRepeater",props:{stages:{type:Array}},setup(o){const s=o,i=$([{name:"Default",description:"This is some description",color:"#366dc7"}]);H(()=>{s.stages.length&&(i.value=s.stages)});const l=()=>{i.value.push({name:"",description:"",color:"#366dc7"})},n=u=>{const d=i.value.indexOf(u);d>-1&&i.value.splice(d,1)};return(u,d)=>(c(),re(ce,{name:"stage-list",appear:""},{default:m(()=>[(c(!0),p(C,null,B(i.value,(r,h)=>(c(),p("div",{class:"d-flex flex-column bg-light mb-3 rounded-3",key:h},[e("div",So,[e("div",Co,[e("h6",null,"#"+y(h+1)+" - "+y(r.name),1),e("div",null,[k(e("button",{class:"btn text-danger btn-lg border-0 p-0",onClick:I(a=>n(r),["prevent"]),title:"Remove Stage"},Mo,8,Bo),[[F,h||!h&&i.value.length>1]]),k(e("button",{class:"btn text-info btn-lg border-0 p-0",title:"Add New Stage",onClick:I(l,["prevent"])},Lo,8,jo),[[F,h===i.value.length-1]])])]),e("div",Do,[e("div",Ao,[Vo,k(e("input",{class:"form-control",name:`pipeline_stages[${h}][name]`,placeholder:"Enter stage name",type:"text",id:"stage_name","onUpdate:modelValue":a=>r.name=a},null,8,Eo),[[V,r.name]])])]),e("div",Wo,[e("div",Ho,[Oo,k(e("input",{class:"form-control",name:`pipeline_stages[${h}][description]`,placeholder:"Enter stage description",type:"text",id:"stage_description","onUpdate:modelValue":a=>r.description=a},null,8,Uo),[[V,r.description]])])]),e("div",Ro,[e("div",zo,[qo,e("div",Fo,[k(e("input",{type:"color",name:`pipeline_stages[${h}][color]`,id:"stage_color","onUpdate:modelValue":a=>r.color=a,style:{height:"30px"}},null,8,Io),[[V,r.color]]),e("span",Po,y(r.color),1)])])]),e("input",{type:"hidden",name:`pipeline_stages[${h}][id]`,value:r.id},null,8,Go)])]))),128))]),_:1}))}};const Yo=(o,s)=>{const i=o.__vccOpts||o;for(const[l,n]of s)i[l]=n;return i},Ko={class:"mb-3 position-relative d-flex flex-column align-items-center"},Jo={for:"body",class:"form-label align-self-start"},Qo=["name"],Zo={class:"placeholder-buttons bg-light"},es={class:"d-flex gap-1"},ts={key:0,class:"invalid-feedback"},os={__name:"TextArea",props:{errorMessage:{type:String,required:!0},messageBody:{type:String},name:{type:String,required:!0}},setup(o){const s=o,i=$(""),l=$(null);H(()=>{i.value=s.messageBody});const n=(u,d)=>{u.preventDefault();const r=l.value,h=r.selectionStart,a=`[[${d}]]`;i.value=`${i.value.substring(0,h)} ${a}${i.value.substring(h)}`,r.focus()};return(u,d)=>(c(),p("div",Ko,[e("label",Jo,y(u.$t("Message Body")),1),k(e("textarea",{ref_key:"textarea",ref:l,"onUpdate:modelValue":d[0]||(d[0]=r=>i.value=r),name:o.name,id:"body",class:pe([{"is-invalid":o.errorMessage},"form-control"]),cols:"10",rows:"10"},`
         `,10,Qo),[[V,i.value]]),e("div",Zo,[e("span",null,y(u.$t("Add message placeholders"))+":",1),e("div",es,[e("button",{onClick:d[1]||(d[1]=r=>n(r,"firstname")),class:"btn btn-sm btn-info"},y(u.$t("Firstname")),1),e("button",{onClick:d[2]||(d[2]=r=>n(r,"lastname")),class:"btn btn-sm btn-info"},y(u.$t("Lastname")),1),e("button",{onClick:d[3]||(d[3]=r=>n(r,"email")),class:"btn btn-sm btn-info"},y(u.$t("Email")),1)])]),o.errorMessage?(c(),p("small",ts,y(o.errorMessage),1)):ue("",!0)]))}},ss=Yo(os,[["__scopeId","data-v-0c41e744"]]);const ns={class:"mb-3"},is={class:"d-block form-label"},ls=["name","value"],as={__name:"MultiSelectList",props:{selected:{type:Array},options:{type:Array,required:!0},name:{type:String},label:{type:String},placeholder:{type:String},labelBy:{type:String},trackBy:{type:String}},setup(o){const s=o,i=$([]);return H(()=>{s.selected.length&&(i.value=s.selected)}),(l,n)=>(c(),p("div",ns,[e("span",is,y(o.label),1),g(t(he),{modelValue:i.value,"onUpdate:modelValue":n[0]||(n[0]=u=>i.value=u),options:o.options,multiple:!0,"close-on-select":!1,placeholder:o.placeholder,label:o.labelBy,"track-by":o.trackBy},null,8,["modelValue","options","placeholder","label","track-by"]),(c(!0),p(C,null,B(i.value,u=>(c(),p("input",{type:"hidden",name:o.name,value:u.id,key:u.id},null,8,ls))),128))]))}};document.addEventListener("DOMContentLoaded",()=>{if(document.getElementsByClassName("js-simplebar")[0]){new ge(document.getElementsByClassName("js-simplebar")[0]);const s=document.getElementsByClassName("sidebar")[0];document.getElementsByClassName("sidebar-toggle")[0].addEventListener("click",()=>{s.classList.toggle("collapsed"),s.addEventListener("transitionend",()=>{window.dispatchEvent(new Event("resize"))})})}});document.addEventListener("DOMContentLoaded",()=>{P.replace()});window.feather=P;window.notyf=new me({duration:5e3,position:{x:"right",y:"top"},types:[{type:"default",backgroundColor:"#3B7DDD",icon:{className:"notyf__icon--success",tagName:"i"}},{type:"info-bsha",backgroundColor:"#495e69",icon:{className:"notyf__icon--success",tagName:"i"}},{type:"success",backgroundColor:"#28a745",icon:{className:"notyf__icon--success",tagName:"i"}},{type:"warning",backgroundColor:"#ffc107",icon:{className:"notyf__icon--error",tagName:"i"}},{type:"danger",backgroundColor:"#dc3545",icon:{className:"notyf__icon--error",tagName:"i"}}]});window.dragula=_e;window.jQuery=window.$=ye;const ds={de:We},G=we({locale:"de",fallbackLocale:"en",messages:ds});G.global.locale=document.documentElement.lang.substring(0,2);const rs=be(),O=fe({components:{WorkFlow:$o,PipelineStageRepeater:Xo,TextArea:ss,MultiSelectList:as}});O.config.globalProperties.emitter=rs;O.use(G);document.querySelector("#app")!==null&&O.mount("#app");window.DataTable=xe;
