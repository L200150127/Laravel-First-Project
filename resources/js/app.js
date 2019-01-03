
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.  
 */

// Import bootstrap.js
require('./bootstrap');
Vue.config.productionTip = false;

/**
 * Plugin plugin
 */
// Impor Vue Router
import VueRouter from 'vue-router';
// Impor Form v-form
import Form from 'vform';
// Impor VeeValidate
import id from 'vee-validate/dist/locale/id';
import VeeValidate, { Validator } from 'vee-validate';
//  Impor momentjs
import moment from 'moment';
// Impor Vue Progress bar
import VueProgressBar from 'vue-progressbar';
// Impor Vue Select
import vSelect from 'vue-select';
// Impor Sweet Alert 2
import swal from 'sweetalert2';
// Impor v-calendar
// import VCalendar from 'v-calendar';
// import 'v-calendar/lib/v-calendar.min.css';

// import MyVcalendar from './components/My-vcalendar.vue';
import MyCalendar from './components/MyCalendar.vue';


/**
 * Kelas dan file JS lain yang diperlukan
 */
// Impor Kelas Gate untuk membuat ACL di Front End
import Gate from './Gate';
// Impor Routes untuk membuat Routing di Front End
import routes from './routes';


// menggunakan plugin vue-router pada Vue
Vue.use(VueRouter);
// menggunakan plugin vee-validate
Vue.use(VeeValidate);
Validator.localize('id', id);
// Inisiasi Vue Progress bar secara global
Vue.use(VueProgressBar, {
    color: '#3490dc',
    failedColor: '#dc3545',
    thickness: '3px',
});
// Use v-calendar, v-date-picker & v-popover components
// Vue.use(VCalendar, {
//   firstDayOfWeek: 2,  // Monday
// });

// Meregisterasikan komponen secara global
// Vue.component(MyVcalendar.name, MyVcalendar);
// Vue.component(MyCalendar.name, MyCalendar);

// Memasang secara Global komponen v-form
window.Form = Form;
// Memasang Sweet Alert : swal reguler pada global window
window.swal = swal;
// Memasang Sweet Alert : Toast secara global
const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.toast = toast;

// Memasang Sweet Alert: Bootstrap Btn Styling
const swalBS = swal.mixin({
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false,
})
window.swalBS = swalBS;

// Masukan Objek User Laravel ke Prototipe Vue
Vue.prototype.$gate = new Gate(window.user);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
// Vue.component('app', require('./views/App.vue'));
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('v-select', vSelect);

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
Vue.filter('gender', function (value) {
    if (!value) return ''
    value = value.toString().toLowerCase();
    return (value == 'l') ? 'Laki-laki' : 'Perempuan';
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
 * Membuat sekaligus menugaskan window.Fire direferensikan ke vue
 * alasan membuat objek Vue kosong adalah sebagai listener global semua event
 **/
window.Fire = new Vue();


/**
 * Membuat objek router dari routes file
 */
const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes
});

/**
 * Konfigurasi Vue-Router
 * 
 */
// This callback runs before every route change, including on page load.
router.beforeEach((to, from, next) => {
    // This goes through the matched routes from last to first, finding the closest route with a title.
    // eg. if we have /some/deep/nested/route and /some, /deep, and /nested have titles, nested's will be chosen.
    const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);

    // Find the nearest route element with meta tags.
    const nearestWithMeta = to.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);
    const previousNearestWithMeta = from.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);

    // If a route with a title was found, set the document (page) title to that value.
    if(nearestWithTitle) document.title = nearestWithTitle.meta.title;

    // Remove any stale meta tags from the document using the key attribute we set below.
    Array.from(document.querySelectorAll('[data-vue-router-controlled]')).map(el => el.parentNode.removeChild(el));

    // Skip rendering meta tags if there are none.
    if(!nearestWithMeta) return next();

    // Turn the meta tag definitions into actual elements in the head.
    nearestWithMeta.meta.metaTags.map(tagDef => {
        const tag = document.createElement('meta');

        Object.keys(tagDef).forEach(key => {
          tag.setAttribute(key, tagDef[key]);
        });

        // We use this to track which meta tags we create, so we don't interfere with other ones.
        tag.setAttribute('data-vue-router-controlled', '');

        return tag;
    })
    // Add the meta tags to the document head.
    .forEach(tag => document.head.appendChild(tag));

    next();
});


/**
 * Konfigurasi Vee-Validate agar dapat menangkap response error dari server
 * 
*/
Vue.prototype.$setErrorsFromResponse = function(errorResponse) {
    // only allow this function to be run if the validator exists
    if(!this.hasOwnProperty('$validator')) {
        return;
    }
    
    // clear errors
    this.$validator.errors.clear();

    // check if errors exist
    if(!errorResponse.hasOwnProperty('errors')) {
        return;
    }

    let errorFields = Object.keys(errorResponse.errors);

    // insert laravel errors
    errorFields.map(field => {
        let errorString = errorResponse.errors[field].join(', ');
        this.$validator.errors.add({
            field: field,
            msg: errorString
        });     
    });
};


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// new Vue(Vue.util.extend({ router }, App)).$mount('#app');


const App = new Vue({
    el: "#app",
    router,
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