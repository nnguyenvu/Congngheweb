<?php
Class transaction extends MY_Controller{
	function __construct(){
		parent::__construct();
		//Load file model
		$this->load->model('transaction_model');
	}
	//hien thi danh sach giao dich
	function index(){
		$this->load->model('transaction_model');
		//Lay tong so luong cac sp trong web
		$total_rows=$this->transaction_model->get_total();
		$this->data['total_rows']=$total_rows;
		//load thu vien phan trang
		$this->load->library('pagination');
		$config=array();
		$config['total_rows']=$total_rows;//Tong tat ca giao dich tren web
		$config['base_url']=base_url('admin/transaction/index');//Link hien thi trang sp
		$config['per_page']=5;//So luong sp hien thi trong 1 trang
		$config['uri_segment']=4;//Phan doan hien thi ra so trang 
		$config['next_link']='Trang kế tiếp';
		$config['prev_link']='Trang trước';
		//Khoi tao cac cau hinh phan trang 
		$this->pagination->initialize($config);
		$segment=$this->uri->segment(4);
		$segment=intval($segment);
		$input=array();
		$input['limit']=array($config['per_page'],$segment);
		//Kiem tra co thuc hien loc du lieu hay khong 
		$id=$this->input->get('id');
		$id=intval($id);
		$input['where']=array();
		if($id>0){
			$input['where']['id']=$id;
		}
		
		
		//Lay danh sach giao dich
		$list=$this->transaction_model->get_list($input);
		$this->data['list']=$list;
		//pre($list);
		
		//lay noi dung cua bien message
		$message =$this->session->flashdata('message');
		$this->data['message']=$message;
		//load view
		 $this->data['temp'] = 'admin/transaction/index';
        $this->load->view('admin/main', $this->data);
	}
	
	
	
	function del(){
		
		$id=$this->uri->rsegment(3);
		$this->_del($id);
		//Tao ra thong bao
		$this->session->set_flashdata('message','Xóa giao dịch thành công');
		redirect('admin/transaction');
	}
	function delete_all(){
		$this->load->model('transaction_model');
		 $this->load->library('form_validation');
        $this->load->helper('form');
		$ids=$this->input->post('ids');
		foreach ($ids as $id){
			$this->_del($id);
		}
		
	}
	//Xoa sp
	private function _del($id){
		$this->load->model('transaction_model');
		$transaction=$this->transaction_model->get_info($id);
		if(!$transaction){
			//Tao ra noi dung thong bao
			$this->session->set_flashdata('message','Không tồn tại giao dịch này');
			redirect('admin/transaction');
		}
		//Thuc hien xoa sp
		$this->transaction_model->delete($id);
		
	}
	
	
	
	//Ham chinh sua thong tin gia dich 
	function edit(){
			$this->load->model('transaction_model');
			//Lay id cua gia dich can chinh sua
			$id= $this->uri->rsegment('3');
			$id=intval($id);
			$this->load->library('form_validation');
			$this->load->helper('form');
			//Lay thong tin cua gia dich
			$info=$this->transaction_model->get_info($id);
			if(!$info){
				$this->session->set_flashdata('message','Không tồn tại giao dịch thêm mới !');
				redirect('/admin/transaction/');
				
			}
			
			$this->data['info']=$info;
			if($this->input->post()){
				
            $this->form_validation->set_rules('status', 'Trạng thái', 'required');
         
            
				/*if($this->form_validation->run()){
					//them vao csdl
					$name     = $this->input->post('name');
					$username = $this->input->post('username');
					
					
					$data = array(
						'name'     -> $name,
						'username' -> $username,
						
					);
					//Neu thay doi mat khau thi gan du lieu
					if($password){
						$data['password']=md5($password);
					}
					echo"alex(data['name'])";
					if($this->transaction_model->update($id,$data)){
						//Tao ra thong bao 
						$this->session->set_flashdata('message','Cập nhật dữ liệu thành công');
						//echo count($data);
						
					}
					else{
						//echo'Khong them thanh cong';
						$this->session->set_flashdata('message','Không cập nhật được');
					}
					//chuyen den trang gia dich
					redirect('/transaction/transaction/');
				}*/
				
				if(strlen($_POST["status"])>0){
					$this->load->model('transaction_model');
					$data = array();
					$data['status']=$_POST["status"];

					if($this->transaction_model->update($id,$data)){
						//Tao ra thong bao 
						$this->session->set_flashdata('message','Cập nhật dữ liệu thành công');
						//echo count($data);
						
					}
					else{
						//echo'Khong them thanh cong';
						$this->session->set_flashdata('message','Không cập nhật được');
					}
					//chuyen den trang gia dich
					redirect('/admin/transaction/');
			
				}
				
			}
			
			$this->data['temp']='admin/transaction/edit' ;
			$this->load->view('admin/main',$this->data);
			
			
			
		}
}