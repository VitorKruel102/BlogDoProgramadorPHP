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

    /**
     * Get category information by ID.
     *
     * This method queries the database to retrieve information about a category
     * based on the provided ID.
     *
     * @param int $id The ID of the desired category.
     * @return array The information about the category as an array of objects.
    */
    public function get_category($id) {
        $this->db->where("id = $id");

        return $this->db->get("categoria")->result();
    }

    /**
     * Add a new category to the database.
     *
     * This method receives the title of the new category as a parameter and inserts
     * the data into the database in the 'categoria' table.
     *
     * @param string $titulo The title of the new category to be added.
     * @return bool Returns true if the insertion is successful, otherwise, false.
    */
    public function add_category($titulo) {
        $data['titulo'] = $titulo;

        return $this->db->insert('categoria', $data);
    }
}