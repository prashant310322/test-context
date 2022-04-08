<?php


namespace App\Doctrine;


use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserSetPasswordListener
{

     public  function  __construct(private UserPasswordHasherInterface $hasher)
     {

     }
     public  function prePersist(User $user)
     {
         if ($user->getPassword()) {
             $this->hashPassword($user);
         }
         $user->eraseCredentials();
     }

    private function hashPassword(User $user)
    {
        $password = $this->hasher->hashPassword($user, $user->getPassword());
        $user->setPassword($password);
    }
}