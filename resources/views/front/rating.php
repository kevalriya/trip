 <?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   require_once 'LSession.php';
   

$routeid=trim(strip_tags($_POST['route']));

$DBRating=$DBUSER->userRouteRating($routeid,$userId);
if(count($DBRating) > 0 ){
    $prating=0;
    $cls='ratingz-review';
    $disb='disabled';
}
else{
  $prating=1;
  $cls='submit-review';
  $disb='';

}
?> 
<div class="row">
  <div class="col-md-12">
      <div class="form-group">
        <input type="hidden"  id="router" value="<?php echo $routeid ?>">
        <input type="hidden" name="ratingm" id="ratingm">
        <input type="hidden"  id="ratingread" value="<?php echo $prating ?>">
           <select class='rating' id='rating_<?php echo $routeid; ?>' data-id='rating_<?php echo $routeid; ?>'>
                                <option value="" ></option>
                                <?php 
                                for($i=1;$i<=5;$i++){
                                  if($DBRating['rating'] == $i){
                                    $sel='selected';
                                  }
                                  else{
                                    $sel='';
                                  }
                                ?>
                                <option value="<?php echo $i ?>" <?php echo $sel ?> ><?php echo $i ?></option>
                                <?php } ?>
                            </select>

                             
                            <!-- Set rating -->
                            <script type='text/javascript'>
                            $(document).ready(function(){
                                $('#rating_<?php echo $routeid; ?>').barrating('set',<?php echo $routeid; ?>);
                            });
                            
                            </script>
         </div> 
    </div>

    <div class="col-md-12">
    <div class="form-group ">
  <label for="exampleFormControlTextarea4">Review</label>
  <textarea class="form-control" id="reviewtxt" rows="3" <?php echo $disb ?>><?php echo (!empty($DBRating['review'])) ? strip_tags(trim($DBRating['review'])) : '' ?></textarea>
</div>

    </div>
<div class="col-md-12">
  <button class="btn btn-primary submit-review" <?php echo $disb ?>>Submit</button>
</div>
<?php }
  else{
    echo "<h3>Direct Not Allowed </h3>";
  }
 ?>
