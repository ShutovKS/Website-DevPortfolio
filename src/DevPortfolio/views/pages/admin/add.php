<?php
/**
 * @var View $view
 */

use App\Kernel\View\View;

?>

<?php $view->component('start'); ?>

    <h1>Add page</h1>

    <form action="" method="post">
        <label>
            <input type="text" name="title" placeholder="Title">
        </label>
        <label>
            <textarea name="content" placeholder="Content"></textarea>
        </label>
        <button type="submit">Add</button>
    </form>
<?php $view->component('end'); ?>