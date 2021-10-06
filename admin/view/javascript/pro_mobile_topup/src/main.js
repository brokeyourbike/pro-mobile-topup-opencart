import Vue from 'vue'
import Notifications from 'vue-notification'
import ToggleButton from 'vue-js-toggle-button'
import VueGoodTable from 'vue-good-table'
import VModal from 'vue-js-modal'

import 'vue-loading-overlay/dist/vue-loading.min.css'
import 'vue-good-table/dist/vue-good-table.css'

import store from '@/store'
import '@/plugins'
import App from '@/components/App.vue'

Vue.config.productionTip = false
Vue.prototype.$codename = 'pro_mobile_topup'

Vue.use(Notifications)
Vue.use(ToggleButton)
Vue.use(VueGoodTable)
Vue.use(VModal, { dialog: true })

document.addEventListener('DOMContentLoaded', () => {
  if (document.getElementById(`${Vue.prototype.$codename}`)) {
    new Vue({
      store,
      render: h => h(App),
    }).$mount(`#${Vue.prototype.$codename}`)
  }
})
