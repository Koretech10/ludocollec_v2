<?php

declare(strict_types=1);

namespace App\Controller;

use App\Builder\Core\DataGrid\DataGridBuilder;
use App\Collection\Core\DataGridHeaderCollection;
use App\Command\Toy\CreateToyCommand;
use App\Entity\Toy\Toy;
use App\Entity\User\User;
use App\Form\Toy\CreateToyType;
use App\Form\Toy\Filter\ToyFilterType;
use App\Model\Core\DataGrid\DataGridConfig;
use App\Model\Core\DataGrid\DataGridHeader;
use App\Presenter\Toy\ShowToyPresenter;
use App\Repository\Toy\ToyRepository;
use Huluti\BreadcrumbsBundle\Attribute\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/toy')]
#[Breadcrumb(text: 'Jouets vidéo', route: 'toy.list')]
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
            headers: new DataGridHeaderCollection([
                new DataGridHeader('Nom', 'toy.name'),
                new DataGridHeader('Série', 'series.name'),
                new DataGridHeader('Fabricant', 'manufacturer.name'),
                new DataGridHeader('Sortie', 'toy.releaseDate', true),
            ]),
            filterType: ToyFilterType::class,
        );

        $dataGrid = $this->dataGridBuilder->build($config, $request);

        return $this->render('toy/list.html.twig', [
            'data_grid' => $dataGrid,
            'title' => 'Jouets vidéo',
        ]);
    }

    #[Route('/show/{id}', name: 'toy.show')]
    #[Breadcrumb(text: '{toy.title}', route: 'toy.show', parameters: ['id' => '{toy.id}'])]
    public function show(Toy $toy, ShowToyPresenter $presenter): Response
    {
        return $this->render('toy/show.html.twig', $presenter->getParameters([
            'toy' => $toy,
            'title' => $toy->title(),
            'content_title' => $toy->title(),
            'user' => $this->getUser(),
        ]));
    }

    #[Route('/create', name: 'toy.create')]
    #[Breadcrumb(text: 'Nouveau jouet vidéo', route: 'toy.create')]
    // ToDo Voter
    public function create(Request $request, #[CurrentUser] User $user): Response
    {
        $command = new CreateToyCommand($user);

        $form = $this->createForm(CreateToyType::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        }

        return $this->render('toy/create.html.twig', [
            'title' => 'Nouveau jouet vidéo',
            'content_title' => 'Nouveau jouet vidéo',
            'form' => $form->createView(),
        ]);
    }
}
