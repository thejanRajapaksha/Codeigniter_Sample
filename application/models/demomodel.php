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
        $recordOption = $this->input->post('recordOption');

        if($recordOption == 1){
            $sql = "INSERT INTO products (Product_name, date, quantity, Unit_price, Selling_price) 
                    VALUES (?, ?, ?, ?, ?)";
            return $this->db->query($sql, array($Product_name, $date, $quantity, $Unit_price, $Selling_price));
        }

        else{
            $id = $this->input->post('id');   
            $sql = "UPDATE products SET Product_name = ?, date = ?, quantity = ?, Unit_price = ?, Selling_price = ? WHERE id = ?";
            return $this->db->query($sql, array($Product_name, $date, $quantity, $Unit_price, $Selling_price, $id));
        }
        
    }

    public function edit_product() {
        $recordID=$this->input->post('recordID');

        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('id', $recordID);

        $respond=$this->db->get();

        $obj=new stdClass();
        $obj->id=$respond->row(0)->id;
        $obj->product_name=$respond->row(0)->Product_name;
        $obj->date=$respond->row(0)->date;
		$obj->quantity=$respond->row(0)->quantity;
        $obj->unit_price=$respond->row(0)->Unit_price;
        $obj->selling_price=$respond->row(0)->Selling_price;
        echo json_encode($obj);
    }

    public function get_all_products() {
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function delete_product() {
        $id = $this->input->post('id');
        $sql = "DELETE FROM products WHERE id = ?";
        return $this->db->query($sql, array($id));
    }

}
?>
