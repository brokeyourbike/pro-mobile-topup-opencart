<template>
  <form class="form-horizontal">
    <div class="form-group">
      <label class="col-sm-2 control-label">{{ text_status }}</label>
      <div class="col-sm-10">
        <toggle-button
          v-model="status"
          :width="80"
          :height="25"
          :labels="getToggleStates"
        />
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">{{ text_debug }}</label>
      <div class="col-sm-10">
        <toggle-button
          v-model="debug"
          :width="80"
          :height="25"
          :labels="getToggleStates"
        />
      </div>
    </div>
  </form>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex'
import { get, sync } from 'vuex-pathify'

export default {
  computed: {
    ...mapState('main', [
      'text_status',
      'text_debug',
      'text_api_key',
      'text_api_secret',
      'text_language_code',
    ]),
    ...mapGetters('main', ['getToggleStates']),

    status: sync('main/setting@status'),
    debug: sync('main/setting@debug'),
  },
}
</script>
