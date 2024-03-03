<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
  public function handle(Request $request, Closure $next, string $role)
  {
    $user_role = auth()->user()->role_id;

    if ($role == 'supadmin' && $user_role != UserRole::SUPER_ADMIN) {
      return abort(401);
    }

    if (
      $role == 'admin' &&
      $user_role != UserRole::SUPER_ADMIN &&
      $user_role != UserRole::ADMIN
    ) {
      return abort(401);
    }

    return $next($request);
  }
}
