<?php

namespace App\Repositories;
use App\Interfaces\Localization;
use App;

class LocalizationRepository implements Localization
{
    public function changeLocale($locale)
    {
        // return $locale;
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
