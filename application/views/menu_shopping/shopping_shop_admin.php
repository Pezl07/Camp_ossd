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

<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    <?php foreach ($items as $item){ ?>
    <div class="col mb-5" id="item_<?php echo $item->_id ?>">
        <div class="card h-100">
            <!-- Sale badge-->
            <div class="badge bg-dark text-white position-absolute item-type" style="top: 0.5rem; right: 0.5rem"><?php echo $item->type ?></div>
            <!-- Product image-->
            
            <?php if($item->type == 'ขอความช่วยเหลือ'){ ?>
                <img class="card-img-top" src="https://image.bangkokbiznews.com/image/kt/media/image/fileupload/source/niti/03042561/1_148.jpg" alt="...">

            <?php }elseif($item->type == 'โจมตี'){ ?>
                <img class="card-img-top" src="https://www.matichon.co.th/wp-content/uploads/2017/01/2-69.jpg" alt="...">

            <?php }else if($item->type == 'ป้องกัน'){ ?>
                <img class="card-img-top" src="https://www.matichon.co.th/wp-content/uploads/2018/05/DSC_4708.jpg" alt="...">
            <?php } ?>
            
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
                    <button class="btn btn-outline-dark btn-warning text-white mt-auto" data-bs-toggle="modal" data-bs-target="#modal-item" 
                    onclick="edit_item('<?php echo $item->_id ?>')">Edit</button>
                    <a class="btn btn-outline-dark btn-danger text-white mt-auto" href="#">Delet</a>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<div class="modal fade" id="modal-item" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modal-itemLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-itemLabel">เพิ่ม Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" class="ui form" enctype="multipart/form-data" method="POST">
            <input type="text" hidden id="item_id" value="" name="item_id">
            <div class="modal-body">
                    <div class="two fields">
                        <div class="field">
                            <label>ชื่อ Item</label>
                            <input type="text" name="item" id="item" placeholder="ชื่อ Item">
                        </div>
                        <div class="field">
                            <label>ประเภท Item</label>
                            <select class="ui dropdown" style="height: 60% !important" id="type" name="type">
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
                            <input type="number" placeholder="ราคา" min="1" id="price" name="price">
                        </div>
                        <div class="field">
                            <label>จำนวนครั้ง/วัน</label>
                            <input type="number" placeholder="จำนวนครั้ง/วัน" min="1" id="quota" name="quota">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload();">ยกเลิก</button>
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
$('.selection.dropdown').dropdown();

function add_item(){
    $('form').attr('action', '<?php echo base_url();?>index.php/C_Shopping/insert_item');
    console.log('insert');
}

function edit_item(id){
    $('form').attr('action', '<?php echo base_url();?>index.php/C_Shopping/update_item');
    $('#item_id').val(id);
    $('#item').val($('#item_'+id+' div div div .item-name').text());
    $('#quota').val($('#item_'+id+' div div div .item-quota').text());
    $('#price').val($('#item_'+id+' div div div .item-price').text());
    $('#type').val($('#item_'+id+' div .item-type').text());
    console.log(type);
}

</script>