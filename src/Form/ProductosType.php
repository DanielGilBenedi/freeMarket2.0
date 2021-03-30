<?php

namespace App\Form;

use App\Entity\Productos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', HiddenType::class)
            ->add('cod_referencia')
            ->add('nombre')
            ->add('precio')
            ->add('peso')
            ->add('descripcion')
            ->add('ean')
            ->add('imagen',FileType::class, [
                'mapped' => false
            ])
            ->add('stock')
            ->add('id_marca')
            ->add('id_categoria')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Productos::class,
        ]);
    }
}
