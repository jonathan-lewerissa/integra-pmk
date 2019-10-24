(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/app"],{

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */
__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");
/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


__webpack_require__(/*! ./components/Presensi */ "./resources/js/components/Presensi.js");

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

window._ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  window.Popper = __webpack_require__(/*! popper.js */ "./node_modules/popper.js/dist/esm/popper.js")["default"];
  window.$ = window.jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

  __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js");
} catch (e) {}
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */


window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

var token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo'
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

/***/ }),

/***/ "./resources/js/components/Presensi.js":
/*!*********************************************!*\
  !*** ./resources/js/components/Presensi.js ***!
  \*********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! sweetalert2 */ "./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var sweetalert2_react_content__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! sweetalert2-react-content */ "./node_modules/sweetalert2-react-content/dist/sweetalert2-react-content.umd.js");
/* harmony import */ var sweetalert2_react_content__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(sweetalert2_react_content__WEBPACK_IMPORTED_MODULE_3__);
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(source, true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(source).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance"); }

function _iterableToArrayLimit(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }





var MySwal = sweetalert2_react_content__WEBPACK_IMPORTED_MODULE_3___default()(sweetalert2__WEBPACK_IMPORTED_MODULE_2___default.a);

var Presensi = function Presensi(props) {
  var initialState = function initialState() {
    return {
      nrp: '',
      nama: '',
      asal: ''
    };
  };

  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(JSON.parse(window.__INITIAL_STATE__)),
      _useState2 = _slicedToArray(_useState, 2),
      events = _useState2[0],
      setEvents = _useState2[1];

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_0__["useState"])(initialState),
      _useState4 = _slicedToArray(_useState3, 2),
      inputs = _useState4[0],
      setInputs = _useState4[1];

  var handleInputChange = function handleInputChange(event) {
    event.persist();
    var target = event.target;

    if (target.name === 'nrp') {
      var regexcheck = new RegExp('^[0-9]*$');

      if (target.value.length <= 14 && regexcheck.test(target.value)) {
        setInputs(function (inputs) {
          return _objectSpread({}, inputs, _defineProperty({}, target.name, target.value));
        });
      }
    }
  };

  var handleSubmit = function handleSubmit(event) {
    event.preventDefault();

    if (inputs.nrp.length !== 14) {
      return;
    }

    axios.put(events.endpoint, {
      nrp: inputs.nrp
    }).then(function (response) {
      console.log(response);
      MySwal.fire({
        title: 'Welcome',
        text: 'Hi ' + response.data.nama + '! Jesus bless you!',
        type: 'success',
        timer: 2500
      });

      if (events.show_attencande_count) {
        setEvents(function (events) {
          return _objectSpread({}, events, {
            attendance_count: response.data.attendance_count
          });
        });
      }

      setInputs(initialState());
    })["catch"](function (error) {
      console.error(error);
      MySwal.fire({
        title: 'Oops!',
        text: 'Oopsie, something wrong is happening!',
        type: 'error',
        timer: 2500
      });
    });
  };

  return react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "container mx-auto h-full flex flex-col justify-center items-center"
  }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "w-2/3"
  }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "max-w-sm w-full lg:max-w-full lg:flex",
    style: {
      height: '50vh'
    }
  }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("img", {
    src: events.background_image || 'https://source.unsplash.com/300x300/daily/?nature',
    className: "w-auto h-full object-cover flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l overflow-hidden"
  }), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal w-full"
  }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "h-full flex flex-col justify-center items-center"
  }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h1", {
    className: "text-3xl font-bold text-center"
  }, events.title), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h2", {
    className: "text-xl font-light text-center"
  }, events.description), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h2", {
    className: "text-xl font-light text-center"
  }, events.show_attendance_count ? "Total: ".concat(events.attendance_count) : ''), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "h-full w-50 flex flex-col justify-center items-center"
  }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("form", {
    onSubmit: handleSubmit
  }, events.type === 'Mahasiswa' ? react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("input", {
    onChange: handleInputChange,
    name: "nrp",
    value: inputs.nrp,
    placeholder: "NRP",
    className: "block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow text-lg"
  }) : react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_0___default.a.Fragment, null, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("input", {
    onChange: handleInputChange,
    name: "nama",
    value: inputs.nama
  }), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("input", {
    onChange: handleInputChange,
    name: "asal",
    value: inputs.asal
  })))))))));
};

if (document.getElementById('app')) {
  react_dom__WEBPACK_IMPORTED_MODULE_1___default.a.render(react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(Presensi, null), document.getElementById('app'));
}

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\laragon\www\integra-pmk\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\laragon\www\integra-pmk\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);