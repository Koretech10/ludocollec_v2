<?php

declare(strict_types=1);

namespace App\Form\Toy\Type;

use App\Entity\Toy\Series;
use App\Enum\Toy\Brand;
use App\Form\Core\Type\AjaxAutocompleteType;
use App\Repository\Toy\SeriesRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;

#[AsEntityAutocompleteField]
class SeriesAutocompleteType extends AjaxAutocompleteType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'label' => 'Série',
            'class' => Series::class,
            'placeholder' => 'Sélectionner une série de jouets vidéo',
            'query_builder' => static function (SeriesRepository $repository) {
                return $repository->findAllQueryBuilder();
            },
            'filter_query' => static function (QueryBuilder $qb, string $query): void {
                if ('' === $query) {
                    return;
                }

                $rootAlias = $qb->getRootAliases()[0];

                $or = $qb->expr()->orX(
                    $qb->expr()->like(\sprintf('%s.name', $rootAlias), ':query'),
                );
                $qb->setParameter('query', \sprintf('%%%s%%', $query));

                $brands = Brand::searchFromLabel($query);
                if ([] !== $brands) {
                    $or->add($qb->expr()->in(\sprintf('%s.brand', $rootAlias), ':brands'));
                    $qb->setParameter('brands', \array_map(static fn (Brand $brand): int => $brand->value, $brands));
                }

                $qb->andWhere($or);
            },
            'options_as_html' => true,
            'choice_label' => function (Series $series): string {
                return $this->getTemplatedChoiceLabel($series);
            },
        ]);
    }

    public function getTemplatedChoiceLabel(object $choice): string
    {
        /** @var Series $series */
        $series = $choice;

        return $this->twig->render('toy/type/series_autocomplete_type.html.twig', [
            'series' => $series->getName(),
            'brand' => $series->getBrand()->label(),
        ]);
    }
}
