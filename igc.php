<?php

	// Recipient 
	$to = 'igc@ppvcup.cz'; 


	$igcErrorOutput = '';

	// send mail
 	if ( !empty($_POST["imatriculation"]) && !empty($_FILES["igcfile"]["name"]) ) {

		$target_dir = "igc/";
		$target_file = $target_dir . basename($_FILES["igcfile"]["name"]);
		$uploadOk = 1;

		// Check if file already exists
		if (file_exists($target_file)) {
			// localization
			// $igcErrorOutput .= "Sorry, file already exists.";
			$uploadOk = 0;
		}

		// TODO: limit to IGC file size
		// Check file size
		if ( !empty($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["size"] > 1) {
			// localization
			$igcErrorOutput .= "Váš soubor je příliš velký, prosím zkontrolujte, zda se jedná o platný IGC soubor. V případě že je platný, zašlete ho na adresu " . $to . " ze svého e-mailu.<br />";
			// Sorry, your file is too large.
			$uploadOk = 0;
		}

		// TODO: honeypot


// Allow certain file formats
/*
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}
*/

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			// localization
			// $igcErrorOutput .= "IGC soubor nebyl odeslán.<br />";
			// Sorry, your file was not uploaded.
		// if everything is ok, try to upload file
		} else {
  			if (move_uploaded_file($_FILES["igcfile"]["tmp_name"], $target_file)) {
				// localization
				// $igcErrorOutput = "The file ". htmlspecialchars( basename( $_FILES["igcfile"]["name"])). " has been uploaded.";
  			} else {
				// localization
    			$igcErrorOutput .= "Z technických důvodů se nepodařilo odeslat IGC soubor. Prosím zašlete ho na adresu " . $to . " ze svého e-mailu.<br />";
				// Sorry, there was an error uploading your file."
			}
		}


		 
		// Sender 
		$from = 'ppvcup@ppvcup.cz'; 
		$fromName = 'PPV Cup 2022'; 
		 
		// Email subject 
		$subject = 'IGC soubor od ' . $_POST["imatriculation"];
		 
		// Attachment file 
		$file = "igc/" . $_FILES["igcfile"]["name"]; 
		 
		// Email body content 
		$htmlContent = 'imatrikulace: ' . $_POST["imatriculation"]; 
		 
		// Header for sender info 
		$headers = "From: $fromName"." <".$from.">"; 
		 
		// Boundary  
		$semi_rand = md5(time());  
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
		 
		// Headers for attachment  
		$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
		 
		// Multipart boundary  
		$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
		"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
		 
		// Preparing attachment 
		if(!empty($file) > 0){ 
		    if(is_file($file)){ 
		        $message .= "--{$mime_boundary}\n"; 
		        $fp =    @fopen($file,"rb"); 
		        $data =  @fread($fp,filesize($file)); 
		 
		        @fclose($fp); 
		        $data = chunk_split(base64_encode($data)); 
		        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
		        "Content-Description: ".basename($file)."\n" . 
		        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
		        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
		    } 
		} 
		$message .= "--{$mime_boundary}--"; 
		$returnpath = "-f" . $from; 
		 
		// Send email 
		$mail = @mail($to, $subject, $message, $headers, $returnpath);  
		 
		// Email sending status 
		// localization
		// $igcErrorOutput = $mail?"<h1>Email Sent Successfully!</h1>":"<h1>Email sending failed.</h1>"; 
		$igcErrorOutput .= $mail ? "" : "IGC soubor se nepodařilo odeslat. Prosím zašlete ho na adresu " . $to . " ze svého e-mailu.<br />";
	}

?>


<!DOCTYPE html>
<html lang="cs">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<title>PPV2022</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;500&display=swap" rel="stylesheet" />
	<!-- MDB -->
	<link rel="stylesheet" href="css/mdb.min.css" />
	<!-- Custom styles -->
	<link rel="stylesheet" href="css/style.css" />
</head>

<body class="page-index">

	<div id="page-header">
		<div id="header" class="container ppv-section"></div>

		<!-- MENU -->
		<div id="menu" class="container ppv-section">
			<nav class="navbar navbar-expand-md navbar-dark bg-dark">
				<div class="container-fluid">

					<a class="navbar-text" href="/">
						PPV 2022 Letiště Havlíčkův Brod
					</a>


					<button
						class="navbar-toggler"
						type="button"
						data-mdb-toggle="collapse"
						data-mdb-target="#navbarNav"
						aria-controls="navbarNav"
						aria-expanded="false"
						aria-label="Toggle navigation"
					>
						<i class="fas fa-bars"></i>
					</button>

					<div class="collapse navbar-collapse" id="navbarNav">

					</div>
				</div>
			</nav>
		</div>

	</div>




	<div id="page-content">
		<h1 class="container ppv-page-title mb-3">Odeslání IGC</h1>

		<div class="container">
			<?php if ( $igcErrorOutput != "" ): ?>
				<div><?php echo($igcErrorOutput); ?></div>
			<?php else: ?>
			
				<?php if ( !empty($_POST["imatriculation"]) && !empty($_FILES["igcfile"]["name"]) ): ?>
					<div>IGC soubor byl odeslán pořadateli soutěže</div>
				<?php else:	?>
					<form action="igc.php" method="post" enctype="multipart/form-data">

						<input type="hidden" name="sent" value="true" />

						<div class="row mt-2 mb-4">
							
							<div class="col-3 ppv-section">
								<label for="imatriculation">Imatrikulace kluzáku</label>
								<div>
									<input type="text" class="form-control" name="imatriculation" id="imatriculation" />
								</div>
								<?php if ( !empty($_POST["sent"]) && empty($_POST["imatriculation"]) ): ?>
									<div class="ppv-warning">Napište prosím imatrikulaci kluzáku.</div>
								<?php endif; ?>
							</div>

							<div class="col-3 ppv-section">
								<label for="igcfile">Igc soubor</label>
								<div>
									<input type="file" class="form-control" name="igcfile" id="igcfile" />
								</div>

								<?php if ( !empty($_POST["sent"]) && empty($_FILES["igcfile"]["name"]) ): ?>
									<div class="ppv-warning">Přiložte prosím IGC soubor.</div>
								<?php endif; ?>
							</div>

							<div class="col-3 ppv-section">
								&nbsp;
								<div>
									<input type="submit" class="btn btn-primary" value="Poslat" name="submit" />
								</div>
							</div>
						</div>



						<div>V případě jakýchkoli problémů prosím zašlete IGC soubor na adresu <?php echo($to); ?> ze svého e-mailu.</div>

					</form>

				<?php endif; ?>

			<?php endif; ?>
		</div>
	</div>


	<div id="page-footer">
		<div id="footer" class="ppv-section"></div>
	</div>

	<script type="text/javascript" src="js/mdb.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
	<!-- Custom scripts -->
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/page.index.js"></script>
</body>

</html>