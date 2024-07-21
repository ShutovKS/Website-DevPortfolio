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

    <main>

    </main>

<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>