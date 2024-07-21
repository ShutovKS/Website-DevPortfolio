<?php

namespace App\Controllers;

use App\Models\Articles;

class HomeController extends AbstractController
{
    public function index(): void
    {
        $data = $this->getData();

        $data['articles'] = Articles::getRandom(9);

        foreach ($data['articles'] as $article) {
            /** @var Articles $article */
            if (empty($article->description)) {
                $article->description = $this->getDescription($article->content);
            }
        }

        $this->view('home', $data, 'Home');
    }

    public function about(): void
    {
        $this->view('/other/about', $this->getData(), 'About');
    }

    private function getDescription(string $text): string
    {
        $text = substr($text, 0, 250);
        $text .= '...';

        return $text;
    }
}