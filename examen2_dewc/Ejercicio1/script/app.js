window.onload = function () {
    const select1 = document.getElementById("opcion1");
    const select2 = document.getElementById("opcion2");
    const select3 = document.getElementById("opcion3");
    const boton = document.getElementById("precio");
    select1.addEventListener("change", function (){
        if(select1.options[select1.selectedIndex].value==0){
            document.getElementById("divopcion2").style.display="none";
            document.getElementById("divopcion3").style.display="none";
            boton.setAttribute("disabled", "disabled");
        }else{
            cargaSelect("opcion2");
        }
    })
    select2.addEventListener("change", function (){
        if(select2.options[select2.selectedIndex].value==0){
            document.getElementById("divopcion3").style.display="none";
            boton.setAttribute("disabled", "disabled");
        }else{
            cargaSelect("opcion3");
        }
    })
    select3.addEventListener("change", function (){
        if(select3.options[select3.selectedIndex].value==0){
            boton.setAttribute("disabled", "disabled");  
        }else{
            boton.removeAttribute("disabled");
        }
        
    })
    cargaSelect("opcion1");
    function inicializa_xhr() {
        if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            return new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    function cargaSelect(tipo) {
        if (tipo == "opcion1") {
            var datos = "tipo=opcion1&" + Math.random();
            peticion_http = inicializa_xhr();
            if (peticion_http) {
                peticion_http.onreadystatechange = procesaOptions;
                peticion_http.open("POST", "php/combos.php");
                peticion_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                peticion_http.send(datos);
            }
        }else{
            if(tipo== "opcion2"){
                var selectedOption1 = select1.options[select1.selectedIndex];
                var datos = "tipo=opcion2&codigo_anterior="+selectedOption1.value;
                document.getElementById("divopcion2").style.display="inline-block";
                peticion_http = inicializa_xhr();
                if (peticion_http) {
                    peticion_http.onreadystatechange = procesaOptions2;
                    peticion_http.open("POST", "php/combos.php");
                    peticion_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    peticion_http.send(datos);
                }
            }else{
                var selectedOption2 = select2.options[select2.selectedIndex];
                var datos = "tipo=opcion3&codigo_anterior="+selectedOption2.value;
                document.getElementById("divopcion3").style.display="inline-block";
                peticion_http = inicializa_xhr();
                if (peticion_http) {
                    peticion_http.onreadystatechange = procesaOptions3;
                    peticion_http.open("POST", "php/combos.php");
                    peticion_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    peticion_http.send(datos);
                }
            }
        }
    }

    function procesaOptions() {
        if (peticion_http.readyState == 4 && peticion_http.status == 200) {
            let parser= new DOMParser();
            let respuesta= parser.parseFromString(peticion_http.responseText, "text/xml");
            let hijos = respuesta.getElementsByTagName("opciones")[0].children;
            for (let index = 0; index < hijos.length; index++) {
               select1.appendChild(new Option(hijos[index].getElementsByTagName("nombre")[0].innerHTML, hijos[index].getElementsByTagName("codigo")[0].innerHTML, false));
            }
        }
    }
    function procesaOptions2() {
        if (peticion_http.readyState == 4 && peticion_http.status == 200) {
            select2.innerHTML="";
            select2.appendChild(new Option("0-Elige una opcion", 0, true));
            let parser= new DOMParser();
            let respuesta= parser.parseFromString(peticion_http.responseText, "text/xml");
            let hijos = respuesta.getElementsByTagName("opciones")[0].children;
            for (let index = 0; index < hijos.length; index++) {
               select2.appendChild(new Option(hijos[index].getElementsByTagName("nombre")[0].innerHTML, hijos[index].getElementsByTagName("codigo")[0].innerHTML, false));
            }
        }
    }
    function procesaOptions3() {
        if (peticion_http.readyState == 4 && peticion_http.status == 200) {
            select3.innerHTML="";
            select3.appendChild(new Option("0-Elige una opcion", 0, true));
            let parser= new DOMParser();
            let respuesta= parser.parseFromString(peticion_http.responseText, "text/xml");
            let hijos = respuesta.getElementsByTagName("opciones")[0].children;
            for (let index = 0; index < hijos.length; index++) {
               select3.appendChild(new Option(hijos[index].getElementsByTagName("nombre")[0].innerHTML, hijos[index].getElementsByTagName("codigo")[0].innerHTML, false));
            }
        }
    }
}