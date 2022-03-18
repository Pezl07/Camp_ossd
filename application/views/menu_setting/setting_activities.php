<style>
.max-score-ac .input input {
    width: 200px;
}
</style>

<div class="menu-setting d-flex mb-5">
    <div class="type-activity text-center col-2 p-3" onclick="change_menu(1)">ประเภท Activity</div>
    <div class="activities text-center col-2 p-3 active">Activities</div>
    <div class="add col-8">
        <button class="ui blue button float-end mb-4" onclick="add_row()"> เพิ่ม </button>
    </div>
</div>

<div class="div">
    <select class="ui dropdown type_id">
        <option value="ALL" <?php if($type_id == "ALL") {echo "selected";}; ?>>ALL</option>
        <?php foreach ($activity_types as $activity_type){ ?>
        <option value="<?php echo $activity_type->_id ?>"
            <?php if($type_id == $activity_type->type_name) {echo "selected";}; ?>>
            <?php echo $activity_type->type_name ?>
        </option>
        <?php } ?>
    </select>

    <select class="ui dropdown day">
        <?php for($i = 7; $i <= 14; $i++){ ?>
        <?php if($i < 10){ ?>
        <option value="2022-04-0<?php echo $i ?>"
            <?php if(isset($day) && $day == "2022-04-0".$i) {echo "selected";}; ?>>
            วันที่ <?php echo $i ?> เมษายน 2565
        </option>
        <?php }else{ ?>
        <option value="2022-04-<?php echo $i ?>" <?php if(isset($day) && $day == "2022-04-".$i) {echo "selected";}; ?>>
            วันที่ <?php echo $i ?> เมษายน 2565
        </option>
        <?php } ?>

        <?php } ?>
    </select>

</div>

<?php $count = 0 ?>

<div class="rate-form mt-4">
<form action="" enctype="multipart/form-data" method="POST">
    <table class="ui celled table">
        <thead>
            <tr>
                <th class="center aligned">ชื่อ Activities</th>

                <?php if($type_id == 'ALL'){ ?>
                <th class="center aligned" style="width: 30%">ประเภท</th>
                <?php } ?>

                <th class="center aligned">คะแนนเต็ม</th>
                <th class="center aligned"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activities as $activity) {?>
            <tr id="ac_<?php echo $activity->_id ?>">
                    <td class="center aligned">
                        <div class="name-ac">
                            <?php echo $activity->ac_name ?>
                        </div>
                    </td>

                    <?php if($type_id == 'ALL'){ ?>

                    <td class="center aligned type">
                        <div class="type-ac">
                            <?php echo $activity->type ?>
                        </div>
                    </td>

                    <?php } ?>

                    <td class="center aligned score">
                        <div class="max-score-ac">
                            <?php echo $activity->max_score ?>
                        </div>
                    </td>
                    <td class="right aligned action-ac">
                        <button type="button" class="btn btn-warning" onclick="edit_row('<?php echo $activity->_id ?>')"><i class="edit outline icon"></i></button>
                        <button type="button" class="btn btn-danger"><i class="trash alternate outline icon"></i></button>
                    </td>
            </tr>
            <?php $count++; } ?>
        </tbody>
    </table>
    </form>
</div>


<script>
var ac_type;

$(document).ready(function() {
    get_types();
    <?php if($count == 0){ ?>
        $('.ui.blue.button').click();
    <?php } ?>
});

$('.type_id, .day').on('change', function() {
    var type_id = $('.type_id').val();
    var day = $('.day').val();
    window.location.href = '<?php echo base_url(); ?>' + 'index.php/C_Setting/show_setting/' + 2 + '/' +
        type_id + '/' + day;
});

function get_types() {
    $.ajax({
        url: '<?php echo base_url() . 'index.php/C_Setting/get_activity_type_ajax' ?>',
        dataType: 'JSON',
        async: false,
        success: function(data) {
            console.log(data);
            ac_type = data;
        }
    });
}

function add_row() {
    if ($('td:eq(0)').hasClass('add') || $('form').attr('action') != '') {
        return;
    }

    $('form').attr('action', '<?php echo base_url(); ?>index.php/C_Setting/insert_activity');
        
    var input = `
                    <tr id="add">
                        <td class="center aligned add">
                            <input type="text" hidden="true" value="${'<?php echo $day ?>'}" id="date" name="date">
                            <div class="name-ac">
                                <div class="ui input" style="width: 100%">
                                    <input type="text" placeholder="ชื่อ Activity" id="ac_name" name="ac_name">
                                </div>
                            </div>
                        </td> 
                `;

    <?php if($type_id == 'ALL'){ ?>

    input += `<td class="center aligned type" >
                    <div class="type-ac">
                        <select class="ui dropdown type_id" style="width: 100%; height: 100%" id="ac_type" name="ac_type">
            `;

    for (var i = 0; i < ac_type.length; i++) {
        input += `   <option value="${ac_type[i].type_name}">
                                ${ac_type[i].type_name}
                            </option>
                        `;
    }

    input += `</select>
                    </div>
                </td> `;
    <?php }else{ ?> 
        
        input += `<td hidden="true"><input id="ac_type" name="ac_type" value="${'<?php echo $type_id ?>'}"></td>`
        
    <?php } ?>

    input += `
                    <td class="center aligned score">
                        <div class="max-score-ac">
                            <div class="ui input">
                                <input type="text" placeholder="คะแนนเต็ม" id="max_score" name="max_score">
                            </div>
                        </div>
                    </td>
                    <td class="right aligned action-ac">
                        <button type="submit" class="btn btn-success" type="submit" style="height: 90px; width: 45%"> บันทึก </button>
                        <button type="button" class="btn btn-danger" style="height: 90px; width: 45%" onclick="cancel_add_row()"> ยกเลิก </button>
                    </td>
                </tr>
            `;

    $('tbody').prepend(input);
}

function cancel_add_row(){
    if($('td').length == 0)
        $('#add').remove();
}

function edit_row(ac_id) {

    if ($('td:eq(0)').hasClass('add') || $('form').attr('action') != '') {
        return;
    }

    var name_ac = $('#ac_' + ac_id + ' td .name-ac')[0].innerText;
    var max_score = $('#ac_' + ac_id + ' td .max-score-ac')[0].innerText;

    <?php if($type_id == 'ALL'){ ?>
        var type_ac = $('#ac_' + ac_id + ' td .type-ac')[0].innerText;
        console.log(max_score);
    <?php } ?>


    $('form').attr('action', '<?php echo base_url(); ?>index.php/C_Setting/edit_activity');

    var input = ` <tr id="ac_${ac_id}" class="edit">
                    <td class="center aligned add">
                        <input type="text" hidden="true" value="${'<?php echo $day ?>'}" id="date" name="date">
                        <div class="name-ac">
                            <div class="ui input" style="width: 100%">
                                <input type="text" placeholder="ชื่อ Activity" value="${name_ac}" id="ac_name" name="ac_name">
                            </div>
                        </div>
                    </td>`;

    <?php if($type_id == 'ALL'){ ?>
    input += `<td class="center aligned type" >
                    <div class="type-ac">
                        <select class="ui dropdown type_id" style="width: 100%; height: 100%" id="ac_type" name="ac_type">
            `;

    for (var i = 0; i < ac_type.length; i++) {
        input += `   <option value="${ac_type[i].type_name}" `;

        if (type_ac == ac_type[i].type_name)
            input += "selected";

        input += `>
                                ${ac_type[i].type_name}
                            </option>
                        `;
    }

    input += `</select>
                        </div>
                    </td> `;
    <?php }else{ ?> 
        
        input += `<input id="ac_type" name="ac_type" value="${'<?php echo $type_id ?>'}">`
        
    <?php } ?>

    input += `                
                    <td class="center aligned score">
                        <div class="max-score-ac">
                            <div class="ui input">
                                <input type="text" placeholder="คะแนนเต็ม" value="${max_score}" id="max_score" name="max_score">
                            </div>
                        </div>
                    </td>
                    <td class="right aligned action-ac">
                        <button type="submit" class="btn btn-success" type="submit" style="height: 90px; width: 45%"> บันทึก </button>
                        <button type="button" class="btn btn-danger" style="height: 90px; width: 45%" onclick="cancel_edit_row('${ac_id}')"> ยกเลิก </button>
                    </td>
                </tr>`;

    $('#ac_' + ac_id).attr('hidden', true);
    $('#ac_' + ac_id).after(input);
}

function cancel_edit_row(ac_id) {
    $('#ac_' + ac_id).attr('hidden', false);
    $('#ac_' + ac_id + '.edit').remove();
    $('form').attr('action', '');
}
</script>