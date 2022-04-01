<?php
defined('BASEPATH') or exit('No direct script access allowed');

require dirname(__FILE__) . '/Camp_controller.php';

class C_Setting extends Camp_controller
{

    public function show_setting($page = 1, $type_id = null, $day = null)
    {
        if ($_SESSION['user']->role == 'admin') {

            if (isset($type_id) && $type_id != 'ALL') {
                $type = $this->M_activity_type->get_activity_type($type_id);
                $data['type_id'] = $type->type_name;
            } else {
                $data['type_id'] = "ALL";
            }

            if (isset($day)) {
                $data['day'] = $day;
            } else {
                $data['day'] = '2022-04-07';
                // $data['day'] = date("Y-m-d");
            }

            $data['page'] = $page;

            $data['activity_types'] = $this->M_activity_type->get_activity_type_list();

            if ($page == 2) {
                $data['activities'] = $this->M_activity->get_activity_list($data['day'], $data['type_id']);
            }

            // echo "<pre>"; print_r($data); echo "</pre>";
            $this->output('v_setting', $data);

        } else {
            redirect('/');
        }
    }

    public function get_activity_type_ajax()
    {
        $activity_types = $this->M_activity_type->get_activity_type_list();
        $json_activity_types = array();
        foreach ($activity_types as $activity) {
            array_push($json_activity_types, $activity);
        }
        echo json_encode($json_activity_types);
    }

    public function insert_activity()
    {
        $obj_ac = $this->input->post();
        // print_r($obj_ac);
        $this->M_activity->insert($obj_ac['ac_name'], $obj_ac['ac_type'], $obj_ac['date'], $obj_ac['max_score']);
        $type = $this->M_activity_type->get_activity_type_by_name($obj_ac['ac_type']);
        redirect('/C_Setting/show_setting/2/' . $type->_id . '/' . $obj_ac['date']);
    }

    public function edit_activity()
    {
        $obj_ac = $this->input->post();
        // print_r($obj_ac);
        $this->M_activity->update($obj_ac['id'], $obj_ac['ac_name'], $obj_ac['ac_type'], $obj_ac['max_score']);
        $type = $this->M_activity_type->get_activity_type_by_name($obj_ac['ac_type']);
        redirect('/C_Setting/show_setting/2/' . $type->_id . '/' . $obj_ac['date']);
    }

    public function delete_activity()
    {
        $obj_ac = $this->input->post();
        // print_r($obj_ac);
        $this->M_activity->delete($obj_ac['delete_id']);
        $type = $this->M_activity_type->get_activity_type_by_name($obj_ac['type_name']);
        redirect('/C_Setting/show_setting/2/' . $type->_id . '/' . $obj_ac['date']);
    }

    public function insert_activity_type()
    {
        $obj_ac = $this->input->post();
        // print_r($obj_ac);
        $this->M_activity_type->insert($obj_ac['type_name']);
        redirect('/C_Setting/show_setting/');
    }

    public function edit_activity_type()
    {
        $obj_ac = $this->input->post();
        // print_r($obj_ac);
        $this->M_activity_type->update($obj_ac['id'], $obj_ac['type_name']);
        redirect('/C_Setting/show_setting/');
    }

    public function delete_activity_type()
    {
        $obj_ac = $this->input->post();
        // print_r($obj_ac);
        $this->M_activity_type->delete($obj_ac['delete_id']);
        redirect('/C_Setting/show_setting/');
    }

}