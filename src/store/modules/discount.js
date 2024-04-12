import { BASE_URL } from '@/api'

const state = {
  discounts: []
}

const getters = {
  fetchdiscounts: (state) => state.discounts,
  fetchdiscountById: (state) => (discountId) => {
    return state.discounts.find((discount) => discount.id === discountId)
  }
}

const actions = {
  async fetchdiscounts({ commit }) {
    try {
      const response = await fetch(`${BASE_URL}discounts`)
      const data = await response.json()
      commit('SET_discounts', data.data)
    } catch (error) {
      console.error(error)
    }
  },

  async fetchdiscountById({ commit }, discountId) {
    try {
      const response = await fetch(`${BASE_URL}discounts/${discountId}`)
      const data = await response.json()
      commit('SET_discount', data.data)
    } catch (error) {
      console.error(error)
    }
  },

  async adddiscount({ commit }, discount) {
    try {
      const response = await fetch(`${BASE_URL}discounts`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(discount)
      })
      const data = await response.json()
      commit('ADD_discount', data.data)
    } catch (error) {
      console.error(error)
    }
  },
  async editdiscount({ commit }, discount) {
    try {
      const response = await fetch(`${BASE_URL}discounts/${discount.id}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(discount.discount)
      })

      const data = await response.json()
      commit('EDIT_discount', data.data)
    } catch (error) {
      console.error(error)
    }
  },
  async deletediscount({ commit }, id) {
    try {
      await fetch(`${BASE_URL}discounts/${id}`, {
        method: 'DELETE'
      })
      commit('DELETE_discount', id)
    } catch (error) {
      console.error(error)
    }
  }
}

const mutations = {
  SET_discounts(state, discounts) {
    state.discounts = discounts
  },

  SET_discount(state, discount) {
    const index = state.discounts.findIndex((c) => c.id === discount.id)
    if (index !== -1) {
      state.discounts[index] = discount
    } else {
      state.discounts.push(discount)
    }
  },

  ADD_discount(state, discount) {
    state.discounts.push(discount)
  },
  EDIT_discount(state, updateddiscount) {
    const index = state.discounts.findIndex((cat) => cat.id === updateddiscount.id)
    if (index !== -1) {
      state.discounts.splice(index, 1, updateddiscount)
    }
  },
  DELETE_discount(state, id) {
    state.discounts = state.discounts.filter((cat) => cat.id !== id)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
