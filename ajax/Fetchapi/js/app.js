var resultado = document.getElementById("resultado");
document.getElementById("txtBtn").addEventListener("click",function (){
    resultado.innerHTML="";
    fetch("datos.txt")
    .then(data => data.text())
    .then(res=>{
        if(!res){
            return false;
        } 
        let arr= res.split(" ");
        resultado.innerHTML+=`<ul>`;
        arr.forEach(element => {
            resultado.innerHTML+=`<li> ${element} </li>`;
        });
        resultado.innerHTML+=`</ul>`;
    })
});
document.getElementById("jsonBtn").addEventListener("click",function (){
    resultado.innerHTML="";
    fetch("empleados.json")
    .then(data => data.json())
    .then(res=>{
        if(!res){
            return false;
        } 
        resultado.innerHTML+=`<ul>`;
        res.forEach(element => {
            resultado.innerHTML+=`<li> ${element.nombre}: ${element.puesto} </li>`;
        });
        resultado.innerHTML+=`</ul>`;
    })
});
document.getElementById("apiBTN").addEventListener("click",function (){
    fetch('https://picsum.photos/v2/list?limit=10')
            .then(response => response.json())
            .then(json => {
                let contador=0;
                json.forEach(element => {
                    resultado.innerHTML += `<img src="${element.download_url}" alt="${element.filename}" width="500" height="500" />`;
                    contador++;
                });

            });
});