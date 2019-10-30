<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud codeigniter</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    
    <!-- Datepicker -->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    
    <!-- JCrop -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/2.0.4/css/Jcrop.min.css">
    
    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>

    <!-- Style css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">


</head>
<body>
    <!--Menu -->
    <input type="checkbox" name="check" id="check">
	<label id="icone" for="check"><div id="botao"></div></label>
	

	<div class="barra">
		<nav>
			<a href="<?php echo base_url(''); ?>"><div class="opcao"><div id="bem-vindo"> <span>Bem-Vindo</span></div></div></a>

            <a href="<?php echo base_url('Usuarios/Cadastrar'); ?>"><div class="opcao"><div id="cadastrar"> <span>Cadastrar</span></div></div></a>

			<a href="<?php echo base_url('Categorias/'); ?>"><div class="opcao"><div id="categorias"> <span>Categorias</span></div></div></a>
			
			<a href="<?php echo base_url('SubCategorias/'); ?>"><div class="opcao"><div id="subcategorias"> <span>Subcategorias</span></div></div></a>

            <a href="<?php echo base_url('Usuarios/Listar'); ?>"><div class="opcao"><div id="usuarios"> <span>Usuarios</span></div></div></a>
		</nav>
	</div>