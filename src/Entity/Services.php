<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServicesRepository")
 */
class Services
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Employers", mappedBy="service")
     */
    private $employers;

    public function __construct()
    {
        $this->employers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Employers[]
     */
    public function getEmployers(): Collection
    {
        return $this->employers;
    }

    public function addEmployer(Employers $employer): self
    {
        if (!$this->employers->contains($employer)) {
            $this->employers[] = $employer;
            $employer->setService($this);
        }

        return $this;
    }

    public function removeEmployer(Employers $employer): self
    {
        if ($this->employers->contains($employer)) {
            $this->employers->removeElement($employer);
            // set the owning side to null (unless already changed)
            if ($employer->getService() === $this) {
                $employer->setService(null);
            }
        }

        return $this;
    }
}
