<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class demomodel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function add_product() {
        $Product_name = $this->input->post('product_name');
        $date = $this->input->post('date');
        $quantity = $this->input->post('quantity');
        $Unit_price = $this->input->post('unit_price');
        $Selling_price = $this->input->post('selling_price');

        $sql = "INSERT INTO products (Product_name, date, quantity, Unit_price, Selling_price) 
                VALUES (?, ?, ?, ?, ?)";
        return $this->db->query($sql, array($Product_name, $date, $quantity, $Unit_price, $Selling_price));
    }

    public function get_all_products() {
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function update_product() {
        $id = $this->input->post('id');
        $data = array(
            'Product_name' => $this->input->post('product_name'),
            'date' => $this->input->post('date'),
            'quantity' => $this->input->post('quantity'),
            'Unit_price' => $this->input->post('unit_price'),
            'Selling_price' => $this->input->post('selling_price')
        );

        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }
}
?>
