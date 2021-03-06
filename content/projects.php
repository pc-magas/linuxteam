<h2>Τα project της κοινότητας μας</h2>
<p>
	Αποτελούν projects της κοινότητάς μας τα οποία:
</p>
	<ul>
		<li>Είτε είναι ελεύθερο/ανοικτό λογισμικό από τα μέλη μας. (Υπό την κατάλληλη άδεια πχ GNU-GPL)</li>
		<li>Είτε είναι projects υλικού όπου συσχετίζεται με το ελεύθερο-ανοικτό λογισμικό η με ιδέες εφάμιλες με το ελεύθρο λογισμικό πχ: opensource hardware, raspberry pi κλπ.</li>
	</ul>
<p>
	Ακόμη η σελίδα αυτή αποτελεί μια πηγή έμπνευσης είτε για ξεκινήσετε δικά σας project είτε για την πτυχιακή σας εργασία. Ελπίζουμε να σας φανούν χρήσιμες οι ιδέες μας.
</p>

<h2>Η κοινότητά μας έχει τα εξής project:</h2>
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
	require('./template/connection.php');
	$hostname=get_hostname();
	
	try
	{
		$stmt=$conn->prepare("SELECT * from actions NATURAL JOIN projects");
		$stmt->execute();
?>

<div id="projects">
<?php
		foreach($stmt->fetch(PDO::FETCH_ASSOC) as $result)
		{
			$forum_user = $result['USER'];
?>
		<div class="project">
			<a  href="<?php echo $hostname;?>/image_upload.php?id=<?php echo $result['ACTIONID']?>&type=cover"><img class="cover floatleft" src="<?php echo $hostname.$result['COVERPATH'];?>"></img></a>

			<div class="details floatleft">
				<h3> <?php echo $result['TITLE']; ?></h3>
				<p>
					<strong>Δημιουργός: </strong> <?php echo '<a href="'. $hostname . '/phpBB3/memberlist.php?mode=viewprofile&un=' . $forum_user . '" title="">'. $forum_user .'</a>'; ?>
				</p>
				<p>
					<strong>Repo: </strong><a href="<?php echo $result['GIT']?>"><?php echo $result['GIT']?></a>
				</p>
				<p>
					<strong>Licence: </strong><?php echo $result['LICENCE'];?>

					<br />
					<br />

					<strong><a class="page-button" href="<?php echo $hostname;?>/phpBB3/<?php echo $result['FORUM']?>">Forum link</a></strong>
					<a class="page-button" href="<?php echo $hostname;?>/action_viewer.php?id=<?php echo $result['ACTIONID']?>">More Info</a>
<?php
					if($user->data['user_id'] != ANONYMOUS)
					{
?>
						<a class="page-button" href="<?php echo $hostname?>/add_project.php?id=<?php echo $result['ACTIONID'];?>&edit=1">Επεξεργασία</a>
						<a class="page-button" href="<?php echo $hostname;?>/image_upload.php?id=<?php echo $result['ACTIONID']?>&type=image">Μεταφόρτωση Εικόνας</a>
					
<?php
					}
?>
				</p>
			</div>
			<div class="clearfix"></div>
		</div>
<?php
		}
	}
	catch(PDOException $e)
	{
		echo "An error occured";
	}
?>
</div>

<?php
	if($user->data['user_id'] != ANONYMOUS){
?>
	<a id="add-project-button" href="<?php echo $hostname?>/add_project.php?id=1&edit=0">Προσθήκη project</a>
<?php
	}
?>
