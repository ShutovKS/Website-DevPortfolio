<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;

?>

<?php $view->component('start'); ?>

<?php if (isset($data['errors'])): ?>
    <div class="error">
        <?php foreach ($data['errors'] as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" action="" name="signup-form">
    <div class="form-element">
        <label>Username<input type="text" name="username" pattern="[a-zA-Z0-9]+" required/></label>
    </div>
    <div class="form-element">
        <label>Email<input type="email" name="email" required/></label>
    </div>
    <div class="form-element">
        <label>Password <input type="password" name="password" required/></label>
    </div>
    <button type="submit" name="register" value="register">Register</button>
</form>

<?php $view->component('end'); ?>
