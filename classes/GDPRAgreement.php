<?php
class GDPRAgreement extends ObjectModel {
    public $id_admin_gdpr_agreement;
    public $user_id;
    public $data_file_id;
    public $ip;
    public $email;
    public $firstname;
    public $lastname;
    public $date;

    public static $definition = array (
        'table' => 'admin_gdpr_agreement',
        'primary' => 'id_admin_gdpr_agreement',
        'fields' => array(
            'id_admin_gdpr_agreement' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
            'user_id' => array('type' => self::TYPE_STRING, 'validate' => 'isName'),
            'data_file_id' => array('type' => self::TYPE_STRING, 'validate' => 'isName'),
            'ip' => array('type' => self::TYPE_STRING, 'validate' => 'isName'),
            'email' => array('type' => self::TYPE_STRING, 'validate' => 'isEmail'),
            'firstname' => array('type' => self::TYPE_STRING, 'validate' => 'isName'),
            'lastname' => array('type' => self::TYPE_STRING, 'validate' => 'isName'),
            'status' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
            'date' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
        )
    );
}