<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                <?= $title ?><small> > <?= $caption ?></small>
            </h1>
            <!-- Authors -->
            <div class="col-md-12 "> 
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
            <br>
            <h1 class="page-header">
                Nossos autores
            </h1>
            <div class="col-md-12 row">
                <?php foreach($authors as $author): ?>
                    <div class="col-md-4 col-xs-6">
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
                        <h4 class="text-center">
                            <a href="<?= base_url("autor/$author->id/".snake_case($author->nome)) ?>">
                                <?= $author->nome ?>
                            </a>
                        </h4> 
                    </div>
                <?php endforeach ?>
            </div>
        </div>
