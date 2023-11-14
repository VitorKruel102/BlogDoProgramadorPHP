<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                Página Inicial - <small>Postagens Recentes</small>
            </h1>


            <!-- First Blog Post -->
            <?php foreach($posts as $post): ?>
                <h2>
                    <a href="#"><?= $post->titulo ?></a>
                </h2>
                <p class="lead">
                    por <a href="index.php"> Start Bootstrap</a>
                </p>
                <p>
                    <span class="glyphicon glyphicon-time"></span> 
                    Postado em <?= $post->data ?>
                </p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>
                    <?= $post->conteudo ?>
                </p>
                <a class="btn btn-primary" href="#">
                    Leia mais <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <hr>
            <?php endforeach ?>
        </div>
