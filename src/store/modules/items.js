import { BASE_URL } from '@/api'

const state = {
  items: []
}

const getters = {
  fetchitems: (state) => state.items,
  fetchitemById: (state) => (itemId) => {
    return state.items.find((item) => item.id === itemId)
  }
}

const actions = {
  async fetchitems({ commit }) {
    try {
      const response = await fetch(`${BASE_URL}items`)
      const data = await response.json()
      commit('SET_items', data.data)
    } catch (error) {
      console.error(error)
    }
  },

  async fetchitemById({ commit }, itemId) {
    try {
      const response = await fetch(`${BASE_URL}items/${itemId}`)
      const data = await response.json()
      commit('SET_item', data.data)
    } catch (error) {
      console.error(error)
    }
  },

  async addItem({ commit }, item) {
    try {
      const response = await fetch(`${BASE_URL}items`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(item)
      })
      const data = await response.json()
      console.log(data,"asd")
      commit('ADD_item', data)
    } catch (error) {
      console.error(error)
    }
  },
  async editItem({ commit }, item) {

    try {
      const response = await fetch(`${BASE_URL}items/${item.id}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(item)
      })

      const data = await response.json()
      commit('EDIT_item', data.data)
    } catch (error) {
      console.error(error)
    }
  },
  async deleteitem({ commit }, id) {
    try {
      await fetch(`${BASE_URL}items/${id}`, {
        method: 'DELETE'
      })
      commit('DELETE_item', id)
    } catch (error) {
      console.error(error)
    }
  }
}

const mutations = {
  SET_items(state, items) {
    state.items = items
  },

  SET_item(state, item) {
    const index = state.items.findIndex((c) => c.id === item.id)
    if (index !== -1) {
      state.items[index] = item
    } else {
      state.items.push(item)
    }
  },

  ADD_item(state, item) {
    state.items.push(item)
  },
  EDIT_item(state, updateditem) {
    const index = state.items.findIndex((cat) => cat.id === updateditem.id)
    if (index !== -1) {
      state.items.splice(index, 1, updateditem)
    }
  },
  DELETE_item(state, id) {
    state.items = state.items.filter((cat) => cat.id !== id)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
