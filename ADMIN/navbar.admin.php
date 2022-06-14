

<nav class="admin_navbar">
    <!-- username -->
    <div class="user_name">
        <h3 id="text_name_user"> <?= $_SESSION['auth_user']['user_name']; ?> </h3>
    </div>

    <!-- logo -->
    <figure class="figure" id="figure">
            <div class="logo"></div>
    </figure>

    <!-- navbar -->
    <div class="admin_navbar_wrapper">
        <ul>
            <li>
                <a href="index.admin.php" id="dashboard"> <h3>Dashboard</h3> </a>
            </li>

            <li>
                <a href="reizen.admin.php" id="reizen_link"> <h3>Reizen</h3> </a>
            </li>

            <li>
                <a href="bestemming.admin.php" id="bestemming_link"> <h3>Bestemming</h3> </a>
            </li>

            <li>
                <a href="accommodatie.admin.php" id="accommodatie_link"> <h3>Accommodatie</h3> </a>
            </li>

            <li>
                <a href="fac.admin.php" id="faciliteit_link"> <h3>Faciliteit</h3> </a>
            </li>

            <li>
                <a href="boeking.admin.php" id="boeking_link"> <h3>Boeking</h3> </a>
            </li>

              <li>
                <a href="../php/index.php" id=""> <h3>User Page</h3> </a>
            </li>
        </ul>
    </div>

    <!-- logout button -->
    <div class="logout">            
        <form action="../INCLUDES/logout.inc.php" method="POST">
            <button type="submit" class="a_logout_btn" name="logout_btn">Log Out</button>
        </form>
    </div>
</nav>