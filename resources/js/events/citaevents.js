import {CitaService} from "../services/citaservice.js";
import {renderMedico} from '../components/MedicoRenderer.js';

// Actua como el controlador , donde valida si existen siertas etiquetas en el Dom
// Si no existen entonces no ejecuta lo demas  

export function initCitaEvent(){
    const selectEspecialidads = document.querySelector(".especialidades");

    const citaServicio = new CitaService(); 

    if(!selectEspecialidads) return ;  //Impide que surgan errores

    selectEspecialidads.addEventListener("change", async ()=>{
        const especialidad_id = selectEspecialidads.value;
        console.log(especialidad_id)
        try{
            const medicos = await citaServicio.MedicoPorEspecGet(especialidad_id);
            console.log(medicos[0]);
            renderMedico(medicos);
        }catch(error){
            console.error("Error al consultar", error.message);
        }
    });
}