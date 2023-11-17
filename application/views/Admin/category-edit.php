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
                    <?= "Alterar $caption" ?><small></small>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= form_open("admin/category/save_edit/".md5($category->id)) ?>
                                <div class="form-group">
                                    <label>Nome da Categoria</label>
                                    <input 
                                        type="text" 
                                        id="text-categoria" 
                                        name="text-categoria"
                                        class="form-control" 
                                        placeholder="Digite o nome da categoria..."
                                        value="<?= $category->titulo ?>"
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
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->