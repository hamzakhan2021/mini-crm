<template>
    <div class="pagination">
        <button @click="changePage(-1)" :disabled="currentPage === 1" class="pagination-button">Previous</button>
        <span class="pagination-info">Page {{ currentPage }} of {{ totalPages }}</span>
        <button @click="changePage(1)" :disabled="currentPage === totalPages" class="pagination-button">Next</button>
    </div>
</template>
  
<script>
import { ref, computed } from "vue";

export default {
    props: {
        totalItems: Number, // Total number of items to paginate
        itemsPerPage: Number, // Number of items to display per page
    },
    setup(props, { emit }) {
        const currentPage = ref(1);

        const totalPages = computed(() => Math.ceil(props.totalItems / props.itemsPerPage));

        const changePage = (offset) => {
            const newPage = currentPage.value + offset;
            if (newPage >= 1 && newPage <= totalPages.value) {
                currentPage.value = newPage;
                emit("page-change", newPage);
            }
        };

        return { currentPage, totalPages, changePage };
    },
};
</script>

<style scoped>
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

.pagination-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
}

.pagination-button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

.pagination-info {
    margin: 0 15px;
}
</style>