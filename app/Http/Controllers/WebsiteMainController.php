<?php

namespace App\Http\Controllers;

use App\Helper\ImageSaver;
use App\Models\WebsiteContact;
use App\Models\WebsiteMain;
use App\Models\WebsiteMainConditions;
use App\Models\WebsiteMainSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WebsiteMainController extends Controller
{
    public function index()
    {

        $modelWebsite = new WebsiteMain();
        $modelConditions = new WebsiteMainConditions();
        $modelSlide = new WebsiteMainSlide();

        $modelContact = new WebsiteContact();


        $websiteContact = $modelContact->getData();

        $websiteMain = $modelWebsite->getData();
        $data = $modelSlide->getSlide();
        $conditions = $modelConditions->getAll();




        return view('website.page.index', ['slide' => $data, 'conditions' => $conditions, 'website' => $websiteMain, 'websiteContact' => $websiteContact] );

    }

    public function adminMainPage(){
        $modelWebsite = new WebsiteMain();
        $modelConditions = new WebsiteMainConditions();
        $modelSlide = new WebsiteMainSlide();

        $websiteMain = $modelWebsite->getData();
        $data = $modelSlide->getSlide();
        $conditions = $modelConditions->getAll();




        return view('website.admin.page.main', ['slide' => $data, 'conditions' => $conditions, 'website' => $websiteMain] );
    }

    public function saveWebsiteMain(Request $request){


        $modelWebsite = new WebsiteMain();
        $modelSlide = new WebsiteMainSlide();
        $modelCondition = new WebsiteMainConditions();
        $imageSaved = new ImageSaver();

        $file = $request->file('slide');
        $fileConditions = $request->file('conditions');
        $data = $request->all();


        $modelWebsite->create($data);


        if ($request->file('slide') !== null) {
            foreach ($file as $key => $item) {
                if ($data['pathImage'][$key] !== null) {
                    $imageSaved->remove($data['pathImage'][$key]);
                }
                $path[$key] = $imageSaved->upl($item, 'image');

            }

            $data['slideSave'] = $path;
            $result = $modelSlide->create($data);
        }



        if ($request->file('conditions') !== null) {
            foreach ($fileConditions as $key => $item) {
                if ($data['pathConditionsImage'][$key] !== null) {
                    $imageSaved->remove($data['pathConditionsImage'][$key]);
                }
                $path[$key] = $imageSaved->upl($item, 'image');

            }

            $data['conditionsSave'] = $path;

        }

        $result = $modelCondition->create($data);

        return redirect()->back()->withSuccess('Успешно!');
    }






}
