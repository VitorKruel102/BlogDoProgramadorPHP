<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                <?= $title ?><small> > <?= $caption ?></small>
            </h1>
            <!-- Posts -->
            <?php foreach($posts as $post): ?>
                <h2>
                    <a href="<?= base_url("postagem/$post->id/".snake_case($post->titulo)) ?>">
                        <?= $post->titulo ?>
                    </a>
                </h2>
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
                <?php if($post->img): ?>
                    <img class="img-responsive" src="<?= base_url("assets/Home/img/publication/".md5($post->id)); ?>" alt="">
                    <hr>
                <?php  endif; ?>
                <p>
                    <?= $post->subtitulo ?>
                </p>
                <a class="btn btn-primary" href="<?= base_url("postagem/$post->id/".snake_case($post->titulo)) ?>">
                    Leia mais <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <hr>
            <?php endforeach ?>
        </div>
