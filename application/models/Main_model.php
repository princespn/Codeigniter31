<?php
Class Main_model extends CI_Model {


    public  function new_listing($data){

// Query to check whether Listing already exist or not
        $condition = "item_sku =" . "'" . $data['item_sku'] . "'";
        $this->db->select('*');
        $this->db->from('main_listings');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {

// Query to insert data in database
            $this->db->insert('main_listings', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            return false;
        }

    }


public  function show_listing(){

    $query = $this->db->get('main_listings');
    if($query->num_rows() > 0){
        $result = $query->result_array();
        return $result;
    }else{
        return false;
    }

    }

    public function upload_csv($filename)
    {

        $file_path =  './files/'.$filename;
        $fp = fopen($file_path, 'r') or die("can't open file");

        while ($data = fgetcsv($fp, 1024)) {
            for ($i = 0, $j = count($data); $i < $j; $i++) {
                $item['item_sku'] = $data[0];
                $item['product_name'] = $data[1];
                $item['cat_name'] = $data[2];
                $item['barcode'] = $data[3];
                $item['prices'] = $data[4];
            }
            $data = array('item_sku' => $item['item_sku'],
                'product_name' => $item['product_name'],
                'cat_name' => $item['cat_name'],
                'barcode' => $item['barcode'],
                'prices' => $item['prices']);

            $this->db->insert('main_listing', $data);

        }

       fclose($fp) or die("can't close file");
       $data['success'] = "success";
        return $data;

    }


}

?>