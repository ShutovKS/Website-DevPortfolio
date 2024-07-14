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

<?php $view->component('header_authorized'); ?>

<div class="container">

</div>

<?php $view->component('footer'); ?>

</body>

<?php $view->component('end'); ?>
