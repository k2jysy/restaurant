<?php 

// Add woocommerce support theme
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

// Disables woocommerce style
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment'); 
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;	
	ob_start();	
	?>
	<a class="shopping_cart tog" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"> <?php _e( 'Cart', 'templatemela' ); ?>
	<span class="item-total">
		<?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>
	</span> 
</a>
<?php	
	$fragments['a.cart-contents'] = ob_get_clean();	
	return $fragments;	
}

// Change the breadcrumb delimeter from '/' to '>'
add_filter( 'woocommerce_breadcrumb_defaults', 'templatemela_change_breadcrumb_delimiter' );
function templatemela_change_breadcrumb_delimiter( $defaults ) {
$defaults['delimiter'] = ' / ';
$defaults['before'] = '<span>';
$defaults['after'] = '</span>';
return $defaults;
}

// Display products per page
$tmoption_shop_items = get_option('tmoption_shop_items');
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$tmoption_shop_items.';' ), 20 ); 

// Change number or products per row
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return get_option('tmoption_shop_items_per_row'); // products per row	
	}	
}
add_filter('loop_shop_columns', 'loop_columns');
if ( ! function_exists( 'tm_header_cart' ) ) :
function tm_header_cart() { ?>
	<div class="header_cart">
		<div class="cart togg">
			<?php global $woocommerce;
			ob_start();?>						
			<div id="shopping_cart" class="shopping_cart tog" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
			<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php _e( 'Cart', 'templatemela' ); ?><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'templatemela'), $woocommerce->cart->cart_contents_count);?><?php echo $woocommerce->cart->get_cart_total(); ?>  </a>			
			
			</div>	
			<?php global $woocommerce; ?>
			<?php templatemela_get_widget('header-widget'); ?>		
		</div>	
	</div>			
<?php }
endif;
?>