<?php 
	require_once("Autoload.php");

	$objUsuario = new Usuario();
	//$insert=$objUsuario->InsertUsuario("Jorge","0983998629","jorge@espe.edu.ec");

	//echo $insert;
    $users=$objUsuario->getUsuarios();
    print_r("<pre>");
    print_r($users);

    $update=$objUsuario->updateUser(2,"Jordan","0982440360","juan@hotmail.com");

    $obUser=$objUsuario->getUser(2);
    print_r($obUser);

    $delUs=$objUsuario->delUser(2);
    echo $delUs;
    

 ?>