<?php
/*
 *  location: admin/model
 */
class ModelExtensionModuleProMobileTopup extends Model
{
    private $codename = 'pro_mobile_topup';
    private $route = 'extension/module/pro_mobile_topup';

    private $store_id = 0;
    private $setting = array();

    public function __construct($registry)
    {
        parent::__construct($registry);

        $this->load->model('extension/pro_patch/setting');

        $this->setting = $this->model_extension_pro_patch_setting->getSetting($this->codename, $this->store_id);
    }

    public function getScriptFiles()
    {
        return array(
            "view/javascript/{$this->codename}/dist/{$this->codename}.js"
        );
    }

    public function getStyleFiles()
    {
        return array(
            HTTPS_CATALOG . "catalog/view/javascript/{$this->codename}/dist/{$this->codename}.css"
        );
    }

    public function createTables()
    {
        //
    }

    public function dropTables()
    {
        $this->db->query("DROP TABLE IF EXISTS `". DB_PREFIX . \pro_mobile_topup\constant::ORDERS_TABLE ."`");
    }

    public function isProductExist($product_id)
    {
        $query = $this->db->query("SELECT * FROM `". DB_PREFIX ."product`
            WHERE `product_id` = '" . (int) $product_id . "'");

        if ($query->num_rows) {
            return true;
        }

        return false;
    }
}
