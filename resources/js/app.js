require('./bootstrap');
import Vue from "vue";
import axios from 'axios'
import VueAxios from 'vue-axios'
import Form from 'vform'
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import Swal from 'sweetalert2'
window.swal = Swal;

import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'
Vue.use(VueGoodTablePlugin);

Vue.component(
    'app-confirmation-modal',
    require('./Crud/Components/Helpers/ConfirmationModal').default
);
Vue.component(
    'admin-user-dashboard',
    require('./Crud/Components/Views/Dashboard/Dashboard').default
);
Vue.component(
    'all-employee',
    require('./Crud/Components/Views/Testing/EmployeListView').default
);
Vue.component(
    'employee-add-edit-modal',
    require('./Crud/Components/Views/Testing/EmployeAddEditModal').default
);

window.Vue = require('vue').default;
window.Form = Form;
window.$this = Vue.use(VueToast, {
    // One of the options
    position: 'top-right',
    duration: 1000
})
Vue.use(VueAxios, axios);

const app = new Vue({
    el: "#app"
});
