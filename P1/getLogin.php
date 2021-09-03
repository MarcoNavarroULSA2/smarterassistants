<?php    
  $error_form = false;
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

    include('login.php');

    if(!$error_form){
        $usuariosEncontrados = selectLoginEmpleado($varcorreo, $varpassword);
    
        if($usuariosEncontrados == 1){
            header("Location: /dianac/menu.html");
            exit();
        }
    }
    
    function selectLoginEmpleado($correo, $password){
    
        include "include/conexion.php";
        $sql_SelectLoginEmpleado = "SELECT * FROM Login_Empleado WHERE Correo = '$correo' AND Password = '$password';";

        $result = mysqli_query($varconexion, $sql_SelectLoginEmpleado);

        $usuariosEncontrados = $result->num_rows;

        mysqli_close($varconexion);

        return $usuariosEncontrados;
    }
?>

