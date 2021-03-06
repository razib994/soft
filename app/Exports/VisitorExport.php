<?php

namespace App\Exports;

use App\Visitor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VisitorExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            "Id",
            'name', 'email',  'phone', 'area',  'land',  'width', 'height',  'store', 'building',  'demand',  'designation', 'organization',  'date',  'remark',  'report',  'contact_person'
        ];
    }
    public function collection()
    {
        return collect(Visitor::getVisitor());
//        return Visitor::all();
    }
}
