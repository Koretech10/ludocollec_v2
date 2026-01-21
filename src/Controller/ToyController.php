<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\Toy\ToyRepository;
use Knp\Component\Pager\PaginatorInterface;
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
        private readonly PaginatorInterface $paginator,
    ) {
    }

    #[Route('/list', name: 'toy.list')]
    public function list(Request $request): Response
    {
        $pagination = $this->paginator->paginate(
            $this->toyRepository->findForListQueryBuilder(),
            $request->query->getInt('page', 1),
            25,
        );

        return $this->render('toy/list.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
