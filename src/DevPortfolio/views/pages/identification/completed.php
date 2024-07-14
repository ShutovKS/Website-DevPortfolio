<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;

?>

<title><?php echo $title; ?></title>

<?php $view->component('start'); ?>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

<main class="container w-50 d-flex min-vh-100">

    <div class="form-signin w-100 m-auto">

        <h2 class="text-center mb-4">You are logged in to your account</h2>

        <form action="/" method="get">
            <button class="w-100 btn btn-lg btn-primary" type="submit">Go to home page</button>
        </form>

    </div>

</main>

</body>

<?php $view->component('end'); ?>
