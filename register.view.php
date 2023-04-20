<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Shaiya Kayıt</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<h3>Hesap Oluştur</h3>
		<?php if(count($errors)){ ?>
			<ul style="color:red; list-style:none;">
				<?php foreach($errors as $error){ ?>
					<li><?php echo $error; ?></li>
				<?php } ?>
			</ul>
		<?php } ?>
		<form action="register.php" method="post">
			<div style="width:436px; border:1px solid #000000; padding:16px;">
				Kullanıcı Adı
				<input name="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>" style="width:100%;" />
				<div style="height: 5px;">&nbsp;</div>
				Şifre							
				<input name="password" type="password" value="<?php if(isset($_POST['password'])){ echo $_POST['password']; } ?>" style="width:100%;" />
				<div style="height: 5px;">&nbsp;</div>
				Şifre Tekrar							
				<input name="password2" type="password" value="<?php if(isset($_POST['password2'])){ echo $_POST['password2']; } ?>" style="width:100%;" />
				<div style="height: 5px;">&nbsp;</div>
				<input type="submit" value="Create Account" />
			</div>
		</form>
		<br><b>www.shaiyapazar.com<b>
	</body>
</html>
