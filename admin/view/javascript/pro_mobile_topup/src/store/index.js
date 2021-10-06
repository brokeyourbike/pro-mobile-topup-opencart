import Vue from 'vue'
import Vuex from 'vuex'
import pathify from 'vuex-pathify'

import main from './modules/main'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    main,
  },
  plugins: [pathify.plugin],
  strict: debug,
})
