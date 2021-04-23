<?php


namespace App\Controller\Admin;


use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserNewController extends EasyAdminController
{
    private $encoder;

  public function __construct(UserPasswordEncoderInterface $encoder)
  {
      $this->encoder = $encoder;
  }


    public function setEncoder(UserPasswordEncoderInterface $encoder): void
    {
        $this->encoder = $encoder;
    }
    public function setUserPlainPassword(User $user): void
    {
      if($user->getPassword()){
          $user->setPassword($this->encoder->encodePassword($user,$user->getPassword()));
      }
    }
    public function persistUserEntity(User $user): void
    {
        $this->setUserPlainPassword($user);

        $this->persistUserEntity($user);
    }

    public function updateUserEntity(User $user): void
    {
        $this->setUserPlainPassword($user);

        $this->updateUserEntity($user);
    }



}