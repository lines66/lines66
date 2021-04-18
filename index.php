<?php
/**
 * @Author: 大胡子
 * @Email:  dahuzi@xintheme.com
 * @Link:   www.dahuzi.me
 * @Date:   2019-11-30 10:52:41
 * @Last Modified by:   dahuzi
 * @Last Modified time: 2020-03-20 19:50:52
 */

if( is_category() && z_taxonomy_image_url() ){
	$home_cover_img = z_taxonomy_image_url();
}else{
	$home_cover_img = get_theme_mod( 'home_cover_img' );
}

get_header(); ?>

	<div class="blog-listing-homepage blog-listing-homepage--full-height">
		<div class="blog-listing-homepage__article">
			<header style="background-image: url(<?php echo $home_cover_img; ?>);" class="blog-listing-homepage__page-header">
				<figure>
					<img src="<?php echo $home_cover_img; ?>" alt="">
				</figure>
				<div class="blog-listing-homepage__article__info<?php if( get_theme_mod( 'home_title_type' ) == '2' ){?> single_title_sleft<?php }?>">

					<?php
						if(is_category()){
						$thiscat = get_category($cat);
						$category_description = category_description();?>

						<div>
							<h1>
								<?php echo $thiscat ->name;?>
							</h1>
							<p>
								<?php
								if($category_description){
									echo $category_description;
								}else{
									echo '请在【后台 – 文章 – 分类 – 编辑 – 图像描述】中输入文本描述…';
								}?>
							</p>
							<?php get_template_part( 'template-parts/copyright' ); ?>
						</div>
					<?php }elseif( is_author() ){?>

						<div>
							<h1>
								<?php the_author(); ?>
							</h1>
							<p>
								<?php if(get_the_author_meta('description')){ echo the_author_meta( 'description' );}else{ echo '我还没有学会写个人说明！'; }?>
							</p>
							<?php get_template_part( 'template-parts/copyright' ); ?>
						</div>

					<?php }elseif( is_tag() ){?>

						<div>
							<h1>
								标签：# <?php single_term_title(); ?> #
							</h1>
							<?php get_template_part( 'template-parts/copyright' ); ?>
						</div>

					<?php }elseif(is_search()){ ?>

						<div>
							<h1>
								“<?php echo get_search_query(); ?>” <?php global $wp_query; echo '搜到 ' . $wp_query->found_posts . ' 篇文章';?>
							</h1>
							<?php get_template_part( 'template-parts/copyright' ); ?>
						</div>

					<?php }elseif( is_archive() && !is_category() ){?>

						<div>
							<h1>
								<?php echo get_the_date(); ?>
							</h1>
							<?php get_template_part( 'template-parts/copyright' ); ?>
						</div>

					<?php }else{ ?>

						<div>
							<?php if( get_theme_mod( 'home_cover_img_title' ) ){?>
								<h1>
									<?php echo get_theme_mod( 'home_cover_img_title' ); ?>
								</h1>
							<?php }?>
							<?php if( get_theme_mod( 'home_cover_img_tagline' ) ){?>
								<p>
									<?php echo get_theme_mod( 'home_cover_img_tagline' ); ?>
								</p>
							<?php }?>
							<?php get_template_part( 'template-parts/copyright' ); ?>
						</div>

					<?php }?>

				</div>
			</header>
			<div class="blog-listing-homepage__articles">
				<?php
					if(!is_home() && !get_theme_mod('breadcrumbs') ){
						echo get_breadcrumbs();
					}
				?>
				<?php
				if ( have_posts() ) :

					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content');

					endwhile;

					get_template_part( 'template-parts/paging' );

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</div>
		</div>
		<?php get_template_part( 'template-parts/copyright' ); ?>
	</div>

<?php
get_sidebar();
get_footer();
