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

class UserSubscriptionListController extends AbstractApiController
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
            if(empty($activity)){
                $this->arResult[] = [
                    "actvityName" => $request->get("activityName"),
                    "outcome" => false,
                    "errorMessage" => "Not found"
                ];
            }
            if($activity instanceof ActivitiesType){
                $subscriptions = $this->activityService->getAllUserSubscribedActivity($user,$activity);
                foreach ($subscriptions as $singleSubscription){
                    /**
                     * @var Activities $singleSubscription
                     */
                    $this->arResult["availableActivities"][] = [
                        "name"      => $singleSubscription->getAcitvityType()->getName(),
                        "place"     => $singleSubscription->getAcitvityType()->getPlace(),
                        "dthStart"  => $singleSubscription->getAcitvityType()->getDthStart(),
                        "dthEnd"    => $singleSubscription->getAcitvityType()->getDthEnd()
                    ];
                }//ENDFOREACH $subscriptions
            }
        }catch(Throwable $exception){
            $this->arResult[""] = [
                "actvityName" => "",
                "outcome" => false,
                "errorMessage" => $exception->getMessage()
            ];
        }

        return $this->arResult;
    }
}