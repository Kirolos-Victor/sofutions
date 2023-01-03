import './bootstrap';
import {createApp} from 'vue';


const app = createApp({});
import CompanyIndex from './components/Companies/Index.vue'
import EmployeeIndex from './components/Employees/Index.vue';

app.component('company-index', CompanyIndex)
app.component('employee-index', EmployeeIndex)

app.mount('#app');
