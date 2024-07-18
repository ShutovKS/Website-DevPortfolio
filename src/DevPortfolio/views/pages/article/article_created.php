<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;

?>

<?php $view->component('start', [], $title); ?>

<title><?php echo $title; ?></title>

<?php $view->component('header_authorized'); ?>

<?php

$articleTitle = "";
$articleContent = "";

?>

<body>

<div class="container">

    <div class="card">

        <div class="card-header">
            <h5 class="card-title text-center mt-2">Create Article</h5>
        </div>

        <div class="row">

            <form action="/article/create" method="post">

                <div class="form-group container">

                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="<?php echo $articleTitle; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content" name="content"
                                  rows="3"><?php echo $articleContent; ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <input type="submit" class="btn btn-primary px-5 mb-3" value="Create">
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>

<?php $view->component('footer'); ?>

</body>

<?php $view->component('end'); ?>

