import{o as e,c as t,ac as s,a0 as o,ad as i,ae as l,b as n,F as a,G as r,e as d,t as c,D as p,af as h,m as u,L as m,ag as f,H as g,U as b,a as y,w as v,d as O,n as w,K as _,s as S,u as V,I as $,J as x,f as C,ah as L}from"./app-30e0783b.js";import{d as k}from"./v-money3-eb747145.js";var D=Object.defineProperty,A=Object.defineProperties,B=Object.getOwnPropertyDescriptors,T=Object.getOwnPropertySymbols,F=Object.prototype.hasOwnProperty,P=Object.prototype.propertyIsEnumerable,M=(e,t,s)=>t in e?D(e,t,{enumerable:!0,configurable:!0,writable:!0,value:s}):e[t]=s,U=(e,t)=>{for(var s in t||(t={}))F.call(t,s)&&M(e,s,t[s]);if(T)for(var s of T(t))P.call(t,s)&&M(e,s,t[s]);return e},E=(e,t)=>A(e,B(t));const j={props:{autoscroll:{type:Boolean,default:!0}},watch:{typeAheadPointer(){this.autoscroll&&this.maybeAdjustScroll()},open(e){this.autoscroll&&e&&this.$nextTick((()=>this.maybeAdjustScroll()))}},methods:{maybeAdjustScroll(){var e;const t=(null==(e=this.$refs.dropdownMenu)?void 0:e.children[this.typeAheadPointer])||!1;if(t){const e=this.getDropdownViewport(),{top:s,bottom:o,height:i}=t.getBoundingClientRect();if(s<e.top)return this.$refs.dropdownMenu.scrollTop=t.offsetTop;if(o>e.bottom)return this.$refs.dropdownMenu.scrollTop=t.offsetTop-(e.height-i)}},getDropdownViewport(){return this.$refs.dropdownMenu?this.$refs.dropdownMenu.getBoundingClientRect():{height:0,top:0,bottom:0}}}},I={data:()=>({typeAheadPointer:-1}),watch:{filteredOptions(){for(let e=0;e<this.filteredOptions.length;e++)if(this.selectable(this.filteredOptions[e])){this.typeAheadPointer=e;break}},open(e){e&&this.typeAheadToLastSelected()},selectedValue(){this.open&&this.typeAheadToLastSelected()}},methods:{typeAheadUp(){for(let e=this.typeAheadPointer-1;e>=0;e--)if(this.selectable(this.filteredOptions[e])){this.typeAheadPointer=e;break}},typeAheadDown(){for(let e=this.typeAheadPointer+1;e<this.filteredOptions.length;e++)if(this.selectable(this.filteredOptions[e])){this.typeAheadPointer=e;break}},typeAheadSelect(){const e=this.filteredOptions[this.typeAheadPointer];e&&this.selectable(e)&&this.select(e)},typeAheadToLastSelected(){this.typeAheadPointer=0!==this.selectedValue.length?this.filteredOptions.indexOf(this.selectedValue[this.selectedValue.length-1]):-1}}},K={props:{loading:{type:Boolean,default:!1}},data:()=>({mutableLoading:!1}),watch:{search(){this.$emit("search",this.search,this.toggleLoading)},loading(e){this.mutableLoading=e}},methods:{toggleLoading(e=null){return this.mutableLoading=null==e?!this.mutableLoading:e}}},R=(e,t)=>{const s=e.__vccOpts||e;for(const[o,i]of t)s[o]=i;return s},H={},N={xmlns:"http://www.w3.org/2000/svg",width:"10",height:"10"},q=[n("path",{d:"M6.895455 5l2.842897-2.842898c.348864-.348863.348864-.914488 0-1.263636L9.106534.261648c-.348864-.348864-.914489-.348864-1.263636 0L5 3.104545 2.157102.261648c-.348863-.348864-.914488-.348864-1.263636 0L.261648.893466c-.348864.348864-.348864.914489 0 1.263636L3.104545 5 .261648 7.842898c-.348864.348863-.348864.914488 0 1.263636l.631818.631818c.348864.348864.914773.348864 1.263636 0L5 6.895455l2.842898 2.842897c.348863.348864.914772.348864 1.263636 0l.631818-.631818c.348864-.348864.348864-.914489 0-1.263636L6.895455 5z"},null,-1)];const z=R(H,[["render",function(s,o){return e(),t("svg",N,q)}]]),J={},Q={xmlns:"http://www.w3.org/2000/svg",width:"14",height:"10"},X=[n("path",{d:"M9.211364 7.59931l4.48338-4.867229c.407008-.441854.407008-1.158247 0-1.60046l-.73712-.80023c-.407008-.441854-1.066904-.441854-1.474243 0L7 5.198617 2.51662.33139c-.407008-.441853-1.066904-.441853-1.474243 0l-.737121.80023c-.407008.441854-.407008 1.158248 0 1.600461l4.48338 4.867228L7 10l2.211364-2.40069z"},null,-1)];const Y={Deselect:z,OpenIndicator:R(J,[["render",function(s,o){return e(),t("svg",Q,X)}]])},G={mounted(e,{instance:t}){if(t.appendToBody){const{height:s,top:o,left:i,width:l}=t.$refs.toggle.getBoundingClientRect();let n=window.scrollX||window.pageXOffset,a=window.scrollY||window.pageYOffset;e.unbindPosition=t.calculatePosition(e,t,{width:l+"px",left:n+i+"px",top:a+o+s+"px"}),document.body.appendChild(e)}},unmounted(e,{instance:t}){t.appendToBody&&(e.unbindPosition&&"function"==typeof e.unbindPosition&&e.unbindPosition(),e.parentNode&&e.parentNode.removeChild(e))}};let W=0;const Z={components:U({},Y),directives:{appendToBody:G},mixins:[j,I,K],compatConfig:{MODE:3},emits:["open","close","update:modelValue","search","search:compositionstart","search:compositionend","search:keydown","search:blur","search:focus","search:input","option:created","option:selecting","option:selected","option:deselecting","option:deselected"],props:{modelValue:{},components:{type:Object,default:()=>({})},options:{type:Array,default:()=>[]},disabled:{type:Boolean,default:!1},clearable:{type:Boolean,default:!0},deselectFromDropdown:{type:Boolean,default:!1},searchable:{type:Boolean,default:!0},multiple:{type:Boolean,default:!1},placeholder:{type:String,default:""},transition:{type:String,default:"vs__fade"},clearSearchOnSelect:{type:Boolean,default:!0},closeOnSelect:{type:Boolean,default:!0},label:{type:String,default:"label"},autocomplete:{type:String,default:"off"},reduce:{type:Function,default:e=>e},selectable:{type:Function,default:e=>!0},getOptionLabel:{type:Function,default(e){return"object"==typeof e?e.hasOwnProperty(this.label)?e[this.label]:console.warn(`[vue-select warn]: Label key "option.${this.label}" does not exist in options object ${JSON.stringify(e)}.\nhttps://vue-select.org/api/props.html#getoptionlabel`):e}},getOptionKey:{type:Function,default(e){if("object"!=typeof e)return e;try{return e.hasOwnProperty("id")?e.id:function(e){const t={};return Object.keys(e).sort().forEach((s=>{t[s]=e[s]})),JSON.stringify(t)}(e)}catch(t){return console.warn("[vue-select warn]: Could not stringify this option to generate unique key. Please provide'getOptionKey' prop to return a unique key for each option.\nhttps://vue-select.org/api/props.html#getoptionkey",e,t)}}},onTab:{type:Function,default:function(){this.selectOnTab&&!this.isComposing&&this.typeAheadSelect()}},taggable:{type:Boolean,default:!1},tabindex:{type:Number,default:null},pushTags:{type:Boolean,default:!1},filterable:{type:Boolean,default:!0},filterBy:{type:Function,default:(e,t,s)=>(t||"").toLocaleLowerCase().indexOf(s.toLocaleLowerCase())>-1},filter:{type:Function,default(e,t){return e.filter((e=>{let s=this.getOptionLabel(e);return"number"==typeof s&&(s=s.toString()),this.filterBy(e,s,t)}))}},createOption:{type:Function,default(e){return"object"==typeof this.optionList[0]?{[this.label]:e}:e}},resetOnOptionsChange:{default:!1,validator:e=>["function","boolean"].includes(typeof e)},clearSearchOnBlur:{type:Function,default:function({clearSearchOnSelect:e,multiple:t}){return e&&!t}},noDrop:{type:Boolean,default:!1},inputId:{type:String},dir:{type:String,default:"auto"},selectOnTab:{type:Boolean,default:!1},selectOnKeyCodes:{type:Array,default:()=>[13]},searchInputQuerySelector:{type:String,default:"[type=search]"},mapKeydown:{type:Function,default:(e,t)=>e},appendToBody:{type:Boolean,default:!1},calculatePosition:{type:Function,default(e,t,{width:s,top:o,left:i}){e.style.top=o,e.style.left=i,e.style.width=s}},dropdownShouldOpen:{type:Function,default:({noDrop:e,open:t,mutableLoading:s})=>!e&&(t&&!s)},uid:{type:[String,Number],default:()=>++W}},data:()=>({search:"",open:!1,isComposing:!1,pushedTags:[],_value:[],deselectButtons:[]}),computed:{isReducingValues(){return this.$props.reduce!==this.$options.props.reduce.default},isTrackingValues(){return void 0===this.modelValue||this.isReducingValues},selectedValue(){let e=this.modelValue;return this.isTrackingValues&&(e=this.$data._value),null!=e&&""!==e?[].concat(e):[]},optionList(){return this.options.concat(this.pushTags?this.pushedTags:[])},searchEl(){return this.$slots.search?this.$refs.selectedOptions.querySelector(this.searchInputQuerySelector):this.$refs.search},scope(){const e={search:this.search,loading:this.loading,searching:this.searching,filteredOptions:this.filteredOptions};return{search:{attributes:U({disabled:this.disabled,placeholder:this.searchPlaceholder,tabindex:this.tabindex,readonly:!this.searchable,id:this.inputId,"aria-autocomplete":"list","aria-labelledby":`vs${this.uid}__combobox`,"aria-controls":`vs${this.uid}__listbox`,ref:"search",type:"search",autocomplete:this.autocomplete,value:this.search},this.dropdownOpen&&this.filteredOptions[this.typeAheadPointer]?{"aria-activedescendant":`vs${this.uid}__option-${this.typeAheadPointer}`}:{}),events:{compositionstart:()=>this.isComposing=!0,compositionend:()=>this.isComposing=!1,keydown:this.onSearchKeyDown,blur:this.onSearchBlur,focus:this.onSearchFocus,input:e=>this.search=e.target.value}},spinner:{loading:this.mutableLoading},noOptions:{search:this.search,loading:this.mutableLoading,searching:this.searching},openIndicator:{attributes:{ref:"openIndicator",role:"presentation",class:"vs__open-indicator"}},listHeader:e,listFooter:e,header:E(U({},e),{deselect:this.deselect}),footer:E(U({},e),{deselect:this.deselect})}},childComponents(){return U(U({},Y),this.components)},stateClasses(){return{"vs--open":this.dropdownOpen,"vs--single":!this.multiple,"vs--multiple":this.multiple,"vs--searching":this.searching&&!this.noDrop,"vs--searchable":this.searchable&&!this.noDrop,"vs--unsearchable":!this.searchable,"vs--loading":this.mutableLoading,"vs--disabled":this.disabled}},searching(){return!!this.search},dropdownOpen(){return this.dropdownShouldOpen(this)},searchPlaceholder(){return this.isValueEmpty&&this.placeholder?this.placeholder:void 0},filteredOptions(){const e=[].concat(this.optionList);if(!this.filterable&&!this.taggable)return e;const t=this.search.length?this.filter(e,this.search,this):e;if(this.taggable&&this.search.length){const e=this.createOption(this.search);this.optionExists(e)||t.unshift(e)}return t},isValueEmpty(){return 0===this.selectedValue.length},showClearButton(){return!this.multiple&&this.clearable&&!this.open&&!this.isValueEmpty}},watch:{options(e,t){!this.taggable&&(()=>"function"==typeof this.resetOnOptionsChange?this.resetOnOptionsChange(e,t,this.selectedValue):this.resetOnOptionsChange)()&&this.clearSelection(),this.modelValue&&this.isTrackingValues&&this.setInternalValueFromOptions(this.modelValue)},modelValue:{immediate:!0,handler(e){this.isTrackingValues&&this.setInternalValueFromOptions(e)}},multiple(){this.clearSelection()},open(e){this.$emit(e?"open":"close")}},created(){this.mutableLoading=this.loading},methods:{setInternalValueFromOptions(e){Array.isArray(e)?this.$data._value=e.map((e=>this.findOptionFromReducedValue(e))):this.$data._value=this.findOptionFromReducedValue(e)},select(e){this.$emit("option:selecting",e),this.isOptionSelected(e)?this.deselectFromDropdown&&(this.clearable||this.multiple&&this.selectedValue.length>1)&&this.deselect(e):(this.taggable&&!this.optionExists(e)&&(this.$emit("option:created",e),this.pushTag(e)),this.multiple&&(e=this.selectedValue.concat(e)),this.updateValue(e),this.$emit("option:selected",e)),this.onAfterSelect(e)},deselect(e){this.$emit("option:deselecting",e),this.updateValue(this.selectedValue.filter((t=>!this.optionComparator(t,e)))),this.$emit("option:deselected",e)},clearSelection(){this.updateValue(this.multiple?[]:null)},onAfterSelect(e){this.closeOnSelect&&(this.open=!this.open,this.searchEl.blur()),this.clearSearchOnSelect&&(this.search="")},updateValue(e){void 0===this.modelValue&&(this.$data._value=e),null!==e&&(e=Array.isArray(e)?e.map((e=>this.reduce(e))):this.reduce(e)),this.$emit("update:modelValue",e)},toggleDropdown(e){const t=e.target!==this.searchEl;t&&e.preventDefault();const s=[...this.deselectButtons||[],this.$refs.clearButton];void 0===this.searchEl||s.filter(Boolean).some((t=>t.contains(e.target)||t===e.target))?e.preventDefault():this.open&&t?this.searchEl.blur():this.disabled||(this.open=!0,this.searchEl.focus())},isOptionSelected(e){return this.selectedValue.some((t=>this.optionComparator(t,e)))},isOptionDeselectable(e){return this.isOptionSelected(e)&&this.deselectFromDropdown},optionComparator(e,t){return this.getOptionKey(e)===this.getOptionKey(t)},findOptionFromReducedValue(e){const t=[...this.options,...this.pushedTags].filter((t=>JSON.stringify(this.reduce(t))===JSON.stringify(e)));return 1===t.length?t[0]:t.find((e=>this.optionComparator(e,this.$data._value)))||e},closeSearchOptions(){this.open=!1,this.$emit("search:blur")},maybeDeleteValue(){if(!this.searchEl.value.length&&this.selectedValue&&this.selectedValue.length&&this.clearable){let e=null;this.multiple&&(e=[...this.selectedValue.slice(0,this.selectedValue.length-1)]),this.updateValue(e)}},optionExists(e){return this.optionList.some((t=>this.optionComparator(t,e)))},normalizeOptionForSlot(e){return"object"==typeof e?e:{[this.label]:e}},pushTag(e){this.pushedTags.push(e)},onEscape(){this.search.length?this.search="":this.searchEl.blur()},onSearchBlur(){if(!this.mousedown||this.searching){const{clearSearchOnSelect:e,multiple:t}=this;return this.clearSearchOnBlur({clearSearchOnSelect:e,multiple:t})&&(this.search=""),void this.closeSearchOptions()}this.mousedown=!1,0!==this.search.length||0!==this.options.length||this.closeSearchOptions()},onSearchFocus(){this.open=!0,this.$emit("search:focus")},onMousedown(){this.mousedown=!0},onMouseUp(){this.mousedown=!1},onSearchKeyDown(e){const t=e=>(e.preventDefault(),!this.isComposing&&this.typeAheadSelect()),s={8:e=>this.maybeDeleteValue(),9:e=>this.onTab(),27:e=>this.onEscape(),38:e=>(e.preventDefault(),this.typeAheadUp()),40:e=>(e.preventDefault(),this.typeAheadDown())};this.selectOnKeyCodes.forEach((e=>s[e]=t));const o=this.mapKeydown(s,this);if("function"==typeof o[e.keyCode])return o[e.keyCode](e)}}},ee=["dir"],te=["id","aria-expanded","aria-owns"],se={ref:"selectedOptions",class:"vs__selected-options"},oe=["disabled","title","aria-label","onClick"],ie={ref:"actions",class:"vs__actions"},le=["disabled"],ne={class:"vs__spinner"},ae=["id"],re=["id","aria-selected","onMouseover","onClick"],de={key:0,class:"vs__no-options"},ce=d(" Sorry, no matching options. "),pe=["id"];const he=R(Z,[["render",function(S,V,$,x,C,L){const k=s("append-to-body");return e(),t("div",{dir:$.dir,class:w(["v-select",L.stateClasses])},[o(S.$slots,"header",i(l(L.scope.header))),n("div",{id:`vs${$.uid}__combobox`,ref:"toggle",class:"vs__dropdown-toggle",role:"combobox","aria-expanded":L.dropdownOpen.toString(),"aria-owns":`vs${$.uid}__listbox`,"aria-label":"Search for option",onMousedown:V[1]||(V[1]=e=>L.toggleDropdown(e))},[n("div",se,[(e(!0),t(a,null,r(L.selectedValue,((s,n)=>o(S.$slots,"selected-option-container",{option:L.normalizeOptionForSlot(s),deselect:L.deselect,multiple:$.multiple,disabled:$.disabled},(()=>[(e(),t("span",{key:$.getOptionKey(s),class:"vs__selected"},[o(S.$slots,"selected-option",i(l(L.normalizeOptionForSlot(s))),(()=>[d(c($.getOptionLabel(s)),1)])),$.multiple?(e(),t("button",{key:0,ref_for:!0,ref:e=>C.deselectButtons[n]=e,disabled:$.disabled,type:"button",class:"vs__deselect",title:`Deselect ${$.getOptionLabel(s)}`,"aria-label":`Deselect ${$.getOptionLabel(s)}`,onClick:e=>L.deselect(s)},[(e(),p(h(L.childComponents.Deselect)))],8,oe)):u("",!0)]))])))),256)),o(S.$slots,"search",i(l(L.scope.search)),(()=>[n("input",m({class:"vs__search"},L.scope.search.attributes,f(L.scope.search.events)),null,16)]))],512),n("div",ie,[g(n("button",{ref:"clearButton",disabled:$.disabled,type:"button",class:"vs__clear",title:"Clear Selected","aria-label":"Clear Selected",onClick:V[0]||(V[0]=(...e)=>L.clearSelection&&L.clearSelection(...e))},[(e(),p(h(L.childComponents.Deselect)))],8,le),[[b,L.showClearButton]]),o(S.$slots,"open-indicator",i(l(L.scope.openIndicator)),(()=>[$.noDrop?u("",!0):(e(),p(h(L.childComponents.OpenIndicator),i(m({key:0},L.scope.openIndicator.attributes)),null,16))])),o(S.$slots,"spinner",i(l(L.scope.spinner)),(()=>[g(n("div",ne,"Loading...",512),[[b,S.mutableLoading]])]))],512)],40,te),y(_,{name:$.transition},{default:v((()=>[L.dropdownOpen?g((e(),t("ul",{id:`vs${$.uid}__listbox`,ref:"dropdownMenu",key:`vs${$.uid}__listbox`,class:"vs__dropdown-menu",role:"listbox",tabindex:"-1",onMousedown:V[2]||(V[2]=O(((...e)=>L.onMousedown&&L.onMousedown(...e)),["prevent"])),onMouseup:V[3]||(V[3]=(...e)=>L.onMouseUp&&L.onMouseUp(...e))},[o(S.$slots,"list-header",i(l(L.scope.listHeader))),(e(!0),t(a,null,r(L.filteredOptions,((s,n)=>(e(),t("li",{id:`vs${$.uid}__option-${n}`,key:$.getOptionKey(s),role:"option",class:w(["vs__dropdown-option",{"vs__dropdown-option--deselect":L.isOptionDeselectable(s)&&n===S.typeAheadPointer,"vs__dropdown-option--selected":L.isOptionSelected(s),"vs__dropdown-option--highlight":n===S.typeAheadPointer,"vs__dropdown-option--disabled":!$.selectable(s)}]),"aria-selected":n===S.typeAheadPointer||null,onMouseover:e=>$.selectable(s)?S.typeAheadPointer=n:null,onClick:O((e=>$.selectable(s)?L.select(s):null),["prevent","stop"])},[o(S.$slots,"option",i(l(L.normalizeOptionForSlot(s))),(()=>[d(c($.getOptionLabel(s)),1)]))],42,re)))),128)),0===L.filteredOptions.length?(e(),t("li",de,[o(S.$slots,"no-options",i(l(L.scope.noOptions)),(()=>[ce]))])):u("",!0),o(S.$slots,"list-footer",i(l(L.scope.listFooter)))],40,ae)),[[k]]):(e(),t("ul",{key:1,id:`vs${$.uid}__listbox`,role:"listbox",style:{display:"none",visibility:"hidden"}},null,8,pe))])),_:3},8,["name"]),o(S.$slots,"footer",i(l(L.scope.footer)))],10,ee)}]]),ue={class:"row g-2"},me={class:"col-lg-12"},fe=n("label",{for:"department",class:"form-label"},"Department",-1),ge=["value"],be={class:"col-lg-6"},ye=n("label",{for:"code",class:"form-label"},"Code",-1),ve={class:"col-lg-6"},Oe=n("label",{for:"name",class:"form-label"},"Name",-1),we={class:"col-lg-12"},_e={class:"table table-sm table-bordered table-hover table-nowrap"},Se={class:"table-light"},Ve={class:"align-middle text-center",rowspan:"2"},$e={href:"#"},xe=n("th",{class:"align-middle text-center",width:"50",rowspan:"2"},"Step",-1),Ce=n("th",{class:"align-middle text-center",rowspan:"2"},"User",-1),Le=n("th",{class:"align-middle text-center",colspan:"2"},"Range",-1),ke=n("th",{class:"align-middle text-center",rowspan:"2"},"Description",-1),De=n("tr",null,[n("th",{class:"text-center",width:"120"},"From"),n("th",{class:"text-center",width:"120"},"To")],-1),Ae={class:"text-center align-middle"},Be=["onClick"],Te={class:"text-center"},Fe=["onUpdate:modelValue"],Pe=["onUpdate:modelValue"],Me=n("option",{value:""},"Select user",-1),Ue=["value"],Ee={class:"text-end"},je={class:"text-end"},Ie={class:"text-center"},Ke=["onUpdate:modelValue"],Re={class:"col-lg-12"},He=n("label",{class:"form-label"},"Description",-1),Ne={__name:"Form",props:["formData","references"],emits:["update:formData"],setup(s,{emit:o}){const i=s,l=S({get:()=>i.formData,set(e){o("update:formData",e)}}),d={precision:0,masked:!1};return(o,i)=>{const h=x,u=C;return e(),t("div",ue,[n("div",me,[fe,V(l).id?(e(),t("input",{key:1,class:"form-control",value:V(l).department?.name,disabled:""},null,8,ge)):(e(),p(V(he),{key:0,modelValue:V(l).department_id,"onUpdate:modelValue":i[0]||(i[0]=e=>V(l).department_id=e),class:w({"is-invalid":V(l).errors.department_id}),options:s.references.departments,reduce:e=>e.id,label:"name"},null,8,["modelValue","class","options","reduce"])),y(h,{id:"input-department-feedback",innerHTML:V(l).errors.department_id},null,8,["innerHTML"])]),n("div",be,[ye,y(u,{id:"code",modelValue:V(l).code,"onUpdate:modelValue":i[1]||(i[1]=e=>V(l).code=e),class:w({"is-invalid":V(l).errors.code}),"aria-describedby":"input-code-feedback"},null,8,["modelValue","class"]),y(h,{id:"input-code-feedback",innerHTML:V(l).errors.code},null,8,["innerHTML"])]),n("div",ve,[Oe,y(u,{id:"name",modelValue:V(l).name,"onUpdate:modelValue":i[2]||(i[2]=e=>V(l).name=e),class:w({"is-invalid":V(l).errors.name}),"aria-describedby":"input-name-feedback",autofocus:""},null,8,["modelValue","class"]),y(h,{id:"input-name-feedback",innerHTML:V(l).errors.name},null,8,["innerHTML"])]),n("div",we,[n("table",_e,[n("thead",Se,[n("tr",null,[n("th",Ve,[n("a",$e,[n("i",{class:"ri-add-fill align-bottom cursor-pointer",title:"Add",onClick:i[3]||(i[3]=e=>{l.value.items.push({user_id:null,sequence:null,range_from:0,range_to:0})})})])]),xe,Ce,Le,ke]),De]),n("tbody",null,[(e(!0),t(a,null,r(V(l).items,((o,i)=>(e(),t("tr",{key:i},[n("td",Ae,[n("i",{class:"ri-close-line text-danger cursor-pointer",title:"Remove",onClick:e=>(e=>{l.value.items.splice(e,1)})(i)},null,8,Be)]),n("td",Te,[g(n("input",{type:"number","onUpdate:modelValue":e=>o.sequence=e,class:"form-control text-end"},null,8,Fe),[[$,o.sequence,void 0,{number:!0}]])]),n("td",null,[g(n("select",{class:"form-select","onUpdate:modelValue":e=>o.user_id=e},[Me,(e(!0),t(a,null,r(s.references.users,((s,o)=>(e(),t("option",{value:o},c(s),9,Ue)))),256))],8,Pe),[[L,o.user_id]])]),n("td",Ee,[y(V(k),m({modelValue:o.range_from,"onUpdate:modelValue":e=>o.range_from=e,modelModifiers:{number:!0}},d,{class:"form-control text-end"}),null,16,["modelValue","onUpdate:modelValue"])]),n("td",je,[y(V(k),m({modelValue:o.range_to,"onUpdate:modelValue":e=>o.range_to=e,modelModifiers:{number:!0}},d,{class:"form-control text-end"}),null,16,["modelValue","onUpdate:modelValue"])]),n("td",Ie,[g(n("input",{type:"text","onUpdate:modelValue":e=>o.description=e,class:"form-control"},null,8,Ke),[[$,o.description]])])])))),128))])])]),n("div",Re,[He,g(n("textarea",{class:"form-control","onUpdate:modelValue":i[4]||(i[4]=e=>V(l).description=e),rows:"4"},null,512),[[$,V(l).description]])])])}}};export{Ne as default};
