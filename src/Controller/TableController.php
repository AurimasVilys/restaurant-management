<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Form\TableFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends AbstractController
{
    /**
     * @Route("/restaurant/{id}/table/create", name="table_create", requirements={"id"="\d+"})
     * @ParamConverter("restaurant", class="App:Restaurant")
     * @param Restaurant $restaurant
     * @param Request $request
     * @return Response
     */
    public function create(Restaurant $restaurant, Request $request)
    {
        $tableForm = $this->createForm(TableFormType::class);

        $tableForm->handleRequest($request);

        if ($tableForm->isSubmitted() && $tableForm->isValid()) {
            //Handler
            return $this->redirectToRoute('restaurant');
        }
        return $this->render('table/index.html.twig', [
            'tableForm' => $tableForm->createView()
        ]);
    }
}
