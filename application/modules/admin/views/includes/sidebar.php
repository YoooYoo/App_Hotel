<script>

(function ($) {
  // custom css expression for a case-insensitive contains()
  jQuery.expr[':'].Contains = function(a,i,m){
      return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
  };


  function FilterMenu(list) { 
      var input = $(".filtertxt");

      $(input).change( function () {
          var filter = $(this).val();
          //console.log(filter);
          //If search text box contains some text then apply filter list
          if(filter){
              //Add open class to parent li item 
              $(list).parent().addClass('open');
              //Add class in and expand the ul item which is nested li of main ul
              $(list).addClass('in').prop('aria-expanded', 'true').slideDown();

              //Check if child list items contain the query text. Them make them active
              $(list).find('li:Contains('+filter+')').addClass('active');
              //Check if any child list items doesn't contain query text. Remove the active class
              //So that they are not more highlighted
              $(list).find('li:not(:Contains('+filter+'))').removeClass('active');

              //Show any ul inside main ul which contains the text.
              $(list).find('li:Contains('+filter+')').show();
              //Hide any ul inside main ul which doesn't contains the text.
              $(list).find('li:not(:Contains('+filter+'))').hide();

              //Filter top level list items to show and hide them.
              $('#social-sidebar-menu').find('li:Contains('+filter+')').show();
              $('#social-sidebar-menu').find('li:not(:Contains('+filter+'))').hide();

          }else{
              //On query text = empty reset all classes and styles to default.
              $(list).parent().removeClass('open');
              $(list).removeClass('in').prop('aria-expanded', 'false').slideUp();
              $(list).find('li').removeClass('active');
              $('#social-sidebar-menu').find('li').show();
          }
      })
      .keyup( function () {
          $(this).change();
      });
  }


  //ondomready
  $(function () {
    FilterMenu($("#social-sidebar-menu ul"));
  });
}(jQuery));

  </script>

<!-- BEGIN SIDEBAR-->
<aside class="social-sidebar">
  <div class="social-sidebar-content">
    <div class="search-sidebar">
      <form class="search-sidebar-form has-icon filterform" onsubmit="return false;">
        <label for="sidebar-query" class="fa fa-search"></label>
        <input id="sidebar-query" type="text" placeholder="Search" class="search-query filtertxt">
      </form>
    </div>
    <div class="clearfix"></div>
    <div class="user">
      <i class="fa-1x glyphicon glyphicon-user"></i>
      <span><?php echo $this->session->userdata('fullName');?></span>
    </div>
    <div class="menu">
      <div class="menu-content">
             <ul id="social-sidebar-menu">
        
         <?php if($isadmin){ ?>
          <li class="active">
            <a href="<?php echo base_url();?>" target="_blank">
              <!-- icon--><i class="fa fa-laptop"></i>
              <span><?php echo trans('02');?></span>
            </a>
          </li>
          <!-- END ELEMENT MENU-->
          <!-- BEGIN ELEMENT MENU-->

          <li>
            <a data-toggle="collapse" data-parent="#social-sidebar-menu" href="#ACCOUNTS"><i class="glyphicon glyphicon-user"></i>
            <span><?php echo trans('017');?></span><i class="fa arrow"></i>
            </a>
            <ul id="<?php echo trans('017');?>" class="collapse wow fadeIn animated">
           <?php if($role != "admin"){ ?>  <li><a href="<?php echo base_url();?>admin/accounts/admins/"><?php echo trans('021');?></a></li> <?php } ?>
              <li><a href="<?php echo base_url();?>admin/accounts/suppliers/"><?php echo trans('023');?></a></li>
              <li><a href="<?php echo base_url();?>admin/accounts/customers/"><?php echo trans('025');?></a></li>
              <li><a href="<?php echo base_url();?>admin/accounts/guest/"><?php echo trans('027');?> <?php echo trans('025');?></a></li>
            </ul>
          </li>

          <li>
            <a href="#menu-ui" data-toggle="collapse" data-parent="#social-sidebar-menu">
              <!-- icon--><i class="fa fa-cogs"></i>
              <span><?php echo trans('03');?></span>
              <!-- arrow--><i class="fa arrow"></i>
            </a>
            <!-- BEGIN SUB-ELEMENT MENU-->
            <ul id="menu-ui" class="collapse wow fadeIn animated">
              <li>
                <a href="<?php echo base_url();?>admin/settings/"><?php echo trans('04');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/api/"><?php echo trans('036');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/modules/"><?php echo trans('08');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/integrations/">Integrations</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/currencies/">Currencies</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/paymentgateways/"><?php echo trans('05');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/social/"><?php echo trans('07');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/widgets/"><?php echo trans('010');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/settings/sliders/"><?php echo trans('011');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/templates/email/"><?php echo trans('012');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/backup/">BackUp</a>
              </li>
            </ul>
            <!-- END SUB-ELEMENT MENU-->
          </li>
       
          <!-- END ELEMENT MENU-->
          <!-- BEGIN ELEMENT MENU-->
         
          <li>
            <a href="#CMS" data-toggle="collapse" data-parent="#social-sidebar-menu">
              <!-- icon--><i class="fa fa-list-alt"></i>
              <span><?php echo trans('013');?></span>
              <!-- arrow--><i class="fa arrow"></i>
            </a>
            <!-- BEGIN SUB-ELEMENT MENU-->
            <ul id="CMS" class="collapse wow fadeIn animated">
              <li>
                <a href="<?php echo base_url();?>admin/cms"><?php echo trans('015');?></a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/cms/menus/manage"><?php echo trans('016');?></a>
              </li>
            </ul>
          </li>
           <?php } if(empty($supplier)){  ?>
          <?php $moduleslist = $this->ptmodules->read_config();
            $baseurl = base_url();
            @$urisegment = $this->uri->segment(1);

            foreach($moduleslist as $modl){
            $isenabled = $this->ptmodules->is_main_module_enabled(strtolower($modl['Name']));
            if($isenabled){
            if($urisegment == "admin"){ $submenu = $modl['AdminMenu'];}else{ $submenu = $modl['SupplierMenu']; }
            if(pt_permissions($modl['Name'],@$userloggedin)){
             if($modl['isIntegration'] != "Yes"){
            ?>
          <li>
            <a href="#<?php echo $modl['DisplayName']; ?>" data-toggle="collapse" data-parent="#social-sidebar-menu">
            <?php echo $modl['Icon']; ?>
            <span><?php echo $modl['DisplayName']; ?></span>
            <i class="fa arrow"></i>
            </a>
            <ul id="<?php echo $modl['DisplayName']; ?>" class="collapse  wow fadeIn animated">
              <?php echo str_replace("%baseurl%","$baseurl",$submenu); ?>
            </ul>
          </li>
          <?php } } } } } ?>
          <?php if($isadmin && $role != "admin"){ ?>
          <li>
            <a data-toggle="collapse" data-parent="#social-sidebar-menu" href="#SPECIAL_OFFERS"><i class="fa fa-gift"></i>
            <span><?php echo trans('028');?></span><i class="fa arrow"></i>
            </a>
            <ul id="SPECIAL_OFFERS" class="collapse  wow fadeIn animated">
              <li><a href="<?php echo base_url();?>admin/offers/"><?php echo trans('029');?> <?php echo trans('030');?></a></li>
              <li><a href="<?php echo base_url();?>admin/offers/settings/"><?php echo trans('030');?> <?php echo trans('04');?></a></li>
            </ul>
          </li>
          <?php } ?>
          <li>
            <a data-toggle="collapse" data-parent="#social-sidebar-menu" href="#OTHERS"><i class="fa fa-th-list"></i>
            <span>Other</span><i class="fa arrow"></i>
            </a>
            <ul id="OTHERS" class="collapse  wow fadeIn animated">
             <?php if($isadmin){  ?> <li><a href="<?php echo base_url();?>admin/newsletter/"><?php echo trans('031');?></a></li><?php } ?>
              <li><a href="<?php echo base_url().$this->uri->segment(1);?>/bookings/"><?php echo trans('034');?></a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <!-- END MENU SECTION-->
  </div>
</aside>
<!-- END SIDEBAR-->