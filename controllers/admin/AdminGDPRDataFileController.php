<?php

class AdminGDPRDataFileController extends ModuleAdminController {

    public $bootstrap = true;

    public function __construct(){
        $this->table = 'admin_gdpr_data_file';
        $this->className = 'GDPRDataFile';
        $this->fields_list = array(
            'id_admin_gdpr_data_file' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 25),
            'data_file_name' => array('title' => $this->l('Name'), 'width' => 140),
            'description' => array('title' => $this->l('Description'), 'width' => 140),
        );

        parent::__construct();
    }
    public function renderList() {
        $this->addRowAction('add');
        $this->addRowAction('edit');
        $this->addRowAction('delete');

        return parent::renderList();
    }
    public function renderForm() {
        $this->fields_form = [
            'input' => [
                [
                    'type' => 'text',
                    'label' => $this->l('Name'),
                    'name' => 'data_file_name',
                    'required' => true,
                ],
                [
                    'type' => 'text',
                    'label' =>  $this->l('Description'),
                    'name' => 'description',
                ],
            ],
            'submit' => [
                'title' => 'Save',
                'class' => 'button'
            ]
        ];
        return parent::renderForm();
    }
}