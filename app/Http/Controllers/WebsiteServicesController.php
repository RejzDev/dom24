<?php

namespace App\Http\Controllers;

use App\Helper\ImageSaver;
use App\Models\WebsiteServices;
use App\Models\WebsiteServicesPage;
use Illuminate\Http\Request;

class WebsiteServicesController extends Controller
{
    public function index()
    {
        $modelServices = new WebsiteServices();
        $modelServicesPage = new WebsiteServicesPage();



        $websiteServices = $modelServices->getServicesPaginate();
        $websiteServicesPage = $modelServicesPage->getData();


        return view('website.page.services.index', ['websiteServices' => $websiteServices, 'website' => $websiteServicesPage]);

    }

    public function adminServicesPage()
    {
        $modelServices = new WebsiteServices();
        $modelServicesPage = new WebsiteServicesPage();



        $websiteServices = $modelServices->getServices();
        $websiteServicesPage = $modelServicesPage->getData();


        return view('website.admin.services.main', ['websiteServices' => $websiteServices, 'website' => $websiteServicesPage]);

    }

    public function saveWebsiteServices(Request $request){


        $request->validate([
            'slide.*' => 'mimes:jpeg,jpg,png,svg|max:5000',
            'conditions.*' => 'mimes:jpeg,jpg,png,svg|max:5000',

        ]);

        $modelWebsiteServices = new WebsiteServices();
        $modelWebsiteServicesPage = new WebsiteServicesPage();
        $imageSaved = new ImageSaver();


        $data = $request->all();



        if ($request->file('websiteServices') !== null) {
            $file= $request->file('websiteServices');
            foreach ($file as $key => $item) {
                if ($data['pathWebsiteServicesImage'][$key] !== null) {
                    $imageSaved->remove($data['pathWebsiteServicesImage'][$key]);
                }
                $path[$key] = $imageSaved->upl($item, 'services');

            }

            $data['servicesSave'] = $path;

        }

        $result = $modelWebsiteServices->create($data);
        $modelWebsiteServicesPage->create($data);

        return redirect()->back()->withSuccess('Успешно!');
    }

    public function removeServices($id)
    {
        $services = new WebsiteServices();
        $imageSaved = new ImageSaver();

        $patch = $services->getServicesIds($id);
        $imageSaved->remove($patch['image']);
        $services->deleteServices($id);

        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
