<?php
$Album_ID='';$strwhere='';
if(isset($r['album']))
	$Album_ID = (int)$r['album'];
if($Album_ID!=''){
	$info_album = $obj->getInfo();
	$strwhere.=" AND album_id=".$Album_ID;
	$obj->getList($strwhere,'');
	?>
	<link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/swiper.min.css" rel="stylesheet">
	<div class="swiper-container phado">
		<div class="swiper-wrapper" id="gallery">
			<?php
			while ($row = $obj->Fetch_Assoc()) {
				$name = stripcslashes($row['name']);
				$thumb = getThumb(stripslashes(PATH_GALLERY.$row['link']),'img-responsive thumb',$name);
				$link = ROOTHOST.'mau-pha-do/'.$info_album['code'].'-'.$row['id'];
				echo '
				<div class="swiper-slide">
					<div class="item">
						<a href="'.PATH_GALLERY.$row['link'].'" title="'.$name.'">'.$thumb.'</a>
						<div class="caption"><a href="" title="'.$name.'">'.$name.'</a></div>
					</div>
				</div>';
			}
			?>
		</div>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>
	<div class="clearfix"></div>
	<div class="text-center"><a href="<?php echo ROOTHOST;?>mau-pha-do" title="Xem tất cả" class="viewall">Xem tất cả</a></div>
	<link href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>plugins/gallery/css/simplelightbox.css" type="text/css" rel="stylesheet" media="all">
	<script src='<?php echo ROOTHOST.THIS_TEM_PATH;?>plugins/gallery/js/simple-lightbox.js'></script>
	<script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>js/swiper.min.js"></script>
	<script>
		$(function(){
			$('#gallery .item>a').simpleLightbox();
		});
	</script>
	<script>
		var swiper = new Swiper('.swiper-container', {
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
			paginationClickable: true,
			slidesPerView: 3,
			spaceBetween: 0,
			breakpoints: {
				1024: {
					slidesPerView: 3,
					spaceBetween: 0
				},
				768: {
					slidesPerView: 3,
					spaceBetween: 0
				},
				640: {
					slidesPerView: 3,
					spaceBetween: 0
				},
				320: {
					slidesPerView: 2,
					spaceBetween: 0
				}
			}
		});
	</script>
	<?php 
}?>

