<?php

namespace App\Handler;

use App\DataTransferObject\TableDTO;
use App\DataTransferObjectTransformer\TransformerInterface;
use App\Entity\Table;
use Doctrine\ORM\EntityManagerInterface;

class TableCreationHandler implements CreationHandlerInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var TransformerInterface
     */
    private $tableTransformer;

    /**
     * TableCreationHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param TransformerInterface $tableTransformer
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        TransformerInterface $tableTransformer
    ) {
        $this->entityManager = $entityManager;
        $this->tableTransformer = $tableTransformer;
    }

    /**
     * @param TableDTO $object
     * @return Table
     */
    public function create($object)
    {
        $table = $this->tableTransformer->reverseTransform($object);
        $this->entityManager->persist($table);
        $this->entityManager->flush();
        return $table;
    }
}
