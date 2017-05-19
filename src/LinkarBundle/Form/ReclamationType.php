<?php


namespace LinkarBundle\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ReclamationType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type',ChoiceType::class,array(

            'choices'=>array(
                "Membre"=>"Membre","Annonce"=>"Annonce","Autre ..."=>"Autre"
            )
        ))->add('subject')
            ->add('text')

            ->add('captchaCode', 'Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType', array(
                'captchaConfig' => 'ExampleCaptcha'



            ))

        ;




        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LinkarBundle\Entity\Reclamation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'Linkar_userbundle_reclamations';
    }




}

