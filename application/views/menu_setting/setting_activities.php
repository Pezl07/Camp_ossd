<style>
    .max-score-ac .input input{
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
            <?php if($type_id == $activity_type->_id) {echo "selected";}; ?>>
            <?php echo $activity_type->type_name ?>
        </option>
        <?php } ?>
    </select>

    <select class="ui dropdown day">
        <?php for($i = 7; $i <= 14; $i++){ ?>
        <?php if($i < 10){ ?>
        <option value="2022-03-0<?php echo $i ?>"
            <?php if(isset($day) && $day == "2022-03-0".$i) {echo "selected";}; ?>>
            วันที่ <?php echo $i ?> เมษายน 2565
        </option>
        <?php }else{ ?>
        <option value="2022-03-<?php echo $i ?>" <?php if(isset($day) && $day == "2022-03-".$i) {echo "selected";}; ?>>
            วันที่ <?php echo $i ?> เมษายน 2565
        </option>
        <?php } ?>

        <?php } ?>
    </select>

</div>

<div class="rate-form mt-4">
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
            <tr id="ac_1">
                <td class="center aligned">
                    <div class="name-ac">
                        Daily
                    </div>
                </td>

                <?php if($type_id == 'ALL'){ ?>

                <td class="center aligned type">
                    <div class="type-ac">
                        Scrum Lover
                    </div>
                </td>

                <?php } ?>

                <td class="center aligned score">
                    <div class="max-score-ac">
                        1000
                    </div>
                </td>
                <td class="right aligned action-ac">
                    <button class="btn btn-warning" onclick="edit_row('<?php echo 1 ?>')"><i class="edit outline icon"></i></button>
                    <button class="btn btn-danger"><i class="trash alternate outline icon"></i></button>
                </td>
            </tr>
            <tr id="ac_2">
                <td class="center aligned">
                    <div class="name-ac">
                        Task Done
                    </div>
                </td>

                <?php if($type_id == 'ALL'){ ?>

                <td class="center aligned type">
                    <div class="type-ac">
                        Soft Skill
                    </div>
                </td>

                <?php } ?>

                <td class="center aligned score">
                    <div class="max-score-ac">
                        1000
                    </div>
                </td>
                <td class="right aligned action-ac">
                    <button class="btn btn-warning" onclick="edit_row('<?php echo 2 ?>')"><i class="edit outline icon"></i></button>
                    <button class="btn btn-danger"><i class="trash alternate outline icon"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>


<script>

$( document ).ready(function() {
    get_types();
});

$('.type_id, .day').on('change', function() {
    var type_id = $('.type_id').val();
    var day = $('.day').val();
    window.location.href = '<?php echo base_url(); ?>' + 'index.php/C_Setting/show_setting/' + 2 + '/' +
        type_id + '/' + day;
});

var undo_edit;
var ac_type;

function get_types(){
    $.ajax({
            url: '<?php echo base_url() . 'index.php/C_Setting/get_activity_type_ajax' ?>',
            dataType: 'JSON',
            success: function(data) {
                ac_type = data;
            }
    });
}

function add_row() {
    if($('td:eq(0)').hasClass('add')){
        return;
    }

    console.log(ac_type);

    var input = `   <tr id="add">
                        <td class="center aligned add">
                            <div class="name-ac">
                                <div class="ui input" style="width: 100%">
                                    <input type="text" placeholder="ชื่อ Activity">
                                </div>
                            </div>
                        </td> 
                `;

    <?php if($type_id == 'ALL'){ ?>

    input += `<td class="center aligned type" >
                    <div class="type-ac">
                        <select class="ui dropdown type_id" style="width: 100%; height: 100%">
            `;

        for(var i = 0; i < ac_type.length; i++){
            input +=    `   <option value="${ac_type[i]._id}">
                                ${ac_type[i].type_name}
                            </option>
                        `;
        }

    input += `</select>
                    </div>
                </td> `;
    <?php } ?>

    input   += `
                <td class="center aligned score">
                    <div class="max-score-ac">
                        <div class="ui input">
                            <input type="text" placeholder="คะแนนเต็ม">
                        </div>
                    </div>
                </td>
                <td class="right aligned action-ac">
                    <button class="btn btn-success" style="height: 90px; width: 45%"> บันทึก </button>
                    <button class="btn btn-danger" style="height: 90px; width: 45%" onclick="$('#add').remove()"> ยกเลิก </button>
                </td>
            </tr>`;
    $('tbody').prepend(input);
}

function edit_row(ac_id){
    var name_ac = $('#ac_'+ac_id+' td .name-ac')[0].innerText;
    var max_score = $('#ac_'+ac_id+' td .max-score-ac')[0].innerText;
    var type_ac = $('#ac_'+ac_id+' td .type-ac')[0].innerText;
    
    var input = `   
                    <td class="center aligned add">
                        <div class="name-ac">
                            <div class="ui input" style="width: 100%">
                                <input type="text" placeholder="ชื่อ Activity" value="${name_ac}">
                            </div>
                        </div>
                    </td>`;

    <?php if($type_id == 'ALL'){ ?>
        input += `<td class="center aligned type" >
                    <div class="type-ac">
                        <select class="ui dropdown type_id" style="width: 100%; height: 100%">
            `;

        for(var i = 0; i < ac_type.length; i++){
            input +=    `   <option value="${ac_type[i]._id}" `;
            
            if(type_ac == ac_type[i].type_name) 
                input += "selected";
            
            input +=    `>
                                ${ac_type[i].type_name}
                            </option>
                        `;
        }

        input += `</select>
                        </div>
                    </td> `;
    <?php } ?>
    
    input += `                
                    <td class="center aligned score">
                        <div class="max-score-ac">
                            <div class="ui input">
                                <input type="text" placeholder="คะแนนเต็ม" value="${max_score}">
                            </div>
                        </div>
                    </td>
                    <td class="right aligned action-ac">
                        <button class="btn btn-success" style="height: 90px; width: 45%"> บันทึก </button>
                        <button class="btn btn-danger" style="height: 90px; width: 45%" onclick="cancel_edit_row('${ac_id}')"> ยกเลิก </button>
                    </td>
                `;

    undo_edit = $('#ac_'+ac_id).html(); 
    $('#ac_'+ac_id+' *').remove();
    $('#ac_'+ac_id).prepend(input);
}

function cancel_edit_row(ac_id){
    $('#ac_'+ac_id+' *').remove();
    $('#ac_'+ac_id).prepend(undo_edit);
}
</script>