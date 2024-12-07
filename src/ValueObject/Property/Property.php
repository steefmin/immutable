<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Property;

final class Property
{
    private PropertyName  $propertyName;

    /** @var mixed */
    private $value;

    /** @param mixed $value */
    public static function create(string $propertyName, $value): self
    {
        return new self(PropertyName::create($propertyName), $value);
    }

    /** @param mixed $value */
    private function __construct(
        PropertyName  $propertyName,
        $value
    ) {
        $this->propertyName = $propertyName;
        $this->value = $value;
    }

    public function name(): PropertyName
    {
        return $this->propertyName;
    }

    /** @return mixed */
    public function value()
    {
        return $this->value;
    }
}
