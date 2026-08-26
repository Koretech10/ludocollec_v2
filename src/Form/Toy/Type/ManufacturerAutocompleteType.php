<?php

declare(strict_types=1);

namespace App\Form\Toy\Type;

use App\Entity\Toy\Manufacturer;
use App\EventSubscriber\Form\Toy\ManufacturerCreatedSubscriber;
use App\Form\Core\Type\AjaxAutocompleteType;
use App\Repository\Toy\ManufacturerRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Twig\Environment;

#[AsEntityAutocompleteField]
class ManufacturerAutocompleteType extends AjaxAutocompleteType
{
    public function __construct(
        private readonly ManufacturerCreatedSubscriber $subscriber,
        Environment $twig,
    ) {
        parent::__construct($twig);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventSubscriber($this->subscriber);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'label' => 'Fabricant',
            'class' => Manufacturer::class,
            'query_builder' => static function (ManufacturerRepository $repository): QueryBuilder {
                return $repository->findAllQueryBuilder();
            },
            'placeholder' => 'Sélectionner un fabricant',
        ]);
    }

    protected function addTomSelectOptions(): array
    {
        return [
            'create' => true,
        ];
    }
}
