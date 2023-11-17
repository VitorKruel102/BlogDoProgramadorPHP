<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $is_logged = $this->session->userdata('logged');
        if (!$is_logged) {
            redirect(base_url('admin/login'));
        }

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
            'title'=> 'Painel de Controle',
            'caption'=> 'Categoria',
            'categories'=> $this->categories,
        ];

        $this->load->view('Admin/templates/head', $data);
        $this->load->view('Admin/templates/template');
        $this->load->view('Admin/category');
        $this->load->view('Admin/templates/footer');
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
        if (!$this->validation_category()) {
            $this->index();
        } else {
            $titulo = $this->input->post('text-categoria');

            if ($this->categories_model->add_category($titulo)){
                redirect(base_url('admin/categoria'));
            } else {
                echo 'Houve um erro no sistema!';
            }
        }
    }

    /**
     * Removes a specific category from the database.
     *
     * This method receives the ID of the category to be removed as a parameter
     * and attempts to remove it from the database. If the removal is successful,
     * it redirects to the categories page in the admin panel. If the removal fails,
     * it displays an error message.
     *
     * @param int $id The ID of the category to be removed.
     * @return void
    */
    public function exclude($id) {
        if ($this->categories_model->remove_category($id)){
            redirect(base_url('admin/categoria'));
        } else {
            echo 'Houve um erro no sistema!';
        }
    }

    /**
     * Displays the category editing page in the admin panel.
     *
     * This method loads the 'table' library from CodeIgniter and displays the
     * category editing page in the admin panel. The loaded data includes title,
     * caption, and information about the category to be edited.
     *
     * @param string $id The ID of the category to be edited (MD5 hash).
     * @return void
    */
    public function change($id) {
        $this->load->library('table');

        $data = [
            'title'=> 'Painel de Controle',
            'caption'=> 'Categoria',
            'category'=> $this->categories_model->get_category_edit($id),
        ];

        $this->load->view('Admin/templates/head', $data);
        $this->load->view('Admin/templates/template');
        $this->load->view('Admin/category-edit');
        $this->load->view('Admin/templates/footer');
    }

    /**
     * Saves the changes made to a category after editing.
     *
     * This method performs validation of the form data, specifically for the
     * 'Nome da Categoria' field. If the validation is successful, it saves the
     * changes to the database and redirects to the categories page in the admin
     * panel. If the validation fails, it redirects back to the main admin panel page.
     *
     * @param string $id The ID of the category to be edited (MD5 hash).
     * @return void
    */
    public function save_edit($id) {
        if (!$this->validation_category()) {
            $this->index();
        } else {
            $titulo = $this->input->post('text-categoria');

            if ($this->categories_model->edit_category($id, $titulo)){
                redirect(base_url('admin/categoria'));
            } else {
                echo 'Houve um erro no sistema!';
            }
        }
    }

    /**
     * Performs validation of category data.
     *
     * This method uses the 'form_validation' library from CodeIgniter to set
     * validation rules for the name of a category. The rules include being required,
     * having a minimum length of 3 characters, and being unique in the 'categoria' table.
     *
     * @return bool True if the validation is successful, False otherwise.
    */
    protected function validation_category() {
        $id_category = 'text-categoria';
        $field_name = 'Nome da Categoria';
        $validator = 'required|min_length[3]|is_unique[categoria.titulo]';
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules($id_category, $field_name, $validator);

        return $this->form_validation->run();
    }

}