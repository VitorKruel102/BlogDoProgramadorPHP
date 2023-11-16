<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->helper('funcoes');
        $this->load->model('authors_model');
        $this->load->model('categories_model');
        $this->categories = $this->categories_model->list_categories();
    }

    
    /**
	 * Function index
	 *
	 * This method is responsible for loading the necessary views for the About Us page.
	 *
	 * @return void
	*/
    public function index() {
        $data = [
            'title'=> 'Sobre nós',
            'caption'=> 'Conheça nossa equipe',
            'categories'=> $this->categories,
            'authors'=>  $this->authors_model->get_authors(),
        ];

        $this->load->view('Home/templates/head', $data);
        $this->load->view('Home/templates/header');
        $this->load->view('Home/about-us');
        $this->load->view('Home/templates/aside');
        $this->load->view('Home/templates/footer');
        $this->load->view('Home/templates/html-footer');
    }

    /**
     * Author page.
     *
     * This method loads author data based on the provided ID and displays
     * the dedicated authors' page. The loaded data includes title, caption,
     * available categories, and details of specific authors.
     *
     * @param int $id The ID of the authors to be displayed.
     * @param string|null $slug The optional slug of the author' page.
     * @return void
    */
    public function author($id, $slug = null) { 
        $data = [
            'title'=> 'Sobre nós',
            'caption'=> 'Autor',
            'categories'=> $this->categories,
            'authors'=> $this->authors_model->get_author($id),
        ];

        $this->load->view('Home/templates/head', $data);
        $this->load->view('Home/templates/header');
        $this->load->view('Home/author');
        $this->load->view('Home/templates/aside');
        $this->load->view('Home/templates/footer');
        $this->load->view('Home/templates/html-footer');
    }
}