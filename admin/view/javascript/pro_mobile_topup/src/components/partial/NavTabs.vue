<template>
  <div>
    <ul class="nav nav-tabs">
      <li
        @click="navigateToTab(k)"
        v-for="(nav, k) in navs"
        :key="k"
        :class="{ active: nav.active }"
      >
        <a>
          <span v-if="nav.icon" :class="nav.icon" />
          {{ nav.title }}
        </a>
      </li>
    </ul>

    <slot />
  </div>
</template>

<script>
export default {
  computed: {
    navs() {
      return this.tabs.map((tab, index) => {
        if (!tab) return
        let { title, icon } = tab
        let active = this.activeTabIndex === index
        if (active) this.activateTab(index)

        return {
          active,
          title,
          icon,
        }
      })
    },
  },
  data() {
    return {
      activeTabIndex: 0,
      tabs: [],
    }
  },
  methods: {
    navigateToTab(index) {
      this.changeTab(this.activeTabIndex, index)
    },
    activateTab(index) {
      this.activeTabIndex = index
      let tab = this.tabs[index]
      tab.active = true
      this.$emit('input', tab.title)
    },
    changeTab(oldIndex, newIndex) {
      let oldTab = this.tabs[oldIndex] || {}
      let newTab = this.tabs[newIndex]
      this.activeTabIndex = newIndex
      oldTab.active = false
      newTab.active = true
      this.$emit('input', this.tabs[newIndex].title)
      this.$emit('tab-change', newIndex, newTab, oldTab)
    },
    addTab(item) {
      const index = this.$slots.default.indexOf(item.$vnode)
      this.tabs.splice(index, 0, item)
    },
    removeTab(item) {
      const tabs = this.tabs
      const index = tabs.indexOf(item)
      if (index > -1) {
        tabs.splice(index, 1)
      }
    },
    getTabs() {
      if (this.$slots.default) {
        return this.$slots.default.filter((comp) => comp.componentOptions)
      }
      return []
    },
  },
  watch: {},
}
</script>

<style lang="scss" scoped>
li {
  cursor: pointer;

  a {
    cursor: pointer;
  }
}
</style>
