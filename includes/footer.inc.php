<!--? ======== FOOTER ======== -->
<footer class="footer">
  <div class="footer-left">
    <a href="./index.php"><img src="./assets/images/logo_light.png" /></a>
    <p>
    विश्व समाचार को संग्रह बिन्दु। एक बिसौनी पसल। हामी तपाईलाई संसारभरका वर्तमान घटनाहरू बाट ल्याउँछौं
    आदरणीय लेखकहरू। हामीले तपाईलाई ल्याएका यस प्लेटफर्म मार्फत पढ्न र हामीसँग रहन सुनिश्चित गर्नुहोस्। समयसीमा
    </p>
    <div class="socials">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-youtube"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
  </div>
  <ul class="footer-right">
    <li>
      <h2>द्रुत लिङ्कहरू</h2>
      <ul class="box">
        <li><a href="./index.php">गृह पृष्ठ</a></li>
        <li><a href="./categories.php">कोटीहरू</a></li>
        <li><a href="./bookmarks.php">बुकमार्कहरू</a></li>
        <li><a href="./search.php?trending=1">ट्रेन्डिङ</a></li>
      </ul>
    </li>
    <li>
      <h2>कोटीहरू</h2>
      <ul class="box">
        <?php

          // Category Query to fetch random 3 categories
  	      $categoryQuery= " SELECT  category_id, category_name
                            FROM category 
                            ORDER BY RAND() LIMIT 3";

          // Running Category Query
          $result = mysqli_query($con,$categoryQuery);

          // Returns the number of rows from the result retrieved.
          $row = mysqli_num_rows($result);


          // If query has any result (records) => If there are categories
          if($row > 0) {

          // Fetching the data of particular record as an Associative Array
          while($data = mysqli_fetch_assoc($result)) {

            // Storing the category data in variables
            $category_id = $data['category_id'];
            $category_name = $data['category_name'];
            
        ?>
        <li><a href="articles.php?id=<?php echo $category_id ?>"><?php echo $category_name ?></a></li>
        <?php  
              }
            }
          ?>
        <li><a href="./categories.php">More +</a></li>
      </ul>
    </li>
    
  </ul>
  <div class="footer-bottom">
    <p>सबै अधिकार  &copy; समयसीमा द्वारा सुरक्षित  <?php echo date("Y")?></p>
  </div>
</footer>

<!-- JQUERY SCRIPT -->
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- SCRIPT FOR BACK TO TOP BUTTON -->
<script src="../assets/js/back-to-top.js"></script>

<!-- SCRIPT FOR NAVBAR COLLAPSE -->
<script src="../assets/js/navbar-collapse.js"></script>
</body>

</html>