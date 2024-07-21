<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;

?>


<?php $view->component('start', ['title' => $title]); ?>

<?php $view->component('header', $data); ?>

<?php

$number_users = $data['number_users'];
$number_articles = $data['number_articles'];

?>

<?php

$statistic = [
    [
        'title' => 'Users',
        'number' => $number_users,
        'link' => '/admin/list/users',
        'color' => 'blue'
    ],
    [
        'title' => 'Articles',
        'number' => $number_articles,
        'link' => '/admin/list/articles',
        'color' => 'green'
    ],
];

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
                <a href="/admin/dashboard" class="nav-link active"> Dashboard </a>
            </li>
        </ul>
        <hr>
    </div>

    <div class="container px-4">
        <div class="row row-cols-lg-4 g-4 ">

            <?php foreach ($statistic as $item): ?>
                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-white rounded-5 shadow-lg"
                         style="background-color: <?= $item['color'] ?>;">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1 text-center">
                            <h2 class="fw-bold"><?= $item['title'] ?></h2>
                            <h2 class="pt-2 display-6 lh-1 fw-bold"><?= $item['number'] ?></h2>
                             <a href="<?= $item['link'] ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

</main>
<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
