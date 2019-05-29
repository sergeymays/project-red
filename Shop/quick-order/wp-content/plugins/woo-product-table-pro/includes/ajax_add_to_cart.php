<?php

function wpt_ajax_paginate_links_load(){
    $targetTableArgs = ( isset( $_POST['targetTableArgs'] ) ? $_POST['targetTableArgs'] : false );
    $temp_number = ( isset( $_POST['temp_number'] ) ? $_POST['temp_number'] : false );
    $directkey = ( isset( $_POST['directkey'] ) ? $_POST['directkey'] : false );
    $texonomies = ( isset( $_POST['texonomies'] ) ? $_POST['texonomies'] : false );
    $pageNumber = ( isset( $_POST['pageNumber'] ) && $_POST['pageNumber'] > 0 ? $_POST['pageNumber'] : 1 );
    $load_type = ( isset( $_POST['load_type'] ) && $_POST['load_type'] == 'current_page' ? true : false );
    
    
    
    $args = $targetTableArgs['args'];
    
    if( !$load_type ){
        if( isset( $directkey['s'] ) ){
            $args['s'] = $directkey['s'];
        }
        $args['orderby'] = ( isset( $directkey['orderby'] ) ? $directkey['orderby'] : false );
        $args['order'] = ( isset( $directkey['order'] ) ? $directkey['order'] : false );
        /**
         * Texonomy Handle
         */
        unset($args['tax_query']);
        if( is_array( $texonomies ) && count( $texonomies ) > 0 ){
            foreach( $texonomies as $texonomie_key => $texonomie ){
                if(is_array( $texonomie ) && count( $texonomie ) > 0 ){
                    $args['tax_query'][] = array(
                        'taxonomy' => $texonomie_key,
                        'field' => 'id',
                        'terms' => $texonomie,
                        'operator' => 'IN'
                    );
                }
            }
        }
        $args['tax_query']['relation'] = 'AND';
    }
    /**
     * Page Number Hander
     */
    $args['paged']   = $pageNumber;
    //var_dump($args['tax_query']);
    $table_column_keywords  = $targetTableArgs['wpt_table_column_keywords'];
    $sort                       = $args['order'];//$targetTableArgs['wpt_product_short'];
    $wpt_permitted_td           = $targetTableArgs['wpt_permitted_td'];
    $add_to_cart_text           = $targetTableArgs['wpt_add_to_cart_text'];
    
    $texonomy_key               = $targetTableArgs['texonomy_key'];
    $customfield_key            = $targetTableArgs['customfield_key'];
    $filter_keywords            = $targetTableArgs['filter_key'];
    $filter_box                 = $targetTableArgs['filter_box'];
    //$wpt_description_length   = $targetTableArgs['description_length'];
    $description_type           = $targetTableArgs['description_type'];
    $ajax_action                = $targetTableArgs['ajax_action'];

    //Добавлено для поиска по sku
    if(!empty($args['s'])) {
        $args = array_merge($args, ['name' => 'search_ajqsqs']);
    }

    $table_row_generator_array = array(
        'args'                      => $args,
        'wpt_table_column_keywords' => $table_column_keywords,
        'wpt_product_short'         => $sort,
        'wpt_permitted_td'          => $wpt_permitted_td,
        'wpt_add_to_cart_text'      => $add_to_cart_text,
        'temp_number'               => $temp_number,
        'texonomy_key'              => $texonomy_key,
        'customfield_key'           => $customfield_key,
        'filter_key'                => $filter_keywords,
        'filter_box'                => $filter_box,
        'description_type'          => $description_type,
        'ajax_action'               => $ajax_action,
    );
    echo '<mypagi myjson="'. esc_attr( wp_json_encode( $table_row_generator_array ) ) .'">'. wpt_paginate_links( $args ) . '</mypagi>';//wp_json_encode($args);//echo wpt_paginate_links( $args );
    die();
}
add_action('wp_ajax_wpt_ajax_paginate_links_load', 'wpt_ajax_paginate_links_load');
add_action('wp_ajax_nopriv_wpt_ajax_paginate_links_load', 'wpt_ajax_paginate_links_load');
/**
 * Table Load by ajax Query before on Tables Top
 * 
 * @since 1.9
 */
function wpt_ajax_table_row_load(){
    
    $targetTableArgs = ( isset( $_POST['targetTableArgs'] ) ? $_POST['targetTableArgs'] : false );
    $temp_number = ( isset( $_POST['temp_number'] ) ? $_POST['temp_number'] : false );
    $directkey = ( isset( $_POST['directkey'] ) ? $_POST['directkey'] : false );
    $texonomies = ( isset( $_POST['texonomies'] ) ? $_POST['texonomies'] : false );
    $pageNumber = ( isset( $_POST['pageNumber'] ) && $_POST['pageNumber'] > 0 ? $_POST['pageNumber'] : 1 );
    $load_type = ( isset( $_POST['load_type'] ) && $_POST['load_type'] == 'current_page' ? true : false );
    
    
    
    $args = $targetTableArgs['args'];
    
    if( !$load_type ){
        if( isset( $directkey['s'] ) ){
            $args['s'] = $directkey['s'];
        }
        $args['orderby'] = ( isset( $directkey['orderby'] ) ? $directkey['orderby'] : false );
        $args['order'] = ( isset( $directkey['order'] ) ? $directkey['order'] : false );
        /**
         * Texonomy Handle
         */
        unset($args['tax_query']);
        if( is_array( $texonomies ) && count( $texonomies ) > 0 ){
            foreach( $texonomies as $texonomie_key => $texonomie ){
                if(is_array( $texonomie ) && count( $texonomie ) > 0 ){
                    $args['tax_query'][] = array(
                        'taxonomy' => $texonomie_key,
                        'field' => 'id',
                        'terms' => $texonomie,
                        'operator' => 'IN'
                    );
                }
            }
        }
        $args['tax_query']['relation'] = 'AND';
    }
    /**
     * Page Number Hander
     */
    $args['paged']   = $pageNumber;
    //var_dump($args['tax_query']);
    $table_column_keywords  = $targetTableArgs['wpt_table_column_keywords'];
    $sort                       = $args['order'];//$targetTableArgs['wpt_product_short'];
    $wpt_permitted_td           = $targetTableArgs['wpt_permitted_td'];
    $add_to_cart_text           = $targetTableArgs['wpt_add_to_cart_text'];
    
    $texonomy_key               = $targetTableArgs['texonomy_key'];
    $customfield_key            = $targetTableArgs['customfield_key'];
    $filter_keywords            = $targetTableArgs['filter_key'];
    $filter_box                 = $targetTableArgs['filter_box'];
    //$wpt_description_length   = $targetTableArgs['description_length'];
    $description_type           = $targetTableArgs['description_type'];
    $ajax_action                = $targetTableArgs['ajax_action'];
    
    //Добавлено для поиска по sku
    if(!empty($args['s'])) {
        $args = array_merge($args, ['name' => 'search_ajqsqs']);
    }

    $table_row_generator_array = array(
        'args'                      => $args,
        'wpt_table_column_keywords' => $table_column_keywords,
        'wpt_product_short'         => $sort,
        'wpt_permitted_td'          => $wpt_permitted_td,
        'wpt_add_to_cart_text'      => $add_to_cart_text,
        'temp_number'               => $temp_number,
        'texonomy_key'              => $texonomy_key,
        'customfield_key'           => $customfield_key,
        'filter_key'                => $filter_keywords,
        'filter_box'                => $filter_box,
        'description_type'          => $description_type,
        'ajax_action'               => $ajax_action,
    );
    //var_dump($table_row_generator_array);
    echo wpt_table_row_generator( $table_row_generator_array );
     
    die();
}
add_action('wp_ajax_wpt_query_table_load_by_args', 'wpt_ajax_table_row_load');
add_action('wp_ajax_nopriv_wpt_query_table_load_by_args', 'wpt_ajax_table_row_load');

/**
 * Adding Item by Ajax. This Function is not for using to any others whee.
 * But we will use this function for Ajax
 * 
 * @since 1.0.4
 * @date 28.04.2018 (D.M.Y)
 * @updated 04.05.2018
 */
function wpt_ajax_add_to_cart() {
    
    $product_id     = ( isset($_POST['product_id']) && !empty($_POST['product_id']) ? $_POST['product_id'] : false );
    $quantity       = ( isset($_POST['quantity']) && !empty($_POST['quantity']) && is_numeric($_POST['quantity']) ? $_POST['quantity'] : 1 );
    $variation_id   = ( isset($_POST['variation_id']) && !empty($_POST['variation_id']) ? $_POST['variation_id'] : false );
    $variation      = ( isset($_POST['variation']) && !empty($_POST['variation']) ? $_POST['variation'] : false );
    $custom_message = ( isset($_POST['custom_message']) && !empty($_POST['custom_message']) ? $_POST['custom_message'] : false );
    
    $string_for_var = '_var' . implode('_', $variation) . '_';
    
    $cart_item_data = false; //Set default value false, if found Custom message, than it will generate true
    
    if( $custom_message ){
        $custom_message = htmlspecialchars( $custom_message ); //$custom_message is Generating for tag and charecter
    
        /**
         * Custom Message for Product Adding
         * 
         * @since 1.9
         */
        $cart_item_data[ 'wpt_custom_message' ] = $custom_message;
            // below statement make sure every add to cart action as unique line item
        $cart_item_data['unique_key'] = md5( $product_id . $string_for_var . '_' .$custom_message );//md5( microtime().rand() ); //
    }
    /**
     else{
       $cart_item_data['unique_key'] = md5( $product_id . $string_for_var ) ; 
    }
     */
    
    wpt_adding_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data );
    
    //return wpt_adding_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data );
    /***********************
    //Removed this part upto **** Because we have used another ajax function for WC_AJAX::get_refreshed_fragments();
    //Now useing wpt_fragment_refresh() for this perpose
    $cart_adding_validation = wpt_adding_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data );
    
    if( $cart_adding_validation ){
        WC_AJAX::get_refreshed_fragments();
    }
    /****************/
    die();
}

add_action('wp_ajax_wpt_ajax_add_to_cart', 'wpt_ajax_add_to_cart');
add_action('wp_ajax_nopriv_wpt_ajax_add_to_cart', 'wpt_ajax_add_to_cart');

/**
 * Getting refresh for fragments
 * 
 * @Since 3.7
 */
function wpt_fragment_refresh(){
    WC_AJAX::get_refreshed_fragments();
    die();
}
add_action('wp_ajax_wpt_fragment_refresh', 'wpt_fragment_refresh');
add_action('wp_ajax_nopriv_wpt_fragment_refresh', 'wpt_fragment_refresh');

/**
 * Getting Image URL and with info for variation images
 * 
 * @Since 3.7
 */
function wpt_variation_image_load(){
    $variation_id = isset( $_POST['variation_id'] ) ? $_POST['variation_id'] : false;
    if( $variation_id ){
        $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $variation_id ), 'full', false );   
        echo $img_src[0] . ' ' . $img_src[1];//wp_json_encode($img_src);[]
    }

    die();
}
add_action('wp_ajax_wpt_variation_image_load', 'wpt_variation_image_load');
add_action('wp_ajax_nopriv_wpt_variation_image_load', 'wpt_variation_image_load');


/**
 * To use in Action Hook for Ajax
 * for Multiple product adding to cart by One click
 * 
 * @since 1.0.4
 * @version 1.0.4
 * @date 3.5.2018
 * return Void
 */
function wpt_ajax_multiple_add_to_cart() {
    $products = false;
    if (isset($_POST['products']) && is_array($_POST['products'])) {
        $products = $_POST['products'];
    }
    wpt_adding_to_cart_multiple_items( $products );
    /*
    //This part has removed from version 3.8.3 and also removed WC_AJAX::get_refreshed_fragments(); because we are using now wpt_fragment_refresh()
    $multiple_cart_adding_validation = wpt_adding_to_cart_multiple_items( $products );
    
    WC_AJAX::get_refreshed_fragments();
    //Now live cartwill handle by another controller in custom.js file
    //wpt_live_cart_for_table();
    */
    die();
}

add_action('wp_ajax_wpt_ajax_mulitple_add_to_cart', 'wpt_ajax_multiple_add_to_cart');
add_action('wp_ajax_nopriv_wpt_ajax_mulitple_add_to_cart', 'wpt_ajax_multiple_add_to_cart');

/**
 * Adding Item to cart by Using WooCommerce WC() Static Object
 * WC()->cart->add_to_cart(); Need few Perameters
 * Normally we tried to Check Each/All Action, When Adding
 * 
 * @param Int $product_id
 * @param Int $quantity
 * @param Int $variation_id
 * @param Array $variation
 * @return Void
 */
function wpt_adding_to_cart( $product_id = 0, $quantity = 1, $variation_id = 0, $variation = array(), $cart_item_data = array() ){
    
    $validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variation, $cart_item_data );     
    if( $validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data ) ){
        $config_value = get_option('wpt_configure_options');
        if( $config_value['popup_notice'] == '1' ){
            wc_add_notice( '"' . get_the_title( $product_id ) . '" ' . $config_value['add2cart_all_added_text']);
        }
        return true;
    }
    return;
}

/**
 * Getting notice by ajax, Control this function from custom.js file
 * 
 * @since 3.8
 * @return type data
 */
function wpt_print_notice(){
    wc_print_notices();
    die();
}
add_action('wp_ajax_wpt_print_notice', 'wpt_print_notice');
add_action('wp_ajax_nopriv_wpt_print_notice', 'wpt_print_notice');

/**
 * Adding Multiple product to Cart by One click. So we used an Array
 * Array's each Item has indivisual Array with product_id,variation_id,quantity,variations's array
 * 
 * @param Array $products Product's Array which will use for adding to cart
 * @return Void
 */
function wpt_adding_to_cart_multiple_items( $products = false ){
    if ( $products && is_array($products) ){
        $serial = 0;
        foreach ($products as $product) {
            $product_id = ( isset($product['product_id']) && !empty($product['product_id']) ? $product['product_id'] : false );
            $quantity = ( isset($product['quantity']) && !empty($product['quantity']) && is_numeric($product['quantity']) ? $product['quantity'] : 1 );
            $variation_id = ( isset($product['variation_id']) && !empty($product['variation_id']) ? $product['variation_id'] : false );

            $variation = ( isset($product['variation']) && !empty($product['variation']) ? $product['variation'] : false );
            
            //Added at @Since 1.9
            $custom_message = ( isset($product['custom_message']) && !empty($product['custom_message']) ? $product['custom_message'] : false );
            
            //Added at 2.1
            $string_for_var = '_var' . implode('_', $variation) . '_';

            //Added at @Since 1.9
            $cart_item_data = false; //Set default value false, if found Custom message, than it will generate true

            if( $custom_message ){
                $custom_message = htmlspecialchars( $custom_message ); //$custom_message is Generating for tag and charecter

                /**
                 * Custom Message for Product Adding
                 * 
                 * @since 1.9
                 */
                $cart_item_data[ 'wpt_custom_message' ] = $custom_message;
                    // below statement make sure every add to cart action as unique line item
                $cart_item_data['unique_key'] = md5( $product_id . $string_for_var . '_' .$custom_message );//md5( microtime().rand() ); //$product_id . '_' .$custom_message;//
            }
            wpt_adding_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data );
            $serial++;
        }
        if( $serial > 0 ){
            return false;
        }
    }
}
/**
 * Removing Added to cart Message. Actualy If we add cart item programitically,
 * and visit any page, Normally display WooCommerce Message. So we have removed
 * by filter wc_add_to_cart_message
 * 
 * @deprecated since 1.7 1.7_3_18.5.2018
 * @return False
 * @updated 18/5/2018 d/m/y
 */
function wpt_remove_add_to_cart_message() {
    return;
}
//add_filter('wc_add_to_cart_message', 'wpt_remove_add_to_cart_message');


/**
 * HTML version for Live cart in Header of Each Table. Used for Ajax Load.
 * 
 * @deprecated since version 3.8.0 A new function added for Mini cart, It has removed from latest version
 * @global type $woocommerce used $woocommerce variable to get few data for cart live
 * @return self Just it will display element
 */
function wpt_live_cart_for_table() {
    $config_value = get_option('wpt_configure_options');
    ?>
    <div class="wpt_live_cart_box">
        <?php
        $items = WC()->cart->get_cart();
        
        global $woocommerce;
        $item_count = $woocommerce->cart->cart_contents_count;
        ?>
        <div class="wpt_live_cart_header">
            <a class="wpt_cart_totals" href="<?php echo wc_get_cart_url(); ?>" title="<?php echo $config_value['mcart_view_title']; /*_e('View your shopping cart','wpt_pro');*/ ?>"><?php echo $config_value['mcart_cart']; /*_e('Cart','wpt_pro');*/ ?> (<span><?php echo $item_count; ?></span>)</a>
            <?php if ($items) { ?>
                <div class="wpt_live-cart-subtotal">
                    <strong><?php echo $config_value['mcart_subtotla'];/** Subtotal */ ?>: <?php echo WC()->cart->get_cart_total(); ?></strong>
                </div>

                <?php
                $cart_url = $woocommerce->cart->get_cart_url();
                $checkout_url = $woocommerce->cart->get_checkout_url();
                ?>

                <div class="wpt_live-cart-other_link">
                    <a href="<?php echo $cart_url; ?>"><?php echo $config_value['mcart_view_cart']; /*_e('View Cart','wpt_pro');*/ ?></a>
                    <a href="<?php echo $checkout_url; ?>"><?php echo $config_value['mcart_checkout']; /*_e('Checkout','wpt_pro');*/ ?></a>
                </div>

            <?php } ?>
        </div>
        <div class="cart-dropdown">
            <div class="cart-dropdown-inner">
                <?php if ($items) { ?>
                    <ul class="wpt_dropdown">
                        <?php
                        foreach ($items as $item => $values) {
                            
                            
                            $cart_remove_url = wc_get_cart_remove_url( $item );
                            //var_dump(wp_nonce_url( add_query_arg( 'remove_item', $item )));
                            /**
                             * For Custom Message in cart
                             * 
                             * @since 1.9
                             */
                            $wpt_custom_message = $wpt_custom_message_original = false;
                            if( !empty( $values['wpt_custom_message'] ) ){
                                $wpt_custom_message = $wpt_custom_message_original = $values['wpt_custom_message'];
                                $wpt_custom_message_generated = wpt_limit_words( $wpt_custom_message, 8 );//substr( $wpt_custom_message, 0, 100 );
                                //$wpt_custom_message = (strlen( $wpt_custom_message ) > strlen( $wpt_custom_message_generated ) ? $wpt_custom_message_generated . '..' : $wpt_custom_message_generated );
                                $wpt_custom_message = ' <span class="custom_msg_in_cart">[' . $wpt_custom_message_generated . ']</span> ';
                                $wpt_custom_message_original = __( 'Message:', 'wpt_pro' ). ' ' .$wpt_custom_message_original;
                                
                            }
                            
                            $_product = $values['data']->post;
                            $full_product = new WC_Product_Variable($values['product_id']);
                            $attributes = $full_product->get_available_variations();
                            $price = 0;
                            if ($values['variation_id'] && is_array($attributes)) {
                                foreach ($attributes as $attribute) {
                                    if ($attribute['variation_id'] == $values['variation_id']) {
                                        $price = $attribute['display_price'];
                                    }
                                }

                                $sale = false;
                            } else {
                                $price = get_post_meta($values['product_id'], '_regular_price', true);
                                $sale = get_post_meta($values['product_id'], '_sale_price', true);
                            }
                            ?>

                        <li class="li woocommerce-mini-cart-item mini_cart_item" title="<?php echo $wpt_custom_message_original; ?>">
                            <a href="<?php echo $cart_remove_url; ?>" class="remove remove_from_cart_button wpt_remove_cart_link" aria-label="Remove this item" data-product_id="<?php echo $values['product_id'] ?>" data-cart_item_key="<?php echo $values['key'] ?>" data-product_sku="">×</a>
                                    
                            <?php
                            /*
                            $remove_cart_link = '<a title="' . __( 'Remove', 'wpt_pro' ) . '" href="'. wc_get_cart_remove_url( $item ) .'" class="remove_cart_icon">&times;</a>';
                            echo apply_filters( 'woocommerce_cart_item_remove_link', $remove_cart_link, $item);
                            */
                            ?>
                            <span class="wpt_cart_title"><?php echo $_product->post_title; ?><?php echo $wpt_custom_message; ?></span>

                                <?php
                                $currency = get_woocommerce_currency_symbol();
                                ?>

                                <?php if ($sale) { ?>
                                    <strong class="price"><strong><?php _e('Price:','wpt_pro'); ?></strong> <del><?php
                                    echo $currency;
                                    echo $price;
                                    ?></del> <?php
                                            echo $currency;
                                            echo $sale;
                                            ?></strong>
                                        <?php } elseif ($price) { ?>
                                    <strong class="price"><strong><?php echo $config_value['mcart_price']; /*_e('Price:','wpt_pro');*/ ?></strong> <?php
                            echo $currency;
                            echo $price;
                                            ?></strong>    
                                    <?php } ?>
                                <span> X </span>
                                <span class="wpt_cart_quantity"><?php echo $values['quantity']; ?></span>

                                
                            </li>
                        <?php
                        //Again set false for Blank for blank
                        $wpt_custom_message = $wpt_custom_message_original = false;
                        } ?>
                    </ul>

                <?php } else { ?>
                    <div class="dropdown-cart-wrap">
                        <p><?php echo $config_value['mcart_empty_now']; /*_e('Your cart is empty.','wpt_pro');*/ ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    die();
}
add_action('wp_ajax_wpt_cart_auto_load', 'wpt_live_cart_for_table');
add_action('wp_ajax_nopriv_wpt_cart_auto_load', 'wpt_live_cart_for_table');

/**
 * Getting WooCommerce selected data, we can use it for different needs. Used for getting count details
 * 
 * @deprecated since version 3.7.12 This ajax loader for count has removed on latest version.
 * @global type $woocommerce WooCommerce default global variable
 */
function wpt_get_cart_count(){
    global $woocommerce;
    /*
    $cartInfo = array(
        'cart_count'    =>  $woocommerce->cart->cart_contents_count,
        'cart_totals'    =>  WC()->cart->get_totals(),
        'provider'      =>  'WOO_Product_table',
    );
    */
    echo $woocommerce->cart->cart_contents_count;
    die();
}
add_action('wp_ajax_wpt_cart_info_details', 'wpt_get_cart_count');
add_action('wp_ajax_nopriv_wpt_cart_info_details', 'wpt_get_cart_count');


/**
 * Adding Custom Mesage Field in Single Product Page
 * By Default: Disable, if you need, you can active it by enable action under this function
 * 
 * @since 1.9
 * @date 7.6.2018 d.m.y
 */
function wpt_add_custom_message_field() {
    echo '<table class="variations" cellspacing="0">
          <tbody>
              <tr>
              <td class="label"><label for="custom_message">Short Message</label></td>
              <td class="value">
                  <input id="custom_message" type="text" name="wpt_custom_message" placeholder="Short Message for Order" />                      
              </td>
          </tr>                               
          </tbody>
      </table>';
}
//add_action( 'woocommerce_before_add_to_cart_button', 'wpt_add_custom_message_field' );

/**
 * To set Validation, I mean: Required.
 * By Default: Disable, if you need, you can active it by enable action under this function
 * 
 * @since 1.9
 * @return boolean
 */
function wpt_custom_message_validation() { 
    if ( empty( $_REQUEST['wpt_custom_message'] ) ) {
        wc_add_notice( __( 'Please enter Short Message', 'wpt_pro' ), 'error' );
        return false;
    }
    return true;
}
//add_action( 'woocommerce_add_to_cart_validation', 'wpt_custom_message_validation', 10, 3 );


/**
 * Saving Custom Message Data here
 * 
 * @param type $cart_item_data
 * @param type $product_id
 * @return string
 */
function wpt_save_custom_message_field( $cart_item_data, $product_id ) {
    if( isset( $_REQUEST['wpt_custom_message'] ) ) {
        $generated_message = htmlspecialchars( $_REQUEST['wpt_custom_message']);
        $cart_item_data[ 'wpt_custom_message' ] =  $generated_message;
        /* below statement make sure every add to cart action as unique line item */
        $cart_item_data['unique_key'] = $product_id . '_' . $generated_message;//md5( microtime().rand() );
    }
    return $cart_item_data;
}
add_action( 'woocommerce_add_cart_item_data', 'wpt_save_custom_message_field', 10, 2 );

/**
 * For Displaying custom Message in WooCommerce Cart
 * Need Woo 2.4.2 or updates
 * 
 * @param type $cart_data
 * @param type $cart_item
 * @return Array
 */
function wpt_render_meta_on_cart_and_checkout( $cart_data, $cart_item = null ) {
    $custom_items = array();
    /* Woo 2.4.2 updates */
    if( !empty( $cart_data ) ) {
        $custom_items = $cart_data;
    }
    if( isset( $cart_item['wpt_custom_message'] ) ) {
        $custom_items[] = array( "name" => __( 'Message', 'wpt_pro' ), "value" => $cart_item['wpt_custom_message'] );
    }
    return $custom_items;
}
add_filter( 'woocommerce_get_item_data', 'wpt_render_meta_on_cart_and_checkout', 10, 2 );

/**
 * Adding Customer Message to Order
 * 
 * @param type $item_id Session ID of Item's
 * @param type $values Value's Array of Customer message
 * @param type $cart_item_key
 * 
 * @since 1.9 6.6.2018 d.m.y
 * @return Void This Function will add Customer Custom Message to Order
 */
function wpt_order_meta_handler( $item_id, $values, $cart_item_key ) {
    if( isset( $values['wpt_custom_message'] ) ) {
        wc_add_order_item_meta( $item_id, __( 'Message', 'wpt_pro' ), $values['wpt_custom_message'] );
    }
}
add_action( 'woocommerce_add_order_item_meta', 'wpt_order_meta_handler', 1, 3 );