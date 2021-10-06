<template>
  <div v-show="active" class="tab-pane" :id="tabId">
    <div class="tab-body">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: '',
    },
    icon: {
      type: String,
      default: '',
    },
    id: String,
  },
  computed: {
    isValidParent() {
      return this.$parent.$options.name === 'nav-tabs'
    },
    hash() {
      return `#${this.id}`
    },
    tabId() {
      return this.id ? this.id : this.title
    },
  },
  data() {
    return {
      active: false,
    }
  },
  mounted() {
    this.$parent.addTab(this)
  },
  destroyed() {
    if (this.$el && this.$el.parentNode) {
      this.$el.parentNode.removeChild(this.$el)
    }
    this.$parent.removeTab(this)
  },
}
</script>
