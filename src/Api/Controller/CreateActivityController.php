<?php declare(strict_types=1);

namespace App\Api\Controller;

use App\Api\Model\ActivitiesTypeModel;
use App\Api\Model\ActivityModel;
use App\Entity\ActivitiesType;
use App\Service\ActivityService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Throwable;

class CreateActivityController extends AbstractApiController
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
     * CreateActivityController constructor.
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
        ActivityModel $data
    )
    {
        try{
            $acitvity = $data->getNewActivity();
            /**
             * @var ActivitiesTypeModel $singleActivity
             */
            $activityType = $this->activityService->getSingleActivityTypeByName($acitvity->getName());
            if(!$activityType instanceof ActivitiesType){
                $activityType = new ActivitiesType();
                $activityType->setName($acitvity->getName());
                $activityType->setPlacesAvailable($acitvity->getPlacesAvailable());
                $activityType->setDthStart($acitvity->getDthStart());
                $activityType->setDthEnd($acitvity->getDthEnd());
                $activityType->setPlace($acitvity->getPlace());
                $this->em->persist($activityType);
                $this->em->flush();

                $this->arResult[] = [
                    "actvityName" => $activityType->getName(),
                    "outcome" => true
                ];
            }else{
                $this->arResult[] = [
                    "actvityName" => $activityType->getName(),
                    "outcome" => true,
                    "errorMessage" => $activityType->getName().' already exist'
                ];
            }

        }catch(Throwable $exception){
            $this->arResult[] = [
                "actvityName" => "Not available",
                "outcome" => false,
                "errorMessage" => $exception->getMessage()
            ];
        }
        return $this->arResult;
    }
}