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


    public function findByfullNameDQL($name){

        $query = $this->getEntityManager()

            ->createQuery(" select m  from LinkarBundle:Membre m  where m.lastName like :name or m.firstName like :first")
            ->setParameter('name',$name.'%')
            ->setParameter('first',$name.'%');


        return $query->getResult();
    }

    public function findByGenre($genre){

        $query = $this->getEntityManager()

            ->createQuery(" select m   from LinkarBundle:Membre m  where m.gender = :gender")
            ->setParameter('gender',$genre);


        return $query->getResult();
    }

    public function getStatCreatedUsersDql(){
//  String req = "select  DATE(CreatedTime) d ,count(id_member) from membre   GROUP BY YEAR(d), MONTH(d)  order by CreatedTime ";

        $query = $this->getEntityManager()

            ->createQuery(" select  SUBSTRING(m.createdtime, 1, 7) as d  , count(m.id)    from LinkarBundle:Membre m   group by  d ");



        return $query->getResult();

    }

  public function getStatCreatedUsersbyYearDql(){
        //String req = "select  DATE(CreatedTime) d ,count(id_member) from membre   GROUP BY YEAR(d) order by CreatedTime ";
      $query = $this->getEntityManager()

          ->createQuery(" select  SUBSTRING(m.createdtime, 1, 4) as d  , count(m.id)    from LinkarBundle:Membre m   group by  d ");



      return $query->getResult();

    }

  public function  getStatnbrUsersbyGender(){

    //  String req = "select  gender ,count(id_member) from membre  group by  gender ";

      $query = $this->getEntityManager()

          ->createQuery(" select  m.gender  , count(m.id)    from LinkarBundle:Membre m   group by  m.gender ");



      return $query->getResult();
  }

  public function countNbrUsers(){
      $query = $this->getEntityManager()

          ->createQuery(" select   count(m.id)    from LinkarBundle:Membre m   ");



      return $query->getSingleResult();

  }

    public function countBlockedUsers(){
        $query = $this->getEntityManager()

            ->createQuery(" select   count(m.id)    from LinkarBundle:Membre m  where m.statut =  0 ");



        return  $query->getSingleResult();

    }

    public function getActiveUsers(){
        $query = $this->getEntityManager()

            ->createQuery(" select   m   , (select count (a)  from LinkarBundle:Annonce a where a.Membre = m )  as d  from LinkarBundle:Membre m   ")

 ->setMaxResults(30);

        return $query->getResult();
    }

    public function countInactiveUsers(){

      //  select count(id) from membre d where 0=(select COUNT(id_annonce)from annonce where id_membre =d.id)
        $query = $this->getEntityManager()

            ->createQuery(" select  count(m) from  LinkarBundle:Membre m where  0=(select count(d) from LinkarBundle:Annonce d  where d.Membre=m) ");



        return $query->getSingleResult();
    }


    public function countAnnouncers(){

        //  select count(id) from membre d where 0=(select COUNT(id_annonce)from annonce where id_membre =d.id)
        $query = $this->getEntityManager()

            ->createQuery(" select  count(m) from  LinkarBundle:Membre m where  (select count(d) from LinkarBundle:Annonce d  where d.Membre=m) > 0 ");



        return $query->getSingleResult();
    }

    public function countDemanders(){

        //  select count(id) from membre d where 0=(select COUNT(id_annonce)from annonce where id_membre =d.id)
        $query = $this->getEntityManager()

            ->createQuery(" select  count(m) from  LinkarBundle:Membre m where  (select count(d) from LinkarBundle:Demande d  where d.Membre=m) > 0 ");



        return $query->getSingleResult();
    }





}