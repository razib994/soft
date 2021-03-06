<?php

namespace App\Exports;


use App\ProjectPayment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectPaymentExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            "ID",
            "Project Name",
            "Category Name",
            "Bank Name",
            "Item Name",
            "Date",
            "Amount",
            "Note",
        ];
    }
    public function collection()
    {
        return collect(ProjectPayment::getProjectPayment());
        //return ProjectPayment::all();
    }
}
