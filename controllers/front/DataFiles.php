<?php

if ( !defined('_PS_VERSION_') ) exit;

class gdprDataFilesModuleFrontController extends ModuleFrontController{
    public function __construct(){
        parent::__construct();
    }

    public function initContent(){
        $sql = 'SELECT id_admin_gdpr_data_file, data_file_name, description FROM '._DB_PREFIX_.'admin_gdpr_data_file';
        $file_name = Db::getInstance()->executeS($sql);
        $user_id = Context::getContext()->customer->id;
        $data_files_agreements = [];

        foreach($file_name as $file){
            $sql_agreement = "SELECT status FROM "._DB_PREFIX_."admin_gdpr_agreement
                                    WHERE user_id = '".$user_id."' AND data_file_id = '".$file['id_admin_gdpr_data_file']."'
                                    ORDER BY id_admin_gdpr_agreement
                                    DESC LIMIT 1";
            $agreement = Db::getInstance()->executeS($sql_agreement);
            if ($agreement) {
                $data_files_agreements[$file['id_admin_gdpr_data_file']] = $agreement[0]['status'];
            }
        }

        $this->context->smarty->assign([
            'file_name' => $file_name,
            'agreement' => $data_files_agreements
        ]);

        $this->setTemplate('DataFiles.tpl');

        parent::initContent();
    }

    public function postProcess() {
            if (Tools::isSubmit('data-files-form')){
                $user_id = Context::getContext()->customer->id;
                $ip = $_SERVER['REMOTE_ADDR'];
                $email = Context::getContext()->customer->email;
                $firstname = Context::getContext()->customer->firstname;
                $lastname = Context::getContext()->customer->lastname;

            foreach ($_POST as $key => $value){
                if ($key != 'data-files-form') {
                    $sql = "INSERT INTO`" . _DB_PREFIX_ . "admin_gdpr_agreement`(`user_id`, `data_file_id`, `ip`, `email`, `firstname`, `lastname`, `status`, `date`)
                            VALUES (".$user_id.", '".$key."', '".$ip."', '".$email."', '".$firstname."', '".$lastname."', ".$value.", NOW())";
                    $db = DB::getInstance();
                    $db->execute($sql);
                }
            }
        }
    }
}
