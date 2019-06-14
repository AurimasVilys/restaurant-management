<?php

namespace App\Controller;

use App\DataTransferObject\RestaurantDTO;
use App\DataTransferObjectTransformer\TransformerInterface;
use App\Entity\Restaurant;
use App\Form\RestaurantFormType;
use App\Handler\RestaurantCreationHandler;
use App\Handler\RestaurantRemovalHandler;
use App\Handler\RestaurantUpdateHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    /**
     * @Route("/restaurant", name="restaurant")
     */
    public function index()
    {
        return $this->render('restaurant/index.html.twig', [
            'controller_name' => 'RestaurantController',
        ]);
    }

    /**
     * @Route("/restaurant/create", name="restaurant_create")
     * @param Request $request
     * @param RestaurantCreationHandler $restaurantCreationHandler
     * @return Response|RedirectResponse
     */
    public function create(Request $request, RestaurantCreationHandler $restaurantCreationHandler)
    {
        $form = $this->createForm(RestaurantFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var RestaurantDTO $restaurantDTO */
            $restaurantDTO = $form->getData();
            $restaurant = $restaurantCreationHandler->create($restaurantDTO);
            return $this->redirectToRoute('restaurant_edit', ['id' => $restaurant->getId()]);
        }

        return $this->render('restaurant/edit.html.twig', [
            'restaurantForm' => $form->createView(),
            'restaurant' => null,
        ]);
    }

    /**
     * @Route("/restaurant/edit/{id}", name="restaurant_edit", requirements={"id"="\d+"})
     * @ParamConverter("restaurant", class="App:Restaurant")
     * @param Request $request
     * @param Restaurant $restaurant
     * @param TransformerInterface $restaurantTransformer
     * @param RestaurantUpdateHandler $restaurantUpdateHandler
     * @return Response|RedirectResponse
     */
    public function edit(
        Request $request,
        Restaurant $restaurant,
        TransformerInterface $restaurantTransformer,
        RestaurantUpdateHandler $restaurantUpdateHandler
    ) {
        /** @var RestaurantDTO $restaurantDTO */
        $restaurantDTO = $restaurantTransformer->transform($restaurant);

        $form = $this->createForm(RestaurantFormType::class, $restaurantDTO);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restaurantDTO = $form->getData();
            $restaurantUpdateHandler->update($restaurant, $restaurantDTO);
            return $this->redirectToRoute('restaurant');
        }

        return $this->render('restaurant/edit.html.twig', [
            'restaurantForm' => $form->createView(),
            'restaurant' => $restaurant,
        ]);
    }

    /**
     * @Route("/restaurant/delete/{id}", name="restaurant_delete", requirements={"id"="\d+"})
     * @ParamConverter("restaurant", class="App:Restaurant")
     * @param Restaurant $restaurant
     * @param RestaurantRemovalHandler $restaurantRemovalHandler
     * @return RedirectResponse
     */
    public function remove(
        Restaurant $restaurant,
        RestaurantRemovalHandler $restaurantRemovalHandler
    ) {
        $restaurantRemovalHandler->remove($restaurant);
        return $this->redirectToRoute('restaurant');
    }
}
