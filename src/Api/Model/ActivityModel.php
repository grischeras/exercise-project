<?php declare(strict_types=1);

namespace App\Api\Model;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Api\Filter\CustomFilter;
use App\Api\Controller\CreateActivityController;
use App\Api\Controller\ListActivityController;
use App\Api\Controller\UpdateActivityController;
use App\Api\Controller\DeleteActivityController;
use App\Api\Controller\UserSubscriptionInsertController;
use App\Api\Controller\UserSubscriptionDeleteController;
use App\Api\Controller\UserSubscriptionListController;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "listActivities"={
 *              "method" = "GET",
 *              "path" = "/activities/list",
 *              "controller" = ListActivityController::class,
 *              "security"="is_granted('ROLE_USER')", "security_message"="You are not enabled to access this route.",
 *              "normalization_context"={"groups"="read_list_activities"},
 *              "denormalization_context"={"groups"="write_list_activities"},
 *              "openapi_context" = {
 *                  "summary" = "List available activities",
 *                  "description"="List available activities",
 *              },
 *          },
 *          "createActivity"={
 *              "method" = "PUT",
 *              "path" = "/activities/create",
 *              "controller" = CreateActivityController::class,
 *              "security"="is_granted('ROLE_USER')", "security_message"="You are not enabled to access this route.",
 *              "normalization_context"={"groups"="read_create_activities"},
 *              "denormalization_context"={"groups"="write_create_activities"},
 *              "openapi_context" = {
 *                  "summary" = "Create an activity",
 *                  "description"="Create an activity",
 *              },
 *          },
 *          "updateActivity"={
 *              "method" = "POST",
 *              "path" = "/activities/update",
 *              "controller" = UpdateActivityController::class,
 *              "security"="is_granted('ROLE_USER')", "security_message"="You are not enabled to access this route.",
 *              "normalization_context"={"groups"="read_update_activities"},
 *              "denormalization_context"={"groups"="write_update_activities"},
 *              "openapi_context" = {
 *                  "summary" = "Update an activity",
 *                  "description"="Update an activity",
 *              },
 *          },
 *          "deleteActivity"={
 *              "method" = "DELETE",
 *              "path" = "/activities/delete/activityName={activityName}",
 *              "controller" = DeleteActivityController::class,
 *              "security"="is_granted('ROLE_USER')", "security_message"="You are not enabled to access this route.",
 *              "normalization_context"={"groups"="read_delete_activities"},
 *              "denormalization_context"={"groups"="write_delete_activities"},
 *              "openapi_context" = {
 *                  "summary" = "Delete an activity",
 *                  "description"="Delete an activity",
 *              },
 *          },
 *          "userSubscriptionInsert"={
 *              "method" = "POST",
 *              "path" = "/activities/user/subscription/insert",
 *              "controller" = UserSubscriptionInsertController::class,
 *              "security"="is_granted('ROLE_USER')", "security_message"="You are not enabled to access this route.",
 *              "normalization_context"={"groups"="read_user_insert_activities"},
 *              "denormalization_context"={"groups"="write_user_insert_activities"},
 *              "openapi_context" = {
 *                  "summary" = "Insert a subscription",
 *                  "description"="Insert a subscription",
 *              },
 *          },
 *          "userSubscriptionDelete"={
 *              "method" = "DELETE",
 *              "path" = "/activities/user/subscription/delete/activityName={activityName}",
 *              "controller" = UserSubscriptionDeleteController::class,
 *              "security"="is_granted('ROLE_USER')", "security_message"="You are not enabled to access this route.",
 *              "normalization_context"={"groups"="read_user_delete_activities"},
 *              "denormalization_context"={"groups"="write_user_delete_activities"},
 *              "openapi_context" = {
 *                  "summary" = "Delte a subscription",
 *                  "description"="Delete a subscription",
 *              },
 *          },
 *          "userSubscriptionList"={
 *              "method" = "GET",
 *              "path" = "/activities/user/subscription/list",
 *              "controller" = UserSubscriptionListController::class,
 *              "security"="is_granted('ROLE_USER')", "security_message"="You are not enabled to access this route.",
 *              "normalization_context"={"groups"="read_user_list_activities"},
 *              "denormalization_context"={"groups"="write_user_list_activities"},
 *              "openapi_context" = {
 *                  "summary" = "List user subscription",
 *                  "description"="List user subscription",
 *              },
 *          },
 *     },
 *     itemOperations={},
 *     shortName="Activity"
 * )
 * * @ApiFilter(
 *        CustomFilter::class,
 *        properties={
 *            "activityName",
 *            "dateFrom",
 *            "dateTo",
 *        },
 *        arguments={
 *            "options"={
 *                "activityName"={
 *                    "description"="Activity name to seach",
 *                    "example" = "MY FAVOURITE ACTIVITY",
 *                    "type"="string",
 *                    "maxLength"=25,
 *                },
 *                "dateFrom"={
 *                    "description"="Activity Date From",
 *                    "format"="Y-m-d",
 *                    "example" = "2020-09-06",
 *                    "type"="date",
 *                },
 *                "dateTo"={
 *                    "description"="Activity Date To",
 *                    "format"="Y-m-d",
 *                    "example" = "2020-09-06",
 *                    "type"="date",
 *                },
 *            }
 *        },
 * )
 */
class ActivityModel
{

    /**
     * @var DateTime
     * @ApiProperty(identifier=true)
     */
    private DateTime $date;

    /**
     * @var ActivitiesTypeModel[]
     * @Groups({"read_list_activities","read_user_list_activities"})
     */
    private array $availableActivities;
    /**
     * @var ActivitiesTypeModel
     * @Groups({"write_create_activities"})
     */
    private ActivitiesTypeModel $newActivity;
    /**
     * @var ActivitiesTypeModel
     * @Groups({"write_update_activities"})
     */
    private ActivitiesTypeModel $updateActivity;
    /**
     * @var ActivitiesTypeModel
     * @Groups({"write_delete_activities"})
     */
    private ActivitiesTypeModel $deleteActivity;
    /**
     * @var ResponseModel
     * @Groups({
     *     "read_create_activities",
     *     "read_update_activities",
     *     "read_delete_activities",
     *     "read_user_insert_activities",
     *     })
     */
    private ResponseModel $response;
    /**
     * @var UserSubscriptionModel
     * @Groups({"write_user_insert_activities","write_user_delete_activities","write_user_list_activities"})
     *
     */
    private UserSubscriptionModel $userSubscription;

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return ActivitiesTypeModel[]
     */
    public function getAvailableActivities(): array
    {
        return $this->availableActivities;
    }

    /**
     * @param ActivitiesTypeModel[] $availableActivities
     */
    public function setAvailableActivities(array $availableActivities): void
    {
        $this->availableActivities = $availableActivities;
    }

    /**
     * @return ActivitiesTypeModel
     */
    public function getNewActivity(): ActivitiesTypeModel
    {
        return $this->newActivity;
    }

    /**
     * @param ActivitiesTypeModel $newActivity
     */
    public function setNewActivity(ActivitiesTypeModel $newActivity): void
    {
        $this->newActivity = $newActivity;
    }

    /**
     * @return ActivitiesTypeModel
     */
    public function getUpdateActivity(): ActivitiesTypeModel
    {
        return $this->updateActivity;
    }

    /**
     * @param ActivitiesTypeModel $updateActivity
     */
    public function setUpdateActivity(ActivitiesTypeModel $updateActivity): void
    {
        $this->updateActivity = $updateActivity;
    }

    /**
     * @return ActivitiesTypeModel
     */
    public function getDeleteActivity(): ActivitiesTypeModel
    {
        return $this->deleteActivity;
    }

    /**
     * @param ActivitiesTypeModel $deleteActivity
     */
    public function setDeleteActivity(ActivitiesTypeModel $deleteActivity): void
    {
        $this->deleteActivity = $deleteActivity;
    }

    /**
     * @return ResponseModel
     */
    public function getResponse(): ResponseModel
    {
        return $this->response;
    }

    /**
     * @param ResponseModel $response
     */
    public function setResponse(ResponseModel $response): void
    {
        $this->response = $response;
    }

    /**
     * @return UserSubscriptionModel
     */
    public function getUserSubscription(): UserSubscriptionModel
    {
        return $this->userSubscription;
    }

    /**
     * @param UserSubscriptionModel $userSubscription
     */
    public function setUserSubscription(UserSubscriptionModel $userSubscription): void
    {
        $this->userSubscription = $userSubscription;
    }


}