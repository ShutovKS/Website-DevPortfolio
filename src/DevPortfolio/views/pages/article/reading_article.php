<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;
use App\Models\Articles;

?>

<?php $view->component('start', ['title' => $title]); ?>

<?php if ($data['isAuth'] === false): ?>
    <?php $view->component('header_unauthorized'); ?>
<?php else: ?>
    <?php $view->component('header_authorized', $data); ?>
<?php endif; ?>

<?php
/** @var Articles $article */
$article = $data['article'];

?>

    <main class="container my-5">

        <div class="bg-body-tertiary p-5 rounded">

            <div class="col-sm-8 py-5 mx-auto">

                <h1 class="display-5 fw-normal"><?php echo $article->title ?></h1>

                <p class="fs-5"><?php echo $article->content ?></p>

            </div>

        </div>

    </main>

<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>