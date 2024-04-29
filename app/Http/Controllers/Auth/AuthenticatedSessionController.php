<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\ActivityLog;
use Jenssegers\Agent\Facades\Agent;
use Stevebauman\Location\Facades\Location;
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('backend.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $ip = '103.133.206.72';
        $currentUserInfo = Location::get($ip);

        $descirption_en = 'Have Loged in '.$currentUserInfo->cityName.', '.$currentUserInfo->countryName.', on '.Agent::platform().', ('.Agent::browser().')';

        $descirption_bn = 'লগইন করেছেন '.$currentUserInfo->cityName.', '.$currentUserInfo->countryName.', ডিভাইস '.Agent::platform().', ('.Agent::browser().')';

        ActivityLog::create([
            'activity' => 'login',
            'slug' => 'login',
            'description_en' => $descirption_en,
            'description_bn' => $descirption_bn,
        ]);

        toastr()->success('Login Successfully',__('common.success'));

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
