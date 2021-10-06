<template>
  <div class="panel panel-default">
    <div class="panel-heading" style="clear: both;">
      <h3 class="panel-title"><i class="fa fa-pencil" /> {{ title }}</h3>
      <span class="pull-right">{{ extra }}</span>
    </div>

    <div class="panel-body">
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
    extra: {
      type: String,
      required: false,
      default: '',
    },
  },
}
</script>
