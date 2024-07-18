<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;

?>


<?php $view->component('start', [], $title); ?>

<?php if ($data['isAuth'] === false): ?>
    <?php $view->component('header_unauthorized'); ?>
<?php else: ?>
    <?php $view->component('header_authorized'); ?>
<?php endif; ?>

<div class="container">

    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
        <div class="col-lg-6 px-0">
            <h1 class="display-4 fst-italic">dev.Blog</h1>
            <p class="lead my-3">This is a place where developers can share their ideas, thoughts, and experiences.</p>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-md-8"></div>

        <div class="col-md-4">
            <div class="position-sticky" style="top: 2rem;">
                <div class="p-4 mb-3 bg-body-secondary rounded">
                    <h4 class="fst-italic text-body-emphasis">Who is dev.Blog for?</h4>
                    <p class="mb-0">This blog is for developers who want to share their ideas, thoughts, and
                        experiences.</p>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $view->component('end'); ?>
