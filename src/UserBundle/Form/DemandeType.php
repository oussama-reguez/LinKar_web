<?php

namespace UserBundle\Form;


use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('depart',ChoiceType::class , array('choices'=>array('Tunis'=>'Tunis','Ghazella'=>'Ghazella','Manzah 6'=>'Manzah 6','Megrine'=>'Megrine','Manar'=>'Manar','Nouvelle Ariana'=>'Nouvelle Ariana','Djerba'=>'Djerba','Bizerte'=>'Bizerte','Nasr'=>'Nasr','Campus Manar'=>'Campus Manar','Mannouba'=>'Mannouba','Bardo'=>'Bardo','Lac 1'=>'Lac 1','Lac 2'=>'Lac 2','Kram'=>'Kram','Grombelia'=>'Grombelia','Ben Arous'=>'Ben Arous','Hammam-Lif'=>'Hammam-Lif','Ariana'=>'Ariana','Sfax'=>'Sfax','Sousse'=>'Sousse','Esprit El Ghazella'=>'Esprit El Ghazella','Tozeur'=>'Tozeur','Mehdia'=>'Mehdia','Hammamet'=>'Hammamet','Nabeul'=>'Nabeul')))
            ->add('approdep')
            ->add('destination',ChoiceType::class , array('choices'=>array('Tunis'=>'Tunis','Ghazella'=>'Ghazella','Manzah 6'=>'Manzah 6','Megrine'=>'Megrine','Manar'=>'Manar','Nouvelle Ariana'=>'Nouvelle Ariana','Djerba'=>'Djerba','Bizerte'=>'Bizerte','Nasr'=>'Nasr','Campus Manar'=>'Campus Manar','Mannouba'=>'Mannouba','Bardo'=>'Bardo','Lac 1'=>'Lac 1','Lac 2'=>'Lac 2','Kram'=>'Kram','Grombelia'=>'Grombelia','Ben Arous'=>'Ben Arous','Hammam-Lif'=>'Hammam-Lif','Ariana'=>'Ariana','Sfax'=>'Sfax','Sousse'=>'Sousse','Esprit El Ghazella'=>'Esprit El Ghazella','Tozeur'=>'Tozeur','Mehdia'=>'Mehdia','Hammamet'=>'Hammamet','Nabeul'=>'Nabeul')))
            ->add('approdest')
            ->add('date_demande', \Symfony\Component\Form\Extension\Core\Type\DateType::class)
            ->add('fumeur',CheckboxType::class, array('label'=> 'Fumeur','required' =>false,))
            ->add('bavard',CheckboxType::class, array('label'=> 'Discussion','required' =>false,))
            ->add('men_only',CheckboxType::class, array('label'=> 'Homme','required' =>false,))
            ->add('women_only',CheckboxType::class, array('label'=> 'Femme','required' =>false,))
            ->add('animaux',CheckboxType::class, array('label'=> 'Animaux','required'=>false,))
            ->add('tarif',ChoiceType::class , array('choices'=>array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20')))
            ->add('description')
            ->add('Sauvegarder', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LinkarBundle\Entity\Demande'
        ));
    }

    public function getBlockPrefix()
    {
        return 'user_bundle_demande_type';
    }
}






