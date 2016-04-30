 <?php  if(pt_main_module_available('tours')){ ?>


<form method="GET" action="<?php echo base_url();?>tours/search">
                  <div class="col-md-6" style="margin-bottom:0px">

                      <h4 style="margin-top: 0px;"><?php echo trans('0218');?></h4>
                      <select name="ocity" class="chosen-select" id="" required>
                      <option value=""> Select</option>
                    <?php $ocities = pt_origin_cities();
                    foreach($ocities as $oc){
                    ?>
                    <option value="<?php echo $oc->city_id;?>" > <?php echo $oc->city_name;?></option>
                    <?php } ?>
                      </select>
                  </div>

                  <div class="col-md-6"  style="margin-bottom:0px">
                   <div class="form-group">
                                       <?php $ttypes = pt_get_tsettings_data("ttypes"); if(!empty($ttypes)){ ?>

                      <p><?php echo trans('0222');?></p>
                      <select class="chosen-select" name="type" >
<option value=""> Select</option>
<?php @$vartype = $_GET['type'];
if(empty($vartype)){
$vartype = array();
}
foreach($ttypes as $ttype){
?>
<option value="<?php echo $ttype->sett_id;?>" <?php  if($ttype->sett_id == $vartype){ echo "selected";} ?> ><?php echo $ttype->sett_name;?></option>
<?php } ?>
</select>

<?php } ?>
                    </div>

                  </div>

                  <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4"><p><?php echo trans('0225');?></p>
                    <input type="text" class="form-control checkinsearch empty" name="start" id="tchkin" placeholder="&#xf073; <?php echo trans('08');?>">
                  </div>

                    <div class="form-group col-xs-6 col-sm-4 col-md-6 col-lg-2">
                    <p><?php echo trans('010');?></p>
                    <select style="witdh:100px" name="adults" class="form-control">
                     <?php $maxadults = pt_max_adults();
                         for($adults = 1;$adults <= $maxadults; $adults++){
                     ?>
                      <option value="<?php echo $adults?>"><?php echo $adults?></option>
                   <?php } ?>
                    </select>
                  </div>


                  <div class="col-md-6">
                  <p>&nbsp;</p>
                    <button style="top:15px;" type="submit" id="searchform" class="<?php echo main_search_btn; ?>"><i class="fa fa-search"></i> <?php echo trans('012');?></button>
                  </div>
                </form>


         <?php } ?>