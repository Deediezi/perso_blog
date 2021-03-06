<?php
    $title = "Ajouter un article";

/** @var \Model\Entities\Post $post */
?>

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-12 col-md-8 mx-auto">

            <h2 class="text-center text-uppercase text-secondary mt-4">Modifier l'article <?= $post->getPostId() ?></h2>
            <hr class="star-dark mb-5">

            <?php
            if(isset($msg)) {
                foreach ($msg as $type => $msg) {
                    echo "<p class='bg-".$type."'>".$msg."</p>";
                }
            }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="title">Titre de l'article</label>
                    <input type="text" class="form-control" name="title" value="<?= (isset($_POST["title"])) ? htmlspecialchars($_POST["title"]) : htmlspecialchars($post->getTitle())?>" />
                </div>

                <div class="form-group">
                    <label for="image">Image de présentation (optionnel) (1MB max)</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input type="file" class="form-control" name="image" />
                </div>

                <div class="form-group">
                    <label for="content">Contenu de l'article</label>
                    <textarea rows="12" id="summernote" class="form-control" name="content" ><?= (isset($_POST["content"])) ? htmlspecialchars($_POST["content"]) : htmlspecialchars($post->getContent())?></textarea>
                </div>

                <div class="form-group">
                    <input type="hidden" name="token" id="token" value="<?= (isset($_SESSION["token"])) ? $_SESSION["token"] : null ?>" />
                    <button type="submit" name="submit" class="btn btn-primary">
                        Modifier
                    </button>
                    <a href="/admin/articles" class="btn btn-default bg-danger text-white">
                        Annuler
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>