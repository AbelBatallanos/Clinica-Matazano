

export class ApiService{
    
    constructor(){
        this.baseUrl = "http://localhost/Clinica_Matazano/public/api";
    }


    async post(endpoint, dataObj){
        console.log(`${this.baseUrl}${endpoint} `)
        console.log(dataObj);
        try {
            const response = await fetch(`${this.baseUrl}${endpoint}`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(dataObj)
                });
            return await response.json();
        } catch (error) {
             console.error("Error al conectarse con la API ", error.message);
            return null;
        }
        
    }
}