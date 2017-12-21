<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Main extends CI_Controller {

public function __construct() {

parent::__construct();

// Load form helper library
$this->load->helper('form');

$this->load->helper('url');

// Load form validation library
$this->load->library('form_validation');

// Load session library
$this->load->library('session');

$this->load->library('upload');
$this->load->helper(array('form', 'url', 'captcha', 'email'));
$this->load->database();
$this->load->helper('file');

// Load Model
$this->load->model('main_model');


}

// Show listing form page
public function add_listing() {
    // Check validation for user input in form
    $this->form_validation->set_rules('item_sku', 'Item sku', 'trim|required|xss_clean|is_unique[main_listings.item_sku]');
    $this->form_validation->set_rules('product_name', 'Product name', 'trim|required|xss_clean');
    $this->form_validation->set_rules('cat_name', 'Category name', 'trim|required|xss_clean');
    $this->form_validation->set_rules('barcode', 'Barcode', 'trim|required|xss_clean');
    $this->form_validation->set_rules('prices', 'Prices', 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
        $data['title'] = "Linnworks codes and All Prices Comparison";
        $this->load->view('header',$data);
        $this->load->view('main/add_listing');
        $this->load->view('footer');
    } else {
        $data = array(
            'item_sku' => $this->input->post('item_sku'),
            'product_name' => $this->input->post('product_name'),
            'cat_name' => $this->input->post('cat_name'),
            'barcode' => $this->input->post('barcode'),
            'prices' => $this->input->post('prices'));
        $listing = $this->main_model->new_listing($data);
        $data['listings'] = $this->main_model->show_listing();
        $data['title'] = "Linnworks All Listing";
        $this->load->view('header',$data);
        $this->load->view('main/main_listing');
        $this->load->view('footer');
    }

	}


    public function index() {
    $result = $this->main_model->all_listing();
        $data['title'] = "All Listing";
        $this->load->view('header',$data);
        $this->load->view('user/login');
        $this->load->view('footer');
    }

    public function imports(){

        if((isset($_POST["submit"])) && ($_FILES['main_listing']['name'])) {

                $filename = $_FILES['main_listing']['name'];
                $file_ext = explode(".",$filename);
                //print_r($file_ext);die();

                if ($file_ext[1] == 'csv') {

                    $upload_path = './files/';
                    $config['upload_path'] = $upload_path;
                    $config['allowed_types'] = 'csv';
                    $config['max_size'] = 1000;
                    $this->upload->initialize($config);
                    $this->load->library('upload', $config);

                        // If upload failed, display error
                             if (!$this->upload->do_upload()) {
                                 print_r($filename);die();
                                $data['error'] = $this->upload->display_errors();
                                $this->load->view('header',$data);
                                $this->load->view('main/import_listing');
                                $this->load->view('footer');
                                 }
                              else
                                {

                                    $file_data = $this->upload->data();
                                    $data['listings'] = $this->main_model->upload_csv($filename);
                                }


                        }
                        else
                        {
                        $data['title'] = "Import Listing";
                        $this->load->view('header', $data);
                        $this->load->view('main/import_listing');
                        $this->load->view('footer');

                        }

        }
        else
        {
            $data['title'] = "Import Listing";
            $this->load->view('header',$data);
            $this->load->view('main/import_listing');
            $this->load->view('footer');
        }
}


}