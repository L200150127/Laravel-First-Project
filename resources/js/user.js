
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.  
 */

// Impor axios library
import axios from 'axios';
// Impor Vue
import Vue from 'vue';
// membuat sekaligus menugaskan window.Vue direferensikan ke Vue
window.Vue = Vue;
// membuat sekaligus menugaskan window.axios direferensikan ke axios
window.axios = axios;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

Vue.config.productionTip = false;

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');

} catch (e) {}

/**
 * Plugin plugin
 */
//  Impor momentjs
import moment from 'moment';
// Impor v-calendar
// import VCalendar from 'v-calendar';
// import 'v-calendar/lib/v-calendar.min.css';

// import MyVcalendar from './components/My-vcalendar.vue';
import MyCalendar from './components/MyCalendar.vue';
// Use v-calendar, v-date-picker & v-popover components
// Vue.use(VCalendar, {
//   firstDayOfWeek: 2,  // Monday
// });

// Meregisterasikan komponen secara global
// Vue.component(MyVcalendar.name, MyVcalendar);
// Vue.component(MyCalendar.name, MyCalendar);



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
// Vue.component('app', require('./views/App.vue'));
Vue.component('pagination', require('laravel-vue-pagination'));

// Membuat Global Filter
Vue.filter('capitalize', function (value, firstOnly=false) {
    if (!value) return ''
    value = value.toString();
    if (firstOnly) {
        return value.charAt(0).toUpperCase() + value.slice(1);
    }
    return value.replace(/\b\w/g, function(l){ return l.toUpperCase() });
});
Vue.filter('date_id_format', function(value) {
    if (!value) return 'Tidak Ada Tanggal'
    moment.locale('id');
    return moment(value).format('dddd, Do MMMM YYYY, [Pukul] HH.mm [WIB]');
});
Vue.filter('date_id_short', function(value) {
    if (!value) return 'Tidak Ada Tanggal'
    moment.locale('id');
    return moment(value).format('Do MMMM YYYY');
});
Vue.filter('date_id', function(value) {
    if (!value) return 'Tidak Ada Tanggal'
    moment.locale('id');
    return moment(value).format('LLL');;
});
Vue.filter('gender', function (value) {
    if (!value) return ''
    value = value.toString().toLowerCase();
    return (value == 'l') ? 'Laki-laki' : 'Perempuan';
});
Vue.filter('status', function (value) {
    value = value.toString().toLowerCase();
    return (value == 1) ? 'Alumni' : 'Aktif';
});
Vue.filter('semester', function (value) {
    if (!value) return ''
    value = value.toString().toLowerCase();
    return (value == 1) ? 'Gasal' : 'Genap';
});
Vue.filter('money', function (value) {
    if (!value) return ''
    const formatter = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 2
    });
    return formatter.format(value)
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const App = new Vue({
    el: "#app",
    data: {
        search: '',
    },
    methods: {
        searchIt: _.debounce(() => {
            Fire.$emit('searching');
        }, 700)
    }
});


// Kode Vanilla JS
if (!Array.prototype.last){
    Array.prototype.last = function(){
        return this[this.length - 1];
    };
};