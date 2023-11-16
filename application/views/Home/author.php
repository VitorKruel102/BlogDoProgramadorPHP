<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                <?= $title ?><small> > <?= $caption ?></small>
            </h1>
            <!-- Author -->
            <?php foreach($authors as $author): ?>
                <div class="col-md-4">
                    <img
                        class="img-responsive img-circle" 
                        src="http://placehold.it/200x200" 
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
            <?php endforeach ?>
        </div>
