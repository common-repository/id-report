<?php


/*
*  Seleciona todos os pedidos com determinado status tendo como
*  argumento o ID do produto Woocommerce
*/
function idre_retrieve_orders_ids_from_a_product_id( $product_id )
{
    global $wpdb;

    $table_posts = $wpdb->prefix . "posts";
    $table_items = $wpdb->prefix . "woocommerce_order_items";
    $table_itemmeta = $wpdb->prefix . "woocommerce_order_itemmeta";

    // Define HERE the orders status to include in  <==  <==  <==  <==  <==  <==  <==
    // $orders_statuses = "'wc-completed', 'wc-processing', 'wc-on-hold'";
    $orders_statuses = "'wc-completed', 'wc-processing'";

    # Requesting All defined statuses Orders IDs for a defined product ID
    $orders_ids = $wpdb->get_col( "
        SELECT DISTINCT $table_items.order_id
        FROM $table_itemmeta, $table_items, $table_posts
        WHERE  $table_items.order_item_id = $table_itemmeta.order_item_id
        AND $table_items.order_id = $table_posts.ID
        AND $table_posts.post_status IN ( $orders_statuses )
        AND $table_itemmeta.meta_key LIKE '_product_id'
        AND $table_itemmeta.meta_value LIKE '$product_id'
        ORDER BY $table_items.order_item_id DESC"
    );
    // return an array of Orders IDs for the given product ID
    return $orders_ids;
}


/**
*  
*/

// retorna todos os pedidos 
function idre_retrieve_all_orders()
{
    global $wpdb;

    $table_posts = $wpdb->prefix . "posts";
    $table_items = $wpdb->prefix . "woocommerce_order_items";
    $table_itemmeta = $wpdb->prefix . "woocommerce_order_itemmeta";

    // Define HERE the orders status to include in  <==  <==  <==  <==  <==  <==  <==
    // $orders_statuses = "'wc-completed', 'wc-processing', 'wc-on-hold'";
    $orders_statuses = "'wc-completed', 'wc-processing'";

    # Requesting All defined statuses Orders IDs for a defined product ID
    $orders_ids = $wpdb->get_col( "
        SELECT DISTINCT $table_items.order_id
        FROM $table_itemmeta, $table_items, $table_posts
        WHERE  $table_items.order_item_id = $table_itemmeta.order_item_id
        AND $table_items.order_id = $table_posts.ID
        AND $table_posts.post_status IN ( $orders_statuses )
        -- AND $table_itemmeta.meta_key LIKE '_product_id'
        -- AND $table_itemmeta.meta_value LIKE '$product_id'
        ORDER BY $table_items.order_item_id DESC"
    );
    // return an array of Orders IDs for the given product ID
    //return $orders_ids;

    $coma_separated = implode(',',$orders_ids);
    echo  $coma_separated;

    exit;
}

add_action('wp_ajax_idre_retrieve_all_orders', 'idre_retrieve_all_orders');
add_action('wp_ajax_nopriv_idre_retrieve_all_orders', 'idre_retrieve_all_orders');



function idre_id_reports_get_orders_processing() {
    // global $wpdb;
    //Pesquisa todos os posts do tipo ignition_product
    $title = $_REQUEST['title'];

    $args = array(
        'post_type' => 'ignition_product',
        );

    $items = get_posts($args);
    $itemResultID = '';

    foreach($items as $item){
        if($item->post_title == $title){
            $itemResultID = $item->ID;
        };
    }	

    $idwcProjectPairing = ''; //trata-se do ID do produto do woocommerce vinculado com o projeto doIGN

    if($itemResultID){
        $metaDadosIgn = get_post_meta($itemResultID);
        $idwcProjectPairing = $metaDadosIgn['idwc_project_pairing'][0];
    }

    $pedidosIds = idre_retrieve_orders_ids_from_a_product_id($idwcProjectPairing);
    
    $coma_separated = implode(',',$pedidosIds);
    echo  $coma_separated;

    exit;
}

add_action('wp_ajax_idre_id_reports_get_orders_processing', 'idre_id_reports_get_orders_processing');
add_action('wp_ajax_nopriv_idre_id_reports_get_orders_processing', 'idre_id_reports_get_orders_processing');


//Prepara pdf dos pedidos IGNITIONDECK
function idre_id_reports_get_address_orders() {

    $upload = wp_upload_dir();


     // global $wpdb;
     //Pesquisa todos os posts do tipo ignition_product
     $pedidos = explode(",", $_REQUEST['pedidos']);
     $pdf = new FPDF('P', 'mm', 'A4');	
     $pdf->SetXY(100,150);
     $y_axis = 200;
     $y2_axis = 0;
     //initialize counter
     $i = 0;
     $pdf->SetFont('Arial','',10);
     $pdf->AddPage();
     foreach($pedidos as $pedido){
        $order = new WC_Order($pedido);
 	    $id = $order->id;
     	$first = $order->shipping_first_name;
     	$last = $order->shipping_last_name;
     	$sA1 = $order->shipping_address_1;
     	$sN = $order->shipping_number;
     	$sA2 = $order->shipping_address_2;
     	$sS = $order->shipping_city;
        $sBai = $order->shipping_neighborhood;
        $sSta = $order->shipping_state;
     	$sPC = $order->shipping_postcode; 

        $pdf->SetFont('Arial','B',10);
     	$pdf->Cell(40,10, iconv('utf-8','iso-8859-1',$first).' '.iconv('utf-8','iso-8859-1',$last));
     	$pdf->Ln(4);
        $pdf->SetFont('','',10);
     	$pdf->Cell(60,10, iconv('utf-8','iso-8859-1',$sA1).' '.iconv('utf-8','iso-8859-1',', '.$sN).' '.iconv('utf-8','iso-8859-1',', '.$sA2));
	    $pdf->Ln(4);
     	$pdf->Cell(40,10, iconv('utf-8','iso-8859-1',$sBai));
        $pdf->Ln(4);
        $pdf->Cell(40,10,iconv('utf-8','iso-8859-1',$sS) .' - '. iconv('utf-8','iso-8859-1',$sSta));
        $pdf->Ln(4);
	    $pdf->Cell(40,10, iconv('utf-8','iso-8859-1','CEP: '.$sPC));    	   
	    $pdf->Ln(10);	
    }
        
    
    $number = rand(10,100);
    $filename = $upload['path']."/".$number."idreport.pdf";
    array_map('unlink', glob( $filename));    
    $pdf->Output($filename,'F');
    chmod($filename, 0777);
    echo $upload['url'].'/'.$number.'idreport.pdf';
	exit;
}
 
add_action('wp_ajax_idre_id_reports_get_address_orders', 'idre_id_reports_get_address_orders');
add_action('wp_ajax_nopriv_idre_id_reports_get_address_orders', 'idre_id_reports_get_address_orders');





//Prepara pdf dos pedidos woocommerce 
function idre_get_all_address_orders() {

    $upload = wp_upload_dir();


     // global $wpdb;
     //Pesquisa todos os posts do tipo ignition_product
     $pedidos = explode(",", $_REQUEST['pedidoswoo']);
     $pdf = new FPDF('P', 'mm', 'A4');  
     $pdf->SetXY(100,150);
     $y_axis = 200;
     $y2_axis = 0;
     //initialize counter
     $i = 0;
     $pdf->SetFont('Arial','',10);
     $pdf->AddPage();
     foreach($pedidos as $pedido){
        $order = new WC_Order($pedido);
        $id = $order->id;
        $first = $order->shipping_first_name;
        $last = $order->shipping_last_name;
        $sA1 = $order->shipping_address_1;
        $sN = $order->shipping_number;
        $sA2 = $order->shipping_address_2;
        $sS = $order->shipping_city;
        $sBai = $order->shipping_neighborhood;
        $sSta = $order->shipping_state;
        $sPC = $order->shipping_postcode; 


        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(40,10,iconv('utf-8','iso-8859-1',$first).' '. iconv('utf-8','iso-8859-1',$last));
        $pdf->Ln(4);
        $pdf->SetFont('','',10);
        $pdf->Cell(60,10, iconv('utf-8','iso-8859-1',$sA1).' '.iconv('utf-8','iso-8859-1',', '.$sN).''.iconv('utf-8','iso-8859-1',', '.$sA2));
        $pdf->Ln(4);
        $pdf->Cell(40,10, iconv('utf-8','iso-8859-1',$sBai));
        $pdf->Ln(4);
        $pdf->Cell(40,10,iconv('utf-8','iso-8859-1',$sS) .' - '. iconv('utf-8','iso-8859-1',$sSta));
        $pdf->Ln(4);
        $pdf->Cell(40,10, iconv('utf-8','iso-8859-1','CEP: '.$sPC));           
        $pdf->Ln(10);   
    }
        
    $number = rand(10,100);
    $filename = $upload['path']."/".$number."idreport.pdf";
    array_map('unlink', glob( $filename));    
    $pdf->Output($filename,'F');
    chmod($filename, 0777);
    echo $upload['url'].'/'.$number.'idreport.pdf';
    exit;
}
 
add_action('wp_ajax_idre_get_all_address_orders', 'idre_get_all_address_orders');
add_action('wp_ajax_nopriv_idre_get_all_address_orders', 'idre_get_all_address_orders');





