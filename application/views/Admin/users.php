<div id="page-wrapper">
    <br>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?= "Administrar novo $caption" ?>
            </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= "Adicionar nova $caption" ?><small></small>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
                            <?= form_open("admin/users/insert") ?>
                                <div class="form-group">
                                    <label id='text-nome'>Nome do Usuário</label>
                                    <input 
                                        type="text" 
                                        id="text-nome" 
                                        name="text-nome"
                                        class="form-control" 
                                        placeholder="Digite o nome do usuário..."
                                        value="<?= set_value('text-nome')?>"
                                    >
                                </div>
                                <div class="form-group">
                                    <label id='text-email'>E-mail</label>
                                    <input 
                                        type="text" 
                                        id="text-email" 
                                        name="text-email"
                                        class="form-control" 
                                        placeholder="Digite o email do usuário..."
                                        value="<?= set_value('text-email')?>"
                                    >
                                </div>
                                <div class="form-group">
                                    <label id='text-historico'>Histórico</label>
                                    <textarea 
                                        id="text-historico" 
                                        name="text-historico"
                                        class="form-control" 
                                    ><?= set_value('text-historico')?></textarea>
                                </div>
                                <div class="form-group">
                                    <label id='text-user'>User</label>
                                    <input 
                                        type="text" 
                                        id="text-user" 
                                        name="text-user"
                                        class="form-control" 
                                        placeholder="Digite o user do usuário..."
                                        value="<?= set_value('text-user')?>"
                                    >
                                </div>
                                <div class="form-group">
                                    <label id='text-senha'>Senha</label>
                                    <input 
                                        type="password" 
                                        id="text-senha" 
                                        name="text-senha"
                                        class="form-control" 
                                        placeholder="Digite o senha do usuário..."
                                    >
                                </div>
                                <div class="form-group">
                                    <label id='text-confirmar-senha'>Confirmar senha</label>
                                    <input 
                                        type="password" 
                                        id="text-confirmar-senha" 
                                        name="text-confirmar-senha"
                                        class="form-control" 
                                    >
                                </div>
                                <button type="submit" class="btn btn-default">Cadastrar</button>
                            <?= form_close()?>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= "Alterar $caption existente" ?><small></small>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php 
                                $this->table->set_heading(
                                    "Foto",
                                    "Nome do Usuário",
                                    "Alterar",
                                    "Excluir"
                                );
                                foreach ($users as $user) {
                                    if ($user->img) {
                                        $photo = img(
                                            "assets/Home/img/users/".md5($user->id), 
                                            false, 
                                            ["style"=> "border-radius: 50%; width: 50px"]
                                        ); 
                                    } else {
                                        $photo = img(
                                            "assets/Home/img/semFoto.png",
                                            false, 
                                            ["style"=> "border-radius: 50%; width: 50px"]
                                        );
                                    }
                                    $name = $user->nome;
                                    $change = anchor(
                                        base_url('admin/usuarios/alterar/'.md5($user->id)), 
                                        '<i class="fa fa-refresh fa-fw"></i> Alterar'
                                    );
                                    $exclude = anchor(
                                        base_url('admin/usuarios/excluir/'.md5($user->id)), 
                                        '<i class="fa fa-remove fa-fw"></i> Excluir'
                                    );
                                    $this->table->add_row($photo, $name, $change, $exclude);
                                }
                                $this->table->set_template(array(
                                    'table_open'=> '<table class="table table-stried">',
                                ));
                                echo $this->table->generate();
                            ?>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->