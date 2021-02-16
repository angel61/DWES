<?php
class PaginaWeb
{
    public $elementos;
    public $titulo;

    public function __construct($titulo = '', $elementos = [])
    {
        $this->elementos = $elementos;
        $this->titulo = $titulo;
    }
    public function setTitulo($titulo = '')
    {
        $this->titulo = $titulo;
    }
    public function addElemento($elemento = null)
    {
        if ($elemento != null)
            $this->elementos[] = $elemento;
    }

    public function __toString()
    {
        $retorno = "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>{$this->titulo}</title>
        </head>
        <body>";

        foreach ($this->elementos as $elemento) {
            $retorno .= $elemento;
        }

        $retorno .= "</body>
        </html>";
        return $retorno;
    }
}

class Titulo
{
    public $tamanno;
    public $texto;

    public function __construct($tamanno = 1, $texto = '')
    {
        if ($tamanno > 0 && $tamanno < 7)
            $this->tamanno = $tamanno;
        else
            $this->tamanno = 1;
        $this->texto = $texto;
    }
    public function setTamanno($tamanno = 1)
    {
        if ($tamanno > 0 && $tamanno < 7)
            $this->tamanno = $tamanno;
        else
            $this->tamanno = 1;
    }
    public function setTexto($texto = '')
    {
        $this->texto = $texto;
    }

    public function __toString()
    {
        $retorno = "<h{$this->tamanno}>{$this->texto}</h{$this->tamanno}>";
        return $retorno;
    }
}
class Parrafo
{
    public $texto;

    public function __construct($texto = '')
    {
        $this->texto = $texto;
    }

    public function setTexto($texto = '')
    {
        $this->texto = $texto;
    }

    public function __toString()
    {
        $retorno = "<p>{$this->texto}</p>";
        return $retorno;
    }
}
class Texto
{
    public $texto;

    public function __construct($texto = '')
    {
        $this->texto = $texto;
    }

    public function setTexto($texto = '')
    {
        $this->texto = $texto;
    }

    public function __toString()
    {
        $retorno = "<span>{$this->texto}</span>";
        return $retorno;
    }
}
class Hipervinculo
{
    public $url;
    public $texto;

    public function __construct($url = '', $texto = '')
    {
        $this->url = $url;
        $this->texto = $texto;
    }

    public function setTexto($texto = '')
    {
        $this->texto = $texto;
    }
    public function setUrl($url = '')
    {
        $this->url = $url;
    }

    public function __toString()
    {
        $retorno = "<a href='{$this->url}'>{$this->texto}</a>";
        return $retorno;
    }
}

class Tabla
{
    public $filas;
    public $borde;

    public function __construct($filas = [],$borde=1)
    {
        $this->filas = $filas;
        $this->borde = $borde;
    }
    public function addFila($fila = null)
    {
        if ($fila != null)
            $this->filas[] = $fila;
    }

    public function __toString()
    {
        $retorno = "<table border='{$this->borde}'>";

        foreach ($this->filas as $fila) {
            $retorno .= $fila;
        }

        $retorno .= "</table>";

        return $retorno;
    }
}

class Fila
{
    public $columnas;

    public function __construct($columnas = [])
    {
        $this->columnas = [];
        foreach ($columnas as $columna) {
            $this->addColumna($columna);
        }
    }
    public function addColumna($columna = '')
    {
        $this->columnas[] = "<td>$columna</td>";
    }
    public function addEncabezado($columna = '')
    {
        $this->columnas[] = "<th>$columna</th>";
    }

    public function __toString()
    {
        $retorno = "<tr>";

        foreach ($this->columnas as $columna) {
            $retorno .= $columna;
        }

        $retorno .= "</tr>";

        return $retorno;
    }
}

class Lista
{
    public $elementos;
    public $enumarada;

    public function __construct($elementos = [], $enumarada = false)
    {
        $this->elementos = $elementos;

        if ($enumarada)
            $this->enumarada = "ol";
        else
            $this->enumarada = "ul";
    }
    public function addElemento($elemento = null)
    {
        if ($elemento != null)
            $this->elementos[] = $elemento;
    }

    public function __toString()
    {
        $retorno = "<{$this->enumarada}>";

        foreach ($this->elementos as $elemento) {
            $retorno .= "<li>{$elemento}</li>";
        }

        $retorno .= "</{$this->enumarada}>";
        return $retorno;
    }
}

class Formulario
{
    public $nombre;
    public $metodo;
    public $accion;
    public $elementos;

    public function __construct($nombre = "", $metodo = "", $accion="", $elementos=[])
    {
        $this->nombre = $nombre;
        $this->metodo = $metodo;
        $this->accion = $accion;
        $this->elementos = $elementos;
    }
    public function addElemento($elemento = null)
    {
        if ($elemento != null)
            $this->elementos[] = $elemento;
    }

    public function __toString()
    {
        $retorno = "<form name='{$this->nombre}' method='{$this->metodo}' action='{$this->accion}'>";

        foreach ($this->elementos as $elemento) {
            $retorno .= "$elemento";
        }

        $retorno .= "</form>";
        return $retorno;
    }
}

class Etiqueta
{
    public $para;
    public $texto;

    public function __construct($para = "", $texto = "")
    {
        $this->para = $para;
        $this->texto = $texto;
    }

    public function __toString()
    {
        $retorno = "<label for='{$this->para}'>{$this->texto}</label>";
        return $retorno;
    }
}

class Input
{
    public $nombre;
    public $tipo;
    public $valor;

    public function __construct($nombre = "", $tipo = "", $valor = "")
    {
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->valor = $valor;
    }

    public function __toString()
    {
        $retorno = "<input type='{$this->tipo}' name='{$this->nombre}' value='{$this->valor}'/>";
        return $retorno;
    }
}

class Desplegable
{
    public $nombre;
    public $elementos;

    public function __construct($nombre = "", $elementos=[])
    {
        $this->nombre = $nombre;
        $this->elementos = $elementos;
    }

    public function addElemento($elemento = null)
    {
        if ($elemento != null)
            $this->elementos[] = $elemento;
    }

    public function __toString()
    {
        $retorno = "<select name='{$this->nombre}'>";

        foreach ($this->elementos as $elemento) {
            $retorno .= "<option>{$elemento}</option>";
        }

        $retorno .= "</select>";
        return $retorno;
    }
}

class Boton
{
    public $nombre;
    public $valor;

    public function __construct($nombre = "", $valor = "")
    {
        $this->nombre = $nombre;
        $this->valor = $valor;
    }

    public function __toString()
    {
        $retorno = "<button name='{$this->nombre}'>{$this->valor}</button>";
        return $retorno;
    }
}