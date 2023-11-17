<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publications extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->helper('funcoes');
        $this->load->model('publications_model');
        $this->load->model('categories_model');
        $this->categories = $this->categories_model->list_categories();
    }

    /**
     * Main page of the publication.
     *
     * This method loads the publication data based on the provided ID
     * and displays the main page of the publication. The loaded data
     * includes title, caption, available categories, and details of the
     * specific publication.
     *
     * @param int $id The ID of the publication to be displayed.
     * @param string|null $slug The optional slug of the publication.
     * @return void
    */
    public function index($id, $slug = null) {
        $this->publication = $this->publications_model->get_publication($id);

        $data = [
            'title'=> '',
            'caption'=> '',
            'categories'=> $this->categories,
            'posts'=>  $this->publication,
        ];

        $this->load->view('Home/templates/head', $data);
        $this->load->view('Home/templates/header');
        $this->load->view('Home/publication');
        $this->load->view('Home/templates/aside');
        $this->load->view('Home/templates/footer');
        $this->load->view('Home/templates/html-footer');
    }
}