<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;


    public function apartaments()
    {
        return $this->belongsTo(Apartaments::class, 'apartaments_id');
    }
    public function tariffs()
    {
        return $this->belongsTo(Tariff::class, 'tariff_id');
    }

    public function invoiceService()
    {
        return $this->hasMany(InvoiceService::class, 'invoice_id');
    }

    public function getLastUid()
    {
        return $this->latest()->first()->uid;
    }

    public function getInvoices()
    {
        return $this->all();
    }

    public function getInvoiceIds($id)
    {
        return $this->find($id);
    }


    public function store(array $data)
    {


        $this->uid = $data['invoice']['number'];
        $this->uid_date = $data['invoice']['uid_date'];
        $this->period_start = date("Y-m-d", strtotime($data['invoice']['period_start']));
        $this->period_end = date("Y-m-d", strtotime($data['invoice']['period_end']));
        $this->status = $data['invoice']['status'];
        $this->is_checked = $data['invoice']['is_checked'];
        $this->apartaments_id = $data['invoice']['apartamets_id'];
        $this->tariff_id = $data['invoice']['tariff_id'];


        $this->save();

        $id = $this->id;

        InvoiceService::store($data, $id);

        $transactionModel = new AccountTransaction();

        $transactionModel->storeInvoice($data, $id);

        return $id;

    }

    public function updates(array $data, Invoice $invoice)
    {


        $invoice->uid = $data['invoice']['number'];
        $invoice->uid_date = $data['invoice']['uid_date'];
        $invoice->period_start = date("Y-m-d", strtotime($data['invoice']['period_start']));
        $invoice->period_end = date("Y-m-d", strtotime($data['invoice']['period_end']));
        $invoice->status = $data['invoice']['status'];
        $invoice->is_checked = $data['invoice']['is_checked'];
        $invoice->apartaments_id = $data['invoice']['apartamets_id'];
        $invoice->tariff_id = $data['invoice']['tariff_id'];


        $invoice->save();

        $id = $invoice->id;

        InvoiceService::store($data, $invoice->id);

        $transactionModel = new AccountTransaction();

        $transactionModel->updateInvoice($data, $id);

        return $id;

    }


    public function removeInvoiceMany(array $data)
    {

        return $this->destroy($data['ids']);
    }
}
