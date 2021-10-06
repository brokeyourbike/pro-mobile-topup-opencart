import Vue from 'vue'
import { extend } from 'lodash'
import { make } from 'vuex-pathify'
import sleep from 'sleep-promise'

// initial state
const state = {
  setting: {},
  isLoading: false,
}

// getters
const getters = {
  getToggleStates: state => {
    return {
      checked: state.text_enabled,
      unchecked: state.text_disabled,
    }
  },
}

// actions
const actions = {
  initData({ commit, state }) {
    shop.getInlineState(data => {
      commit('SET_DATA', data)
    })
  },
  saveAndStayRequest({ commit, state, dispatch }) {
    commit('SET_IS_LOADING', true)
    const data = extend({}, state.setting, { url: state.save })

    shop.makeRequest(data, res => {
      commit('SET_IS_LOADING', false)
      notify.messageHandler(res.data)
    })
  },
  saveAndGoRequest({ commit, state }) {
    commit('SET_IS_LOADING', true)
    const data = extend({}, state.setting, { url: state.save })

    shop.makeRequest(data, res => {
      commit('SET_IS_LOADING', false)
      notify.messageHandler(res.data)

      sleep(1500).then(() => {
        window.location.href = state.cancel
      })
    })
  },
}

// mutations
const mutations = {
  SET_DATA(state, data) {
    for (let d in data) {
      state[d] = data[d]
    }
  },

  ...make.mutations(state),
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
}
