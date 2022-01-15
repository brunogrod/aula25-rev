<?php
include "menu.php";
$IDProduto = isset($_GET["IDProduto"]) ? $_GET["IDProduto"]:null;
$op = isset($_GET["op"])? $_GET["op"]:null;
try{
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdrevisao";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);

  if($op=="del"){
    $sql = "delete from tblprodutos where IDProduto= :IDProduto";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(":IDProduto",$IDProduto);
    $stmt->execute();
    header("Location:produtos.php");
  }
  if($IDProduto){
    $sql = "Select *  from tblprodutos where IDProduto= :IDProduto";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(":IDProduto",$IDProduto);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_OBJ);

  }



  if($_POST){
    if($_POST["IDProduto"]){
      $sql = "UPDATE tblprodutos set Produto=:Produto, dtCadastro=:dtCadastro, Quantidade=:Quantidade, Valor=:Valor WHERE IDProduto=:IDProduto";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":Produto", $_POST["Produto"]);
      $stmt->bindValue(":dtCadastro", $_POST["dtCadastro"]);
      $stmt->bindValue(":Quantidade",$_POST["Quantidade"]);
      $stmt->bindValue(":Valor", $_POST["Valor"]);
      $stmt->bindValue(":IDProduto", $_POST["IDProduto"]);
      $stmt->execute();
    } else {
      $sql = "INSERT INTO tblprodutos(Produto,dtCadastro,Quantidade,valor) values(:Produto,:dtCadastro,:Quantidade,:valor)";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":Produto", $_POST["Produto"]);
      $stmt->bindValue(":dtCadastro", $_POST["dtCadastro"]);
      $stmt->bindValue(":Quantidade",$_POST["Quantidade"]);
      $stmt->bindValue(":Valor", $_POST["Valor"]);      
    

    }
    header("Location:produtos.php");
  }


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
    <h1>Cadastro de Produtos</h1>    
    <hr>
    <div class="container">
        <form method="post">
            Produto       <input type="text" name="Produto" value="<?php echo isset($produto) ? $produto->Produto:null ?>">
            Data Cadastro <input type="date" name="dtCadastro"   value="<?php echo isset($produto) ? $produto->dtCadastro:null ?>">
            Quantidade         <input type="text" name="Quantidade"   value="<?php echo isset($produto) ? $produto->Quantidade:null ?>">
            Valor         <input type="text" name="Valor"   value="<?php echo isset($produto) ? $produto->Valor:null ?>">

 
            <input type="hidden" name="IDProduto"           value="<?php echo isset($produto) ? $produto->IDProduto:null ?>">
            <input type="submit" value="Cadastrar" class="btn btn-warning">

        </form>
    </div>
  
  <?php 
    
    include "rodape.php";
    ?>


