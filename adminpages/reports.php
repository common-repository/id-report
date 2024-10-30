<?php 
	function id_report_get_project_names() {
	global $wpdb;
	$sql = 'SELECT * FROM '.$wpdb->prefix.'ign_products';
	$projects = $wpdb->get_results($sql);
	return $projects;
}

$all_projects = id_report_get_project_names();

?> 

<style>
.alert-danger {
    background-color: #e74c3c;
    border-color: #e74c3c;
    color: #ffffff;
    padding: 15px;
    margin-bottom: 10px;
    border: 1px solid transparent;
    border-radius: 4px;
}
.hidden{
    display:none;
}
.show{
    display:block;
}
</style>

<div class="bs-docs-section">

	<div class="icon32" ></div> <h2>ID Report - IgnitionDeck | Woocommerce </h2>

	<div class="postbox-container" style="width:65%; margin-right: 5%">

		<!-- Ignitiondeck -->
		<div class="metabox-holder">
			<div class="meta-box-sortables" style="min-height:0;">
                
				<div class="postbox">
		          <div  class="alert-danger hidden" id="error">
		              <span > Desculpe, Algo deu errado. Recarregue a página e tente novamente </span> 
		          </div>
					<h3 class="hndle"><span><?php _e('Pedidos IgnitionDeck', 'idreport'); ?></span></h3>
					<div class="inside">
					<p><?php _e('Gere PDF dos endereços de envio de pedidos realizados por meio
					de projetos IgnitionDeck com status processing*, concluded* ', 'idreport'); ?>.</p>
						<form method="POST" action="" id="idreport" name="idreport">
							<fieldset>
								<div class="form-group select-field">
									<label for="project" class="col-lg-2 control-label"><?php _e('Selecione o Projeto IgnitionDeck', 'idreport'); ?>
										
									</label>
									</br>
									</br>
									<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
										<select  class="form-control"id="project" name="project">
											<option value=""><?php _e('Projetos', 'idreport'); ?></option>
											<?php
											foreach ($all_projects as $project) {
												echo '<option value="'.$project->id.'">'.$project->product_name.'</option>';
											}
											?>
										</select>
									</div>
								</div>

	              				<div class="form-group select-field-pedidos hidden">
									<!-- <label class="col-lg-2 control-label" for="project"><?php _e('Pedidos', 'idreport'); ?></label> -->
									<div class="col-lg-10">
										<select class="form-control" id="pedido" name="pedido" multiple="multiple" size=30 style='height: 200px;width: 15%;'>
	                  						<!-- <option value=""><?php _e('Pedidos', 'idreport'); ?></option> -->
										</select>
									</div>
								</div>
	                            
								<div class="form-group submit">
									<label class="col-lg-2 control-label"></label>
									<div class="col-lg-10">
	  									<input type="submit" name="idreport-get-metadata" id="idreport-get-metadata" value="<?php _e('Gerar PDF', 'idreport'); ?>" class="button-primary"/>
	  									<button type="button" id="idreport-get-all-metadata"  class="button-primary"><?php _e('Selecionar todos', 'idreport'); ?></button>
									</div>
								</div>

							</fieldset>
						</form>
			            <div >
			                <ul id="infoConsulta"></ul>
			            </div>
					</div>
				</div>
			</div>
		</div>	<!--  fim Ignitiondeck -->

        <!-- Woocommerce  -->
		<div class="metabox-holder">
			<div class="meta-box-sortables" style="min-height:0;">
                
				<div class="postbox">
		          <div  class="alert-danger hidden" id="error">
		              <span > Desculpe, Algo deu errado. Recarregue a página e tente novamente </span> 
		          </div>
					<h3 class="hndle"><span><?php _e('Pedidos Woocommerce', 'idreport'); ?></span></h3>
					<div class="inside">
					<p><?php _e('Gere PDF dos endereços de envio de pedidos realizados por meio do Woocommerce 
					com status processing*, concluded* ', 'idreport'); ?>.</p>
						<form method="POST" action="" id="idreport" name="idreport">
							<fieldset>
								<div class="form-group select-field">
									<label for="project" class="col-lg-2 control-label">
										<?php _e('Selecione os pedidos', 'idreport'); ?>
									</label>
									</br>
										</br>
								</div>
	              				<div class="form-group select-field-pedidos2 hidden">
									<div class="col-lg-10">
										<select class="form-control" id="pedidoWoo" name="pedidoWoo" multiple="multiple" size=30 style='height: 200px; width: 15%;'>
	                  					
										</select>
									</div>
								</div>
	                            
								<div class="form-group submit">
									<label class="col-lg-2 control-label"></label>
									<div class="col-lg-10">
	  									<input type="submit" name="idreport-get-metadata" id="idreport-get-metadata2" value="<?php _e('Gerar PDF', 'idreport'); ?>" class="button-primary"/>
	  									<button type="button" id="idreport-get-all-metadata2"  class="button-primary"><?php _e('Selecionar todos', 'idreport'); ?></button>
									</div>
								</div>

							</fieldset>
						</form>
			            <div >
			                <ul id="infoConsulta"></ul>
			            </div>
					</div>
				</div>
			</div>
		</div>  
		<!-- fim woocommerce --> 


		<div class="metabox-holder">
			<div class="meta-box-sortables" style="min-height:0;">
				<div class="postbox">
		          <div  class="alert-danger hidden" id="error">
		              <span > Desculpe, Algo deu errado. Recarregue a página e tente novamente </span> 
		          </div>
					<h3 class="hndle"><span><?php _e('PDF de pedidos Ignitiondeck', 'idreport'); ?></span></h3>
					<div class="inside">
						<ul class="lista-arquivos">
						
						</ul>
					</div>
				</div>
			</div>
		</div>


		<div class="metabox-holder">
			<div class="meta-box-sortables" style="min-height:0;">
				<div class="postbox">
		          <div  class="alert-danger hidden" id="error">
		              <span > Desculpe, Algo deu errado. Recarregue a página e tente novamente </span> 
		          </div>
					<h3 class="hndle"><span><?php _e('PDF de pedidos Woocommerce', 'idreport'); ?></span></h3>
					<div class="inside">
						<ul class="lista-arquivos2">
						
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>		


	<!-- Begin Sidebar -->
	<div class="postbox-container" style="width:20%;">
		<div class="metabox-holder">
			<div class="meta-box-sortables" style="min-height:0;">
				<div class="postbox">
					<h3 class="hndle"><span>Donate</span></h3>
					<div class="inside">
						<div style="float: left; margin: 0 10px 25px 0;"></div>
						<p>
							Has this plugin helped you? </br> How about pay me a beer?
						</p>
						<p>
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="K4AAHW5Q3EQPA">
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
							</form>
						</p>
					</div>
			</div>
		</div>
	</div>
	<!-- End Sidebar -->


</div>
<script type="text/javascript">
    
	jQuery(document).ready(function() {
		jQuery("#idreport-get-all-metadata").prop('disabled', true);
		jQuery("#idreport-get-metadata").prop('disabled', true);


        
		var proj = jQuery("#project").val();
            
        /*
        * Busca lista de ID's de pedidos Woocommerce/IgnitionDeck
        */
		jQuery("#project").change(function() {
            //disable the button 
            jQuery(this).attr('disabled', 'disabled');
			proj = jQuery("#project").val();
			var title = jQuery("#project option[value='" + proj + "']").text();
			if (proj !== "") {
				jQuery.ajax({ 
                    url: "admin-ajax.php",
                    timeout:2500,
                    dataType:'text',
                    type:'POST',
					data: 'action=idre_id_reports_get_orders_processing&title='+title,
                    error: function(xml){
                        //disable the button 
                        jQuery("#error").show().delay(6000).hide();
                        jQuery(this).removeAttr('disabled');
                    },
					success: function(response) {
                        var listaOptions = '';
                        var result = response.split(",");
                        
						for(var i=0; i<result.length;i++){
                           listaOptions += '<option value='+result[i]+'>'+result[i]+'</li>';
                        }

                        jQuery('.select-field-pedidos').removeClass('hidden');
                        jQuery('#pedido').append(listaOptions);
                        jQuery("#project").removeAttr('disabled');
                        jQuery("#idreport-get-metadata").prop('disabled', false);
                        jQuery("#idreport-get-all-metadata").prop('disabled', false);
					}
				});

			}
			else {
				jQuery(this).prop('disabled', false);
				jQuery('.select-field-pedidos').addClass('hidden');
				jQuery("#idreport-get-metadata").prop('disabled', true);
                jQuery("#idreport-get-all-metadata").prop('disabled', true);
			}
		});
        
        
        
        /*
        * Busca endereço de pedidos selecionados Ignitiondeck
        */
		jQuery("#idreport-get-metadata").click(function(e) {
            e.preventDefault();
            var listaPedidos = jQuery("#pedido").val();
            if(listaPedidos !=""){
                jQuery.ajax({ 
                    url: "admin-ajax.php",
                    timeout:10000,
                    dataType:'text',
                    type:'POST',
					data: 'action=idre_id_reports_get_address_orders&pedidos='+listaPedidos,
                    error: function(xml){
                      
                    },
					success: function(response) {
						
					jQuery('.lista-arquivos').append('<li><a class="button-primary" href="'+response+'"> Click para Download </li>');
                    }
				});
            }
        });



        /*
        * Busca endereço de pedidos selecionados woocommerce 
        */
		jQuery("#idreport-get-metadata2").click(function(e) {
            e.preventDefault();
            var listaPedidos = jQuery("#pedidoWoo").val();
            if(listaPedidos !=""){
                jQuery.ajax({ 
                    url: "admin-ajax.php",
                    timeout:10000,
                    dataType:'text',
                    type:'POST',
					data: 'action=idre_get_all_address_orders&pedidoswoo='+listaPedidos,
                    error: function(xml){
                       
                    },
					success: function(response) {
						
					jQuery('.lista-arquivos2').append('<li><a class="button-primary" href="'+response+'"> Click para Download </li>');
                    }
				});
            }
        });


		/*
        * Seleciona todos os pedidos e cria pdf
        */
        jQuery("#idreport-get-all-metadata").on('click',function(){
        	jQuery('#pedido option').prop('selected', true);
        });


       	/*
        * Seleciona todos os pedidos e cria pdf de pedidos woocommerce
        */
        jQuery("#idreport-get-all-metadata2").on('click',function(){
        	jQuery('#pedidoWoo option').prop('selected', true);
        });

	});



	//Carrega os pedidos do Woocommerce automaticamente ao abrir a página
	jQuery( window ).load(function() {
  		// Run code
  		jQuery.ajax({ 
            url: "admin-ajax.php",
            timeout:5000,
            dataType:'text',
            type:'POST',
			data: 'action=idre_retrieve_all_orders',
            error: function(xml){
                //disable the button 
                jQuery("#error").show().delay(6000).hide();
                jQuery(this).removeAttr('disabled');
            },
			success: function(response) {
                var listaOptions = '';
                var result = response.split(",");
                
				for(var i=0; i<result.length;i++){
                   listaOptions += '<option value='+result[i]+'>'+result[i]+'</li>';
                }

                jQuery('.select-field-pedidos2').removeClass('hidden');
                jQuery('#pedidoWoo').append(listaOptions);
                jQuery("#projectWoo").removeAttr('disabled');
                jQuery("#idreport-get-metadata2").prop('disabled', false);
                jQuery("#idreport-get-all-metadata2").prop('disabled', false);
			}
		});

	});
</script>
