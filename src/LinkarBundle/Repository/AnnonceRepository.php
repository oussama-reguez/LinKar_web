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

class AnnonceRepository extends EntityRepository
{




    public function showMessagesDQL($idMembre){

        $query = $this->getEntityManager()

            ->createQuery(" select DISTINCT m  from LinkarBundle:Message m  JOIN m.Sender a WHERE a.id=:id")
        ->setParameter('id',$idMembre);

        $query-> setFetchMode("LinkarBundle:Message", "Sender", ClassMetadata::FETCH_EAGER);
        return $query->getResult();
    }


    public function countNbrAnnonce(){
        $query = $this->getEntityManager()

            ->createQuery(" select   count(m.idAnnonce)    from LinkarBundle:Annonce m   ");



        return $query->getResult();

    }
    public function countAnnonceByState(){
        $query = $this->getEntityManager()

            ->createQuery(" select     m.etat  ,count(m.idAnnonce)    from LinkarBundle:Annonce m  group by m.etat   ");



        return $query->getResult();

    }


    public function getYears(){
//  String req = "select  DATE(CreatedTime) d ,count(id_member) from membre   GROUP BY YEAR(d), MONTH(d)  order by CreatedTime ";

        $query = $this->getEntityManager()

            ->createQuery(" select  DISTINCT  SUBSTRING(m.dateAnnonce, 1, 4) as d     from LinkarBundle:Annonce m   ");



        return $query->getResult();

    }


    public function getStatAnnonceByYear($year){
//  String req = "select  DATE(CreatedTime) d ,count(id_member) from membre   GROUP BY YEAR(d), MONTH(d)  order by CreatedTime ";

        $query = $this->getEntityManager()

            ->createQuery(" select  SUBSTRING(m.dateAnnonce, 6, 2) as d  , count(m.idAnnonce)    from LinkarBundle:Annonce m    where SUBSTRING(m.dateAnnonce, 1, 4) =:year group by  d ")
        ->setParameter('year',$year);


        return $query->getResult();

    }

    public function getPopularDestination(){
        $query = $this->getEntityManager()

            ->createQuery(" select  m.destination , COUNT(m) as cnt  from LinkarBundle:Annonce m  GROUP by m.destination order by cnt desc ")


->setMaxResults(5);
        return $query->getResult();

    }


    public function getPopularDepart(){
        $query = $this->getEntityManager()

            ->createQuery(" select  m.depart , COUNT(m) as cnt  from LinkarBundle:Annonce m  GROUP by m.depart order by cnt desc ")


            ->setMaxResults(5);
        return $query->getResult();

    }

    
}