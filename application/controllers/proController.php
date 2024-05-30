<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class proController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('proModel');
    }

    public function index() {
        $result['employeeList']=$this->proModel->GetEmployeeList();
        $this->load->view('productsview',$result);
    }

    public function productsviewinsertupdate() {
        $result=$this->proModel->productsviewinsertupdate();
        redirect('proController/index');
    }
    
    public function edit_product() {
        $this->proModel->edit_product();
    }

    public function delete_product() {
        $this->proModel->delete_product();
        echo json_encode(array("status" => "success"));
    }

}
?>
