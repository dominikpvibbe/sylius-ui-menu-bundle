<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuNodeTranslationType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'required' => true
            ])
            ->add('tooltip', TextareaType::class, [
                'required' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'vibbe_sylius_menu_translation';
    }
}
