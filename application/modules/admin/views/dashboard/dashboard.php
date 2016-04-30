<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3 class="page-title"><?php echo trans('01');?></h3>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <!-- BEGIN ICON BUTTONS SET-->
    <div class="btn-icon col-xs-6 col-sm-6 col-md-2">
      <form action="<?php echo base_url().$this->uri->segment(1); ?>/quickbooking/" method="post">
        <button type="submit" class="btn btn-danger">
          <i class="fa fa-dashboard fa-lg"></i>
          <div class="h5">Quick Booking</div>
        </button>
      </form>
    </div>
    <div class="btn-icon col-xs-6 col-sm-6 col-md-2">
      <form action="<?php echo base_url().$this->uri->segment(1); ?>/bookings/" method="post">
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-bar-chart-o fa-lg"></i>
          <div class="h5">Bookings</div>
        </button>
      </form>
    </div>
   <?php if($isadmin){ ?>
    <div class="btn-icon col-xs-6 col-sm-6 col-md-2">
    <form action="<?php echo base_url(); ?>admin/cms/" method="post">
        <button type="submit" class="btn btn-info">
          <i class="fa fa-list-alt fa-lg"></i>
          <div class="h5">CMS Pages</div>
        </button>
      </form>
    </div>
    <div class="btn-icon col-xs-6 col-sm-6 col-md-2">
     <form action="<?php echo base_url(); ?>admin/blog/" method="post">
        <button type="submit" class="btn btn-success">
          <i class="glyphicon glyphicon-th-large fa-lg"></i>
          <div class="h5">Blog</div>
        </button>
      </form>
    </div>
    <div class="btn-icon col-xs-6 col-sm-6 col-md-2">
      <form action="<?php echo base_url(); ?>admin/newsletter/" method="post">
        <button type="submit" role="button" class="btn btn-warning">
          <i class="fa fa-envelope fa-lg"></i>
          <div class="h5">Send Newsletter</div>
        </button>
      </form>
    </div>
    <div class="btn-icon col-xs-6 col-sm-6 col-md-2">
      <form action="<?php echo base_url(); ?>admin/backup/" method="post">
        <button type="submit" role="button" class="btn btn-default">
          <i class="fa fa-inbox fa-lg"></i>
          <div class="h5">Backup Databse</div>
        </button>
      </form>
    </div>
    <?php } ?>
    <!-- END ICON BUTTONS SET-->
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php if(!empty($isadmin)){ ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><span class="fa fa-bar-chart-o"></span> Visit Statistics of <?php echo date('F', time()); ?></h3>
        </div>
        <div class="panel-body">
          <?php
            $totaldays = count($visits);

            $arr = array();
            $maxhits = array();

               foreach($visits as $v){
              if(empty($v)){
                   $arr[] = 0;
                 }
                 foreach($v as $vsub){
                  $arr[] = $vsub;
                 }
                 }

               foreach($arr as $aaa){
              if(!empty($aaa)){

              $maxhits[] = $aaa->hitscount;
              }

            } ?>
          <br>
          <!-- <canvas id="canvasbar" height="237" width="750"></canvas>-->
          <div id="resgraph" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<!-- Charts -->
<script src="<?php echo base_url(); ?>assets/include/highcharts/highcharts.js"></script>
<!-- Charts -->
<script type="text/javascript">
  $(function () {



          $('#resgraph').highcharts({
                  chart: {
              type: 'column',
               zoomType: 'x'
          },
          title: {
              text: ''
          },
          xAxis: {
            title: {
                  text: "<?php echo date('F', time()); ?>"
              },
            categories: [<?php for($day =1;$day <= $totaldays;$day++){echo $day.","; }?>]
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Visits'
              },
              stackLabels: {
                  enabled: true,
                  style: {
                      fontWeight: 'bold',
                      color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                  }
              }
          },
          legend: {
              align: 'right',
              x: -70,
              verticalAlign: 'top',
              y: 20,
              floating: true,
              backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
              borderColor: '#CCC',
              borderWidth: 1,
              shadow: false
          },
          tooltip: {
              formatter: function () {
                  return '<b>' + this.x + '</b><br/>' +
                      this.series.name + ': ' + this.y + '<br/>' +
                      'Total: ' + this.point.stackTotal;
              }
          },
          plotOptions: {
              column: {
                  stacking: 'normal',
                  dataLabels: {
                      enabled: false,
                      color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                      style: {
                          textShadow: '0 0 3px black, 0 0 3px black'
                      }
                  }
              }
          },
          series: [{
              name: 'Unique',
              data: [<?php       foreach($arr as $aaa){
    if(!empty($aaa)){

    echo $aaa->visitscount.",";
    }else{
      echo "0,";
    }

    } ?>],
       stack: 'male'
          }, {
              name: 'Total Hits',
              data: [<?php       foreach($arr as $aaa){
    if(!empty($aaa)){

    echo $aaa->hitscount - $aaa->visitscount.",";
    }else{
      echo "0,";
    }

    } ?>],
      stack: 'female'
          }]
          });
      });


</script>