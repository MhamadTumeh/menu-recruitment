<template>
    <div>
        <h2>{{ mode === 'add' ? 'Add Category' : 'Edit Category' }}</h2>
        <input type="text" v-model="categoryName">
        <select v-model="parentCategoryId">
            <option value="">Select Parent Category</option>
            <option :value="null">Root</option>
            <option v-for="category in categories.categories" :value="category.id" :key="category.id">{{ category.name
                }}</option>
        </select>
        <button @click="saveCategory">{{ mode === 'add' ? 'Save' : 'Update' }}</button>
        <button @click="cancel">Cancel</button>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

export default {
    props: {
        mode: String,
        categoryId: Number,
    },
    setup(props) {
        const router = useRouter();
        const store = useStore();
        const categories = ref([]);
        const categoryName = ref('');
        const parentCategoryId = ref('');

        const fetchCategories = async () => {
            try {
                await store.dispatch('fetchCategories');
                categories.value = store.state.categories;
            } catch (error) {
                console.error(error);
            }
        };

        const loadCategory = async () => {
            if (props.mode === 'edit' && props.categoryId) {
                const category = await store.dispatch('fetchCategoryById', props.categoryId);
                if (category) {
                    categoryName.value = category.name;
                    parentCategoryId.value = category.parent_id;
                }
            }
        };

        const saveCategory = async () => {
            const category = {
                name: categoryName.value,
                parent_id: parentCategoryId.value ? parseInt(parentCategoryId.value) : null
            };
            if (props.mode === 'add') {
                await store.dispatch('addCategory', category);
            } else {
                await store.dispatch('editCategory', { category, id: props.categoryId });
            }
            cancel();
        };

        const cancel = () => {
            router.push('/categories');
        };

        onMounted(() => {
            fetchCategories();
            loadCategory();
        });

        return {
            categories,
            categoryName,
            parentCategoryId,
            saveCategory,
            cancel
        };
    }
};
</script>

<style>
/* Add your styles here */
</style>
