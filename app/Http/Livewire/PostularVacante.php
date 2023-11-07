<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    public $cv;
    public $vacante;

    use WithFileUploads;

    protected $rules = [
        'cv'=>'required|mimes:pdf',
    ];

    public function mount(Vacante $vacante){
        $this->vacante = $vacante;
        
    }

    public function postularme(){

        $datos = $this->validate();

        //Almacenar cv en el disco duro      
        
        $cv= $this->cv->store('public/cv');
        $datos['cv'] = str_replace('public/cv/','', $cv);
        
        //Crear candidato a la oferta

        $this->vacante->candidatos()->create([
            'user_id'=> auth('')->user()->id,
            'cv' => $datos['cv'],
        ]);
        //Crear notificacion y enviar el email


        //Mostrar el usuario un mensaje de okç

        session()->flash('mensaje','Se envió correctamente tu información, mucha suerte');
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
