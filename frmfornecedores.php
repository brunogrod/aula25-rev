<?php
include "menu.php";
$IDFornecedor = isset($_GET["IDFornecedor"]) ? $_GET["IDFornecedor"]:null;
$op = isset($_GET["op"])? $_GET["op"]:null;
try{
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdrevisao";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);

  if($op=="del"){
    $sql = "delete from tblfornecedores where IDFornecedor= :IDFornecedor";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(":IDFornecedor",$IDFornecedor);
    $stmt->execute();
    header("Location:fornecedores.php");
  }
  if($IDFornecedor){
    $sql = "Select *  from tblfornecedores where IDFornecedor= :IDFornecedor";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(":IDFornecedor",$IDFornecedor);
    $stmt->execute();
    $fornecedor = $stmt->fetch(PDO::FETCH_OBJ);

  }



  if($_POST){
    if($_POST["IDFornecedor"]){
      $sql = "UPDATE tblfornecedores set Fornecedor=:Fornecedor, CNPJ=:CNPJ,Telefone=:Telefone,email=:email,IDProduto=:IDProduto  WHERE IDFornecedor=:IDFornecedor";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":Fornecedor", $_POST["Fornecedor"]);
      $stmt->bindValue(":CNPJ", $_POST["CNPJ"]);
      $stmt->bindValue(":Telefone", $_POST["Telefone"]);
      $stmt->bindValue(":email", $_POST["email"]);
      $stmt->bindValue(":IDProduto", $_POST["IDProduto"]);
      $stmt->bindValue(":IDFornecedor", $_POST["IDFornecedor"]);
      $stmt->execute();
    } else {
      $sql = "INSERT INTO tblfornecedores(Fornecedor,CNPJ,Telefone,email,IDProduto) values(:Fornecedor,:CNPJ,:Telefone,:email,:IDProduto";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":Fornecedor", $_POST["Fornecedor"]);
      $stmt->bindValue(":CNPJ", $_POST["CNPJ"]);
      $stmt->bindValue(":Telefone", $_POST["Telefone"]);
      $stmt->bindValue(":email", $_POST["email"]);
      $stmt->bindValue(":IDProduto", $_POST["IDProduto"]);
      
      $stmt->execute();
      


    }
    header("Location:fornecedores.php");
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
    <h1>Cadastro de Fornecedores</h1>    
    <hr>
    <div class="container">
        <form method="post">
            Fornecedor      <input type="text" name="Fornecedor" value="<?php echo isset($fornecedor) ? $fornecedor->Fornecedor:null ?>">
            CNPJ  <input type="date" name="CNPJ"   value="<?php echo isset($fornecedor) ? $fornecedor->CNPJ:null ?>">
            Telefone       <input type="text" name="Telefone"   value="<?php echo isset($fornecedor) ? $fornecedor->Telefone:null ?>">
            email      <input type="text" name="email"   value="<?php echo isset($fornecedor) ? $fornecedor->email:null ?>">
            Id Produto       <input type="text" name="IDProduto"   value="<?php echo isset($fornecedor) ? $fornecedor->IDProduto:null ?>">
            <input type="hidden" name="IDFornecedor"           value="<?php echo isset($fornecedor) ? $fornecedor->IDFornecedor:null ?>">>
            <input type="submit" value="Cadastrar" class="btn btn-warning">

        </form>
    </div>
  
  <?php 
    
    include "rodape.php";
    ?>
