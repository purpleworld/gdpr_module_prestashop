<?php

class AdminGDPRDataFileController extends ModuleAdminController {

    public $bootstrap = true;

    public function __construct(){
        $this->table = 'admin_gdpr_data_file';
        $this->className = 'AdminGDPRAgreement';
        $this->fields_list = array(
            'id_admin_gdpr_data_file' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 25),
            'data_file_name' => array('title' => $this->l('Name'), 'width' => 140),
            'description' => array('title' => $this->l('Description'), 'width' => 140),
        );

        parent::__construct();
    }

}