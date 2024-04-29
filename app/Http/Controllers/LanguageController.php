<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\Localization;

class LanguageController extends Controller
{
    public $localization;
    public function __construct(Localization $localization)
    {
        $this->localization = $localization;
    }

    public function changeLocale(Request $request)
    {
        $output = $this->localization->changeLocale($request->locale);
        return $output;
    }
}
