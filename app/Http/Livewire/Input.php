<?php

namespace App\Http\Livewire;

use App\Models\Etiket;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Input extends Component
{
    public $state = [];
    public function create()
    {
        Validator::make($this->state, [
            'jenis' => 'required',
            'ket' => 'required',
        ])->validate();
        Etiket::create([
            'jenis' => $this->state['jenis'],
            'ket' => $this->state['ket'],
            'status' => 1,
            'nocode' => 'Manual',
            'barcode' => 'No Barcode',
        ]);
        $this->reset();
       return $this->dispatchBrowserEvent('alert-tes', [
            'icon' => 'success',
            'title' => 'Manual',
            'success' => 'Berhasil ditambahkan',
        ]);
       
    }
    public function render()
    {
        $ada1 = Etiket::latest()->where(['status' => 1, 'jenis' => 'TIKET FISIK']);
        $ada2 = Etiket::latest()->where(['status' => 1, 'jenis' => 'TIKET EARLY BIRD']);
        $ada3 = Etiket::latest()->where(['status' => 1, 'jenis' => 'TIKET OTS']);
        return view('livewire.input', ['data1' => $ada1->count(), 'data2' => $ada2->count(), 'data3' => $ada3->count()]);
    }
}
