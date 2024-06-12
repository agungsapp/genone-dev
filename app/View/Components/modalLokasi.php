<?php

namespace App\View\Components;

use App\Models\Kota;
use Illuminate\View\Component;

class modalLokasi extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $lokasis = Kota::all();

        return view('components.modal-lokasi', [
            'lokasis' => $lokasis,
        ]);
    }
}
