<?php
/**
 * Created by PhpStorm.
 * User: vilca
 * Date: 27/05/18
 * Time: 03:09
 */

namespace AppBundle\Form;


use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, ['attr' => ['required' => true ]])
            ->add('lastname', TextType::class, ['attr' => ['required' => true]])
            ->add('birthDate', BirthdayType::class, ['attr' => ['required' => true]])
            ->add('phoneNumber', TelType::class, ['attr' => ['required' => true]])
            ->add('isACertifiedPilot', ChoiceType::class, [
                'choices' => [
                    'yes' => 'true',
                    'No' => 'false'
                ]
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
       return RegistrationFormType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => 'AppBundle\Entity\User',
        ]);
    }

    public function getBlockPrefix()
    {
       return 'app_user_registration';
    }


}