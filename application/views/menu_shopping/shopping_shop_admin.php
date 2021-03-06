<style>
.modal * {
    font-size: clamp(16px, 2vw, 20px);
}
</style>

<div class="menu-setting d-flex mb-3">
    <div class="type-activity text-center col-2 p-4 active">ร้านค้า</div>
    <div class="activities text-center col-2 p-4 " onclick="change_menu(2)">ตะกร้า</div>
    <div class="add col-8">
        <div class="float-end mx-0 my-3 score">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-item"
                style="font-size: 20px" onclick="add_item()">
                เพิ่ม Item
            </button>
        </div>
    </div>
</div>

<?php $count = 0?>

<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    <?php foreach ($items as $item) {?>
    <div class="col mb-5" id="item_<?php echo $item->_id ?>">
        <div class="card h-100">
            <!-- Sale badge-->
            <div class="badge bg-dark text-white position-absolute item-type" style="top: 0.5rem; right: 0.5rem"><?php echo $item->type ?></div>
            <!-- Product image-->

            <?php if ($item->type == 'ขอความช่วยเหลือ') {?>
            <img class="card-img-top"
                src="https://cdn-icons-png.flaticon.com/512/682/682055.png"
                alt="...">

            <?php } elseif ($item->type == 'โจมตี') {?>
            <img class="card-img-top" src="https://cdn-icons-png.flaticon.com/512/1496/1496059.png" alt="...">

            <?php } else if ($item->type == 'ป้องกัน') {?>
            <img class="card-img-top" src="https://icons-for-free.com/iconfiles/png/512/protect-1324760613746387702.png"
                alt="...">
            <?php }?>

            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder item-name"><?php echo $item->name ?></h5>
                    <span class="item-quota"><?php echo $item->quota ?></span> ครั้ง / วัน
                    <p></p>
                    <!-- Product price-->
                    $ <span class="item-price"><?php echo $item->price ?></span>
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                    <button class="btn btn-outline-dark btn-warning text-white mt-auto" data-bs-toggle="modal"
                        data-bs-target="#modal-item" onclick="edit_item('<?php echo $item->_id ?>')">Edit</button>
                    <button type="button" class="btn btn-outline-dark btn-danger text-white mt-auto"
                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                        onclick="get_id_delete('<?php echo $item->_id ?>')">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php $count++;}?>

</div>

<?php if ($count == 0) {?>
<div class="ui message text-center">
    <div class="header">
        ไม่มีสินค้าในระบบ
    </div>
    <p></p>
</div>
<style>
table {
    display: none;
}
</style>
<?php }?>

<div class="modal fade" id="modal-item" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modal-itemLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-itemLabel">เพิ่ม Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" class="ui form" enctype="multipart/form-data" method="POST" id="input">
                <input type="text" hidden id="item_id" value="" name="item_id">
                <div class="modal-body">
                    <div class="two fields">
                        <div class="field">
                            <label>ชื่อ Item</label>
                            <input type="text" name="item" id="item" placeholder="ชื่อ Item" required>
                        </div>
                        <div class="field">
                            <label>ประเภท Item</label>
                            <select class="ui dropdown" style="height: 60% !important" id="type" name="type" required>
                                <option value="" disabled selected>ประเภท</option>
                                <option value="ขอความช่วยเหลือ">ขอความช่วยเหลือ</option>
                                <option value="โจมตี">โจมตี</option>
                                <option value="ป้องกัน">ป้องกัน</option>
                            </select>
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>ราคา ($SE)</label>
                            <input type="number" placeholder="ราคา" min="1" id="price" name="price" required>
                        </div>
                        <div class="field">
                            <label>จำนวนครั้ง/วัน</label>
                            <input type="number" placeholder="จำนวนครั้ง/วัน" min="1" id="quota" name="quota" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        onclick="location.reload();">ยกเลิก</button>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<form action="<?php echo base_url(); ?>index.php/C_Shopping/delete_item" enctype="multipart/form-data" method="POST"
    id="delete">
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" class="ui form" enctype="multipart/form-data" method="POST" id="input">
                    <input type="text" hidden id="item_id" value="" name="item_id">
                    <div class="modal-body">
                        <h1 style="font-weight: bold; font-size: 50px !important" class="text-center"> ยืนยันการลบ </h1>
                        <input type="hidden" name="delete_id" id="delete_id" hidden="true">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onclick="location.reload();">ยกเลิก</button>
                        <button type="submit" class="btn btn-danger">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>

<script>
$('.selection.dropdown').dropdown();

$(document).ready(function() {
    $("form#input").validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            item: {
                required: true,
            },
            type: {
                required: true,
            },
            price: {
                required: true,
            },
            quota: {
                required: true
            }
        },
        messages: {
            item: {
                required: '',
            },
            type: {
                required: '',
            },
            price: {
                required: '',
            },
            quota: {
                required: ''
            }
        }
    });
});

function add_item() {
    $('form#input').attr('action', '<?php echo base_url(); ?>index.php/C_Shopping/insert_item');
    $('.modal-title').html('เพิ่ม Item');
    console.log('insert');
}

function edit_item(id) {
    $('form#input').attr('action', '<?php echo base_url(); ?>index.php/C_Shopping/update_item');
    $('#item_id').val(id);
    $('#item').val($('#item_' + id + ' div div div .item-name').text());
    $('#quota').val($('#item_' + id + ' div div div .item-quota').text());
    $('#price').val($('#item_' + id + ' div div div .item-price').text());
    $('#type').val($('#item_' + id + ' div .item-type').text());
    $('.modal-title').html('แก้ไข Item');
    console.log(type);
}


function get_id_delete(ac_id) {
    $('#delete_id').val(ac_id);
}
</script>