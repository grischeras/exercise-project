<?php declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivitiesTypeRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class ActivitiesType
{
    use CommonEntityTrait;
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Activities",mappedBy="acitvityType",cascade={"all"},orphanRemoval=true)
     */
    private Collection $activities;
    /**
     * @var string
     * @ORM\Column(type="string",nullable=false)
     */
    private string $name;
    /**
     * @var string
     * @ORM\Column(type="string",nullable=false)
     */
    private string $place;
    /**
     * @var DateTime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private DateTime $dthStart;
    /**
     * @var DateTime
     * @ORM\Column(type="datetime",nullable=false)
     */
    private DateTime $dthEnd;
    /**
     * @var int
     * @ORM\Column(type="integer",nullable=false)
     */
    private int $placesAvailable;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
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

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getDthStart(): ?\DateTimeInterface
    {
        return $this->dthStart;
    }

    public function setDthStart(\DateTimeInterface $dthStart): self
    {
        $this->dthStart = $dthStart;

        return $this;
    }

    public function getDthEnd(): ?\DateTimeInterface
    {
        return $this->dthEnd;
    }

    public function setDthEnd(\DateTimeInterface $dthEnd): self
    {
        $this->dthEnd = $dthEnd;

        return $this;
    }

    public function getPlacesAvailable(): ?int
    {
        return $this->placesAvailable;
    }

    public function setPlacesAvailable(int $placesAvailable): self
    {
        $this->placesAvailable = $placesAvailable;

        return $this;
    }

    /**
     * @return Collection|Activities[]
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activities $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->setAcitvityType($this);
        }

        return $this;
    }

    public function removeActivity(Activities $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            // set the owning side to null (unless already changed)
            if ($activity->getAcitvityType() === $this) {
                $activity->setAcitvityType(null);
            }
        }

        return $this;
    }
}