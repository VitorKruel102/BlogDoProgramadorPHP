<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('categories_model');
        $this-> categories = $this->categories_model->list_categories();
    }

    public function index() {
        $this->load->library('table');

        $data = [
            'title'=> 'Painel Administrativo',
            'caption'=> 'Categoria',
            'categories'=> $this->categories,
        ];

        $this->load->view('Admin/templates/head', $data);
        $this->load->view('Admin/templates/template', $data);
        $this->load->view('Admin/category', $data);
        $this->load->view('Admin/templates/footer', $data);
    }
}