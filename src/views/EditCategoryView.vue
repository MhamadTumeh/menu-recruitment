<template>
    <div>
        <h2>Edit Category</h2>
        <input type="text" v-model="categoryName">
        <select v-model="parentCategoryId">
            <option value="">Select Parent Category</option>
            <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
        </select>
        <button @click="saveCategory">Save</button>
        <button @click="$router.push('/categories')">Cancel</button>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed } from 'vue';
import axios from 'axios';

export default defineComponent({
    name: 'EditCategory',
    props: {
        categoryId: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            categoryName: '',
            parentCategoryId: null,
        };
    },
    computed: {
        async categories() {
            try {
                const response = await axios.get('http://localhost:8000/api/categories');
                return response.data;
            } catch (error) {
                console.error('Error fetching categories:', error);
                return [];
            }
        },
    },
    async created() {
        await this.fetchCategory();
    },
    methods: {
        async fetchCategory() {
            try {
                const response = await axios.get(`http://localhost:8000/api/categories/${this.categoryId}`);
                this.categoryName = response.data.name;
                this.parentCategoryId = response.data.parentId;
            } catch (error) {
                console.error('Error fetching category:', error);
            }
        },
        async saveCategory() {
            try {
                await axios.put(`http://localhost:8000/api/categories/${this.categoryId}`, {
                    name: this.categoryName,
                    parentId: this.parentCategoryId,
                });
                this.$router.push('/categories');
            } catch (error) {
                console.error('Error saving category:', error);
            }
        },
    },
});
</script>