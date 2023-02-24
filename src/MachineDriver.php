<?php
declare(strict_types=1);

namespace Kata;

class MachineDriver
{
    public function process(UserRequest $request)
    {
        if($request->drink === "chocolate"){
            return "H::";
        } elseif ($request->drink === "coffee"){
            return "C:2:0";
        }
        return "T:1:0";
    }
}