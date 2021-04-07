<?php

namespace Colorninja\Normalizer;

use Colorninja\Exception\NormalizeException;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;

class DateTimeNormalizer implements INormalizer
{
    public function __construct(private string $preferredType = DateTimeImmutable::class,
                                string $preferredFormat = DATE_ATOM)
    {
    }


    /**
     * @param mixed $value
     * @param string $type
     * @return DateTimeInterface|DateTimeImmutable|DateTime
     * @throws NormalizeException
     */
    public function normalize(mixed $value, string $type): DateTimeImmutable|DateTime|DateTimeInterface
    {
        // Try to normalize into one of the following classes
        try {
            if ($type === DateTimeImmutable::class) {
                return new DateTimeImmutable($value);
            }

            if ($type === DateTime::class) {
                return new DateTime($value);
            }

            if ($type === DateTimeInterface::class) {
                return new $this->preferredType($value);
            }
        } catch (Exception) {
        }

        throw new NormalizeException('Unable to normalize datetime');
    }

    public function getSupportedTypes(): array
    {
        return [
            DateTimeImmutable::class,
            DateTime::class,
            DateTimeInterface::class,
        ];
    }
}