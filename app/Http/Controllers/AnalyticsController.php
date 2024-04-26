<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AnalyticsController extends Controller
{
    public function index($appId)
    {
        // Retrieve the user with the specified ID along with their associated apps
        $user = User::with('apps')->find($appId);

        // Initialize arrays to store analytics data
        $totalApps = $user->apps->count();
        $totalAndroidApps = $user->apps->where('app_os', 'Android')->count();
        $totaliOSApps = $user->apps->where('app_os', 'iOS')->count();
        $totalPCGames = $user->apps->where('app_cat', 'PCGames')->count();

        return view('admin.analytics.index', compact('totalApps', 'totalAndroidApps', 'totaliOSApps', 'totalPCGames'));
    }
}
