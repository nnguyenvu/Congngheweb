<?php
Class Product extends MY_Controller{
	function __construct(){
		parent::__construct();
		//Load file model
		$this->load->model('product_model');
	}
	//hien thi danh sach san pham
	function index(){
		$this->load->model('product_model');
		//Lay tong so luong cac sp trong web
		$total_rows=$this->product_model->get_total();
		$this->data['total_rows']=$total_rows;
		//load thu vien phan trang
		$this->load->library('pagination');
		$config=array();
		$config['total_rows']=$total_rows;//Tong tat ca san pham tren web
		$config['base_url']=base_url('admin/product/index');//Link hien thi trang sp
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
		//Loc theo ten
		$name = $this->input->get('name');
		if($name){
			$input['like']=array('name',$name);
		}
		//loc theo loai sp
		$catalog_id=$this->input->get('catalog');
		$catalog_id=intval($catalog_id);
		if($catalog_id>0){
			$input['where']['catalog_id']=$catalog_id;
		}
		//Lay danh sach san pham
		$list=$this->product_model->get_list($input);
		$this->data['list']=$list;
		//pre($list);
		
		
		//Lay danh sach danh sach danh muc san pham 
		$this->load->model('catalog_model');
		$input=array();
		$input['where']=array('parent_id'=>0);
		
		$catalogs=$this->catalog_model->get_list($input);
		foreach($catalogs as $row){
			$input['where']=array('parent_id'=>$row->id);
			$subs=$this->catalog_model->get_list($input);
			$row->subs=$subs;
			
		}
		//pre($catalogs);
		$this->data['catalogs']=$catalogs;
		//lay noi dung cua bien message
		$message =$this->session->flashdata('message');
		$this->data['message']=$message;
		//load view
		 $this->data['temp'] = 'admin/product/index';
        $this->load->view('admin/main', $this->data);
	}
	
	
	//them sp moi
	function add(){
		//Lay danh sach danh sach danh muc san pham 
		$this->load->model('catalog_model');
		$input=array();
		$input['where']=array('parent_id'=>0);
		
		$catalogs=$this->catalog_model->get_list($input);
		foreach($catalogs as $row){
			$input['where']=array('parent_id'=>$row->id);
			$subs=$this->catalog_model->get_list($input);
			$row->subs=$subs;
			
		}
		//pre($catalogs);
		$this->data['catalogs']=$catalogs;
		
		//Load thu vien validate lieu lieu 
		 $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên', 'required');
			 $this->form_validation->set_rules('catalog', 'Thể loại', 'required');
			  $this->form_validation->set_rules('price', 'Giá', 'required');
           
            
            //nhập liệu chính xác
			if(strlen($_POST["catalog"])>0&&$_POST["name"]!=''&&$_POST["price"]!=''){
					$this->load->model('admin_model');
					//lay ten file anh minh hoa duoc upload len
					$this->load->library('upload_library');
					$upload_path='./upload/product';
					$upload_data=$this->upload_library->upload($upload_path,'image');
					
					$image_link='';
					if(isset($upload_data['file_name'])){
						$image_link=$upload_data['file_name'];
						
					}
					//upload cac anh kem theo
					$image_list=array();
					$image_list=$this->upload_library->upload_file($upload_path,'image_list[]');
					$image_list=json_encode($image_list);
					$data = array();
					$data['catalog_id']=$_POST["catalog"];
					$data['price']=str_replace(',','',$_POST["price"]);
					$data['image_link']=$image_link;
					$data['name']=$_POST["name"];
					$data['image_list']=$image_list;
					$data['discount']=str_replace(',','',$_POST["discount"]);
					$data['warranty']=$_POST["warranty"];
					$data['gifts']=$_POST["gifts"];
					$data['site_title']=$_POST["site_title"];
					$data['meta_desc']=$_POST["meta_desc"];
					$data['meta_key']=$_POST["meta_key"];
					$data['content']=$_POST["content"];
					$data['created']=now();
					//them vao csdl
					if($this->product_model->create($data)){
						//Tao ra thong bao 
						$this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
						//echo count($data);
						
					}
					else{
						//echo'Khong them thanh cong';
						$this->session->set_flashdata('message','Không thêm được');
					}
					//chuyen den trang danh sach sp
					redirect('/admin/product/');
			
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
		 $this->data['temp'] = 'admin/product/add';
        $this->load->view('admin/main', $this->data);
	}
	//chinh sua sp
	function edit(){
		$id=$this->uri->rsegment('3');
		$id=intval($id);
		$product=$this->product_model->get_info($id);
		if(!$product){
			//Tao ra thong bao 
			$this->session->set_flashdata('message','Không tồn tại sản phẩm này');
			redirect('admin/product');
		}
		$this->data['product']=$product;
		//pre($product);
		//Lay danh sach danh sach danh muc san pham 
		$this->load->model('catalog_model');
		$input=array();
		$input['where']=array('parent_id'=>0);
		
		$catalogs=$this->catalog_model->get_list($input);
		foreach($catalogs as $row){
			$input['where']=array('parent_id'=>$row->id);
			$subs=$this->catalog_model->get_list($input);
			$row->subs=$subs;
			
		}
		//pre($catalogs);
		$this->data['catalogs']=$catalogs;
		
		//Load thu vien validate lieu lieu 
		 $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên', 'required');
			 $this->form_validation->set_rules('catalog', 'Thể loại', 'required');
			  $this->form_validation->set_rules('price', 'Tên', 'required');
           
            
            //nhập liệu chính xác
			if(strlen($_POST["catalog"])>0&&$_POST["name"]!=''&&$_POST["price"]!=''){
					$this->load->model('admin_model');
					//lay ten file anh minh hoa duoc upload len
					$this->load->library('upload_library');
					$upload_path='./upload/product';
					$upload_data=$this->upload_library->upload($upload_path,'image');
					
					$image_link='';
					if(isset($upload_data['file_name'])){
						$image_link=$upload_data['file_name'];
						
					}
					//upload cac anh kem theo
					$image_list=array();
					$image_list=$this->upload_library->upload_file($upload_path,'image_list[]');
					
					$image_list_json=json_encode($image_list);
					$data = array();
					$data['catalog_id']=$_POST["catalog"];
					$data['price']=str_replace(',','',$_POST["price"]);
					
					$data['name']=$_POST["name"];
					$data['discount']=str_replace(',','',$_POST["discount"]);
					$data['warranty']=$_POST["warranty"];
					$data['gifts']=$_POST["gifts"];
					$data['site_title']=$_POST["site_title"];
					$data['meta_desc']=$_POST["meta_desc"];
					$data['meta_key']=$_POST["meta_key"];
					$data['content']=$_POST["content"];
					
					if($image_link!=''){
						$data['image_link']=$image_link;
					
					}
					if(!empty($image_list)){
						//$data['image_link']=$image_link;
						$data['image_list']=$image_list_json;
					}
					//them vao csdl
					if($this->product_model->update($product->id,$data)){
						//Tao ra thong bao 
						$this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
						//echo count($data);
						
					}
					else{
						//echo'Khong them thanh cong';
						$this->session->set_flashdata('message','Không thêm được');
					}
					//chuyen den trang danh sach sp
					redirect('/admin/product/');
			
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
		 $this->data['temp'] = 'admin/product/edit';
        $this->load->view('admin/main', $this->data);
	
	}
	function del(){
		
		$id=$this->uri->rsegment(3);
		$this->_del($id);
		//Tao ra thong bao
		$this->session->set_flashdata('message','Xóa sản phẩm thành công');
		redirect('admin/product');
	}
	function delete_all(){
		$this->load->model('product_model');
		 $this->load->library('form_validation');
        $this->load->helper('form');
		$ids=$this->input->post('ids');
		foreach ($ids as $id){
			$this->_del($id);
		}
		
	}
	//Xoa sp
	private function _del($id){
		$this->load->model('product_model');
		$product=$this->product_model->get_info($id);
		if(!$product){
			//Tao ra noi dung thong bao
			$this->session->set_flashdata('message','Không tồn tại sản phẩm này');
			redirect('admin/product');
		}
		//Thuc hien xoa sp
		$this->product_model->delete($id);
		//Xoa cac anh cua sp
		$image_link='./upload/product/'.$product->image_link;
		if(file_exists($image_link)){
			unlink($image_link);
		}
		//xoa cac anh kem theo sp
		$image_list = json_decode($product->image_list);
		if(is_array($image_list)){
			foreach($image_list as $img){
				$image_link='./upload/product/'.$img;
				if(file_exists($image_link)){
					unlink($image_link);
				}
			}
		}
	}
}