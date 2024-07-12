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
        $data = [
            'title' => $this->request()->input('title'),
            'content' => $this->request()->input('content'),
        ];

        $rules = [
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:3',
        ];

        $errors = $this->validator()->validate($data, $rules);
    }
}