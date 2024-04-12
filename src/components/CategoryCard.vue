<template>
    <div class="category-card">
        <h2>{{ category.name }}</h2>
        <div class="actions">
            <button class="edit-btn" @click="editCategory(category)">Edit Category</button>
            <button class="delete-btn" @click="deleteCategory(category.id)">Delete Category</button>
        </div>
        <div v-if="category.subcategories && category.subcategories.length">
            <h3>Subcategories:</h3>
            <ul class="sub-info">
                <li v-for="subcategory in category.subcategories" :key="subcategory.id">
                    <h4>{{ subcategory.name }}</h4>
                    <button class="edit-btn" @click="editCategory(subcategory)">Edit Sub Category</button>
                    <button class="delete-btn" @click="deleteCategory(subcategory.id)">Delete Sub Category</button>
                    <ul class="item-info">
                        <li v-for="item in subcategory.items" :key="item.id">
                            <ul>
                                <button class="edit-btn" @click="editItem(item)">Edit Item</button>
                                <button class="delete-btn" @click="deleteItem(item.id)">Delete Item</button>
                                <p>Item name : <span>{{ item.name }}</span> </p>
                                <p>Price : <span>{{ item.price }}</span> </p>
                                <span v-if="item.discount">{{ item.discount }}</span>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <p v-else>No subcategories found.</p>
    </div>
</template>



<script setup>
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import { defineProps } from 'vue';

const props = defineProps({
    category: {
        type: Object,
        required: true
    }
});

const router = useRouter();
const store = useStore();

const editCategory = (category) => {
    router.push({ name: 'EditCategory', params: { id: category.id } });
};

const deleteCategory = async (categoryId) => {
    await store.dispatch('deleteCategory', categoryId);
};

const editItem = (item) => {
    router.push({ name: 'EditItem', params: { id: item.id } });
};

const deleteItem = async (itemId) => {
    await store.dispatch('deleteitem', itemId);
};


</script>

<style scoped>
.category-card {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 20px;
}

.category-card {
    margin-bottom: 20px;
}

.category-card ul {
    margin: 0;
    padding: 0;
}

.item-info,
.sub-info {
    padding-left: 20px !important;
}


.category-card h2 {
    margin-bottom: 10px;
}

.category-card h3 {
    margin-bottom: 5px;
}



.category-card ul li {
    margin-bottom: 10px;
}

.edit-btn {
    background-color: #4caf50;
    color: white;
    border: none;
}

.delete-btn {
    background-color: #f44336;
    color: white;
    border: none;
}
</style>