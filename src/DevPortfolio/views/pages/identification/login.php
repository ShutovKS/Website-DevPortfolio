<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;

?>


<?php $view->component('start', [], $title); ?>

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

            <form method="post" action="/identification/login" name="login-form">
                <h2 class="h3 mb-3 fw-bold text-center">Please sign in</h2>

                <div class="form-floating mb-1">
                    <input type="email" name="email" class="form-control" id="floatingInput"
                           placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>

                <div class="form-floating mb-1">
                    <input type="password" name="password" class="form-control" id="floatingPassword"
                           placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
            </form>

            <div class="d-flex justify-content-between">
                <form class="btn btn-link" method="get" action="/identification/signup">
                    <input type="hidden">
                    <button type="submit" class="btn btn-link">Registration</button>
                </form>

                <form class="btn btn-link" method="get" action="/identification/recover_password">
                    <input type="hidden">
                    <button type="submit" class="btn btn-link">Forgot password?</button>
                </form>
            </div>

        </div>

        <?php $view->component('footer'); ?>
    </div>

</main>

<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
