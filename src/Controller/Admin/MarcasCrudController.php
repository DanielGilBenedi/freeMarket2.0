<?php

namespace App\Controller\Admin;

use App\Entity\Marcas;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
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

        if (Crud::PAGE_INDEX === $pageName) {
            return [TextField::new('nombre'),
                TextField::new('descripcion'),
                ImageField::new('imagen')->setBasePath('/uploads/marcas')->setUploadDir('public/uploads/marcas'),];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [TextField::new('nombre'),
                TextField::new('descripcion'),
                ImageField::new('imagen')->setBasePath('/uploads/marcas')->setUploadDir('public/uploads/marcas'),];

        }else{
            return [TextField::new('nombre'),
                TextField::new('descripcion'),
                ImageField::new('imagen')->setBasePath('/uploads/marcas')->setUploadDir('public/uploads/marcas'),
                DateField::new('fecha'),
                TextField::new('url'),];
        }
    }
}
