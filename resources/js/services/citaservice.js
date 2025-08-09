import { ApiService } from "./apiservice.js";


export class CitaService extends ApiService {
    constructor() {
        super();
    }

    async MedicoPorEspecGet(especialidad_id){
        
      return await this.post("/Cita-Medica/medico_especialidad", {especialidad_id: parseInt(especialidad_id)} );
    }
   
}