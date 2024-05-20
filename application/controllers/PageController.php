<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('demomodel');
    }

    public function index() {
        $data['products'] = $this->demomodel->get_all_products();
        $this->load->view('demopage', $data);
    }

    public function add_product() {
        $this->demomodel->add_product();
        redirect('PageController/index');
    }

    public function update_product() {
        // header('Content-Type: application/json');

        $update = $this->demomodel->update_product();
        if ($update) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false));
        }
    }
}
?>
