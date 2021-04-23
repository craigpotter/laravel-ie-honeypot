<?php
namespace CraigPotter\LaravelIEHoneypot;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CaptureIE
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('ie-honeypot.enabled')) {
            return $next($request);
        }

        if ($request->path() == config('ie-honeypot.redirect_url')) {
            return $next($request);
        }

        if ($this->isIE($request)) {
            return redirect(config('ie-honeypot.redirect_url'));
        }

        return $next($request);
    }

    protected function isIE(Request $request)
    {
        if (Str::of($request->userAgent())->lower()->contains(['msie', 'trident'])) {
            return true;
        }

        return false;
    }
}
