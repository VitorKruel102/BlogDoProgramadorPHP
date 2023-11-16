<?php 


class LibraryForm {
    public $introducao;
    public $validation_errors;
    public $criandoFormulario;
    public $set_rules;
    public $condicaoValidacao;

    public function __construct() {
        $this->introducao = '
            Essa Library tem como objetivo facilitar a criação de
            formulário com o FrameWork. Precisamos carregalo dentro
            do Controller e no AutoLoad para conseguilo utiliza-lo;
            Sintaxa:
                Autoload:
                    $autoload["helper"] = array("url", "form", "html");
                Controller:
                    $this->load->library("form_validation");
        ';
    }
    public function set_ValidationErrors() {
        $this->validation_errors = '
            É utilizado dentro da view para mostrar mensagens de erros quando
            o usuário preencher os dados incorretamente
            Possui dois parâmetros:
            parâmetros (
                \'<div class="alert alert-danger">\',
                \'</div>\'
            )
            Todos os erros serão colocados dentro dessa tag.
        ';
    }
    
    public function set_CriandoFormulario() {
        $this->criandoFormulario = '
            Toda a criação de um formulário necessita duas funções:
                form_open("admin/category/insert");
                    // Campos do Formulário
                form_close();

            "admin/category/insert" => Método que será chamado para registrar
                                       e validar o formulario.
        ';
    }
    public function set_SetRules() {
        $this->set_rules = '
            Esse método vem da Class "form_validation", utilizamos
            elas para criar validadores de input do nosso formulário
            Possui três:
                $validator = "required|min_length[3]|is_unique[categoria.titulo]";
                parâmetros(
                    "id_input", 
                    "nome_descritivo_campo",
                    $validador
                )
        ';
        $tipos_validadores = '
            required => Campo Requirido;
            min_length[3] => Mínimo 3 caracteres;
            max_length[3] => Máximo 3 caracteres;
            is_unique[categoria.titulo] => Registro Titulo precisa ser único;
        ';
    }
    public function set_CondicaoValidacao() {
        $this->condicaoValidacao = '
            $this->form_validation->run()
            -----------------------------
                Retornar TRUE se o Form está válido

            $this->categories_model->add_category($titulo)
            ----------------------------------------------
                Método criado dentro do model para salvar informações, se 
                conseguir salvar ele ira retornar TRUE.

            ESTRUTURA BASE:
            if (!$this->form_validation->run()) {
                $this->index(); // Retorna para a mesma página que estava
            } else {
                $titulo = $this->input->post($id_category);

                if ($this->categories_model->add_category($titulo)){
                    redirect(base_url("admin/categoria"));
                } else {
                    echo "Houve um erro no sistema!";
                }
            }
        ';
    }
}