<?php 

include "./dbconfig.php"; 

if(isset($_GET['logout'])) {
    session_destroy();
    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/external.css" />
</head>
<body>
    <header>
        <a href="./privacy.html">Privacy Policy</a>
        <a href="./tnc.html">Terms and Conditions</a>

        <?php if(!isset($_SESSION['username'])) { ?>
        <div class="dropdown">
            <button class="dropbtn">Login</button>
            <div class="dropdown-content">
                <a href="./authentication/login.php">Login into existing account</a>
                <a href="./authentication/register.php">Create a new account</a>
            </div>
        </div>

        <?php } else { ?>
        <div class="dropdown">
            <button class="dropbtn"><?php echo $_SESSION['username'] ?></button>
            <div class="dropdown-content">
                <a href="./authentication/changepwd.php">Change password</a>
                <a href="./index.php?logout=true">Logout</a>
            </div>
        </div>
        <?php } ?>

    </header>

    <section class="branding">
        <div class="left-align">
            <img src="./assets/images/logo.gif" alt="Music Hub" />
            <h1>MUSIC HUB</h1>
            <p>---------------------------------------------<br />One stop shop for all your musical needs</p>
        </div>
        <div class="right-align">
            <form action="search.html" method="get" id="searchbox">
                <input type="search" name="key" id="search-inp" placeholder="Search songs, artists, playlists,etc" />
                <button type="submit" id="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </section>

    <nav>
        <ul class="menubar">
            <li><a href="index.html">Home</a></li>
            <li><a href="hits.html">New Hits</a></li>
            <li><a href="recent.html">Recently Added</a></li>
            <li><a href="favs.html">Favourites</a></li>
            <li><a href="playlists.html">Playlists</a></li>
            <li><a href="about.html">About Us</a></li>
        </ul>
    </nav>

    <main>
        <section class="m-5" id="dynamic-container">
            <h1 class="d-inlineblock mb-5 text-center">Songs</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php 
                $sql_query = "SELECT name,album,views,singer,composer,songwriter,label,starring,image,link FROM music;";
                $result = mysqli_query($conn,$sql_query);
                while($row=mysqli_fetch_array($result)) {
            ?>
                <div class="col">
                    <div class="card h-100">
                    <img src="./assets/musicimg/<?php echo $row['image'] ?>" class="card-img-top" alt="musicimg-<?php echo $row['name'] ?>">
                    <audio controls>
                        <source src="./assets/music/<?php echo $row['link'] ?>" />
                    </audio>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name'] ?></h5>
                        <p class="card-text">Album:<?php echo $row['album'] ?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><?php echo "Views: ",$row['views'] ?></small>
                    </div>
                    </div>
                </div>
            <?php } ?>

            </div>
        </section>
    </main>

    <footer></footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>