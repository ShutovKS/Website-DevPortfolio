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

<?php $view->component('start'); ?>

<title><?php echo $title; ?></title>

<body>

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
                        <?php $socialsSample = [
                            'website' =>
                                [
                                    'name' => 'website',
                                    'svg_path' => 'M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z',
                                    'svg_fill' => "none",
                                    'viewBox' => '0 0 24 24',
                                    'svg_elements' => [
                                        '<line x1="2" y1="12" x2="22" y2="12"></line>',
                                        '<circle cx="12" cy="12" r="10"></circle>'
                                    ],
                                ],

                            'github' =>
                                [
                                    'name' => 'github',
                                    'svg_path' => 'M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22',
                                    'svg_fill' => "none",
                                    'viewBox' => '0 0 24 24'
                                ],

                            'vk' =>
                                [
                                    'name' => 'vk',
                                    'svg_path' => 'M27.55,35.19V28.55c4.46.68,5.87,4.19,8.71,6.64H43.5a29.36,29.36,0,0,0-7.9-10.47c2.6-3.58,5.36-6.95,6.71-12.06H35.73c-2.58,3.91-3.94,8.49-8.18,11.51V12.66H18l2.28,2.82,0,10.05c-3.7-.43-6.2-7.2-8.91-12.87H4.5C7,20.32,12.26,37.13,27.55,35.19Z',
                                    'svg_fill' => "none",
                                    'viewBox' => '0 0 48 48'
                                ],

                            'telegram' =>
                                [
                                    'name' => 'telegram',
                                    'svg_path' => 'M152.531,179.476c-1.48,0-2.95-0.438-4.211-1.293l-47.641-32.316l-25.552,18.386c-2.004,1.441-4.587,1.804-6.914,0.972 c-2.324-0.834-4.089-2.759-4.719-5.146l-12.83-48.622L4.821,93.928c-2.886-1.104-4.8-3.865-4.821-6.955 c-0.021-3.09,1.855-5.877,4.727-7.02l174.312-69.36c0.791-0.336,1.628-0.53,2.472-0.582c0.302-0.018,0.605-0.018,0.906-0.001 c1.748,0.104,3.465,0.816,4.805,2.13c0.139,0.136,0.271,0.275,0.396,0.42c1.11,1.268,1.72,2.814,1.835,4.389 c0.028,0.396,0.026,0.797-0.009,1.198c-0.024,0.286-0.065,0.571-0.123,0.854L159.898,173.38c-0.473,2.48-2.161,4.556-4.493,5.523 C154.48,179.287,153.503,179.476,152.531,179.476z M104.862,130.579l42.437,28.785L170.193,39.24l-82.687,79.566l17.156,11.638 C104.731,130.487,104.797,130.533,104.862,130.579z M69.535,124.178l5.682,21.53l12.242-8.809l-16.03-10.874 C70.684,125.521,70.046,124.893,69.535,124.178z M28.136,86.782l31.478,12.035c2.255,0.862,3.957,2.758,4.573,5.092l3.992,15.129 c0.183-1.745,0.974-3.387,2.259-4.624L149.227,38.6L28.136,86.782z',
                                    'svg_fill' => "",
                                    'viewBox' => '0 0 189.473 189.473'
                                ],
                        ]
                        ?>

                        <?php foreach ($socials as $key => $social_link): ?>
                            <?php if (!isset($socialsSample[$key])) {
                                continue;
                            } ?>

                            <?php $socialSample = $socialsSample[$key]; ?>

                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="<?php echo $socialSample['viewBox']; ?>"
                                         fill="<?php echo $socialSample['svg_fill'] ?>"
                                         stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline">

                                        <?php
                                        if (isset($socialSample['svg_elements'])):
                                            foreach ($socialSample['svg_elements'] as $svg_element):
                                                echo $svg_element;
                                            endforeach;
                                        endif;
                                        ?>

                                        <path d="<?php echo $socialSample['svg_path']; ?>"></path>
                                    </svg>
                                    <?php echo $socialSample['name']; ?>
                                </h6>
                                <div>
                                    <input type="text" class="form-control-plaintext" id="city-name" placeholder="City"
                                           autocomplete="on" value="<?php echo $social_link; ?>" readonly="">
                                </div>
                            </li>

                        <?php endforeach; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php $view->component('footer'); ?>

</body>


<?php $view->component('end'); ?>
