<?php
/**
 namespace namespacenamespacenamespacenamespacenamespacenamespacenamespace
 namespacenamespacenamespacenamespacenamespacenamespacenamespacenamespacenamespace
 namespacenamespacenamespacenamespacenamespacenamespacenamespacenamespacenamespace
 */
namespace LinkarBundle\Repository;
/**
 dont forget this !!!!!!!!!!!!!!!!!!!!!!!!!
 @ORM\Entity(repositoryClass="myApp\parcBundle\Repository\ModeleRepository")
 */

 
use \Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class NotificationRepository extends EntityRepository
{
    public function findPaysQB(){


        $query=$this->createQueryBuilder('s');
        $query->where("s.pays=:pays")->setParameter('pays','tunisie');

        return $query->getQuery()->getResult();
    }



    public function showMessagesDQL($idMembre){

        $query = $this->getEntityManager()

            ->createQuery(" select DISTINCT m  from LinkarBundle:Message m  JOIN m.Sender a WHERE a.id=:id")
        ->setParameter('id',$idMembre);

        $query-> setFetchMode("LinkarBundle:Message", "Sender", ClassMetadata::FETCH_EAGER);
        return $query->getResult();
    }

    public function showAllSendersMessagesDQL($idMembre,$idSender){

        $query = $this->getEntityManager()

            ->createQuery(" select m  from LinkarBundle:Message m  where m.Receiver=:id and m.Sender=:sender order by m.date")
            ->setParameter('id',$idMembre)
            ->setParameter('sender',$idSender);

        return $query->getResult();
    }

    public function showAllReceiversMessagesDQL($idMembre,$idSender){

        $query = $this->getEntityManager()

            ->createQuery(" select m  from LinkarBundle:Message m  where m.Receiver=:id and m.Sender=:sender order by m.date")
            ->setParameter('sender',$idMembre)
            ->setParameter('id',$idSender);

        return $query->getResult();
    }


public function countNotification($id_member){
    $query = $this->getEntityManager()

        ->createQuery(" select  count(n.idNotification) from LinkarBundle:Notification n  JOIN n.Member a WHERE a.id =:id ")
        ->setParameter('id',$id_member)
        ->setMaxResults(1);


    return $query->getSingleResult();

}

    public function getNotifications($id_member,$count){
        $query = $this->getEntityManager()

            ->createQuery(" select  n from LinkarBundle:Notification n  JOIN n.Member a WHERE a.id =:id order by n.idNotification DESC ")
            ->setParameter('id',$id_member)
            ->setMaxResults($count);


        return $query->getResult();

    }

    public function getAllNotifications($id_member){
        $query = $this->getEntityManager()

            ->createQuery(" select  n from LinkarBundle:Notification n  JOIN n.Member a WHERE a.id =:id order by n.idNotification DESC ")
            ->setParameter('id',$id_member);



        return $query->getResult();

    }







    
}