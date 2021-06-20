<?php
	session_start();
	$user_sender=$_SESSION['id_user'];
	$user_receiver=$_COOKIE['userReceiver'];
	include('connect_database.php');
	$sql3="SELECT * FROM messages INNER JOIN user ON user.id_user=user_sender  WHERE (user_receiver='$user_receiver' AND user_sender='$user_sender') OR (user_receiver='$user_sender' AND user_sender='$user_receiver') ORDER BY heure DESC";
	$result3=mysqli_query($link,$sql3);
	while($data3=mysqli_fetch_assoc($result3)){

		if (($user_sender == $data3['user_sender']) && $user_sender == $_SESSION['id_user']) {
			echo '<div class="MessageSender">
					<p class="name"> Vous ('.$data3['user_name'].')</p>
					<div class="msg">
						'.$data3['contenu'].
					'</div>
					<span style="color:red;font-size:12px; class="time"> Envoyé le :'.$data3['heure'].'</span>
					</div>';
		}
		else {
			echo '<div class="MessageReciever">
					<p class="name">'.$data3['user_name'].'</p>
					<div class="msg">
						'.$data3['contenu'].
					'</div>
					
					<span style="color:red;font-size:12px; class="time"> Envoyé le :'.$data3['heure'].'</span>
					</div>';
		}
	}
?>
