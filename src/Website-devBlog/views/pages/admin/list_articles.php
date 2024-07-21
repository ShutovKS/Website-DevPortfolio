<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;
use App\Models\Articles;

?>


<?php $view->component('start', ['title' => $title]); ?>

<?php $view->component('header', $data); ?>

<?php

/** @var Articles[] $articles */
$articles = $data['articles'];

?>

<main class="d-flex flex-nowrap">
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
        <a href="/admin/" class="mb-md-0 text-decoration-none text-center">
            <span class="fs-4">Admin panel</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="/admin/home" class="nav-link link-body-emphasis" aria-current="page"> Home </a>
            </li>
            <li>
                <a href="/admin/dashboard" class="nav-link link-body-emphasis"> Dashboard </a>
            </li>
        </ul>
        <hr>
    </div>

    <div class="w-100">
        <h1 class="text-center">Articles</h1>
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr class="d-flex table-secondary">
                <th class="col-1 text-center" scope="col">ID</th>
                <th class="col-2 text-center" scope="col">Title</th>
                <th class="col-5 text-center" scope="col">Description</th>
                <th class="col-1 text-center" scope="col">Author ID</th>
                <th class="col-1 text-center" scope="col">Created at</th>
                <th class="col-1 text-center" scope="col">Updated at</th>
                <th class="col-1 text-center" scope="col">Actions</th>
            </tr>
            <tr class="d-flex table-secondary">
                <th class="col-1"></th>
                <th class="col-10 text-center" scope="col">Content</th>
                <th class="col-1"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($articles as $article): ?>
                <tr class="d-flex">
                    <th class="col-1 text-center" scope="row"><?= $article->id ?></th>
                    <td class="col-2 text-center"><?= htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="col-5"><?= htmlspecialchars($article->description ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="col-1 text-center"><?= $article->userId ?></td>
                    <td class="col-1 text-center"><?= $article->createdAt ?></td>
                    <td class="col-1 text-center"><?= $article->updatedAt ?></td>
                    <td class="col-1 text-center btn-group-sm">
                        <a href="/article/view/<?= $article->id ?>" class="w-100 btn btn-primary">View</a>
                        <a href="/article/edit/<?= $article->id ?>" class="w-100 btn btn-warning">Edit</a>
                        <a href="/article/delete/<?= $article->id ?>" class="w-100 btn btn-danger">Delete</a>
                    </td>
                </tr>
                <tr class="d-flex">
                    <td class="col-1 text-center">
                        <button class="btn btn-info" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseContent<?= $article->id ?>" aria-expanded="false">
                            Show content
                        </button>
                    </td>
                    <td class="col-10">
                        <div class="collapse" id="collapseContent<?= $article->id ?>">
                            <div class="card card-body">
                                <?= nl2br(htmlspecialchars($article->content, ENT_QUOTES, 'UTF-8')) ?>
                            </div>
                        </div>
                    </td>
                    <td class="col-1"></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</main>
<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
