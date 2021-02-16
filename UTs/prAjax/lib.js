/**
 * Cte's para las funciones del servidor
 * @type {number}
 */
const LOGIN = 0;
const LOGOUT = 1;
const SELECT = 2;


/**
 * Las funciones guiXxxxx son las Callback llamadas después de la respuesta del servidor
 * Se llaman dentro del onreadystatechange decontactServer
 * @param data  valor devuelto del servidor XMK para login/logout JSON en otro caso
 */
function guiLogin(data){
    parser = new DOMParser();
    objXML = parser.parseFromString(data, "text/xml");
    respuesta = objXML.getElementsByTagName("status")[0].textContent;


    if (respuesta == "OK"){
        document.getElementById("login").style.display = "none";
        document.getElementById("logout").style.display = "";
        document.getElementById("central").innerHTML = ""
    }
    else
        alert("Error de Autentificación");
}

function guiLogout(data){
    parser = new DOMParser();
    objXML = parser.parseFromString(data, "text/xml");
    respuesta = objXML.getElementsByTagName("status")[0].textContent;
    document.getElementById("login").style.display = "";
    document.getElementById("logout").style.display = "none";
    document.getElementById("central").innerHTML = ""

}

function guiSelect(data){
    objJSON = JSON.parse(data);
    html='<table class="tablaDatos">';
    keys = Object.keys(objJSON.data.data[0]);
    html += "<tr>";
    for (key of keys){
        html += "<th>"+key+"</th>";
    }
    html += "</tr>";
    for (row of objJSON.data.data){
        html += "<tr><td>"+row[keys[0]]+"</td><td>"+row[keys[1]]+"</td></tr>"
    }
    html += "</table>"
    document.getElementById("central").innerHTML = html
}


/**
 * Las funciones clicXXXX se llaman desde los elementos de menú
 */
function clicLogin() {
    usu = document.getElementById("usuario").value;
    pw = document.getElementById("clave").value;
    contactServer(LOGIN,{"usuario":usu, "clave":pw},guiLogin);
}
function clicLogout() {
    contactServer(LOGOUT,[],guiLogout);
}

function clicSelect() {
    contactServer(SELECT,[],guiSelect);
}


/**
 * Carga la parte central dependiendo del menú pulsado (función)
 * @param func  página html a solicitar al servidor
 * @param idDiv  identificador del div a cargar después
 */
function cargarGui(func, idDiv="central") {
    let div = document.getElementById(idDiv);
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                div.innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "gui/" + func + ".html", true);
        xmlhttp.send();
}

/**
 * Conecta con el servidor y llama a la callback registrada
 * @param func  función a solicitar al servidor, numérico de 0 a 4
 * @param params  parámetros del servidor
 * @param callback  función a llamar una vez terminada la conexioón
 */
function contactServer(func, params , callback) {
    //Generamos la parte de parámetros de la url
    url_params=""
    for (key of Object.keys(params)){
        url_params += "&" + key + "=" + params[key];
    }
    //Conexión con el servidor
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            callback(this.responseText);
        }
    };
    url = "api.php?func=" + func + url_params
    xmlhttp.open("GET", url , true);
    xmlhttp.send();
}