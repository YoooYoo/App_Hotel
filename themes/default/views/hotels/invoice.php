<style>
.panel { border: solid 1px #D6D6D6; box-shadow: none !important; }
 aside.sidebar-right { padding-left: 30px; border-left: 1px solid #d4d4d4; }
  #countdown span {
  color: #4A4A4A;
  font-size: 13px;
  margin-left: 2px;
  margin-right: 2px;
  text-align: center;
  }
  .btn-arrival {
  color: #FF3333;
  background-color: #FFFFFF;
  display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.428571429;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  background-image: none;
  border: 1px solid #FF3333;
  border-radius: 4px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
  }
  .btn-arrival:hover,
  .btn-arrival:focus,
  .btn-arrival:active,
  .btn-arrival.active,
  .open .dropdown-toggle.btn-arrival {
  color: #FFFFFF;
  background-color: #FF3333;
  border-color: #FF3333;
  }
  .btn-arrival:active,
  .btn-arrival.active,
  .open .dropdown-toggle.btn-arrival {
  background-image: none;
  }
  .btn-arrival.disabled,
  .btn-arrival[disabled],
  fieldset[disabled] .btn-arrival,
  .btn-arrival.disabled:hover,
  .btn-arrival[disabled]:hover,
  fieldset[disabled] .btn-arrival:hover,
  .btn-arrival.disabled:focus,
  .btn-arrival[disabled]:focus,
  fieldset[disabled] .btn-arrival:focus,
  .btn-arrival.disabled:active,
  .btn-arrival[disabled]:active,
  fieldset[disabled] .btn-arrival:active,
  .btn-arrival.disabled.active,
  .btn-arrival[disabled].active,
  fieldset[disabled] .btn-arrival.active {
  background-color: #FFFFFF;
  border-color: #175BD1;
  }
  .btn-arrival .badge {
  color: #FFFFFF;
  background-color: #1E65DD;
  }
</style>


  <div class="clearfix"></div>

      <div class="panel panel-default  hidden-xs">
      <div class="panel-heading  hidden-xs">

        <span><strong><?php echo trans('076');?> <?php echo trans('08');?> </strong>: <?php echo $invoice->bookingDate;?></span>
        <span><strong><?php echo trans('079');?> </strong>: <?php echo $invoice->expiry;?></span>

      </div>
      <div class="panel-body hidden-xs">
        <div class="row">
          <div class="col-md-2">
            <img class="img-responsive" src="<?php echo $invoice->thumbnail;?>" alt="" />
          </div>
          <div class="col-md-10">
            <p class="strong"> <?php echo $invoice->title;?></p>
            <p> <?php echo $invoice->location;?> </p>
            <h5><?php echo $invoice->stars;?></h5>
          </div>

        </div>

      </div>
      </div>




      <div class="panel panel-default  hidden-xs">
      <div class="panel-heading  hidden-xs">

         <strong><?php echo trans('076');?> <?php echo trans('0434');?></strong> : <span class="weak"> <?php echo $invoice->id; ?> </span> <strong><?php echo trans('0398');?></strong> <?php echo $invoice->code; ?>
      </div>

      </div>

      <div class="col-md-8 hidden-xs">

       <p><strong><?php echo trans('07');?> : </strong> <?php echo $invoice->checkin; ?> <strong><?php echo trans('09');?> : </strong> <?php echo $invoice->checkout; ?> </p>
        <p><span class="strong"> <?php echo trans('0435');?> </span> : <?php echo $invoice->subItem->title;?> </span> <span class="text-primary strong"><?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->price;?></span><br>
        <span class="strong"> <?php echo trans('0123');?> ( <?php echo $invoice->subItem->quantity;?> )   </span> <span class="text-primary strong"><?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->total;?></span><br>
        <?php if($invoice->extraBeds > 0){ ?>
        <span class="strong"> <?php echo trans('0428');?> ( <?php echo $invoice->extraBeds; ?> )</span> <span class="text-primary strong"><?php echo $invoice->currSymbol; ?><?php echo $invoice->extraBedsCharges; ?></span><br>
        <?php } ?>
        <strong><?php echo trans('0122');?> ( <?php echo $invoice->nights;?> )</strong> <span class="text-primary strong"><?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->totalNightsPrice;?>
        </p>

      </div>
      <div class="col-md-4">
      <aside class="sidebar-right">
         <p>
      <strong><?php echo trans('0153');?> </strong> : <?php echo $invoice->currSymbol; ?><?php echo $invoice->tax;?></p>
      <h3 style="margin:0px"><strong><?php echo trans('0124');?> </strong> : <?php echo $invoice->currSymbol; ?><?php echo $invoice->checkoutTotal;?></h3>
      <span style="color:#d4d4d4" >--------------------------------------- </span>
      <br>
      <strong class="text-success"><?php echo trans('0126');?> </strong> : <?php echo $invoice->currSymbol; ?><?php echo $invoice->checkoutAmount; ?>
    </aside>
    </div>

      <div class="clearfix"></div>




 <!-- /.modal-content -->
