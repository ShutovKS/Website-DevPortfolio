<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;
use App\Models\Articles;

/** @var Articles $article */
$article = $data['article'];
$articleTitle = $article->title;
$articleDescription = $article->description;
$articleContent = $article->content;

$errors = $data['errors'];

$view->component('start', ['title' => $title]);
$view->component('header', $data);

?>

<?php if (!empty($errors['update'])): ?>

    <div class="alert alert-danger" role="alert">
        <ul>
            <?php foreach ($errors['update'] as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>

<main class="container">

    <div class="card">

        <div class="card-header">
            <h5 class="card-title text-center mt-2">Create Article</h5>
        </div>

        <div class="row">

            <form action="/article/update/<?= $article->id ?>" method="post">
                <input name="user_id" type="hidden" value="<?= $article->userId ?>">

                <div class="form-group container">

                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" maxlength="140"
                               value="<?= $articleTitle ?>">
                    </div>

                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="2"
                                  maxlength='250'><?= $articleDescription ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content" name="content"
                                  rows="15"><?= $articleContent ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <input type="submit" class="btn btn-primary px-5 mb-3" value="Update">
                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>

</main>

<?php

$view->component('footer');
$view->component('end');

?>

