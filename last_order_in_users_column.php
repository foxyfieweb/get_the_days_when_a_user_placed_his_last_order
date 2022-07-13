<?php
// adding a column "Last Order" into users panel

function add_last_order_column( $columns ){
    $columns['last_order'] = 'Last Order';
    return $columns;
}
add_filter( 'manage_users_columns', 'add_last_order_column' );

// populating the days when a last order was placed by a user
function show_last_order_column_content( $value, $column_name, $user_id ){
    if ( 'last_order' == $column_name ){
		$last_order = date_format(wc_get_customer_last_order($user_id)->date_created, "Y/m/d");
    
    // if you want to return the date if last order not days then return this, and comment out the last line in this block
    // return $last_order;
    
		return round((time() - strtotime($last_order))/ (60 * 60 * 24)) .' Days ago';
    }
    return $value;
}
add_action( 'manage_users_custom_column', 'show_last_order_column_content', 10, 3 );

?>
