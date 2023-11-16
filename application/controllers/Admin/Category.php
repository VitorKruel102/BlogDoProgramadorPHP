<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('categories_model');
        $this-> categories = $this->categories_model->list_categories();
    }

    /**
     * Main page of the administrative panel for categories.
     *
     * This method loads the 'table' library from CodeIgniter and displays the main
     * page of the administrative panel for category management. The loaded data
     * includes title, caption, and available categories for display.
     *
     * @return void
    */
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

    /**
     * Inserts a new category after form validation.
     *
     * This method performs validation of the form data, specifically for the
     * 'Nome da Categoria' field. If the validation is successful, it inserts the
     * new category into the database and redirects to the categories page in the
     * admin panel. If the validation fails, it redirects back to the main admin
     * panel page.
     *
     * @return void
    */
    public function insert() {
        $id_category = 'text-categoria';
        $field_name = 'Nome da Categoria';
        $validator = 'required|min_length[3]|is_unique[categoria.titulo]';
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules($id_category, $field_name, $validator);

        if (!$this->form_validation->run()) {
            $this->index();
        } else {
            $titulo = $this->input->post($id_category);

            if ($this->categories_model->add_category($titulo)){
                redirect(base_url('admin/categoria'));
            } else {
                echo 'Houve um erro no sistema!';
            }
        }
    }
}