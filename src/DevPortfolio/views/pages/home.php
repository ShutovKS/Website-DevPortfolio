<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;
use App\Models\Articles;

?>

<?php $view->component('start', ['title' => $title]); ?>

<?php if ($data['isAuth'] === false): ?>
    <?php $view->component('header_unauthorized'); ?>
<?php else: ?>
    <?php $view->component('header_authorized', $data); ?>
<?php endif; ?>

<?php
/** @var Articles[] $articles */
$articles = $data['articles'];
?>

<main>

    <div class="container">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
            <div class="col-lg-6 px-0">
                <h1 class="display-4 fst-italic">dev.Blog</h1>
                <p class="lead my-3">This is a place where developers can share their ideas, thoughts, and
                    experiences.</p>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="p-4 mb-3 bg-body-secondary rounded">
                        <h4 class="fst-italic text-body-emphasis">Who is dev.Blog for?</h4>
                        <p class="mb-0">This blog is for developers who want to share their ideas, thoughts, and
                            experiences.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="album py-5 bg-body-tertiary">

        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                <?php foreach ($articles as $article): ?>

                    <div class="col">
                        <div class="card shadow-sm">
                            <!--                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"-->
                            <!--                             xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"-->
                            <!--                             preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>-->
                            <!--                            <rect width="100%" height="100%" fill="#55595c"></rect>-->
                            <!--                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>-->
                            <!--                        </svg>-->
                            <div class="card-header">
                                <h6 class="form-control-plaintext"><?php echo $article->title; ?></h6>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?php echo $article->content ?></p>
                                <form method="get" action="/article/<?php echo $article->id ?>" name="form-article" class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">View</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>


<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
