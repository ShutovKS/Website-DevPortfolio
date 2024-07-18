<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;

?>


<?php $view->component('start', ['title' => $title]); ?>

<?php $view->component('header_authorized', $data); ?>

<main class="d-flex min-vh-100">

    <div class="container m-auto">

        <h2 class="text-center mb-4">You are logged in to your account</h2>

        <form action="/" method="get">
            <button class="w-100 btn btn-lg btn-primary" type="submit">Go to home page</button>
        </form>

    </div>

</main>

<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
