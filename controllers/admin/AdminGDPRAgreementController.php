<?php
require_once(_PS_MODULE_DIR_.'gdpr/classes/GDPRAgreement.php');
require_once(_PS_MODULE_DIR_.'gdpr/helpers/CSVExport.php');

class AdminGDPRAgreementController extends ModuleAdminController {

    public $bootstrap = true;

    public function __construct(){
        $this->table = 'admin_gdpr_agreement';
        $this->className = 'GDPRAgreement';
        $this->fields_list = array(
            'id_admin_gdpr_agreement' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 25),
            'user_id' => array('title' => $this->l('User ID'), 'width' => 25),
            'data_file_id' => array('title' => $this->l('Name'), 'width' => 140),
            'ip' => array('title' => $this->l('IP'), 'width' => 25),
            'email' => array('title' => $this->l('Email'), 'width' => 140),
            'firstname' => array('title' => $this->l('Firstname'), 'width' => 140),
            'lastname' => array('title' => $this->l('Lastname'), 'width' => 140),
            'status' => array('title' => $this->l('Status'), 'width' => 50),
            'date' => array('title' => $this->l('Date'), 'type' => 'date')
        );
        if (Tools::getValue('exportcsv') == 'true'){
            $this->exportCSV();
        }

        parent::__construct();
    }

    public function renderList() {
        $parentList = parent::renderList();
        $linkBack = $this->context->link;

        $this->context->smarty->assign([
            'linkcsv' => $linkBack,
        ]);
        $top = $this->context->smarty->fetch(_PS_MODULE_DIR_."gdpr/views/templates/admin/csv.tpl");

        return($parentList.$top);
    }

    public function initToolbar(){
        parent::initToolbar();
        unset($this->toolbar_btn['new']);
    }

    public function exportCSV(){
        $detail = new PrestaShopCollection("GDPRAgreement");
        $csv = new CSVExport($detail, 'data');
        $csv->export();
        die();
    }

}