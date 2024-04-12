<template>
    <div>
        <h2>{{ mode === 'add' ? 'Add Item' : 'Edit Item' }}</h2>
        <div>
            <label for="itemName">Item Name:</label>
            <input type="text" id="itemName" v-model="itemName">
        </div>
        <div>
            <label for="description">Description:</label>
            <input type="text" id="description" v-model="description">
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" v-model="price">
        </div>
        <div>
            <label for="category">Category:</label>
            <select id="category" v-model="category_id">
                <option value="">Select Parent category</option>
                <option v-for="category in categories.categories" :value="category.id" :key="category.id">{{
                    category.name }}</option>
            </select>
        </div>
        <button @click="saveItem">{{ mode === 'add' ? 'Save' : 'Update' }}</button>
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
        itemId: Number,
    },
    setup(props) {
        const router = useRouter();
        const store = useStore();
        const categories = ref([]);
        const itemName = ref('');
        const description = ref('');
        const price = ref('');
        const category_id = ref('');

        const fetchCategories = async () => {
            try {
                await store.dispatch('fetchSubCategories');
                categories.value = store.state.categories;
            } catch (error) {
                console.error(error);
            }
        };


        const saveItem = async () => {
            const item = {
                name: itemName.value,
                description: description.value,
                price: price.value,
                category_id: category_id.value ? parseInt(category_id.value) : null
            };
            if (props.mode === 'add') {
                console.log(item, "AAA")
                await store.dispatch('addItem', item);
            } else {
                await store.dispatch('editItem', { item, id: props.itemId });
            }
            cancel();
        };

        const cancel = () => {
            router.push('/categories');
        };

        onMounted(() => {
            fetchCategories();
        });

        return {
            categories,
            itemName,
            description,
            price,
            category_id,
            saveItem,
            cancel
        };
    }
};
</script>

<style>
/* Add your styles here */
</style>
