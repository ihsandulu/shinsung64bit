<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uncomplete extends MY_Controller
{

    private $db_kis = "";
    function __construct()
    {
        parent::__construct();
		$this->is_logedin();
		$this->lang->load('auth');
    }

        public function Inspect($line_ , $id_schedule) {
            // pre($this->session->userdata());
            $data['id_schedule']=$id_schedule;
            $data['line_']=$line_;

            $sql = " Select * from ref_uncompleted  "; 
            $data['unc_list'] = $this->db->query($sql)->result_array();
            $sql = " Select * from inspect_v2_uncomplete where id_schedule = $id_schedule "; 
            $data['unc_sch'] = $this->db->query($sql)->result_array();
            $this->load->view('Uncomplete/Endline/inputan', $data);

        }

        public function InsertUncompleteEndline($line_ , $id_schedule){
            pre($id_schedule);
            pre($_POST);
            $check = $this->input->post("checkboxList");

            $this->db->query("delete from inspect_v2_uncomplete where id_schedule = $id_schedule");

            foreach ($check as $key => $value) {
                // code...
                 $data['id_schedule'] = $id_schedule;
                 $data['uncomplete'] = $value;
                 $this->db->insert('inspect_v2_uncomplete' , $data);
            }
            $this->Inspect($line_ , $id_schedule);
            // exit();

        }

        public function Dashboard()
        {
            
              $data['pagetitle'] = 'DASHBOARD UNCOMPLETE ITEM ';
                $this->loadViews('Uncomplete/Dashboard/Dashboard_uncomplete', $data);
        }

         public function datauncomplete ()
        {
            $sql = " Select * from v_stuff_inspect_v2_uncomplete "; 
            $data['data'] = $this->db->query($sql)->result_array();
             $this->load->view('Uncomplete/Dashboard/datauncomplete', $data);

        }
        public function datauncompletejson()
        {
            $sql = " Select * from v_stuff_inspect_v2_uncomplete "; 
            $data = $this->db->query($sql)->result_array();
            echo json_encode($data);

        }






    
}