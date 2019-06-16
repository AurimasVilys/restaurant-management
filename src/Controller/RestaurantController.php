<?php

namespace App\Controller;

use App\DataTransferObject\RestaurantDTO;
use App\DataTransferObjectTransformer\TransformerInterface;
use App\Entity\Restaurant;
use App\Form\RestaurantFormType;
use App\Handler\CreationHandlerInterface;
use App\Handler\RemovalHandlerInterface;
use App\Handler\UpdateHandlerInterface;
use App\Repository\RestaurantRepository;
use App\Utils\PaginationUtilsInterface;
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
     * @param Request $request
     * @param PaginationUtilsInterface $paginationUtils
     * @return Response
     */
    public function index(
        Request $request,
        PaginationUtilsInterface $paginationUtils
    ) {
        /** @var RestaurantRepository $restaurantRepository */
        $restaurantRepository = $this->getDoctrine()->getRepository(Restaurant::class);

        $title = $request->query->get('title');

        $page = $paginationUtils->getPageInput($request->query->get('page'));

        $paginator = $restaurantRepository->findActiveRestaurants($title, $page, PaginationUtilsInterface::PAGE_SIZE);

        /** @var Restaurant[][] $restaurants */
        $restaurants = $paginator->getIterator();

        $pageCount = ceil($paginator->count() / PaginationUtilsInterface::PAGE_SIZE);

        if ($pageCount < $page) {
            $this->redirectToRoute('restaurant');
        }

        return $this->render('restaurant/index.html.twig', [
            'restaurants' => $restaurants,
            'page' => $page,
            'pageCount' => $pageCount
        ]);
    }

    /**
     * @Route("/restaurant/create", name="restaurant_create")
     * @param Request $request
     * @param CreationHandlerInterface $restaurantCreationHandler
     * @return Response|RedirectResponse
     */
    public function create(Request $request, CreationHandlerInterface $restaurantCreationHandler)
    {
        $form = $this->createForm(RestaurantFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var RestaurantDTO $restaurantDTO */
            $restaurantDTO = $form->getData();
            $restaurantCreationHandler->create($restaurantDTO);
            return $this->redirectToRoute('restaurant');
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
     * @param UpdateHandlerInterface $restaurantUpdateHandler
     * @return Response|RedirectResponse
     */
    public function edit(
        Request $request,
        Restaurant $restaurant,
        TransformerInterface $restaurantTransformer,
        UpdateHandlerInterface $restaurantUpdateHandler
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
     * @param RemovalHandlerInterface $restaurantRemovalHandler
     * @return RedirectResponse
     */
    public function remove(
        Restaurant $restaurant,
        RemovalHandlerInterface $restaurantRemovalHandler
    ) {
        $restaurantRemovalHandler->remove($restaurant);
        return $this->redirectToRoute('restaurant');
    }
}
