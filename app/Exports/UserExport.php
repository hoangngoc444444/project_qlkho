<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Ware;
use App\User;

class UserExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */



    public function __construct()
    {
    }
    public function collection()
    {
        $wares = Ware::with('user')->get();
        $stt = 1;
        foreach ($wares as $row) {
            $ware[] = array(
                '0' => $stt,
                '1' => $row->name,
                '2' => $row->user->name,
                '3' => $row->created_at,
                '4' => $row->updated_at,
            );
            $stt++;
        }
        return (collect($ware));
    }
    public function headings(): array
    {
        return [
            'ID',
            'Tên kho hàng',
            'Người quản lý kho hàng',
            'Thời gian khơi tạo kho hàng',
            'Thời gian cập nhật kho hàng',
        ];
    }
    public function registerEvents(): array
    {
        // $wallet = \Auth::user()->wallet;
        // $id = $wallet->id;
        // $count = Expend::whereMonth('created_at', '=', date($this->month))->where('wallet_id', $id)->get()->count();
        // $count += 2;
        // $total = $count + 1;


        $styleArray = [
            'font' => [
                'bold' => true,
            ]
        ];
        return [
            BeforeSheet::class => function (BeforeSheet $event) use ($styleArray) {
                $event->sheet->setCellValue('A1', 'Danh sách các kho');
            },

            AfterSheet::class => function (AfterSheet $event) use ($styleArray) {
                $event->sheet->getStyle('A2:E2')->applyFromArray($styleArray);
                $event->sheet->getStyle('A1')->applyFromArray($styleArray);
                // $event->sheet->getStyle('E' . $total)->applyFromArray($styleArray);
                // $event->sheet->getStyle('F' . $total)->applyFromArray($styleArray);
                // $event->sheet->setCellValue('F' . $total, '=SUM(F3:F' . $count . ')');
                // $event->sheet->setCellValue('E' . $total, 'Tổng chệnh lệch thu chi tháng ' . $this->month);
            },
        ];
    }
}
