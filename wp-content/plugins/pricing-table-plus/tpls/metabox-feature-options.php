<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/pricing-table-plus/css/admin/my.css"> 
 <script>
 jQuery('body').on('click', '.deleterow', function() {   //alert(val);
    if(confirm("Are you sure you want to delete?")){
            
            jQuery("."+jQuery(this).attr('rel')).slideUp(function(){jQuery(this).remove();});
         
    }
 });
 jQuery('body').on('click', '.deletecol', function() {   //alert(val);
    if(confirm("Are you sure you want to delete?")){
            
            jQuery("."+jQuery(this).attr('rel')).remove();
         
    }
 });
 
 jQuery('body').on('click', '.featured-package', function() {   //alert(val);
    var fid=jQuery(this).attr("id");
    var iv = jQuery(this).attr('src'); //,"<?php echo plugins_url(); ?>/pricing-table-plus/images/featured.png");
    jQuery('.featured-package').attr('src','<?php echo plugins_url(); ?>/pricing-table-plus/images/unfeatured.png')
    if(iv=='<?php echo plugins_url(); ?>/pricing-table-plus/images/unfeatured.png') {
    jQuery(this).attr('src',"<?php echo plugins_url(); ?>/pricing-table-plus/images/featured.png");
    jQuery('#featured').val(jQuery(this).attr("rel"));
    }
 });
 
 </script>
 
<?php
    $data = get_post_meta($post->ID, 'pricing_table_opt',true);  
    $featured=  get_post_meta($post->ID, 'pricing_table_opt_feature',true);  
     
     
?>

<div style="width: 100%;float:left;margin-right: 25px;">
<style type="text/css">
#pricetable tr:first-child td img{
    margin-top: 5px;
}
#pricetable tr:first-child td{
    line-height: 30px;
    cursor: move;
    vertical-align: middle;
}
#pricetable td{
    border-left:1px solid #ffffff;
    border-right:1px solid #dddddd;
}
.dndr *{
    color: #fff;
}
.dndr{
    background: #444444;
    color: #fff;
}
</style>    
        
        <br>
          
        <br>
        <span style="padding: 5px 0 5px 0;">&nbsp;</span>
 <table>
 <tr><td></td><td><a style="float: right;" href="#" class="button" id="addcolumn"><?php echo __('Add Package','pricing-table-plus'); ?></a> </td></tr>
 <tr><td>
 <table class="draggable widefat" id="pricetable" border="0" width="100%" cellspacing="0" cellpadding="0" >       
   <tr class="nodrag nodrop">
      <td >
        <?php echo __('Packages/Features','pricing-table-plus'); ?>
      </td>  
      <input type="hidden" id="featured" name="featured" value="<?php echo $featured;?>">   
      <?php  
    $pkeys=@array_keys($data);//print_r($keys); 
    $cnt=count($pkeys);
    if($cnt > 0 ){
        $imgc=0;
    foreach($pkeys as $index=> $value){ 
        $imgc++;
        if($featured==$value)$fimg="featured.png";else $fimg="unfeatured.png";
        //echo  $fimg;
        
        $package_key=str_replace(" ","",$value);
        echo  '<td class="'.$package_key.'"><div class="deletecol" rel="'.$package_key.'" title="Delete this column" >&nbsp;</div><strong>
        '.$value.'
        </strong> <img rel="'.$value.'" style="cursor:pointer;float:right" id="f'.$imgc.'" class="featured-package" title="click here to feature or unfeatue" src="'. plugins_url().'/pricing-table-plus/images/'.$fimg.'">
      </td>';
    }
    }
?>
   </tr>    
<?php
	$fkeys = array();
	if( is_array($data) && is_array($pkeys) && isset($pkeys[0]) && isset($data[$pkeys[0]])) {
		$fkeys = @array_keys($data[$pkeys[0]]);
	}
	//$cnt=count($data[$pkeys[0]]);
	if( count($fkeys) ) { 
		foreach( $fkeys as $index1=> $value1){
			$feature_key = str_replace(" ","",$value1);
			if(in_array($value1,array('Price','Detail','Button URL','Button Text'))) $cls = "nodrag nodrop";
			else $cls = "";
			echo "<tr class='{$value1} $cls'>";
			$t=0;
			foreach($pkeys as $index=> $value){
				$package_key=str_replace(" ","",$value);
				$t++;
				if($t==1){
					echo "<td  class='".$feature_key."'>";
					if($value1 != "Price" && $value1!="Detail" && $value1!="Button URL" && $value1!="Button Text" ){
						echo "<div class='deleterow' rel='{$feature_key}' title='Delete this row'>&nbsp;</div>";
						echo "<div class='moverow' rel='{$feature_key}'>&nbsp;</div>"; }
					else   
						echo "<div class='lockedrow' rel='{$feature_key}'>&nbsp;</div>"; 
					echo "<strong>".$value1."</strong></td>";
				}
				echo  '<td class="'.$package_key.' '.$feature_key.'"><input type="text"  id="features['.$value.']['.$value1.']" name="features['.$value.']['.$value1.'] " value="'
				.htmlspecialchars($data[$value][$value1]).'" >
				
			  </td>';
			}
			echo "</tr>";  
		}
    } else {
        ?>
        <tr class="nodrag nodrop">
      <td class="Price">
        <strong><?php echo __('Price','pricing-table-plus'); ?></strong>
      </td>
      </tr>
      <tr class="nodrag nodrop">
      <td class="Detail">
        <strong><?php echo __('Detail','pricing-table-plus'); ?></strong>
      </td>
      </tr>
      <tr class="nodrag nodrop">
      <td class="Button URL ">
         <strong><?php echo __('Button URL','pricing-table-plus'); ?></strong>
      </td>
      </tr>
      <tr class="nodrag nodrop">
      <td class="Button Text">
         <strong><?php echo __('Button Text','pricing-table-plus'); ?></strong>
      </td>
      </tr>
        <?php
        
    }
?>
   
</table></td><td></td></tr>
 <tr><td><a href="#" class="button" id="addrow"><?php echo __('Add Feature','pricing-table-plus'); ?></a>  </td><td></td></tr>
 </table>       


     <script language="JavaScript">
      function trim(str) {
        return str.replace(/^\s+|\s+$/g,"");
    }


    jQuery(function(){
      
        //jQuery('#pricetable').tableDnD({onDragClass: "dndr",dragHandle: ".moverow"});  
        jQuery('#pricetable tbody').sortable({items: "tr:not(.nodrop)"});  
        
        
      jQuery('#addrow').click(function(){
          
          var feat;
          feat=prompt("Enter Feature");   //alert(feat); 
          feat=trim(feat);  
          while(feat.length==0 ){
               feat=prompt("Enter Feature");
               feat=trim(feat);    
          }
          
          
           jQuery('#pricetable tbody tr:last').clone(true).insertAfter('#pricetable tbody>tr:last');
           jQuery('#pricetable tbody tr:last td:first').text(feat);
            jQuery('#pricetable tbody tr:last td:first').append("<div class='deleterow' title='Delete this row'>&nbsp;</div><div class='moverow' title='Delete this row'>&nbsp;</div>");
           jQuery('#pricetable tbody tr:last td:first').attr("class",feat);
           jQuery('#pricetable tbody tr:last').attr("class",feat);
           jQuery('#pricetable tbody tr:last td:first .deleterow').attr("rel",feat);
           
           var ht="";
           
           jQuery("#pricetable tbody tr:last").find("td").each(function() {
               
               
               var ccl,pos1;
               var nclassname="";
               ccl=jQuery(this).attr("class");
               ccl=trim(new String(ccl));
               
               pos1= ccl.indexOf(" ");
               
               if(pos1 != -1){
                  nclassname=ccl.substr(0,pos1+1); 
                  
                  
               }
               nclassname += feat;
               
               jQuery(this).attr("class",nclassname);
               ht= jQuery(this).find('input').attr('name');
               ht=new String(ht); 
               if(ht != "undefined"){
                   var pos= ht.indexOf("]");
                   var cnam=ht.substr(0,pos+1);
                   var nnam=cnam+"["+feat+"]";
                   jQuery(this).find('input').attr("name",nnam);
                   jQuery(this).find('input').attr("id",nnam);
                   
               } 
               
           });

           jQuery('#pricetable tbody tr:last td:first').css("font-weight","bold"); 
           });
     
     
      jQuery('#addcolumn').click(function(){
           var cid = 1;
          //check whether any features exists or not. if no feature then create feature first
          //alert(jQuery('#pricetable tbody tr:last td:first').html());
          if(trim(jQuery('#pricetable tbody tr:last td:first').html())=="Packages/Features"){
              alert("Create Features first");
          }else{
              var package=prompt("Enter Package");
              package=trim(package); 
              while(package.length==0 ){
                   package=prompt("Enter Package");
                   package=trim(package);    
              }
               var htm;  
              jQuery("#pricetable").find("tr").each(function() {
                  //alert(jQuery(this).find('td:first').html());
              
               var rw="";
               rw= trim(jQuery(this).find('td:first').text());
               
               htm="features["+package+"]["+rw+"]"; 
               jQuery(this).find('td:last').after( '<td > &nbsp;</td>' ); 
               jQuery(this).find('td:last').addClass(package + " "+ rw.replace(" ",""));
               if(trim(jQuery(this).find('td:first').html())!="Packages/Features"){                          
                    jQuery(this).find('td:last').append('<input id="'+cid+'" name="'+htm+'" type="text" >');                   
                    
                     cid++;
               }         
               });
                
               jQuery('#pricetable tbody tr:first td:last').text(package);
               jQuery('#pricetable tbody tr:first td:last').append("<div class='deletecol' rel='"+package+"' title='Delete this row'>&nbsp;</div>");
               jQuery('#pricetable tbody tr:first td:last').append('<img rel="'+package+'" style="cursor:pointer;float:right" id="f" class="featured-package" title="click here to feature" src="<?php echo plugins_url();?>/pricing-table-plus/images/unfeatured.png" >');  
               jQuery('#pricetable tbody tr:first td:last').css("font-weight","bold");
               jQuery('#pricetable tbody tr:first td:last').attr("class",package);
          }
    });
      });
    
    </script>
    <br clear="all"> 
    <br clear="all">
    <b>Tip for using tooltip:</b><br/>
    When you adding feature value, if you want to add tooltip text, just separate it using vertical bar (|) as you seeing in following image:<br/>
    <img alt="" src="<?php echo plugins_url('pricing-table-plus/images/tooltip.png'); ?>" />        
    <br/>    
    <b>Hiding "Price" and "Detail" from front-end:</b><br/>
    Simply don't add any value for price and detail:<br/>
    <img alt="" src="<?php echo plugins_url('pricing-table-plus/images/hide-price-detail.png'); ?>" />     
    <br clear="all">              
    <br clear="all">             
    </div>
    
    <br clear="all">
    <div style="border:3px solid #008000;padding:10px;font-weight: 900;text-align: center">
        <a href="http://wordpress.org/support/view/plugin-reviews/pricing-table-plus?rate=5#postform" style="text-decoration: none !important;">A 5* rating will encourage me a lot. Please consider it, if you get some free secs :)</a>
    </div>
