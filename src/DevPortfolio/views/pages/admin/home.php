<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;

?>


<?php $view->component('start'); ?>

<title><?php echo $title; ?></title>

<body>

<?php if ($data['isAuth'] === false): ?>
    <?php $view->component('header_unauthorized'); ?>
<?php else: ?>
    <?php $view->component('header_authorized'); ?>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Admin Home</h1>
        </div>
    </div>
</div>

<?php $view->component('footer'); ?>

</body>

<?php $view->component('end'); ?>
