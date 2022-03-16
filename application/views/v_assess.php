<style>
.rate-container {
    padding-bottom: 50px;
}

table {
    background-color: rgba(0, 0, 0, 0.7) !important;
    border-radius: 15px !important;
    padding-bottom: 50px !important;
}

table,
td,
th {
    border: none !important;
    padding: 20px 50px;
}

td {
    font-size: 20px;
    background-color: rgba(255, 255, 255, 0.5) !important;
}

th {
    color: white !important;
    background-color: rgba(0, 0, 0, 0.0) !important;
    font-size: 20px;
}

tr:not(:last-child) {
    border-spacing: 5em;
}

td:not(.right) {
    padding-right: 20px !important;
    border-radius: 20px 0px 0px 20px !important;
}

td.right {
    width: 20%;
    padding-right: 20px !important;
    border-radius: 0px 20px 20px 0px !important;
}

.name-ac,
.input-ac {
    background-color: white !important;
    border-radius: 20px !important;
    padding: 20px;
    width: 100%;
}

.ui.input input {
    text-align: right !important;
}

.ui.green.button{
    font-size: 20px;
}
</style>

<div class="rate-container mx-5">

    <div class="div">
        <select class="ui dropdown type_id">
            <option value="ALL" <?php if($type_id == "ALL") {echo "selected";}; ?> >ALL</option>
            <?php foreach ($activity_types as $activity_type){ ?>
                <option value="<?php echo $activity_type->_id ?>" <?php if($type_id == $activity_type->_id) {echo "selected";}; ?> >
                    <?php echo $activity_type->type_name ?>
                </option>
            <?php } ?>
        </select>

        <select class="ui dropdown day">
            <?php for($i = 7; $i <= 14; $i++){ ?>
                <?php if($i < 10){ ?>
                    <option value="2022-03-0<?php echo $i ?>" <?php if(isset($day) && $day == "2022-03-0".$i) {echo "selected";}; ?> >
                        วันที่ <?php echo $i ?> เมษายน 2565
                    </option>
                <?php }else{ ?>
                    <option value="2022-03-<?php echo $i ?>" <?php if(isset($day) && $day == "2022-03-".$i) {echo "selected";}; ?> >
                        วันที่ <?php echo $i ?> เมษายน 2565
                    </option>
                <?php } ?>

            <?php } ?>
        </select>

        <button class="ui green button float-end"> บันทึก </button>
    </div>

    <div class="rate-form mt-5">
        <table class="ui celled table">
            <thead>
                <tr>
                    <th class="center aligned">ชื่อ Activities</th>
                    <th class="center aligned">คะแนน ($SE)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="center aligned">
                        <div class="name-ac">
                            Daily
                        </div>
                    </td>
                    <td class="right aligned">
                        <div class="input-ac">
                            <div class="ui transparent input">
                                <input type="text" placeholder="/1000">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="center aligned">
                        <div class="name-ac">
                            Task Done
                        </div>
                    </td>
                    <td class="right aligned">
                        <div class="input-ac">
                            <div class="ui transparent input">
                                <input type="text" placeholder="/100">
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<script>
    $('.type_id, .day').on('change', function() {
        var type_id = $('.type_id').val();
        var day = $('.day').val();
        window.location.href = '<?php echo base_url(); ?>' + 'index.php/C_Assess/show_assess/' + type_id + '/' + day;
    });
</script>