<?php declare(strict_types=1);

namespace App\Api\Model;

use DateTime;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class ActivitiesTypeModel
{
    /**
     * @var string
     * @Groups({"read_list_activities","write_create_activities","read_update_activities","write_update_activities","read_user_list_activities"})
     */
    private string $name;
    /**
     * @var string
     * @Groups({"read_list_activities","write_create_activities","read_update_activities","write_update_activities","read_user_list_activities"})
     */
    private string $place;
    /**
     * @var DateTime
     * @Groups({"read_list_activities","write_create_activities","read_update_activities","write_update_activities","read_user_list_activities"})
     */
    private DateTime $dthStart;
    /**
     * @var DateTime
     * @Groups({"read_list_activities","write_create_activities","read_update_activities","write_update_activities","read_user_list_activities"})
     */
    private DateTime $dthEnd;
    /**
     * @var int
     * @Groups({"read_list_activities","write_create_activities","read_update_activities","write_update_activities"})
     */
    private int $placesAvailable;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPlace(): string
    {
        return $this->place;
    }

    /**
     * @param string $place
     */
    public function setPlace(string $place): void
    {
        $this->place = $place;
    }

    /**
     * @return DateTime
     */
    public function getDthStart(): DateTime
    {
        return $this->dthStart;
    }

    /**
     * @param DateTime $dthStart
     */
    public function setDthStart(DateTime $dthStart): void
    {
        $this->dthStart = $dthStart;
    }

    /**
     * @return DateTime
     */
    public function getDthEnd(): DateTime
    {
        return $this->dthEnd;
    }

    /**
     * @param DateTime $dthEnd
     */
    public function setDthEnd(DateTime $dthEnd): void
    {
        $this->dthEnd = $dthEnd;
    }

    /**
     * @return int
     */
    public function getPlacesAvailable(): int
    {
        return $this->placesAvailable;
    }

    /**
     * @param int $placesAvailable
     */
    public function setPlacesAvailable(int $placesAvailable): void
    {
        $this->placesAvailable = $placesAvailable;
    }
}