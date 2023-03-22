<?php

namespace App\Http\Controllers;

use App\Models\WebsiteContact;
use Illuminate\Http\Request;

class WebsiteContactController extends Controller
{
    public function index()
    {
        $modelContact = new WebsiteContact();


        $website = $modelContact->getData();


        return view('website.page.contact.index', ['website' => $website]);

    }

    public function adminContactPage()
    {
        $modelContact = new WebsiteContact();


        $website = $modelContact->getData();


        return view('website.admin.contact.main', ['website' => $website]);

    }

    public function saveWebsiteContact(Request $request){


        $modelContact = new WebsiteContact();


        $data = $request->all();


        $modelContact->create($data);

        return redirect()->back()->withSuccess('Успешно!');
    }
}
