<?php

namespace App\Controller;

use App\DataTransferObject\TableDTO;
use App\DataTransferObjectTransformer\TransformerInterface;
use App\Entity\Restaurant;
use App\Entity\Table;
use App\Form\TableFormType;
use App\Handler\CreationHandlerInterface;
use App\Handler\RemovalHandlerInterface;
use App\Handler\UpdateHandlerInterface;
use App\Repository\TableRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends AbstractController
{

    /**
     * @Route("/restaurant/{id}/table", name="table", requirements={"id"="\d+"})
     * @ParamConverter("restaurant", class="App:Restaurant")
     * @param Restaurant $restaurant
     * @param Request $request
     * @return Response
     */
    public function index(Restaurant $restaurant, Request $request)
    {
        /** @var TableRepository $tableRepository */
        $tableRepository = $this->getDoctrine()->getRepository(Table::class);
        $tables = $tableRepository->findByRestaurant($restaurant);

        return $this->render('/table/index.html.twig', [
            'tables' => $tables,
            'restaurant' => $restaurant
        ]);
    }

    /**
     * @Route("/restaurant/{id}/table/create", name="table_create", requirements={"id"="\d+"})
     * @ParamConverter("restaurant", class="App:Restaurant")
     * @param Restaurant $restaurant
     * @param Request $request
     * @param CreationHandlerInterface $tableCreationHandler
     * @return Response
     */
    public function create(Restaurant $restaurant, Request $request, CreationHandlerInterface $tableCreationHandler)
    {
        $tableForm = $this->createForm(TableFormType::class);

        $tableForm->handleRequest($request);

        if ($tableForm->isSubmitted() && $tableForm->isValid()) {
            /** @var TableDTO $tableDTO */
            $tableDTO = $tableForm->getData();
            $tableDTO->setRestaurant($restaurant);

            $tableCreationHandler->create($tableDTO);

            return $this->redirectToRoute('table', ['id' => $restaurant->getId()]);
        }
        return $this->render('/table/edit.html.twig', [
            'tableForm' => $tableForm->createView()
        ]);
    }

    /**
     * @Route("/restaurant/{rest_id}/table/edit/{id}", name="table_edit", requirements={"id"="\d+", "rest_id"="\d+"})
     * @ParamConverter("table", class="App:Table")
     * @param int $rest_id
     * @param Table $table
     * @param Request $request
     * @param TransformerInterface $tableTransformer
     * @param UpdateHandlerInterface $tableUpdateHandler
     * @return Response
     */
    public function edit(
        int $rest_id,
        Table $table,
        Request $request,
        TransformerInterface $tableTransformer,
        UpdateHandlerInterface $tableUpdateHandler
    ) {
        /** @var TableDTO $tableDTO */
        $tableDTO = $tableTransformer->transform($table);
        $tableForm = $this->createForm(TableFormType::class, $tableDTO);

        $tableForm->handleRequest($request);

        if ($tableForm->isSubmitted() && $tableForm->isValid()) {
            $tableDTO = $tableForm->getData();
            $tableUpdateHandler->update($table, $tableDTO);
            return $this->redirectToRoute('table', ['id' => $rest_id ]);
        }
        return $this->render('/table/edit.html.twig', [
            'tableForm' => $tableForm->createView()
        ]);
    }

    /**
     * @Route(
     *     "/restaurant/{rest_id}/table/delete/{id}",
     *     name="table_delete",
     *     requirements={"id"="\d+", "rest_id"="\d+"}
     * )
     * @ParamConverter("table", class="App:Table")
     * @param int $rest_id
     * @param Table $table
     * @param RemovalHandlerInterface $tableRemovalHandler
     * @return RedirectResponse
     */
    public function remove(
        int $rest_id,
        Table $table,
        RemovalHandlerInterface $tableRemovalHandler
    ) {
        $tableRemovalHandler->remove($table);
        return $this->redirectToRoute('table', ['id' => $rest_id]);
    }
}
