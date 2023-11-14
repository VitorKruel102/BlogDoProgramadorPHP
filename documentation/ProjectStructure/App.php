<?php

class App {
    public $introducao;
    public $pastaConfig;
    

    public function __construct() {
        $this->introducao = "
            Diretorio responsável por conter pastas da
            nossa aplicação Web.
        ";
    }

    public function getPastaConfig() {
        $this->pastaConfig = "
            Pasta responsável por conter as configurações
            do site, é nela que iremos adiconar os funções
            e classe no autoload, caminhos de urls, definir
            baseURL e informações do Banco de Dados(DB).
        ";
        $base_url = "
            Como o próprio nome sugere, é a url base que será 
            apresentado o site. Quando for em produção, devemos
            alterar para o caminho do nosso dominio.
        ";
    }
}
