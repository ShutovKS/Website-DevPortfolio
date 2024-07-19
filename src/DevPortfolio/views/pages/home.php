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

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis text-center">
                    <h1 class="display-4 fst-italic fw-bold text-black-50">dev.Blog</h1>
                    <p class="lead my-3 full-width">This is a place where developers can share their ideas,
                        thoughts, and experiences.</p>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

        <div class="row">
            <!-- Image -->
        </div>
    </div>

    <div class="bg-body-secondary">
        <div class="container">
            <div class="position-sticky text-center" style="top: 2rem;">
                <div class="p-4 mb-3 rounded">
                    <h3 class="fst-italic text-body-emphasis mb-4">Who is dev.Blog for?</h3>
                    <p class="mb-0 h5">This blog is for developers who want to share their ideas, thoughts, and
                        experiences.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="position-sticky" style="top: 2rem;">
            <div class="p-4 mb-3 rounded">
                <h3 class="fw-medium text-body-emphasis text-center mb-4">How it works?</h3>

                <div class="container row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">
                        <img class="img-fluid"
                             src="https://reaction.ru/userfls/upload/eb1ab7143dc457f7fcc4b6a527f7bdaa.png"
                             alt="registration img">
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <p class="mb-0 h5 mb-2 fw-medium text-info">Step 1</p>
                        <p class="mb-0 h6 mb-2 fw-bold">Customize your page</p>
                        <p class="mb-0 text-secondary mb-2">Register and set up your page on dev.Blog. Think about
                            your future content. Think about what you can really tell and what your fans will be
                            happy about. Keep it simple!</p>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="col-lg-3 text-center" style="height:40px;width:auto"></div>

                <div class="container row">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                        <p class="mb-0 h5 mb-2 fw-medium text-info">Step 2</p>
                        <p class="mb-0 h6 mb-2 fw-bold">Tell your subscribers that you are now on dev.Blog</p>
                        <p class="mb-0 text-secondary mb-2">Make posts on all your main social networks to notify
                            all your followers. dev.Blog is a place where special posts from the IT field and those
                            who want something more than just following you on social networks will be born.</p>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <img class="img-fluid"
                             src="https://gas-kvas.com/grafic/uploads/posts/2024-01/gas-kvas-com-p-chernie-znachki-na-prozrachnom-fone-24.png"
                             alt="registration img">
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <div class="col-lg-3 text-center" style="height:40px;width:auto"></div>

                <div class="container row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">
                        <img class="img-fluid"
                             src="https://i7.uihere.com/icons/469/976/1014/three-hundred-and-thirty-seven-870ff71d3cb4527876477f2e90e28829.png"
                             alt="registration img">
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <p class="mb-0 h5 mb-2 fw-medium text-info">Step 3</p>
                        <p class="mb-0 h6 mb-2 fw-bold">Be active</p>
                        <p class="mb-0 text-secondary mb-2">Share new posts regularly. The goal is for readers to stay
                            with you for a long time and their number to grow steadily. Also, keep the momentum going by
                            periodically posting reminders on social media about your dev.Blog to encourage more fans to
                            subscribe.</p>
                    </div>
                    <div class="col-md-2"></div>
                </div>

            </div>
        </div>
    </div>

    <div class="bg-body-secondary">
        <div class="container text-center">
            <div class="p-3 rounded">
                <h3 class="fst-italic text-body-emphasis">Random articles</h3>
            </div>
        </div>
    </div>

    <div class="album py-5 bg-body-tertiary">

        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                <?php foreach ($articles as $article): ?>

                    <div class="col">
                        <div class="card shadow-sm">
                            <!-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225"-->
                            <!--      xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"-->
                            <!--      preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>-->
                            <!--     <rect width="100%" height="100%" fill="#55595c"></rect>-->
                            <!--     <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>-->
                            <!-- </svg>-->
                            <div class="card-header">
                                <h6 class="form-control-plaintext"><?php echo $article->title; ?></h6>
                            </div>
                            <div class="card-body overflow-scroll">
                                <p class="card-text"><?php echo $article->description ?></p>
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
