import { createRouter, createWebHistory } from 'vue-router'
import CategoryFormVeiw from '../views/CategoryFormVeiw.vue'
import RestaurantMenuView from '../views/RestaurantMenuView.vue'
import CategoryForm from '@/components/CategoryForm.vue'
import ItemForm from '@/components/ItemForm.vue'
import DiscountForm from '@/components/DiscountForm.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/categories',
      name: 'Categories',
      component: RestaurantMenuView
    },
    {
      path: '/categories/add',
      name: 'AddCategory',
      component: CategoryForm,
      props: {
        mode: 'add',
        categoryId: null
      }
    },

    {
      path: '/categories/edit/:id',
      name: 'EditCategory',
      component: CategoryForm,
      props: (route) => ({
        mode: 'edit',
        categoryId: parseInt(route.params.id)
      })
    },

    {
      path: '/items/add',
      name: 'AddItem',
      component: ItemForm,
      props: {
        mode: 'add',
        itemId: null
      }
    },
    {
      path: '/items/edit/:id',
      name: 'EditItem',
      component: ItemForm,
      props: (route) => ({ mode: 'edit', itemId: parseInt(route.params.id) })
    },

    {
      path: '/discounts/add',
      name: 'AddDiscount',
      component: DiscountForm,
      props: {
        mode: 'add',
        itemId: null
      }
    },
    {
      path: '/discounts/edit/:id',
      name: 'EditDiscount',
      component: DiscountForm,
      props: (route) => ({ mode: 'edit', discountId: parseInt(route.params.id) })
    }
  ]
})

export default router
