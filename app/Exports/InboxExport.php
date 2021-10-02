<?php

namespace App\Exports;

use App\Models\Inbox;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InboxExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;

    public function __construct(array $condition)
    {
        $this->condition = $condition;
    }

    public function collection()
    {
        $condition = $this->condition;
        $data = Inbox::select('created_at','name','email','phone','subject','message')->whereDate('created_at', '>=', $condition['created_at_from'])->whereDate('created_at', '<=', $condition['created_at_to']);
        if (isset($condition['flag_read']) AND !empty($condition['flag_read'])) { $data->where('flag_read', 'like', '%'.$condition['flag_read'].'%'); }
        if (isset($condition['email']) AND !empty($condition['email'])) { $data->where('email', 'like', '%'.$condition['email'].'%'); }
        if (isset($condition['phone']) AND !empty($condition['phone'])) { $data->where('phone', 'like', '%'.$condition['phone'].'%'); }
        if (isset($condition['subject']) AND !empty($condition['subject'])) { $data->where('subject', 'like', '%'.$condition['subject'].'%'); }
        if (isset($condition['name']) AND !empty($condition['name'])) { $data->where('name', 'like', '%'.$condition['name'].'%'); }
        $data = $data->orderBy('id','desc')->get();
        return $data;
    }

    public function headings(): array
    {
        return array_keys($this->collection()->first()->toArray());
    }
}
