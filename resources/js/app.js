import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';
import router from './router'
import Pagination from '@/components/Pagination.vue'
import CompaniesIndex from '@/components/companies/CompaniesIndex.vue'

const app = createApp({})
app.component('companies-index', CompaniesIndex)
app.component('Pagination', Pagination);
app.use(router).mount('#app') 