<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'date')]
class Date
{
    public ?\DateTimeInterface $date = null;
    public ?string $dateTimeString = null;
    public ?string $nullMessage = null;
    public bool $hideDay = false;
    public bool $hideMonth = false;
    public bool $hideYear = false;
    public bool $showTime = false;
    public bool $hideHour = false;
    public bool $hideMinute = false;
    public bool $hideSecond = false;

    public function getDate(): string
    {
        $dateTime = $this->getDateTime();

        if (null === $dateTime) {
            return $this->nullMessage ?? '';
        }

        return $dateTime->format($this->getFormat());
    }

    private function getDateTime(): ?\DateTimeInterface
    {
        if ($this->date instanceof \DateTimeInterface) {
            return $this->date;
        }

        if (null !== $this->dateTimeString) {
            return new \DateTimeImmutable($this->dateTimeString);
        }

        return null;
    }

    private function getFormat(): string
    {
        $dateFormat = [];

        if (!$this->hideDay) {
            $dateFormat[] = 'd';
        }

        if (!$this->hideMonth) {
            $dateFormat[] = 'm';
        }

        if (!$this->hideYear) {
            $dateFormat[] = 'Y';
        }

        $dateFormat = \implode('/', $dateFormat);

        $timeFormat = [];

        if (!$this->hideHour) {
            $timeFormat[] = 'H';
        }

        if (!$this->hideMinute) {
            $timeFormat[] = 'i';
        }

        if (!$this->hideSecond) {
            $timeFormat[] = 's';
        }

        $timeFormat = \implode(':', $timeFormat);

        if ($this->showTime) {
            return \sprintf('%s %s', $dateFormat, $timeFormat);
        }

        return $dateFormat;
    }
}
