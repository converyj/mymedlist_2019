<nav id="navBar" class="nav">
    <a href="home.php">
        <img class="logo" src="images/logo.jpg" alt="mymedlist" />
    </a>
    <ul>
        <li>
            <a href="home.php">Home</a>
        </li>
        <li>
            <a href="contact.php">Contact</a>
        </li>
        <!-- if already logged in, change navigation  -->
        <?php 
            if (isset($_SESSION['logged-in'])) {
            ?>
                <li>
                    <a href="menu.php">Menu</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            <?php 
            } else { 
            ?>
                <li>
                    <a href="login.php">Sign In</a>
                </li>
                <li>
                    <a href="register.php">Register</a>
                </li>
            <?php
            }
        ?>							
    </ul>
    <button class="hamburger_btn" id="icon">
            <span class="fa fa-bars"></span>
    </button>
</nav>