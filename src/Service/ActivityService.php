<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Activities;
use App\Entity\ActivitiesType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Throwable;
use DateTime;
class ActivityService
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * ActivityService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @param string $name
     * @return object|null
     * @throws Throwable
     */
    public function getSingleActivityTypeByName(string $name)
    {
        try{
            $repo = $this->em->getRepository(ActivitiesType::class);
            return $repo->findOneBy(["name" => $name]);
        }catch(Throwable $exception){
            throw $exception;
        }
    }


    /**
     * @param string|null $name
     * @param string|null $dateFrom
     * @param string|null $dateTo
     * @return mixed
     * @throws Throwable
     */
    public function getAllActivitiesByNameDates(
        ?string $name,
        ?string $dateFrom,
        ?string $dateTo
    )
    {
        try{
            $repo = $this->em->getRepository(ActivitiesType::class);
            if(!is_null($dateFrom)){
                $dateFrom = DateTime::createFromFormat("Y-m-d",$dateFrom);
                $dateFrom->setTime(0,0,0);
            }
            if(!is_null($dateTo)){
                $dateTo = DateTime::createFromFormat("Y-m-d",$dateTo);
                $dateTo->setTime(23,59,59);
            }
            return $repo->findAllActivitiesByNameDates($name,$dateFrom,$dateTo);
        }catch(Throwable $exception){
            throw $exception;
        }
    }


    /**
     * @param ActivitiesType $activitiesType
     * @param bool $flush
     * @throws Throwable
     */
    public function remove(
        ActivitiesType $activitiesType,
        bool $flush = true
    )
    {
        try{
            $this->em->remove($activitiesType);
            if($flush){
                $this->em->flush();
            }
        }catch(Throwable $exception){
            throw $exception;
        }

    }

    /**
     * @param User $user
     * @param ActivitiesType $activitiesType
     * @return object|null
     * @throws Throwable
     */
    public function getUserSubscriptionByActivity(
        User $user,
        ActivitiesType $activitiesType
    )
    {
        try{
            $repo = $this->em->getRepository(Activities::class);
            return $repo->findOneBy(["user" => $user,"acitvityType" => $activitiesType]);
        }catch(Throwable $exception){
            throw $exception;
        }
    }

    /**
     * @param Activities $activity
     * @param bool $flush
     * @throws Throwable
     */
    public function removeUserSubscription(
        Activities $activity,
        bool $flush = true
    )
    {
        try{
            $this->em->remove($activity);
            if($flush){
                $this->em->flush();
            }
        }catch(Throwable $exception){
            throw $exception;
        }
    }

    /**
     * @param User $user
     * @param ActivitiesType $activitiesType
     * @return object[]
     * @throws Throwable
     */
    public function getAllUserSubscribedActivity(
        User $user,
        ActivitiesType $activitiesType
    )
    {
        try{
            $repo = $this->em->getRepository(Activities::class);
            return $repo->findBy(["user" => $user,"acitvityType" => $activitiesType]);
        }catch(Throwable $exception){
            throw $exception;
        }
    }
}