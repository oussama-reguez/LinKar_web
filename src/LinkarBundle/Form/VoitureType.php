<?php

namespace LinkarBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Tests\Constraints\ImageValidatorTest;

class VoitureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('brand',TextType::class,array('label' => 'Référence voiture'))
            ->add('model',EntityType::class, array ('class'=>'LinkarBundle\Entity\VoitureModel','choice_label'=>'modelName',))
            ->add('confort',ChoiceType::class,array('label' => 'Confort','choices'=>array('Peu confortable'=>'1','Confort Moyen'=>2,'Confortable'=>3,'Très confortable'=>4)))
            ->add('numberPlaces',IntegerType::class,array('label' => 'Nombre de places (chauffeur inclu)'))
            ->add('color',ChoiceType::class,array('label' => 'Couleur','choices'=>array('Noir'=>'Noir','Gris'=>'Gris','Blanc'=>'Blanc','Rouge'=>'Rouge','Bleu'=>'Bleu','Vert'=>'Vert','Autre'=>'Autre')))
            ->add('urlCarSelfie', FileType::class, array('label' => 'Image Voiture','data_class' => null,'attr' => array('accept' => 'image/jpeg,image/png,image/jpg') ))
            //->add('captchaCode', 'Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType', array('captchaConfig' => 'ExampleCaptcha'))
        ;
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LinkarBundle\Entity\Voiture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'linkarbundle_voiture';
    }


}