<?php
/*
	Linuxteam teilam Site
    Copyright (C) 2012-2013  Linuxteam teilam

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>
*/
require_once('./template/connection.php');

	$hostname=get_hostname();
	$id= $_GET['id'];
	if(!intval($id)){
		die("Wrong parameters");
	}
	
	$query_s="SELECT * FROM actions WHERE ACTIONID=:id";//.intval($id);
	try
	{
		$stmt=$conn->prepare($query_s);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		
		if(!$result || empty($result))
		{
			die("Δεν υπάρχει αυτό το event η η ενέργεια αυτή");
		}
		
		$forum_users = explode(', ', $result['USER']);
?>

<div id="events">
		<h2><a href="<?=$hostname;?>/action_viewer.php?id=<?=$result['ACTIONID']; ?>"><?= $result['TITLE']; ?></a></h2>
	<div class="event">
		<img id="cover" src="<?=$hostname.$result['COVERPATH'];?>" class="floatleft" style="margin-right: 1em;" />
		<div class="details" style="margin-left: 0;">
			<p class="other-details">
				<?php
				
					$editv="";					
					if(isset($_GET['event']) && $_GET['event']==1)
					{
						echo "<strong>Διοργανωτές:</strong> ";
					}
					else
					{
						echo "<strong>Δημιουργός:</strong> ";
					}

					$temp = 0;
					 foreach ($forum_users as $forum_user)
					 {
						if($temp == 1)
						{
							echo ', ';
						}
						$temp ++;

						echo '<a href="'. $hostname . '/phpBB3/memberlist.php?mode=viewprofile&un=' . $forum_user . '" title="">'. $forum_user .'</a>';

					}
				?>

				<?php if ($result['FORUM'] != ''): ?>
						<br /><br />
						<strong><a class="page-button" href="<?php echo $hostname;?>/phpBB3/<?php echo $result['FORUM']; ?>">Forum link</a></strong>
				<?php endif ?>
				<?php
					if(($user->data['user_id'] != ANONYMOUS))
					{
				?>
						<strong><a class="page-button" href="<?php echo $hostname;?>/image_upload.php?id=<?php echo $id?>">Μεταφόρτωση εικόνων</a></strong>
					
				<?php
						if($auth->acl_gets('a_'))
						{
				?>
							<strong><a class="page-button" href="<?php echo $hostname;?>/image_preview.php?id=<?php echo $id?>">Ορισμός εικόνων στο slideshow</a></strong>
				<?php
						}
					}
				?>

				<br />

				<?php echo $result['ABOUT']; ?>
			</p>
<?php	
	}
	catch(PDOException $e)
	{
		//die("Προεκυψε πρόβλημα παρακαλώ δοκιμάστε αργότερα");
		echo $e->getMessage()."<br>";
		
	}
?>

		</div>
		<div class="clearfix"></div>
	</div>

	 <div id="mini_pics" style="width:100%;"> -->
	<!--	the following is a template
			for what the js does
		<button></button>
		<button></button>
		<div></div>
	 </div> -->
	</div>
</div>






