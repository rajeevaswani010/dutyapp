<?php
namespace App\Export;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MissionExport implements FromView{
    private $data;

    public function __construct($data){
        $this->data = $data;
    }

	 public function view(): View{
    	$Data = $this->data;
        return view('Exports.Mission', compact("Data"));
    }
}