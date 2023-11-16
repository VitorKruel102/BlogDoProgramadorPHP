<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->load->helper('funcoes');
        $this->load->model('categories_model');
        $this->categories = $this->categories_model->list_categories();
    }

    /**
	 * Function index
	 *
	 * This method is responsible for loading the necessary views for the Category page.
	 *
	 * @return void
	*/
    public function index($id, $slug = null) {
        $this->load->model('Home/publications_model');
        $this->category_title = $this->categories_model->get_category($id)[0]->titulo;

        $data = [
            'title'=> 'Categorias',
            'caption'=> $this->category_title,
            'categories'=> $this->categories,
            'posts'=>  $this->publications_model->category_pub($id),
        ];

        $this->load->view('Home/templates/head', $data);
        $this->load->view('Home/templates/header');
        $this->load->view('Home/category');
        $this->load->view('Home/templates/aside');
        $this->load->view('Home/templates/footer');
        $this->load->view('Home/templates/html-footer');
    }
}