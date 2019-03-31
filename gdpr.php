<?php

require_once(__DIR__ . '/classes/GDPRAgreement.php');
require_once(__DIR__ . '/classes/GDPRDataFile.php');

class GDPR extends Module
{
    private $_default_values = array(
    'GDPR_FREQUENCY' => '25'
    );

    public function __construct() {
        $this->name = 'gdpr';
        $this->tab = 'front_office_features';
        $this->version = '0.0.1';
        $this->author = 'Jérémy Schneider';
        $this->need_instance = 0;


        parent::__construct();

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        $this->displayName = $this->l('GDPR');
        $this->description = $this->l('');

    }


    public function install(){
        return (
            parent::install()
            && $this->_initDefaultConfigurationValues()
            && $this->installSQL()
            && $this->installTab('DEFAULT', 'AdminGDPR', 'GDPR')
            && $this->installTab('AdminGDPR', 'AdminGDPRAgreement', 'Agreements')
            && $this->installTab('AdminGDPR', 'AdminGDPRDataFile', 'Data Files')
            && $this->registerHook('displayBackOfficeHeader')
            && $this->registerHook('customerAccount')
            && $this->installDefaultSQL()
        );
    }

    private function _initDefaultConfigurationValues()
    {
        foreach ($this->_default_values as $key => $value) {
            if (false === Configuration::get($key)) {
                Configuration::updateValue($key, $value);
            }
        }
        return true;
    }


    public function uninstall()
    {
        return parent::uninstall()
        && $this->uninstallTab('AdminGDPR');
    }

    private function installSQL(){
        $sqls = [];
        $sqls[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'admin_gdpr_agreement`(
            `id_admin_gdpr_agreement` int(11) NOT NULL AUTO_INCREMENT,
            `email` varchar(1024) NOT NULL,
            `firstname` varchar(1024) NOT NULL,
            `lastname` varchar(1024) NOT NULL,
            `date` datetime NOT NULL,
                PRIMARY KEY (`id_admin_gdpr_agreement`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;';

        $sqls[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'admin_gdpr_data_file`(
            `id_admin_gdpr_data_file` int(11) NOT NULL AUTO_INCREMENT,
            `data_file_name` varchar(1024) NOT NULL,
            `description` varchar(1024) NOT NULL,
                PRIMARY KEY (`id_admin_gdpr_data_file`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;';

        $db = DB::getInstance();

        foreach($sqls as $sql)
        {
            $db->execute($sql);
        }
        return true;
    }

    private function installDefaultSQL(){
        GDPRDataFile::defaultSQL();
    }

    private function installTab($parent, $class_name, $name) {
        $tab = new Tab();
        $tab->id_parent = (int)Tab::getIdFromClassName($parent);
        $tab->name = array();
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = $name;
        }
        $tab->class_name = $class_name;
        $tab->module = $this->name;
        $tab->active = 1;
        return $tab->add();
    }

    private function uninstallTab($class_name){
        $id_tab = (int)Tab::getIdFromClassName($class_name);

        if ($id_tab){
            $tab = new Tab((int)$id_tab);
            return $tab->delete();
        }

        return false;
    }

    public function processConfiguration()
    {
        if(Tools::isSubmit('submitgdpr')){
            $set_day = Tools::getValue('GDPR_FREQUENCY');
            Configuration::updateValue('GDPR_FREQUENCY', $set_day);
        }
    }

    public function getContent()
    {
        $html = '';

        $html .= $this->processConfiguration();

        $defaultLang = (int)Configuration::get('PS_LANG_DEFAULT');

        $fieldsForm[0]['form'] = [
            'legend' => [
                'title' => $this->l('GDPR configuration')
            ],
            'input' => [
                [
                'type' => 'text',
                'label' => $this->l('Acceptance proof frequency'),
                'name' => 'GDPR_FREQUENCY',
                'required' => true
                ]
            ],
            'submit' => [
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right'
            ]
        ];

        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->module = $this;

        $helper->title = $this->displayName;
        $helper->show_toolbar = true;        // false -> remove toolbar
        $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = [
            'save' => [
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
                    '&token='.Tools::getAdminTokenLite('AdminModules'),
            ],
            'back' => [
                'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            ]
        ];

        // Load current value
        foreach ($this->_default_values as $key => $default_value) {
            $helper->fields_value[$key] = Configuration::get($key);
        }

        $html .= $helper->generateForm($fieldsForm);

        return $html;

    }

    public function  hookDisplayBackOfficeHeader(){
        $this->context->controller->addCSS($this->_path.'css/tab.css');
    }
    public function hookCustomerAccount(){
        return($this->display(__FILE__, 'customerAccount.tpl'));
    }

}