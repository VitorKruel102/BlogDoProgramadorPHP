<?php 


class LibraryForm {
    public $introducao;
    public $validation_errors;
    public $criandoFormulario;
    public $set_rules;
    public $condicaoValidacao;
    public $criandoFormularioFotos;

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
        $this->set_value = '
                Utilizado dentro do atributo value para deixar salvo os dados
                do formulário quando tiver algum erro, para não apagar o que
                já havia sido feito;
                Sintaxe:
                    value="<?= set_value("txt-nome")?>"
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
            valid_email => Valida o email  ;
            matches[id_input] => Se igual ao valor de outro input;
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

    public function set_CriandoFormularioFotos() {
        $this->criandoFormularioFotos = '
            Para criar um formulário de envio de uma imagen, vamos precisar
            alterar um pouco a estrutura de formulário:
            index.php:
                <?= form_open_multipart("admin/users/new_photo/".md5($user->id)) ?>   --> Direciona para o método que irá validar a foto
                <div class="form-group">
                    <?= form_upload(                                                  --> Direciona os atributos do input
                        array(
                            "name"=> "userfile",                                      --> userfile é OBRIGATORIO
                            "id"=> "userfile",                                        --> userfile é OBRIGATORIO
                            "class"=> "form-control",
                        )
                    ) ?>
                </div>
                <div class="form-group">
                    <?= form_submit(
                        array(
                            "name"=> "btn_adicionar",
                            "id"=> "btn_adicionar",
                            "class"=> "btn btn-default",
                            "value"=> "Adicionar nova imagem",
                        )
                    ) ?>
                </div>
            <?= form_close() ?>

            Controller: 
                $config_upload = [
                    "upload_path"=> "./assets/Home/img/users",  -> Aonde será salvo as imagens;
                    "allowed_types"=> "jpg",                    -> Tipo de imagens permitidas;
                    "file_name"=> "$id.jpg",                    -> Como será os nomes dos arquivos;
                    "overwrite"=> TRUE,                         -> Utilizar sempre True para reescrever a imagem quando o usuario altera-la;
                ];
                $this->load->library("upload", $config_upload); 

                if (!$this->upload->do_upload()) {               -> Analisae fez ou não o upload
                    echo $this->upload->display_errors();        -> Exibe os erros
                } else {
                    $config_img = [
                        "source_image"=> "./assets/Home/img/users/$id.jpg",             -> Chama a imagem
                        "create_thumb"=> FALSE,                                         -> Crie uma thumb
                        "width"=> 200,
                        "height"=> 200,
                    ];
                    $this->load->library("image_lib", $config_img);
        
                    if ($this->image_lib->resize()) {                                   -> Analise se houve ou não o ajuste na imagem
                        redirect(base_url("admin/usuarios/alterar/$id"));
                    } else {
                        echo $this->image_lib->display_errors();                        -> Exibe os erros
                    }
                }
        ';
        $this->mostrando_imagem = '
                Para mostrar a imagem, basta colocar a url da foto em uma função img().
                Sintaxe:
                    <?=img("assets/Home/img/users/".md5($user->id))?>
        ';
    }
}