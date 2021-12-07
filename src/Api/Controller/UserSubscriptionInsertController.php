<?php declare(strict_types=1);

namespace App\Api\Controller;

use App\Api\Model\ActivityModel;
use App\Entity\Activities;
use App\Entity\ActivitiesType;
use App\Service\ActivityService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Throwable;

class UserSubscriptionInsertController extends AbstractApiController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;
    /**
     * @var ActivityService
     */
    private ActivityService $activityService;

    /**
     * UserSubscriptionInsertController constructor.
     * @param EntityManagerInterface $em
     * @param ActivityService $activityService
     */
    public function __construct(
        EntityManagerInterface $em,
        ActivityService $activityService
    )
    {
        $this->em = $em;
        $this->activityService = $activityService;
    }

    public function __invoke(ActivityModel $data)
    {
        try{
            $insert = $data->getUserSubscription();
            $user = $this->getUser();
            $activity = $this->activityService->getSingleActivityTypeByName($insert->getActivityName());
            if(empty($activity)){
                $this->arResult[] = [
                    "actvityName" => $insert->getActivityName(),
                    "outcome" => false,
                    "errorMessage" => "Not found"
                ];
            }
            if($activity instanceof ActivitiesType){
                $subscription = $this->activityService->getUserSubscriptionByActivity($user,$activity);
                if(!$subscription instanceof Activities){
                    $subscription = new Activities();
                    $subscription->setAcitvityType($activity);
                    $subscription->setUser($user);
                    $this->em->persist($subscription);
                    $this->em->flush();
                    $this->arResult[] = [
                        "actvityName" => $insert->getActivityName(),
                        "outcome" => true,
                    ];
                }else{
                    $this->arResult[] = [
                        "actvityName" => $insert->getActivityName(),
                        "outcome" => false,
                        "errorMessage" => "You are already subscribed"
                    ];
                }

            }
        }catch(Throwable $exception){
            $this->arResult[] = [
                "actvityName" => "",
                "outcome" => false,
                "errorMessage" => $exception->getMessage()
            ];
        }
        return $this->arResult;
    }
}