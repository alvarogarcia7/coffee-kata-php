<?php
declare(strict_types=1);

namespace Kata;

class MachineDriver
{
    public function process(UserRequest $request)
    {
        if($request->drink === "chocolate"){
            return "H::";
        }
        return "T:1:0";
    }
}