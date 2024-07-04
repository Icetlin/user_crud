<?php

namespace App\Controller;

use App\Model\UserCrudModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UserCrudController extends AbstractController
{
    private UserCrudModel $model;
    private ValidatorInterface $validator;

    public function __construct(UserCrudModel $model, ValidatorInterface $validator)
    {
        $this->model = $model;
        $this->validator = $validator;
    }

    public function getById(int $id): Response
    {
        $user = $this->model->getUserById($id);

        if (!$user) {
            return new Response('User not found', Response::HTTP_NOT_FOUND);
        }

        return $this->json($user);
    }

    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $errors = $this->validateUserData($data);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $user = $this->model->createUser($data);

        return $this->json($user, Response::HTTP_CREATED);
    }

    public function update(int $id, Request $request): Response
    {
        $user = $this->model->getUserById($id);

        if (!$user) {
            return new Response('User not found', Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $errors = $this->validateUserData($data);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $user = $this->model->updateUser($user, $data);

        return $this->json($user);
    }

    public function delete(int $id): Response
    {
        $user = $this->model->getUserById($id);

        if (!$user) {
            return new Response('User not found', Response::HTTP_NOT_FOUND);
        }

        $this->model->deleteUser($user);

        return new Response('User deleted', Response::HTTP_NO_CONTENT);
    }

    private function validateUserData(array $data): array
    {
        $constraints = new Assert\Collection([
            'email' => [new Assert\NotBlank(), new Assert\Email()],
            'name' => [new Assert\NotBlank(), new Assert\Length(['max' => 255])],
            'age' => [new Assert\NotBlank(), new Assert\Type('integer')],
            'sex' => [new Assert\NotBlank(), new Assert\Choice(['choices' => ['M', 'F']])],
            'birthday' => [new Assert\NotBlank(), new Assert\Date()],
            'phone' => [new Assert\Optional(new Assert\Length(['max' => 255]))],
        ]);

        $violations = $this->validator->validate($data, $constraints);

        $errors = [];
        if (count($violations) > 0) {
            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }
        }

        return $errors;
    }
}
