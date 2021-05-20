<?php


namespace App\Controller\Admin;


use App\Entity\OrderItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrderItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrderItem::class;
    }
}