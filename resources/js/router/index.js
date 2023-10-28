import { createRouter, createWebHistory } from 'vue-router'

import Dashboard from '@/components/Dashboard.vue'
import CompaniesIndex from '@/components/companies/CompaniesIndex.vue'
import CompaniesCreate from '@/components/companies/CompaniesCreate.vue'
import CompaniesEdit from '@/components/companies/CompaniesEdit.vue'
import EmployeesIndex from '@/components/employees/EmployeesIndex.vue'
import EmployeesCreate from '@/components/employees/EmployeesCreate.vue'
import EmployeesEdit from '@/components/employees/EmployeesEdit.vue'

const routes = [
    {
        path: '/dashboard',
        name: '',
        component: Dashboard
    },
    {
        path: '/companies/create',
        name: 'companies.create',
        component: CompaniesCreate
    },
    {
        path: '/companies/:id/edit',
        name: 'companies.edit',
        component: CompaniesEdit,
        props: true,
    },
    {
        path: '/companies',
        name: 'companies.index',
        component: CompaniesIndex
    },
    {
        path: '/employees/create',
        name: 'employees.create',
        component: EmployeesCreate
    },
    {
        path: '/employees/:id/edit',
        name: 'employees.edit',
        component: EmployeesEdit,
        props: true,
    },
    {
        path: '/employees',
        name: 'employees.index',
        component: EmployeesIndex
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})