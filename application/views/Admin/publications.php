<div id="page-wrapper">
    <br>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?= "Administrar nova $caption" ?>
            </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= "Adicionar nova $caption" ?><small></small>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
                            <?= form_open("admin/publications/insert/".$this->session->userdata('user_logged')->id) ?>
                                <div class="form-group">
                                    <label id="select-categoria">Categoria</label>
                                    <select id="select-categoria" name="select-categoria" class="form-control">
                                        <?php foreach($categories as $category): ?>
                                            <option value="<?= $category->id ?>">
                                                <?= $category->titulo ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label id='text-titulo'>Titulo</label>
                                    <input 
                                        type="text" 
                                        id="text-titulo" 
                                        name="text-titulo"
                                        class="form-control" 
                                        placeholder="Digite o titulo do usuário..."
                                        value="<?= set_value('text-titulo')?>"
                                    >
                                </div>
                                <div class="form-group">
                                    <label id='text-subtitulo'>Subtitulo</label>
                                    <input 
                                        type="text" 
                                        id="text-subtitulo" 
                                        name="text-subtitulo"
                                        class="form-control" 
                                        placeholder="Digite o subtitulo do usuário..."
                                        value="<?= set_value('text-subtitulo')?>"
                                    >
                                </div>
                                <div class="form-group">
                                    <label id='text-conteudo'>Conteudo</label>
                                    <textarea 
                                        id="text-conteudo" 
                                        name="text-conteudo"
                                        class="form-control" 
                                    ><?= set_value('text-conteudo')?></textarea>
                                </div>
                                <div class="form-group">
                                    <label id='text-data'>Data</label>
                                    <input 
                                        type="datetime-local" 
                                        id="text-data" 
                                        name="text-data"
                                        class="form-control" 
                                        placeholder="Digite o data do usuário..."
                                        value="<?= set_value('text-data')?>"
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
        <div class="col-lg-12">
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
                                    "Titulo",
                                    "Data",
                                    "Alterar",
                                    "Excluir"
                                );
                                foreach ($publications as $publication) {
                                    $photo = 'Foto Pub';
                                    $title = $publication->titulo;
                                    $date = date_format_string($publication->data);
                                    $change = anchor(
                                        base_url('admin/publicacao/alterar/'.md5($publication->id)), 
                                        '<i class="fa fa-refresh fa-fw"></i> Alterar'
                                    );
                                    $exclude = anchor(
                                        base_url('admin/publicacao/excluir/'.md5($publication->id)), 
                                        '<i class="fa fa-remove fa-fw"></i> Excluir'
                                    );
                                    $this->table->add_row($photo, $title, $date, $change, $exclude);
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