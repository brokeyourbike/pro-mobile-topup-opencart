<template>
  <div :id="this.$codename">
    <notifications :group="this.$codename" position="bottom right" />
    <loading :active.sync="isLoading" :is-full-page="true" />
    <v-dialog />

    <page-header :title="heading_title_main" :version="version">
      <template slot="buttons">
        <button
          @click="SAVE_AND_STAY_REQUEST"
          data-toggle="tooltip"
          :title="button_save_and_stay"
          class="btn btn-success"
        >
          <i class="fa fa-save" />
        </button>
        <button
          @click="SAVE_AND_GO_REQUEST"
          data-toggle="tooltip"
          :title="button_save"
          class="btn btn-primary"
        >
          <i class="fa fa-save" />
        </button>
        <a
          :href="cancel"
          data-toggle="tooltip"
          :title="button_cancel"
          class="btn btn-default"
        >
          <i class="fa fa-reply" />
        </a>
      </template>

      <breadcrumbs :crumbs="breadcrumbs" />
    </page-header>

    <div class="container-fluid">
      <panel-default :title="text_edit">
        <nav-tabs>
          <nav-tab :title="text_setting" icon="fa fa-cog" id="setting">
            <setting-section />
          </nav-tab>
        </nav-tabs>
      </panel-default>
    </div>
  </div>
</template>


<script>
import { mapState, mapActions } from 'vuex'
import Loading from 'vue-loading-overlay'
import PageHeader from '@/components/partial/PageHeader.vue'
import Breadcrumbs from '@/components/partial/Breadcrumbs.vue'
import NavTabs from '@/components/partial/NavTabs.vue'
import NavTab from '@/components/partial/NavTab.vue'
import Panel from '@/components/partial/Panel.vue'
import Setting from '@/components/Setting.vue'

export default {
  components: {
    Loading,
    PageHeader,
    Breadcrumbs,
    NavTabs,
    NavTab,
    'panel-default': Panel,
    'setting-section': Setting,
  },
  computed: {
    ...mapState('main', [
      'breadcrumbs',
      'version',
      'heading_title_main',
      'button_save_and_stay',
      'button_save',
      'button_cancel',
      'text_edit',
      'text_setting',
      'text_yes',
      'text_no',
      'cancel',
      'save',
      'stores',
      'isLoading',
    ]),

  },
  created() {
    this.$store.dispatch('main/INIT_DATA')
  },
  methods: {
    ...mapActions('main', ['SAVE_AND_STAY_REQUEST', 'SAVE_AND_GO_REQUEST']),
  },
}
</script>

<style lang="scss">
.vue-notification {
  font-size: 20px;

  &.warn {
    background: #fd7b7c;
    border-left-color: #fd7b7c;
  }

  &.error {
    background: #fd7b7c;
    border-left-color: #fd7b7c;
  }

  &.success {
    background: #2d8353;
    border-left-color: #bfe8d2;
  }
}

</style>
