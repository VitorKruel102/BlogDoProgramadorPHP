<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacoes_model extends CI_Model {
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
     * This function returns the latest 4 posts, ordered by date in descending order.
     *
     * @return array Returns an array containing the featured posts from the 'postagens' table.
     */
    public function featured_post() {
        $this->db->order_by('data', 'DESC');
        $this->db->limit(4);
        
        return $this->db->get('postagens')->result();
    }
}