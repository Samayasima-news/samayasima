<?php
  require('./includes/nav.inc.php');  
?>

<script>
function deleteConfirm(id) {
  if (confirm("Are you sure you want to delete this author ?")) {
    var url = "./delete-author.php?id=" + id;
    document.location = url;
  }
}
</script>

<!-- BREADCRUMB -->
<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Dashboard</a></li>
      <li class="active">Delete_Author</li>
    </ol>
  </div>
</section>


<section id="main">
  <div class="container">
    <div class="col-md-12">
      <?php
        $limit = 5;
        if(isset($_GET['page'])) {
          $page = $_GET['page'];
        }else {
          $page = 1;
        }
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * 
                FROM author
                ORDER BY author_name ASC
                LIMIT {$offset},{$limit}";
        $result = mysqli_query($con,$sql);
        $row = mysqli_num_rows($result);

      ?>
      <div class="panel panel-default">
        <div class="panel-heading main-color-bg">
          <h3 class="panel-title">Delete_Author</h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover article-list">
            <tr>
             <th style="min-width: 100px">Id</th>
              <th style="min-width: 80px; text-align:center">Name</th>
              <th style="min-width: 100px">Email</th>
              
              
            </tr>
            <?php
                if($row > 0) {
                  while($data = mysqli_fetch_assoc($result)) {
                    $author_id = $data['author_id'];
                    $author_name = $data['author_name'];
                    $author_email = $data['author_email'];
                    
                    

                    echo '
                      <tr>
                        <td>
                          '.$author_id.'
                        </td>
                        <td  >
                          '.$author_name.'
                        </td>
                        
                        <td>
                          '.$author_email.'
                        </td>
                        
                        <td>';
                        echo '
                          
                          <a class="btn btn-danger" href="javascript:deleteConfirm('.$author_id.')" title="Delete_Author">
                            <span class="glyphicon glyphicon-trash"></span>
                          </a>
                        </td>
                      
                      </tr>
                    ';
                  }
                }
                
              ?>
          </table>
        </div>
        <div class="text-center">
          <ul class="pagination pg-red">
            <?php
              $paginationQuery = "SELECT * FROM author";
              $paginationResult = mysqli_query($con, $paginationQuery);
              if(mysqli_num_rows($paginationResult) > 0) {
                $total_authors = mysqli_num_rows($paginationResult);
                $total_page = ceil($total_authors / $limit);

                if($page > $total_page) {
                  redirect('./author11.php');
                }
                if($page > 1) {
                  echo '
                    <li class="page-item">
                      <a href="author11.php?page='.($page - 1).'" class="page-link">
                        <span>&laquo;</span>
                      </a>
                    </li>';
                }
                for($i = 1; $i <= $total_page; $i++) {
                  $active = "";
                  if($i == $page) {
                    $active = "active";
                  }
                  echo '<li class="page-item '.$active.'"><a href="./author11.php?page='.$i.'" class="page-link">'.$i.'</a></li>';
                }
                if($total_page > $page){
                  echo '
                    <li class="page-item">
                      <a href="author11.php?page='.($page + 1).'" class="page-link">
                        <span>&raquo;</span>
                      </a>
                    </li>';
                }
              }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
  require('./includes/footer.inc.php')
?>