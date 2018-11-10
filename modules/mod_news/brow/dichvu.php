<?php
$Cate_ID='';
if(isset($r['cate_id']))
	$Cate_ID = (int)$r['cate_id'];
if($Cate_ID!=''){
	$Child_ID = $obj_cate->getCatIDChild('',$Cate_ID);
	?>
	<h3 class="title-header"><span><?php echo $r['title'] ?><span></h3>
	<div class="container service">
		<div class="row">
			<?php
			$obj_cate->getList(" AND cate_id IN($Child_ID) ORDER BY `order` ASC");
			while ($row = $obj_cate->Fetch_Assoc()) {
				$name = stripslashes($row['name']);
				$ar_name = explode(',',$name);
				$number = count($ar_name);
				if($number>1){
					$name1 = $ar_name[0].',<br/>'.$ar_name[1];
				}else{
					$name1 = stripslashes($row['name']);
				}
				$code = stripslashes($row['code']);
				$thumb = getThumb(stripslashes($row['thumb']),'img-responsive thumb',$name);
				$link = ROOTHOST.$code;
				echo '
				<div class="col-sm-4">
					<a href="'.$link.'" title="'.$name.'">'.$thumb.'</a>
					<div class="name"><a href="'.$link.'" title="'.$name.'">'.$name1.'</a></div>
				</div>';
			}
			?>
		</div>
	</div>
	<?php 
} ?>