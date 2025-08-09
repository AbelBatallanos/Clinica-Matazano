
// Muestra los datos del back al front desde este archivo  "components" 
// Es la parte de renderisar  
export function renderMedico(medicos = []) {
    const contentSelect = document.querySelector(".medicos");
    contentSelect.innerHTML  = "";

    if( !medicos || medicos.length === 0){
        const option = document.createElement("OPTION");
        option.textContent = "Primero debes seleccionar la especialidad";
        option.disabled = true;
        option.selected = true;
        contentSelect.appendChild(option);
        return;
    }

    medicos.forEach( (medico) => {
        const placeholderOption = document.createElement("OPTION");
        placeholderOption.textContent = "Elige tu medico";
        placeholderOption.selected = true;
        placeholderOption.disabled = true;

        const option = document.createElement("OPTION");
        option.textContent = `${medico.usuario.name} ${medico.usuario.lastname}`;
        option.value = medico.id;
        contentSelect.append(placeholderOption ,option);
    })
}