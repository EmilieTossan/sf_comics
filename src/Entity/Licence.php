<?php

namespace App\Entity;

use App\Repository\LicenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LicenceRepository::class)]
class Licence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $media;

    #[ORM\OneToMany(mappedBy: 'licence', targetEntity: Comic::class)]
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(string $media): self
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @return Collection|Comic[]
     */
    public function getComics(): Collection
    {
        return $this->comic;
    }

    public function addComic(Comic $comic): self
    {
        if (!$this->comic->contains($comic)) {
            $this->comic[] = $comic;
            $comic->setLicence($this);
        }

        return $this;
    }

    public function removeComic(Comic $comic): self
    {
        if ($this->comic->removeElement($comic)) {
            // set the owning side to null (unless already changed)
            if ($comic->getLicence() === $this) {
                $comic->setLicence(null);
            }
        }

        return $this;
    }
}
