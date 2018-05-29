import axios from 'axios'

// initial state
const state = {
        id: null,
        name: null,
        email: null
}

// getters
const getters = {
    get: state => state
}

// actions
const actions = {
    getAllProducts ({ commit }) {
        shop.getProducts(products => {
            commit('setProducts', products)
        })
    }
}

// mutations
const mutations = {
    setUser (state, user) {
        state.id = user.id
        state.name = user.name
        state.email = user.email
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}