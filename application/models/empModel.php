<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class empModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function Employeeinsertupdate() {
        $name = $this->input->post('name');
        $nic = $this->input->post('nic');
        $contact = $this->input->post('contact');
        $city = $this->input->post('city');
        $recordOption = $this->input->post('recordOption');

        if($recordOption == 1){
            $sql = "INSERT INTO employee (name, nic, contact, city) 
                    VALUES (?, ?, ?, ?)";
            return $this->db->query($sql, array($name, $nic, $contact, $city));
        }

        else{
            $id = $this->input->post('recordID');   
            $sql = "UPDATE employee SET name = ?,nic = ?, contact = ?, city = ? WHERE id = ?";
            return $this->db->query($sql, array($name, $nic, $contact, $city, $id));
        }
        
    }

    public function edit_product() {
        $recordID=$this->input->post('recordID');

        $this->db->select('*');
        $this->db->from('employee');
        $this->db->where('id', $recordID);

        $respond=$this->db->get();

        $obj=new stdClass();
        $obj->id=$respond->row(0)->id;
        $obj->name=$respond->row(0)->name;
        $obj->nic=$respond->row(0)->nic;
        $obj->contact=$respond->row(0)->contact;
		$obj->city=$respond->row(0)->city;
        echo json_encode($obj);
    }

    public function get_all_products() {
        $query = $this->db->get('employee');
        return $query->result_array();
    }

    public function delete_product() {
        $id = $this->input->post('id');
        $sql = "DELETE FROM employee WHERE id = ?";
        return $this->db->query($sql, array($id));
    }

    public function GetEmployeeList(){
        $this->db->select('*');
        $this->db->from('employee');

        return $respond=$this->db->get();
    }

}
?>
