<?php
/*
Plugin Name: NS Frontend Add Product
Plugin URI: https://www.nsthemes.com/
Description: This plugin allow to choose the fields to show in the checkout page
Version: 1.1.3
Author: NsThemes
Author URI: http://www.nsthemes.com
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! defined( 'ADDPROD_NS_PLUGIN_DIR' ) )
    define( 'ADDPROD_NS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( ! defined( 'ADDPROD_NS_PLUGIN_DIR_URL' ) )
    define( 'ADDPROD_NS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );



/* *** plugin options *** */
require_once( ADDPROD_NS_PLUGIN_DIR.'/ns-frontend-add-product-options.php');


require_once( plugin_dir_path( __FILE__ ).'ns-admin-options/ns-admin-options-setup.php');

/*Only logged users can use the plugin*/
function ns_is_user_logged_in() {
    $user = wp_get_current_user();
 
    return $user->exists();
}



/*this create a shortcode that allow to insert the add image module linked to a new product*/
add_shortcode("ns-add-product", "ns_add_prod");

function ns_add_prod( $atts ) { 
$args = array(
    'textarea_rows' => 15,
    'teeny' => true,
    'quicktags' => false
);

if(!ns_is_user_logged_in())
		{
			echo ('You need to login to see this page');
			return;
		}

ob_start(); ?>
<div id="ns-container-add-product-frontend">
	<form name="form1" action="" method="post" class="" enctype="multipart/form-data">
		<div id="ns-product-data-container" class="ns-big-box">
			<div class="ns-center">
				<h2><span>Product Data </span></h2> <span type='button' id='ns-post-prod-data-hide-show' class="dashicons dashicons-arrow-down ns-pointer"></span>
			</div>
			<div id="ns-product-data-inner-container" class="ns-border-margin">
				<div class="ns-left-list-data-container">
					<ul>
						<li id="ns-general" class="ns-active"><a href="#ns-prod-data" class="ns-link"> General</a></li>
						<li id="ns-inventory"><a href="#ns-prod-data" class="ns-link"> Inventory</a></li>
						<li id="ns-shipping"><a href="#ns-prod-data" class="ns-link"> Shipping</a></li>
						
						<li id="ns-attributes"><a href="#ns-prod-data" class="ns-link"> Attributes</a></li>
						<li id="ns-advanced"><a href="#ns-prod-data" class="ns-link"> Advanced</a></li>
						<li id="ns-extra"><a href="#ns-prod-extra" class="ns-link"> Extra</a></li>
					</ul>
				</div>
				<div class="ns-prod-data-tab ns-general">
					<div>
						<div><label>Product Name</label> <br><input class="ns-input-width" name="ns-product-name" id="ns-product-name" value="" placeholder="Product name" type="text" required="true"></div>
						<div><label>Regular price (<?php echo  get_woocommerce_currency_symbol();?>)</label> <br><input class="ns-input-width" name="ns-regular-price" id="ns-regular-price" value="" placeholder="4.20" type="text" pattern="[0-9]+([\.][0-9]+)?" title="This should be a number with up to 2 decimal places."></div>
						<div><label>Sale price (<?php echo  get_woocommerce_currency_symbol();?>)</label> <br><input class="ns-input-width" name="ns-sale-price" id="ns-sale-price" value="" placeholder="3.00" type="text" pattern="[0-9]+([\.][0-9]+)?" title="This should be a number with up to 2 decimal places."></div>
					</div>
				</div>
				<div class="ns-prod-data-tab ns-inventory ns-hidden">
					<div>
						<div>
							<label>SKU</label><br> <input class="ns-input-width" name="ns-sku" id="ns-sku" value="" placeholder="" type="text">
						</div>
						<div>
							<label>Manage Stock?</label> <input name="ns-manage-stock" id="ns-manage-stock" value="no" type="checkbox"><br> <span class="ns-add-product-frontend-span-text">Enable stock management at product level</span>
						</div>
						<div id="ns-manage-stock-div" style="display: none;">
							<div>
								<label>Stock quantity</label><br><input class="" name="ns-stock" id="ns-stock" step="any" type="number"> 
							</div>
							<div class="">
							<label>Allow backorders?</label>
								<select id="ns-backorders" name="ns-backorders" class="">
									<option value="no">Do not allow</option>
									<option value="notify">Allow, but notify customer</option>
									<option value="yes" selected="selected">Allow</option>
								</select> 
							</div>
						</div>
						<div>
							<label>Stock Status</label><br>
							<select id="ns-stock-status" name="ns-stock-status" class="ns-input-width" >
								<option value="instock">In stock</option>
								<option value="outofstock">Out of stock</option>
							</select>
						</div>
						<div>
							<div style="margin-left: 0px;"><label>Sold individually </label><input class="checkbox" name="ns-sold-individually" id="ns-sold-individually" value="yes" type="checkbox"><br><span class="ns-add-product-frontend-span-text">Enable this to only allow one of this item to be bought in a single order</span></div>
						</div>
					</div>				
				</div>
				<div class="ns-prod-data-tab ns-shipping ns-hidden">
					<div class="">
						<div><label>Weight (kg)</label><br><input class="ns-input-width" name="ns-weight" id="ns-weight" placeholder="0" type="text"></div>								
						<div><label>Dimensions (cm)</label><div style="margin-left: 0px;"><input class="ns-input-width" id="ns-product-length" placeholder="Length" size="6" name="ns-product-length"  type="text"><br><input class="ns-input-width" placeholder="Width" size="6" id="ns-width" name="ns-width"  type="text"><br><input class="ns-input-width" placeholder="Height" size="6" id="ns-height" name="ns-height"  type="text"></div>		</div>					
					</div>
					
				</div>

				<div class="ns-prod-data-tab ns-attributes ns-hidden">
					<div id="ns-inner-attributes">
						<select id="ns-attribute-taxonomy" name="ns-attribute-taxonomy" class="ns-attribute-taxonomy ns-input-width">
							<option value="ns-cus-prod-att">Custom product attribute</option>
							<option id="ns-color-id" value="ns-color-att">color</option>
						</select><br>
						<button id="ns-add-attribute-btn" type="button" class="button">Add</button>
						<input id="ns-attribute-list" name="ns-attribute-list" type="hidden" />
					</div>
					
				</div>
				<div class="ns-prod-data-tab ns-advanced ns-hidden">
					<div>
						<label>Purchase note</label><textarea name="ns-purchase-note" id="ns-purchase-note" ></textarea>			
					</div>
					<div>
						<label>Menu order</label><br><input class="ns-input-width" name="ns-menu-order" id="ns-menu-order" placeholder="" step="1" type="number">
					</div>
					<div>
						<label>Enable reviews</label><input class="checkbox" name="ns-comment-status" id="ns-comment-status" checked="checked" type="checkbox">				
					</div>
				</div>
				<div class="ns-prod-data-tab ns-extra ns-hidden">
					<div id="ns-wc-productdata-options-tab">
						<!--<div>
							<label>Custom Bubble</label>
							<select id="ns-bubble" name="ns-bubble" class="ns-input-width">
								<option value="" selected="selected">Disabled</option>
								<option value="&quot;yes&quot;">Enabled</option>
							</select>
						</div> -->
						<div><label>Custom Bubble Title</label><br><input class="ns-input-width" name="ns-bubble-text" id="ns-bubble-text" value="" placeholder="NEW" type="text"></div>
						<div><label>Custom Tab Title</label><br><input class="ns-input-width" value="" name="ns-custom-tab" id="ns-custom-tab" placeholder="" type="text"></div>
						<div><label>Custom Tab Content</label><textarea  id="ns-cus-tab-content" name="ns-cus-tab-content" class="short" placeholder="Enter content for custom product tab here. Shortcodes are allowed"></textarea></div>
						<div><div style="margin-left: 0px;"><label>Product Video</label><br><input id="ns-video" name="ns-video" class="short ns-input-width" placeholder="https://www.youtube.com/watch?v=Ra_iiSIn4OI" type="text"><br><span class="ns-add-product-frontend-span-text">Enter a Youtube or Vimeo Url of the product video here. We recommend uploading your video to Youtube.</span></div></div>
						<div><label>Product Video Size</label><br><input id="ns-video-size" name="ns-video-size" class="ns-input-width" placeholder="900x900" type="text"></div>
						<div><label>Top Content</label><textarea id="ns-top-content" name="ns-top-content" placeholder="Enter content that will show after the header and before the product. Shortcodes are allowed"></textarea></div>
						<div><label>Bottom Content</label><textarea id="ns-bottom-content" name="ns-bottom-content" placeholder="Enter content that will show after the product info. Shortcodes are allowed"></textarea></div>
					</div>
				</div>
			</div>
		</div>
		<div id="ns-post-content" class="ns-big-box">
			<div>
				<h2>Post Content</h2><span type='button' id='ns-post-content-hide-show' class="dashicons dashicons-arrow-down ns-pointer"></span>
			</div>
			<div id="ns-wp-post-content-div" class="ns-border-margin ns-padding-container">
				<p class="ns-add-product-frontend-span-text">Here you can add the complete description of your product</p>
				<textarea id="ns-post-content-text" name="ns-post-content-text" class="ns-display-block"></textarea>
			</div>
		</div>
		<div id="ns-short-desc-container" class="ns-big-box">
			<div>
				<h2>Product Short Description</h2><span type='button' id='ns-short-desc-hide-show' class="dashicons dashicons-arrow-down ns-pointer"></span>
			</div>
			<div id="ns-wp-editor-div" class="ns-border-margin ns-padding-container">
				<p class="ns-add-product-frontend-span-text">Here you can add a short description to your product</p>
				<textarea id="ns-short-desc-text" name="ns-short-desc-text" class="ns-display-block"></textarea>
			</div>
		</div>
		
		<div class="ns-left ns-little-container">
			<div id="ns-product-tags" class="ns-little-box ns-margin-right">
				<div>
					<h2>Product Tags</h2><span type='button' id='ns-prod-tags-hide-show' class="dashicons dashicons-arrow-down ns-pointer"></span>
				</div>
				<div id="ns-prod-tags-div" class="ns-padding-container ns-border-margin">
					<div><input id="ns-new-tag-product" name="ns-new-tag-product"  size="16" value="" type="text"></div>
					<div>
						<p class="ns-add-product-frontend-span-text">Separate Product Tags with commas</p>
					</div>
				</div>
			</div>
			<div id="ns-image-container" class="ns-little-box">
				<div>
					<h2>Product Image</h2><span type='button' id='ns-prod-image-hide-show' class="dashicons dashicons-arrow-down ns-pointer"></span>
				</div>
				<div id = "ns-image-container-0"class="ns-border-margin ns-padding-container">
					<div id="ns-image-container1">
						<img id="ns-img-thumbnail" src="<?php echo(wc_placeholder_img_src()); ?>" />
					</div>
					<div class="ns-margin-top"><p><input type="file" name="ns-thumbnail" id="ns-thumbnail" /></p></div>
				</div>
			</div>
		</div>
		<div class="ns-left ns-little-container">
			<div id="ns-product-categories" class="ns-little-box ns-margin-right">
				<div>
					<h2>Product Categories</h2><span type='button' id='ns-prod-categories-hide-show' class="dashicons dashicons-arrow-down ns-pointer"></span>
				</div>
				<div id="ns-prod-cat-inner" class="ns-border-margin ns-padding-container">
					<div>
					<?php 
						$all_existent_cat = get_terms( array(
							'taxonomy' => 'product_cat',
							'hide_empty' => false,
						));			
					?>
						<table>
						<?php
							foreach($all_existent_cat as $cat_obj){							
								echo '<tr>';
									echo '<td>';
										echo '<input type="checkbox" name="'.$cat_obj->name.'" class="ns-add-product-frontend-ca-checkbox" value="'. $cat_obj->name .'"/>'.$cat_obj->name;
									echo '</td>';
								echo '</tr>';
	
								}
						?>
							
						</table>
					</div>
				</div>
			</div>
			<div id="ns-product-gallery" class="ns-little-box">
				<div>
					<h2>Product Gallery</h2><span id='ns-prod-gallery-hide-show' class="dashicons dashicons-arrow-down ns-pointer"></span>
				</div>
				<div id="ns-prod-gallery-inner" class="ns-border-margin ns-padding-container">
					<div>
						<p class="ns-add-product-frontend-span-text">Add product gallery images</p>
						 <!-- Trigger/Open The Gallery Modal -->
						<button id="ns-myBtn" class="button ns-left" type="button">Open Gallery</button>
					</div>
				</div>
			</div>
		</div>
		<button type="submit" class="button ns-left" name="submit">Save</button>			
</div>
<input id="ns-image-from-list" name="ns-image-from-list" type="hidden" value="" />
<input id="ns-attr-from-list" name="ns-attr-from-list" type="hidden" value="" />

</form>	
				<?php //get all the images from wordpress
					$query_images_args = array(
						'post_type'      => 'attachment',
						'post_mime_type' => 'image',
						'post_status'    => 'inherit',
						'posts_per_page' => - 1,
					);

					$query_images = new WP_Query( $query_images_args );

					/*All the images are stored in $images, so then i can foreach on them and echo in <img> source*/
					$images = array();
				?>
				<!-- The Gallery Modal -->
				<div id="ns-myModal" class="ns-modal">
				  <!-- Gallery Modal content -->
				  <div class="ns-modal-content">
						<span class="ns-close">x</span>
						<div class="ns-image-container">
						<?php foreach($query_images->posts as $image){ ?>
							<div class="ns-inline-flex"><img src="<?php echo(wp_get_attachment_url( $image->ID ));?>" id="<?php echo($image->ID);?>" /></div>
						<?php } ?>
						</div>
				  </div>
				</div>
				

<input id="ns-color-att-list"  type="hidden" value="<?php foreach(ns_get_all_color_terms() as $val){echo ($val.',');} ?>" />
<?php 
$ns_html_to_return = ob_get_clean();

	if(isset($_POST['submit']))
	{
		if(!ns_save_product()){			//error found, return empty html;
			echo ("Error: cannot add product.");
			return '';
		}
		else{
			echo 'Your product has been added.';
		}
	}
	return  $ns_html_to_return;
}  


function ns_save_product(){
/*Create a new post*/
$post_id = ns_save_post();
if(is_wp_error( $post_id )){
	return false;
}

/*Product data*/
$regular_price = null;
 if(isset($_POST["ns-regular-price"])){
	if(is_numeric( $_POST["ns-regular-price"] ) || $_POST["ns-regular-price"] == ''){
			$regular_price = sanitize_text_field($_POST["ns-regular-price"]);
		}
	else{
		wp_delete_post( $post_id, true );
		return false;
	}
}
$sale_price = null;
 if(isset($_POST["ns-sale-price"])){
	if(is_numeric( $_POST["ns-sale-price"] ) || $_POST["ns-sale-price"] == ''){
			$sale_price = sanitize_text_field($_POST["ns-sale-price"]);
		}
	else{
		wp_delete_post( $post_id, true );
		return false;
	}
 }
$sku = null;
 if(isset($_POST["ns-sku"])){
	 $sku = sanitize_text_field($_POST["ns-sku"]);
 }
 
$manage_stock = null;
$stock_quantity = null;
$stock_back_orders = "no";
 if(isset($_POST["ns-manage-stock"])){
	 $manage_stock = sanitize_text_field($_POST["ns-manage-stock"]);
	 $stock_quantity = sanitize_text_field($_POST["ns-stock"]);
	 $stock_back_orders = sanitize_text_field($_POST["ns-backorders"]);
 }

 $stock_status = null;
 if(isset($_POST["ns-stock-status"])){
	 $stock_status = $_POST["ns-stock-status"];
 }
	
$sold_individually = null; 
if(isset($_POST["ns-sold-individually"])){
	$sold_individually = $_POST["ns-sold-individually"];
}

$weight = null;
 if(isset($_POST["ns-weight"])){
	 $weight = sanitize_text_field($_POST["ns-weight"]);
 }
 
$length = null;
 if(isset($_POST["ns-product-length"])){
	 $length = sanitize_text_field($_POST["ns-product-length"]);
 }
 
$width = null;
 if(isset($_POST["ns-width"])){
	$width = sanitize_text_field($_POST["ns-width"]);
}

$height = null;
 if(isset($_POST["ns-height"])){
	 $height = sanitize_text_field($_POST["ns-height"]);
 }
  
 /* $shipping_class = null; 
  if(isset($_POST["ns-product-shipping-class"])){
	$shipping_class = $_POST["ns-product-shipping-class"];
  }*/
  
$purchase_note = null; 
 if(isset($_POST["ns-purchase-note"])){
	$purchase_note = sanitize_text_field($_POST["ns-purchase-note"]);
 }

if($stock_status)
	update_post_meta( $post_id, '_stock_status', $stock_status);
if($regular_price)
	update_post_meta( $post_id, '_regular_price',  $regular_price);
if($sale_price)
	update_post_meta( $post_id, '_sale_price', $sale_price );
if($purchase_note)
	update_post_meta( $post_id, '_purchase_note', $purchase_note  );

update_post_meta( $post_id, '_featured', "no" );
if($weight)
	update_post_meta( $post_id, '_weight', $weight );
if($length)
	update_post_meta( $post_id, '_length', $length );
if($width)
	update_post_meta( $post_id, '_width', $width );
if($height)
	update_post_meta( $post_id, '_height', $height );
if($sku)
	update_post_meta( $post_id, '_sku', $sku);

update_post_meta( $post_id, '_sale_price_dates_from', "" );
update_post_meta( $post_id, '_sale_price_dates_to', "" );

if($sale_price)
	update_post_meta( $post_id, '_price', $sale_price );
if($sold_individually)
	update_post_meta( $post_id, '_sold_individually', $sold_individually );

if($manage_stock == "yes"){
	update_post_meta( $post_id, '_manage_stock', $manage_stock );
	update_post_meta( $post_id, '_stock', $stock_quantity );
	update_post_meta( $post_id, '_backorders', $stock_back_orders );
}

update_post_meta( $post_id, '_visibility', 'visible' );
update_post_meta( $post_id, 'total_sales', '0');

 
/*
wp_set_object_terms( $post_id, 'Races', 'product_cat' );
wp_set_object_terms($post_id, 'simple', 'product_type');
update_post_meta( $post_id, '_downloadable', 'yes');
update_post_meta( $post_id, '_virtual', 'yes');
*/

/*Bubbles*/
ns_save_bubble($post_id);

/*Categories*/
ns_save_categories($post_id);

/*Tags*/
ns_save_tags($post_id);

/*Images*/
$ns_attachment_id = ns_add_image($post_id);

//if($ns_attachment_id)
	update_post_meta( $post_id, '_thumbnail_id', $ns_attachment_id );

/*Attributes*/
ns_add_attributes($post_id);

/*Gallery*/
ns_add_gallery_images($post_id);

return true;
}

function ns_save_post(){
	/*Checking if user is logged in*/

	$user_id = wp_get_current_user()->ID;
	
	/*Get the inserted product title*/
	$ns_title = "New Product";
	if(isset($_POST["ns-product-name"])){
		$ns_title = sanitize_text_field($_POST["ns-product-name"]);
	}
	
	/*Get the inserted product short description*/
	$ns_short_desc = null;
	if(isset($_POST["ns-short-desc-text"])){
		$ns_short_desc = sanitize_text_field($_POST["ns-short-desc-text"]);
	}
	
	/*Get the inserted product post content*/	
	$ns_post_content = null;
	if(isset($_POST["ns-post-content-text"])){
		$ns_post_content = sanitize_text_field($_POST["ns-post-content-text"]);
	}
	
	/*If user wanna activate the reviews*/	
	$ns_is_reviews = "closed";
	if(isset($_POST["ns-comment-status"])){
		$ns_is_reviews = "open";
	}
	
	/*Get the menu order inserted by user*/
	$ns_menu_order = 0;
	if(isset($_POST["ns-menu-order"])){
		$ns_menu_order = $_POST["ns-menu-order"];	
	}
	
	$post = array(
    'post_author' => $user_id,
    'post_content' => $ns_post_content,	
    'post_status' => "publish",
    'post_title' => $ns_title,
    'post_parent' => '',
    'post_type' => "product",
	'post_excerpt' => $ns_short_desc,
	'comment_status' => $ns_is_reviews,
	'menu_order' => $ns_menu_order,
);

	//Create post
	$post_id = wp_insert_post( $post, true );

	return $post_id;
}


function ns_save_categories($post_id){
	$ns_cat_array = array();
	
	$all_existent_cat = get_terms( array(
										'taxonomy' => 'product_cat',
										'hide_empty' => false,
									));	
							
	foreach($all_existent_cat as $cat_obj){		
		/*already saved categories*/
		$remove_spaces = str_replace(' ', '_', $cat_obj->name);
		if(isset($_POST[$remove_spaces])){
			$cat = sanitize_text_field($_POST[$remove_spaces]);
			array_push($ns_cat_array, $cat);
		}

		/*set product categories*/
		if($ns_cat_array){
			wp_set_object_terms($post_id, $ns_cat_array, 'product_cat');
		}
	
	}
	
	/*$ns_cat_array = array();
	if(isset($_POST["clothing"]))
		array_push($ns_cat_array,$_POST["clothing"]);

	if(isset($_POST["hoddies"]))
		array_push($ns_cat_array,$_POST["hoddies"]);

	if(isset($_POST["tshirts"]))
		array_push($ns_cat_array,$_POST["tshirts"]);

	if(isset($_POST["music"]))
		array_push($ns_cat_array,$_POST["music"]);

	if(isset($_POST["albums"]))
		array_push($ns_cat_array,$_POST["albums"]);

	if(isset($_POST["singles"]))
		array_push($ns_cat_array,$_POST["singles"]);

	if(isset($_POST["posters"]))
		array_push($ns_cat_array,$_POST["posters"]);*/

	/*set product categories*/
	/*if($ns_cat_array){
		wp_set_object_terms($post_id, $ns_cat_array, 'product_cat');
	}*/
	
}


function ns_save_tags($post_id){
	/*First need to sanitize the post variables, then explode the string on the comma to have the array*/
	$ns_tags_comma = null;
	if(isset($_POST["ns-new-tag-product"]))
		$ns_tags_comma = sanitize_text_field($_POST["ns-new-tag-product"]);

	$ns_tags = explode("," , $ns_tags_comma);

	/*set the product tags*/
	if($ns_tags){
		wp_set_object_terms($post_id, $ns_tags, 'product_tag');
	}
	
}


function ns_save_bubble($post_id){
	$is_any = false;
	/*
	$custom_bubble = null;
	if(isset($_POST["ns-bubble"])){
		$custom_bubble = sanitize_text_field($_POST["ns-bubble"]);
		$is_any = true;
	}
	 */
	 $bubble_title = null;
	 if(isset($_POST["ns-bubble-text"])){
		$bubble_title = sanitize_text_field($_POST["ns-bubble-text"]);
		$is_any = true;
	 }
	 
	 $cus_tab_title = null;
	 if(isset($_POST["ns-custom-tab"])){
		 $cus_tab_title = sanitize_text_field($_POST["ns-custom-tab"]);
		 $is_any = true;
	 }
     
	 $cus_tab_content = null;
	 if(isset($_POST["ns-cus-tab-content"])){
		 $cus_tab_content = sanitize_text_field($_POST["ns-cus-tab-content"]);
		 $is_any = true;
	 }
	 
     $cus_tab_top = null;
	 if(isset($_POST["ns-top-content"])){
		 $cus_tab_top = sanitize_text_field($_POST["ns-top-content"]);
		 $is_any = true;
	 }
     
	 $cus_tab_bottom = null;
	 if(isset($_POST["ns-bottom-content"])){
		$cus_tab_bottom = sanitize_text_field($_POST["ns-bottom-content"]);
		 $is_any = true;
	 }
    
	$ns_video = null;
	if(isset($_POST["ns-video"])){
		$ns_video = sanitize_text_field($_POST["ns-video"]);
		$is_any = true;
	}
	 
	 $ns_video_size = null;
	 if(isset($_POST["ns-video-size"])){
		 $ns_video_size = sanitize_text_field($_POST["ns-video-size"]);
		 $is_any = true;
	 }
	 
	if($is_any){
		$ns_bubble_arr = Array( Array(
		 '_bubble_new' => "yes",
		 '_bubble_text' => $bubble_title,
		 '_custom_tab_title' => $cus_tab_title,
		 '_custom_tab' => $cus_tab_content,
		 '_product_video' =>  $ns_video,
		 '_product_video_size' => $ns_video_size,
		 '_top_content' =>  $cus_tab_top,
		 '_bottom_content' => $cus_tab_bottom,
		 )
		);

		update_post_meta( $post_id, 'wc_productdata_options', $ns_bubble_arr );
	} 
     
 	
}

function ns_add_image($post_id){

	$user_id = wp_get_current_user()->ID;

	if (!function_exists('wp_generate_attachment_metadata')){
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                require_once(ABSPATH . "wp-admin" . '/includes/file.php');
                require_once(ABSPATH . "wp-admin" . '/includes/media.php');
            }
	if ($_FILES['ns-thumbnail']['name']) {
		foreach ($_FILES as $file => $array) {
			if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
				return "upload error : " . $_FILES[$file]['error'];
			}
	
			$attach_id = media_handle_upload( $file, $post_id );

			return $attach_id;
		}   
	}
	return false;
			
}

function ns_add_attributes($post_id){
	$ns_outer_array = Array();
	if(isset($_POST["ns-color-attr"])){					//There's could be only one color attribute field
														//if is set then create the array(array) 
		$color_attributes = sanitize_text_field($_POST["ns-color-attr"]);
		$is_visible = 0;
		if(isset($_POST["ns-attr-visibility-status"])){
			$is_visible = 1;
		}
		$ns_attr = Array(
				'name' => "pa_color",
				'value' => "",
				'position' => "0",
				'is_visible' => $is_visible,
				'is_variation' =>  0,
				'is_taxonomy' => 1,
				);
		
		$ns_outer_array['pa_color'] = $ns_attr;			//adding the color with key 'pa_color' to let framework knows it is color
	    wp_set_object_terms($post_id, $_POST["ns-color-attr"], 'pa_color', false);
	
  }
  
  if(isset($_POST['ns-attribute-list'])){		//Check if user inserted custom attributes and loop over them
	  $num_custom_attr = intval(sanitize_text_field($_POST['ns-attribute-list']));

	  if($num_custom_attr >= 0){	
		  for($i=0; $i<$num_custom_attr; $i++){ 
				$is_visible = 0;
				$ns_attr_name = sanitize_text_field($_POST['ns-attr-names'.$i.'']);
				$ns_attr_value = sanitize_text_field($_POST['ns-attribute-values'.$i.'']);
				
				
				if(isset($_POST['ns-attr-visibility-status'.$i.''])){
					$is_visible = 1;
				}
				
				
				$ns_attr = Array(
					'name' => $ns_attr_name,
					'value' => $ns_attr_value,
					'position' => "1",
					'is_visible' => $is_visible,
					'is_variation' =>  0,
					'is_taxonomy' => 0,
					);
				array_push($ns_outer_array,  $ns_attr);		
		  }
	  }
  }
  if($ns_outer_array)
	update_post_meta( $post_id, '_product_attributes', $ns_outer_array );
  
  $arr_to_terms;
  if(isset($_POST["ns-attr-from-list"])){			//user selected an already saved color
		$arr_to_terms = explode(",",$_POST["ns-attr-from-list"]);
  }
  if(isset($_POST["ns-color-attr"])){				//user has inserted another new color
		array_push($arr_to_terms,$_POST["ns-color-attr"]);
  }
  if($arr_to_terms)									//if the array is not empty we have a new color or a already existing one
		wp_set_object_terms( $post_id, $arr_to_terms, 'pa_color'); 
}

/*Used to get all the colors already inserted by user*/
function ns_get_all_color_terms(){
	$term_array = Array();
	$term_list = get_terms( 'pa_color');
	foreach($term_list as $classTerm){
		array_push($term_array, $classTerm->name);
	}
	return $term_array;
}


function ns_add_gallery_images($post_id){
	$images_ids = null;
	if(isset($_POST["ns-image-from-list"])){
		$images_ids = sanitize_text_field($_POST["ns-image-from-list"]);
		update_post_meta( $post_id, '_product_image_gallery', $images_ids );
	}
}

//Enqueue the Dashicons script
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
	wp_enqueue_style( 'dashicons' );
}




