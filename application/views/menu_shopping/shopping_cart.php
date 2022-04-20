<div class="menu-setting d-flex mb-3">
    <div class="type-activity text-center col-2 p-4" onclick="change_menu(1)">ร้านค้า</div>
    <div class="activities text-center col-2 p-4 active">ตะกร้า</div>
    <div class="add col-8">
        <div class="float-end m-4"> <?php echo $team->score ?> $SE</div>
    </div>
</div>

<?php $count = 0?>

<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    <?php foreach ($items as $item) {?>

    <div class="col mb-5" id="item_<?php echo $item->_id ?>">
        <div class="card h-100">
            <!-- Sale badge-->
            <div class="badge bg-dark text-white position-absolute item-type" style="top: 0.5rem; right: 0.5rem">
                <?php echo $item->type ?></div>
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
                    <h5 class="fw-bolder item-name">
                        <?php
echo $item->item;
    if ($_SESSION['user']->role == 'admin') {
        echo ' (team' . $item->team . ')';
    }

    ?>
                    </h5>
                    <!-- Product price-->
                    $ <span class="item-price"> <?php echo $item->price ?> </span>
                </div>
            </div>

        </div>
    </div>
    <?php $count++;}?>

</div>

<?php if ($count == 0) {?>
    <div class="ui message text-center">
        <div class="header">
            ไม่มีการสั่งซื้อสินค้าในระบบ
        </div>
        <p></p>
    </div>
    <style>
    table {
        display: none;
    }
    </style>
<?php }?>