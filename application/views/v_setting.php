<style>
.rate-container {
    padding-bottom: 50px;
}

table {
    background-color: #810000 !important;
    border-radius: 15px !important;
    padding-bottom: 50px !important;
}

table,
td,
th {
    border: none !important;
    padding: 20px 50px;
}

td {
    font-size: 20px;
    background-color: rgba(255, 255, 255, 0.5) !important;
}

th {
    color: white !important;
    background-color: rgba(0, 0, 0, 0.0) !important;
    font-size: 20px;
}

tr:not(:last-child) {
    border-spacing: 5em;
}

td:not(.right, .score, .type) {
    padding-right: 20px !important;
    border-radius: 20px 0px 0px 20px !important;
}

td.right {
    width: 20%;
    padding-right: 20px !important;
    border-radius: 0px 20px 20px 0px !important;
}

.name-ac,
.input-ac,
.max-score-ac,
.type-ac {
    background-color: white !important;
    border-radius: 20px !important;
    padding: 20px;
    width: 100%;
}

.ui.input input {
    text-align: center !important;
}

.action-ac .btn {
    width: 45%;
    height: 70px;
    color: white;
    font-size: 30px;
    font-weight: normal;
    border-radius: 10px !important;
}

.ui.blue.button {
    font-size: 20px;
}

@media only screen and (max-width: 800px) {

    tr {
        margin: 20px;
    }

    td:not(.score, .type) {
        border-radius: 20px 20px 0px 0px !important;
    }

    td.right {
        text-align: center !important;
        width: 20%;
        border-radius: 0px 0px 20px 20px !important;
    }
}
</style>

<div class="rate-container mx-5">

    <?php 
        if($page == 1){
            $this->load->view('/menu_setting/setting_type_activity'); 
        }else{
            $this->load->view('/menu_setting/setting_activities'); 
        }
    ?>

</div>

<script>
function change_menu(page) {
    window.location.href = '<?php echo base_url(); ?>' + 'index.php/C_Setting/show_setting/' + page;
}
</script>