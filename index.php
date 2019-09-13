<?php 
 
 include('templetes/config/db_connect.php');

 //write a query for all pizzas 
 $sql = 'SELECT title, Ingredients, id FROM pizzas ORDER BY created_at';

 //make query & get result
 $result = mysqli_query($conn, $sql);

 //fetch the resulting row as an array
 $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

 //free from memory
 mysqli_free_result($result);

 //colse the connection
 mysqli_close($conn);


?>

<!DOCTYPE html>
<html>

<?php include('templetes/header.php'); ?>
 
<h4 class="center gray-text">pizzas!</h4>
<div class="container">
 <div class="row">
  <?php foreach($pizzas as $pizza){ ?>
     <div class="col s6 md3">
     <div class="card z-depth-0">
       <div class="card-content center">
         <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
         <ul>
           <?php foreach(explode(',', $pizza['Ingredients']) as $ing){ ?>
             <li><?php echo htmlspecialchars($ing); ?></li>   
          <?php } ?>
         </ul>
       </div>
       <div class="card-action right-align">
        <a class="brand-text" href="details.php ?id =<?php echo $pizza['id'] ?>">More Info</a>
       </div>
     </div>
     </div>
 <?php } ?>
 
 </div>
</div>

<?php include('templetes/footer.php'); ?>



 
 </html>
       

