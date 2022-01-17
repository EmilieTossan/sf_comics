<?php

namespace App\Globals;

use App\Repository\ComicRepository;

class Comics
{
    private $comicRepository;

    public function __construct(ComicRepository $comicRepository)
    {
        $this->comicRepository = $comicRepository;
    }

    public function getAll()
    {
        $gcomics = $this->comicRepository->findAll();

        return $gcomics;
    }
}