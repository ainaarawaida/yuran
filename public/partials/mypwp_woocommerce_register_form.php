<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label for="typeReg"><?php esc_html_e( 'Type Registration', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
    <select name="typeReg" id="typeReg" class="form-control woocommerce-Input woocommerce-Input--select input-select" required>
        <option value="ahli">Daftar Ahli</option>
        <option value="pentadbir">Daftar Pentadbir</option>
    </select>

</p>


<?php 
global $wpdb ;

$groupId = $wpdb->get_results( 
    $wpdb->prepare("SELECT ID,post_name,post_title FROM {$wpdb->prefix}posts WHERE post_type =%s", array('mypwp_page_name')) 
 );

?>

<p id="p_groupId" class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label for="groupId"><?php esc_html_e( 'Group Name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
    <select name="groupId" id="groupId" class="form-control woocommerce-Input woocommerce-Input--select input-select" required>
        <option></option>
        <?php foreach($groupId AS $key => $val ) { ?>
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


            let ele = document.querySelector("#typeReg") ;
          
            if(ele.value == 'ahli'){
                    document.querySelector("#p_groupId").style.display = 'block' ;
                    document.querySelector("#groupId").setAttribute('required','');
                    // document.querySelector("#p_groupId").required = true ;
                   }else{
                
                    document.querySelector("#p_groupId").style.display = 'none' ;
                    document.querySelector("#groupId").removeAttribute('required');
                    // document.querySelector("#p_groupId").required = false ;
                   }


            ele.addEventListener("change", function(e){
                   if(e.target.value == 'ahli'){
                    document.querySelector("#p_groupId").style.display = 'block' ;
                    document.querySelector("#groupId").setAttribute('required','');
                    // document.querySelector("#p_groupId").required = true ;
                   }else{
                    document.querySelector("#p_groupId").style.display = 'none' ;
                    document.querySelector("#groupId").removeAttribute('required');
                    // document.querySelector("#p_groupId").required = false ;
                   }
                   
                  
                
                
            });

         
           
        
    });


$( '#groupId' ).select2( {
    theme: 'bootstrap-5'
} );
</script>
