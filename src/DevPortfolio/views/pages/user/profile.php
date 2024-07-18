<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;
use App\Models\User;

?>

<?php /** @var User $user */
$user = $data['user']; ?>

<?php $socials = [
    'website' => $user->socialWebsite,
    'github' => $user->socialGithub,
    'vk' => $user->socialVk,
    'telegram' => $user->socialTelegram,
]; ?>

<?php $socialsSample = $data['socialsInProfile'] ?>

<?php $view->component('start', [], $title); ?>

<?php $view->component('header_authorized'); ?>

<div class="container">
    <div class="main-body">

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

                        <?php foreach ($socials as $key => $social_link): ?>
                            <?php if (!isset($socialsSample[$key])) {
                                continue;
                            } ?>

                            <?php $socialSample = $socialsSample[$key]; ?>

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

                <div class="container row text-center">

                    <div class="col-sm-10"></div>

                    <form class="col-sm-2" method="get" name="buttons-form" action="/article/created">
                        <input type="submit" class="btn btn-outline-primary" value="Created post">
                    </form>

                </div>

            </div>
        </div>

    </div>

</div>

<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
