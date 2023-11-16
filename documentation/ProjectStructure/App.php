<?php

class App {
    public $introducao;
    public $pastaConfig;
    public $pastaController;
    public $pastaModels;
    

    public function __construct() {
        $this->introducao = "
            Diretório responsável por conter pastas da
            nossa aplicação Web.
        ";
    }

    public function getPastaConfig() {
        $this->pastaConfig = "
            Pasta responsável por conter as configurações
            do site, é nela que iremos adicionar os funções
            e classe no autoload, caminhos de urls, definir
            baseURL e informações do Banco de Dados(DB).
        ";
        function autoload() {
            $introducao = "
                Normalmente em uma aplicação Web utilizando o
                CodeIgniter, iremos utilizar funções ou classes
                padrões do Framework, para não precisar adicionar
                o load dessas funcionalidades, podemos adiciona-los
                nessa pasta para sempre estar carregado em todas as
                pastas do projeto. 
                RECOMENDAÇÃO:
                 -> Utiliza apenas quando essas funcionalidade sejam
                    utilizadas em mais de duas páginas da sua aplicação.
            ";
            $helper = "
                Podemos deixar como padrão três helpers que normalmente 
                são utilizados em uma aplicação(url, form, html);
            ";
            $libraries = "
                Podemos deixar como padrão: ('database')
            ";
        }
        function config() { 
            $config_base_url = "
            Como o próprio nome sugere, é a url base que será 
            apresentado o site. Quando for em produção, devemos
            alterar para o caminho do nosso domínio.
        ";
        }
        function database() {
            $db_default = "
                Esse Array é responsável por definir as configurações
                do nosso Banco de Dados, é nele que iremos adicionar:
                    -> hostname;
                    -> username;
                    -> password;
                    -> database;
                    -> etc...
            ";
        }
        function routes() {
            $introducao = "
                Pasta responsável por adicionar as rotas do nosso site
            ";
            $default_controller = "
                Definimos o controller padrão que será acessado
                quando o usuário entrar na página.
            ";
        }
    }
    public function getPastaController() {
        $this->pastaController = "
            Pasta responsável por conter o celebro 
        ";
        $metodo_load = '
            Utilizado para carregar outras classes ou funções da 
            nossa aplicação;
            Sintaxa:
                $this->load->model("nome_da_classe");
                $this->load->libraries("nome_da_classe");
                $this->load->view("Home/templates/head");"
        ';
        $metodo_input = '
            Ele ira retornar todos os campos de input, precisamos ainda
            dizer qual tipo de input estamos interessado.
            Sintaxe:
                $this->titulo = $this->input->post("id_titulo");
                $this->nome = $this->input->get("id_nome");
        ';
    }
    public function getPastaModels() {
        $this->pastaModels = "
            Pasta responsável por manter as Classe que irão realizar
            as querys no DB, por padrão, ele estende a class CI_Model.
        ";
        $db_order_by = '
            Utilizamos esse método para ordernar a table no banco de dados,
            ela possui dois parametros ("Coluna", "ASC || DESC")
            Sintaxa:
                $this->db->order_by("coluna1", "ASC"); == CRESCENTE
                $this->db->order_by("coluna1", "DESC"); == DECRESCENTE
        ';
        $db_get_result = '
            Utilizamos esses dois métodos para retornar nossa query no DB, 
            é utilizada para realizar os filtros ou buscas no nosso Bando de 
            dados.
            Sintaxa:
                $this->db->get("animais").result(); == Realiza a query tabela animais
        ';
        $db_limit = '
            Utilizamos esse método para retornar apenas X registros no banco de dados
            Sintaxa:
                $this->db->limit(4); == Retorna apenas 4 registro do DB
        ';
        $db_from = '
            Utilizamos esse método para indicar qual tabela estamos realizando a query
            no Banco de Dados.
            Sintaxe:
                $this->db->from("animais");

            Com isso, no método get(), podemos deixa-lo vazio, pois esse método já está
            indicando qual a tabela.
        ';
        $db_select = '
            Utilizamos esse método para indicar quais as colunas que queremos selecionar
            Sintaxe:
                $this->db->select("usuario.id, usuario.nome, usuario.email");
        ';
        $db_join = '
            Utilizamos esse método para para realizar um Join(junção) entre duas tabelas
            no nosso banco de dados:
            Sintaxe: 
                $this->db->select(
                    "usuario.id as idautor, usuario.nome, postagens.user, postagens.data"
                );
                $this->db->from("postagens");
                $this->db->join("usuario", "usuario.id = postagens.user");
        ';
    }
}
