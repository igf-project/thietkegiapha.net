<?php
$Cate_ID='';
if(isset($r['cate_id']))
	$Cate_ID = (int)$r['cate_id'];
if($Cate_ID!=''){
	?>
	<div class="box-question">
		<h3 class="title-header"><span><?php echo $r['title']; ?><span></h3>
		<div class="container">
			<div class="row">
				<?php
				$obj->getList(" AND cate_id=".$Cate_ID." ORDER BY cdate DESC ");
				while ($row = $obj->Fetch_Assoc()) {
					$name = stripslashes($row['title']);
					$code = stripslashes($row['code']);
					$link = ROOTHOST.$code.'.html';
					echo '
					<div class="col-sm-4">
					<div class="item"><a href="'.$link.'" title="'.$name.'">+ '.$name.'</a></div>
					</div>';
				}
				?>
			</div>
		</div>
	</div>
	<?php 
} ?>