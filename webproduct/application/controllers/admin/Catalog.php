<?php
Class Catalog extends MY_Controller{
	 function __construct()
    {
        parent::__construct();
        $this->load->model('catalog_model');
    }
	//lay ra danh sach danh muc sp
	function index(){
		$list=$this->catalog_model->get_list();
		$this->data['list']=$list;
		//lay noi dung cua bien message
		$message =$this->session->flashdata('message');
		$this->data['message']=$message;
		//load view
		 $this->data['temp'] = 'admin/catalog/index';
        $this->load->view('admin/main', $this->data);
	}
	//them moi du lieu sp
	function add(){
		//Load thu vien validate lieu lieu 
		 $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên', 'required');
           
            
            //nhập liệu chính xác
			if(strlen($_POST["parent_id"])>0&&$_POST["name"]!=''&&$_POST["sort_order"]!=''){
					$this->load->model('admin_model');
					$data = array();
					$data['parent_id']=$_POST["parent_id"];
					$data['sort_order']=intval($_POST["sort_order"]);
					$data['name']=$_POST["name"];
					//them vao csdl
					if($this->catalog_model->create($data)){
						//Tao ra thong bao 
						$this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
						//echo count($data);
						
					}
					else{
						//echo'Khong them thanh cong';
						$this->session->set_flashdata('message','Không thêm được');
					}
					//chuyen den trang danh sach sp
					redirect('/admin/catalog/');
			
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
		
		//Lay danh sach danh muc cha
		$input=array();
		$input['where']=array('parent_id' => 0);
		$list=$this->catalog_model->get_list($input);
        $this->data['list']=$list;
        $this->data['temp'] = 'admin/catalog/add';
        $this->load->view('admin/main', $this->data);
		
	}
	
	
	//cap nhat du lieu
	function edit(){
		//Load thu vien validate lieu lieu 
		$this->load->model('catalog_model');
		$id=$this->uri->rsegment('3');
		$id=intval($id);
		 $this->load->library('form_validation');
        $this->load->helper('form');
        
		
		$info=$this->catalog_model->get_info($id);
		//pre($info);
		if(!$info){
			//Tao ra thong bao 
			$this->session->set_flashdata('message','Không tồn tại danh mục này');
			redirect('/admin/catalog/');
			
		}
		$this->data['info']=$info;
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên', 'required');
           
            
            //nhập liệu chính xác
			if(strlen($_POST["parent_id"])>0&&$_POST["name"]!=''&&$_POST["sort_order"]!=''){
					$this->load->model('admin_model');
					$data = array();
					$data['parent_id']=$_POST["parent_id"];
					$data['sort_order']=intval($_POST["sort_order"]);
					$data['name']=$_POST["name"];
					//them vao csdl
					if($this->catalog_model->update($id,$data)){
						//Tao ra thong bao 
						$this->session->set_flashdata('message','Cập nhật dữ liệu thành công');
						//echo count($data);
						
					}
					else{
						//echo'Khong them thanh cong';
						$this->session->set_flashdata('message','Không thêm được');
					}
					//chuyen den trang danh sach sp
					redirect('/admin/catalog/');
			
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
		
		//Lay danh sach danh muc cha
		$input=array();
		$input['where']=array('parent_id' => 0);
		$list=$this->catalog_model->get_list($input);
        $this->data['list']=$list;
        $this->data['temp'] = 'admin/catalog/edit';
        $this->load->view('admin/main', $this->data);
		
	}
	//Xoa danh muc san pham
	function delete(){
		$this->load->model('catalog_model');
		$id=$this->uri->rsegment('3');
		$id=intval($id);
		 $this->_del($id);
		
		//Tao ra thong bao
		$this->session->set_flashdata('message','Xóa danh mục thành công ');
		redirect('/admin/catalog/');
		
	}
	//Xoa nhieu danh muc
	function delete_all(){
		$ids=$this->input->post('ids');
		foreach($ids as $id){
			$this->_del($id,false);
		}
	}
	private function _del($id,$rediect = true){
		$this->load->model('catalog_model');
		$info=$this->catalog_model->get_info($id);
		//pre($info);
		if(!$info){
			//Tao ra thong bao 
			$this->session->set_flashdata('message','Không tồn tại danh mục này');
			if($rediect){
				redirect('/admin/catalog/');
			}
			else{
				return false;
			}
			
		}
		//Kiem tra xem danh muc nay co san pham khong 
		$this->load->model('product_model');
		$product=$this->product_model->get_info_rule(array('catalog_id'=>$id),'id');
		
		if($product){
			//Tao ra thong bao 
			$this->session->set_flashdata('message','Danh mục '.$info->name.' có chứa sản phẩm, yêu cầu xóa sản phẩm trong danh mục');
			if($rediect){
				redirect('/admin/catalog/');
			}
			else{
				return false;
			}
			
		}
		//Xoa du lieu
		$this->catalog_model->delete($id);
	}
}