<?php

namespace App\Form;

use App\Entity\Pedidos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PedidosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha')
            ->add('num_pedido')
            ->add('cod_pedido')
            ->add('precio')
            ->add('array_productos')
            ->add('id_cliente')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pedidos::class,
        ]);
    }
}
