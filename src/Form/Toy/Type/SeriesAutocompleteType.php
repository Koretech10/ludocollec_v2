<?php

declare(strict_types=1);

namespace App\Form\Toy\Type;

use App\Entity\Toy\Series;
use App\Form\Core\Type\AjaxAutocompleteType;
use App\Repository\Toy\SeriesRepository;
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
