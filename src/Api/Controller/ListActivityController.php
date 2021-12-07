<?php declare(strict_types=1);

namespace App\Api\Controller;

use App\Entity\ActivitiesType;
use App\Service\ActivityService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

class ListActivityController extends AbstractApiController
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
     * ListActivityController constructor.
     * @param EntityManagerInterface $em
     * @param ActivityService $activityService
     */
    public function __construct(
        EntityManagerInterface $em,
        ActivityService $activityService
    )
    {
        $this->em               = $em;
        $this->activityService  = $activityService;
    }

    public function __invoke(
        Request $request
    )
    {
        try{
            $activityName   = $request->get("activityName");
            $dateFrom       = $request->get("dateFrom");
            $dateTo         = $request->get("dateTo");
            $activities     = $this->activityService->getAllActivitiesByNameDates($activityName,$dateFrom,$dateTo);
            foreach ($activities as $singleActivity){
                /**
                 * @var ActivitiesType $singleActivity
                 */
                $this->arResult[] = [
                    "name"              => $singleActivity->getName(),
                    "place"             => $singleActivity->getPlace(),
                    "dthStart"          => $singleActivity->getDthStart(),
                    "dthEnd"            => $singleActivity->getDthEnd(),
                    "placesAvailable"   => ($singleActivity->getPlacesAvailable() - count($singleActivity->getActivities()))
                ];
            }//ENDOFREACH $activities
        }catch(Throwable $exception){
            $this->arResult[] = [
                "errorMessage" => $exception->getMessage()
            ];
        }
        if(empty($this->arResult)){
            $this->arResult[] = [
                "No record found"
            ];
        }
        return $this->arResult;
    }
}