<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = [
            'title'=> 'Painel Administrativo',
            'caption'=> 'Home',
        ];

        $this->load->view('Admin/templates/head', $data);
        $this->load->view('Admin/templates/template', $data);
        $this->load->view('Admin/home', $data);
        $this->load->view('Admin/templates/footer', $data);
    }

    /**
     * Displays the login page of the admin panel.
     *
     * This method loads the login page of the admin panel with information
     * such as title and caption. The information is passed to the corresponding views.
     *
     * @return void
    */
    public function pag_login() {
        $data = [
            'title'=> 'Painel Controle',
            'caption'=> 'Entrar no sistema',
        ];

        $this->load->view('Admin/templates/head', $data);
        $this->load->view('Admin/login', $data);
        $this->load->view('Admin/templates/footer', $data);
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
        $this->load->model('authors_model');

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
}