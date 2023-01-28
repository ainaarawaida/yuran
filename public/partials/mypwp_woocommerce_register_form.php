<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label for="type_reg"><?php esc_html_e( 'Type Registration', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
    <select name="type_reg" id="type_reg" class="form-control woocommerce-Input woocommerce-Input--select input-select" required>
        <option value="ahli">Daftar Ahli</option>
        <option value="pentadbir">Daftar Pentadbir</option>
    </select>

</p>


<?php 
global $wpdb ;

$group_id = $wpdb->get_results( 
    $wpdb->prepare("SELECT ID,post_name,post_title FROM {$wpdb->prefix}posts WHERE post_type =%s", array('mypwp_page_name')) 
 );

?>

<p id="p_group_id" class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label for="group_id"><?php esc_html_e( 'Group Name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
    <select name="group_id" id="group_id" class="form-control woocommerce-Input woocommerce-Input--select input-select" required>
        <option></option>
        <?php foreach($group_id AS $key => $val ) { ?>
        <option value="<?php echo $val->ID ; ?>"><?php echo ($val->post_title) ; ?> </option>
      
        <?php } ?> 
    </select>

</p>

<!-- Styles -->
<link rel="stylesheet" type="text/css" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/select2.css">


<!-- Scripts -->
<script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/select2/select2.full.min.js"></script>
    <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/select2/select2-custom.js"></script>

<script>


document.addEventListener("DOMContentLoaded", function(){

            let ele2 = document.querySelectorAll("input.woocommerce-Input") ;
            // console.log(ele);
            for(let i = 0 ; i < ele2.length ; i++){
                ele2[i].classList.add('form-control');
            }


            let ele = document.querySelector("#type_reg") ;
          
            if(ele.value == 'ahli'){
                    document.querySelector("#p_group_id").style.display = 'block' ;
                    document.querySelector("#group_id").setAttribute('required','');
                    // document.querySelector("#p_group_id").required = true ;
                   }else{
                
                    document.querySelector("#p_group_id").style.display = 'none' ;
                    document.querySelector("#group_id").removeAttribute('required');
                    // document.querySelector("#p_group_id").required = false ;
                   }


            ele.addEventListener("change", function(e){
                   if(e.target.value == 'ahli'){
                    document.querySelector("#p_group_id").style.display = 'block' ;
                    document.querySelector("#group_id").setAttribute('required','');
                    // document.querySelector("#p_group_id").required = true ;
                   }else{
                    document.querySelector("#p_group_id").style.display = 'none' ;
                    document.querySelector("#group_id").removeAttribute('required');
                    // document.querySelector("#p_group_id").required = false ;
                   }
                   
                  
                
                
            });

         
           
        
    });


$( '#group_id' ).select2( {
    theme: 'bootstrap-5'
} );
</script>
