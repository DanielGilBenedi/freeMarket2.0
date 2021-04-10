<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Component\Security\Core\Security;

class UserUserCrudController extends AbstractCrudController
{
    private $userRepository;
    private $cartSessionStorage;
    private $entityManager;
    private $security;

    /**
     * CartManager constructor.
     *
     * @param CartSessionStorage $cartStorage
     * @param EntityManagerInterface $entityManager
     * @param UserRepository $userRepository
     * @param Security $security
     */
    public function __construct(
        CartSessionStorage $cartStorage,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        Security $security

    ) {
        $this->cartSessionStorage = $cartStorage;
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->security = $security;
    }
    public static function getEntityFqcn(): string
    {
        return User::class;
    }



    public function configureFields(string $pageName): iterable
    {
        $idUser = $this->userRepository->findOneBy(['email' => $this->cartSessionStorage->getIdUser($this->security->getUser())]);
        $user = $this->entityManager->getRepository(User::class)->findBy([
            'id' =>$idUser]);
        $id = $user[0]->getId();

    }

}
