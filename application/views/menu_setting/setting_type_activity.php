<div class="menu-setting d-flex mb-5">
    <div class="type-activity text-center col-2 p-3 active">ประเภท Activity</div>
    <div class="activities text-center col-2 p-3 " onclick="change_menu(2)">Activities</div>
    <div class="add col-8">
        <button class="ui blue button float-end mb-4" onclick="add_row()"> เพิ่ม
        </button>
    </div>
</div>

<?php $count = 0 ?>

<div class="rate-form">
    <form action="" enctype="multipart/form-data" method="POST">
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
                        <button class="btn btn-warning" onclick="edit_row('<?php echo $activity_type->_id ?>')"
                            type="button">
                            <i class="edit outline icon"></i></button>
                        <button class="btn btn-danger" type="button"><i
                                class="trash alternate outline icon"></i></button>
                    </td>
                </tr>
                <?php } ?>
                <?php } ?>
            </tbody>
            <?php $count++; } ?>

        </table>
    </form>
    <script>
    var undo_edit;

    $(document).ready(function() {
        <?php if($count == 0){ ?>
        $('.ui.blue.button').click();
        <?php } ?>
    });

    function add_row() {
        if ($('td:eq(0)').hasClass('add') || $('form').attr('action') != '') {
            return;
        }

        $('form').attr('action', '<?php echo base_url(); ?>index.php/C_Setting/input_activity_type');

        var input = `   <tr id="add">
                        <td class="center aligned add">
                            <div class="name-ac">
                                <div class="ui input" style="width: 100%">
                                    <input type="text" placeholder="ชื่อประเภท Activity" id="type_name" name="type_name">
                                </div>
                            </div>
                        </td>
                        <td class="right aligned action-ac">
                            <button class="btn btn-success" type="submit" style="height: 90px; width: 45%"> บันทึก </button>
                            <button class="btn btn-danger" type="button" style="height: 90px; width: 45%" onclick="cancel_add_row()"> ยกเลิก </button>
                        </td>
            </tr>`;
        $('tbody').prepend(input);
    }

    function cancel_add_row() {
        if ($('td').length == 0 || $('td:eq(0)').hasClass('add')){
            $('#add').remove();
            $('form').attr('action', '');
        }
    }

    function edit_row(ac_id) {

        if ($('td:eq(0)').hasClass('add') || $('form').attr('action') != '') {
            return;
        }

        var name_type_ac = $('#ac_' + ac_id + ' td .name-ac')[0].innerText;

        $('form').attr('action', '<?php echo base_url(); ?>index.php/C_Setting/edit_activity_type');

        var input = `   <tr id="ac_${ac_id}" class="edit">
                        <td class="center aligned add">
                            <input type="text" value="${'ac_id'}" id="id" name="id" hidden="true">
                            <div class="name-ac">
                                <div class="ui input" style="width: 100%">
                                    <input type="text" placeholder="ชื่อประเภท Activity" value="${name_type_ac}" id="type_name" name="type_name">
                                </div>
                            </div>
                        </td>
                        <td class="right aligned action-ac">
                            <button class="btn btn-success" type="submit" style="height: 90px; width: 45%"> บันทึก </button>
                            <button class="btn btn-danger" type="button" style="height: 90px; width: 45%" onclick="cancel_edit_row('${ac_id}')"> ยกเลิก </button>
                        </td>
                        </tr>
                    `;

        $('#ac_' + ac_id).attr('hidden', true);
        $('#ac_' + ac_id).after(input);
    }

    function cancel_edit_row(ac_id) {
        $('#ac_' + ac_id).attr('hidden', false);
        $('#ac_' + ac_id + '.edit').remove();
        $('form').attr('action', '');
    }
    </script>