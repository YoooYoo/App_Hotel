 <div class="clearfix"></div>
  <div class="mt40"></div>

   <div class="panel panel-default">
     <div class="panel-heading"><h4><?php echo character_limiter($tourslib->title, 25);?></h4></div>
     <div class="panel-body">

      <span class="h4 star"><?php if($details[0]->tour_stars > 0){ for($stars=1;$stars <= $details[0]->tour_stars;$stars++){ ?> <i class="star fa fa-star"></i><?php } } ?></span>

  <p class="text-small"><i class="fa fa-map-marker"></i> City Name</p>
  <ul class="list list-inline text-small">
    <li><a href="mailto:#"><i class="fa fa-envelope"></i> <?php echo trans('0392');?></a></li>
    <li><a href="#"><i class="fa fa-home"></i> <?php echo trans('0393');?></a></li>
    <li><i class="fa fa-phone"></i> <a href="tel:123456"> 123456</a></li>
  </ul>

  <div class="bs-example">
      <table class="table form-horizontal">
        <thead>
          <tr>
            <th></th>
            <th>No.</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Adults</th>
            <td><select name="" class="form-control"id="">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            </select></td>
            <td>$200</td>
          </tr>
          <tr>
            <th scope="row">Students</th>
            <td><select name="" class="form-control"id="">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            </select></td>
            <td>$150</td>
          </tr>
          <tr>
            <th scope="row">Childrens ( 2 - 11)</th>
            <td><select name="" class="form-control"id="">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            </select></td>
            <td>$100</td>
          </tr>
          <tr>
            <th scope="row">Infant ( 0 - 1 )</th>
            <td><select name="" class="form-control"id="">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            </select></td>
            <td>$50</td>
          </tr>        </tbody>
      </table>
    </div>

  <div class="row">
       <div class="alert-message alert-message-warning">
                   <div class="col-xs-12 col-md-12"><button data-toggle="modal" data-target="#read-reviews" class="btn btn-block btn-action"><?php echo trans('0142');?></button></div>
        <div class="clearfix"></div></div>



            </div>

  </div>
  </div>