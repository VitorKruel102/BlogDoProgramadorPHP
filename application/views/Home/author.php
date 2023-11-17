<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                <?= $title ?><small> > <?= $caption ?></small>
            </h1>
            <!-- Author -->
            <div class="col-md-4">
                <?php 
                    if ($author->img) {
                        $url_photo = "assets/Home/img/users/".md5($author->id); 
                    } else {
                        $url_photo = "assets/Home/img/semFoto.png";
                    }
                ?>
                <img
                    class="img-responsive img-circle" 
                    src="<?= base_url($url_photo) ?>" 
                    alt="imagem autor"
                >
            </div>
            <div class="col-md-8 ">
                <h2>
                    <?=$author->nome?>
                </h2>
                <hr>
                <p>
                    <?=$author->historico?>
                </p>
                <hr>
            </div>
        </div>
