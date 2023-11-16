<?php 

class LibraryTable {
    public $introducao;
    public $set_heading;
    public $anchor;
    public $add_row;
    public $set_template;
    public $generate;

    public function __construct() {
        $this->introducao = '
            Essa Library possui funcionalidades para facilitar 
            a criação de tabelas dentro das View utilizando o
            php. Precisamos carragalo no Controller
            Sintaxa:
                $this->load->library("table");
        ';
    }

    public function set_heading() {
        $this->set_heading = '
            Utilizamos este método para definir os nomes das colunas
            que iremos utilizar no Header da tabela.
            Sintaxe:
                $this->table->set_heading("nome", "sobrenome", "idade");
        ';
    }
    public function set_Anchor() {
        $this->anchor = '
            Método utilizado para ancoragem(Tag <a></a>), possui dois 
            parametros(URL, texto).
            Sintaxe:
                anchor(base_url("admin/alterar"), "Alterar")
                anchor(base_url("admin/excluir"), "Excluir")
        ';
    }
    public function set_addRow() {
        $this->add_row = '
            Método utilizado para adicionar linha, cada parâmetro
            é utilizado como informação da coluna.
            Sintaxe:
                $nome = $usuario->nome;
                $sobrenome = $usuario->sobrenome;
                $idade = $usuario->idade;

                $this->table->add_row(
                    $nome,
                    $sobrenome,
                    $idade,
                )
        ';
    }
    public function set_setTemplate() {
        $this->set_template = '
            Utilizado para colocar estilos na tabelas, normalmente
            é usado junto com o Bootstrap, Possui um parâmetro que 
            é um Array.
            Sintaxe:
                $this->table->set_template(array(
                    "table_open"=> "<table class=\'table table-stried\'>",
                ));
        ';
    }
    public function set_generate() {
        $this->generate = '
            Método utilizado para gerar a tabela ao final da contrução dela
            Sintaxe:
                echo $this->table->generate();
        ';
    }
}