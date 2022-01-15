<?php
include "menu.php";
$idVendedor = isset($_GET["idVendedor"]) ? $_GET["idVendedor"]:null;
$op = isset($_GET["op"])? $_GET["op"]:null;
try{
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdrevisao";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);

  if($op=="del"){
    $sql = "delete from tblvendedores where idVendedor= :idVendedor";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(":idVendedor",$idVendedor);
    $stmt->execute();
    header("Location:vendedores.php");
  }
  if($idVendedor){
    $sql = "Select *  from tblvendedores where idVendedor= :idVendedor";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(":idVendedor",$idVendedor);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_OBJ);

  }



  if($_POST){
    if($_POST["idVendedor"]){
      $sql = "UPDATE tblvendedores set Vendedor=:Vendedor, vlVenda=:vlVenda,Produto=:Produto,numPecas=:numPecas WHERE idVendedor=:idVendedor";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":Vendedor", $_POST["Vendedor"]);
      $stmt->bindValue(":vlVenda", $_POST["vlVenda"]);
      $stmt->bindValue(":Produto", $_POST["Produto"]);
      $stmt->bindValue(":numPecas", $_POST["numPecas"]);
      $stmt->bindValue(":idVendedor", $_POST["idVendedor"]);
      $stmt->execute();
    } else {
      $sql = "INSERT INTO tblvendedores(Vendedor,vlVenda,Produto,numPecas) values(:Vendedor,:vlVenda,:Produto,:numPecas)";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":Vendedor", $_POST["Vendedor"]);
      $stmt->bindValue(":vlVenda", $_POST["vlVenda"]);
      $stmt->bindValue(":Produto", $_POST["Produto"]);
      $stmt->bindValue(":numPecas", $_POST["numPecas"]);
      
      $stmt->execute();
      


    }
    header("Location:vendedores.php");
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
    <h1>Cadastro de Vendedores</h1>    
    <hr>
    <div class="container">
        <form method="post">
        Vendedor       <input type="text" name="Vendedor" value="<?php echo isset($vendedor) ? $vendedor->Vendedor:null ?>">
        Valor da venda <input type="text" name="vlVenda"   value="<?php echo isset($vendedor) ? $vendedor->vlVenda:null ?>">
        Produto         <input type="text" name="Produto"   value="<?php echo isset($vendedor) ? $vendedor->Produto:null ?>">
        Número de Peças        <input type="text" name="numPecas"   value="<?php echo isset($vendedor) ? $vendedor->numPecas:null ?>">
            <input type="hidden" name="idVendedor"           value="<?php echo isset($vendedor) ? $vendedor->idVendedor:null ?>">>
            <input type="submit" value="Cadastrar" class="btn btn-warning">

        </form>
    </div>
  
  <?php 
    
    include "rodape.php";
    ?>
