<?php
$Album_ID='';
if(isset($r['album']))
	$Album_ID = (int)$r['album'];
if($Album_ID!=''){
	?>
	<div class="swiper-container phado">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="item">
					<a href="" title=""><img src="<?php echo ROOTHOST;?>images/root/image5.jpg" src="" class="img-responsive thumb"></a>
					<div class="caption"><a href="" title="">Gia phả họ đặng</a></div>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="item">
					<a href="" title=""><img src="<?php echo ROOTHOST;?>images/root/image5.jpg" src="" class="img-responsive thumb"></a>
					<div class="caption"><a href="" title="">Gia phả họ đặng</a></div>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="item">
					<a href="" title=""><img src="<?php echo ROOTHOST;?>images/root/image5.jpg" src="" class="img-responsive thumb"></a>
					<div class="caption"><a href="" title="">Gia phả họ đặng</a></div>
				</div>
			</div>
		</div>
		<!-- Add Pagination -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>
	<div class="clearfix"></div>
	<div class="text-center"><a href="" title="Xem tất cả" class="viewall">Xem tất cả</a></div>
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