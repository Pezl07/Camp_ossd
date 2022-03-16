<style>
.rate-container {
    padding-bottom: 50px;
}
</style>

<div class="rate-container mx-5">

    <?php 
        if($page == 1){
            $this->load->view('/menu_shopping/shopping_shop'); 
        }else{
            $this->load->view('/menu_shopping/setting_activities'); 
        }
    ?>

</div>