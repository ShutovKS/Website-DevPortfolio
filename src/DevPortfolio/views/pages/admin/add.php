<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;

?>

<?php $view->component('start'); ?>

    <h1><?= $title ?></h1>

    <form action="" method="post">
        <label>
            <input type="text" name="title" placeholder="Title">
        </label>
        <label>
            <textarea name="content" placeholder="Content"></textarea>
        </label>
        <button type="submit">Add</button>
    </form>

<?php if (isset($data['errors'])): ?>
    <ul>
        <?php foreach ($data['errors'] as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php dd($data); ?>

<?php $view->component('end'); ?>