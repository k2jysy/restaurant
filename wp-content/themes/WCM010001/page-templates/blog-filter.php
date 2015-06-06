<?php
/* Template Name: Blog Filter */
?>
<?php get_header(); 
$columns_number = tm_blog_filter_columns_number();
$tm_blog_filter_columns_class = tm_blog_filter_columns_class();

?>
<!-- Start blog-filter -->

<div id="main-content" class="main-content blog-page blog-filter <?php echo esc_attr( tm_sidebar_position() ) ; ?>">
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
      <div id="container" class="blog-filter-container filter-container">
        <?php	
						wp_reset_query(); 
						$i = 1;			
						$last_class = "";
						$categories = get_categories('hide_empty=0&orderby=name');
						$test = '';
						$test .= '<section id="blog_filter_options" class="options clearfix">';
						$test .= '<ul id="filters" class="option-set clearfix" data-option-key="filter">';
						$test .= '<li><a href="#show-all" data-option-value="*" class="selected">Show All</a></li>';
						foreach ($categories as $category_item ) {
							$test .= '<li><a href="#'.$category_item->slug.'" data-option-value=".'.$category_item->slug.'">'.$category_item->cat_name.'</a></li>';
						}
						$test .= '</ul></section>';
						echo $test; ?>
        <div class="loading"> <img src="<?php echo get_template_directory_uri(); ?>/images/megnor/loading.gif" alt=""> </div>
        <div id="box_filter" class="clearfix da-thumbs <?php echo $tm_blog_filter_columns_class; ?>" style="display:none;">
          <?php foreach ($categories as $category_item ) {
							$args = array(
								'post_type'          => 'post',
								'post_status'        => 'publish',
								'posts_per_page'	=> 10,
								'cat' => $category_item->cat_ID
							); 
							query_posts($args);					
							if ( have_posts() ):
								while (have_posts()) : the_post();
									if($i % $columns_number == 1):
										$last_class = " first"; 	
									elseif($i % $columns_number == 0):
										$last_class = " last";									
									else:
										$last_class = '';
									endif; 	
																														
	
	 ?>
          <div class="<?php echo $category_item->slug ?> item<?php echo $last_class; ?>">
            <?php  $post_format = get_post_format();
					if ( $post_format ) $post_format = 'format-' . $post_format;
					get_template_part( 'content', $post_format );
					?>
          </div>
          <?php $i++; endwhile; 						 
							else:  ?>
          <p>
            <?php  __( 'Sorry, no posts matched your criteria.', 'templatemela' ); ?>
          </p>
          <?php endif;
							wp_reset_query();  // Reset 								
						} ?>
        </div>
      </div>
      <?php 
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				} ?>
    </div>
    <!-- #content -->
  </div>
  <!-- #primary -->
  <?php get_sidebar(); ?>
</div>
<!-- End blog-filter -->
<?php get_footer(); ?>
