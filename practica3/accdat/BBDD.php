<?php
    require_once("accdat/constantesDB.php");

    function getConferencias()
    {
        $conferencias=[];
        @$conn=mysqli_connect(host, us, pw, bd);
        if ($conn) {
            $sql="SELECT Conferencia FROM `equipos` GROUP BY Conferencia";
            $rest=mysqli_query($conn, $sql);
            while ($row=mysqli_fetch_assoc($rest)) {
                $conferencia[]=$row['Conferencia'];
            }
            mysqli_close($conn);
        }
        return $conferencia;
    }

    function getEquipos($conferencia)
    {
        $equipos=[];
        @$conn=mysqli_connect(host, us, pw, bd);
        if ($conn) {
            $sql="SELECT Nombre FROM `equipos` WHERE Conferencia='".$conferencia."'";
            $rest=mysqli_query($conn, $sql);
            while ($row=mysqli_fetch_assoc($rest)) {
                $equipos[]=$row['Nombre'];
            }
            mysqli_close($conn);
        }
        return $equipos;
    }

    function getJugadores($equipo)
    {
        $jugadores=[];
        @$conn=mysqli_connect(host, us, pw, bd);
        if ($conn) {
            $sql="SELECT codigo, Nombre FROM `jugadores` WHERE Nombre_equipo='".$equipo."'";
            $rest=mysqli_query($conn, $sql);
            while ($row=mysqli_fetch_assoc($rest)) {
                $jugadores[$row['codigo']]=$row['Nombre'];
            }
            mysqli_close($conn);
        }
        return $jugadores;
    }

    function getJugador($id)
    {
        $jugador=[];
        @$conn=mysqli_connect(host, us, pw, bd);
        if ($conn) {
            $sql="SELECT Nombre, Posicion, Nombre_equipo, Altura, Peso, FORMAT(AVG(Puntos_por_partido),2) AS Puntos, FORMAT(AVG(Asistencias_por_partido),2) AS Asistencias, FORMAT(AVG(Tapones_por_partido),2) AS Tapones, FORMAT(AVG(Rebotes_por_partido),2) AS Rebotes FROM estadisticas e, jugadores j WHERE j.codigo=e.jugador AND j.codigo=".$id." GROUP BY j.codigo";
            $rest=mysqli_query($conn, $sql);
            while ($row=mysqli_fetch_assoc($rest)) {
                $jugador[]=$row['Nombre'];
                $jugador[]=$row['Posicion'];
                $jugador[]=$row['Nombre_equipo'];
                $jugador[]=$row['Altura'];
                $jugador[]=$row['Peso'];
                $jugador[]=$row['Puntos'];
                $jugador[]=$row['Asistencias'];
                $jugador[]=$row['Tapones'];
                $jugador[]=$row['Rebotes'];
            }
            mysqli_close($conn);
        }
        return $jugador;
    }
