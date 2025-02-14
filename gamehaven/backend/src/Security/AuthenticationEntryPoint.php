<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class AuthenticationEntryPoint implements AuthenticationEntryPointInterface
{
    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        // If this is the verification endpoint, allow access
        if (str_starts_with($request->getPathInfo(), '/verify/email')) {
            return new Response(null, Response::HTTP_OK);
        }

        // Otherwise, redirect to login
        return new RedirectResponse('/login');
    }
}
