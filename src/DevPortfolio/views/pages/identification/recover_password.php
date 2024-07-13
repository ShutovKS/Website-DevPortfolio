<?php
/**
 * @var View $view
 * @var array $data
 */

use App\Kernel\Services\View\View;

?>

<?php $view->component('start'); ?>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

<main class="container d-flex min-vh-100">

    <div class="w-50 m-auto">

        <?php $view->component('page_under_construction'); ?>

    </div>

</main>

</body>

<?php $view->component('end'); ?>
