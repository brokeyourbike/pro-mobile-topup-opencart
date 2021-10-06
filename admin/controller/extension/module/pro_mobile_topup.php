<?php
/*
 *  location: admin/controller
 */
class ControllerExtensionModuleProMobileTopup extends Controller
{
    private $codename = 'pro_mobile_topup';
    private $route = 'extension/module/pro_mobile_topup';
    private $type = 'module';

    private $store_id = 0;
    private $error = array();
    private $setting = array();

    public function __construct($registry)
    {
        parent::__construct($registry);

        $this->load->language($this->route);

        $this->load->model($this->route);
        $this->load->model('extension/pro_patch/url');
        $this->load->model('extension/pro_patch/load');
        $this->load->model('extension/pro_patch/user');
        $this->load->model('extension/pro_patch/setting');
        $this->load->model('extension/pro_patch/permission');
        $this->load->model('extension/pro_patch/modification');

        $this->setting = $this->model_extension_pro_patch_setting->getSetting($this->codename);

        $this->extension_model = $this->{'model_'.str_replace("/", "_", $this->route)};
    }

    public function index()
    {
        // HEADING
        $this->document->setTitle($this->language->get('heading_title_main'));

        // STATE
        $data['codename'] = $this->codename;
        $data['state'] = json_encode($this->getState());

        $data['scripts'] = $this->extension_model->getScriptFiles();
        $data['styles'] = $this->extension_model->getStyleFiles();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->model_extension_pro_patch_load->view($this->route, $data));
    }

    public function getState()
    {
        $state = $this->model_extension_pro_patch_language->loadStrings(array(
            'heading_title',
            'text_edit',
            'text_yes',
            'text_no',
            'text_enabled',
            'text_disabled',
            'text_deleted',
            'text_undefined',
            'text_uploaded',
            'text_no_results',
            'text_total_orders',
            'text_status',
            'text_cloud_name',
            'text_product_id',
            'text_fee',
            'text_name',
            'text_api_key',
            'text_api_url',
            'text_orders',
            'text_success',
            'text_warning',
            'text_close',
            'text_cancel',
            'text_topup',
            'text_country',
            'text_operator',
            'text_phone_number',
            'text_currency',
            'text_amount',
            'text_please',
            'text_enter_mobile_number',
            'text_provider',
            'text_provider_item',
            'text_currency_in',
            'text_select_country',
            'text_select_operator',
            'text_select_currency',
            'text_select_provider',
            'text_select_provider_item',
            'text_network',
            'text_plan',
            'text_min',
            'text_max',
            'text_fee',
            'text_no_network_selected',
            'text_products',
            'text_select',
            'text_price',
            'text_description',
            'text_please_select_network',
            'button_save_and_stay',
            'button_save',
            'button_cancel',
            'button_edit',
            'button_delete',
            'button_send_recharge',
            'button_get_summary',
            'button_update_information',
            'button_start_checkout',
            'button_open_cart',
            'button_add_more_topup',
            'button_check_number',
            'button_get_plans',
            'button_topup_now',
            'button_go_to_cart',
            'help_mobile_number',
            'error_number_not_valid',
            'tab_setting',
            'tab_orders',
            'tab_topup',
        ));

        // BREADCRUMB
        $state['breadcrumbs'] = array();
        $state['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->model_extension_pro_patch_url->ajax('common/dashboard'),
        );

        $state['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_module'),
            'href'      => $this->model_extension_pro_patch_url->getExtensionAjax('module'),
        );

        $state['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title_main'),
            'href'      => $this->model_extension_pro_patch_url->ajax($this->route),
        );

        // VARIABLE
        $state['id'] = $this->codename;
        $state['route'] = $this->route;
        $state['token'] = $this->model_extension_pro_patch_user->getUrlToken();

        // ACTION
        $state['module_link'] = $this->model_extension_pro_patch_url->ajax($this->route);
        $state['cancel'] = $this->model_extension_pro_patch_url->getExtensionAjax($this->type);
        $state['get_cancel'] = $this->model_extension_pro_patch_url->getExtensionAjax($this->type);
        $state['save'] = $this->model_extension_pro_patch_url->ajax("{$this->route}/save");

        // SETTING
        $state['setting'] = $this->setting;
        $state['setting']['status'] = (bool) $state['setting']['status'];
        $state['setting']['debug'] = (bool) $state['setting']['debug'];

        return $state;
    }
}
