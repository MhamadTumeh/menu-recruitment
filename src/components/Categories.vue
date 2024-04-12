<template>
    <div>
        <h1 class="text-3xl font-semibold mb-4">Restaurant Menu</h1>
        <router-link to="/categories/add" class="btn-add">Add
            Category</router-link>
        <router-link to="/items/add" class="btn-add">Add
            Item</router-link>
        <router-link to="/discounts/add" class="btn-add">Add
            Discount</router-link>

        <CategoryCard v-if="categories.categories && categories.categories.length"
            v-for="category in categories.categories" :key="category.id" :category="category" />
        <p v-else>No categories found.</p>
    </div>

</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useStore } from 'vuex';
import CategoryCard from '@/components/CategoryCard.vue';

const store = useStore();
const categories = ref([]);

const fetchCategories = async () => {
    try {
        await store.dispatch('fetchCategories');
        categories.value = store.state.categories;
    } catch (error) {
        console.error(error);
    }
};

onMounted(() => {
    fetchCategories();
});
</script>
