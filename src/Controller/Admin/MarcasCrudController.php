<?php

namespace App\Controller\Admin;

use App\Entity\Marcas;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MarcasCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Marcas::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
