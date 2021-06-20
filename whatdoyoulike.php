<!DOCTYPE html>
<html>
<head>
	<title>Whatdoyoulike</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/whatdoyoulikestyle.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/all.css">
	<link rel="shortcut icon" type="image/png" href="images/fav.png"/>
</head>
<body>
	<div class="page">
		<div class="description-section page-side section-open">
			<div class="icon">
				<img src="Image/description-icon.jpg" width="150">
                <p class="title" style="color:black;">Your Description</p>
			</div>
			<div class="description-form-area">
				<p class="form-title">Description</p>
				<div class="section-form">
					<form action="includes/checkdescription.php" method="post" class="description-form" enctype="multipart/form-data">
						<div class="form-floating">
							<label for="labdesc" class="label" style="margin-top: 10px"><span style="color: #0C67ED;">Write Something About You ..</span></label>
							<br>
							<textarea name="yourDescription" class="form-control" id="labdesc" cols="100" rows="10" maxlength="60">Hey, i'm using KadimiMessagerie</textarea>
						</div>
						<div>
							<label for="picture" style="margin-top: 25px;margin-bottom: 10px;color: #0C67ED;">Choose Your Profil Picture</label>
							<input type="file" name="picture" class="form-control form-control-lg" style="margin-bottom: 25px;">			
						</div>
						<div class="description-form-submit-btn" >	
							<input type="submit" name="description" value="Confirm" style="margin-bottom: 25px;">
						</div>
					</form>
					<div class="gotohobbies">
						<button class="btn btn-primary">Skip</button>
					</div>
				</div>
			</div>
		</div>
		<div class="hobbies-section page-side section-close">
			<div class="icon">
				<img src="Image/hobbies-icon.png" width="150">
				<p class="title">Your Hobbies</p>
			</div>
			<div class="hobbies-form-area">
				<p class="form-title">Hobbies</p>
				<div class="section-form">
					<form action="includes/checkhobbies.php" method="post" class="hobbies-form">
					<div class="btn-group" role="group" aria-label="Basic checkbox toggle button group"> 
						<input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off" name="sports" value="1">
  						<label class="btn btn-outline-primary" for="btncheck1">Sports</label>

  						<input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off" name="politics" value="1"> 
  						<label class="btn btn-outline-primary" for="btncheck2">Politics</label>

  						<input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off" name="music" value="1">
  						<label class="btn btn-outline-primary" for="btncheck3">Music</label>

  						<input type="checkbox" class="btn-check" id="btncheck4" autocomplete="off" name="gaming" value="1">
  						<label class="btn btn-outline-primary" for="btncheck4">Gaming</label>

  						<input type="checkbox" class="btn-check" id="btncheck5" autocomplete="off" name="science" value="1">
  						<label class="btn btn-outline-primary" for="btncheck5">Science</label>
                	</div>
                		<div class="hobbies-form-submit-btn">
                			<input type="submit" name="hobbies" value="Confirm" style="margin-top: 25px;margin-bottom: 25px">
                		</div>
					</form>
					<div class="backtodescription">
						<button class="btn btn-primary"><span style="color: black">Back</span></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery-1.12.1.min.js"></script>
	<script src="js/whatdoyoulikeScript.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>
</html>