<?php

if ( !defined('_PS_VERSION_') ) exit;

class gdprDataFilesModuleFrontController extends ModuleFrontController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function initContent()
    {
        $sql = 'SELECT data_file_name, description FROM '._DB_PREFIX_.'admin_gdpr_data_file';
        $file_name = Db::getInstance()->executeS($sql);

        $this->context->smarty->assign([
            'file_name' => $file_name,
        ]);

        $this->setTemplate('DataFiles.tpl');

        parent::initContent();
    }
}
