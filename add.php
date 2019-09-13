<?php 

 include('templetes/config/db_connect.php');

 $email =$title =$Ingredients ='';
 $error = array('email'=>'', 'title'=>'', 'Ingredients'=>'');
 
 if(isset($_POST['submit'])){
     
       //check email
     if(empty($_POST['email'])){
        $error['email']= 'An Email Is Required <br />';
     } else{
        $email = $_POST['email'];
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $error['email'] ='Email must be a valid email address';
        }
     }
      //check title
     if(empty($_POST['title'])){
        $error['title']= 'A Title Is Required <br />';
    } else{
       //echo htmlspecialchars($_POST['title']);
       $title = $_POST['title'];
       if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
           $error['title'] ='title must be letters and space only';
       }
    }
      //check Ingredients
    if(empty($_POST['Ingredients'])){
        $error['Ingredients'] = ' At least one Ingredient is Required <br />';
    } else{
       //echo htmlspecialchars($_POST['Ingredients']);
       $Ingredients = $_POST['Ingredients'];
       if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$Ingredients)){
        $error['Ingredients']= 'Ingredients must be comma seperated list';
    }
    }

    if(array_filter($error)){
       // echo 'error in the form';
    } else{

        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $title = mysqli_real_escape_string($conn,$_POST['title']);
        $Ingredients = mysqli_real_escape_string($conn,$_POST['Ingredients']);

        //create sql
        $sql = "INSERT INTO pizzas (title, email, Ingredients) VALUES ('$title','$email','$Ingredients')";
        
        //save it to db and check
        if(mysqli_query($conn,$sql)){
            //success
            //echo 'form is valid';
        header('Location: index.php');
        } else{
            //error
            echo 'query error: '. mysql_error($conn);  
        }

        
    }
 } // this is the end of post check

?>

<!DOCTYPE html>
<html>

<?php include('templetes/header.php'); ?>

<section class="container gray-text">
  <h4 class="center">add a pizza</h4>
  <form class="white" action="add.php" method="POST">
  <label> For your email:</label>
   <input type="text" name="email"value="<?php echo htmlspecialchars ($email) ?>">
    <div class="red-text"><?php echo $error['email']; ?></div>
   <label> Pizza title:</label>
   <input type="text" name="title" value="<?php echo htmlspecialchars ($title) ?>">
   <div class="red-text"><?php echo $error['title']; ?></div>
   <label> Ingredients (comma seperated):</label>
   <input type="text" name="Ingredients" value="<?php echo htmlspecialchars ($Ingredients) ?>">
   <div class="red-text"><?php echo $error['Ingredients']; ?></div>
   <div class="center">
    <input type="submit" name="submit" value="sumbit" class="btn brand z-depth-0">
   </div>
   </form>
</section>


<?php include('templetes/footer.php'); ?>



 
 </html>