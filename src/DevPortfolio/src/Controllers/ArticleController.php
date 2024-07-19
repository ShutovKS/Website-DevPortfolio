<?php

namespace App\Controllers;

use App\Models\Articles;

class ArticleController extends AbstractController
{
    public function openCreated(): void
    {
        $this->view(
            '/article/article_created',
            $this->getData(),
            'Article created');
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
        $data = $this->getData();

        /** @var Articles $article */
        $article = Articles::find($id);
        $data['article'] = $article;

        $this->view(
            '/article/reading_article',
            $data,
            'Article');
    }

    private function getData(): array
    {
        $errors = $this->session()->get('errors');
        $this->session()->remove('errors');

        $isAuth = $this->identification()->isAuth();
        $link_to_photo = null;

        if ($isAuth === true) {
            $link_to_photo = $this->identification()->getUser()->linkToPhoto;
        }

        return [
            'errors' => $errors,
            'isAuth' => $isAuth,
            'link_to_photo' => $link_to_photo,
        ];
    }
}