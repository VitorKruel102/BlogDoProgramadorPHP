<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Publications extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $is_logged = $this->session->userdata('logged');
        if (!$is_logged) {
            redirect(base_url('admin/login'));
        }

        $this->load->helper('funcoes');
        $this->load->model('publications_model');
        $this->load->model('categories_model');
        $this-> categories = $this->categories_model->list_categories();
    }

    /**
     * Displays the main page of the control panel for managing publications.
     *
     * This method loads the 'table' library and sets the necessary data to display
     * the main page of the control panel. It includes titles, available categories,
     * and the list of publications obtained by the `get_publications()` method from
     * the publication model. The data is then passed to the corresponding views to
     * render the page.
     *
     * @return void
    */
    public function index() {
        $this->load->library('table');

        $data = [
            'title'=> 'Painel de Controle',
            'caption'=> 'Publicação',
            'categories'=> $this->categories,
            'publications'=> $this->publications_model->get_publications(),
        ];

        $this->load->view('Admin/templates/head', $data);
        $this->load->view('Admin/templates/template');
        $this->load->view('Admin/publications');
        $this->load->view('Admin/templates/footer');
    }

    /**
     * Inserts a new publication into the database.
     *
     * This method checks the validation of the publication, and if validation
     * passes, it inserts a new publication into the database. Otherwise, it
     * redirects to the main page of the control panel.
     *
     * @param int $id The ID of the publication (not used in this context).
     * @return void
    */
    public function insert($id) {
        if (!$this->validation_publication()) {
            $this->index();
        } else {
            $title = $this->input->post('text-titulo');
            $caption = $this->input->post('text-subtitulo');
            $content = $this->input->post('text-conteudo');
            $date = $this->input->post('text-data');
            $category = $this->input->post('select-categoria');

            if ($this->publications_model->add_publication(
                $title,
                $caption,
                $content,
                $date,
                $category,
                $id
            )){
                redirect(base_url('admin/publicacao'));
            } else {
                echo 'Houve um erro no sistema!';
            }
        }
    }

    /**
     * Deletes a publication from the database.
     *
     * This method checks if the deletion of the publication was successful.
     * If it was, it redirects to the main publications page in the control panel.
     * Otherwise, it displays an error message.
     *
     * @param int $id The ID of the publication to be deleted.
     * @return void
    */
    public function exclude($id) {
        if ($this->publications_model->remove_publication($id)){
            redirect(base_url('admin/publicacao'));
        } else {
            echo 'Houve um erro no sistema!';
        }
    }

    /**
     * Displays the edit form for a publication.
     *
     * This method loads the 'table' library and the necessary data to display
     * the edit form for a publication. The data includes information about
     * the category of the publication and the details of the publication itself.
     *
     * @param string $id The encrypted ID (md5) of the publication.
     * @return void
    */
    public function change($id) {
        $this->load->library('table');

        $data = [
            'title'=> 'Painel de Controle',
            'caption'=> 'Publicação',
            'categories'=> $this->categories_model->list_categories(),
            'publication'=> $this->publications_model->get_publication_edit($id),
        ];

        $this->load->view('Admin/templates/head', $data);
        $this->load->view('Admin/templates/template');
        $this->load->view('Admin/publications-edit');
        $this->load->view('Admin/templates/footer');
    }

    /**
     * Saves the changes made to a publication.
     *
     * This method checks the validation of the publication before saving the changes.
     * If the validation is successful, the edited information of the publication is
     * saved in the database.
     *
     * @param string $id The encrypted ID (md5) of the publication.
     * @return void
    */
    public function save_edit($id) {
        if (!$this->validation_publication()) {
            $this->index();
        } else {
            $title = $this->input->post('text-titulo');
            $caption = $this->input->post('text-subtitulo');
            $content = $this->input->post('text-conteudo');
            $date = $this->input->post('text-data');
            $category = $this->input->post('select-categoria');

            if ($this->publications_model->edit_publication(
                $title,
                $caption,
                $content,
                $date,
                $category,
                $id
            )){
                redirect(base_url('admin/publicacao'));
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
    protected function validation_publication() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules(
            'text-titulo', 
            'Titulo', 
            'required|min_length[3]'
        );
        $this->form_validation->set_rules(
            'text-subtitulo', 
            'Subtitulo', 
            'required|min_length[3]'
        );
        $this->form_validation->set_rules(
            'text-conteudo', 
            'Conteudo', 
            'required|min_length[20]'
        );

        return $this->form_validation->run();
    }

}