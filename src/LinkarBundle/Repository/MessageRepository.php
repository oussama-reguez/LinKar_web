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

class MessageRepository extends EntityRepository
{




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







    public function getSendersDQL($idMembre){

        $query = $this->getEntityManager()

            ->createQuery(" select DISTINCT a from LinkarBundle:Message m  , LinkarBundle:Membre a  WHERE m.Sender=a and m.Receiver=:id order by m.date desc ")
            ->setParameter('id',$idMembre);


        return $query->getResult();
    }
    public function getLastDate($idMembre,$idSender){

        $query = $this->getEntityManager()

            ->createQuery(" select m.date from LinkarBundle:Message m  where m.Receiver=:id or  m.Receiver=:id2 or m.Sender=:sender or m.Sender=:sender2  order by m.date desc")
            ->setParameter('sender',$idMembre)
            ->setParameter('sender2',$idSender)
            ->setParameter('id2',$idMembre)
            ->setParameter('id',$idSender)
            ->setMaxResults(1);



        return $query->getSingleResult();
    }

    public function getCountMessages($idMembre,$idSender){

        $query = $this->getEntityManager()

            ->createQuery(" select count(m) from LinkarBundle:Message m  where (m.Receiver=:id and  m.Sender=:id2 ) or ( m.Receiver=:sender and m.Sender=:sender2 ) order by m.date desc")
            ->setParameter('sender',$idMembre)
            ->setParameter('sender2',$idSender)
            ->setParameter('id2',$idMembre)
            ->setParameter('id',$idSender)
            ->setMaxResults(1);

        return $query->getSingleResult();
    }


    public function  searchDQL($search){
        $query = $this->getEntityManager()
            ->createQuery("select m  from ExamAssuranceBundle:Assurance m  where m.liblle like :search")
            ->setParameter('search',"$search%");

        return $query->getResult();
    }


    
}