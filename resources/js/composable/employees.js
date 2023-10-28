import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useEmployees() {
    const employee = ref([])
    const employees = ref([])
    const currentPage = ref([])

    const errors = ref('')
    const router = useRouter()

    const getEmployees = async () => {
        let response = await axios.get('/api/employees')
        employees.value = response.data.data
    }

    const showEmployee = async (id) => {
        let response = await axios.get(`/api/employees/${id}`)
        employee.value = response.data.data
    }

    const storeEmployee = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/employees', data, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
            await router.push({ name: 'employees.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }

    }

    const updateEmployee = async (id) => {
        errors.value = ''
        try {
            await axios.patch(`/api/employees/${id}`, employee.value, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
            await router.push({ name: 'employees.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const destroyEmployee = async (id) => {
        await axios.delete(`/api/employees/${id}`)
    }

    const getPaginatedEmployees = async (page = 1) => {
        try {
            const response = await axios.get(`/api/employees?page=${page}`);
            employee.value = response.data.data;
            currentPage.value = response.data.current_page; // Update current page
            totalPage.value = response.data.last_page; // Update total number of pages
        } catch (error) {
            console.error(error)
        }
    };

    return {
        errors,
        employee,
        employees,
        showEmployee,
        getEmployees,
        storeEmployee,
        updateEmployee,
        destroyEmployee,
        getPaginatedEmployees,
        currentPage,
    }
}