<?php

require APPPATH . '/libraries/REST_Controller.php';
Class Api Extends REST_Controller{

    // untuk menampilkan data dari database
    //function index_get(){
   // }
    // untuk mengirim data ke database
    function index_get(){
		$data=array(
			"id_sensor"  =>$_GET['id'],
			"ketinggian"  =>$_GET['ketinggian'],
		);
		$insert = $this->db->insert('data_ketinggian',$data);
        
        if($insert){
            $data = array ('status'=>'success insert');
            $this->response($data,200);
        }else{
            $data = array ('status'=>'gagal insert');
            $this->response($data,502);
        }
    }
}
?>
