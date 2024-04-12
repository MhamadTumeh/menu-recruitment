<template>
    <div>
      <!-- Categories -->
      <h1 class="text-3xl font-semibold mb-4">Restaurant Menu</h1>
      <div v-if="categories.length">
        <ul>
          <li v-for="category in categories" :key="category.id" class="mb-4">
            <div class="flex justify-between items-center mb-2">
              <h2 class="text-xl font-semibold">{{ category.name }}</h2>
              <div>
                <button @click="editCategory(category)" class="mr-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</button>
                <button @click="deleteCategory(category.id)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
              </div>
            </div>
            <!-- Subcategories -->
            <ul v-if="category.subcategories.length">
              <li v-for="subcategory in category.subcategories" :key="subcategory.id" class="ml-4">
                <div class="flex justify-between items-center mb-2">
                  <h3 class="text-lg font-semibold">{{ subcategory.name }}</h3>
                  <div>
                    <button @click="editSubcategory(subcategory)" class="mr-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</button>
                    <button @click="deleteSubcategory(subcategory.id)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                  </div>
                </div>
                <!-- Items -->
                <ul v-if="subcategory.items.length">
                  <li v-for="item in subcategory.items" :key="item.id" class="flex justify-between items-center">
                    <span class="mr-2">
                      <img v-if="item.image" :src="item.image" alt="" width="50" height="50" class="rounded-full mr-2">
                      {{ item.name }}
                    </span>
                    <span class="font-bold">
                      {{ getDiscountedPrice(item.price) }}
                      <span v-if="item.originalPrice" class="text-gray-400 line-through">{{ item.originalPrice }}</span>
                    </span>
                    <div>
                      <button @click="editItem(item)" class="mr-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</button>
                      <button @click="deleteItem(item.id)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                    </div>
                  </li>
                </ul>
                <p v-else>No items found.</p>
              </li>
            </ul>
            <p v-else>No subcategories found.</p>
          </li>
        </ul>
      </div>
      <p v-else>No categories found.</p>
    </div>
  </template>

<script lang="ts">
import { defineComponent } from 'vue';

interface Item {
    id: number;
    name: string;
    price: number;
    originalPrice?: number; // Optional property for original price
    image?: string; // Optional property for image URL
}

interface Subcategory {
    id: number;
    name: string;
    items: Item[];
}

interface Category {
    id: number;
    name: string;
    subcategories: Subcategory[];
}

export default defineComponent({
    name: 'RestaurantMenu',
    data() {
        return {
            categories: [] as Category[],
        };
    },
    mounted() {
        this.fetchMenu();
    },
    methods: {
        async fetchMenu() {
            try {
                const response = await fetch('http://localhost:8000/api/categories');
                const data = await response.json();
                this.categories = data.data;
            } catch (error) {
                console.error(error);
                // Handle error (e.g., display user-friendly message)
            }
        },
        getDiscountedPrice(price: number) {
            // Implement logic to check for discounts and apply them
            // This example assumes a single discount per item (replace with your actual logic)
            return price; // Replace with discounted price calculation
        },
    },
});
</script>

<style scoped>
/* Add your custom styles here */
.text-3xl {
    font-size: 1.875rem;
}

.text-xl {
    font-size: 1.25rem;
}

.text-lg {
    font-size: 1.125rem;
}

.font-semibold {
    font-weight: 600;
}

.mb-4 {
    margin-bottom: 1rem;
}

.mr-2 {
    margin-right: 0.5rem;
}

.flex {
    display: flex;
}

.justify-between {
    justify-content: space-between;
}

.items-center {
    align-items: center;
}

.rounded-full {
    border-radius: 50%;
}

/* Add more styles as needed */
</style>