
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
    <title>E-mail</title>

    <style type="text/css">
    	*{
    		margin: 0;
    		padding: 0;
    	}
    	.title {
    		background: black;
    		color: white;
    		padding: 30px;
    		text-align: center;
            font-weight: 400;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    	}
    	.container {
            width: 790px;
            margin: auto;
        }
​		.d-flex {
            display: flex;
            justify-content: space-between;
        }
        .desc h3 {
            font-weight: 400;
        }
         .desc div {
            border: 1px solid #ccc;
            padding: 0 30px;
        }
         footer {
            text-align: center;
            margin-top: 50px;
        }
​
        footer .small {
            font-size: 0.9em;
            color: #444;
        }
    </style>
</head>
<body>
    <h2 class="title">Alteração no cadastro de <?php echo $nome; ?></h2>
    <div class="container">
	    <p>E-mail: <?php echo $email; ?></p>
	    <p>Data de nascimento: <?php echo date('d/m/Y', strtotime($nascimento)); ?></p>
    
    
    	<p>Categoria: <?php echo $categoria->categoria; ?></p>
    	<p>Subcategoria: <?php echo $categoria->subcategoria; ?></p>
   		<div class="d-flex">
           <img src="<?php echo base_url('assets/images/'.$img); ?>" alt="Imagem teste">
   		</div>
   	<div class="desc">
   		<h3>Descrição</h3>
    	<div>
    	    <?php echo $descricao; ?>
    	</div>
	</div>    

    <footer>
    	<p class="small">Editado em: <?php echo $date ?></p>
    </footer>
</body>
</html>