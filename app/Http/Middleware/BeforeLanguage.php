<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class BeforeLanguage
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language_code = session('language_code');
        $language_id = session('language_id');

        // ===> Session fails to provide language
        if ($language_code === null || $language_id === null)
        {
            // ===> User is authenticated
            if (Auth::check())
            {
                $language = Language::where('id', Auth::user()->language_id)->first();
                $cookie = Cookie::forever('language_id', $language->id);
                session(['language_code' => $language->language_code, 'language_id' => $language->id]);
            }

            // ===> User is not authenticated
            else
            {
                // ===> User has language in cookie
                if (Cookie::get('language_id') != null)
                {
                    $language = Language::where('id', Cookie::get('language_id'))->first();
                    session(['language_code' => $language->language_code, 'language_id' => $language->id]);
                    $cookie = Cookie::forever('language_id', $language->id);
                }

                // ===> User does not have language in cookie
                else
                {
                    // ===> Read Language from browser
                    $http_language_code = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                    $language = Language::where('language_code', $http_language_code)->first();

                    // ===> Browser Language is valid
                    if ($language != null)
                    {
                        session(['language_code' => $language->language_code, 'language_id' => $language->id]);
                        $cookie = Cookie::forever('language_id', $language->id);
                    }

                    /**
                     * Browser Language is not valid
                     * Find the first Language in the database and set it
                     */
                    else
                    {
                        // todo let user select language.
                        $language = Language::orderBy('id', 'asc')->first();
                        $cookie = Cookie::forever('language_id', $language->id);
                        session(['language_code' => $language->language_code, 'language_id' => $language->id]);
                    }
                }
            }
            App::setlocale($language->language_code);
            return $next($request)->cookie($cookie);
        }

        App::setlocale($language_code);
        return $next($request);
    }
}
