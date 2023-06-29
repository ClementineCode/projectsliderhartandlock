<?php if(have_rows('home_mid_callout')){ ?>

	<div id="hlMidbottom">

		<div class="bxWrappers">
		
			<?php 
				while(have_rows('home_midbottom')){ 
					the_row();
					$hrPhoto = get_sub_field('home_right_photo');
					$hrAlt = $hrPhoto['alt'];
					$hrPhoto = $hrPhoto['url'];

					if(have_rows('home_left_text')){
						while(have_rows('home_left_text')):
							the_row();
							$hlTitle = get_sub_field('home_left_text_title');
							$hlText = get_sub_field('home_left_main_text');

							$hlButton = get_sub_field('home_left_button_text');
							if($hlButton == '' || $hrButton == NULL){
								$hlButton = 'See More';
							}

							$hlbLink = get_sub_field('home_left_button_link');
						endwhile;
					}
			?>

			<?php }?>

			<div id="hmidRight" class="imgtxtPhoto homeRight">
				<div class="flexCenter">
					<div class="bgImage effect2" style="background-image: url('<?php echo $hrPhoto; ?>');"></div>
					<img src="" data-src="<?php echo $hrPhoto; ?>" class="imageAbove" alt="<?php echo $hrAlt; ?>" title="<?php echo $hrAlt; ?>" />
				</div>
			</div>

			<div id="hmidLeft" class="imgtxtCopy homeLeft">

				<div class="rel">

					<?php if($hlTitle != '' && $hlTitle != NULL){ ?>
						<h1><?php echo $hlTitle;?></h1>
					<?php }?>

					<?php echo $hlText;?>

					<?php if($hlbLink != '' && $hlbLink != NULL){ ?>
						<div class="hlkbContainer">
							<a href="<?php echo $hlbLink;?>" class="hldButtons hlButtons">
								<?php echo $hlButton;?>
							</a>
						</div>
					<?php } ?>

				</div>

			</div>

			<div class="clear"></div>

		</div>

	</div>

<?php }?>


<?php
	$i = 0;
	$j = 1;
	$postTotal;
	$blogList = array(array());

	$args = array('posts_per_page' => 3, 'orderby'=>'date', 'order'=>'DESC');

	$list_of_posts = new WP_Query( $args );
	//sort($list_of_posts);
	while ( $list_of_posts->have_posts() ) :
		
		$list_of_posts->the_post();

		$blogList[$i]['link'] = get_permalink($post->ID);
		$blogList[$i]['postTitle'] = get_the_title();
		$blogList[$i]['excerpt'] = get_field('post_excerpts',$post->ID);
		
		$thumbnail_id;
		$blogList[$i]['postImg'];
		$blogList[$i]['postAlt'] = get_bloginfo('name');
		$alt;

		if(has_post_thumbnail()){
			$blogList[$i]['postImg'] = get_the_post_thumbnail_url();
			$thumbnail_id = get_post_thumbnail_id($post->ID);
			$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
			if($blogList[$i]['postImg'] == ''){
				$blogList[$i]['postImg'] = get_template_directory_uri().'/images/postDefault.jpg';
			}

			if($alt != ''){
				$blogList[$i]['postAlt'] = esc_html ( $alt );
			}
		}

		$i++;

	endwhile;

	$postTotal = $i;

	wp_reset_postdata();
?>

<?php if($postTotal > 0){ ?>

	<div id="hlpContainer">
		
		<?php foreach($blogList as $blog){?>

			<div id="hblgItem<?php echo $j;?>" class="hblgItems">
				<?php if(wp_is_mobile()){ ?>
					
					<div class="bgImage" style="background-image: url('<?php echo $blog['postImg'];?>');"></div>
					<img class="imageAbove" src="<?php echo $blog['postImg'];?>" alt="<?php echo $blog['postAlt'];?>" />
					<div class="hblgInner">
						<div class="rel">
							<span class="hblgTitles"><?php echo $blog['postTitle'];?></span>
						</div>
					</div>
					<div class="hblgExpand">
						<div class="rel">
							<span class="hblgTitles"><?php echo $blog['postTitle'];?></span>
							<div class="hblgExcerpt"><?php echo $blog['excerpt'];?></div>
							<a href="<?php echo $blog['link'];?>">Read More</a>
						</div>
					</div>

				<?php }else{ ?>
					
					<a href="<?php echo $blog['link'];?>">
						<div class="bgImage" style="background-image: url('<?php echo $blog['postImg'];?>');"></div>
						<img class="imageAbove" src="<?php echo $blog['postImg'];?>" alt="<?php echo $blog['postAlt'];?>" />
						<div class="hblgInner">
							<div class="rel">
								<span class="hblgTitles"><?php echo $blog['postTitle'];?></span>
							</div>
						</div>
						<div class="hblgExpand">
							<div class="rel">
								<span class="hblgTitles"><?php echo $blog['postTitle'];?></span>
								<div class="hblgExcerpt"><?php echo $blog['excerpt'];?></div>
								<a class="hbrmLinks" href="<?php echo $blog['link'];?>">Read More ></a>
							</div>
						</div>
					</a>

				<?php }?>
			</div>
			
		<?php
				$j++; 
			}
		?>

		<div class="clear"></div>

	</div><!-- END OF HLPCONTAINER -->

<?php }?>
