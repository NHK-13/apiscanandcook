<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RecetteRepository")
 */
class Recette
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $titreRecette;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slugRecette;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionRecette;

    /**
     * @ORM\Column(type="text")
     */
    private $ingredientsRecette;

    /**
     * @ORM\Column(type="text")
     */
    private $intructionRecette;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbDePersonne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeRecette", inversedBy="recette")
     */
    private $typeRecette;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TimeRecette", inversedBy="recette")
     */
    private $timeRecette;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $timeCuisson;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Region", inversedBy="recette")
     */
    private $regions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AllergeneRecette", inversedBy="recette")
     */
    private $allergeneRecettes;

    public function __construct()
    {
        $this->regions = new ArrayCollection();
        $this->allergeneRecettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreRecette(): ?string
    {
        return $this->titreRecette;
    }

    public function setTitreRecette(string $titreRecette): self
    {
        $this->titreRecette = $titreRecette;

        return $this;
    }

    public function getSlugRecette(): ?string
    {
        return $this->slugRecette;
    }

    public function setSlugRecette(string $slugRecette): self
    {
        $this->slugRecette = $slugRecette;

        return $this;
    }

    public function getDescriptionRecette(): ?string
    {
        return $this->descriptionRecette;
    }

    public function setDescriptionRecette(string $descriptionRecette): self
    {
        $this->descriptionRecette = $descriptionRecette;

        return $this;
    }

    public function getIngredientsRecette(): ?string
    {
        return $this->ingredientsRecette;
    }

    public function setIngredientsRecette(string $ingredientsRecette): self
    {
        $this->ingredientsRecette = $ingredientsRecette;

        return $this;
    }

    public function getIntructionRecette(): ?string
    {
        return $this->intructionRecette;
    }

    public function setIntructionRecette(string $intructionRecette): self
    {
        $this->intructionRecette = $intructionRecette;

        return $this;
    }

    public function getNbDePersonne(): ?int
    {
        return $this->nbDePersonne;
    }

    public function setNbDePersonne(int $nbDePersonne): self
    {
        $this->nbDePersonne = $nbDePersonne;

        return $this;
    }

    public function getTypeRecette(): ?TypeRecette
    {
        return $this->typeRecette;
    }

    public function setTypeRecette(?TypeRecette $typeRecette): self
    {
        $this->typeRecette = $typeRecette;

        return $this;
    }

    public function getTimeRecette(): ?TimeRecette
    {
        return $this->timeRecette;
    }

    public function setTimeRecette(?TimeRecette $timeRecette): self
    {
        $this->timeRecette = $timeRecette;

        return $this;
    }

    public function getTimeCuisson(): ?string
    {
        return $this->timeCuisson;
    }

    public function setTimeCuisson(string $timeCuisson): self
    {
        $this->timeCuisson = $timeCuisson;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|Region[]
     */
    public function getRegions(): Collection
    {
        return $this->regions;
    }

    public function addRegion(Region $region): self
    {
        if (!$this->regions->contains($region)) {
            $this->regions[] = $region;
            $region->addRecette($this);
        }

        return $this;
    }

    public function removeRegion(Region $region): self
    {
        if ($this->regions->contains($region)) {
            $this->regions->removeElement($region);
            $region->removeRecette($this);
        }

        return $this;
    }

    /**
     * @return Collection|AllergeneRecette[]
     */
    public function getAllergeneRecettes(): Collection
    {
        return $this->allergeneRecettes;
    }

    public function addAllergeneRecette(AllergeneRecette $allergeneRecette): self
    {
        if (!$this->allergeneRecettes->contains($allergeneRecette)) {
            $this->allergeneRecettes[] = $allergeneRecette;
            $allergeneRecette->addRecette($this);
        }

        return $this;
    }

    public function removeAllergeneRecette(AllergeneRecette $allergeneRecette): self
    {
        if ($this->allergeneRecettes->contains($allergeneRecette)) {
            $this->allergeneRecettes->removeElement($allergeneRecette);
            $allergeneRecette->removeRecette($this);
        }

        return $this;
    }
    public function __toString()
    {
       return $this->titreRecette;
    }
}
