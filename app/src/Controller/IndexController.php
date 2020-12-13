<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Floor;
use App\Service\FloorService;
use App\Model\ElevatorRequest;
use App\Service\ElevatorService;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;

class IndexController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Works!'
        ]);
    }

    /**
     * @Route("/floor")
     */
    public function getFloor(
        FloorService $floorService
    ): JsonResponse
    {
        $defaultId = 1;
        $response = $floorService->getOrderedFloorByBuildingId($defaultId);
        return $this->json($response);
    }

    /**
     * @Route("/elevator/status")
     */
    public function elevatorStatus(
        ElevatorService $elevatorService
    ): JsonResponse
    {
        $defaultId = 1;
        $response = $elevatorService->getAllElevator($defaultId);
        return $this->json($response);
    }

    /**
     * @Route("/elevator/request", methods="POST")
     */
    public function elevatorRequest(
        Request $request,
        ElevatorService $elevatorService
    ): JsonResponse
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $model = $serializer->deserialize($request->getContent(), ElevatorRequest::class, 'json', [
            AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => true,
        ]);
        
        $response = $elevatorService->requestElevator($model);

        return $this->json($response);
    }
}
