import { createStore } from 'vuex'
import categories from './modules/categories'
import items from './modules/items'
import discount from './modules/discount'

export default createStore({
  modules: {
    categories,
    items,
    discount
  }
})
