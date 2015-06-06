<?php
/**
 * TemplateMela
 * @copyright  Copyright (c) 2010 TemplateMela. (http://www.templatemela.com)
 * @license    http://www.templatemela.com/license/
 */
?><?php // Reference:  http://codex.wordpress.org/Widgets_API
class RecentPostsWidget extends WP_Widget
{
    function RecentPostsWidget(){
		$widget_settings = array('description' => 'Recent Posts Widget', 'classname' => 'widgets-recent-posts');
		parent::WP_Widget(false,$name='TM - Recent Posts Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$postCount = empty($instance['postCount']) ? 5 : $instance['postCount'];
		$postCategory = empty($instance['postCategory']) ? '' : $instance['postCategory']; ?>
		<?php echo $before_widget; 
		echo $before_title;
		if($title)
			echo $title;
		echo $after_title; ?>
		<ul>
			<li>	
		<?php 	
			global $post;
			$cat_post = get_posts('numberposts='.$postCount.'&category='.$postCategory.'&post_status=publish&orderby=date');
			foreach($cat_post as $post) : setup_postdata($post);
			if ( has_post_thumbnail() && ! post_password_required() ) :
				$title_class = "";
				$title_length = 15;
			else:
				$title_class = "no-image";
				$title_length = 25;
			endif;
			?>
			<div class="single-post">
				<?php $shorttitle = substr(the_title('','',FALSE),0, $title_length ); ?>
				<h3 class="post-title <?php echo $title_class; ?>"><a href="<?php echo get_permalink(); ?>" title="<?php echo $shorttitle; ?>">
				<?php echo $shorttitle; if (strlen($shorttitle) >= $title_length){ echo '&hellip;'; } ?></a></h3>
				<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
					<div class="post-img"> <?php the_post_thumbnail('small-thumb'); ?> </div>
				 <?php endif; ?>							 	
				<span class="post-date"><?php echo date("j M, Y", strtotime($post->post_date)); ?></span>
			</div>
			
		<?php endforeach; ?>
		</li>
		</ul>
	<?php
	echo $after_widget;
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['postCount'] = strip_tags($new_instance['postCount']);
		$instance['postCategory'] = strip_tags($new_instance['postCategory']);
		return $instance;
	}
    function form($instance){
		$instance = wp_parse_args( (array) $instance, array('title' =>'Recent Posts', 'postCategory'=>'','postCount' => '5') );
		$title = esc_attr($instance['title']);
		$postCount = esc_attr($instance['postCount']);
		$postCategory = esc_attr($instance['postCategory']);
		?>
			<p><label for="<?php echo $this->get_field_id('title');?>">Title:</label><input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" /></p>
			<p><label for="<?php echo $this->get_field_id('postCategory');?>">Post Category</label><input class="widefat" id="<?php echo $this->get_field_id('postCategory');?>" name="<?php echo $this->get_field_name('postCategory');?>" type="text" value="<?php echo $postCategory;?>" /></p>
	<label for="<?php echo $this->get_field_id('postCount');?>">Number of Posts</label><input class="widefat" id="<?php echo $this->get_field_id('postCount');?>" name="<?php echo $this->get_field_name('postCount');?>" type="text" value="<?php echo $postCount;?>" />
		<?php
	}

}
add_action('widgets_init', create_function('', 'return register_widget("RecentPostsWidget");'));
// end FeaturedWidget
?>