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
        <div class="clearfix"></div>
        <div class="<?php echo mainsearch; ?>">
            <button type="submit" id="searchform" class="btn btn-warning btn-block btn-lg rippler rippler-inverse"><i
                    class="fa fa-search"></i> <?php echo trans('012'); ?></button>
        </div>
    </form>
<?php } ?>