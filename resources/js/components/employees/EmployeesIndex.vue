<template>
    <div class="flex place-content-end mb-4">
        <div class="px-6 py-4 text-sm text-center leading-5 text-gray-900 whitespace-no-wrap">
            <router-link :to="{ name: 'employees.create' }"
                class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Create
                employee</router-link>
        </div>
    </div>
    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50">
                        <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">First
                            Name</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Last
                            Name</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span
                            class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Email</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Company
                            Name</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span
                            class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Phone</span>
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                <template v-for="employee in employees" :key="employee.id">
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ employee.first_name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ employee.last_name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ employee.email }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ employee.company_name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ employee.phone }}
                        </td>
                        <td class="px-6 py-4 text-sm text-center leading-5 text-gray-900 whitespace-no-wrap">
                            <button @click="deleteEmployee(employee.id)"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Delete
                            </button>
                        </td>
                        <td>
                            <router-link :to="{ name: 'employees.edit', params: { id: employee.id } }"
                                class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Edit</router-link>
                        </td>


                    </tr>
                </template>
            </tbody>
        </table>
    </div>
    <Pagination :totalItems="totalItems" :itemsPerPage="itemsPerPage" @page-change="getPaginatedEmployees" />
</template>
 
<script>

import useEmployee from '../../composable/employees'
import { onMounted, ref } from 'vue';

export default {
    setup() {
        const { employees, getEmployees, getPaginatedEmployees, currentPage, totalItem } = useEmployee()

        onMounted(getEmployees)

        const totalItems = ref(totalItem);
        const itemsPerPage = ref(10);
        const currentPageData = ref(currentPage);


        const deleteEmployee = async (id) => {
            if (!window.confirm('You sure?')) {
                return
            }

            await deleteEmployee(id)
            await getEmployees()
        }

        return {
            employees,
            deleteEmployee, getPaginatedEmployees,
            totalItems, itemsPerPage, currentPageData
        }
    }
}
</script>

<style scoped>
.pagination a.active {
    background-color: #4CAF50;
    color: white;
}

.pagination a:hover:not(.active) {
    background-color: #ddd;
}</style>