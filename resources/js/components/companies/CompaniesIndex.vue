<template>
    <div class="flex place-content-end mb-4">
        <div class="px-6 py-4 text-sm text-center leading-5 text-gray-900 whitespace-no-wrap">
            <router-link :to="{ name: 'companies.create' }"
                class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Create
                Company</router-link>
        </div>
    </div>
    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50">
                        <span
                            class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">ID</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span
                            class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Name</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span
                            class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Email</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span
                            class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Logo</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span
                            class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Website</span>
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                <template v-for="company in companies" :key="company.id">
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ company.id }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ company.name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ company.email }}
                        </td>
                        <td class="image-wrapper px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            <img class="max-width: 100px;max-height: 100px;" :src="company.logo" alt="Logo Preview" />
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-wrap">
                            {{ company.website }}
                        </td>
                        <td class="px-6 py-4 text-sm text-center leading-5 text-gray-900 whitespace-no-wrap">
                            <button @click="deleteCompany(company.id)"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Delete
                            </button>
                        </td>
                        <td>
                            <router-link :to="{ name: 'companies.edit', params: { id: company.id } }"
                                class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Edit</router-link>
                        </td>


                    </tr>
                </template>
            </tbody>
        </table>

    </div>
    <Pagination :totalItems="totalItems" :itemsPerPage="itemsPerPage" @page-change="getPaginatedCompanies" />
</template>
 
<script>
import useCompany from '../../composable/companies'
import { onMounted, ref } from 'vue';

export default {
    setup() {
        const { companies, getCompanies, getPaginatedCompanies } = useCompany()

        onMounted(getCompanies)

        const totalItems = ref(100); // Replace with the total number of items
        const itemsPerPage = ref(10); // Replace with the number of items per page
        const currentPageData = ref([]);

        const deleteCompany = async (id) => {
            if (!window.confirm('You sure?')) {
                return
            }
            await destroyCompany(id)
            await getCompanies()
        }

        return {
            companies,
            deleteCompany,
            getPaginatedCompanies,
            totalItems, itemsPerPage, currentPageData
        }
    }
}
</script>
<style scoped>
.image-wrapper {
    display: table-cell;
    width: 100px;
    height: 150px;
    vertical-align: middle;
}

.image-wrapper img {
    max-width: 100%;
    max-height: 100%;
    display: block;
    margin: 0 auto;
}</style>
