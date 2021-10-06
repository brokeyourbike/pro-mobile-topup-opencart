import Vue from 'vue'
import { isObject, has } from 'lodash'
import notify from '@/plugins/notify'

export default {
  getInlineState(cb) {
    const codename = Vue.prototype.$codename
    if (!isNil(window['__' + codename + '__'])) {
      cb(window['__' + codename + '__'])
    }
  },
  makeRequest(data, cb) {
    const url = data.url
    delete data.url

    Vue.prototype.$http
      .post(url, data)
      .then(res => {
        cb(res)
      })
      .catch(error => {
        if (has(error.response, 'data')) {
          notify.handle(error.response.data)
        }
        cb(false)
      })
  },
  makeGetRequest(data, cb) {
    const url = data.url
    delete data.url

    Vue.prototype.$http
      .get(url, { params: data })
      .then(res => {
        cb(res)
      })
      .catch(error => {
        if (has(error.response, 'data')) {
          notify.handle(error.response.data)
        }
        cb(false)
      })
  },
}
