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

        return $this->db->get("categoria")->result()[0];
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
    public function add_category($title) {
        $data['titulo'] = $title;

        return $this->db->insert('categoria', $data);
    }

    /**
     * Remove a specific category from the database.
     *
     * This method receives the ID of the category to be removed as a parameter,
     * converts it to MD5 for security purposes, and uses it as a condition
     * for removing the category from the 'categoria' table.
     *
     * @param string $id The ID of the category to be removed (MD5 hash).
     * @return bool Returns true if the removal is successful, otherwise, false.
    */
    public function remove_category($id) {
        $this->db->where('md5(id)', $id);
        
        return $this->db->delete("categoria");
    }

    /**
     * Get information about a specific category for editing.
     *
     * This method receives the ID of the category to be edited as a parameter,
     * converts it to MD5 for security purposes, and uses it as a condition
     * to obtain information about the category from the 'categoria' table.
     *
     * @param string $id The ID of the category to be edited (MD5 hash).
     * @return array The information about the category as an array of objects.
    */
    public function get_category_edit($id) {
        $this->db->where("md5(id)", $id);

        return $this->db->get("categoria")->result();
    }

    /**
     * Edits the title of a category in the database.
     *
     * This method receives the ID of the category to be edited and the new title
     * as parameters, converts the ID to MD5 for security purposes, uses both as
     * conditions to find the category in the 'categoria' table, and updates the
     * title of the category with the new value.
     *
     * @param string $id The ID of the category to be edited (MD5 hash).
     * @param string $titulo The new title of the category.
     * @return bool Returns true if the edit is successful, otherwise, false.
    */
    public function edit_category($id, $title) {
        $data['titulo'] = $title;
        $this->db->where("md5(id)", $id);

        return $this->db->update('categoria', $data);
    }
}