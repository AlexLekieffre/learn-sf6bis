<?php

namespace App\Form;

use App\Entity\Article;
use App\Form\ImageType;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', ImageType::class)
            ->add('categories', EntityType::class,['class'=>Category::class,'choice_label'=>'label','multiple'=>true,'expanded'=>true,'query_builder'=> function(CategoryRepository $repository){return $repository->getPublish();}])
            ->add('title', TextType::class,["label"=>"Titre"])
            ->add('content',TextareaType::class,["label"=>"Contenu"])
            ->add('isPublished',CheckboxType::class,["label"=>"Publier"])
            ->add('sauvegarder',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}