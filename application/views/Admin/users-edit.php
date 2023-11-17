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
                            <?= form_open("admin/users/save_edit/".md5($user->id)) ?>
                                <div class="form-group">
                                    <label id='text-nome'>Nome do Usuário</label>
                                    <input 
                                        type="text" 
                                        id="text-nome" 
                                        name="text-nome"
                                        class="form-control" 
                                        placeholder="Digite o nome do usuário..."
                                        value="<?= $user->nome ?>"
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
                                        value="<?= $user->email ?>"
                                    >
                                </div>
                                <div class="form-group">
                                    <label id='text-historico'>Histórico</label>
                                    <textarea 
                                        name="text-historico" 
                                        id="text-historico" 
                                        cols="30" 
                                        rows="5" 
                                        class="form-control"
                                    >
                                        <?= $user->historico ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label id='text-user'>User</label>
                                    <input 
                                        type="text" 
                                        id="text-user" 
                                        name="text-user"
                                        class="form-control" 
                                        placeholder="Digite o user do usuário..."
                                        value="<?= $user->user ?>"
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
                                <button type="submit" class="btn btn-default">Atualizar</button>
                            <?= form_close()?>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->