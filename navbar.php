
<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		/*background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important*/
	}
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark' >
	
		
		<div class="sidebar-list">
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt "></i></span> Analytics</a>
				<?php if($_SESSION['login_faculty_id'] <= 0): ?>
				<a href="index.php?page=courses" class="nav-item nav-courses"><span class='icon-field'><i class="fa fa-th-list "></i></span> Course</a>
				<a href="index.php?page=subjects" class="nav-item nav-subjects"><span class='icon-field'><i class="fa fa-book "></i></span> Subject</a>
				<a href="index.php?page=class" class="nav-item nav-class"><span class='icon-field'><i class="fa fa-list-alt "></i></span> Class</a>
				<a href="index.php?page=faculty" class="nav-item nav-faculty"><span class='icon-field'><i class="fa fa-user-tie "></i></span> Faculty</a>
				<a href="index.php?page=students" class="nav-item nav-students"><span class='icon-field'><i class="fa fa-user-friends "></i></span> Student</a>
				<a href="index.php?page=class_subject" class="nav-item nav-class_subject"><span class='icon-field'><i class="fa fa-user-friends "></i></span> Class per Subject</a>
				<?php endif; ?>
				
				<a href="https://docs.google.com/forms/d/1JjyIMwaC6J2aWgmAtsBdm_8VjW3LG6dlOoWY6Ru9qyI/edit" class="nav-item nav-attendance_record"><span class='icon-field'><i class="fa fa-tasks "></i></span> Attendance Record</a>
				<a href="https://docs.google.com/spreadsheets/d/1UJ3TbaS3HIQZJkFlkguwJTx40QXszJuhSnOs3wvEwEs/edit?resourcekey=&gid=1594982017#gid=1594982017" class="nav-item nav-attendance_report"><span class='icon-field'><i class="fa fa-tasks "></i></span> Attendance Report</a>
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users "></i></span> Users</a>
				<!-- <a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs text-danger"></i></span> System Settings</a> -->
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
