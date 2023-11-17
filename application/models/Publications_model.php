<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publications_model extends CI_Model {
    public $id;
    public $categoria;
    public $titulo;
    public $subtitulo;
    public $conteudo;
    public $data;
    public $img;
    public $user;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Function featured_post
     *
     * This function returns information about the latest 4 featured posts,
     * including author details, title, subtitle, user, date, and image.
     *
     * @return array Returns an array of objects containing information about the featured posts.
     */
    public function featured_post() {
        $this->db->select(
            'usuario.id as idautor, '.
            'usuario.nome, '.
            'postagens.id, '.
            'postagens.titulo ,'.
            'postagens.subtitulo, '.
            'postagens.user, '.
            'postagens.data, '.
            'postagens.img, '
        );
        $this->db->from('postagens');
        $this->db->join('usuario', 'usuario.id = postagens.user');
        $this->db->order_by('postagens.data', 'DESC');
        $this->db->limit(4);
        
        return $this->db->get()->result();
    }

    /**
     * Function category_pub
     *
     * This function returns information about posts from a specific category,
     * including author details, title, subtitle, user, date, image, and category.
     *
     * @param int $id The identifier of the category for which posts are to be retrieved.
     * @return array Returns an array of objects containing information about posts in the category.
     */
    public function category_pub($id) {
        $this->db->select(
            'usuario.id as idautor, '.
            'usuario.nome, '.
            'postagens.id, '.
            'postagens.titulo ,'.
            'postagens.subtitulo, '.
            'postagens.user, '.
            'postagens.data, '.
            'postagens.img, '.
            'postagens.categoria, '
        );
        $this->db->from('postagens');
        $this->db->join('usuario', 'usuario.id = postagens.user');
        $this->db->where("postagens.categoria = $id");
        $this->db->order_by('postagens.data', 'DESC');

        return $this->db->get()->result();
    }

    /**
     * Get details of a publication by ID.
     *
     * This method queries the database to retrieve details of a publication
     * based on the provided ID.
     *
     * @param int $id The ID of the desired publication.
     * @return array The detailed information of the publication as an array of objects.
    */
    public function get_publication($id) {
        $this->db->select(
            'usuario.id as idautor, '.
            'usuario.nome, '.
            'postagens.id, '.
            'postagens.titulo ,'.
            'postagens.subtitulo, '.
            'postagens.user, '.
            'postagens.data, '.
            'postagens.img, '.
            'postagens.categoria, '.
            'postagens.conteudo, '
        );
        $this->db->join('usuario', 'usuario.id = postagens.user');
        $this->db->where("postagens.id = $id");

        return $this->db->get('postagens')->result();
    }

    /**
     * Retrieves all publications ordered by date in descending order.
     *
     * This method queries the database to retrieve all publications from the
     * 'postagens' table, ordering them by date in descending order (from the
     * most recent to the oldest).
     *
     * @return array An array containing objects representing the publications.
    */
    public function get_publications() {
        $this->db->order_by('data', 'DESC');

        return $this->db->get('postagens')->result();
    }

    /**
     * Retrieves data of a publication for editing.
     *
     * This method fetches data from the database for a specific publication,
     * identified by its encrypted ID (md5). Returns an object containing the
     * publication data for editing.
     *
     * @param string $id The encrypted ID (md5) of the publication.
     * @return object|null An object containing the publication data for editing or null if not found.
    */
    public function get_publication_edit($id) {
        $this->db->where("md5(id)", $id);

        return $this->db->get("postagens")->result()[0];
    }

    /**
     * Edits an existing publication in the database.
     *
     * This method updates the information of a publication based on the provided parameters.
     *
     * @param string $title Title of the publication.
     * @param string $caption Subtitle of the publication.
     * @param string $content Content of the publication.
     * @param string $date Date of the publication.
     * @param string $category Category of the publication.
     * @param string $id The encrypted ID (md5) of the publication.
     * @return bool Returns true if the edit is successful; otherwise, returns false.
    */
    public function edit_publication(
        $title,
        $caption,
        $content,
        $date,
        $category,
        $id
    ) {
        $data = [
            'titulo'=> $title,
            'subtitulo'=> $caption,
            'conteudo'=> $content,
            'data'=> $date,
            'categoria'=> $category,
        ];

        $this->db->where("md5(id)", $id);

        return $this->db->update("postagens", $data);
    }


    /**
     * Adds a new publication to the database.
     *
     * This method receives the data of a new publication and inserts it into the database.
     * Returns true if the insertion is successful, and false otherwise.
     *
     * @param string $title The title of the publication.
     * @param string $caption The subtitle of the publication.
     * @param string $content The content of the publication.
     * @param string $date The date of the publication.
     * @param string $category The category of the publication.
     * @param string $user The user associated with the publication.
     * @return bool True if the insertion is successful, False otherwise.
    */
    public function add_publication(
        $title,
        $caption,
        $content,
        $date,
        $category,
        $user
    ) {
        $data = [
            'titulo'=> $title,
            'subtitulo'=> $caption,
            'conteudo'=> $content,
            'user'=> $user,
            'data'=> $date,
            'categoria'=> $category,
        ];
        
        return $this->db->insert('postagens', $data);
    }

    /**
     * Removes a publication from the database.
     *
     * This method uses the provided publication ID to locate and delete
     * the corresponding publication in the database. Returns true if the deletion is successful,
     * and false otherwise.
     *
     * @param string $id The ID of the publication to be removed.
     * @return bool True if the removal is successful, False otherwise.
    */
    public function remove_publication($id) {
        $this->db->where('md5(id)', $id);

        return $this->db->delete('postagens');
    }
}