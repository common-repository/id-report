<?php
/*
   Plugin Name: ID Report
   Plugin URI: http://daniloribeiro.net
   Description: Plugin para exportação de dados de endereço de pedidos realizados no IgnitionDeck/Woocommerce para formato PDF
   Author: Danilo Ribeiro
   Version: 2.0.3
   Author URI: http://daniloribeiro.net/
*/

/*
		version constant
*/
define("IDREPORT_VERSION","2.0.3");

/*
    Includes
*/
define("IDR_DIR", plugin_dir_path(__FILE__));
define('FPDF_FONTPATH',IDR_DIR.'includes/fpdf181/font/');


/*
		Action que cria menu no menu painel 
*/ 
add_action('admin_menu', 'idreport_plugin_setup_menu');
 
function idreport_plugin_setup_menu(){
        add_menu_page( 
        	'Plugin ID page', 
        	'ID Reports', 
        	'manage_options', 
        	'idreports', 
        	'idreports_page' );
}


function idreports_page(){
  require_once( IDR_DIR . "/adminpages/reports.php" );
}

require_once(IDR_DIR .'includes/fpdf181/fpdf.php');
require_once("idreports-functions.php");




