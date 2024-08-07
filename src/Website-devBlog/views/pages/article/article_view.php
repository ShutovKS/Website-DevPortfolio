<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;
use App\Models\Articles;
use App\Models\User;

?>

<?php $view->component('start', ['title' => $title]); ?>

<?php $view->component('header', $data); ?>

<?php
/** @var Articles $article */
$article = $data['article'];

/** @var User $current_user */
$current_user = $data['current_user'];
?>

    <main class="container my-2">

        <div class="bg-body-tertiary p-4">

            <div class="col-sm-10 mx-auto">

                <h2 class="fw-normal text-center"><?php echo htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8'); ?></h2>

                <hr class="table-group-divider" />

                <p class="fs-5"><?php echo nl2br(htmlspecialchars($article->content, ENT_QUOTES, 'UTF-8')); ?></p>

                <hr class="table-group-divider" />

                <p>
                    <nobr class="fs-6">Автор:</nobr>
                    <a class="fs-6" href="/user/<?php echo $current_user->id ?>"><?php echo $current_user->fullName ?></a>
                </p>

                <p>
                    <nobr class="fs-6">Дата публикации:</nobr>
                    <nobr class="fs-6"><?php echo $article->createdAt ?></nobr>
                </p>

                <p>
                    <nobr class="fs-6">Дата последнего обновления:</nobr>
                    <nobr class="fs-6"><?php echo $article->updatedAt ?></nobr>
                </p>

            </div>

        </div>
    </main>

<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>