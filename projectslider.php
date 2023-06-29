<?php
	$i = 0;
	$projectList = array(array());

	$args = array('post_type' => 'portfolio', 'posts_per_page' => 15, 'orderby'=>'date', 'order'=>'DESC');

	$cats = get_categories($args);

	$list_of_posts = new WP_Query( $args );
	//sort($list_of_posts);
	while ( $list_of_posts->have_posts() ) :
		
		$list_of_posts->the_post();

		$projectList[$i]['postLink'] = get_post_permalink();
		$projectList[$i]['title'] = get_the_title();
		$projectList[$i]['excerpt'] = get_field('post_excerpts').'...<a class="pjdSM" href="'.get_post_permalink().'">See the full project here.</a>';
		$projectList[$i]['excerpt2'] = get_field('post_excerpts');
		$projectList[$i]['postAlt'] = $projectList[$i]['title'];
		$projectList[$i]['postImg'] = get_template_directory_uri().'/images/pfDefault.jpg';

		if(has_post_thumbnail()){
			$projectList[$i]['postImg'] = get_the_post_thumbnail_url();
			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
			if($projectList[$i]['postImg'] == ''){
				$projectList[$i]['postImg'] = get_template_directory_uri().'/images/pfDefault.jpg';
			}
		}

		$i++;

	endwhile;

	$total = $i;
	$totalThrd = $total / 3;

	wp_reset_postdata();

	$prjCount1 = 0;
	$prjCount2 = 1;
	$prjCount3 = 2;

?>

<div id="prmSlider">
	
	<div class="swiper-container">
		
		<div class="swiper-wrapper">

			<?php foreach($projectList as $project){ ?>

				<div class="swiper-slide">
					<a href="<?php echo $project['postLink'];?>">
						<div class="bgImage" style="background-image: url('<?php echo $project['postImg'];?>');"></div>
						<img class="imageAbove" src="<?php echo $project['postImg'];?>" alt="<?php echo $project['postAlt'];?>" />
						<div class="prjDetail">
							<div class="rel">
								<span class="pjdTitles"><?php echo $project['title'];?></span>
								<span class="pjdExcerpt"><?php echo $project['excerpt'];?></span>
							</div>
						</div><!-- END OF PRJDETAIL -->
					</a>
				</div>

			<?php }?>

		</div><!-- END OF SWIPER WRAPPER -->

	</div><!-- END OF SWIPER CONTAINER -->

</div><!-- END OF PRMSLIDER -->



<div id="projSlider">
	
	<div class="swiper-container">
		
		<div class="swiper-wrapper">

			<?php foreach($projectList as $project){ ?>

				<div class="swiper-slide">
					
					<div class="projLeft">
						<div class="bgImage" style="background-image: url('<?php echo $project['postImg'];?>');"></div>
						<img class="imageAbove" src="<?php echo $project['postImg'];?>" alt="<?php echo $project['postAlt'];?>" />
					</div>

					<div class="projRight">
						<div class="rel">
							<div class="hblgTitles"><?php echo $project['title'];?></div>
							<div class="hblgExcerpt"><?php echo $project['excerpt2'];?></div>
							<div class="hblgSMlinks">
								<span><a href="<?php echo $project['postLink'];?>">See the full project here ></a></span>
							</div>
						</div>
					</div>

					<div class="clear"></div>

				</div>

			<?php }?>

		</div><!-- END OF SWIPER WRAPPER -->

	</div><!-- END OF SWIPER CONTAINER -->

</div><!-- END OF PROJSLIDER -->


<script type="text/javascript">

	var pjSlider;
	var pmSlider;

    $(document).ready(function(){

    	
    	pmSlider = new Swiper('#prmSlider .swiper-container',{
			speed: 1100,
			autoplay: {
				delay: 4000,
				disableOnInteraction: false,
			},
			preloadImages: true,
			lazy: false,
			effect: 'slide',
			autoHeight: true,
			roundLengths: true,
			loop: true
		});


    	pjSlider = new Swiper('#projSlider .swiper-container',{
			speed: 1100,
			autoplay: {
				delay: 4000,
				disableOnInteraction: false,
			},
			preloadImages: true,
			lazy: false,
			effect: 'slide',
			autoHeight: true,
			roundLengths: true,
			loop: true
		});

    });

    $(window).on('load', function(){ // WAITS TILL THE WHOLE PAGE LOADS
    	<?php if($total > 1){ ?>
			pmSlider.update();
		<?php }?>

		<?php if($total > 3){ ?>
			pjSlider.update();
		<?php }?>

	});

	$(window).resize(function() {
		<?php if($total > 1){ ?>
			pmSlider.update();
		<?php }?>

		<?php if($total > 3){ ?>
			pjSlider.update();
		<?php }?>
	});

</script>
