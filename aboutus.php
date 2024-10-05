<?php
  // Fetching all the Navbar Data
  require('./includes/nav.inc.php');
  
  
?>
    <div class="container">
        <h1>हाम्रो बारेमा</h1>

        <div class="member">
            <div class="photo">
                <img src="member1.jpg" alt="Member 1">
            </div>
            <div class="description">
                <h3>Member 1</h3>
                <p>Position: Team Leader</p>
                <p>Description: Member 1 has over 10 years of experience in the industry, specializing in project management and team building.</p>
            </div>
        </div>

        <div class="member">
            <div class="description">
                <h3>Member 2</h3>
                <p>Position: Developer</p>
                <p>Description: Member 2 is a skilled developer with a passion for coding and problem-solving.</p>
            </div>
            <div class="photo">
                <img src="member2.jpg" alt="Member 2">
            </div>
        </div>

        <div class="member">
            <div class="photo">
                <img src="member3.jpg" alt="Member 3">
            </div>
            <div class="description">
                <h3>Member 3</h3>
                <p>Position: Designer</p>
                <p>Description: Member 3 is a creative designer who brings ideas to life through innovative design solutions.</p>
            </div>
        </div>

        <div class="member">
            <div class="description">
                <h3>Member 4</h3>
                <p>Position: Marketer</p>
                <p>Description: Member 4 specializes in digital marketing and has a knack for crafting compelling campaigns.</p>
            </div>
            <div class="photo">
                <img src="member4.jpg" alt="Member 4">
            </div>
        </div>
    </div>


<?php

  // Fetching all the Footer Data
  require('./includes/footer.inc.php');
?>