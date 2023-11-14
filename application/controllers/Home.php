<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->helper('funcoes');
		$this->load->model('Home/categorias_model');
		$this->categories = $this->categorias_model->list_categories();
	}

	/**
	 * Function index
	 *
	 * This method is responsible for loading the necessary views for the home page.
	 *
	 * @return void
	 */
	public function index() {
		$this->load->model('Home/publicacoes_model');

		$data = [
			'categories'=> $this->categories,
			'posts'=> $this->publicacoes_model->featured_post(),
		];

		$this->load->view('Home/templates/head', $data);
		$this->load->view('Home/templates/header');
		$this->load->view('Home/home');
		$this->load->view('Home/templates/aside');
		$this->load->view('Home/templates/footer');
		$this->load->view('Home/templates/html-footer');
	}
}
