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

<main class="d-flex flex-nowrap">
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
        <a href="/admin/" class="mb-md-0 text-decoration-none text-center">
            <span class="fs-4">Admin panel</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="/admin/home" class="nav-link active" aria-current="page"> Home </a>
            </li>
            <li>
                <a href="/admin/dashboard" class="nav-link link-body-emphasis"> Dashboard </a>
            </li>
        </ul>
        <hr>
    </div>

    <div class="container">

    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Admin Home</h1>
        </div>
    </div>

    </div>

</main>
<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
