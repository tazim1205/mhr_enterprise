<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Jenssegers\Agent\Facades\Agent;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Http;
use App;
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
use DeviceDetector\Parser\OperatingSystem;
use DeviceDetector\Parser\Client\Browser;
use App\Models\Menu;

class BackendController extends Controller
{
    public $path;
    public function __construct()
    {
        $this->path = 'backend.layouts';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::where('status',1)->where('label_id','!=',NULL)->where('type',3)->orderBy('order_by','ASC')->get();
       
     
 


        $data = [];
        $data['total_users'] = User::totalUsers();
        $data['total_roles'] = Role::count();
        // return $data['total_users'];
        return view($this->path.'.home',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function webcam(Request $request)
    {
        $img = $request->image;
        $folderPath = "uploads/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);

        dd('Image uploaded successfully: '.$fileName);
    }

    public function agent()
    {
        AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

        $userAgent = $_SERVER['HTTP_USER_AGENT']; // change this to the useragent you want to parse
        $clientHints = ClientHints::factory($_SERVER); // client hints are optional

        $dd = new DeviceDetector($userAgent, $clientHints);

        $dd->parse();

        if ($dd->isBot()) {
          // handle bots,spiders,crawlers,...
          $botInfo = $dd->getBot();
        } else {
          $clientInfo = $dd->getClient(); // holds information about browser, feed reader, media player, ...
          $osInfo = $dd->getOs();
          $device = $dd->getDeviceName();
          $brand = $dd->getBrandName();
          $model = $dd->getModel();
        }
        return $dd->getDeviceName();
        $osFamily = OperatingSystem::getOsFamily($dd->getOs('name'));
        $browserFamily = Browser::getBrowserFamily($dd->getClient('name'));

        return $browserFamily;
    }


}
