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
}