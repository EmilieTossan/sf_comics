<?php

namespace App\Globals;

use App\Repository\WriterRepository;

class Writers
{
    private $writerRepository;

    public function __construct(WriterRepository $writerRepository)
    {
        $this->writerRepository = $writerRepository;
    }

    public function getAll()
    {
        $gwriters = $this->writerRepository->findAll();

        return $gwriters;
    }
}