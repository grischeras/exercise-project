<?php declare(strict_types=1);

namespace App\Api\Controller;

use App\Api\Model\ActivityModel;
use App\Entity\Activities;
use App\Entity\ActivitiesType;
use App\Service\ActivityService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

class UserSubscriptionDeleteController extends AbstractApiController
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

    public function __invoke(
        array $data,
        Request $request
    )
    {
        try{
            $user = $this->getUser();
            $activity = $this->activityService->getSingleActivityTypeByName($request->get("activityName"));
            if($activity instanceof Exception){
                $this->arResult[] = [
                    "actvityName" => $request->get("activityName"),
                    "outcome" => false,
                    "errorMessage" => $activity->getMessage()
                ];
            }
            if(empty($activity)){
                $this->arResult[] = [
                    "actvityName" => $request->get("activityName"),
                    "outcome" => false,
                    "errorMessage" => "Not found"
                ];
            }
            if($activity instanceof ActivitiesType){
                $subscription = $this->activityService->getUserSubscriptionByActivity($user,$activity);
                if(!$subscription instanceof Activities){
                    $this->arResult[] = [
                        "actvityName" => $request->get("activityName"),
                        "outcome" => false,
                        "errorMessage" => "You are not subscribed"
                    ];
                }else{
                    $this->activityService->removeUserSubscription($subscription);
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