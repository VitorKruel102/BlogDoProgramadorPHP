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
                <?php if($post->img): ?>
                    <img class="img-responsive" src="<?= base_url("assets/Home/img/publication/".md5($post->id)); ?>" alt="">
                    <hr>
                <?php  endif; ?>
                <p>
                    <?= $post->conteudo ?>
                </p>
                <hr>
            <?php endforeach ?>
        </div>
