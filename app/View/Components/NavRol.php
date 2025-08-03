<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class NavRol extends Component
{
    public $nav_rol = '';
    /**
     * Create a new component instance.
     */
    public function __construct($datarol)
    {
        //
        switch($datarol){

            case "admin":
                $this->nav_rol = '
                    <a href="'. route("home") .'"><i class="bi bi-house"></i> Inicio</a>
                    <a href="'. route("listUsuarios") .'"><i class="bi bi-people"></i> Pacientes</a>
                    <a href="'. route("crearCita") .'"><i class="bi bi-calendar-check"></i> Reservas</a>
                    <a href="'. route("HistorialesClinicos") .'"><i class="bi bi-journal-medical"></i> Historiales</a>
                    <a href="'. route("VerHistorialClinico") .'"><i class="bi bi-journal-medical"></i> Reportes</a>';
                break;

            case "secretaria":
                 $this->nav_rol = ' <a href="'. route("home") .'"><i class="bi bi-house"></i> Inicio</a>
                    <a href="'. route("listUsuarios") .'"><i class="bi bi-people"></i> Pacientes</a>
                    
                    <a href="'. route("crearCita") .'"><i class="bi bi-calendar-check"></i> Citas Medicas</a>
                    <a href="'. route("HistorialesClinicos") .'"><i class="bi bi-journal-medical"></i> Historiales</a>
                    ';
                break;

            case "medico":
                 $this->nav_rol = '<a href="{{ route("home") }}"><i class="bi bi-house"></i> Inicio</a>
                    <a href="'. route("listUsuarios") .'"><i class="bi bi-people"></i> Pacientes</a>
                    <a href="'. route("crearCita") .'"><i class="bi bi-calendar-check"></i> Reservas</a>
                    <a href="'. route("HistorialesClinicos") .'"><i class="bi bi-journal-medical"></i> Historiales</a>
                    <a href="'. route("HistorialesClinicos") .'"><i class="bi bi-journal-medical"></i> Medico</a>';
                break;
                
            case "paciente":
                 $this->nav_rol = '
                    <a href="'. route("home") .'"><i class="bi bi-house"></i> Inicio</a>
                    <a href="'. route("crearCita") .'"><i class="bi bi-calendar-check"></i> Reservas</a>
                    <a href="'. route("HistorialesClinicos") .'"><i class="bi bi-journal-medical"></i> Historiales</a>
                    <a href="'. route("HistorialesClinicos") .'"><i class="bi bi-journal-medical"></i> Paciente</a>';
                break;
        }

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-rol');
    }
}
