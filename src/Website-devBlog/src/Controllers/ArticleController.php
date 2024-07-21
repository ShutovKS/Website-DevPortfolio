<?php

namespace App\Controllers;

use App\Models\Articles;

class ArticleController extends AbstractController
{
    public function openCreated(): void
    {
        $data = $this->getData();

        $this->view('/article/article_created', $data, 'Article created');
    }

    public function create(): void
    {
        $data = [
            'title' => $this->request()->input('title'),
            'description' => $this->request()->input('description'),
            'content' => $this->request()->input('content'),
        ];

        $rules = [
            'title' => 'required|no_scripts|max:140',
            'description' => 'no_scripts|max:140',
            'content' => 'required|min:100',
        ];

        $errors = $this->validator()->validate($data, $rules);

        if (count($errors) > 0) {
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/article/created');
            exit;
        }

        $article = new Articles();

        $article->userId = $this->identification()->getUser()->id;
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->description = $data['description'];
        $article->createdAt = date('Y-m-d H:i:s');
        $article->updatedAt = date('Y-m-d H:i:s');
        $article->published = 1;

        $article->save();

        $this->redirect()->to('../user/profile');
    }

    public function viewArticle($id): void
    {
        /** @var Articles $article */
        $article = Articles::find($id);

        $data = $this->getData(['article' => $article,]);

        $this->view('/article/article_view', $data, 'Article');
    }

    public function editArticle($id): void
    {
        /** @var Articles $article */
        $article = Articles::find($id);

        if (!$this->identification()->isAdmin() && !($this->identification()->getUser()->id === $article->userId)) {
            $this->redirect()->to('/error/404');
            exit();
        }

        $data = $this->getData(['article' => $article,]);

        $this->view('/article/article_edit', $data, 'Edit article');
    }

    public function update($id): void
    {
        /** @var Articles $article */
        $article = Articles::find($id);

        if (!$this->identification()->isAdmin() && !($this->identification()->getUser()->id === $article->userId)) {
            $this->redirect()->to('/error/404');
            exit();
        }

        $title = $this->request()->input('title');
        $description = $this->request()->input('description');
        $content = $this->request()->input('content');

        $data = [
            'title' => $title,
            'description' => $description,
            'content' => $content,
        ];

        $rules = [
            'title' => 'required|no_scripts|max:140',
            'description' => 'no_scripts|max:250',
            'content' => 'required|min:100',
        ];

        $errors = ['update' => $this->validator()->validate($data, $rules),];

        if (count($errors['update']) > 0) {
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/article/edit/' . $id);
            exit;
        }

        /** @var Articles $article */
        $article = Articles::find($id);

        if ($article->userId !== $this->identification()->getUser()->id) {
            $this->redirect()->to('/user/profile');
            exit;
        }

        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->description = $data['description'];
        $article->updatedAt = date('Y-m-d H:i:s');

        $article->save();

        $this->redirect()->to('/article/view/' . $id);
    }

    public function deleteArticle($id): void
    {
        /** @var Articles $article */
        $article = Articles::find($id);

        if (!$this->identification()->isAdmin() && !($this->identification()->getUser()->id === $article->userId)) {
            $this->redirect()->to('/error/404');
            exit();
        }

        $article->delete();

        if ($this->identification()->isAdmin() && $this->identification()->getUser()->id === $article->userId) {
            $this->redirect()->to('/user/' . $this->identification()->getUser()->id);
        }
        else{
            $this->redirect()->to('/admin/list/articles');
        }
    }
}