<?php

namespace App\Entity;

use App\Repository\EditorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditorRepository::class)]
class Editor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $country;

    #[ORM\OneToMany(mappedBy: 'editor', targetEntity: Comic::class)]
    private $comic;

    public function __construct()
    {
        $this->comic = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Comic[]
     */
    public function getComic(): Collection
    {
        return $this->comic;
    }

    public function addComic(Comic $comic): self
    {
        if (!$this->comic->contains($comic)) {
            $this->comic[] = $comic;
            $comic->setEditor($this);
        }

        return $this;
    }

    public function removeComic(Comic $comic): self
    {
        if ($this->comic->removeElement($comic)) {
            // set the owning side to null (unless already changed)
            if ($comic->getEditor() === $this) {
                $comic->setEditor(null);
            }
        }

        return $this;
    }
}
