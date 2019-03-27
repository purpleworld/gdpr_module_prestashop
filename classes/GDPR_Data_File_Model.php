<?php
class GDPR_Data_File_Model extends ObjectModel {
    public $id_admin_gpdr_data_file;
    public $data_file_name;
    public $description;

    public static $definition = array(
        'table' => 'admin_gdpr_data_file',
        'primary' => 'id_gdpr_data_file',
        'multilang' => true,
        'fields' => array(
            'id_admin_gdpr_data_file' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
            'data_file_name' => array('type' => self::TYPE_STRING, 'validate' => 'isName'),
            'description' => array('type' => self::TYPE_STRING, 'validate' => 'isDescription'),
        )
    );
}