<?php

    /** @var \Model\Entities\Post $post */
    /** @var \Model\Entities\Comment $comment */

    $title = $post->getTitle();

?>

<!-- Page Content -->
<div class="container pt-5 mt-5">

    <!-- Post section -->
    <div class="row">

        <!-- Post header -->
        <div class="col-12">
            <hr>

            <p>Posté le <b><?= $post->getCreationDate()?></b> par <b><?= $post->getAuthor() ?></b>
                <?php
                    if(!is_null($post->getLastUpdate())) {
                        echo "<span class='d-block'>Modifié le <b> " . $post->getLastUpdate() . "</b></span>";
                    }
                ?>
            </p>

            <hr>

            <!-- Post  title -->
            <h2 class="text-center text-uppercase text-secondary mt-4"><?= $post->getTitle() ?></h2>
            <hr class="star-dark mb-5">
        </div>

        <!-- Post image -->
        <div class="col-12 text-center">
            <?php
                if($post->hasPicture()) {
                    echo "<img class='img-fluid rounded' src='". $post->getImageForDisplay() ."' alt='Image de l'article numéro'". $post->getPostId() ."'";
                }
            ?>
            <hr>
        </div>

        <!-- Post content -->
        <div class="col-12 mt-5">

            <?= nl2br($post->getContent()) ?>

            <hr>
        </div>
    </div>

    <!-- Comments section -->
    <div class="row" id="form">
        <div class="col-sm-12 col-md-10 col-lg-8 mx-auto text-center">

            <div class="card my-4">
                <h5 class="card-header">Laisser un commentaire</h5>
                <div class="card-body">
                    <form action="#form" method="POST">
                        <div class="form-group">
                            <input type="text" name="author" placeholder="Pseudo" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <textarea name="content" class="form-control" rows="3" placeholder="Message ..."></textarea>
                        </div>
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>

            <?php
                if(isset($msg)) {
                    foreach ($msg as $type => $msg) {
                        echo "<p class='bg-".$type."'>".$msg."</p>";
                    }
                }
            ?>

        </div>
    </div>

    <!-- Comments list -->
    <div class="row">

        <?php
            if(!empty($comments)) {
                foreach ($comments as $comment) {
        ?>

            <div class="col-12 media mb-4">
                <div class="media-body">
                    <h5 class="mt-0"><?= $comment->getAuthor() ?></h5>
                    <p><?= $comment->getContent() ?></p>
                </div>
            </div>

        <?php
                }
            } else {
        ?>
             <div class="col-12 text-center">
                 <p>Oups ... Il semblerait que personne ne soit passé par là !</p>
             </div>
        <?php
            }
        ?>

    </div>

    <hr>
</div>
