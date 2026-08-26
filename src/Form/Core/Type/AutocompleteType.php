<?php

declare(strict_types=1);

namespace App\Form\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Environment;

abstract class AutocompleteType extends AbstractType
{
    protected const string CHOICE_TEMPLATE = '';

    public function __construct(
        protected readonly Environment $twig,
    ) {
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'tom_select_options' => $this->getTomSelectOptions(),
        ]);

        if ('' !== $this::CHOICE_TEMPLATE) {
            $resolver->setDefaults([
                'options_as_html' => true,
                'choice_label' => $this->getTemplatedChoiceLabel(...),
            ]);
        }
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getTemplatedChoiceLabel(object $choice): string
    {
        if ('' === $this::CHOICE_TEMPLATE) {
            return '';
        }

        throw new \BadMethodCallException('La méthode « getTemplatedChoiceLabel() » doit être implémentée si « CHOICE_TEMPLATE » n’est pas vide.');
    }

    /**
     * @param array<string, mixed> $parameters
     */
    protected function renderTemplate(array $parameters): string
    {
        return $this->twig->render($this::CHOICE_TEMPLATE, $parameters);
    }

    private function getTomSelectOptions(): array
    {
        $options = ['plugins' => $this->getTomSelectPlugins()];

        return \array_merge($options, $this->addTomSelectOptions());
    }

    protected function addTomSelectOptions(): array
    {
        return [];
    }

    private function getTomSelectPlugins(): array
    {
        $plugins = ['dropdown_input'];

        return \array_merge($plugins, $this->addTomSelectPlugins());
    }

    protected function addTomSelectPlugins(): array
    {
        return [];
    }
}
