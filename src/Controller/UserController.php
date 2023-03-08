<?php

namespace App\Controller;

use App\DataTransferObjects\UserDto;
use App\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/api/v1')]
class UserController extends AbstractController
{

    public function __construct(private UserService $userService)
    {    }


    #[Route('/users', name: 'app_users_get', methods: "GET")]
    public function index(): JsonResponse
    {   
        $userDtos = $this->userService->listAllUsers();
       
        return $this->json($userDtos);
    }


    #[Route('/users/{id}', name: 'app_user_get', methods: "GET")]
    public function getUserById(int $id): JsonResponse
    {
        $userDto = new UserDto();
        $userDto = $this->userService->getUserById($id);
        
        return $this->json($userDto);
    }


    #[Route('/users/{id}', name: 'app_users_patch', methods: "PATCH")]
    public function updateUser(Request $request,int $id): JsonResponse
    {
        
        if ($id == null) {
            return new JsonResponse("id is incorrect", 200, [], true);
        }

        $this->userService->updateUser($request,$id);

        return new JsonResponse(['meesage' => 'User updated succesfully'], 200);
    }



     #[Route('/users/{id}/role', name:'app_user_role_unassign', methods: "PATCH")]
     public function unAssignRole(Request $request,int $id):JsonResponse{

        if ($id == null) {
            return new JsonResponse("id is incorrect", 200, [], true);
        }

        $this->userService->unAssignRole($request,$id);

        return new JsonResponse(['message'=>'Role Unassigned Successfuly'],200);
     }


    #[Route('/users/{id}/project', name:'app_user_project_unassign', methods: "PATCH")]
    public function unAssignProject(Request $request,int $id):JsonResponse{

        if ($id == null) {
            return new JsonResponse("id is incorrect", 200, [], true);
        }

        $this->userService->unAssignProject($request,$id);

        return new JsonResponse(['message'=>'Project Unassigned Successfuly'],200);
    }


    #[Route('/users/{id}/feedback', name:'app_user_feedback_unassign', methods: "PATCH")]
    public function unAssignFeedback(Request $request,int $id):JsonResponse{

        if ($id == null) {
            return new JsonResponse("id is incorrect", 200, [], true);
        }

        $this->userService->unAssignFeedBack($request,$id);

        return new JsonResponse(['message'=>'Feedback Unassigned Successfuly'],200);
    }


}