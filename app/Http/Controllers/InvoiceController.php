<?php

namespace App\Http\Controllers;

use App\Models\AccountTransaction;
use App\Models\House;
use App\Models\Invoice;
use App\Models\InvoiceService;
use App\Models\PersonalAccounts;
use App\Models\Service;
use App\Models\ServiceUnit;
use App\Models\Tariff;
use App\Models\TariffService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\directoryExists;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $modelInvoice = new Invoice();
        $modelTransaction = new AccountTransaction();
        $modelAccount= new PersonalAccounts();


        $invoices = $modelInvoice->getInvoices();

        $data['debt'] = $modelAccount->getBalanceDebtTotal();
        $data['total'] = $modelAccount->getBalanceTotal();


        $data['cashBox'] = $modelTransaction->getCashboxBalance();





        foreach ($invoices as $invoice){
            $invoice['dateMonth'] = Carbon::createFromFormat('d-m-Y', $invoice["uid_date"])->locale('ru')->isoFormat('MMMM YYYY');

            foreach ($invoice->invoiceService as $invoiceService){
                $invoice['priceTotal'] += $invoiceService['price'];
            }

        }
      $user = Auth::guard('admin')->user();

      $role = Role::findByName('manager', 'admin');



        //$permissions = $user->getPermissionsViaRoles();







        return view('admin.invoice.main', ['invoices' => $invoices, 'data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $modelInvoice = new Invoice();
        $modelHouse = new House();
        $modelTariff = new Tariff();
        $modelService = new Service();
        $modelServiceUnit = new ServiceUnit();

        $houses = $modelHouse->getHouse();
        $tariffs = $modelTariff->getTariff();
        $services = $modelService->getData();
        $units = $modelServiceUnit->getData();
        $invoiceUid = $modelInvoice->getLastUid();

        $invoiceId = $request->get('invoice_id');
        $invoice = $modelInvoice->getInvoiceIds($invoiceId);
       if (isset($invoice)) {
           foreach ($invoice->invoiceService as $service) {

               $invoice['price'] += $service['price'];
           }
       }

        return view('admin.invoice.create', ['houses' => $houses, 'tariffs' => $tariffs, 'services' => $services,
            'units' => $units, 'invoiceUid' => $invoiceUid, 'invoice' => $invoice]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $modelInvoice = new Invoice();

        $data = $request->all();


        $invoice = $modelInvoice->store($data);
        return redirect()->back()->withSuccess('Успешно!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {

        foreach ($invoice->invoiceService as $service) {

            $invoice['price'] += $service['price'];
        }
        return view('admin.invoice.show', ['invoice' => $invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {


        $modelHouse = new House();
        $modelTariff = new Tariff();
        $modelService = new Service();
        $modelServiceUnit = new ServiceUnit();

        $houses = $modelHouse->getHouse();
        $tariffs = $modelTariff->getTariff();
        $services = $modelService->getData();
        $units = $modelServiceUnit->getData();

        foreach ($invoice->invoiceService as $service) {

            $invoice['price'] += $service['price'];
            }


        return view('admin.invoice.edit', ['houses' => $houses, 'tariffs' => $tariffs, 'services' => $services,
            'units' => $units, 'invoice' => $invoice]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {


        $data = $request->all();


        $invoiceId = $invoice->updates($data, $invoice);
        return redirect()->back()->withSuccess('Успешно!');
    }


    public function removeInvoice(int $id)
    {
        $modelInvoice = new Invoice();

        $invoice = $modelInvoice->getInvoiceIds($id);

        $invoice->delete();

        return redirect()->back()->withSuccess('Успешно!');
    }

    public function invoiceAjaxDelete(Request $request)
    {

       $data = $request->all();
       $modelInvoice = new Invoice();

       $id = $modelInvoice->removeInvoiceMany($data);

        return json_encode($id);
    }


    public function removeInvoiceService(int $id)
    {
        $modelInvoiceService = new InvoiceService();

        $invoice = $modelInvoiceService->removeInvoiceService($id);


        return redirect()->back()->withSuccess('Успешно!');
    }

    public function templates(Request $request)
    {

        dd($request);


    }
}
