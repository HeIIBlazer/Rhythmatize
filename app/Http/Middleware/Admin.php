<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        //Для пользователя с ролью admin
        //если роль пользователя НЕ admin - отправим на страницу dashboard
        if ($user && $user->role === 'admin') {
            return $next($request);
        }
        return redirect()->back();
    }
}