<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class AdminController extends Controller
{
    public function index(): void
    {
        $this->view('admin/index');
    }

    public function add(): void
    {
        $this->view('admin/add');
    }

    public function print(): void
    {
        $this->view('admin/print');
    }
}