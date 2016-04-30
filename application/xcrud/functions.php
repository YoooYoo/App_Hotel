<?php
function publish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE base_fields SET `bool` = b\'1\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function unpublish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE base_fields SET `bool` = b\'0\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function exception_example($postdata, $primary, $xcrud)
{
    // get random field from $postdata
    $postdata_prepared = array_keys($postdata->to_array());
    shuffle($postdata_prepared);
    $random_field = array_shift($postdata_prepared);
    // set error message
    $xcrud->set_exception($random_field, 'This is a test error', 'error');
}

function test_column_callback($value, $fieldname, $primary, $row, $xcrud)
{
    return $value . ' - nice!';
}

function after_upload_example($field, $file_name, $file_path, $params, $xcrud)
{
    $ext = trim(strtolower(strrchr($file_name, '.')), '.');
    if ($ext != 'pdf' && $field == 'uploads.simple_upload')
    {
        unlink($file_path);
        $xcrud->set_exception('simple_upload', 'This is not PDF', 'error');
    }
}


function show_description($value, $fieldname, $primary_key, $row, $xcrud)
{
    $result = '';
    if ($value == '1')
    {
        $result = '<i class="fa fa-check" />' . 'OK';
    }
    elseif ($value == '2')
    {
        $result = '<i class="fa fa-circle-o" />' . 'Pending';
    }
    return $result;
}

function custom_field($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<input type="text" readonly class="xcrud-input" name="' . $xcrud->fieldname_encode($fieldname) . '" value="' . $value .
        '" />';
}
function unset_val($postdata)
{
    $postdata->del('Paid');
}

function format_phone($new_phone)
{
    $new_phone = preg_replace("/[^0-9]/", "", $new_phone);

    if (strlen($new_phone) == 7)
        return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $new_phone);
    elseif (strlen($new_phone) == 10)
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $new_phone);
    else
        return $new_phone;
}

function before_list_example($list, $xcrud)
{
    var_dump($list);
}

function create_status_icon($value, $fieldname, $primary_key, $row, $xcrud)
{
  if($value == "Yes" || $value == "yes"){
    return '<i class="fa fa-check text-success"></i>';
  }else{
   return '<i class="fa fa-times text-danger"></i>';
  }

}

function long_date_fmt($value, $fieldname, $primary_key, $row, $xcrud)
{
    if(!empty($value)){
      return date("F j Y, h:i a",$value);
    }else{
       return "";
    }


}

function fmtDate($value, $fieldname, $primary_key, $row, $xcrud)
{
    if(!empty($value)){
      return pt_show_date_php($value);
    }else{
       return "";
    }


}

function create_stars($value, $fieldname, $primary_key, $row, $xcrud) {
    $res = "";
    for ($stars = 1; $stars <= $value; $stars++) {
    $res .= "<i class='star fa fa-star'></i>";
    }
    return $res;
}

function feature_stars($value, $fieldname, $primary_key, $row, $xcrud){
   $url = base_url()."admin/hotelajaxcalls/update_featured";
  if($value == "yes"){
    return '<span class="star fa fa-star fstar"  data-url='.$url.' style="cursor: pointer;" data-featured="no" id="'.$primary_key.'"></span>';
  }else{
    return '<span class="fa fa-star-o fstar"  data-url='.$url.' style="cursor: pointer;" data-featured="yes" id="'.$primary_key.'" ></span>';
  }

}

function hotelGallery($value, $fieldname, $primary_key, $row, $xcrud){
  $photocounts =  pt_HotelPhotosCount($primary_key);
  return "<a href=".base_url()."admin/hotels/gallery/".$value.">Upload (".$photocounts.")</a>";
}

function roomGallery($value, $fieldname, $primary_key, $row, $xcrud){
  $photocounts =  pt_RoomPhotosCount($primary_key);
  return "<a href=".base_url()."admin/hotels/roomgallery/".$primary_key.">Upload (".$photocounts.")</a>";
}

function roomPrices($value, $fieldname, $primary_key, $row, $xcrud){
  return "<a href=".base_url()."admin/hotels/rooms/prices/".$primary_key.">Prices </a>";
}

function roomAvail($value, $fieldname, $primary_key, $row, $xcrud){
  return "<a href=".base_url()."admin/hotels/rooms/availability/".$primary_key.">Availability </a>";
}

function orderInputHotels($value, $fieldname, $primary_key, $row, $xcrud) {
  $url = base_url()."admin/hotelajaxcalls/update_hotel_order";

return '<input class="form-control input-sm" data-url='.$url.' type="number" id="order_'.$primary_key.'" value='.$value.' min="1"  onblur="updateOrder($(this).val(),'.$primary_key.','.$value.')" />';


}

function translateExtras($value, $fieldname, $primary_key, $row, $xcrud){
   return '<a href="#extra'.$primary_key.'" data-toggle="modal"> Translate </a>';
}

function assignExtras($value, $fieldname, $primary_key, $row, $xcrud){
   return '<a href="#assign'.$primary_key.'" data-toggle="modal"> Assign </a>';
}

function orderInputPost($value, $fieldname, $primary_key, $row, $xcrud) {
  $url = base_url()."admin/ajaxcalls/update_post_order";

return '<input class="form-control input-sm" data-url='.$url.' type="number" id="order_'.$primary_key.'" value='.$value.' min="1"  onblur="updateOrder($(this).val(),'.$primary_key.','.$value.')" />';

}

function orderInputSlider($value, $fieldname, $primary_key, $row, $xcrud) {
  $url = base_url()."admin/ajaxcalls/update_slide_order";

return '<input class="form-control input-sm" data-url='.$url.' type="number" id="order_'.$primary_key.'" value='.$value.' min="1"  onblur="updateOrder($(this).val(),'.$primary_key.','.$value.')" />';

}

function translateSlider($value, $fieldname, $primary_key, $row, $xcrud){
  $url = base_url().'admin/settings/sliders/translate/'.$primary_key;
   return '<a href="'.$url.'" > Translate </a>';
}

function orderInputSocial($value, $fieldname, $primary_key, $row, $xcrud) {
  $url = base_url()."admin/ajaxcalls/update_social_order";

return '<input class="form-control input-sm" data-url='.$url.' type="number" id="order_'.$primary_key.'" value='.$value.' min="1"  onblur="updateOrder($(this).val(),'.$primary_key.','.$value.')" />';

}

function widgetCode($value, $fieldname, $primary_key, $row, $xcrud) {
            $string = "<?php echo run_widget(\$id); ?>";
            $str = str_replace("\$id",$value,$string);

            return htmlentities($str);

}

function orderInputOffers($value, $fieldname, $primary_key, $row, $xcrud) {
  $url = base_url()."admin/ajaxcalls/update_offers_order";

return '<input class="form-control input-sm" data-url='.$url.' type="number" id="order_'.$primary_key.'" value='.$value.' min="1"  onblur="updateOrder($(this).val(),'.$primary_key.','.$value.')" />';

}

function OffersPhotos($value, $fieldname, $primary_key, $row, $xcrud){
  $photocounts =  pt_OffersPhotosCount($primary_key);
  return "<a href=".base_url()."admin/offers/gallery/".$primary_key.">Upload (".$photocounts.")</a>";
}

function MakeDefault($value, $fieldname, $primary_key, $row, $xcrud){
 if($value == "No"){
    $url = base_url().'admin/ajaxcalls/makeCurrDefault';
    return "<span id='".$primary_key."' data-url='".$url."' class='makeDefault btn btn-md' ><i style='font-size:18px' class='fa fa-circle-o'></i></span>";
  }else{
    return "<span class='btn btn-md ' ><i style='font-size:18px' class='fa fa-circle fa-2x'></i></span>";
  }


}
