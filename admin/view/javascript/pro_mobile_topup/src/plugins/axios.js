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
      notify.messageHandler({
        error: [
          'We detected that request have returned unexpected result. Please try again.',
        ],
      })
    }

    return response
  },
  error => {
    const { status } = error.response

    if (status !== 200) {
      notify.messageHandler({
        error: ['We detected that request have returned an error.'],
      })
    }

    return Promise.reject(error)
  }
)
