<div id="set-main">
	<div id="nav-search">
		<a class="menu-search" href="#">搜索</a>
	</div>
	<div id="nav-login">
		<?php
			if ( is_user_logged_in() ) {
				echo '<a href="#login" class="flatbtn" id="login-main" >管理</a>';
			} else {
				echo '<a href="#login" class="flatbtn" id="login-main" >登录</a>';
			}
		?>
	</div>
</div>