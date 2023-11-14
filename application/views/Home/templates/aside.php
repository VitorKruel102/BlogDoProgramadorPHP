    <!-- Blog Sidebar Widgets Column -->
    <hr>
    <div class="col-md-4">
        <!-- Blog Search Well -->
        <div class="well">
            <h4>Busca no Blog</h4>
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
            <!-- /.input-group -->
        </div>

        <!-- Blog Categories Well -->
        <div class="well">
            <h4>Categorias do Blog</h4>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">
                        <?php foreach ($categories as $category): ?>
                            <li>
                                <a href="<?= base_url("categoria/$category->id/".snake_case($category->titulo)) ?>"><?= $category->titulo ?></a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>
<!-- /.row -->
<hr>