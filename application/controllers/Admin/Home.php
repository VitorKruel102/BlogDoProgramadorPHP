<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
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
}