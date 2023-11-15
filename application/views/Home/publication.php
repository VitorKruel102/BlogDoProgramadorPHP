<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <!-- Posts -->
            <?php foreach($posts as $post): ?>
                <hr>
                <h1>
                    <?= $post->titulo ?>
                </h1>
                <p class="lead">
                    por 
                    <a href="<?= base_url("autor/$post->idautor/".snake_case($post->nome)) ?>"> 
                        <?= $post->nome ?>
                    </a>
                </p>
                <p>
                    <span class="glyphicon glyphicon-time"></span> 
                    Postado: <?= date_format_string($post->data) ?>
                </p>
                <hr>
                <p>
                    <?= $post->subtitulo ?>
                </p>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>
                    <?= $post->conteudo ?>
                </p>
                <hr>
            <?php endforeach ?>
        </div>
