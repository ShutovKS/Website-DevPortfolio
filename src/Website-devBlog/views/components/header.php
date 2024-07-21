<?php
/**
 * @var $data array
 * @var $view View
 */

use App\Kernel\Services\View\View;

?>

<?php if ($data['current_user_is_auth'] === false): ?>
    <?php $view->component('header/unauthorized'); ?>
<?php else: ?>
    <?php $view->component('header/authorized', $data); ?>
<?php endif; ?>