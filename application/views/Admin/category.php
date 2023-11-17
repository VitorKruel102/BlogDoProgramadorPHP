<div id="page-wrapper">
    <br>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?= "Administrar $caption" ?>
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
                            <?= form_open("admin/category/insert") ?>
                                <div class="form-group">
                                    <label id='text-categoria'>Nome da Categoria</label>
                                    <input 
                                        type="text" 
                                        id="text-categoria" 
                                        name="text-categoria"
                                        class="form-control" 
                                        placeholder="Digite o nome da categoria..."
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
                                    "Nome da Categoria",
                                    "Alterar",
                                    "Excluir"
                                );
                                foreach ($categories as $category) {
                                    $nome = $category->titulo;
                                    $alterar = anchor(
                                        base_url('admin/categoria/alterar/'.md5($category->id)), 
                                        '<i class="fa fa-refresh fa-fw"></i> Alterar'
                                    );
                                    $excluir = anchor(
                                        base_url('admin/categoria/excluir/'.md5($category->id)), 
                                        '<i class="fa fa-remove fa-fw"></i> Excluir'
                                    );
                                    $this->table->add_row($nome, $alterar, $excluir);
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