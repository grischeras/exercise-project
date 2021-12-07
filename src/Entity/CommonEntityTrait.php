<?php declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait CommonEntityTrait
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;
    /**
     * @var DateTime
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected DateTime $createDth;
    /**
     * @var DateTime
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected DateTime $updateDth;
    /**
     * @var DateTime
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected DateTime $deleteDth;
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getCreateDth(): DateTime
    {
        return $this->createDth;
    }

    /**
     * @param DateTime $createDth
     */
    public function setCreateDth(DateTime $createDth): object
    {
        $this->createDth = $createDth;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdateDth(): DateTime
    {
        return $this->updateDth;
    }

    /**
     * @param DateTime $updateDth
     */
    public function setUpdateDth(DateTime $updateDth): object
    {
        $this->updateDth = $updateDth;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDeleteDth(): DateTime
    {
        return $this->deleteDth;
    }

    /**
     * @param DateTime $deleteDth
     */
    public function setDeleteDth(DateTime $deleteDth): object
    {
        $this->deleteDth = $deleteDth;
        return $this;
    }

}