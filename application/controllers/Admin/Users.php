<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('authors_model');
    }

    /**
     * Displays the main page of the admin panel for users.
     *
     * This method checks if the user is authenticated (logged in). If not,
     * it redirects to the login page. Otherwise, it loads the necessary
     * information to display the main page of the admin panel, including
     * the list of users, and displays the corresponding views.
     *
     * @return void
    */
    public function index() {
        $this->login_manager();
        $this->load->library('table');
        
        $data = [
            'title'=> 'Painel Administrativo',
            'caption'=> 'Usuários',
            'users'=> $this->authors_model->get_authors(),
        ];

        $this->load->view('Admin/templates/head', $data);
        $this->load->view('Admin/templates/template');
        $this->load->view('Admin/users');
        $this->load->view('Admin/templates/footer');
    }

    /**
     * Inserts a new user into the system, validating and processing form data.
     *
     * This method uses the `login_manager()` method to check if the user is 
     * authenticated. It then loads the form validation library and sets 
     * validation rules for the form fields. If the validation is successful, 
     * it redirects to the main user page. Otherwise, it displays error messages 
     * or inserts the new user into the system, depending on the validation result.
     *
     * @return void
    */
    public function insert() {
        $this->login_manager();

        if (!$this->validation_user()) {
            $this->index();
        } else {
            $nome = $this->input->post('text-nome');
            $email = $this->input->post('text-email');
            $historico = $this->input->post('text-historico');
            $user = $this->input->post('text-user');
            $senha = $this->input->post('text-senha');
            
            if ($this->authors_model->add_authors(
                $nome,
                $email,
                $historico,
                $user,
                $senha
            )) {
                redirect(base_url('admin/usuarios'));
            } else {
                echo 'Houve um erro no sistema!';
            }
        }
    }

    /**
     * Removes an author from the system, checking if the user is 
     * authenticated before the operation.
     *
     * This method uses the `login_manager()` method to check if the user 
     * is authenticated. It then attempts to remove the author with the 
     * provided ID. If the removal is successful, it redirects to the admin 
     * panel's users page. Otherwise, it displays an error message.
     *
     * @param int $id The ID of the author to be removed.
     * @return void
    */
    public function exclude($id) {
        $this->login_manager();

        if ($this->authors_model->remove_author($id)) {
            redirect(base_url('admin/usuarios'));
        } else {
            echo 'Houve um erro no sistema!';
        }
    }

    /**
     * Displays the user edit page in the control panel.
     *
     * This method checks if the user is authenticated before displaying the
     * user edit page. It retrieves user details based on the provided ID,
     * prepares the necessary data, and loads the corresponding views.
     *
     * @param int $id The ID of the user to be edited.
    */
    public function change($id) {
        $this->login_manager();

        $data = [
            'title'=> 'Painel de Controle',
            'caption'=> 'Usuários',
            'user'=> $this->authors_model->get_user($id),
        ];

        $this->load->view('Admin/templates/head', $data);
        $this->load->view('Admin/templates/template');
        $this->load->view('Admin/users-edit');
        $this->load->view('Admin/templates/footer');
    }
    
    /**
     * Saves the edits of a user after the edit form is submitted.
     *
     * This method checks if the information provided in the edit form is valid
     * using the `validation_user()` method. If the information is valid, the 
     * edits are saved in the database for the user corresponding to the 
     * provided ID. If the edit is successful, it redirects to the users' page 
     * in the admin panel. Otherwise, it displays an error message.
     *
     * @param string $id The ID of the user to be edited.
     *
     * @return void
    */
    public function save_edit($id) {
        $this->login_manager();

        if (!$this->validation_user()) {
            $this->index();
        } else {
            $nome = $this->input->post('text-nome');
            $email = $this->input->post('text-email');
            $historico = $this->input->post('text-historico');
            $user = $this->input->post('text-user');
            $senha = $this->input->post('text-senha');
            
            if ($this->authors_model->edit_user(
                $nome,
                $email,
                $historico,
                $user,
                $senha,
                $id
            )) {
                redirect(base_url('admin/usuarios'));
            } else {
                echo 'Houve um erro no sistema!';
            }
        }
    }

    public function new_photo($id) {
        $this->login_manager();
        
        $config_upload = [
            'upload_path'=> './assets/Home/img/users',
            'allowed_types'=> 'jpg',
            'file_name'=> "$id.jpg",
            'overwrite'=> TRUE,
        ];
        $this->load->library('upload', $config_upload);

        if (!$this->upload->do_upload()) {
            echo $this->upload->display_errors();
        } else {
            $config_img = [
                'source_image'=> "./assets/Home/img/users/$id.jpg",
                'create_thumb'=> FALSE,
                'width'=> 200,
                'height'=> 200,
            ];
            $this->load->library('image_lib', $config_img);

            if ($this->image_lib->resize()) {
                redirect(base_url("admin/usuarios/alterar/$id"));
            } else {
                echo $this->image_lib->display_errors();
            }
        }
    }

    /**
     * Displays the login page of the admin panel.
     *
     * This method loads the login page of the admin panel with information
     * such as title and caption. The information is passed to the 
     * corresponding views.
     *
     * @return void
    */
    public function pag_login() {
        $data = [
            'title'=> 'Painel Controle',
            'caption'=> 'Entrar no sistema',
        ];

        $this->load->view('Admin/templates/head', $data);
        $this->load->view('Admin/login');
        $this->load->view('Admin/templates/footer');
    }

    /**
     * Processes the login form and authenticates the user.
     *
     * This method validates the username and password fields of the login form.
     * If the validation is successful, it attempts to authenticate the user
     * with the provided information. If authentication is successful, it starts
     * a user session and redirects to the admin panel. If authentication fails,
     * it redirects back to the login page.
     *
     * @return void
    */
    public function login()  {
        $this->load->library('form_validation');

        $id_input_user = 'txt-user';
        $id_input_password = 'txt-senha';

        $this->form_validation->set_rules($id_input_user, 'Usuário', 'required|min_length[3]');
        $this->form_validation->set_rules($id_input_password, 'Senha', 'required|min_length[3]');

        if (!$this->form_validation->run()) {
            $this->pag_login();
        } else {
            $user = $this->input->post($id_input_user);
            $password = $this->input->post($id_input_password);
            $user_exists = $this->authors_model->is_user($user, $password);

            if ($user_exists) {
                $data = [
                    'user_logged'=> $user_exists[0],
                    'logged'=> TRUE,
                ];
                $this->session->set_userdata($data);

                redirect(base_url('admin'));
            } else {
                $data = [
                    'user_logged'=> NULL,
                    'logged'=> FALSE,
                ];
                $this->session->set_userdata($data);

                redirect(base_url('admin/login'));
            }
        }
    }

    /**
     * Logs out the user, ending the session.
     *
     * This method ends the user session by setting session data to null
     * and the login status to false. It then redirects to the admin panel login page.
     *
     * @return void
    */
    public function logout() {
        $data = [
            'user_logged'=> NULL,
            'logged'=> FALSE,
        ];
        $this->session->set_userdata($data);

        redirect(base_url('admin/login'));
    }

    /**
     * Protects routes that require authentication by redirecting unauthenticated 
     * users to the login page.
     *
     * This method checks if the user is authenticated (logged in). If not,
     * it redirects to the admin panel login page.
     *
     * @return void
    */
    protected function login_manager() {
        $is_logged = $this->session->userdata('logged');
        if (!$is_logged) {
            redirect(base_url('admin/login'));
        }
    }

    /**
     * Performs validation of user data.
     *
     * This method uses the form validation library to set validation rules 
     * for different fields in the user registration form. The rules include 
     * requiring mandatory fields, checking the email format, setting a 
     * minimum length for the history and username, ensuring that the username 
     * is unique, and validating the match between the password and its 
     * confirmation.
     *
     * @return bool Returns true if validation is successful; 
     * otherwise, returns false.
    */
    protected function validation_user() {
        $this->load->library('form_validation');

        $id_input_nome = 'text-nome';
        $id_input_email = 'text-email';
        $id_input_historico = 'text-historico';
        $id_input_user = 'text-user';
        $id_input_senha = 'text-senha';
        $id_input_confirmar_senha = 'text-confirmar-senha';
       
        $this->form_validation->set_rules(
            $id_input_nome,
            'Nome do Usuário',
            'required|min_length[3]'
        );
        $this->form_validation->set_rules(
            $id_input_email,
            'E-mail',
            'required|valid_email'
        );
        $this->form_validation->set_rules(
            $id_input_historico,
            'Histórico',
            'required|min_length[20]'
        );
        $this->form_validation->set_rules(
            $id_input_user,
            'Histórico',
            'required|min_length[3]|is_unique[usuario.user]'
        );
        $this->form_validation->set_rules(
            $id_input_senha,
            'Senha',
            'required|min_length[3]'
        );
        $this->form_validation->set_rules(
            $id_input_confirmar_senha,
            'Confirmar senha',
            "required|matches[text-senha]"
        );

        return $this->form_validation->run();
    }
}