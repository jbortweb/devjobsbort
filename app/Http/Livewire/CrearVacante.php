<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{

    //Validacion con Livewire
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    protected $rules = [
        "titulo"=> "required|string",
        "salario"=> "required",
        "categoria"=> "required",
        "empresa"=> "required",
        "ultimo_dia"=> "required",
        "descripcion"=> "required",
        "imagen"=> "required|image|max:1024",
    ];

    //Subir archivos con livewire

    use WithFileUploads;


    public function crearVacante(){
        $datos = $this->validate();
    }
    
    public function render()
    
    {

        //Consultar BD

        $salarios= Salario::all();
        $categorias= Categoria::all();
         
        return view('livewire.crear-vacante', [
            'salarios'=> $salarios,
            'categorias'=> $categorias,
        ]);
    }
}
