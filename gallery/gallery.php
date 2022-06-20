<!doctype html>
<html lang="cs-CZ">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="Petr Tůma">
<title>PPV2022</title>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
	<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/gallery/gallery.css?v=0">
<link rel="stylesheet" href="/gallery/swipebox/src/css/swipebox.css">
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/mdb.min.css">
</head>

<body>
<div id="page-header" class="mb-2 mb-sm-0">
    <div id="header" class="container ppv-section"></div>
		<!-- MENU -->
		<div id="menu" class="container ppv-section">
		    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
				    <div class="container-fluid">
                <a class="navbar-text" href="/">PPV 2022 Letiště Havlíčkův Brod</a>
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                    </button>

					      <div class="collapse navbar-collapse" id="navbarNav">
						        <ul class="navbar-nav ms-auto">
						            <li class="nav-item"><a class="nav-link" aria-current="page" href="./documents.html">Dokumenty</a></li>
                        <li class="nav-item"><a class="nav-link" href="./competitorlist.html">Startovní listina</a></li>
                        <li class="nav-item"><a class="nav-link" href="/gallery/gallery.php">Foto</a></li>
						            </ul>
                    </div>
                </div>
            </nav>
		    </div>
    </div>

<div class="container">
    <?php if (isset($_POST['dir'])) { $post_dir = $_POST['dir']; } else { $post_dir = ''; } ?>
    <div class="gallery-container" data-dir="<?php echo $dir_name ?>">
        <div class="frame-main"></div>
        <div class="frame-sub"></div>
        </div>
	  </div>

<div id="page-footer">
		<div id="footer" class="container ppv-section"></div>
    </div>

<button class="btn-set fas fa-cog"></button>
<button class="btn-top fa fa-angle-up"></button>
</body>

<script src="js/jquery-3.6.0.min.js"></script>
<script src="swipebox/src/js/jquery.swipebox.js"></script>
<script src="js/gallery.js?v=6"></script>
</html>
