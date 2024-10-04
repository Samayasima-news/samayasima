<?php
  require('./includes/nav.inc.php');
  
  if(isset($_GET['id'])) {
    $author_id = $_GET['id'];
  }else {
    redirect('./author11.php');
  }
  if($author_id == '' || $author_id == null) {
    redirect('./author11.php');
  } 

  $sql = "SELECT author_id
          FROM  author
          WHERE author_id = {$author_id}";
          
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  
  

  $delete_sql = " DELETE FROM author
                  WHERE author_id = {$author_id}";
  $cat_result = mysqli_query($con, $delete_sql); 
 
  if($cat_result) {
    redirect('./author11.php');
  }
?>


<?php
  require('./includes/footer.inc.php')
?>