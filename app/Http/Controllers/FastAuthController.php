<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\UnauthorizedException;
use M1guelpf\FastLogin\Events\FastLoginLogIn;
use M1guelpf\FastLogin\FastLoginServiceProvider;
use M1guelpf\FastLogin\Http\Controllers\FastLoginController;
use Psr\Http\Message\ServerRequestInterface as CredentialRequest;
use Webauthn\AuthenticatorAssertionResponse as LoginResponse;
use Webauthn\AuthenticatorAssertionResponseValidator as LoginValidator;
use Webauthn\PublicKeyCredentialLoader as CredentialLoader;
use Webauthn\PublicKeyCredentialRequestOptions as LoginRequest;

class FastAuthController extends FastLoginController
{
    public function login(Request $request, CredentialLoader $credentialLoader, LoginValidator $loginValidator, CredentialRequest $credentialRequest)
    {
        $credentials    = $credentialLoader->loadArray($request->all())->getResponse();
        $requestOptions = LoginRequest::createFromArray(Cache::pull($this->getCacheKey()));

        if (!$requestOptions || !$credentials instanceof LoginResponse) {
            throw new UnauthorizedException('FastLogin: Failed validating request', 422);
        }

        $response['message'] = $request->all();
        return response()->json($response);

        try {
            $response = $loginValidator->check($request->cookie(FastLoginServiceProvider::FASTLOGIN_COOKIE), $credentials, $requestOptions, $credentialRequest, null, [$requestOptions->getRpId()]);
        } catch (InvalidArgumentException $e) {
            throw new UnauthorizedException('FastLogin: Failed validating request', 422, $e);
        }

        $authenticatable = Auth::loginUsingId(intval($response->getUserHandle()));

        if ($authenticatable instanceof Authenticatable) {
            // Dispatch event that we have logged in via FastLogin.
            FastLoginLogIn::dispatch($authenticatable);
        }

        return response()->noContent();
    }
}
