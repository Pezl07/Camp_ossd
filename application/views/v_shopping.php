<style>
.rate-container {
    padding-bottom: 50px;
}
</style>

<?php 
    if($_SESSION['user']->role == 'admin')
        $team->score = 'ไม่จำกัด';

?>

<div class="rate-container mx-5">

    <?php 
        if($page == 1){
            if($_SESSION['user']->role != 'admin')
                $this->load->view('/menu_shopping/shopping_shop'); 
            else
                $this->load->view('/menu_shopping/shopping_shop_admin'); 
        }else{
            $this->load->view('/menu_shopping/shopping_cart'); 
        }
    ?>

</div>

<script>
function change_menu(page) {
    window.location.href = '<?php echo base_url(); ?>' + 'index.php/C_Shopping/show_shopping/' + page;
}
</script>