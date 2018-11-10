<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
?>
<div class="box1">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-6">
				<?php $this->loadModule('box1'); ?>
			</div>
		</div>
	</div>
</div>
<div class="box-service">
	<?php $this->loadModule('box2'); ?>
	<?php $this->loadModule('box3'); ?>
</div>
<?php $this->loadModule('box4'); ?>
<?php $this->loadModule('box5'); ?>
