<?php
/**
 * @var View $view
 * @var array $data
 */

use App\Kernel\Services\View\View;

?>

<?php $view->component('start'); ?>

<?php if ($data['isAuth'] === false): ?>
    <?php $view->component('header_unauthorized'); ?>
<?php else: ?>
    <?php $view->component('header_authorized'); ?>
<?php endif; ?>

    <h1>Home page</h1>

<?php $view->component('end'); ?>