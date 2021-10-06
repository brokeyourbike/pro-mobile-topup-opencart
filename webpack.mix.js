const mix = require('laravel-mix')

mix
  .js('admin/view/javascript/pro_mobile_topup/src/main.js', 'admin/view/javascript/pro_mobile_topup/dist')
  .vue({ runtimeOnly: true })
  .alias({ '@': 'admin/view/javascript/pro_mobile_topup/src' })
