<?php
class GDPRAgreement extends ObjectModel {
    public $id_admin_gpdr_agreement;
    public $ip;
    public $firstname;
    public $lastname;
    public $date;

    public static $definition = array (
        'table' => 'admin_gdpr_agreement',
        'primary' => 'id_admin_gdpr_agreement',
        'fields' => array(
            'id_admin_gdpr_agreement' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
            'email' => array('type' => self::TYPE_STRING, 'validate' => 'isEmail'),
            'firstname' => array('type' => self::TYPE_STRING, 'validate' => 'isName'),
            'lastname' => array('type' => self::TYPE_STRING, 'validate' => 'isName'),
            'status' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
            'date' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
        )
    );


}