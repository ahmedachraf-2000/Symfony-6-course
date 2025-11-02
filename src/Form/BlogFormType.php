<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'block w-full border-b-2 border-gray-300 focus:border-blue-500 outline-none py-2',
                    'placeholder' => 'Enter title',
                ],
                'label' => false,
            ])
            ->add('slug', TextType::class, [
                'attr' => [
                    'class' => 'block w-full border-b-2 border-gray-300 focus:border-blue-500 outline-none py-2',
                    'placeholder' => 'Enter slug',
                ],
                'label' => false,
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'class' => 'block w-full border-b-2 border-gray-300 focus:border-blue-500 outline-none py-2 h-40',
                    'placeholder' => 'Enter content',
                ],
                'label' => false,
            ])
            ->add('publishedAt', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'label' => false,
                'attr' => [
                    'class' => 'block w-full border-b-2 border-gray-300 focus:border-blue-500 outline-none py-2',
                    'placeholder' => 'Select publish date',
                ],
            ])
            ->add('imagePath', FileType::class, [
                'required' => false,
                'label' => false,
            ]);

        // 👇 Add the transformer here
        $builder->get('publishedAt')
            ->addModelTransformer(new CallbackTransformer(
                // Transform entity (DateTimeImmutable) -> form (DateTime)
                fn($dateTimeImmutable) => $dateTimeImmutable
                    ? \DateTime::createFromImmutable($dateTimeImmutable)
                    : null,
                // Transform form (DateTime) -> entity (DateTimeImmutable)
                fn($dateTime) => $dateTime
                    ? \DateTimeImmutable::createFromMutable($dateTime)
                    : null
            ));

           // ->add('author')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }


}
