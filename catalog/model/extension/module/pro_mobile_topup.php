<?php
/*
 *  location: catalog/model
 */
class ModelExtensionModuleProMobileTopup extends Model
{
    private $codename = 'pro_mobile_topup';
    private $route = 'extension/module/pro_mobile_topup';

    private $setting = array();

    public function __construct($registry)
    {
        parent::__construct($registry);

        $this->load->language($this->route);
        $this->load->model('extension/pro_patch/setting');

        $this->setting = $this->model_extension_pro_patch_setting->getSetting($this->codename);
    }
}
