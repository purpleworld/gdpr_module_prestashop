<?php
class CSVExport {
    public $filename;
    public $collection;
    public $delimiter;
    /**
     * Loads objects, filename and optionnaly a delimiter.
     * @param array|Iterator $collection Collection of objects / arrays (of non-objects)
     * @param string $filename : used later to save the file
     * @param string $delimiter Optional : delimiter used
     */
    public function __construct($collection, $filename, $delimiter = ';')
    {
        $this->filename = $filename;
        $this->delimiter = $delimiter;
        $this->collection = $collection;
    }
    /**
     * Main function
     * Adds headers
     * Outputs
     */
    public function export()
    { //ddd($this->collection);
        $this->headers();
        $header_line = false;

        foreach ($this->collection as $object) {
            unset($object->id);
            unset($object->id_shop_list);
            unset($object->force_id);

            $user_id = $object->{'user_id'};
            $data_file = $object->{'data_file_id'};
            $sql = "SELECT secure_key FROM "._DB_PREFIX_."customer WHERE id_customer = ".$user_id;
            $secure_key = Db::getInstance()->executeS($sql);
            $object->accept_link = md5($user_id."1".$secure_key[0]['secure_key'].$data_file);
            $object->deny_link = md5($user_id."0".$secure_key[0]['secure_key'].$data_file);

            $vars = get_object_vars($object);
            if (!$header_line) {
                $this->output(array_keys($vars));
                $header_line = true;
            }
            // outputs values
            $this->output($vars);
            unset($vars);
        }
    }
    /**
     * Wraps data and echoes
     * Uses defined delimiter
     */
    public function output($data)
    {
        $wraped_data = array_map(array('CSVCore', 'wrap'), $data);
        echo sprintf("%s\n", implode($this->delimiter, $wraped_data));
    }
    /**
     * Escapes data
     * @param string $data
     * @return string $data
     */
    public static function wrap($data)
    {
        $data = str_replace(array('"', ';'), '', $data);
        return sprintf('"%s"', $data);
    }
    /**
     * Adds headers
     */
    public function headers()
    {
        header('Content-type: text/csv');
        header('Content-Type: application/force-download; charset=UTF-8');
        header('Cache-Control: no-store, no-cache');
        header('Content-disposition: attachment; filename="'.$this->filename.'.csv"');
    }
}