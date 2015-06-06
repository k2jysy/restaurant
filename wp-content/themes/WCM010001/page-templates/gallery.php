<?php
/* Template Name: Gallery */ 
?>
<?php get_header(); ?>
<!--Start gallery-page-->

<div id="main-content" class="main-content blog-page blog-filter <?php echo esc_attr( tm_sidebar_position() ); ?>">	
  <div id="primary" class="content-area">
  <?php 
			global $wp_query;
			$id = $wp_query->get_queried_object_id();
			$single_page = is_single();
			if( !empty($id) && isset($id) ) :  
  				$tm_content_show_page_title = get_post_meta($id, 'tm_content_show_page_title', true);  
			if($tm_content_show_page_title == 1 || $single_page == 1 ): ?>
  			<div class="page-title">
   				<div class="page-title-inner">
    				<h1 class="entry-title-main">
     					<?php $page = get_post($id);
     						echo $page->post_title; ?>
    					</h1>
    						<?php templatemela_breadcrumbs(); ?>
  				 </div>
  			</div>
  			<?php endif;endif; ?>
    <div id="content" class="site-content" role="main">
      <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
      <?php //comments_template( '', true ); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
    <!-- #content -->
  </div>
  <!-- #primary -->
  <?php get_sidebar(); ?>
</div>
<!-- End blog-filter -->
<?php get_footer(); ?>
