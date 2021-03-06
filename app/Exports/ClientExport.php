<?php

namespace App\Exports;

use App\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            "ID",
            "Project Name",
            "Client Name",
            "Phone",
            "Address",
            "Floor",
            "Apartment",
            "Amount"
        ];
    }
    public function collection()
    {
        return collect(Client::getclient());
//        return Client::all();
    }
}
