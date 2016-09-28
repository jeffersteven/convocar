//La funcion de ajax recibe 3 variables:

// string : el primer parametro es la operacion que se va a hacer y luego el string del post
//EJEMPLO: "command=CREAR&usuario="+y+"&clave="+z+"&nombre="+x;    DONDE x, y, z son las variables

//direccion : Es la direccion donde esta la operacion, debe estar separada por dos valores, el dominio y el subdominio

// callback : es la funcion que va a recibir la respuesta del ajax

//ajax(string, direccion, prueba);

//function prueba(x){
//alert(x);
//}


function ajax(string, servicio, callback)
{
    var dirServlet = "/pruebas/";
    var stringFinal = "servicio="+servicio+"&"+string;
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            var respuesta = xmlhttp.responseText;
            callback(respuesta);
        }
    }
    xmlhttp.open("POST", dirServlet ,true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded; charset=utf-8");
    xmlhttp.send(stringFinal);
}
