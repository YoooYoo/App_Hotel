<h4 class="strong go-text-right"><i class="fa fa-bed text-warning go-right"></i> &nbsp; <?php echo trans('0372');?> &nbsp; </h4>
<nav class="panel well-sm">
  <form  action="" method="GET" role="search">
    <div class="col-md-2 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <label class="control-label go-right"><?php echo trans('07');?></label>
        <input type="text" placeholder="&#xf073; <?php echo trans('07');?>" name="checkin" class="form-control dpd1" value="<?php echo $hotelslib->checkin;?>" required>
      </div>
    </div>
    <div class="col-md-2 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <label class="control-label go-right"><?php echo trans('09');?></label>
        <input type="text" placeholder="&#xf073; <?php echo trans('09');?>" name="checkout" class="form-control dpd2" value="<?php echo $hotelslib->checkout;?>" required>
      </div>
    </div>
    <div class="col-md-2 col-lg-2 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <label class="control-label go-right"><?php echo trans('010');?></label>
        <select data-placeholder="<?php echo trans('010');?>" class="form-control" name="adults" required>
          <?php for($adults = 1; $adults < 11;$adults++){ ?>
          <option value="<?php echo $adults;?>" <?php if($adults == $hotelslib->adults){ echo "selected"; } ?> > <?php echo $adults;?> </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="hidden-md col-lg-2 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <label class="control-label go-right"><?php echo trans('011');?></label>
        <select data-placeholder="Children" class="form-control" name="child">
          <option value="0" selected>0</option>
          <?php for($child = 1; $child < 6;$child++){ ?>
          <option value="<?php echo $child;?>" <?php if($child == $hotelslib->children){ echo "selected"; } ?>> <?php echo $child;?> </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-3 col-lg-4 col-xs-12 col-sm-12">
      <div class="form-group">
        <label class="control-label">&nbsp;</label>
        <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-search"></i> <?php echo trans('0106');?></button>
      </div>
    </div>
  </form>
  <div class="clearfix"></div>
</nav>
<?php if(!empty($hotelslib->stayerror)){ ?>
<div class="alert alert-danger go-text-right">
  <?php echo trans("0420"); ?>
</div>
<?php } ?>
<table class="table table-bordered table-responsive RTL">
<?php if(!empty($rooms)){ ?>
  <thead>
    <tr>
      <th class="go-text-right"><?php echo trans('0246');?></th>
      <th style="width:100px" class="hidden-xs text-center"><?php echo trans('0373');?></th>
      <th style="width:100px" class="text-center"><?php echo trans('0374');?></th>
      <th style="width:180px" class="text-center"><?php echo trans('0375') ?> <span class="btn btn-success btn-xs"><?php echo $hotelslib->stay; ?></span> <?php echo trans('0122');?></th>
    </tr>
  </thead>
  <?php foreach($rooms as $r){ if($r->maxQuantity > 0){ ?>
  <tr class="featured">
  <form action="<?php echo base_url();?>hotels/book/<?php echo $hotel->slug;?>" method="GET">
      <input type="hidden" name="adults" value="<?php  echo $hotelslib->adults; ?>" />
      <input type="hidden" name="child" value="<?php  echo $hotelslib->children; ?>" />
      <input type="hidden" name="checkin" value="<?php  echo $hotelslib->checkin; ?>" />
      <input type="hidden" name="checkout" value="<?php  echo $hotelslib->checkout; ?>" />
      <input type="hidden" name="roomid" value="<?php echo $r->id; ?>" />
    <td>
      <div class="col-md-5 col-lg-3 row go-right">
        <a href="#"> <img src="<?php echo $r->thumbnail;?>" href="#" class="img-responsive fade-img"/></a>
      </div>
      <div class="col-md-7 col-lg-9">
        <p class="strong"><?php echo $r->title;?></p>
        <h5 class="hidden-xs" style="margin-bottom: 4px;"><?php echo character_limiter($r->desc,150); ?></h5>
        <div id="accordion">
          <button data-toggle="collapse" data-parent="#accordion" class="hidden-xs btn btn-warning btn-xs"  href="#details<?php echo $r->id;?>"><?php echo trans('052');?></button>
          <button data-toggle="collapse" data-parent="#accordion" href="#availability<?php echo $r->id;?>" class="hidden-xs btn btn-info btn-xs"><?php echo trans('0251');?></button>
         <?php if($r->extraBeds > 0){ ?> <button data-toggle="collapse" data-parent="#accordion" href="#EXTRABED<?php echo $r->id;?>" class="hidden-xs btn btn-danger btn-xs"><i class="fa fa-plus"></i> <?php echo trans('0428');?></button> <?php } ?>
        </div>
      </div>
      <div class="clearfix"></div>
      <div id="availability<?php echo $r->id;?>" class="panel-body panel-collapse collapse">
        <div class="panel panel-default">
          <div class="panel-body">
            
            <div class="col-md-6">
              <div class="form-group">
                <select id="<?php echo $r->id;?>" class="form-control form showcalendar">
                  <option value="0">Select Dates Range</option>
                  <option value="<?php echo $first;?>"> <?php echo $from1;?> - <?php echo $to1;?></option>
                  <option value="<?php echo $second;?>"> <?php echo $from2;?> - <?php echo $to2;?></option>
                  <option value="<?php echo $third;?>"> <?php echo $from3;?> - <?php echo $to3;?></option>
                  <option value="<?php echo $fourth;?>"> <?php echo $from4;?> - <?php echo $to4;?></option>
                </select>
              </div>
            </div>
            <div id="roomcalendar<?php echo $r->id;?>"></div>
          </div>
        </div>
      </div>
      <div id="details<?php echo $r->id;?>" class="panel-body panel-collapse collapse">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
            <?php foreach($r->Images as $Img){ ?>
              <div class="col-md-3"><img class="img-responsive" src="<?php echo $Img['thumbImage'];?>" alt="" /></div>
            <?php } ?>
            </div>
            <div class="clearfix"></div>
            <hr>
            <p><strong><?php echo trans('046');?> : </strong> <?php echo $r->desc;?></p>
            <hr>
            <p><strong><?php echo trans('055');?> : </strong></p>
            <?php foreach($r->Amenities as $roomAmenity){ if(!empty($roomAmenity['name'])){ ?>
            <div class="col-md-4">
              <ul class="checklist">
                <li><?php echo $roomAmenity['name'];?></li>
              </ul>
            </div>
            <?php } } ?>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div id="EXTRABED<?php echo $r->id;?>" class="panel-body panel-collapse collapse">
        <div class="panel panel-default">
          <div class="panel-body form-horizontal">

<?php if($r->extraBeds > 0){ ?>
  <div class="form-group">
    <label for="<?php echo trans('0428');?>" class="col-sm-2 control-label"><?php echo trans('0428');?></label>
    <div class="col-md-4">
     <select name="extrabeds" class="form-control form go-right" id="">
     <option value="0"><?php echo trans("0158"); ?></option>
     <?php for($i = 1; $i <= $r->extraBeds; $i++){ ?>
            <option value="<?php echo $i;?>"> <?php echo $i;?> (<?php echo $r->currCode." ".$r->currSymbol.$i * $r->extrabedCharges;?>) </option>
     <?php } ?>
            </select>
    </div>
  </div>
<?php } ?>


        </div>
      </div>
    </div>
    </td>
    <td class="hidden-xs" style="padding:35px 10px 0px 10px">
      <p><span class=""><?php echo trans('010');?></span> : <?php echo $r->Info['maxAdults'];?><br>
        <span class=""><?php echo trans('011');?></span> : <?php echo $r->Info['maxChild'];?>
      </p>
    </td>
      <td style="padding:35px 10px 0px 10px">
        <select class="selectx input-md" name="roomscount" >
        <?php for($q = 1; $q <= $r->maxQuantity; $q++){ ?>
          <option value="<?php echo $q;?>"><?php echo $q;?></option>
        <?php } ?>
        </select>
      </td>
      <td>
        <div class="text-center go-left">
          <span class="go-left">&nbsp; <?php echo $r->currCode;?> <?php echo $r->currSymbol; ?> &nbsp; </span> &nbsp; <span class="strong h3"><?php echo $r->price;?></span>
        </div>
        <div class="form-group">
          <button class="btn btn-success btn-block btn-lg chk"><?php echo trans('0142');?></button>
        </div>
      </td>
    </form>
  </tr>
  <?php } ?>
  <tr>
    <script>
      $('.collapse').on('show.bs.collapse', function () {
          $('.collapse.in').collapse('hide');
      });
    </script>
  </tr> <?php } }else{ echo trans("066"); }?>
</table>

<script>
   jQuery(document).ready(function($) {

   $('.showcalendar').on('change',function(){
      var roomid = $(this).prop('id');
      var monthdata = $(this).val(); 
     $("#roomcalendar"+roomid).html("<br><br><div id='rotatingDiv'></div>");
    $.post("<?php echo base_url();?>hotels/roomcalendar", { roomid: roomid, monthyear: monthdata}, function(theResponse){ console.log(theResponse);
    $("#roomcalendar"+roomid).html(theResponse);

    });


    });

   });

</script>