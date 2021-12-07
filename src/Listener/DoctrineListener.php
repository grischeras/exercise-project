<?php declare(strict_types=1);

namespace App\Listener;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\UnitOfWork;

class DoctrineListener
{
    /**
     * @param OnFlushEventArgs $eventArgs
     */
    public function onFlush(OnFlushEventArgs $eventArgs)
    {
        $em = $eventArgs->getEntityManager();
        $uow = $em->getUnitOfWork();
        $entityInsert = $uow->getScheduledEntityInsertions();
        $entityUpdate = $uow->getScheduledEntityUpdates();
        $arEntityToRecompute = [];
        foreach ($entityInsert as $singleInsertEntity){
            $arEntityToRecompute[] = $singleInsertEntity->setCreateDth(new DateTime());
        }//ENDFOREACH $entityInsert
        foreach ($entityUpdate as $singleUpdateEntity){
            $arEntityToRecompute[] = $singleUpdateEntity->setUpdateDth(new DateTime());
        }//ENDFOREACH $entityInsert
        if(!empty($arEntityToRecompute)){
            $this->recomputeUnitOfWork(
                $em,
                $uow,
                $arEntityToRecompute
            );
        }

    }

    /**
     * @param EntityManagerInterface $em
     * @param UnitOfWork $uow
     * @param array $arEntityToRecompute
     */
    private function recomputeUnitOfWork(
        EntityManagerInterface $em,
        UnitOfWork $uow,
        array $arEntityToRecompute
    )
    {

        foreach ($arEntityToRecompute as $singleEntity){
            if(is_null($singleEntity)) continue;
            $class = get_class($singleEntity);
            $meta = $em->getClassMetadata($class);
            $isNew = UnitOfWork::STATE_NEW == $uow->getEntityState($singleEntity);
            if($isNew){
                $uow->computeChangeSet($meta, $singleEntity);
            }else{
                if(count($uow->getScheduledEntityDeletions())==0){
                    $uow->recomputeSingleEntityChangeSet($meta, $singleEntity);
                }
            }
        }//ENDFOREACH $arEntityToRecompute

    }
}