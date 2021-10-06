<?php
/*
 *  location: admin/controller
 */
class ControllerExtensionTotalProMobileTopup extends Controller
{
    private $codename = 'pro_mobile_topup';
    private $route = 'extension/total/pro_mobile_topup';
    private $type = 'total';

    private $store_id = 0;
    private $error = array();
    private $setting = array();

    function __construct($registry)
    {
        parent::__construct($registry);

        $this->load->language($this->route);
        $this->load->model('extension/pro_patch/url');
        $this->load->model('extension/pro_patch/setting');
    }

    public function index()
    {
        $this->document->setTitle($this->language->get('heading_title_main'));

        $data['heading_title'] = $this->language->get('heading_title_main');
        $data['text_edit'] = $this->language->get('text_edit');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['codename'] = $this->codename;

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_extension_pro_patch_setting->editSetting($this->type, $this->codename, $this->request->post, $this->store_id);

            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->model_extension_pro_patch_url->getExtensionAjax($this->type));
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->model_extension_pro_patch_url->link('common/dashboard')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get("text_{$this->type}"),
            'href' => $this->model_extension_pro_patch_url->link('marketplace/extension', "&type={$this->type}", true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_main'),
            'href' => $this->model_extension_pro_patch_url->link($this->route)
        );

        $data['action'] = $this->model_extension_pro_patch_url->link($this->route);

        $data['cancel'] = $this->model_extension_pro_patch_url->link('marketplace/extension', "&type={$this->type}", true);

        if (isset($this->request->post["{$this->codename}_status"])) {
            $data["{$this->codename}_status"] = $this->request->post["{$this->codename}_status"];
        } else {
            $data["{$this->codename}_status"] = $this->config->get("{$this->codename}_status");
        }

        if (isset($this->request->post["{$this->codename}_sort_order"])) {
            $data["{$this->codename}_sort_order"] = $this->request->post["{$this->codename}_sort_order"];
        } else {
            $data["{$this->codename}_sort_order"] = $this->config->get("{$this->codename}_sort_order");
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view($this->route, $data));
    }

    protected function validate()
    {
        if (!$this->user->hasPermission('modify', $this->route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}
