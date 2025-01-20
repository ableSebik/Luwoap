<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
  /**
   * Display the login view.
   */
  public function create(): View
  {
    return view('auth.login');
  }

  /**
   * Handle an incoming authentication request.
   */
  // public function store(LoginRequest $request): RedirectResponse
  // {
  //   $request->authenticate();

  //   $request->session()->regenerate();

  //   // Validate the redirect URL to avoid unexpected or unsafe redirections
  //   $redirectUrl = $request->input('redirect');

  //   if ($redirectUrl && filter_var($redirectUrl, FILTER_VALIDATE_URL)) {
  //     return redirect()->intended($redirectUrl);
  //   }

  //   return redirect()->intended(RouteServiceProvider::HOME);
  // }

  public function store(LoginRequest $request): RedirectResponse
  {
    $request->authenticate();

    $request->session()->regenerate();

    // Validate and sanitize the redirect URL to ensure it is safe
    $redirectUrl = $request->input('redirect');

    if ($redirectUrl && filter_var($redirectUrl, FILTER_VALIDATE_URL)) {
      // Check if the redirect URL is within the same domain
      $parsedUrl = parse_url($redirectUrl);
      $host = $parsedUrl['host'] ?? null;

      if ($host && $host === parse_url(config('app.url'), PHP_URL_HOST)) {
        return redirect()->intended($redirectUrl);
      }
    }

    // Fallback to home if no valid redirect URL is provided
    return redirect()->intended(RouteServiceProvider::HOME);
  }


  /**
   * Destroy an authenticated session.
   */
  public function destroy(Request $request): RedirectResponse
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
