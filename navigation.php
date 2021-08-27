<nav id="navHead" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="index.php">Kryptonix</a>
        </div>
	<font size="2">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
               <?php if(isset($_SESSION['loggedIn']) && $_SESSION['userType']==1)
               {   ?>
                 <li>
                    <a class="page-scroll" href="play.php">Play</a>
                </li>
                 <li>
                     <a class="page-scroll" href="leaderBoard.php">Leaderboard</a>
                </li>
               <?php }   ?>
                 <li>
                    <a class="page-scroll" href="about.php">About Us</a>
                </li>
               
                <li>
                    <a class="page-scroll" href="rules.php">Rules</a>
                </li>
                <li >
                    <?php
                   if(isset($_SESSION['loggedIn']))
                       echo '<a id="lnkSignup" style="margin-left: 5px" href="https://www.facebook.com/kxoffice">Hints</a>';
                   else 
                       echo ' <a id="lnkSignup"  href="login.php">Login</a>'; 
                   ?>
                </li>
                <li>
                   <?php
                   if(isset($_SESSION['loggedIn']))
                       echo '<a id="lnkSignup" style="margin-left: 5px" href="logout.php">Logout</a>';
                   else 
                       echo ' <a id="lnkSignup" style="margin-left: 5px" href="register.php">Register</a>'; 
                   ?>
                   
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>