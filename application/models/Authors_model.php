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

        return $this->db->get('usuario')->result()[0];
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

    /**
     * Gets details of a user based on the provided ID.
     *
     * This method queries the database to retrieve specific data about a user,
     * including ID, name, history, email, and username. The ID is provided as 
     * a parameter and is converted to its MD5 equivalent for the query.
     *
     * @param string $id The user's ID (MD5 format).
     * @return object Returns an object containing user details, 
     * including ID, name, history, email, and username.
    */
    public function get_user($id) {
        $this->db->select(
            'id, '.
            'nome, '.
            'historico, '.
            'email, '.
            'user'
        );
        $this->db->where("md5(id)", $id);

        return $this->db->get('usuario')->result()[0];
    }

    /**
     * Edits the information of a user in the database.
     *
     * This method receives updated information about a user, including 
     * name, email, history, username, password, and the ID of the user 
     * to be updated. The data is then updated in the database for the 
     * user corresponding to the provided ID, after converting the ID to the MD5 format for the query.
     *
     * @param string $name      The new name of the user.
     * @param string $email     The new email address of the user.
     * @param string $history   The new history of the user.
     * @param string $username  The new username of the user.
     * @param string $password  The new password of the user (in MD5 format).
     * @param string $id        The ID of the user to be edited (in MD5 format).
     *
     * @return bool Returns true if the editing is successful, false otherwise.
    */
    public function edit_user(
        $nome,
        $email,
        $historico,
        $user,
        $senha,
        $id
    ) {
        $data = [
            'nome'=> $nome,
            'email'=> $email,
            'historico'=> $historico,
            'user'=> $user,
            'senha'=> md5($senha),
        ];
        $this->db->where("md5(id)", $id);

        return $this->db->update('usuario', $data);
    }
}