<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('chemin',FileType::class,["label"=>"Ajouter une image"])
            ->add('alt',TextType::class,["label"=>"Ajouter une description"])
            ->add('isPublished',CheckboxType::class,array('label'=>'publier l\'image ?','attr'=>['checked'=>'checked']))
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}