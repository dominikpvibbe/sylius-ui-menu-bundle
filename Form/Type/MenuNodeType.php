<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\Form\Type;


use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;

class MenuNodeType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slug',TextType::class,[
                'required' => true
            ])
            ->add('url',TextType::class,[
                'required' => false,
                'label'    => 'Url'
            ])
            ->add('description',TextareaType::class,[
                'required' => false
            ])
            ->add('enabled', CheckboxType::class, [
                'required' => false,
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => MenuNodeTranslationType::class,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'vibbe_sylius_menu';
    }
}
