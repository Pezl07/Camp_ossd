<div class="menu-setting d-flex mb-5">
    <div class="type-activity text-center col-2 p-3 active">ประเภท Activity</div>
    <div class="activities text-center col-2 p-3 " onclick="change_menu(2)">Activities</div>
    <div class="add col-8">
        <button class="ui blue button float-end mb-4" onclick="add_row()"> เพิ่ม
        </button>
    </div>
</div>

<div class="rate-form">
    <table class="ui celled table">
        <thead>
            <tr>
                <th class="center aligned">ชื่อ Activities</th>
                <th class="center aligned"></th>
            </tr>
        </thead>

        <?php if(isset($activity_types)){ ?>
            <tbody>
            <?php foreach($activity_types as $activity_type){ ?>
                <?php if($activity_type->type_name != 'Admin') { ?>
                    <tr id="ac_<?php echo $activity_type->_id ?>">
                        <td class="center aligned">
                            <div class="name-ac">
                                <?php echo $activity_type->type_name ?>
                            </div>
                        </td>
                        <td class="right aligned action-ac">
                            <button class="btn btn-warning" onclick="edit_row('<?php echo $activity_type->_id ?>')"><i class="edit outline icon"></i></button>
                            <button class="btn btn-danger"><i class="trash alternate outline icon"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        <?php } ?>

    </table>

    <script>

    var undo_edit;

    function add_row() {
        if($('td:eq(0)').hasClass('add')){
            return;
        }

        var input = `   <tr id="add">
                        <td class="center aligned add">
                            <div class="name-ac">
                                <div class="ui input" style="width: 100%">
                                    <input type="text" placeholder="ชื่อประเภท Activity">
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
        var name_type_ac = $('#ac_'+ac_id+' td .name-ac')[0].innerText;
        
        var input = `   <td class="center aligned add">
                            <div class="name-ac">
                                <div class="ui input" style="width: 100%">
                                    <input type="text" placeholder="ชื่อประเภท Activity" value="${name_type_ac}">
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
        console.log(undo_edit);
    }



    </script>