<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;

?>


<?php $view->component('start', ['title' => $title]); ?>

<title><?php echo $title; ?></title>

<?php if ($data['isAuth'] === false): ?>
    <?php $view->component('header_unauthorized', $data); ?>
<?php else: ?>
    <?php $view->component('header_authorized', $data); ?>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Admin Home</h1>
        </div>
    </div>
</div>

<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
