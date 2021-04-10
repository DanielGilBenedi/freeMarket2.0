<?php

namespace App\Controller\Admin;

use App\Entity\Marcas;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MarcasCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Marcas::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nombre'),
            TextField::new('descripcion'),
            ImageField::new('imagen')->setBasePath('/uploads/marcas')->setUploadDir('public/uploads/marcas'),
        ];
    }
}
