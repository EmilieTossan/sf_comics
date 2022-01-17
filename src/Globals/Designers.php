<?php

namespace App\Globals;

use App\Repository\DesignerRepository;

class Designers
{
    private $designerRepository;

    public function __construct(DesignerRepository $designerRepository)
    {
        $this->designerRepository = $designerRepository;
    }

    public function getAll()
    {
        $gdesigners = $this->designerRepository->findAll();

        return $gdesigners;
    }
}