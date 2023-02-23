import{a as T,o as u,c as h,b as e,d as g,e as d,u as n,j as f,Y as v,n as C,m as x,r as $,f as Q,w as S,_ as J,g as Z,h as ee,E as te,i as A,t as m,k as se,l as D,p as ne,T as oe,q as O,s as b,v as V,x as R,y as M,F as W,z as ae,A as ie,S as le,B as z,N as de,C as re,$ as ce,D as pe,G as ue,H as he,I as ge}from"./vendor-54f69326.js";let _e=document.head.querySelector('meta[name="csrf-token"]');T.defaults.headers.common["X-CSRF-TOKEN"]=_e.textContent;T.defaults.headers.common["X-Requested-With"]="XMLHttpRequest";window.axios=T;const me="Dashboard",fe="List",ve="Edit",we="Delete",ye="Remove",xe="Name",be="Description",ke="Count",$e="Speichern",Ce="Stornieren",Se="Vorname",Me="Nachname",Be="Email",Te={"Good day":"Guten Tag",Dashboard:me,"All Lists":"All Lists",List:fe,Edit:ve,Delete:we,Remove:ye,Name:xe,Description:be,Count:ke,Save:$e,Cancel:Ce,"Message Body":"Nachrichtentext",Firstname:Se,Lastname:Me,"Add message placeholders":"Nachrichtenplatzhalter hinzufügen",Email:Be};const De={class:"bg-light h-100 shadow-lg"},je=g('<h5 class="sidebar-heading py-3 px-2"><span class="d-flex align-items-center justify-content-center fw-lighter text-center"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move align-middle me-2"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>You can drag these nodes to the pane</span></h5>',1),Le={class:"d-flex flex-column gap-2"},Ee=g('<div class="bg-white shadow-sm px-3 py-2"><h6 class="mb-0"><span class="d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-git-pull-request align-middle me-2"><circle cx="18" cy="18" r="3"></circle><circle cx="6" cy="6" r="3"></circle><path d="M13 6h3a2 2 0 0 1 2 2v7"></path><line x1="6" y1="9" x2="6" y2="21"></line></svg> Conditions</span></h6></div>',1),Ne={class:"d-flex flex-wrap gap-2 align-items-center my-3 px-4"},Ae=g('<span class="condition-box pe-2 justify-content-end"><span class="condition-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw align-middle"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></span> Stage Changed</span>',1),Ve=[Ae],Re=g('<span class="condition-box pe-2 justify-content-end"><span class="condition-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw align-middle"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></span> Message Opened</span>',1),Oe=[Re],We=g('<div class="bg-white shadow-sm px-3 py-2"><h6 class="mb-0"><span class="d-flex align-items-center"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-repeat align-middle me-2"><polyline points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg> Actions</span></h6></div>',1),ze={class:"d-flex flex-wrap gap-4 align-items-center my-3 px-4"},Fe=g('<span class="action-box pe-2 justify-content-end"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail align-middle"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></span> Send Message </span>',1),Ue=[Fe],qe=g('<span class="action-box px-3 justify-content-center"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock align-middle"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></span> Wait </span>',1),Pe=[qe],He=g('<span class="action-box ps-2 justify-content-center"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag align-middle"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg></span> Add Tag </span>',1),Ge=[He],Ie=g('<span class="action-box ps-2 justify-content-center"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list align-middle"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg></span> Move To List </span>',1),Xe=[Ie],Ye={__name:"Sidebar",setup(s){const o=(t,i,a)=>{t.dataTransfer&&(t.dataTransfer.setData("application/vueflow",i),t.dataTransfer.effectAllowed="move")};return(t,i)=>(u(),h("aside",De,[je,e("div",Le,[Ee,e("div",Ne,[e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:i[0]||(i[0]=a=>o(a,"stageChanged"))},Ve,32),e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:i[1]||(i[1]=a=>o(a,"messageOpened"))},Oe,32)]),We,e("div",ze,[e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:i[2]||(i[2]=a=>o(a,"sendMessage"))},Ue,32),e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:i[3]||(i[3]=a=>o(a,"wait"))},Pe,32),e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:i[4]||(i[4]=a=>o(a,"addTag"))},Ge,32),e("div",{class:"vue-flow__node-input shadow-sm",draggable:!0,onDragstart:i[5]||(i[5]=a=>o(a,"moveToList"))},Xe,32)])])]))}},Ke={class:"vue-flow__node-input shadow-sm"},Qe=g('<span class="condition-box pe-2 justify-content-end"><span class="condition-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw align-middle"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></span> Stagge Changed</span>',1),Je={__name:"StageChanged",props:{id:String,label:String,type:String},setup(s){return(o,t)=>(u(),h("div",Ke,[Qe,d(n(v),{type:"source",position:n(f).Bottom},null,8,["position"])]))}},Ze={class:"vue-flow__node-input shadow-sm"},et=["data-handleid","data-nodeid"],tt=g('<span class="action-box pe-2 justify-content-end"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail align-middle"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></span> Send Message </span>',1),st={__name:"SendMessage",props:{id:String,label:String,type:String},setup(s){return(o,t)=>(u(),h("div",Ze,[e("div",{"data-handleid":`${s.id}__handle-top`,"data-nodeid":s.id,"data-handlepos":"top",class:C(`vue-flow__handle nodrag vue-flow__handle-top vue-flow__handle-${s.id}__handle-top target connectable`)},null,10,et),tt,d(n(v),{id:"source",type:"source",position:n(f).Bottom},null,8,["position"]),d(n(v),{id:"target",type:"target",position:n(f).Top},null,8,["position"])]))}},nt={class:"vue-flow__node-input shadow-sm"},ot=["data-handleid","data-nodeid"],at=g('<span class="action-box pe-2 justify-content-center"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock align-middle"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></span> Wait </span>',1),it={__name:"Wait",props:{id:String,label:String,type:String},setup(s){return(o,t)=>(u(),h("div",nt,[e("div",{"data-handleid":`${s.id}__handle-top`,"data-nodeid":s.id,"data-handlepos":"top",class:C(`vue-flow__handle nodrag vue-flow__handle-top vue-flow__handle-${s.id}__handle-top target connectable`)},null,10,ot),at,d(n(v),{type:"target",position:n(f).Top},null,8,["position"]),d(n(v),{type:"source",position:n(f).Bottom},null,8,["position"])]))}},lt={class:"vue-flow__node-input shadow-sm"},dt=["data-handleid","data-nodeid"],rt=g('<span class="action-box pe-2 justify-content-center"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag align-middle"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg></span> AddTag </span>',1),ct={__name:"AddTag",props:{id:String,label:String,type:String},setup(s){return(o,t)=>(u(),h("div",lt,[e("div",{"data-handleid":`${s.id}__handle-top`,"data-nodeid":s.id,"data-handlepos":"top",class:C(`vue-flow__handle nodrag vue-flow__handle-top vue-flow__handle-${s.id}__handle-top target connectable`)},null,10,dt),rt,d(n(v),{id:"source",type:"source",position:n(f).Bottom},null,8,["position"]),d(n(v),{id:"target",type:"target",position:n(f).Top},null,8,["position"])]))}};const pt={class:"vue-flow__node-input shadow-sm"},ut=g('<span class="condition-box pe-2 justify-content-end"><span class="condition-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw align-middle"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg></span> Message Opened</span>',1),ht={__name:"MessageOpened",props:{id:String,label:String,type:String},setup(s){return(o,t)=>(u(),h("div",pt,[ut,d(n(v),{type:"target",position:n(f).Top},null,8,["position"]),d(n(v),{id:"yes",type:"source",position:n(f).Bottom,class:"bottom-left"},null,8,["position"]),d(n(v),{id:"no",type:"source",position:n(f).Bottom,class:"bottom-right"},null,8,["position"])]))}},gt={class:"vue-flow__node-input shadow-sm"},_t=["data-handleid","data-nodeid"],mt=g('<span class="action-box pe-2 justify-content-center"><span class="action-box__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list align-middle"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg></span> Move To List </span>',1),ft={__name:"MoveToList",props:{id:String,label:String,type:String},setup(s){return(o,t)=>(u(),h("div",gt,[e("div",{"data-handleid":`${s.id}__handle-top`,"data-nodeid":s.id,"data-handlepos":"top",class:C(`vue-flow__handle nodrag vue-flow__handle-top vue-flow__handle-${s.id}__handle-top target connectable`)},null,10,_t),mt,d(n(v),{id:"source",type:"source",position:n(f).Bottom},null,8,["position"]),d(n(v),{id:"target",type:"target",position:n(f).Top},null,8,["position"])]))}},vt={class:"col-lg-7 col-xl-8 col-xxl-9 pe-0"},wt={class:"h3 mb-3 px-4 py-2 bg-white"},yt={class:"btn btn-danger"},xt={class:"col-lg-5 col-xl-4 col-xxl-3 px-0"},bt={__name:"WorkFlow",props:{panelTitle:{type:String,default:"Workflow"}},setup(s){const o={stageChanged:x(Je),sendMessage:x(st),wait:x(it),addTag:x(ct),moveToList:x(ft),messageOpened:x(ht)},t=$([{id:"1",type:"stageChanged",label:"Stage Changed",position:{x:350,y:100}},{id:"2",type:"wait",label:"Wait",position:{x:350,y:180}},{id:"3",type:"sendMessage",label:"Send Message",position:{x:350,y:260}},{id:"4",type:"addTag",label:"Add Tag",position:{x:350,y:340}},{id:"5",type:"moveToList",label:"Move to list",position:{x:350,y:420}},{id:"e1-2",source:"1",target:"2"},{id:"e2-3",source:"2",target:"3"},{id:"e3-4",source:"3",target:"4"},{id:"e4-5",source:"4",target:"5"}]);let i=0;const a=()=>`dndnode_${i++}`,{findNode:c,onConnect:r,nodes:l,edges:_,addEdges:w,addNodes:U,viewport:ls,project:q,vueFlowRef:P}=Q({nodes:[]}),H=p=>{p.preventDefault(),p.dataTransfer&&(p.dataTransfer.dropEffect="move")};r(p=>w([p]));const G=p=>{var E;const k=(E=p.dataTransfer)==null?void 0:E.getData("application/vueflow"),{left:B,top:X}=P.value.getBoundingClientRect(),Y=q({x:p.clientX-B,y:p.clientY-X}),L={id:a(),type:k,position:Y,label:`${k} node`};U([L]),Z(()=>{const y=c(L.id),K=ee(()=>y.dimensions,N=>{N.width>0&&N.height>0&&(y.position={x:y.position.x-y.dimensions.width/2,y:y.position.y-y.dimensions.height/2},K())},{deep:!0,flush:"post"})})},I=function(){axios.post("/workflow/save",{elements:t.value}).then(function(p){console.log(p)}).catch(function(p){console.log(p)}),console.log(t.value),alert("Workflow saved")};return(p,k)=>(u(),h("div",{class:"row w-100 h-100 mx-0",onDrop:G},[e("div",vt,[d(n(J),{onDragover:H,modelValue:t.value,"onUpdate:modelValue":k[0]||(k[0]=B=>t.value=B),"node-types":o},{default:S(()=>[d(n(te)),d(n(A),null,{default:S(()=>[e("h1",wt,m(s.panelTitle),1)]),_:1}),d(n(A),{position:n(se).BottomRight},{default:S(()=>[e("button",{class:"btn btn-success me-2",onClick:I},m(p.$t("Save")),1),e("button",yt,m(p.$t("Cancel")),1)]),_:1},8,["position"])]),_:1},8,["modelValue"])]),e("div",xt,[d(Ye)])],32))}};const kt={class:"row p-3"},$t={class:"d-flex justify-content-between"},Ct=["onClick"],St=e("i",{class:"align-middle fas fa-fw fa-minus-circle"},null,-1),Mt=[St],Bt=["onClick"],Tt=e("i",{class:"align-middle ms-2 fas fa-fw fa-plus-circle"},null,-1),Dt=[Tt],jt={class:"col-md-4"},Lt={class:"mb-3"},Et=e("label",{for:"stage_name",class:"form-label"},"Stage name",-1),Nt=["name","onUpdate:modelValue"],At={class:"col-md-5"},Vt={class:"mb-3"},Rt=e("label",{for:"stage_description",class:"form-label"},"Stage description",-1),Ot=["name","onUpdate:modelValue"],Wt={class:"col-md-3"},zt={class:"d-flex flex-column mb-3"},Ft=e("label",{for:"stage_color",class:"form-label"},"Stage color",-1),Ut={class:"d-flex align-items-center"},qt=["name","onUpdate:modelValue"],Pt={class:"fs-4 ms-3"},Ht=["name","value"],Gt={__name:"PipelineStageRepeater",props:{stages:{type:Array}},setup(s){const o=s,t=$([{name:"Default",description:"This is some description",color:"#366dc7"}]);D(()=>{o.stages.length&&(t.value=o.stages)});const i=()=>{t.value.push({name:"",description:"",color:"#366dc7"})},a=c=>{const r=t.value.indexOf(c);r>-1&&t.value.splice(r,1)};return(c,r)=>(u(),ne(oe,{name:"stage-list",appear:""},{default:S(()=>[(u(!0),h(W,null,O(t.value,(l,_)=>(u(),h("div",{class:"d-flex flex-column bg-light mb-3 rounded-3",key:_},[e("div",kt,[e("div",$t,[e("h6",null,"#"+m(_+1)+" - "+m(l.name),1),e("div",null,[b(e("button",{class:"btn text-danger btn-lg border-0 p-0",onClick:R(w=>a(l),["prevent"]),title:"Remove Stage"},Mt,8,Ct),[[V,_||!_&&t.value.length>1]]),b(e("button",{class:"btn text-info btn-lg border-0 p-0",title:"Add New Stage",onClick:R(i,["prevent"])},Dt,8,Bt),[[V,_===t.value.length-1]])])]),e("div",jt,[e("div",Lt,[Et,b(e("input",{class:"form-control",name:`pipeline_stages[${_}][name]`,placeholder:"Enter stage name",type:"text",id:"stage_name","onUpdate:modelValue":w=>l.name=w},null,8,Nt),[[M,l.name]])])]),e("div",At,[e("div",Vt,[Rt,b(e("input",{class:"form-control",name:`pipeline_stages[${_}][description]`,placeholder:"Enter stage description",type:"text",id:"stage_description","onUpdate:modelValue":w=>l.description=w},null,8,Ot),[[M,l.description]])])]),e("div",Wt,[e("div",zt,[Ft,e("div",Ut,[b(e("input",{type:"color",name:`pipeline_stages[${_}][color]`,id:"stage_color","onUpdate:modelValue":w=>l.color=w,style:{height:"30px"}},null,8,qt),[[M,l.color]]),e("span",Pt,m(l.color),1)])])]),e("input",{type:"hidden",name:`pipeline_stages[${_}][id]`,value:l.id},null,8,Ht)])]))),128))]),_:1}))}};const It=(s,o)=>{const t=s.__vccOpts||s;for(const[i,a]of o)t[i]=a;return t},Xt={class:"mb-3 position-relative d-flex flex-column align-items-center"},Yt={for:"body",class:"form-label align-self-start"},Kt=["name"],Qt={class:"placeholder-buttons bg-light"},Jt={class:"d-flex gap-1"},Zt={key:0,class:"invalid-feedback"},es={__name:"TextArea",props:{errorMessage:{type:String,required:!0},messageBody:{type:String},name:{type:String,required:!0}},setup(s){const o=s,t=$(""),i=$(null);D(()=>{t.value=o.messageBody});const a=(c,r)=>{c.preventDefault();const l=i.value,_=l.selectionStart,w=`[[${r}]]`;t.value=`${t.value.substring(0,_)} ${w}${t.value.substring(_)}`,l.focus()};return(c,r)=>(u(),h("div",Xt,[e("label",Yt,m(c.$t("Message Body")),1),b(e("textarea",{ref_key:"textarea",ref:i,"onUpdate:modelValue":r[0]||(r[0]=l=>t.value=l),name:s.name,id:"body",class:C([{"is-invalid":s.errorMessage},"form-control"]),cols:"10",rows:"10"},`
         `,10,Kt),[[M,t.value]]),e("div",Qt,[e("span",null,m(c.$t("Add message placeholders"))+":",1),e("div",Jt,[e("button",{onClick:r[1]||(r[1]=l=>a(l,"firstname")),class:"btn btn-sm btn-info"},m(c.$t("Firstname")),1),e("button",{onClick:r[2]||(r[2]=l=>a(l,"lastname")),class:"btn btn-sm btn-info"},m(c.$t("Lastname")),1),e("button",{onClick:r[3]||(r[3]=l=>a(l,"email")),class:"btn btn-sm btn-info"},m(c.$t("Email")),1)])]),s.errorMessage?(u(),h("small",Zt,m(s.errorMessage),1)):ae("",!0)]))}},ts=It(es,[["__scopeId","data-v-0c41e744"]]);const ss=e("label",{class:"typo__label"},"Select assignees",-1),ns=["value"],os={__name:"AssigneeListMultiselect",props:{assignees:{type:Array},users:{type:Array}},setup(s){const o=s,t=$([]);return D(()=>{o.assignees.length&&(t.value=o.assignees)}),(i,a)=>(u(),h("div",null,[ss,d(n(ie),{modelValue:t.value,"onUpdate:modelValue":a[0]||(a[0]=c=>t.value=c),options:s.users,multiple:!0,"close-on-select":!0,placeholder:"Pick some",label:"email","track-by":"email"},null,8,["modelValue","options"]),(u(!0),h(W,null,O(t.value,(c,r)=>(u(),h("input",{type:"hidden",name:"assignees[]",value:c.id},null,8,ns))),256))]))}};document.addEventListener("DOMContentLoaded",()=>{if(document.getElementsByClassName("js-simplebar")[0]){new le(document.getElementsByClassName("js-simplebar")[0]);const o=document.getElementsByClassName("sidebar")[0];document.getElementsByClassName("sidebar-toggle")[0].addEventListener("click",()=>{o.classList.toggle("collapsed"),o.addEventListener("transitionend",()=>{window.dispatchEvent(new Event("resize"))})})}});document.addEventListener("DOMContentLoaded",()=>{z.replace()});window.feather=z;window.notyf=new de({duration:5e3,position:{x:"right",y:"top"},types:[{type:"default",backgroundColor:"#3B7DDD",icon:{className:"notyf__icon--success",tagName:"i"}},{type:"info-bsha",backgroundColor:"#495e69",icon:{className:"notyf__icon--success",tagName:"i"}},{type:"success",backgroundColor:"#28a745",icon:{className:"notyf__icon--success",tagName:"i"}},{type:"warning",backgroundColor:"#ffc107",icon:{className:"notyf__icon--error",tagName:"i"}},{type:"danger",backgroundColor:"#dc3545",icon:{className:"notyf__icon--error",tagName:"i"}}]});window.dragula=re;window.jQuery=window.$=ce;const as={de:Te},F=pe({locale:"de",fallbackLocale:"en",messages:as});F.global.locale=document.documentElement.lang.substring(0,2);const is=ge(),j=ue({components:{WorkFlow:bt,PipelineStageRepeater:Gt,TextArea:ts,AssigneeListMultiselect:os}});j.config.globalProperties.emitter=is;j.use(F);document.querySelector("#app")!==null&&j.mount("#app");window.DataTable=he;
