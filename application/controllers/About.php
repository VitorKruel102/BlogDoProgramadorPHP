<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->helper('funcoes');
        $this->load->model('Home/categories_model');
        $this->categories = $this->categories_model->list_categories();
    }

    public function index($id, $slug = null) {
        $this->load->model('Home/publications_model');
        $this->category_title = $this->categories_model->get_category($id);

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

    public function authors($id, $slug = null) { 
        $this->load->model('authors_model');

        $data = [ 
            'title'=> 'Sobre nós',
            'caption'=> 'Autores',
            'authors'=> $this->authors_model->get_authors($id),
        ];

        $this->load->view('Home/templates/head', $data);
        $this->load->view('Home/templates/header');
        $this->load->view('Home/authors');
        $this->load->view('Home/templates/aside');
        $this->load->view('Home/templates/footer');
        $this->load->view('Home/templates/html-footer');
    }
}