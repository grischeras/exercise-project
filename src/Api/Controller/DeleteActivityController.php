<?php declare(strict_types=1);

namespace App\Api\Controller;

use App\Entity\ActivitiesType;
use App\Service\ActivityService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

class DeleteActivityController extends AbstractApiController
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
     * DeleteActivityController constructor.
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
            $activityName = $request->get("activityName");
            $activity = $this->activityService->getSingleActivityTypeByName($activityName);
            if($activity instanceof ActivitiesType){
                $activity = $this->activityService->remove($activity);
                $this->arResult[] = [
                    "error" => $activity->getMessage()
                ];
            }
        }catch(Throwable $exception){
            $this->arResult[] = [
                "error" => $exception->getMessage()
            ];
        }
        if(!empty($this->arResult)){
            return $this->arResult;
        }
    }
}