<?php

namespace App\Services;

class SessionService
{

    public function value ($key, $default, $request)
    {
        if($request->has($key))
            session([$key => $request->get ($key)]);

        $value = session($key, $default);

        return $value;
    }
}