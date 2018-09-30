<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\PetRepository;

class PetController extends AbstractController
{
    /**
     * @Route("/pet/{id}", name="pet_infos")
     */
    public function getPetInfos(SerializerInterface $serializer, PetRepository $repository, $id): JsonResponse
    {
        $pet = $repository->find($id);
        return new JsonResponse(
            json_decode($serializer->serialize(
                $pet,
                'json', 
                ['groups' => ['pet_details']]
            )),
            Response::HTTP_OK
        );
    }
}
