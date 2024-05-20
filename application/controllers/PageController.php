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

}
?>
