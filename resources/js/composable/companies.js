import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useCompanies() {
    const company = ref([])
    const companies = ref([])

    const errors = ref('')
    const router = useRouter()

    const getCompanies = async () => {
        let response = await axios.get('/api/companies')
        companies.value = response.data.data
    }

    const showCompany = async (id) => {
        let response = await axios.get(`/api/companies/${id}`)
        company.value = response.data.data
    }

    const storeCompany = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/companies', data, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
            await router.push({ name: 'companies.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }

    }
    const getPaginatedCompanies = async (page = 1) => {
        try {
            const response = await axios.get(`/api/companies?page=${page}`);
            companies.value = response.data.data;
            currentPage.value = response.data.current_page; // Update current page
            totalPage.value = response.data.last_page; // Update total number of pages
        } catch (error) {
            console.error(error)
        }
    };

    const updateCompany = async (id) => {
        errors.value = ''
        try {
            await axios.patch(`/api/companies/${id}`, company.value, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
            await router.push({ name: 'companies.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const destroyCompany = async (id) => {
        await axios.delete(`/api/clients/${id}`)
    }

    return {
        errors,
        company,
        companies,
        showCompany,
        getCompanies,
        storeCompany,
        updateCompany,
        destroyCompany,
        getPaginatedCompanies
    }
}