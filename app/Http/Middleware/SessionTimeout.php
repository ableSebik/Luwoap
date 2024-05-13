<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;

class SessionTimeout
{
    protected $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle($request, Closure $next)
    {
        // Get last activity time from the session
        $lastActivity = $this->session->get('last_activity');

        // Check if last activity time is set and has exceeded the session lifetime
        if ($lastActivity && time() - $lastActivity > config('session.lifetime') * 30) {
            // Clear the session data
            $this->session->flush();

            // Redirect the user to the login page or any other page
            return redirect()->route('login')->with('session_timeout', 'Your session has expired. Please log in again.');
        }

        // Update last activity time in the session
        $this->session->put('last_activity', time());

        return $next($request);
    }
}
