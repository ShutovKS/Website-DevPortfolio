<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;

?>


<?php $view->component('start', [], $title); ?>

<main class="d-flex min-vh-100">

    <div class="container m-auto">

        <div class="w-50 m-auto">

            <?php $view->component('page_under_construction'); ?>

            <?php $view->component('footer'); ?>

        </div>

</main>

<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
