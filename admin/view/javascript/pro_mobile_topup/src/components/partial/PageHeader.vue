<template>
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right form-inline">
        <slot name="buttons" />
      </div>

      <h1>{{ title }} {{ version }}</h1>

      <slot />
    </div>
  </div>
</template>

<script type="text/javascript">
export default {
  props: {
    title: {
      type: String,
      required: false,
      default: '',
    },
    version: {
      type: String,
      required: false,
      default: '',
    },
  },
}
</script>
