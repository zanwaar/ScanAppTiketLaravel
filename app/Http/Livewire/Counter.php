<?php

namespace App\Http\Livewire;

use App\Models\Etiket;
use Livewire\Component;

class Counter extends Component
{
    public $nsearch = null;
    public function fsearch()
    {
        $ada = Etiket::latest()
            ->where('barcode', $this->nsearch)
            ->orwhere('nocode', $this->nsearch);
        //return response
        if ($ada->count() > 0) {
            $data = $ada->get();
            if ($data[0]['status'] === 1) {
                return $this->dispatchBrowserEvent('alert', [
                    'icon' => 'warning',
                    'title' => 'Telah Terpakai',
                    'success' => 'Tiket Tidak Berlaku Lagi',
                ]);
            } else {
                $ada->update([
                    'status' => 1,
                ]);
                return $this->dispatchBrowserEvent('alert', [
                    'icon' => 'success',
                    'title' => 'Tiket valid',
                    'success' => 'Berhasil ditambahkan',
                ]);
            }
        }
        return $this->dispatchBrowserEvent('alert-danger', [
            'icon' => 'success',
            'title' => 'Tiket valid',
            'success' => 'Berhasil ditambahkan',
        ]);
        // $s = Etiket::Where('id', $this->nsearch)->first();

        // dd($s);
    }
    public function render()
    {
        $ada1 = Etiket::latest()->where(['status' => 1, 'jenis' => 'TIKET FISIK']);
        $ada2 = Etiket::latest()->where(['status' => 1, 'jenis' => 'TIKET EARLY BIRD']);
        $ada3 = Etiket::latest()->where(['status' => 1, 'jenis' => 'TIKET OTS']);
        return view('livewire.counter', ['data1' => $ada1->count(), 'data2' => $ada2->count(), 'data3' => $ada3->count()]);
    }
}
