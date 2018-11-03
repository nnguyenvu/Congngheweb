<?php
Class order extends MY_Controller{
	function __construct(){
		parent::__construct();
		//Load file model
		$this->load->model('order_model');
	}
	//hien thi danh sach hoa don
	function index(){
		$this->load->model('order_model');
		//Lay tong so luong cac sp trong web
		$total_rows=$this->order_model->get_total();
		$this->data['total_rows']=$total_rows;
		//load thu vien phan trang
		$this->load->library('pagination');
		$config=array();
		$config['total_rows']=$total_rows;//Tong tat ca hoa don tren web
		$config['base_url']=base_url('admin/order/index');//Link hien thi trang sp
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
		
		
		//Lay danh sach hoa don
		$list=$this->order_model->get_list($input);
		$this->data['list']=$list;
		//pre($list);
		
		//lay noi dung cua bien message
		$message =$this->session->flashdata('message');
		$this->data['message']=$message;
		//load view
		 $this->data['temp'] = 'admin/order/index';
        $this->load->view('admin/main', $this->data);
	}
	
	
	
	function del(){
		
		$id=$this->uri->rsegment(3);
		$this->_del($id);
		//Tao ra thong bao
		$this->session->set_flashdata('message','Xóa hoa don thành công');
		redirect('admin/order');
	}
	function delete_all(){
		$this->load->model('order_model');
		 $this->load->library('form_validation');
        $this->load->helper('form');
		$ids=$this->input->post('ids');
		foreach ($ids as $id){
			$this->_del($id);
		}
		
	}
	//Xoa sp
	private function _del($id){
		$this->load->model('order_model');
		$order=$this->order_model->get_info($id);
		if(!$order){
			//Tao ra noi dung thong bao
			$this->session->set_flashdata('message','Không tồn tại hoa don này');
			redirect('admin/order');
		}
		//Thuc hien xoa sp
		$this->order_model->delete($id);
		
	}
	
	
	
	
}