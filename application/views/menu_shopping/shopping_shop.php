<div class="menu-setting d-flex mb-3">
    <div class="type-activity text-center col-2 p-4 active">ร้านค้า</div>
    <div class="activities text-center col-2 p-4 " onclick="change_menu(2)">ตะกร้า</div>
    <div class="add col-8">
        <div class="float-end m-4 score"><?php echo $team->score ?> $SE</div>
    </div>
</div>

<?php $count = 0 ?>

<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    <?php foreach ($items as $item){ ?>
    <div class="col mb-5" id="item_<?php echo $item->_id ?>">
        <div class="card h-100">
            <!-- Sale badge-->
            <div class="badge bg-dark text-white position-absolute item-type" style="top: 0.5rem; right: 0.5rem"><?php echo $item->type ?></div>
            <!-- Product image-->

            <?php if($item->type == 'ขอความช่วยเหลือ'){ ?>
            <img class="card-img-top"
                src="https://image.bangkokbiznews.com/image/kt/media/image/fileupload/source/niti/03042561/1_148.jpg"
                alt="...">

            <?php }elseif($item->type == 'โจมตี'){ ?>
            <img class="card-img-top" src="https://www.matichon.co.th/wp-content/uploads/2017/01/2-69.jpg" alt="...">

            <?php }else if($item->type == 'ป้องกัน'){ ?>
            <img class="card-img-top" src="https://www.matichon.co.th/wp-content/uploads/2018/05/DSC_4708.jpg"
                alt="...">
            <?php } ?>

            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder item-name"><?php echo $item->name ?></h5>
                    <p><?php echo $item->quota ?> ครั้ง / วัน</p>
                    <!-- Product price-->
                    $ <span class="item-price"><?php echo $item->price ?></span>
                </div>
            </div>
            <?php if($_SESSION['user']->role == 'หัวหน้า'){ ?>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                        class="btn btn-danger mt-auto <?php if($team->score < $item->price) echo "disabled" ?>"
                        onclick="get_id('<?php echo $item->_id ?>')">Add to cart</a></div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php $count++; } ?>

</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-5">
                <h1 style="font-weight: bold; font-size: 50px !important"> ยืนยันการสั่งซื้อ </h1>
                <input type="hidden" name="delete_id" id="delete_id" hidden="true">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-success" id="confirm" onclick="">ยืนยัน</button>
            </div>
        </div>
    </div>
</div>

<?php if($count == 0){ ?>
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
<?php } ?>

<script>
function insert(id) {
    var team = Number('<?php echo $_SESSION['user']->team; ?>');
    var item = $('#item_' + id + ' div div div .item-name').text();
    var price = Number($('#item_' + id + ' div div div .item-price').text());
    var score = $('.score').text();
    score = score.substr(0, score.length - 3);
    var type = $('#item_' + id + ' div .item-type').text();

    $.ajax({
        url: '<?php echo base_url() . 'index.php/C_Shopping/insert_order_ajax' ?>',
        method: 'POST',
        dataType: 'JSON',
        async: true,
        data: {
            team: team,
            item: item,
            price: price,
            score: score,
            type: type
        },
        success: function(data) {
            if (data = 'fail') {
                swal({
                    title: "เกินกำหนด",
                    text: "",
                    icon: "error",
                    button: "OK",
                }).then((value) => {
                    location.reload();
                });
            }
            console.log(data);
        }
    });

    swal({
        title: "สั่งซื้อสำเร็จ",
        text: "",
        icon: "success",
        button: "OK",
    }).then((value) => {
        location.reload();
    });
}

function get_id(id) {
    $('#confirm').attr('onclick', 'insert("' + id + '")');
}
</script>