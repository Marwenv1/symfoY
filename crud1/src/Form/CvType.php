<?php

namespace App\Form;

use App\Entity\Cv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('photo',
                FileType::class, [
                    'label' => 'Content( image)',
                    'mapped' => false
                ])
            ->add('nom')
            ->add('prenom')

            ->add('email')

            ->add('telephone')

            ->add('adresse')
            ->add('codepostale')


            ->add('ville')
            ->add('datedenaissance')
            ->add('lieu')


            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'sexe' => [
                        'homme' => 'homme',
                        'femme' => 'femme',
                        'autre' => 'autre',

                    ],
                ],
            ])



            ->add('etatcivil', ChoiceType::class, [
                'choices' => [
                    'etatcivil' => [
                        'Célibataire' => 'Célibataire',
                        'En couple' => 'En couple',
                        'PACSé(e)' => 'PACSé(e)',
                        'Marié(e)' => 'Marié(e)',
                        'Divorcé(e)' => 'Divorcé(e)',
                        'Veu(f/ve)' => 'Veu(f/ve)',
                        'autre' => 'autre',

                    ],
                ],
            ])




            ->add('formation')
            ->add('etablif')




            ->add('stage')

            ->add('etablis')

            ->add('experience')

            ->add('tablie')

            ->add('centredinteret')
            ->add('longtitude')
            ->add('altitude')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cv::class,
        ]);
    }
}
