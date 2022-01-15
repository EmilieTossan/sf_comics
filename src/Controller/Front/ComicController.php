<?php

namespace App\Controller\Front;

use App\Repository\ComicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ComicController extends AbstractController
{
    /**
     * @Route("comics", name="comic_list")
     */
    public function comicList(ComicRepository $comicRepository)
    {
        $comics = $comicRepository->findAll();

        return $this->render("front/comics.html.twig", ['comics' => $comics]);
    }

    /**
     * @Route("comic/{id}", name="show_comic")
     */
    public function showComic($id, ComicRepository $comicRepository)
    {
        $comic = $comicRepository->find($id);

        return $this->render("front/comic.html.twig", ['comic' => $comic]);
    }
}