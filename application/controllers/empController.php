<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class empController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('empModel');
    }

    public function index() {
        $data['employee'] = $this->empModel->get_all_products();
        $this->load->view('employee');
    }

    public function Employeeinsertupdate() {
        $this->empModel->Employeeinsertupdate();
        $result=$this->empModel->Employeeinsertupdate();
        redirect('empController/index');
    }
    
    public function edit_product() {
        $this->empModel->edit_product();
    }

    public function delete_product() {
        $this->empModel->delete_product();
        echo json_encode(array("status" => "success"));
    }

}
?>
