<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Camp_controller.php';

class C_Shopping extends Camp_controller {

    function show_shopping($page = 1) {

        if($_SESSION['user']->role == 'admin'){
            $team = '';
        }else{
            $team = $_SESSION['user']->team;
        }

        $data['team'] = $this->M_team->get_score($team);

        if($page == 1)
            $data['items'] = $this->M_item->get_item_list();
        else if($page == 2)
            $data['items'] = $this->M_order_item->get_order_list($team, date("Y-m-d"));

        $data['page'] = $page;

        // echo print_r($data);
        $this->output('v_shopping', $data);
	}

    function insert_order_ajax(){
        $obj_order = $this->input->post();
        $obj_order['date'] =  date("Y-m-d");

        $item = $this->M_item->get_item_by_item($obj_order['item']);
        $items = $this->M_order_item->get_check_order($obj_order['item'], $obj_order['date']);

        $count = 0;

        foreach ($items as $order){
            $count++;
        }

        if($count < $item->quota){
            $this->M_order_item->insert(intval($obj_order['team']), $obj_order['item'], $obj_order['type'], intval($obj_order['price']), $obj_order['date']);
            $this->M_team->update_score($obj_order['team'], $obj_order['score'] - $obj_order['price']);
            $message = 'สั่งซื้อสำเร็จ';
        }else{
            $message = 'เกินกำหนดการสั่งซื้อ';
        }

        echo json_encode($message);
    }

    function insert_item(){
        $obj_item = $this->input->post();
        $this->M_item->insert($obj_item['item'], $obj_item['type'], $obj_item['price'], $obj_item['quota']);
        redirect('C_Shopping/show_shopping');
    }

    function update_item(){
        $obj_item = $this->input->post();
        $this->M_item->update($obj_item['item_id'], $obj_item['item'], $obj_item['type'], $obj_item['price'], $obj_item['quota']);
        redirect('C_Shopping/show_shopping');
    }

    function test(){
        $items = $this->M_order_item->get_order_list(4, date("Y-m-d"));

        echo "<pre>";
        foreach($items as $item){
            print_r($item);
        }
        echo "</pre>";
    }
}
