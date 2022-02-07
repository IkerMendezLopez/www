const boton =  document.getElementById("btnEnviar");
window.onload= function(){
    fetch("persona.json")
    .then(data => data.json())
    .then(res => {
        nombre.value= res.nombre;
        apellidos.value= res.apellidos;
        profesion.value= res.profesion;
    });
}
boton.addEventListener("click", function (e){ 
    e.preventDefault();

    let data =new FormData(document.getElementById("formulario"));
    console.log(data);
    fetch('php/json.php', {
        method: 'POST',
        body: data
     })
     .then(data => data.json())
     .then(res => console.log(res));
})