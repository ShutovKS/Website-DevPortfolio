<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;
use App\Models\User;

?>


<?php $view->component('start', ['title' => $title]); ?>

<?php $view->component('header', $data); ?>

<?php

/** @var User[] $users */
$users = $data['users'];

?>

<main class="d-flex flex-nowrap">
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
        <a href="/admin/" class="mb-md-0 text-decoration-none text-center">
            <span class="fs-4">Admin panel</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="/admin/home" class="nav-link link-body-emphasis" aria-current="page"> Home </a>
            </li>
            <li>
                <a href="/admin/dashboard" class="nav-link link-body-emphasis"> Dashboard </a>
            </li>
        </ul>
        <hr>
    </div>

    <div class="w-100">
        <h1 class="text-center">List of users</h1>
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr class="d-flex table-secondary">
                <th class="col-1 text-center" scope="col">ID</th>
                <th class="col-2 text-center" scope="col">Username</th>
                <th class="col-2 text-center" scope="col">Full name</th>
                <th class="col-1 text-center" scope="col">Job</th>
                <th class="col-2 text-center" scope="col">Email</th>
                <th class="col-1 text-center" scope="col">Phone</th>
                <th class="col-1 text-center" scope="col">Created at</th>
                <th class="col-1 text-center" scope="col">Is admin</th>
                <th class="col-1 text-center" scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr class="d-flex">
                    <th class="col-1 text-center" scope="row"><?= $user->id ?></th>
                    <td class="col-2 text-center"><?= $user->username ?></td>
                    <td class="col-2 text-center"><?= $user->fullName ?></td>
                    <td class="col-1 text-center"><?= $user->job ?></td>
                    <td class="col-2 text-center"><?= $user->email ?></td>
                    <td class="col-1 text-center"><?= $user->phone ?></td>
                    <td class="col-1 text-center"><?= $user->createdAt ?></td>
                    <td class="col-1 text-center"><?= $user->isAdmin ? 'Yes' : 'No' ?></td>
                    <td class="col-1 text-center btn-group-sm">
                        <a href="/user/<?= $user->id ?>" class="w-100 btn btn-primary">View</a>
                        <a href="/user/settings/<?= $user->id ?>" class="w-100 btn btn-warning">Edit</a>
                        <a href="/user/delete/<?= $user->id ?>" class="w-100 btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</main>
<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
