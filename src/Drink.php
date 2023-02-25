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

    public function toCommand($isExtraHot, $sugarLevel): string
    {
        [$drinkRepresentation, $sugarRepresentation, $stickRepresentation] = explode(":", $this->commandRepresentation);
        if($this->canBeExtraHot && $isExtraHot){
            $drinkRepresentation .= "h";
        }
        if ($sugarLevel === 0) {
            $sugarRepresentation = "";
            $stickRepresentation = "";
        }
        if ($sugarLevel > 0) {
            $sugarRepresentation = (string) $sugarLevel;
            $stickRepresentation = "0";
        }
        $commandRepresentation = $this->joinRepresentations([$drinkRepresentation, $sugarRepresentation, $stickRepresentation]);
        return $commandRepresentation;
    }

    private function joinRepresentations($parts): string
    {
        return implode(":", $parts);
    }
}