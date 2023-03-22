<?php

namespace App\Http\Controllers;

use App\Helper\ImageSaver;
use App\Models\WebsiteAbout;
use App\Models\WebsiteAboutDocument;
use App\Models\WebsiteAboutGalery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WebsiteAboutController extends Controller
{
    public function index()
    {
        $modelAbout = new WebsiteAbout();
        $modelAboutGallery = new WebsiteAboutGalery();
        $modelAboutDocument = new WebsiteAboutDocument();


        $website = $modelAbout->getData();

        $aboutGallery= $modelAboutGallery->getGallery();
        $aboutDopGallery = $modelAboutGallery->getDopGallery();

        $aboutDocument = $modelAboutDocument->getDocument();



        return view('website.page.about.index', ['website' => $website, 'aboutGallery' => $aboutGallery,
            'aboutDopGallery' => $aboutDopGallery, 'aboutDocument' => $aboutDocument]);

    }

    public function adminAboutPage()
    {
        $modelAbout = new WebsiteAbout();
        $modelAboutGallery = new WebsiteAboutGalery();
        $modelAboutDocument = new WebsiteAboutDocument();


        $website = $modelAbout->getData();

        $aboutGallery= $modelAboutGallery->getGallery();
        $aboutDopGallery = $modelAboutGallery->getDopGallery();

        $aboutDocument = $modelAboutDocument->getDocument();



        return view('website.admin.about.main', ['website' => $website, 'aboutGallery' => $aboutGallery,
            'aboutDopGallery' => $aboutDopGallery, 'aboutDocument' => $aboutDocument]);

    }

    public function saveWebsiteAbout(Request $request)
    {


        $request->validate([
            'websiteAboutImage' => 'mimes:jpeg,jpg,png,svg|max:5000',
            'websiteAboutGallery.*' => 'mimes:jpeg,jpg,png,svg|max:5000',
            'websiteAboutDocument.*' => 'mimes:jpeg,pdf,jpg|max:20000',
            'websiteDocumentTitle.*' => 'required',

        ]);

        $modelAbout = new WebsiteAbout();
        $modelAboutGallery = new WebsiteAboutGalery();
        $modelAboutDocument = new WebsiteAboutDocument();
        $imageSaved = new ImageSaver();


        $data = $request->all();

        if ($request->file('websiteAboutImage') !== null) {
            $file = $request->file('websiteAboutImage');

                if ($data['pathWebsiteAboutImage'] !== null) {
                    $imageSaved->remove($data['pathWebsiteAboutImage']);
                }
            $data['pathImage'] = $imageSaved->upl($file, 'aboutImg');

            }

        if ($request->file('websiteAboutGallery') !== null) {

            $file = $request->file('websiteAboutGallery');
            foreach ($file as $key => $item) {
                $path[$key] = $imageSaved->upl($item, 'aboutImg');
            }

            $data['aboutGallery'] = $path;


           $aboutGallery = $modelAboutGallery->saveGallery($data);
        }


        if ($request->file('websiteAboutDocument') !== null) {

            $file = $request->file('websiteAboutDocument');
            foreach ($file as $key => $item) {
                $path[$key] = $imageSaved->upl($item, 'aboutDocument');
            }

            $data['aboutDocument'] = $path;


            $arrDocument = array();

            if (count($data['aboutDocument']) > 1) {
                foreach ($data['aboutDocument'] as $key => $item){
                    $arrDocument[] =  ['patch' => $item, 'title' => $data['websiteDocumentTitle'][$key]];
                }
            } else{
                foreach ($data['aboutDocument'] as $key => $item){
                    $arrDocument =  ['patch' => $item, 'title' => $data['websiteDocumentTitle'][$key]];
                }
            }



            $aboutDocument = $modelAboutDocument->saveDocument($data);
        }


        $modelAbout->create($data);

        return redirect()->back()->withSuccess('Успешно!');
    }

    public function removeImageGallery($id)
    {
        $aboutGallery = new WebsiteAboutGalery();
        $imageSaved = new ImageSaver();

        $patch = $aboutGallery->getGalleryIds($id);
        $imageSaved->remove($patch['image']);
        $aboutGallery->deleteImage($id);

        return redirect()->back()->withSuccess('Успешно удалено');
    }

    public function removeDocument($id)
    {
        $aboutDocument = new WebsiteAboutDocument();
        $imageSaved = new ImageSaver();

        $patch = $aboutDocument->getDocumentIdsIds($id);
        $imageSaved->remove($patch['patch']);
        $aboutDocument->deleteDocument($id);

        return redirect()->back()->withSuccess('Успешно удалено');
    }

    public function downloadDocument($id)
    {
        $aboutDocument = new WebsiteAboutDocument();

        $document = $aboutDocument->getDocumentIds($id);

        return Storage::disk('public')->download($document['patch'], $document['title']);
    }


}
