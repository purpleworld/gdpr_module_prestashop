<?php
class GDPRDataFile extends ObjectModel {
    public $id_admin_gpdr_data_file;
    public $data_file_name;
    public $description;

    public static $definition = array (
        'table' => 'admin_gdpr_data_file',
        'primary' => 'id_admin_gpdr_data_file',
        'fields' => array(
            'data_file_name' => array('type' => self::TYPE_STRING, 'validate' => 'isName'),
            'description' => array('type' => self::TYPE_STRING, 'validate' => 'isDescription'),
        )
    );

    public static function defaultSQL(){
        $sqls = [];
        $sqls[] = 'INSERT IGNORE INTO`'._DB_PREFIX_.'admin_gdpr_data_file`(`id_admin_gdpr_data_file`, `data_file_name`, `description`)
                   VALUES (1, \'Accounting\', \'\')';
        $sqls[] = 'INSERT IGNORE INTO`'._DB_PREFIX_.'admin_gdpr_data_file`(`id_admin_gdpr_data_file`, `data_file_name`, `description`)
                   VALUES (2, \'Traffic statistics\', \'\')';
        $sqls[] = 'INSERT IGNORE INTO`'._DB_PREFIX_.'admin_gdpr_data_file`(`id_admin_gdpr_data_file`, `data_file_name`, `description`)
                   VALUES (3, \'Marketing history\', \'\')';

        $db = DB::getInstance();

        foreach($sqls as $sql){
            $db->execute($sql);
        }
        return true;
    }
}