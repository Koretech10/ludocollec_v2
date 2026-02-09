<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\Toy\ToyRepository;
use App\Util\DataGrid\DataGridBuilder;
use App\Util\DataGrid\DataGridConfig;
use SlopeIt\BreadcrumbBundle\Attribute\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/toy')]
#[Breadcrumb(['label' => 'Jouets vidéo', 'route' => 'toy.list'])]
class ToyController extends AbstractController
{
    public function __construct(
        private readonly ToyRepository $toyRepository,
        private readonly DataGridBuilder $dataGridBuilder,
    ) {
    }

    #[Route('/list', name: 'toy.list')]
    public function list(Request $request): Response
    {
        $config = new DataGridConfig(
            queryBuilder: $this->toyRepository->findForListQueryBuilder(),
            defaultSortField: 'releaseDate',
        );

        $dataGrid = $this->dataGridBuilder->build($config, $request);

        return $this->render('toy/list.html.twig', [
            'pagination' => $dataGrid->pager,
        ]);
    }
}
