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

    <main>

    </main>

    </body>

<?php $view->component('end'); ?>