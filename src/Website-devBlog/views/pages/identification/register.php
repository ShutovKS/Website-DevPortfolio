<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;

?>


<?php $view->component('start', ['title' => $title]); ?>

<?php $view->component('header', $data); ?>

<main class="d-flex min-vh-100">

    <div class="container m-auto">

        <div class="w-50 m-auto">
            <div>
                <?php if (isset($data['errors'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($data['errors'] as $error): ?>
                            <p class="mb-0"><?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <form method="post" action="/identification/register" name="signup-form">
                <h2 class="h3 mb-3 fw-bold text-center">Please sign up</h2>

                <div class="form-floating mb-1">
                    <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username">
                    <label for="floatingInput">Username</label>
                </div>

                <div class="form-floating mb-1">
                    <input type="email" name="email" class="form-control" id="floatingInput"
                           placeholder="name@example.com" autocomplete="on">
                    <label for="floatingInput">Email address</label>
                </div>

                <div class="form-floating mb-1">
                    <input type="password" name="password" class="form-control" id="floatingPassword"
                           placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="form-check text-start mb-3">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <button class="btn btn-primary w-100 py-2" type="submit">Sign up</button>
            </form>

            <div class="d-flex justify-content-between">
                <!-- Registration Link -->
                <form class="btn btn-link" method="get" action="/identification/login">
                    <input type="hidden">
                    <button type="submit" class="btn btn-link">Login</button>
                </form>
            </div>

        </div>

</main>

<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
