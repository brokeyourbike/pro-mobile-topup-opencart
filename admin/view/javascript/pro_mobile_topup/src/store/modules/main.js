import Vue from 'vue'
import { make } from 'vuex-pathify'
import sleep from 'sleep-promise'

// initial state
const state = {
  setting: {},
  isLoading: false
}

// getters
const getters = {
  getToggleStates: state => {
    return {
      checked: state.text_enabled,
      unchecked: state.text_disabled
    }
  }
}

// actions
const actions = {
  INIT_DATA ({ commit }) {
    const codename = Vue.prototype.$codename

    if (typeof window[`__${codename}__`] === 'object') {
      commit('SET_DATA', window[`__${codename}__`])
    }
  },
  async SAVE_AND_STAY_REQUEST ({ commit, state }) {
    commit('SET_IS_LOADING', true)
    await Vue.prototype.$http.post(state.save, state.setting)
    commit('SET_IS_LOADING', false)
  },
  async SAVE_AND_GO_REQUEST ({ dispatch, state }) {
    await dispatch('SAVE_AND_STAY_REQUEST')
    await sleep(1500)
    window.location.href = state.cancel
  }
}

// mutations
const mutations = {
  SET_DATA (state, data) {
    for (const d in data) {
      state[d] = data[d]
    }
  },

  ...make.mutations(state)
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
