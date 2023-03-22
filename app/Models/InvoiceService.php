<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceService extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function getInvoiceServiceIds(int $id):InvoiceService
    {
        return $this->find($id);
    }

    public function store(array $data, int $id)
    {

        $arraySave = array();

        foreach ($data['invoiceService'] as $key => $item) {

            $arraySave[] = [
                'id' => $item['id'], 'amount' => $item['amount'],
                'price_unit' => $item['price_unit'], 'price' => $item['price'],
                'invoice_id' => $id, 'service_id' => $item['service_id'],
            ];


        }



        $result = InvoiceService::upsert($arraySave, ['id'], ['amount', 'price_unit', 'price', 'invoice_id', 'service_id']);

        return $result;

    }

    public function removeInvoiceService(int $id)
    {
       $invoiceService = $this->getInvoiceServiceIds($id);
        return $invoiceService->delete();
    }


}
