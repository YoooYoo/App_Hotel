<style>
    /* Tooltip */
    .setting_context + .tooltip > .tooltip-inner {
        background-color: #717171;
        color: #FFFFFF;
        border: 1px solid #717171;
        padding: 15px;
        font-size: 14px;
    }
    /* Tooltip on bottom */
    .setting_context + .tooltip.bottom > .tooltip-arrow {
        border-bottom: 5px solid #717171;
    }

    @media (min-width: 768px)
    .title-line-black2 {
        font-size: 16px;
        padding: 6px 10px;
    }
    .title-line-black2 {
        text-transform: uppercase;
        font-weight: 700;
        font-size: 13px;
        padding: 4px 10px;
        background-color: #DDD;
    }

    .modal-backdrop, .modal-backdrop.in{
        display: none;
    }

    .x-modal-context {
        with:100%
    }
</style>
<?php if (pt_main_module_available('hotels')) { ?>

    <form method="GET" action="<?php echo base_url(); ?>hotels/search" style="margin-top:15px">
        <div class="<?php echo findwhat; ?>">
            <div class="form-group" style="margin-bottom: 0px;">
                <input required id="HotelsPlaces" name="searching" type="text" class="form-control input-lg RTL"
                       placeholder="&#xf041; <?php echo trans('026'); ?>">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="<?php echo checkin; ?> go-right"><p class="go-right"><?php echo trans('07'); ?></p>
            <input type="text" class="input-sm form-control checkinsearch dpd1 RTL" name="checkin"
                   value="<?php echo $checkin; ?>" placeholder="&#xf073; <?php echo trans('07'); ?>">

        </div>
        <div class="<?php echo checkout; ?> go-right"><p class="go-right"><?php echo trans('09'); ?></p>
            <input type="text" class="input-sm form-control dpd2 RTL" name="checkout" value="<?php echo $checkout; ?>"
                   placeholder="&#xf073; <?php echo trans('09'); ?>">
        </div>

        <div class="<?php echo checkadults; ?> go-right">
            <p class="go-right"><?php echo trans('010'); ?></p>
            <select name="adults" class="form-control input-sm RTL">
                <option value="1">1</option>
                <option value="2" selected>2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>

        <div class="<?php echo checkchild; ?> go-left">
            <p class="go-right"><?php echo trans('011'); ?></p>
            <select name="adults" class="form-control input-sm RTL">
                <option value="1">1</option>
                <option value="2" selected>2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>

        <div class="form-group c-3 col-sm-3 col-md-3 col-lg-3 pull-right">
            <a class="setting_context pull-right x-set-search-condition" href="javascript;"
               data-toggle="modal"
               data-tooltip="tooltip"
               data-placement="bottom"
               data-target="#ConditionContext"
               title="<?php echo trans('0447'); ?>" >
                <img class="img-responsive pull-right" src="<?php echo $theme_url; ?>assets/images/icon_setting.png" alt="" style="width: 15%;">
            </a>
        </div>

        <div class="modal fade in" id="ConditionContext" tabindex="" role="dialog" aria-labelledby="ConditionContext" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="margin-top: 100px; width: 50%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="title-line-black2"><?php echo trans('0490'); ?></div>
                    </div>
                    <div class="modal-body">
                        <div class="title-line-black2 x-modal-context"><?php echo trans('0450'); ?></div>
                        <ul class="list-unstyled clearfix x-modal-context">
                            <li class="col-xs-12 col-sm-12 col-md-12">
                                <div class="list-checkbox">
                                    <div class="custom-checkbox">
                                        <label>
                                            <input type="checkbox" name="thoi_gian[]" value="5">
                                            <span><i><?php echo trans('0451'); ?></i></span>

                                            <input type="checkbox" name="thoi_gian[]" value="6">
                                            <span><i><?php echo trans('0452'); ?></i></span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="title-line-black2 x-modal-context"><?php echo trans('0460'); ?></div>
                        <ul class="list-unstyled clearfix x-modal-context">
                            <li class="col-xs-12 col-sm-12 col-md-12">
                                <div class="list-checkbox">
                                    <div class="custom-checkbox">
                                        <label>
                                            <input type="checkbox" name="thoi_tiet[]" value="7">
                                            <span><i><?php echo trans('0461'); ?></i></span>

                                            <input type="checkbox" name="thoi_tiet[]" value="8">
                                            <span><i><?php echo trans('0462'); ?></i></span>

                                            <input type="checkbox" name="thoi_tiet[]" value="9">
                                            <span><i><?php echo trans('0463'); ?></i></span>

                                            <input type="checkbox" name="thoi_tiet[]" value="10">
                                            <span><i><?php echo trans('0464'); ?></i></span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="title-line-black2 x-modal-context"><?php echo trans('0470'); ?></div>
                        <ul class="list-unstyled clearfix x-modal-context">
                            <li class="col-xs-12 col-sm-12 col-md-12">
                                <div class="list-checkbox">
                                    <div class="custom-checkbox">
                                        <label>
                                            <input type="checkbox" name="di_cung[]" value="11">
                                            <span><i><?php echo trans('0471'); ?></i></span>

                                            <input type="checkbox" name="di_cung[]" value="12">
                                            <span><i><?php echo trans('0472'); ?></i></span>

                                            <input type="checkbox" name="di_cung[]" value="13">
                                            <span><i><?php echo trans('0473'); ?></i></span>

                                            <input type="checkbox" name="di_cung[]" value="14">
                                            <span><i><?php echo trans('0474'); ?></i></span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="title-line-black2 x-modal-context"><?php echo trans('0480'); ?></div>
                        <ul class="list-unstyled clearfix x-modal-context">
                            <li class="col-xs-12 col-sm-12 col-md-12">
                                <div class="list-checkbox">
                                    <div class="custom-checkbox">
                                        <label>
                                            <input type="checkbox" name="muc_dich[]" value="15">
                                            <span><i><?php echo trans('0481'); ?></i></span>

                                            <input type="checkbox" name="muc_dich[]" value="6">
                                            <span><i><?php echo trans('0482'); ?></i></span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="lat" value="">
        <input type="hidden" name="long" value="">

        <div class="clearfix"></div>
        <div class="<?php echo mainsearch; ?>">
            <button type="submit" id="searchform" class="btn btn-warning btn-block btn-lg rippler rippler-inverse"><i
                    class="fa fa-search"></i> <?php echo trans('012'); ?></button>
        </div>
    </form>
<?php } ?>
<!-- Comments modal -->
<script>
    $(document).ready(function(){
        $('[data-tooltip="tooltip"]').tooltip();

        $('.x-set-search-condition').click(function() {
            $('.modal-backdrop').css('display:none');
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            //x.innerHTML = "Geolocation is not supported by this browser.";
        }

        function showPosition(position) {
            $('input[name=lat]').val(position.coords.latitude);
            $('input[name=long]').val(position.coords.longitude);
        }
    });
</script>
