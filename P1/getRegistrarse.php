<?php
    $error_form = false;


    //Validacion nombre
    $varnombrecompleto = htmlspecialchars($_REQUEST["nombrecompleto"]);

    if(empty($varnombrecompleto)){
        $namecompleto_error = "Por favor ingresa tu nombre completo";
        $error_form = true;
    }

    //Validacion correo
    $varcorreo= htmlspecialchars($_REQUEST["email"]);

    if(empty($varcorreo)){
        $correo_error = "Por favor ingresa tu correo";
        $error_form = true;
    }

    //Validacion password
    $varpassword= htmlspecialchars($_REQUEST["password"]);

    if(empty($varpassword)){
        $password_error = "Por favor ingresa una contraseña";
        $error_form = true;
    }

    //Validacion telefono
    $vartel= htmlspecialchars($_REQUEST["tel"]);

    if(empty($vartel)){
        $tel_error = "Por favor ingresa un telefono";
        $error_form = true;
    }

    //Validacion puesto   
    $varpuesto= htmlspecialchars($_REQUEST["puesto"]);

    if(empty($varpuesto)){
        $puesto_error = "Por favor ingrese su puesto";
        $error_form = true;
    }


    include('registrarse.php');


    //Cuando no hay error formulario
    if(!$error_form){

        $resultLoginEmpleado = insertLoginEmpleado($varcorreo, $varpassword);
        $resultEmpleado = insertEmpleado($varnombrecompleto, $vartel, $varpuesto);

        if($resultLoginEmpleado && $resultEmpleado){
            header("Location: /dianac/login.html");
            exit();
        }
    }

    function insertLoginEmpleado($correo, $password){
        
        include "include/conexion.php";
        $sql_InsertLoginEmpleado = "INSERT INTO Login_Empleado (Correo, Password) VALUES ('$correo', '$password');";
        
        $result = mysqli_query($varconexion, $sql_InsertLoginEmpleado);
        
        mysqli_close($varconexion);

        return $result;
    }

    function insertEmpleado($nombrecompleto, $tel, $puesto){
        
        include "include/conexion.php";
        
        $sql_InsertEmpleado = "INSERT INTO Empleado (Nombre, Telefono, Puesto, ID_LoginEmpleado) VALUES ('$nombrecompleto', '$tel', '$puesto', 1)";
        
        $result = mysqli_query($varconexion, $sql_InsertEmpleado);

        mysqli_close($varconexion);
        
        return $result;
    }
?>