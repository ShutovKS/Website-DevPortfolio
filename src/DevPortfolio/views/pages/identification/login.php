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

<main class="container w-25 d-flex min-vh-100">

    <div class="form-signin w-100 m-auto">

        <!-- Вывод об ошибках -->
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
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>

            <div class="form-floating mb-1">
                <input type="password" name="password" class="form-control" id="floatingPassword"
                       placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <!--        <div class="form-check text-start my-3">-->
            <!--            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">-->
            <!--            <label class="form-check-label" for="flexCheckDefault">Remember me </label>-->
            <!--        </div>-->

            <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
        </form>

        <div class="d-flex justify-content-between">
            <!-- Registration Link -->
            <form class="btn btn-link" method="get" action="/identification/signup">
                <input type="hidden">
                <button type="submit" class="btn btn-link">Registration</button>
            </form>

            <!-- Forgot Password Link -->
            <form class="btn btn-link" method="get" action="/identification/recover_password">
                <input type="hidden">
                <button type="submit" class="btn btn-link">Forgot password?</button>
            </form>
        </div>

    </div>

</main>

</body>

<?php $view->component('end'); ?>
