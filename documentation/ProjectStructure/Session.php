<?php 

class Session {
    public $introducao;
    public $configuracaoSession;
    public $comoCriarVariaveisSession;

    public function __construct() {
        $this->introducao = '
            Session é muito utilizada para salvar informações "globais",
            ou seja, quando precisamos salvar informações do usuário para
            serem utilizados em varias páginas, podemos colocar tudo na
            sessão da página.
        ';
    }

    public function set_configuracaoSession() {
        $this->configuracaoSession = '
            Precismos adicionalo nas libraries("session");
            Configurar ela no Config.php;
                $config["sess_driver"] = "database";      --> Informar que será em um Banco de Dados;
                $config["sess_expiration"] = 0;           --> Fecha a sessão quando o usuario sair da pagina (0s);
                $config["sess_save_path"] = "ci_session"; --> Informar que o nome da tabela no DB;
                $config["sess_match_ip"] = TRUE;          --> Para informar o número do IP do usuário; 
            
            Precisamos ter uma estrutura do banco de dados;
                id;
                ip_address;
                timestamp;
                data;
        ';
    }

    public function set_ComoCriarVariaveisSession() {
        $this->comoCriarVariaveisSession = '
            $data = [
                "user_logged"=> $user_exists[0],
                "logged"=> TRUE,
            ];
            $this->session->set_userdata($data);
        ';
        $this->acessarVariaveisSession = '
            $this->session->userdata("user_logged")->nome;
        ';
    }
}