import Vue from 'vue'
import axios from 'axios'
import { isObject } from 'lodash'
import notify from '@/plugins/notify'

Vue.prototype.$http = axios

// Response interceptor
axios.interceptors.response.use(
  response => {
    const { data } = response

    if (!isObject(data)) {
      notify.handle({
        error: [
          'We detected that request have returned unexpected result. Please try again.'
        ]
      })
    } else {
      notify.handle(data)
    }

    return response
  },
  error => {
    const { data, status } = error.response

    if (status !== 200) {
      notify.handle({
        error: ['We detected that request have returned an error.']
      })
    }

    if (isObject(data)) {
      notify.handle(data)
    }

    return Promise.reject(error)
  }
)
