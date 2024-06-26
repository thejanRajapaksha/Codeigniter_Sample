<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class proModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function productsviewinsertupdate() {
        $item_name = $this->input->post('item_name');
        $emp_name = $this->input->post('emp_name');
        $price = $this->input->post('price');
        $recordOption = $this->input->post('recordOption');

        $data = array(
            'item_name' => $item_name,
            'emp_name' => $emp_name,
            'price' => $price,
        );

        if($recordOption == 1){
            $this->db->insert('items', $data);
        }

        else{
            $id = $this->input->post('recordID');   
            $this->db->where('item_id', $id);
            $this->db->update('items', $data);
        }
        
    }

    public function edit_product() {
        $recordID=$this->input->post('recordID');

        $this->db->select('*');
        $this->db->from('items');
        $this->db->where('item_id', $recordID);

        $respond=$this->db->get();

        $obj=new stdClass();
        $obj->item_id=$respond->row(0)->item_id;
        $obj->item_name=$respond->row(0)->item_name;
        $obj->emp_name=$respond->row(0)->emp_name;
        $obj->price=$respond->row(0)->price;
        echo json_encode($obj);
    }


    public function delete_product() {
        $id = $this->input->post('id');
        $sql = "DELETE FROM items WHERE item_id = ?";
        return $this->db->query($sql, array($id));
    }

    public function GetEmployeeList(){
        $this->db->select('*');
        $this->db->from('employee');

        return $respond=$this->db->get();
    }

    

}
?>
