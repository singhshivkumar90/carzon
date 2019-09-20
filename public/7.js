(window.webpackJsonp=window.webpackJsonp||[]).push([[7],{146:function(e,a,s){"use strict";s.r(a);var t=s(3),r={name:"UserForm",components:{SpinnerButton:s(9).a},data:function(){return{id:this.$route.params.id,firstName:"",lastName:"",email:"",password:"",role:"",loggedInUserId:localStorage.getItem("userId"),options:[{id:1,name:"admin"},{id:2,name:"employee"}]}},computed:Object(t.b)({loading:function(e){return e.user.loading},buttonLoading:function(e){return e.user.buttonLoading}}),created:function(){this.id&&this.getUserInformation(this.id)},methods:{getUserInformation:function(e){var a=this;this.$store.dispatch("user/getUserData",e).then(function(e){a.firstName=e.firstName,a.lastName=e.lastName,a.email=e.email,a.role=e.roleId})},userFormSubmit:function(){var e=this;this.$validator.validateAll().then(function(a){if(a){var s=e.id?"user/editUser":"user/addUser";e.$store.dispatch(s,{firstName:e.firstName,lastName:e.lastName,email:e.email,password:e.password,role:e.role,id:e.id})}})}}},i=s(1),n=Object(i.a)(r,function(){var e=this,a=e.$createElement,s=e._self._c||a;return s("div",{staticClass:"inner-page"},[s("header",{staticClass:"inner-page__header d-flex justify-content-between align-items-center"},[s("h1",{staticClass:"inner-page__title"},[e._v(e._s(e.id?"Edit User":"Add User"))])]),e._v(" "),s("section",{staticClass:"inner-page__content container-fluid"},[s("div",{staticClass:"row mb-3"},[s("div",{staticClass:"col-12"},[s("form",{on:{submit:function(a){return a.preventDefault(),e.userFormSubmit(a)}}},[s("div",{staticClass:"card"},[e.loading?s("div",{staticClass:"text-center"},[s("b-spinner",{attrs:{label:"Spinning",variant:"warning"}})],1):e._e(),e._v(" "),e.loading?e._e():s("div",{staticClass:"card-body"},[s("div",{staticClass:"row justify-content-center"},[s("div",{staticClass:"col-xl-9 p-4 py-xl-5"},[s("div",{staticClass:"row justify-content-between"},[s("div",{staticClass:"col-12 col-lg-6 col-xl-5"},[s("div",{staticClass:"form-group"},[e._m(0),e._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:e.firstName,expression:"firstName"},{name:"validate",rawName:"v-validate",value:"required|alpha_spaces|min:1|max:50",expression:"'required|alpha_spaces|min:1|max:50'"}],staticClass:"form-control",class:{input:!0,"is-invalid":e.errors.has("firstName")},attrs:{type:"text",id:"firstName",name:"firstName","data-vv-as":"First name"},domProps:{value:e.firstName},on:{input:function(a){a.target.composing||(e.firstName=a.target.value)}}}),e._v(" "),s("span",{directives:[{name:"show",rawName:"v-show",value:e.errors.has("firstName"),expression:"errors.has('firstName')"}],staticClass:"text-danger"},[e._v(e._s(e.errors.first("firstName")))])])]),e._v(" "),s("div",{staticClass:"col-12 col-lg-6 col-xl-5"},[s("div",{staticClass:"form-group"},[e._m(1),e._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:e.lastName,expression:"lastName"},{name:"validate",rawName:"v-validate",value:"required|alpha_spaces|min:1|max:50",expression:"'required|alpha_spaces|min:1|max:50'"}],staticClass:"form-control",class:{input:!0,"is-invalid":e.errors.has("lastName")},attrs:{type:"text",id:"lastName",name:"lastName","data-vv-as":"Last name"},domProps:{value:e.lastName},on:{input:function(a){a.target.composing||(e.lastName=a.target.value)}}}),e._v(" "),s("span",{directives:[{name:"show",rawName:"v-show",value:e.errors.has("lastName"),expression:"errors.has('lastName')"}],staticClass:"text-danger"},[e._v(e._s(e.errors.first("lastName")))])])]),e._v(" "),s("div",{staticClass:"col-12 col-lg-6 col-xl-5"},[s("div",{staticClass:"form-group"},[e._m(2),e._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:e.email,expression:"email"},{name:"validate",rawName:"v-validate",value:"required|email",expression:"'required|email'"}],staticClass:"form-control",class:{input:!0,"is-invalid":e.errors.has("email")},attrs:{type:"email",id:"email",name:"email","data-vv-as":"Email"},domProps:{value:e.email},on:{input:function(a){a.target.composing||(e.email=a.target.value)}}}),e._v(" "),s("span",{directives:[{name:"show",rawName:"v-show",value:e.errors.has("email"),expression:"errors.has('email')"}],staticClass:"text-danger"},[e._v(e._s(e.errors.first("email")))])])]),e._v(" "),e.id?e._e():s("div",{staticClass:"col-12 col-lg-6 col-xl-5"},[s("div",{staticClass:"form-group"},[e._m(3),e._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:e.password,expression:"password"},{name:"validate",rawName:"v-validate",value:"required|min:6|max:10",expression:"'required|min:6|max:10'"}],staticClass:"form-control",class:{input:!0,"is-invalid":e.errors.has("password")},attrs:{type:"password",id:"password",name:"password","data-vv-as":"Password"},domProps:{value:e.password},on:{input:function(a){a.target.composing||(e.password=a.target.value)}}}),e._v(" "),s("span",{directives:[{name:"show",rawName:"v-show",value:e.errors.has("password"),expression:"errors.has('password')"}],staticClass:"text-danger"},[e._v(e._s(e.errors.first("password")))])])]),e._v(" "),s("div",{staticClass:"col-12 col-lg-6 col-xl-5"},[s("div",{staticClass:"form-group"},[e._m(4),e._v(" "),s("select",{directives:[{name:"model",rawName:"v-model",value:e.role,expression:"role"},{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],staticClass:"form-control",attrs:{id:"role",name:"role","data-vv-as":"Role",disabled:e.id===e.loggedInUserId},on:{change:function(a){var s=Array.prototype.filter.call(a.target.options,function(e){return e.selected}).map(function(e){return"_value"in e?e._value:e.value});e.role=a.target.multiple?s:s[0]}}},[s("option",{attrs:{disabled:"",value:""}},[e._v("Select a role")]),e._v(" "),e._l(e.options,function(a){return s("option",{key:a.id,domProps:{selected:e.role===a.id,value:a.id}},[e._v(e._s(a.name)+"\n                                                    ")])})],2),e._v(" "),s("span",{directives:[{name:"show",rawName:"v-show",value:e.errors.has("role"),expression:"errors.has('role')"}],staticClass:"text-danger"},[e._v("\n                                            "+e._s(e.errors.first("role"))+"\n                                        ")])])])]),e._v(" "),s("div",{staticClass:"row"},[s("div",{staticClass:"col-12 text-right"},[s("button",{staticClass:"mt-2 btn btn-success",attrs:{type:"submit"}},[e.buttonLoading?s("SpinnerButton"):e._e(),e._v(" "),e.buttonLoading?e._e():s("span",[e._v(e._s(e.id?"Update User":"Add User"))])],1),e._v(" "),s("router-link",{staticClass:"mt-2 btn btn-outline-danger",attrs:{to:"/users"}},[e._v("CANCEL\n                                            ")])],1)])])])])])])])])])])},[function(){var e=this.$createElement,a=this._self._c||e;return a("label",{attrs:{for:"firstName"}},[this._v("\n                                                    First Name\n                                                    "),a("span",{staticClass:"text-danger"},[this._v("*")])])},function(){var e=this.$createElement,a=this._self._c||e;return a("label",{attrs:{for:"lastName"}},[this._v("\n                                                    Last Name\n                                                    "),a("span",{staticClass:"text-danger"},[this._v("*")])])},function(){var e=this.$createElement,a=this._self._c||e;return a("label",{attrs:{for:"email"}},[this._v("\n                                                    Email\n                                                    "),a("span",{staticClass:"text-danger"},[this._v("*")])])},function(){var e=this.$createElement,a=this._self._c||e;return a("label",[this._v("\n                                                    Password\n                                                    "),a("span",{staticClass:"text-danger"},[this._v("*")])])},function(){var e=this.$createElement,a=this._self._c||e;return a("label",{attrs:{for:"role"}},[this._v("\n                                                    Role\n                                                    "),a("span",{staticClass:"text-danger"},[this._v("*")])])}],!1,null,null,null);a.default=n.exports}}]);
//# sourceMappingURL=7.js.map