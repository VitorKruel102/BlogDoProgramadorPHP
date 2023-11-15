<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {
    // DB fields
    public $id;
    public $titulo;

    public function __construct() {
        parent::__construct();
    }

    // Methods
    /**
     * Function list_categories
     *
     * This function returns a list of categories ordered by title in ascending order.
     *
     * @return array Returns an array containing the categories from the 'categoria' table.
     */
    public function list_categories() {
        $this->db->order_by('titulo', 'ASC');

        return $this->db->get('categoria')->result();
    }

    public function get_category($id) {
        $this->db->where("id = $id");

        return $this->db->get("categoria")->result();
    }
}