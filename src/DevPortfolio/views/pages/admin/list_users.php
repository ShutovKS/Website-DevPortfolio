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

    <div class="container">
        <h1 class="text-center">List of users</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <th scope="row"><?= $user->id ?></th>
                    <td><?= $user->username ?></td>
                    <td><?= $user->email ?></td>
                    <td class="btn-group-sm">
                        <a href="/user/<?= $user->id ?>" class="btn btn-primary">View</a>
                        <a href="/user/settings/<?= $user->id ?>" class="btn btn-warning">Edit</a>
                        <a href="/user/delete/<?= $user->id ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</main>
<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
