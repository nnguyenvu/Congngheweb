<?php
Class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }
    
    /*
     * Lay danh sach admin
     */
    function index()
    {
        $input = array();
        $list = $this->admin_model->get_list($input);
        $this->data['list'] = $list;
        
        $total = $this->admin_model->get_total();
        $this->data['total'] = $total;
        
		
		//lay noi dung cua bien message 
		$message =$this->session->flashdata('message');
		$this->data['message']=$message;
        $this->data['temp'] = 'admin/admin/index';
        $this->load->view('admin/main', $this->data);
    }
    
    
	//$check =true;
    function check_username()
    {
        //$username = $_POST["username"];
        $where = array( 'username'=>$_POST["username"]);
        //kiêm tra xem username đã tồn tại chưa
        if($this->admin_model->check_exists($where))
        {
            //trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Tài khoản đã tồn tại');
			//$check=false;
            return false;
        }
        return true;
    }
    
    //them quan tri vien
	 
    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
            $this->form_validation->set_rules('username', 'Tài khoản đăng nhập', 'required|callback_check_username');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            
            //nhập liệu chính xác
			if(strlen($_POST["name"])>=8&&$this->check_username()==true&&strlen($_POST["password"])>=6&&$_POST["password"]==$_POST["re_password"]&&strlen($_POST["username"])>0){
					$this->load->model('admin_model');
					$data = array();
					$data['username']=$_POST["username"];
					$data['password']=md5($_POST["password"]);
					$data['name']=$_POST["name"];
					if($this->admin_model->create($data)){
						//Tao ra thong bao 
						$this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
						//echo count($data);
						
					}
					else{
						//echo'Khong them thanh cong';
						$this->session->set_flashdata('message','Không thêm được');
					}
					//chuyen den trang quan tri vien
					redirect('/admin/admin/');
			
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
        
        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/main', $this->data);
		
		
    }
	//Ham chinh sua thong tin quan tri vien 
	function edit(){
			$this->load->model('admin_model');
			//Lay id cua quan tri vien can chinh sua
			$id= $this->uri->rsegment('3');
			$id=intval($id);
			$this->load->library('form_validation');
			$this->load->helper('form');
			//Lay thong tin cua quan tri vien
			$info=$this->admin_model->get_info($id);
			if(!$info){
				$this->session->set_flashdata('message','Không tồn tại quản trị viên thêm mới !');
				redirect('/admin/admin/');
				
			}
			
			$this->data['info']=$info;
			if($this->input->post()){
				 $this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
				$this->form_validation->set_rules('username', 'Tài khoản đăng nhập', 'required|callback_check_username');
				$data['password']=$_POST["password"];
				if(strlen($_POST["password"])>=6){
					$this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
					$this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
				}
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
					if($this->admin_model->update($id,$data)){
						//Tao ra thong bao 
						$this->session->set_flashdata('message','Cập nhật dữ liệu thành công');
						//echo count($data);
						
					}
					else{
						//echo'Khong them thanh cong';
						$this->session->set_flashdata('message','Không cập nhật được');
					}
					//chuyen den trang quan tri vien
					redirect('/admin/admin/');
				}*/
				
				if(strlen($_POST["name"])>=8&&strlen($_POST["username"])>0){
					$this->load->model('admin_model');
					$data = array();
					$data['username']=$_POST["username"];
					if(strlen($_POST["password"])>=6){
							$data['password']=md5($_POST["password"]);
					}
					if(strlen($_POST["password"])>0&&strlen($_POST["password"])<6){
							redirect('/admin/admin/edit/'.$id);
							
					}
					
					if($_POST["password"]!=$_POST["re_password"]){
							redirect('/admin/admin/edit/'.$id);
							
					}
					
					
				
					$data['name']=$_POST["name"];
					if($this->admin_model->update($id,$data)){
						//Tao ra thong bao 
						$this->session->set_flashdata('message','Cập nhật dữ liệu thành công');
						//echo count($data);
						
					}
					else{
						//echo'Khong them thanh cong';
						$this->session->set_flashdata('message','Không cập nhật được');
					}
					//chuyen den trang quan tri vien
					redirect('/admin/admin/');
			
				}
				
			}
			
			$this->data['temp']='admin/admin/edit' ;
			$this->load->view('admin/main',$this->data);
			
			
			
		}
	function delete(){
			$this->load->model('admin_model');
			$id=$this->uri->rsegment('3');
			$id=intval($id);
			//Lay thong tin cua quan tri vien
			$info=$this->admin_model->get_info($id);
			if(!$info){
				$this->session->set_flashdata('message','Không tồn tại quản trị viên');
				redirect('/admin/admin/');
				
			}
			//Thuc hien xoa 
			$this->admin_model->delete($id);
			$this->session->set_flashdata('message','xóa dữ liệu thành công');
			redirect('/admin/admin/');
			
		}	
	function delete_all(){
		$this->load->model('admin_model');
		for($id=0;;$id++){
			$info=$this->admin_model->get_info($id);
			if(!$info){
				redirect('/admin/admin/');
				break;
			}
			$this->admin_model->delete($id);
		}
		$this->session->set_flashdata('message','xóa dữ liệu thành công');
		redirect('/admin/admin/');
	} 
	
	//Dang xuat
	function logout()
    {
        if($this->session->userdata('login'))
        {
            $this->session->unset_userdata('login');
			
        }
        redirect('/admin/login');
    }
}



