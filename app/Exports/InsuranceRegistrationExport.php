<?php
namespace App\Exports;

use App\Models\User;
use App\Models\InsuranceRegistrationModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class InsuranceRegistrationExport implements FromCollection, WithHeadings, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect([$this->data]);
    }


    //Set header names
    public function headings(): array
    {
        return [
            'ID',
            'NAME',
            'EMAIL ADDRESS',
            'DATE',
            'TIME'
        ];
    }

    // public function collection()
    // {
    //     $user = [
    //         'id'     => "1",
    //         'name'     => "Airi Satou",
    //         'email'    => "Accountant@yahoo.com",
    //         'date'      => date('m-m-Y'),
    //         'Status'    => 'Active'
    //     ];
    //     //return User::all();
    //     return collect([$user]);
    // }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:D1')
                    ->getFill()
                    //->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFA500');

                 $event->sheet->getDelegate()->freezePane('A2');
            },
        ];
    }
}
