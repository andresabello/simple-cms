(window.webpackJsonp=window.webpackJsonp||[]).push([[13],{T4fW:
/*!**********************************************************************!*\
  !*** ./src/resources/core/assets/js/components/partials/Sidebar.vue ***!
  \**********************************************************************/
/*! exports provided: default */function(module,__webpack_exports__,__webpack_require__){"use strict";eval('__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _Sidebar_vue_vue_type_template_id_9979131e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Sidebar.vue?vue&type=template&id=9979131e& */ "YpeN");\n/* harmony import */ var _Sidebar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Sidebar.vue?vue&type=script&lang=js& */ "cGDk");\n/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "KHd+");\n\n\n\n\n\n/* normalize component */\n\nvar component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(\n  _Sidebar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],\n  _Sidebar_vue_vue_type_template_id_9979131e___WEBPACK_IMPORTED_MODULE_0__["render"],\n  _Sidebar_vue_vue_type_template_id_9979131e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],\n  false,\n  null,\n  null,\n  null\n  \n)\n\n/* hot reload */\nif (false) { var api; }\ncomponent.options.__file = "src/resources/core/assets/js/components/partials/Sidebar.vue"\n/* harmony default export */ __webpack_exports__["default"] = (component.exports);\n\n//# sourceURL=webpack:///./src/resources/core/assets/js/components/partials/Sidebar.vue?')},XZni:
/*!***************************************************************************************************************************************************************************************************************!*\
  !*** /var/www/packagetestapp/node_modules/babel-loader/lib??ref--2!./node_modules/vue-loader/lib??vue-loader-options!./src/resources/core/assets/js/components/partials/Sidebar.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************************************/
/*! exports provided: default */function(module,__webpack_exports__,__webpack_require__){"use strict";eval("__webpack_require__.r(__webpack_exports__);\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  props: ['menu'],\n  data: function data() {\n    return {\n      isActive: false\n    };\n  },\n  mounted: function mounted() {},\n  computed: {},\n  methods: {\n    makeActive: function makeActive(item) {\n      if (item.children) {\n        if (item.active && this.isActive) {\n          item.active = false;\n          this.isActive = false;\n        } else {\n          _.forEach(this.menu, function (type, index) {\n            _.forEach(type, function (item, key) {\n              item.active = false;\n            });\n          });\n\n          item.active = true;\n          this.isActive = true;\n        }\n      }\n    },\n    getActive: function getActive(item) {\n      if (typeof item.children == 'undefined') {\n        return item.active ? 'is-current' : '';\n      }\n\n      return this.isActive && item.active ? 'is-active' : item.active ? 'is-current' : '';\n    }\n  }\n});\n\n//# sourceURL=webpack:///./src/resources/core/assets/js/components/partials/Sidebar.vue?/var/www/packagetestapp/node_modules/babel-loader/lib??ref--2!./node_modules/vue-loader/lib??vue-loader-options")},YpeN:
/*!*****************************************************************************************************!*\
  !*** ./src/resources/core/assets/js/components/partials/Sidebar.vue?vue&type=template&id=9979131e& ***!
  \*****************************************************************************************************/
/*! exports provided: render, staticRenderFns */function(module,__webpack_exports__,__webpack_require__){"use strict";eval('__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Sidebar_vue_vue_type_template_id_9979131e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Sidebar.vue?vue&type=template&id=9979131e& */ "ef1K");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Sidebar_vue_vue_type_template_id_9979131e___WEBPACK_IMPORTED_MODULE_0__["render"]; });\n\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Sidebar_vue_vue_type_template_id_9979131e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });\n\n\n\n//# sourceURL=webpack:///./src/resources/core/assets/js/components/partials/Sidebar.vue?')},cGDk:
/*!***********************************************************************************************!*\
  !*** ./src/resources/core/assets/js/components/partials/Sidebar.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************/
/*! exports provided: default */function(module,__webpack_exports__,__webpack_require__){"use strict";eval('__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Sidebar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../../../../node_modules/babel-loader/lib??ref--2!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Sidebar.vue?vue&type=script&lang=js& */ "XZni");\n/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Sidebar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); \n\n//# sourceURL=webpack:///./src/resources/core/assets/js/components/partials/Sidebar.vue?')},ef1K:
/*!***********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/resources/core/assets/js/components/partials/Sidebar.vue?vue&type=template&id=9979131e& ***!
  \***********************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */function(module,__webpack_exports__,__webpack_require__){"use strict";eval('__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });\nvar render = function() {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _c(\n    "aside",\n    { staticClass: "menu" },\n    _vm._l(_vm.menu, function(type, index) {\n      return _c("div", [\n        _c(\n          "ul",\n          { staticClass: "menu-list" },\n          _vm._l(type, function(item) {\n            return _c("li", [\n              _c(\n                "a",\n                {\n                  class: _vm.getActive(item),\n                  attrs: { href: item.url },\n                  on: {\n                    click: function($event) {\n                      return _vm.makeActive(item)\n                    }\n                  }\n                },\n                [\n                  _c("i", {\n                    class: item.icon,\n                    attrs: { "aria-hidden": "true" }\n                  }),\n                  _vm._v(" " + _vm._s(item.name) + "\\n                ")\n                ]\n              ),\n              _vm._v(" "),\n              item.children\n                ? _c(\n                    "ul",\n                    {\n                      directives: [\n                        {\n                          name: "show",\n                          rawName: "v-show",\n                          value: item.active,\n                          expression: "item.active"\n                        }\n                      ],\n                      staticClass: "menu-list"\n                    },\n                    _vm._l(item.children, function(child) {\n                      return _c("li", [\n                        _c("a", { attrs: { href: child.url } }, [\n                          _c("i", {\n                            class: child.icon,\n                            attrs: { "aria-hidden": "true" }\n                          }),\n                          _vm._v(" " + _vm._s(child.name))\n                        ])\n                      ])\n                    }),\n                    0\n                  )\n                : _vm._e()\n            ])\n          }),\n          0\n        )\n      ])\n    }),\n    0\n  )\n}\nvar staticRenderFns = []\nrender._withStripped = true\n\n\n\n//# sourceURL=webpack:///./src/resources/core/assets/js/components/partials/Sidebar.vue?./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options')}}]);