<?php
/*
 *  location: catalog/controller
 */
class ControllerExtensionModuleProMobileTopup extends Controller
{
    private $codename = 'pro_mobile_topup';
    private $route = 'extension/module/pro_mobile_topup';

    private $store_id = 0;
    private $setting = array();

    public function __construct($registry)
    {
        parent::__construct($registry);

        $this->load->language('checkout/checkout');
        $this->load->language($this->route);

        $this->load->model($this->route);
        $this->load->model('extension/pro_patch/url');
        $this->load->model('extension/pro_patch/load');
        $this->load->model('extension/pro_patch/user');
        $this->load->model('extension/pro_patch/setting');
        $this->load->model('extension/pro_patch/json');
        $this->load->model('extension/pro_patch/language');

        $this->setting = $this->model_extension_pro_patch_setting->getSetting($this->codename);

        $this->extension_model = $this->{'model_'.str_replace("/", "_", $this->route)};
    }

    public function index()
    {
        $data['codename'] = $this->codename;

        return $this->model_extension_pro_patch_load->view($this->route, $data);
    }
}
