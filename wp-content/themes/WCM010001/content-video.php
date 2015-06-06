<?php
/**
 * The template for displaying posts in the Video post format
 *
 * @package WordPress
 * @subpackage TemplateMela
 * @since TemplateMela 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <div class="entry-main-content">
	<div class="entry-main-header">
			<header class="entry-header">
				<?php 		
					if ( is_single() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
					endif;
				?>
				 <div class="entry-meta-inner"> 
	  <div class="entry-content-date">
		  <?php tm_post_entry_date(); ?>
		</div>
		<?php edit_post_link( __( 'Edit', 'templatemela' ), '<span class="edit-link"><i class="fa fa-pencil"></i>', '</span>' ); ?>
	</div>
		  </header>
      <!-- .entry-header -->
</div>
  <!-- .entry-main-content -->
	 </div>
	 
	  <div class="entry-video">
        <?php
					the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'templatemela' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'templatemela' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				?>
		</div>		
	 <div class="entry-content-other">
    	  <div class="entry-content"> 
			
		
      </div>
      <!-- .entry-content -->
		
    </div>
    <!-- .entry-content-other -->
	  <div class="entry-meta"> 
			  <?php templatemela_comments_link(); ?>
	</div>
			<!-- .entry-meta -->
  
</article>
<!-- #post-## -->
