<?php


namespace App\Form;


use App\Entity\Productos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductosShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('cod_referencia')
            ->add('nombre')
            ->add('precio')
            ->add('peso')
            ->add('descripcion')
            ->add('ean')
            ->add('imagen')
            ->add('stock')
            ->add('url')
            ->add('titulo')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Productos::class,
        ]);
    }

}