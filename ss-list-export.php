<?php
/**
 * Plugin Name: Products List Export
 * Plugin URI: https://www.shahryar.pro/
 * Description: List Export for WooCommerce Products
 * Version: 0.3
 * Author: Saeed Shahryar
 * Author URI: https://www.shahryar.pro
 **/

// Add image size
add_image_size('list-thumb', 120, 120, true); // Hard Crop Mode

// WooCommerce Custom Fields
add_action('woocommerce_product_options_general_product_data', 'create_custom_fields', 1);
function create_custom_fields()
{
	woocommerce_wp_textarea_input(
		array(
			'id' => 'list_guarantee_field',
			'label' => __('توضیحات لیست', 'list_guarantee'),
			'class' => 'list-guarantee-field',
			'placeholder' => 'توضیحات محصول مانند گارانتی',
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => 'box_quantity_field',
			'label' => __('تعداد در کارتن', 'box_quantity'),
			'class' => 'box-quantity-field',
			'desc_tip' => true,
			'description' => __('تعداد در کارتن مورد نمایش در لیست اکسپورت محصولات را وارد کنید', 'box_quantity_desc'),
		)
	);
}

add_action('woocommerce_process_product_meta', 'save_custom_fields');
function save_custom_fields($post_id)
{
	update_post_meta($post_id, 'list_guarantee_field', wp_kses_post($_POST['list_guarantee_field']));
	update_post_meta($post_id, 'box_quantity_field', wp_kses_post($_POST['box_quantity_field']));
}


// Hook the menu to dashboard
add_action('admin_menu', 'list_export_main_menu');
function list_export_main_menu()
{
	add_menu_page('لیست محصولات', 'لیست محصولات', 'manage_options', 'list_export', 'list_export_init', 'dashicons-admin-page', 2);
	add_submenu_page('list_export', 'لیست محصولات (W/TSCO)', 'لیست محصولات (W/TSCO)', 'manage_options', 'list_export2', function () {
		list_export_init(2);
	});
    add_submenu_page('list_export', 'لیست محصولات 5%', 'لیست محصولات 5%', 'manage_options', 'list_export_5percent', function () {
		list_export_init(3);
	});
	// add_menu_page('بر اساس دسته بندی', 'بر اساس دسته بندی', 'manage_options', 'list_export_by_category' , '', 'dashicons-admin-page' , 3);
	add_submenu_page('list_export', 'موس ها', 'موس ها', 'manage_options', 'list_export_cat_82', function () {
		list_export_init_cat(82);
	});
	add_submenu_page('list_export', 'کیبوردها', 'کیبوردها', 'manage_options', 'list_export_cat_81', function () {
		list_export_init_cat(81);
	});
	add_submenu_page('list_export', 'اسپیکرها', 'اسپیکرها', 'manage_options', 'list_export_cat_83', function () {
		list_export_init_cat(83);
	});
	add_submenu_page('list_export', 'کابل های تصویر', 'کابل های تصویر', 'manage_options', 'list_export_cat_903', function () {
		list_export_init_cat(903);
	});
	add_submenu_page('list_export', 'کابل های صدا', 'کابل های صدا', 'manage_options', 'list_export_cat_924', function () {
		list_export_init_cat(924);
	});
	add_submenu_page('list_export', 'کابل های شبکه', 'کابل های شبکه', 'manage_options', 'list_export_cat_908', function () {
		list_export_init_cat(908);
	});
	add_submenu_page('list_export', 'کابل های موبایل', 'کابل های موبایل', 'manage_options', 'list_export_cat_91', function () {
		list_export_init_cat(91);
	});
	add_submenu_page('list_export', 'سایر کابل ها', 'سایر کابل ها', 'manage_options', 'list_export_cat_88', function () {
		list_export_init_cat(88);
	});
	add_submenu_page('list_export', 'تبدیل ها و رابط ها', 'تبدیل ها و رابط ها', 'manage_options', 'list_export_cat_499', function () {
		list_export_init_cat(499);
	});
	add_submenu_page('list_export', 'لوازم جانبی کامپیوتر', 'لوازم جانبی کامپیوتر', 'manage_options', 'list_export_cat_80', function () {
		list_export_init_cat(80);
	});
	add_submenu_page('list_export', 'لوازم جانبی موبایل', 'لوازم جانبی موبایل', 'manage_options', 'list_export_cat_89', function () {
		list_export_init_cat(89);
	});
	add_submenu_page('list_export', 'رم و فلش', 'رم و فلش', 'manage_options', 'list_export_cat_2134819', function () {
		list_export_init_cat(array(2134, 819));
	});
	add_submenu_page('list_export', 'TSCO', 'TSCO', 'manage_options', 'list_export_brand_2173', function () {
		list_export_init_brand(2173);
	});
	add_submenu_page('list_export', 'Royal', 'Royal', 'manage_options', 'list_export_brand_1997', function () {
		list_export_init_brand(1997);
	});
	add_submenu_page('list_export', 'Aula', 'Aula', 'manage_options', 'list_export_brand_2352', function () {
		list_export_init_brand(2352);
	});
	add_submenu_page('list_export', 'Enzo', 'Enzo', 'manage_options', 'list_export_brand_1232', function () {
		list_export_init_brand(1232);
	});
	add_submenu_page('list_export', 'Hiska', 'Hiska', 'manage_options', 'list_export_brand_3443', function () {
		list_export_init_brand(3443);
	});
	add_submenu_page('list_export', 'Ldnio', 'Ldnio', 'manage_options', 'list_export_brand_2329', function () {
		list_export_init_brand(2329);
	});
	
}

// Add Custom CSS to Admin Area
function callback_for_setting_up_scripts($hook_suffix)
{
	$catIDHook = preg_match('/page_list_export/', $hook_suffix);
	if ($catIDHook == true) {
		wp_register_style('main_list_style', '/wp-content/plugins/ss-list-export/css/main_list_style.css');
		wp_enqueue_style('main_list_style');
		// wp_register_script( 'html2pdf', '/wp-content/plugins/ss-list-export/js/html2pdf.bundle.min.js', array(), '0.10.1', true );
		// wp_enqueue_script( 'html2pdf' );
		wp_register_script('main_list_script', '/wp-content/plugins/ss-list-export/js/main_list_script.js', array(), '0.1', true);
		wp_enqueue_script('main_list_script');
	}
}

add_action('admin_enqueue_scripts', 'callback_for_setting_up_scripts');

function list_export_header($listType = 0)
{
	// Print page button
	echo '<div class="print-page-top print-hide"><a class="button" id="html2pdfBtn" href="#" onClick="window.print()">پرینت لیست</a></div>';
	if ($listType != 3) {
		// Hero image
		echo '<section class="main"><div class="list-hero-img"><img src="https://yasincomputer.com/wp-content/uploads/2022/11/yasin_list_hero_image-scaled-e1667809445738.jpg" width="1244" height="1500"/></div></section>';
	}
}

function list_export_footer($listType = 0)
{
	if ($listType != 3) {
		// End image
		echo '<div class="list-hero-img end-image"><img src="https://yasincomputer.com/wp-content/uploads/2022/11/yasin_list_end_image-scaled-e1667809591116.jpg" width="1048" height="1500"/></div>';
	}
}

// Products List export
function list_export_init($listType)
{
	if ($listType != 2) {
		list_export_header($listType);
	}
	?>
    <section class="cats" id="fehrest">
        <div class="before-cat-text">
            <p>
                <i class="dashicons-before dashicons-star-filled"></i>
                <span>برای مشاهده هر دسته، نام دسته مورد نظرتان را لمس کنید.</span>
            </p>
            <p>
                <i class="dashicons-before dashicons-star-filled"></i>
                <span>جهت برگشت به فهرست از <img src="/wp-content/plugins/ss-list-export/img/back-to-top.jpg"
                                                 width="143" height="53"> استفاده کنید.</span>
            </p>
        </div>
		<?php
		$children_cats = get_categories(array(
			'taxonomy' => 'product_cat',
			'orderby' => 'name',
			'hierarchical' => 1,
			'hide_empty' => true,
			'exclude_tree' => array(79),
			// 'posts_per_page' => 1,
			// 'number'    => 2,
		));
		if ($children_cats) { ?>
            <div class="cats-table" style="margin-top:50px;">
				<?php foreach ($children_cats as $subCat) {
					$categorie_name = $subCat->name;
					$categorie_id = $subCat->term_id;
					$categorie = $subCat->slug;
					
					$Args = array(
						'post_type' => 'product',
						'product_cat' => $categorie,
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
								'key' => '_stock_status',
								'value' => 'instock'
							),
							array(
								'key' => '_price',
								'value' => 0,
								'compare' => '>'
							),
						),
					);
					
					$Loop = new WP_Query($Args);
					
					if ($Loop->have_posts()) { ?>
                        <div class="button-grad">
                            <a href="#<?php echo $categorie; ?>"><?php echo $categorie_name; ?></a>
                        </div>
					<?php }
				} ?>
            </div>
		<?php } ?>
    </section>

    <section class="products">
		<?php
		$children = get_categories(array(
			'taxonomy' => 'product_cat',
			'orderby' => 'name',
			'hide_empty' => true,
			'exclude_tree' => array(79),
			// 'posts_per_page' => 1,
			// 'parent'    => 0,
		));
		
		if ($children) {	
			$tableNum = 1;
			
			foreach ($children as $subcat) {
				$sub_category = new WP_Term($subcat);	
// 				$kategorie_id = $sub_category->term_id;
// 				$kategorie = ;
				$args = array(
					'post_type' => 'product',
					'product_cat' => $sub_category->id,
					'posts_per_page' => -1,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => '_stock_status',
							'value' => 'instock',
							'compare' => 'IN'
						),
						array(
							'key' => '_price',
							'value' => 0,
							'compare' => '>'
						),
					)
				);
				
				if($listType == 2){
					$args['tax_query'] = [
						[
							'taxonomy' => 'product_brand',
							'field' => 'term_id',
							'terms' => array('2173'),
							'operator' => 'NOT IN'
						]
					];
				}
				
				$loop = new WP_Query($args);
				
				if ($loop->have_posts()) { ?>
                    <div class="table-wrap">
                        <div class="back-to-top">
                            <a href="#fehrest" class="button-grad button-grad-blue">بازگشت به فهرست</a>
                        </div>
                        <table class="products-table">
                            <thead class="table-head">
                                <tr>
                                    <th class="table-th-num">#</th>
                                    <th>کد</th>
                                    <th class="table-th-name">نام محصول</th>
                                    <th class="table-th-guarantee">
                                        <span>توضیحات</span>
                                    </th>
                                    <th class="table-th-box-quantity">
                                        <span>تعداد در کارتن</span>
                                    </th>
                                    <th>قیمت</th>
                                    <th class="table-th-image">عکس</th>
                                    <th class="print-hide">ویرایش ادمین</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="list-cat" colspan="7">
                                        <?php echo '<a target="_blank" id="' . $sub_category->slug . '" href="' . esc_url(get_term_link($sub_category, $sub_category->taxonomy)) . '">' . $sub_category->name; ?>
                                    </td>
                                </tr>
                                <?php while ($loop->have_posts()) :
                                    $loop->the_post();
                                    $product = wc_get_product(get_the_ID());
                                    $image_thumb_org = wp_get_attachment_image_src(get_post_thumbnail_id($product->ID), 'thumbnail');
                                    $catQuantity = $product->get_category_ids();
                                    $guarantee_field = wpautop(get_post_meta($product->get_id(), 'list_guarantee_field', true));
                                    
                                    if ($guarantee_field) {
                                        $guarantee = $guarantee_field;
                                    } else {
                                        $guarantee = '<p>-</p>';
                                    }
                                    
                                    $boxQuantity_field = get_post_meta($product->get_id(), 'box_quantity_field', true);
                                    
                                    if ($boxQuantity_field) {
                                        $boxQuantity = $boxQuantity_field;
                                    } else {
                                        $boxQuantity = '-';
                                    }
                                    
                                    $product_brand = get_the_terms($product->get_id(), 'product_brand');
                                    $product_price = $product->get_price();
                                    
                                    if (($listType == 2) && ($product_brand[0]->slug == 'royal')) {
                                        $product_price_5plus = ($product_price / 100) * 5;
                                        $product_FinalPrice = round(($product_price + $product_price_5plus), -2);
                                    } else if($listType==3){
	                                    $product_price_5plus = ($product_price / 100) * 5;
	                                    $product_FinalPrice = round(($product_price + $product_price_5plus), -2);
                                    }else{
                                        $product_FinalPrice = $product_price;
                                    }
                                    ?>
                                    <tr style="<?php echo count($catQuantity) > 1 ? 'background-color: red;' : '' ; ?>">
                                        <td class="table-num"><?php echo $tableNum ?></td>
                                        <td class="table-sku"><?php echo $product->get_sku(); ?></td>
                                        <td class="table-name">
                                            <h3>
                                                <?php if ($listType != 2) { ?>
                                                    <a target="_blank" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                                <?php } else {
                                                    echo the_title();
                                                } ?>
                                            </h3>
                                        </td>
                                        <td class="table-guarantee"><?php echo $guarantee; ?></td>
                                        <td class="table-box-quantity"><span><?php echo $boxQuantity; ?></span></td>
                                        <td class="table-price"><?php echo number_format($product_FinalPrice); ?></td>
                                        <td class="table-image">
                                            <img src="<?php echo $image_thumb_org[0]; ?>" height="150" width="150">
                                        </td>
                                        <td class="table-edit-link print-hide">
                                            <a href="/wp-admin/post.php?post=<?php echo $product->get_id(); ?>&action=edit" class="button" target="_blank">ویرایش محصول</a>
                                        </td>
                                    </tr>
                                    <?php $tableNum++;
							    endwhile; ?>
                            </tbody>
                        </table>
                    </div>
				<?php }
				wp_reset_postdata(); // Reset Query
			}
		} ?>
    </section>
	<?php
    if ($listType != 2) {
        list_export_footer($listType);
    }
}

// Products List export based on category 
function list_export_init_cat($categoryID)
{
	
       list_export_header();
    
	
	$tableNum = 1;
	global $product;
	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => '_stock_status',
				'value' => 'instock',
				'compare' => 'IN'
			),
			array(
				'key' => '_price',
				'value' => 0,
				'compare' => '>'
			),
		),
		'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'term_id',
				'terms' => is_array($categoryID) ? $categoryID : array($categoryID),
				'include_children' => true,
				'operator' => 'IN'
			)
		)
	);
	$loop = new WP_Query($args);
	?>
    <section class="table-wrap">
        <h1>
			<?php
			echo is_array($categoryID) ? 'لیست قیمت ' . get_the_category_by_ID($categoryID[0]) . ' و ' . get_the_category_by_ID($categoryID[1]) : 'لیست قیمت ' . get_the_category_by_ID($categoryID);
			?>
        </h1>
        <table class="products-table">
            <thead class="table-head">
            <th class="table-th-num">#</th>
            <th>کد</th>
            <th class="table-th-name">نام محصول</th>
            <th class="table-th-guarantee"><span>توضیحات</span></th>
            <th class="table-th-box-quantity"><span>تعداد</span></th>
            <th>قیمت</th>
            <th class="table-th-image">عکس</th>
            <th class="print-hide">ویرایش ادمین</th>
            </thead>
            <tbody>
			<?php
			while ($loop->have_posts()) : $loop->the_post();
				$product = wc_get_product(get_the_ID());
				$image = wp_get_attachment_image_src(get_post_thumbnail_id($product->ID), 'list-thumb');
				$guarantee_field = wpautop(get_post_meta($product->get_id(), 'list_guarantee_field', true));
				if ($guarantee_field) {
					$guarantee = $guarantee_field;
				} else {
					$guarantee = '<p>-</p>';
				}
				$boxQuantity_field = get_post_meta($product->get_id(), 'box_quantity_field', true);
				if ($boxQuantity_field) {
					$boxQuantity = $boxQuantity_field;
				} else {
					$boxQuantity = '-';
				}
				
				?>

                <tr>
                    <td class="table-num"><?php echo $tableNum ?></td>
                    <td class="table-sku"><?php echo $product->get_sku(); ?></td>
                    <td class="table-name"><h3><a target="_blank" href="<?php the_permalink() ?>" rel="bookmark"
                                                  title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                    </td>
                    <td class="table-guarantee"><?php echo $guarantee; ?></td>
                    <td class="table-box-quantity"><span><?php echo $boxQuantity; ?></span></td>
                    <td class="table-price"><?php echo number_format($product->get_price()); ?></td>
                    <td class="table-image"><img src="<?php echo $image[0]; ?>" height="120" width="120"></td>
                    <td class="table-edit-link print-hide"><a
                                href="/wp-admin/post.php?post=<?php echo $product->get_id(); ?>&action=edit"
                                class="button" target="_blank">ویرایش محصول</a></td>
                </tr>
				<?php
				$tableNum++;
			
			endwhile;
			?>
            </tbody>
        </table>
    </section>
	<?php
	wp_reset_postdata();
	
	 
      list_export_footer();
    
	
}


// Products List export based on brand 
function list_export_init_brand($brandID)
{
	
     list_export_header();
    
	
	$tableNum = 1;
	global $product;
	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => '_stock_status',
				'value' => 'instock',
				'compare' => 'IN'
			),
			array(
				'key' => '_price',
				'value' => 0,
				'compare' => '>'
			),
		),
		'tax_query' => array(
			array(
				'taxonomy' => 'product_brand',
				'field' => 'term_id',
				'terms' => array(strval($brandID)),
				'operator' => 'IN'
			)
		)
	);
	$loop = new WP_Query($args);
	?>
    <section class="table-wrap">
        <h1>
			<?php
			echo 'لیست قیمت ' . get_term($brandID)->name;
			?>
        </h1>
        <table class="products-table">
            <thead class="table-head">
            <th class="table-th-num">#</th>
            <th>کد</th>
            <th class="table-th-name">نام محصول</th>
            <th class="table-th-guarantee"><span>توضیحات</span></th>
            <th class="table-th-box-quantity"><span>تعداد در کارتن</span></th>
            <th>قیمت</th>
            <th class="table-th-image">عکس</th>
            <th class="print-hide">ویرایش ادمین</th>
            </thead>
            <tbody>
			<?php
			while ($loop->have_posts()) : $loop->the_post();
				$product = wc_get_product(get_the_ID());
				$image = wp_get_attachment_image_src(get_post_thumbnail_id($product->ID), 'list-thumb');
				$guarantee_field = wpautop(get_post_meta($product->get_id(), 'list_guarantee_field', true));
				if ($guarantee_field) {
					$guarantee = $guarantee_field;
				} else {
					$guarantee = '<p>-</p>';
				}
				$boxQuantity_field = get_post_meta($product->get_id(), 'box_quantity_field', true);
				if ($boxQuantity_field) {
					$boxQuantity = $boxQuantity_field;
				} else {
					$boxQuantity = '-';
				}
				
				?>

                <tr>
                    <td class="table-num"><?php echo $tableNum ?></td>
                    <td class="table-sku"><?php echo $product->get_sku(); ?></td>
                    <td class="table-name"><h3><a target="_blank" href="<?php the_permalink() ?>" rel="bookmark"
                                                  title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                    </td>
                    <td class="table-guarantee"><?php echo $guarantee; ?></td>
                    <td class="table-box-quantity"><span><?php echo $boxQuantity; ?></span></td>
                    <td class="table-price"><?php echo number_format($product->get_price()); ?></td>
                    <td class="table-image"><img src="<?php echo $image[0]; ?>" height="120" width="120"></td>
                    <td class="table-edit-link print-hide"><a
                                href="/wp-admin/post.php?post=<?php echo $product->get_id(); ?>&action=edit"
                                class="button" target="_blank">ویرایش محصول</a></td>
                </tr>
				<?php
				$tableNum++;
			
			endwhile;
			?>
            </tbody>
        </table>
    </section>
	<?php
	wp_reset_postdata();
	
	
     list_export_footer();
    
	
}