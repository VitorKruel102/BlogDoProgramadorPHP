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
                            <?= form_open("admin/publications/save_edit/".md5($publication->id)) ?>
                                <div class="form-group">
                                    <label id="select-categoria">Categoria</label>
                                    <select id="select-categoria" name="select-categoria" class="form-control">
                                        <?php foreach($categories as $category): ?>
                                            <option 
                                                value="<?= $category->id ?>"
                                                <?php if($category->id == $publication->categoria) {echo "selected";}?>
                                            >
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
                                        value="<?= $publication->titulo ?>"
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
                                        value="<?= $publication->subtitulo ?>"
                                    >
                                </div>
                                <div class="form-group">
                                    <label id='text-conteudo'>Conteudo</label>
                                    <textarea 
                                        id="text-conteudo" 
                                        name="text-conteudo"
                                        class="form-control" 
                                    ><?= $publication->conteudo ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label id='text-data'>Data</label>
                                    <input 
                                        type="datetime-local" 
                                        id="text-data" 
                                        name="text-data"
                                        class="form-control" 
                                        placeholder="Digite o data do usuário..."
                                        value="<?= $publication->data ?>"
                                    >
                                </div>
                                <button type="submit" class="btn btn-default">Salvar Alterações</button>
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
                    <?= "Imagem de destaque do $caption" ?><small></small>
                </div>
                <div class="panel-body">
                    <div class="row" style="padding-bottom: 15px;">
                        <div class="col-lg-3 col-lg-offset-1">
                            <?php 
                                if ($publication->img) {
                                    echo img(
                                        "assets/Home/img/publication/".md5($publication->id), 
                                        false, 
                                        ["style"=> "border-radius: 50%"]
                                    ); 
                                } else {
                                    echo img(
                                        "assets/Home/img/semFoto2.png",
                                        false, 
                                        ["style"=> "border-radius: 50%"]
                                    );
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= form_open_multipart('admin/publication/new_photo/'.md5($publication->id)) ?>
                                <?= form_hidden('id', md5($publication->id)) ?>
                                <div class="form-group">
                                    <?= form_upload(
                                        array(
                                            'name'=> 'userfile',
                                            'id'=> 'userfile',
                                            'class'=> 'form-control',
                                        )
                                    ) ?>
                                </div>
                                <div class="form-group">
                                    <?= form_submit(
                                        array(
                                            'name'=> 'btn_adicionar',
                                            'id'=> 'btn_adicionar',
                                            'class'=> 'btn btn-default',
                                            'value'=> 'Adicionar nova imagem',
                                        )
                                    ) ?>
                                </div>
                            <?= form_close() ?>
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