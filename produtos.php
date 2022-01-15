<?php
include "conexao.php";
include "menu.php";

try{
    $sql = "SELECT * FROM tblprodutos";
    $qry = $con->query($sql);
    $produtos = $qry->fetchALL(PDO::FETCH_OBJ);

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
    <h1>Produtos cadastrados</h1>
<hr>

<div class="container">
    <a href="frmprodutos.php" class="btn btn-primary">Novo</a>
    <table class="table table-success table-striped table-hover">
        <thead>
            <tr>
                <th>idProduto</th>
                <th>Produto</th>
                <th>Data Cadastro</th>
                <th>Quantidade</th>
                <th>Valor</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($produtos as $produto) { ?>
            <tr>
                <th><?php echo $produto->IDProduto ?></th>
                <th><?php echo $produto->Produto ?></th>
                <th><?php echo $produto->dtCadastro ?></th>
                <th><?php echo $produto->Quantidade ?></th>
                <th><?php echo $produto->Valor ?></th>
                <th>
                    <a href="frmprodutos.php?IDProduto=<?php echo $produto->IDProduto ?>" >
                    
                    <img src="./img/editar.png" alt="">
                </a>
                </th>

                <th>
                    <a href="frmprodutos.php?op=del&IDProduto=<?php echo $produto->IDProduto ?>" >
                   
                    <img src="./img/excluir.png" alt="">
                </a>
                </th>

            </tr>
            </tr>
            <?php } ?>
            </tbody>
           

    </table>
</div>

    <?php 
    
    include "rodape.php";
    ?>