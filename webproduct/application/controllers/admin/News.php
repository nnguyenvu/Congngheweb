<?php
Class News extends MY_Controller{
	function __construct(){
		parent::__construct();
		//Load file model
		$this->load->model('news_model');
	}
	//hien thi danh sach news
	function index(){
		$this->load->model('news_model');
		//Lay tong so luong cac bai viet trong web
		$total_rows=$this->news_model->get_total();
		$this->data['total_rows']=$total_rows;
		//load thu vien phan trang
		$this->load->library('pagination');
		$config=array();
		$config['total_rows']=$total_rows;//Tong tat ca news tren web
		$config['base_url']=base_url('admin/news/index');//Link hien thi trang bai viet
		$config['per_page']=5;//So luong bai viet hien thi trong 1 trang
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
		//Loc theo ten
		$title = $this->input->get('title');
		if($title){
			$input['like']=array('title',$title);
		}
		
		//Lay danh sach bai viet
		$list=$this->news_model->get_list($input);
		$this->data['list']=$list;
		//pre($list);
		
		
		
		//lay noi dung cua bien message
		$message =$this->session->flashdata('message');
		$this->data['message']=$message;
		//load view
		 $this->data['temp'] = 'admin/news/index';
        $this->load->view('admin/main', $this->data);
	}
	
	
	//them bai viet  moi
	function add(){
		
		$this->load->model('news_model');
		//Load thu vien validate lieu lieu 
		 $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
			$this->form_validation->set_rules('content', 'Nội dung tiêu đề', 'required');
            //nhập liệu chính xác
			if($_POST["title"]!=''&&$_POST["content"]!=''){
					$this->load->model('news_model');
					//lay ten file anh minh hoa duoc upload len
					$this->load->library('upload_library');
					$upload_path='./upload/news';
					$upload_data=$this->upload_library->upload($upload_path,'image');
					
					$image_link='';
					if(isset($upload_data['file_name'])){
						$image_link=$upload_data['file_name'];
						
					}
					//luu du lieu can them
					$data = array();
					$data['title']=$_POST["title"];
					
					$data['image_link']=$image_link;
					
					$data['meta_desc']=$_POST["meta_desc"];
					$data['meta_key']=$_POST["meta_key"];
					$data['content']=$_POST["content"];
					$data['created']=now();
					//them vao csdl
					if($this->news_model->create($data)){
						//Tao ra thong bao 
						$this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
						//echo count($data);
						
					}
					else{
						//echo'Khong them thanh cong';
						$this->session->set_flashdata('message','Không thêm được');
					}
					//chuyen den trang danh sach bai viet
					redirect('/admin/news/');
			
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
		 $this->data['temp'] = 'admin/news/add';
        $this->load->view('admin/main', $this->data);
	}
	//chinh sua bai viet
	function edit(){
		$id=$this->uri->rsegment('3');
		$id=intval($id);
		$news=$this->news_model->get_info($id);
		if(!$news){
			//Tao ra thong bao 
			$this->session->set_flashdata('message','Không tồn tại bài viết này');
			redirect('admin/news');
		}
		$this->data['news']=$news;
		//pre($news);
		
		//Load thu vien validate lieu lieu 
		 $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
			 $this->form_validation->set_rules('content', 'Nội dung bài viết ', 'required');
           
            
            //nhập liệu chính xác
			if(strlen($_POST["content"])>0&&$_POST["title"]!=''){
					$this->load->model('admin_model');
					//lay ten file anh minh hoa duoc upload len
					$this->load->library('upload_library');
					$upload_path='./upload/news';
					$upload_data=$this->upload_library->upload($upload_path,'image');
					
					$image_link='';
					if(isset($upload_data['file_name'])){
						$image_link=$upload_data['file_name'];
						
					}
					
					$data = array();
					$data['title']=$_POST["title"];
				
					
					$data['meta_desc']=$_POST["meta_desc"];
					$data['meta_key']=$_POST["meta_key"];
					$data['content']=$_POST["content"];
					$data['created']=now();
					
					if($image_link!=''){
						$data['image_link']=$image_link;
					
					}
					
					//them vao csdl
					if($this->news_model->update($news->id,$data)){
						//Tao ra thong bao 
						$this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
						//echo count($data);
						
					}
					else{
						//echo'Khong them thanh cong';
						$this->session->set_flashdata('message','Không thêm được');
					}
					//chuyen den trang danh sach bai viet
					redirect('/admin/news/');
			
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
		 $this->data['temp'] = 'admin/news/edit';
        $this->load->view('admin/main', $this->data);
	
	}
	function del(){
		
		$id=$this->uri->rsegment(3);
		$this->_del($id);
		//Tao ra thong bao
		$this->session->set_flashdata('message','Xóa bài viết thành công');
		redirect('admin/news');
	}
	function delete_all(){
		$this->load->model('news_model');
		 $this->load->library('form_validation');
        $this->load->helper('form');
		$ids=$this->input->post('ids');
		foreach ($ids as $id){
			$this->_del($id);
		}
		
	}
	//Xoa bai viet
	private function _del($id){
		$this->load->model('news_model');
		$news=$this->news_model->get_info($id);
		if(!$news){
			//Tao ra noi dung thong bao
			$this->session->set_flashdata('message','Không tồn tại bài viết này');
			redirect('admin/news');
		}
		//Thuc hien Xoa bai viet
		$this->news_model->delete($id);
		//Xoa cac anh cua bai viet
		$image_link='./upload/news/'.$news->image_link;
		if(file_exists($image_link)){
			unlink($image_link);
		}
		
	}
}