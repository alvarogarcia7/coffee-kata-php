<?php

namespace Kata;

class Drink
{

    public function __construct(
        public readonly string $name,
        public readonly float  $price,
        public readonly bool   $canBeExtraHot,
        public readonly string $commandRepresentation)
    {
    }

    public function toCommand($isExtraHot): string
    {
        $commandRepresentation = $this->commandRepresentation;
        if($this->canBeExtraHot && $isExtraHot){
            $parts = explode(":", $this->commandRepresentation);
            $parts[0] .= "h";
            $commandRepresentation = implode(":", $parts);
        }
        return $commandRepresentation;

    }
}