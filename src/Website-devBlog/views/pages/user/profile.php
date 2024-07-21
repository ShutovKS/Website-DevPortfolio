<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;
use App\Models\Articles;
use App\Models\User;

/** @var User $user */
$user = $data['user'];

/** @var Articles[] $articles */
$articles = $data['articles'];

$socialsSample = $data['socials_in_profile'];

$this_is_current_user = $data['this_is_current_user'];
$current_user_is_auth = $data['current_user_is_auth'];
$current_user_is_admin = $data['current_user_is_admin'];
$link_to_photo_current_user = $data['link_to_photo_current_user'];

$errors = $data['errors'];

$socials = [
    'website' => $user->socialWebsite,
    'github' => $user->socialGithub,
    'vk' => $user->socialVk,
    'telegram' => $user->socialTelegram,
];

$view->component('start', ['title' => $title]);
$view->component('header', $data);

?>

<main class="container">

    <div class="row gutters-sm">

        <div class="col-md-4 mb-3">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo $user->linkToPhoto; ?>" alt="Admin" class="rounded-circle" width="150">

                        <div class="mt-3">
                            <h4><?php echo $user->fullName; ?></h4>
                            <p class="text-secondary mb-1"><?php echo $user->job; ?></p>
                            <p class="text-muted font-size-sm">
                                <?php echo $user->locationCity; ?>, <?php echo $user->locationCountry; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">

                <h5 class="card-header">Socials</h5>

                <div class="list-group list-group-flush">

                    <?php
                    foreach ($socials as $key => $social_link):
                        if (!isset($socialsSample[$key])) {
                            continue;
                        }

                        $socialSample = $socialsSample[$key];

                        ?>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-auto form-control-color text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="<?php echo $socialSample['viewBox']; ?>"
                                         fill="<?php echo $socialSample['svg_fill'] ?>"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round">

                                        <?php
                                        if (isset($socialSample['svg_elements'])):
                                            foreach ($socialSample['svg_elements'] as $svg_element):
                                                echo $svg_element;
                                            endforeach;
                                        endif;
                                        ?>

                                        <path d="<?php echo $socialSample['svg_path']; ?>"></path>
                                    </svg>
                                </div>

                                <div class="col-md-3">
                                    <h6 class="form-control-plaintext"><?php echo $socialSample['name']; ?></h6>
                                </div>

                                <div class="col-md-auto">
                                    <label for="city-name">
                                        <input type="text" class="form-control-plaintext" id="city-name"
                                               placeholder="City" autocomplete="on" readonly=""
                                               value="<?php echo $social_link; ?>">
                                    </label>
                                </div>
                            </div>
                        </li>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

        <div class="col-lg-8">

            <?php if ($current_user_is_auth && ($this_is_current_user || $current_user_is_admin)): ?>
                <div class="row text-center mb-2">

                    <div class="col-sm-10"></div>

                    <form class="col-sm-2" method="get" name="buttons-form" action="/article/created">
                        <input type="submit" class="btn btn-outline-primary" value="Created post">
                    </form>

                </div>

            <?php endif; ?>

            <?php if ($articles !== []): ?>

                <div class="container mb-2 bg-body-tertiary">

                    <div class="py-4 bg-body-tertiary">

                        <div class="container">
                            <div class="g-3">

                                <?php foreach ($articles as $article): ?>

                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header">
                                            <h6 class="form-control-plaintext"><?php echo $article->title; ?></h6>
                                        </div>

                                        <div class="card-body overflow-scroll">

                                            <div class="row">

                                                <div class="col-md-5">
                                                    <nobr class="card-text">Latest update:</nobr>
                                                    <nobr class="card-text text-info"><?php echo $article->updatedAt; ?></nobr>
                                                </div>

                                                <div class="col-md-4"></div>

                                                <div class="col-md-3 d-flex justify-content-between align-items-center">

                                                    <div class="btn-group">
                                                        <form method="get"
                                                              action="/article/view/<?php echo $article->id ?>"
                                                              name="form-article" class="btn-group">
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-secondary">
                                                                View
                                                            </button>
                                                        </form>


                                                        <?php if ($current_user_is_auth && ($this_is_current_user || $current_user_is_admin)): ?>

                                                        <form method="get" action="/article/edit/<?php echo $article->id ?>"
                                                              name="form-article" class="btn-group">
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-primary">Edit
                                                            </button>
                                                        </form>

                                                        <form method="get" action="/article/delete/<?php echo $article->id ?>"
                                                              name="form-article" class="btn-group">
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger">Delete
                                                            </button>
                                                        </form>

                                                        <?php endif; ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else: ?>
            
                <div class="container mb-2 bg-body-tertiary">

                    <div class="p-3 rounded text-center">
                        <h3 class="fst-italic text-body-emphasis">No articles</h3>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>
</main>
<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
