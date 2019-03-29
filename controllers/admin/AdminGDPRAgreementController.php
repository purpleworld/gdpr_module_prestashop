<?php

class AdminGDPRAgreementController extends ModuleAdminController {

    public $bootstrap = true;

    public function __construct(){
        $this->table = 'admin_gdpr_agreement';
        $this->className = 'GDPRAgreement';
        $this->fields_list = array(
            'id_admin_gdpr_agreement' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 25),
            'ip' => array('title' => $this->l('IP'), 'width' => 25),
            'email' => array('title' => $this->l('Email'), 'width' => 140),
            'firstname' => array('title' => $this->l('Firstname'), 'width' => 140),
            'lastname' => array('title' => $this->l('Lastname'), 'width' => 140),
            'status' => array('title' => $this->l('Status'), 'width' => 50),
            'date' => array('title' => $this->l('Date'), 'type' => 'date')
        );

        parent::__construct();
    }
}