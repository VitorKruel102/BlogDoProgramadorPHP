<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authors_model extends CI_Model {
    public $id;
    public $nome;
    public $email;
    public $img;
    public $historico;
    public $user;
    public $senha;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get author information by ID.
     *
     * This method queries the database to retrieve information about 
     * an author based on the provided ID.
     *
     * @param int $id The ID of the desired author.
     * @return array The information about the author as an array of
     * objects.
    */
    public function get_author($id) {
        $this->db->select(
            'id, '.
            'nome, '.
            'historico, '.
            'img'
        );
        $this->db->where("id = $id");

        return $this->db->get('usuario')->result();
    }
}