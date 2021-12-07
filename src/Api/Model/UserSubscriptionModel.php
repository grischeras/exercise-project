<?php declare(strict_types=1);

namespace App\Api\Model;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class UserSubscriptionModel
{
    /**
     * @var string
     * @Groups({"write_user_insert_activities","write_user_delete_activities","write_user_list_activities"})
     */
    private string $activityName;

    /**
     * @return string
     */
    public function getActivityName(): string
    {
        return $this->activityName;
    }

    /**
     * @param string $activityName
     */
    public function setActivityName(string $activityName): void
    {
        $this->activityName = $activityName;
    }

}