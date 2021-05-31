<?php

namespace App\Controller\Admin;

use App\Entity\Categorias;
use App\Form\CategoriasABSType;
use App\Form\CategoriasType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CategoriasCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categorias::class;
    }


    public function configureFields(string $pageName): iterable
    {


        if (Crud::PAGE_INDEX === $pageName) {
            return [TextField::new('nombre'),
                TextField::new('descripcion'),
                ImageField::new('imagen')->setBasePath('/uploads/categorias')->setUploadDir('public/uploads/categorias'),];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [TextField::new('nombre'),
                TextField::new('descripcion'),
                ImageField::new('imagen')->setBasePath('/uploads/categorias')->setUploadDir('public/uploads/categorias'),];

        }else{
            return [TextField::new('nombre'),
                TextField::new('descripcion'),
                ImageField::new('imagen')->setBasePath('/uploads/categorias')->setUploadDir('public/uploads/categorias'),
                DateField::new('fecha'),
                TextField::new('url'),];
        }

    }
}
