<?php
include "conexao.php";
include "menu.php";

try{
    $sql = "SELECT * FROM tblvendedores";
    $qry = $con->query($sql);
    $vendedores = $qry->fetchALL(PDO::FETCH_OBJ);

    //echo "<pre>";
    //    print_r($clientes);
       
} catch(PDOException $e){
    echo $e->getMessage();
}


?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sistema</title>
  </head>
  <body>
    <h1>Vendedores cadastrados</h1>
<hr>

<div class="container">
    <a href="frmvendedores.php" class="btn btn-primary">Novo</a>
    <table class="table table-success table-striped table-hover">
        <thead>
            <tr>
                <th>idVendedor</th>
                <th>Vendedor</th>
                <th>Valor de Venda</th>
                <th>Produto</th>
                <th>Número de Peças</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($vendedores as $vendedor) { ?>
            <tr>
                <th><?php echo $vendedor->idVendedor ?></th>
                <th><?php echo $vendedor->Vendedor ?></th>
                <th><?php echo $vendedor->vlVenda ?></th>
                <th><?php echo $vendedor->Produto ?></th>
                <th><?php echo $vendedor->numPecas ?></th>

                <th>
                    <a href="frmvendedores.php?idVendedor=<?php echo $vendedor->idVendedor ?>" >
                    
                    <img src="./img/editar.png" alt="">
                </a>
                </th>

                <th>
                    <a href="frmvendedores.php?op=del&idVendedor=<?php echo $vendedor->idVendedor ?>" >
                   
                    <img src="./img/excluir.png" alt="">
                </a>
                </th>
            </tr>
            <?php } ?>
            </tbody>
           

    </table>
</div>

    <?php 
    
    include "rodape.php";
    ?>