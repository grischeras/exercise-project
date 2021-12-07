<?php declare(strict_types=1);

namespace App\Api\Model;

use Symfony\Component\Serializer\Annotation\Groups;

class ResponseModel
{
    /**
     * @var string
     * @Groups({"read_create_activities","read_update_activities","read_delete_activities","read_user_insert_activities","read_user_delete_activities","read_user_list_activities"})
     */
    private string $actvityName;
    /**
     * @var bool
     * @Groups({"read_create_activities","read_update_activities","read_delete_activities","read_user_insert_activities","read_user_delete_activities","read_user_list_activities"})
     */
    private bool $outcome;
    /**
     * @var string|null
     * @Groups({"read_create_activities","read_update_activities","read_delete_activities","read_user_insert_activities","read_user_delete_activities","read_user_list_activities"})
     */
    private ?string $errorMessage;

    /**
     * @return string
     */
    public function getActvityName(): string
    {
        return $this->actvityName;
    }

    /**
     * @param string $actvityName
     */
    public function setActvityName(string $actvityName): void
    {
        $this->actvityName = $actvityName;
    }

    /**
     * @return bool
     */
    public function isOutcome(): bool
    {
        return $this->outcome;
    }

    /**
     * @param bool $outcome
     */
    public function setOutcome(bool $outcome): void
    {
        $this->outcome = $outcome;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * @param string|null $errorMessage
     */
    public function setErrorMessage(?string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }

}