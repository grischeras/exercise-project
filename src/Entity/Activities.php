<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivitiesRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Activities
{
    use CommonEntityTrait;
    /**
     * @var ActivitiesType
     * @ORM\ManyToOne(targetEntity="App\Entity\ActivitiesType",inversedBy="activities")
     */
    private ActivitiesType $acitvityType;
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User",inversedBy="activities")
     */
    private User $user;

    public function getAcitvityType(): ?ActivitiesType
    {
        return $this->acitvityType;
    }

    public function setAcitvityType(?ActivitiesType $acitvityType): self
    {
        $this->acitvityType = $acitvityType;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}