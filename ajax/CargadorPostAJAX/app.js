var list1 = document.getElementById("listado");
window.onload = function () {
    document.getElementById("cargar").onclick = function () {
        fetch('https://jsonplaceholder.typicode.com/users')
            .then(response => response.json())
            .then(json => {
                var list1 = document.getElementById("listado");
                json.forEach(element => {
                    let {
                        id,
                        name,
                        username,
                        email
                    } = element;
                    list1.innerHTML += `<h3>User ${id}</h3>
                                                <ul>
                                                    <li>Username: ${username}</li>
                                                    <li>Name: ${name}</li>
                                                    <li>Email: ${email}</li>
                                                </ul>`;
                });

            });
    }
}