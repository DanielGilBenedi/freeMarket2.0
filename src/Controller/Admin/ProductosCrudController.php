<?php

namespace App\Controller\Admin;

use App\Entity\Productos;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
class ProductosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Productos::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('cod_referencia'),
            TextField::new('ean'),
            TextField::new('titulo'),
            TextEditorField::new('descripcion'),
            ImageField::new('imagen')->onlyOnIndex(),
            NumberField::new('stock'),
            NumberField::new('precio'),
            NumberField::new('peso'),
        ];
    }

}
