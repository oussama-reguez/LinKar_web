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

class MembreRepository extends EntityRepository
{


    public function showAllReceiversMessagesDQL($idMembre,$idSender){

        $query = $this->getEntityManager()

            ->createQuery(" select m  from LinkarBundle:Message m  where m.Receiver=:id and m.Sender=:sender order by m.date")
            ->setParameter('sender',$idMembre)
            ->setParameter('id',$idSender);

        return $query->getResult();
    }

    public function findByNameDQL($name){

        $query = $this->getEntityManager()

            ->createQuery(" select m  from LinkarBundle:Membre m  where m.firstName like :name")
            ->setParameter('name',$name+'%');


        return $query->getResult();
    }


    public function findByLastNameDQL($name){

        $query = $this->getEntityManager()

            ->createQuery(" select m  from LinkarBundle:Membre m  where m.lastName like :name")
            ->setParameter('name',$name+'%');


        return $query->getResult();
    }


    public function findByfullNameDQL($first ,$name){

        $query = $this->getEntityManager()

            ->createQuery(" select m  from LinkarBundle:Membre m  where m.lastName like :name and m.firstName like :first")
            ->setParameter('name',$name+'%')
            ->setParameter('first',$first+'%');


        return $query->getResult();
    }

    public function findByGenre($genre){

        $query = $this->getEntityManager()

            ->createQuery(" select m  from LinkarBundle:Membre m  where m.gender = :gender")
            ->setParameter('gender',$genre);


        return $query->getResult();
    }

    
}