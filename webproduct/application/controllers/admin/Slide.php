<?php
Class Slide extends MY_Controller{
	function __construct(){
		parent::__construct();
		//Load file model
		$this->load->model('slide_model');
	}
	//hien thi danh sach slide
	function index(){
		$this->load->model('slide_model');
		//Lay tong so luong cac slide trong web
		$total_rows=$this->slide_model->get_total();
		$this->data['total_rows']=$total_rows;
		
		$input=array();
		
		
		
		//Lay danh sach slide
		$list=$this->slide_model->get_list($input);
		$this->data['list']=$list;
		//pre($list);
		
		
		
		//lay noi dung cua bien message
		$message =$this->session->flashdata('message');
		$this->data['message']=$message;
		//load view
		 $this->data['temp'] = 'admin/slide/index';
        $this->load->view('admin/main', $this->data);
	}
	
	
	//them slide  moi
	function add(){
		
		$this->load->model('slide_model');
		//Load thu vien validate lieu lieu 
		 $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tiêu đề', 'required');
			
            //nhập liệu chính xác
			if($_POST["name"]!=''){
					$this->load->model('slide_model');
					//lay ten file anh minh hoa duoc upload len
					$this->load->library('upload_library');
					$upload_path='./upload/slide';
					$upload_data=$this->upload_library->upload($upload_path,'image');
					
					$image_link='';
					if(isset($upload_data['file_name'])){
						$image_link=$upload_data['file_name'];
						
					}
					//luu du lieu can them
					$data = array();
					$data['name']=$_POST["name"];
					
					$data['image_link']=$image_link;
					
					$data['link']=$_POST["link"];
					$data['info']=$_POST["info"];
					$data['sort_order']=$_POST["sort_order"];
					
					//them vao csdl
					if($this->slide_model->create($data)){
						//Tao ra thong bao 
						$this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
						//echo count($data);
						
					}
					else{
						//echo'Khong them thanh cong';
						$this->session->set_flashdata('message','Không thêm được');
					}
					//chuyen den trang danh sach slide
					redirect('/admin/slide/');
			
			}
            if($this->form_validation->run())
            {
                //them vao csdl
                /*$name     = $this->input->post('name');
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                
                $data = array(
                    'name'     -> $name,
                    'username' -> $username,
                    'password' -> md5($password)
                );
				echo"alex(data['name'])";
                if($this->admin_model->create($data))
                {
                    echo 'Them thanh cong';
                }else{
                    echo 'Khong them thanh cong';
                }*/
				
            }
		}
		//load view
		 $this->data['temp'] = 'admin/slide/add';
        $this->load->view('admin/main', $this->data);
	}
	//chinh sua slide
	function edit(){
		$id=$this->uri->rsegment('3');
		$id=intval($id);
		$slide=$this->slide_model->get_info($id);
		if(!$slide){
			//Tao ra thong bao 
			$this->session->set_flashdata('message','Không tồn tại bài viết này');
			redirect('admin/slide');
		}
		$this->data['slide']=$slide;
		//pre($slide);
		
		//Load thu vien validate lieu lieu 
		 $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
           $this->form_validation->set_rules('name', 'Tiêu đề', 'required');
           
            
            //nhập liệu chính xác
			if($_POST["name"]!=''){
					$this->load->model('slide_model');
					//lay ten file anh minh hoa duoc upload len
					$this->load->library('upload_library');
					$upload_path='./upload/slide';
					$upload_data=$this->upload_library->upload($upload_path,'image');
					
					$image_link='';
					if(isset($upload_data['file_name'])){
						$image_link=$upload_data['file_name'];
						
					}
					
					//luu du lieu can them
					$data = array();
					$data['name']=$_POST["name"];
					
			
					
					$data['link']=$_POST["link"];
					$data['info']=$_POST["info"];
					$data['sort_order']=$_POST["sort_order"];
					
					if($image_link!=''){
						$data['image_link']=$image_link;
					
					}
					
					//them vao csdl
					if($this->slide_model->update($slide->id,$data)){
						//Tao ra thong bao 
						$this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
						//echo count($data);
						
					}
					else{
						//echo'Khong them thanh cong';
						$this->session->set_flashdata('message','Không thêm được');
					}
					//chuyen den trang danh sach slide
					redirect('/admin/slide/');
			
			}
            if($this->form_validation->run())
            {
                //them vao csdl
                /*$name     = $this->input->post('name');
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                
                $data = array(
                    'name'     -> $name,
                    'username' -> $username,
                    'password' -> md5($password)
                );
				echo"alex(data['name'])";
                if($this->admin_model->create($data))
                {
                    echo 'Them thanh cong';
                }else{
                    echo 'Khong them thanh cong';
                }*/
				
            }
		}
		//load view
		 $this->data['temp'] = 'admin/slide/edit';
        $this->load->view('admin/main', $this->data);
	
	}
	function del(){
		
		$id=$this->uri->rsegment(3);
		$this->_del($id);
		//Tao ra thong bao
		$this->session->set_flashdata('message','Xóa bài viết thành công');
		redirect('admin/slide');
	}
	function delete_all(){
		$this->load->model('slide_model');
		 $this->load->library('form_validation');
        $this->load->helper('form');
		$ids=$this->input->post('ids');
		foreach ($ids as $id){
			$this->_del($id);
		}
		
	}
	//Xoa slide
	private function _del($id){
		$this->load->model('slide_model');
		$slide=$this->slide_model->get_info($id);
		if(!$slide){
			//Tao ra noi dung thong bao
			$this->session->set_flashdata('message','Không tồn tại bài viết này');
			redirect('admin/slide');
		}
		//Thuc hien Xoa slide
		$this->slide_model->delete($id);
		//Xoa cac anh cua slide
		$image_link='./upload/slide/'.$slide->image_link;
		if(file_exists($image_link)){
			unlink($image_link);
		}
		
	}
}