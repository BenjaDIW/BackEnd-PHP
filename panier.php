<?php


session_start();

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="public\assets\bootstrap-4.5.3-dist\css\bootstrap.min.css"/>
    
    <title>Boutique</title>

 
  </head>





<div class="cart content-wrapper text-center">
    <h1>Panier</h1>
    <form action="addPanier.php?page=cart" method="post">
        <table class= "text-center">
            <thead>
                <tr>
                    <td>Produit</td>
                    <td>prix</td>
                    <td>Qte</td>
                    <td>Total</td>
                </tr>
            </thead>
            
                
             
                
            
        </table>
       
    </form>
</div>