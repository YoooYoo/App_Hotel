<style>
              .calendar-legend {
              margin: 0 0 10px;
              text-align: center;
              }
              .calendar-legend .calendar-key {
              display: inline-block;
              line-height: 21px;
              height: 21px;
              width: 23px;
              position: relative;
              }
              .calendar-legend .available-key {
              background-color: #fff;
              }
              .calendar-legend .calendar-key-box {
              height: 21px;
              width: 23px;
              position: absolute;
              top: 4px;
              left: 0;
              border: 1px solid #dbdbdb;
              }
              .calendar-legend .calendar-key {
              display: inline-block;
              line-height: 21px;
              height: 21px;
              width: 23px;
              position: relative;
              }
              dt {
              font-weight: 700;
              }
              .calendar-legend .calendar-label {
              margin: 0 30px 0 5px;
              }
              .calendar-legend dt, .calendar-legend dd {
              display: inline-block;
              }
              .calendar-legend .blocked-key {
              background-color: rgba(204,204,204,0.9);
              text-decoration: line-through;
              }
              .today {
              background-color: rgba(0, 50, 245, 0.9);
              border-radius: 0px !important;
              color: #fff;
              padding: 3px;
              }
              .notavailable{
                background-color: rgba(204,204,204,0.9);
                text-decoration: line-through;
              }
            </style>
<div class="col-md-6">
              <div class="form-group">
                <dl class="calendar-legend">
                  <dt class="calendar-key"><span class="calendar-key-box available-key"></span></dt>
                  <dd class="calendar-label">Available</dd>
                  <dt class="calendar-key"><span class="calendar-key-box availability-key blocked-key"></span></dt>
                  <dd class="calendar-label">Unavailable</dd>
                </dl>
              </div>
            </div>
            <div class="clearfix"></div>
            <hr>
            <?php 
            $month = $initialmonth; 
            $finalmonth = $initialmonth + 6; 
            for($i=$initialmonth;$i<$finalmonth;$i++){              
             
           echo $calendar->frontgenerate($year,$month,$roomid); 
           $month++;
              if($month > 12){
                  $year += 1;
                  $month = 1;
              }
           } 

           ?>