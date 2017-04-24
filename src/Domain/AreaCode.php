<?php

namespace Mannion007\LongRunningProcess\Domain;

class AreaCode
{
    private $areaCode;

    public function __construct(string $areaCode)
    {
        if (strlen($areaCode) !== 5) {
            throw new \InvalidArgumentException('Area code must be 5 digits long');
        }
        $this->areaCode = $areaCode;
    }

    public static function fromExisting(string $existing) : AreaCode
    {
        return new self($existing);
    }

    public function equals(AreaCode $other) : bool
    {
        return (string)$other === $this->areaCode;
    }

    public function __toString()
    {
        return $this->areaCode;
    }
}