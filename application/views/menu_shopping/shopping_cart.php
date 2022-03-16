<div class="menu-setting d-flex mb-3">
    <div class="type-activity text-center col-2 p-4" onclick="change_menu(1)">ร้านค้า</div>
    <div class="activities text-center col-2 p-4 active">ตะกร้า</div>
    <div class="add col-8">
        <div class="float-end m-4"> <?php echo $team->score ?> $SE</div>
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
                    <h5 class="fw-bolder item-name">
                        <?php 
                        echo $item->item;
                        if($_SESSION['user']->role == 'admin')
                            echo ' (team'.$item->team.')';
                        ?>
                    </h5>
                    <!-- Product price-->
                    $ <span class="item-price"> <?php echo $item->price ?> </span>
                </div>
            </div>
            <!-- Product actions-->
            <!-- <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark btn-danger text-white mt-auto" href="#">Add to cart</a></div>
            </div> -->

        </div>
    </div>
    <?php } ?>
</div>