<script type="text/javascript">
$(function(){
  $(".pagetitle").blur(function(){
    var title = $(this).val();
    var pageid = $("#pageid").val();
    $.post("<?php echo base_url();?>admin/ajaxcalls/createCMSPermalink",{pagetitle: title, pageid: pageid},function(response){
        $(".permalink").val(response);
    });
  })
})
</script>
<div class="container">
  <form action="" method="POST">
  <?php $validationerrors = validation_errors();
       if(isset($errormsg) || !empty($validationerrors)){  ?>
    <div class="alert alert-danger">
      <i class="fa fa-times-circle"></i>
      <?php
        echo @$errormsg;
        echo $validationerrors; ?>
    </div>
    <?php  } ?>
    <div class="panel panel-default">

            <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="active"><a href="#GENERAL" data-toggle="tab"><?php echo ucfirst($action);?> Page</a></li>
            <li class=""><a href="#TRANSLATE" data-toggle="tab">Translate</a></li>
        </ul>

      <div class="panel-body">
    <br>
            <div class="tab-content">
          <div class="tab-pane wow fadeIn animated active in" id="GENERAL">
          <div class="col-md-12">
            <div class="col-md-4">
              <div class="form-group ">
                <label class="required">Page Title</label>
                <input class="form-control pagetitle" type="text" placeholder="Page Title" name="pagetitle" value="<?php echo  @$pagedata[0]->content_page_title;?>">
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group ">
                <label class="required">Permalink : <?php echo base_url();?></label>
                <input class="form-control pull-right permalink" type="text" placeholder="Permalink" name="pageslug" value="<?php echo  @$pagedata[0]->page_slug;?>">
              </div>
            </div>
            <div class="col-md-12">
            <?php $this->ckeditor->editor('pagebody', @$pagedata[0]->content_body, $ckconfig,'pagebody'); ?>
            </div>
          </div>
          <div class="clearfix"></div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">Page Settings</div>
                <div class="panel-body form-horizontal">
                  <div class="form-group">
                    <label for="form-input" class="col-sm-1 control-label">Status</label>
                    <div class="col-sm-2">
                      <select data-placeholder="Select" name="status" class="form-control" tabindex="2">
                        <option value="Yes" <?php if($pagedata[0]->page_status == "Yes"){ echo "selected";} ?> >Enable</option>
                        <option value="No" <?php if($pagedata[0]->page_status == "No"){ echo "selected";} ?>>Disable</option>
                      </select>
                    </div>
                    <label for="form-input" class="col-sm-1 control-label">Target</label>
                    <div class="col-sm-2">
                      <select data-placeholder="Select" name="pagetarget" class="form-control" tabindex="2">
                        <option value="self" <?php if($pagedata[0]->page_target == "self"){ echo "selected";} ?>>Self</option>
                        <option value="blank" <?php if($pagedata[0]->page_target == "blank"){ echo "selected";} ?>>Blank</option>
                      </select>
                    </div>
                    <label for="form-input" class="col-sm-1 control-label">Link</label>
                    <div class="col-sm-4">
                      <input class="form-control" type="text" name="externalink" value="<?php echo $pagedata[0]->page_external_link; ?>" placeholder="External URL">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            .
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">SEO</div>
                <div class="panel-body form-horizontal">
                  <div class="form-group">
                    <label for="form-input" class="col-sm-1 control-label">Keywords</label>
                    <div class="col-sm-11">
                      <input class="form-control" type="text" name="keywords" value="<?php echo @$pagedata[0]->content_meta_keywords; ?>" placeholder="Keywords">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="form-input" class="col-sm-1 control-label">Description</label>
                    <div class="col-sm-11">
                      <input class="form-control" type="text" name="pagedesc" value="<?php echo @$pagedata[0]->content_meta_desc; ?>" placeholder="Description">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>

          <!----Translation Tab---->

           <div class="tab-pane wow fadeIn animated in" id="TRANSLATE">

                    <?php foreach($languages as $lang => $val){ if($lang != "en"){ @$trans = getBackCMSTranslation($lang,$pageid);  ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><img src="<?php echo PT_LANGUAGE_IMAGES.$lang.".png"?>" height="20" alt="" /> <?php echo $val; ?></div>
                        <div class="panel-body">
                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left">Page Title</label>
                                <div class="col-md-4">
                                    <input name='<?php echo "translated[$lang][title]"; ?>' type="text" placeholder="Page Title" class="form-control" value="<?php echo @$trans[0]->content_page_title;?>" />
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left">Page Content</label>
                                <div class="col-md-10">
                                 <?php $this->ckeditor->editor("translated[$lang][desc]", @$trans[0]->content_body, $ckconfig,"translated[$lang][desc]"); ?>

                                </div>
                            </div>

                            <hr>


                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left">Meta Keywords</label>
                                <div class="col-md-6">
                                    <textarea name='<?php echo "translated[$lang][keywords]"; ?>' placeholder="Keywords" class="form-control" id="" cols="30" rows="2"><?php echo @$trans[0]->content_meta_keywords;?></textarea>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2 control-label text-left">Meta Description</label>
                                <div class="col-md-6">
                                    <textarea name='<?php echo "translated[$lang][metadesc]"; ?>' placeholder="Description" class="form-control" id="" cols="30" rows="4"><?php echo @$trans[0]->content_meta_desc;?></textarea>
                                </div>
                            </div>


                        </div>
                    </div>
                    <?php } } ?>

                </div>

        </div>
      </div>
      <div class="panel-footer">
      <input type="hidden" name="action" value="<?php echo $action;?>" />
      <input type="hidden" id="pageid" name="pageid" value="<?php echo $pageid;?>" />
      <input type="hidden" id="" name="contentid" value="<?php echo @$pagedata[0]->content_id; ?>" />
        <button class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
</div>