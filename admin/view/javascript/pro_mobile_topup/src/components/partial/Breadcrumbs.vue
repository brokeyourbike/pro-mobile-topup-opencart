<template>
  <ul class="breadcrumb">
    <li v-for="(breadcrumb, k) in crumbs" :key="k">
      <a :href="breadcrumb.href" v-text="breadcrumb.text" />
    </li>
  </ul>
</template>

<script type="text/javascript">
export default {
  props: {
    crumbs: {
      type: Array,
      required: false,
      default() {},
    },
  },
}
</script>
