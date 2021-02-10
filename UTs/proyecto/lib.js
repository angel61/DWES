const LOGIN=0;
const LOGOUT=1;
const SELECT=2;

guiLogin=(data)=>{
    parser = new DOMParser();
    objXML = parser.parseFromString(data,"text/xml");
    respuesta = objXML.getElementsByTagName("status")[0].textContent

    if(respuesta=="OK"){
        document.getElementById("logout").style.display="";
        document.getElementById("login").style.display="none";
        document.getElementById("central").innerHTML="";
    }
    else
    alert("Error de Autentificación.");
};



cargarGui = (func, idDiv = "central") => {
    let div = document.getElementById(idDiv);
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            div.innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "gui/" + func + ".html", true);
    xmlhttp.send();
}

clickLogin = () => {
    usu = document.getElementById("usuario");
    pw = document.getElementById("clave");
    contactServer(LOGIN,{"usuario":usu, "clave":pw}, guiLogin);
}

clickLogout = () => {
    contactServer(LOGOUT,[], guiLogout);
}

clickSelect = () => {
    contactServer(SELECT,[], guiSelect);
}

contactServer = (func, params, callback) => {
    url_params = ""
    for (key of Object.keys(params)) {
        url_params += "&" + key + "=" + params[key];
    }

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        callback(this.responseText);
    };
    url = "api.php?func=" + func + url_params
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}