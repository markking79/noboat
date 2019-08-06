<?php

namespace App\Services;

class SessionService
{

    public function value ($key, $default, $request = false)
    {
        if($request && $request->has($key))
            session([$key => $request->get ($key)]);

        $value = session($key, $default);

        return $value;
    }
}