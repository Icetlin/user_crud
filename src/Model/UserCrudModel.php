<?php

namespace App\Model;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserCrudModel
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getUserById(int $id): ?User
    {
        return $this->entityManager->getRepository(User::class)->find($id);
    }

    public function createUser(array $data): User
    {
        $user = new User();
        $user->setEmail($data['email']);
        $user->setName($data['name']);
        $user->setAge($data['age']);
        $user->setSex($data['sex']);
        $user->setBirthday(new \DateTime($data['birthday']));
        $user->setPhone($data['phone'] ?? null);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTimeImmutable());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function updateUser(User $user, array $data): User
    {
        $user->setEmail($data['email']);
        $user->setName($data['name']);
        $user->setAge($data['age']);
        $user->setSex($data['sex']);
        $user->setBirthday(new \DateTime($data['birthday']));
        $user->setPhone($data['phone'] ?? null);
        $user->setUpdatedAt(new \DateTimeImmutable());

        $this->entityManager->flush();

        return $user;
    }

    public function deleteUser(User $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}
