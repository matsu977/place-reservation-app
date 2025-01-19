<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        $userRole = auth()->user()->role;

        // unassignedユーザーは、特定のteamルートのみアクセス可能
        if ($userRole === 'unassigned') {
            $allowedRoutes = [
                'team.select',
                'team.create',
                'team.store',
                'team.join',
                'team.join.process'
            ];

            if (!in_array($request->route()->getName(), $allowedRoutes)) {
                return redirect()->route('team.select');
            }
        }
        // team_leaderとmemberは、特定のteamルートにアクセス不可
        elseif (in_array($userRole, ['team_leader', 'member'])) {
            $restrictedRoutes = [
                'team.select',
                'team.create',
                'team.store',
                'team.join',
                'team.join.process'
            ];

            if (in_array($request->route()->getName(), $restrictedRoutes)) {
                return redirect()->route('dashboard');
            }
        }

        // 指定されたロールのいずれかを持っているかチェック
        if (!in_array($userRole, $roles)) {
            return redirect()->route('team.select');
        }

        return $next($request);
    }
}
