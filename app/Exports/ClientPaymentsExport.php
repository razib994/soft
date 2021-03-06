<?php

namespace App\Exports;

use App\ClientPayment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientPaymentsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            "ID",
            "Client Name",
            "Date",
            "Amount",
            "Payment Method",
            "Note",
        ];
    }

    public function collection()
    {
        return collect(ClientPayment::getClientPayment());
        //return ClientPayment::all();
    }


}
