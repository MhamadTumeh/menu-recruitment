import { BASE_URL } from '@/api'

const state = {
  categories: []
}

const getters = {
  fetchCategories: (state) => state.categories,
  fetchCategoryById: (state) => (categoryId) => {
    return state.categories.find((category) => category.id === categoryId)
  }
}

const actions = {
  async fetchCategories({ commit }) {
    try {
      const response = await fetch(`${BASE_URL}categories`)
      const data = await response.json()
      commit('SET_CATEGORIES', data.data)
    } catch (error) {
      console.error(error)
    }
  },

  async fetchSubCategories({ commit }) {
    try {
      const response = await fetch(`${BASE_URL}categories/leaf`)
      const data = await response.json()
      commit('SET_SUB_CATEGORIES', data.data)
    } catch (error) {
      console.error(error)
    }
  },

  async fetchCategoryById({ commit }, categoryId) {
    try {
      const response = await fetch(`${BASE_URL}categories/${categoryId}`)
      const data = await response.json()
      commit('SET_CATEGORY', data.data)
    } catch (error) {
      console.error(error)
    }
  },

  async addCategory({ commit }, category) {
    try {
      const response = await fetch(`${BASE_URL}categories`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(category)
      })
      const data = await response.json()
      commit('ADD_CATEGORY', data.data)
    } catch (error) {
      console.error(error)
    }
  },
  async editCategory({ commit }, category) {
    try {
      const response = await fetch(`${BASE_URL}categories/${category.id}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(category.category)
      })

      const data = await response.json()
      commit('EDIT_CATEGORY', data.data)
    } catch (error) {
      console.error(error)
    }
  },
  async deleteCategory({ commit }, id) {
    // console.log("id",id)
    try {
      await fetch(`${BASE_URL}categories/${id}`, {
        method: 'DELETE'
      })
      commit('DELETE_CATEGORY', id)
    } catch (error) {
      console.error(error)
    }
  }
}

const mutations = {
  SET_CATEGORIES(state, categories) {
    state.categories = categories
  },

  SET_SUB_CATEGORIES(state, categories) {
    state.categories = categories
  },

  SET_CATEGORY(state, category) {
    const index = state.categories.findIndex((c) => c.id === category.id)
    if (index !== -1) {
      state.categories[index] = category
    } else {
      state.categories.push(category)
    }
  },

  ADD_CATEGORY(state, category) {
    state.categories.push(category)
  },
  EDIT_CATEGORY(state, updatedCategory) {
    const index = state.categories.findIndex((cat) => cat.id === updatedCategory.id)
    if (index !== -1) {
      state.categories.splice(index, 1, updatedCategory)
    }
  },
  DELETE_CATEGORY(state, id) {
    state.categories = state.categories.filter((cat) => cat.id !== id)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
