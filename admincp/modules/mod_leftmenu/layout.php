<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
if(!isset($objuser)) $objuser = new CLS_USERS();
?>
<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="images/user2-160x160.jpg" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo $_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN']; ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>
			<li class="active treeview">
				<a href="#">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
			</li>
			<li class="treeview">
				<a href="index.php?com=gallery">
					<i class="fa fa-picture-o"></i> <span>Thư viện ảnh</span>
				</a>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-newspaper-o"></i>
					<span>Tin tức</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="index.php?com=category"><i class="fa fa-circle-o"></i> Nhóm tin</a></li>
					<li><a href="index.php?com=contents"><i class="fa fa-circle-o"></i> Tin tức</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-newspaper-o"></i>
					<span>Sản phẩm</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="index.php?com=vendor"><i class="fa fa-circle-o"></i>Nhà cung cấp</a></li>
					<li><a href="index.php?com=partner"><i class="fa fa-circle-o"></i> Đối tác</a></li>
					<li><a href="index.php?com=catalogs"><i class="fa fa-circle-o"></i> Nhóm sản phẩm</a></li>
					<li><a href="index.php?com=product&task=add"><i class="fa fa-circle-o"></i> Thêm sản phẩm</a></li>
					<li><a href="index.php?com=product"><i class="fa fa-circle-o"></i> Danh sách sản phẩm</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-users"></i>
					<span>Thành viên</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="index.php?com=member&task=add"><i class="fa fa-circle-o"></i> Thêm thành viên</a></li>
					<li><a href="index.php?com=member"><i class="fa fa-circle-o"></i> Danh sách thành viên</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="index.php?com=slider">
					<i class="fa fa-desktop"></i> <span>Banner slide</span>
				</a>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-desktop"></i>
					<span>Quản lý Menu</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="index.php?com=menus&task=add"><i class="fa fa-circle-o"></i> Thêm mới Menu</a></li>
					<li><a href="index.php?com=menus"><i class="fa fa-circle-o"></i> Danh sách Menu</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="index.php?com=module">
					<i class="fa fa-desktop"></i> <span>Quản lý Module</span>
				</a>
			</li>
			<?php
			// require_once(libs_path.'cls.menu.php');
			// require_once(libs_path.'cls.menuitem.php');
			// $obj_menu = new CLS_MENU();
			// $obj_menu->getList();
			// while ($row = $obj_menu->Fetch_Assoc()) {
			// 	echo '
			// 	<li class="treeview">
			// 		<a href="#"><i class="fa fa-desktop"></i>'.$row['name'].'<i class="fa fa-angle-left pull-right"></i></a>
			// 		<ul class="treeview-menu">
			// 			<li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
			// 			<li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
			// 			<li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
			// 		</ul>
			// 	</li>';
			// }
			?>
			<!--
			<li class="treeview">
				<a href="#">
					<i class="fa fa-share"></i> <span>Quản lý MenuItem</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					 <li>
						<a href="#"><i class="fa fa-circle-o"></i> Level One</a>
						<ul class="treeview-menu">
							<li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
							<li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
							<li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
							<li>
								<a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
								<ul class="treeview-menu">
									<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
									<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li> 
				</ul>
			</li> -->
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
