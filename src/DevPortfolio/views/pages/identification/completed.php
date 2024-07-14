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

<main class="d-flex min-vh-100">

    <div class="container m-auto">

        <h2 class="text-center mb-4">You are logged in to your account</h2>

        <form action="/" method="get">
            <button class="w-100 btn btn-lg btn-primary" type="submit">Go to home page</button>
        </form>

        <?php $view->component('footer'); ?>

    </div>

</main>

</body>

<?php $view->component('end'); ?>
