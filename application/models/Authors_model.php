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

    /**
     * Get information about all authors.
     *
     * This method queries the database to retrieve information about all authors,
     * including their IDs, names, and images.
     *
     * @return array The information about authors as an array of objects.
    */
    public function get_authors() {
        $this->db->select(
            'id, '.
            'nome, '.
            'img, '
        );
        $this->db->order_by('nome', 'ASC');

        return $this->db->get('usuario')->result();
    }

    public function is_user($user, $password) {
        $this->db->where("user", $user);
        $this->db->where("senha", $password);

        return $this->db->get("usuario")->result(); 
    }
}