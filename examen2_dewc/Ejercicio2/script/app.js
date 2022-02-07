const boton =  document.getElementById('obtener');
boton.addEventListener('click', e => {
	e.preventDefault();
	fetch('tabla.json')
	.then(datos => datos.json())
	.then(res => {
		
		let salario = document.getElementById('salarioMinimo');
		if(salario.value != ''){
			res = res.filter(e => e.salario > salario.value);
		}
		let contenido= document.getElementById("contenido");
		contenido.innerHTML = '';
		contenido.appendChild(crearTabla(res));
		let media = res.reduce((acc, el) => acc + el.edad, 0) / res.length;
		let salarioMin = res.reduce((acc, el) => el.salario < acc.salario ? el : acc);
		let edadMax = res.reduce((acc, el) => el.edad > acc.edad ? el : acc);
		let informacion = document.getElementById('estadisticas');
		informacion.innerHTML = `<p>La media de edad es ${Math.floor(media * 100) / 100}</p>`;
		informacion.innerHTML += `<p>La persona de más edad es ${edadMax.nombre} y la de menor salario es ${salarioMin.nombre}</p>`;
	})	

})

const crearTabla = (datos) => {
	let tabla = document.createElement('table');
	let thead = tabla.createTHead();
	let row = thead.insertRow();

	for (let index of datos) {
		for (let propiedad in index) {
			let th = document.createElement('th');
			let texto = document.createTextNode(propiedad);
			th.appendChild(texto);
			row.appendChild(th);
		}
		break;
	}

	for (let element of datos) {
		let row = tabla.insertRow();
		for (let index in element) {
			let celda = row.insertCell();
			let texto = document.createTextNode(element[index]);
			celda.appendChild(texto);
		}
	}
	return tabla;
}


