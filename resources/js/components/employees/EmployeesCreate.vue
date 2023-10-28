<template>
    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>
 
    <form class="space-y-6" @submit.prevent="saveEmployee">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <div class="mt-1">
                    <input type="text" name="first_name" id="first_name"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.first_name">
                </div>
            </div>

            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <div class="mt-1">
                    <input type="text" name="last_name" id="last_name"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.last_name">
                </div>
            </div>
 
            <div>
                <label for="company_id" class="block text-sm font-medium text-gray-700">Select Company:</label>
                <select class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="company_id" v-model="form.company_id">
                    <option value="">Select a company</option>
                    <option v-for="company in companies" :key="company.id" :value="company.id">
                    {{ company.name }}
                    </option>
                </select>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1">
                    <input type="text" name="email" id="email"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.email">
                </div>
            </div>
 
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <div class="mt-1">
                    <input type="text" name="phone" id="phone"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.phone">
                </div>
            </div>
        </div>
 
        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Create Employee
        </button>
    </form>
</template>
 
<script>
import useEmployee from '../../composable/employees'
import useCompany from '../../composable/companies';
import { onMounted } from 'vue';
import { reactive } from 'vue'
 
export default {
    setup() {
        const form = reactive({
            first_name: '',
            last_name: '',
            company_id: null,
            phone: '',
            email: ''
        })

        const { companies, getCompanies } = useCompany()
 
        onMounted(getCompanies)

        const { errors, storeEmployee } = useEmployee()
 
        const saveEmployee = async () => {
            await storeEmployee({ ...form })
        }
 
        return {
            form,
            errors,
            saveEmployee,
            companies
        }
    }
}
</script>