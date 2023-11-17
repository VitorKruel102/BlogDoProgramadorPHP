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
     * This method queries the database to retrieve information about all 
     * authors, including their IDs, names, and images.
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

    /**
     * Checks if a user with the provided username and password exists in 
     * the database.
     *
     * This method queries the database to check if there is a user with 
     * the provided username and password. It returns the results of the 
     * query.
     *
     * @param string $user The username to be checked.
     * @param string $password The password to be checked.
     * @return array|null Returns an array with user data if it exists, 
     * or null if it doesn't.
    */
    public function is_user($user, $password) {
        $this->db->where("user", $user);
        $this->db->where("senha", md5($password));

        return $this->db->get("usuario")->result(); 
    }

    /**
     * Adds a new author to the system.
     *
     * This method receives information about the author, such as 
     * name, email, history, username, and password. It then creates 
     * an associative array with this data, including the password 
     * encrypted with MD5. Finally, it inserts this data into the 
     * 'usuario' table of the database.
     *
     * @param string $name The author's name.
     * @param string $email The author's email.
     * @param string $history The author's history.
     * @param string $username The author's username.
     * @param string $password The author's password.
     * @return bool True if the insertion is successful, False otherwise.
    */
    public function add_authors(
        $nome,
        $email,
        $historico,
        $user,
        $senha
    ) {
        $data = [
            'nome'=> $nome,
            'email'=> $email,
            'historico'=> $historico,
            'user'=> $user,
            'senha'=> md5($senha)
        ];
        
        return $this->db->insert('usuario', $data);
    }

    /**
     * Removes an author from the system based on the provided ID.
     *
     * This method uses the author's ID, converts it to MD5, and uses 
     * it as a condition to locate the author in the 'usuario' table. 
     * It then performs the deletion of the author from the database.
     *
     * @param string $id The ID of the author to be removed.
     * @return bool True if the removal is successful, False otherwise.
    */
    public function remove_author($id) {
        $this->db->where('md5(id)', $id);

        return $this->db->delete('usuario');
    }
}