<?php
Class Order extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    //lay thong tin khach hang
    function checkout()
    {
        //thong gio hang
        $carts = $this->cart->contents();
        //tong so san pham co trong gio hang
        $total_items = $this->cart->total_items();
       
        if($total_items <= 0)
        {
            redirect();
        }
        //tong so tien can thanh toan
        $total_amount = 0;
        foreach ($carts as $row)
        {
            $total_amount = $total_amount + $row['subtotal'];  
        }
        $this->data['total_amount'] = $total_amount;
        
        //neu thanh vien da dang nhap thì lay thong tin cua thanh vien
        $user_id = 0;
        $user = '';
        if($this->session->userdata('user_id_login'))
        {
            //lay thong tin cua thanh vien
            $user_id = $this->session->userdata('user_id_login');
            $user = $this->user_model->get_info($user_id);
        }
        $this->data['user']  = $user;
        

        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('email', 'Email nhận hàng', 'required|valid_email');
            $this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required');
            $this->form_validation->set_rules('message', 'Ghi chú', 'required');
            $this->form_validation->set_rules('payment', 'Cổng thanh toán', 'required');
            
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                $payment = $this->input->post('payment');
                //them vao csdl
                 $data = array(
                    'status'   => 0, 
                    'user_id'  => $user_id, 
                    'user_email'    => $this->input->post('email'),
                    'user_name'     => $this->input->post('name'),
                    'user_phone'    => $this->input->post('phone'),
                    'message'       => $this->input->post('message'), 
                    'amount'        => $total_amount,
                    'payment'       => $payment, 
                    'created'       => now(),
                );
				
				
				
				//gui mail xac nhan
				$this->sendmail($_POST["email"],$_POST["name"]);
				
                 //them du lieu vao bang transaction
                $this->load->model('transaction_model');
                $this->transaction_model->create($data);
                $transaction_id = $this->db->insert_id();  //lấy ra id của giao dịch vừa thêm vào
                
                //them vao bảng order (chi tiết đơn hàng)
                $this->load->model('order_model');
                foreach ($carts as $row)
                {
                    $data = array(
                        'transaction_id' => $transaction_id,
                        'product_id'     => $row['id'],
                        'qty'            => $row['qty'],
                        'amount'         => $row['subtotal'],
                        'status'         => '0',
                    );
                    $this->order_model->create($data);
                }
				
				
                //xóa toàn bô giỏ hang
                $this->cart->destroy();
				if($payment=='offline'){
					   //tạo ra nội dung thông báo
					$this->session->set_flashdata('message', 'CHÚC MỪNG ! bạn đã đặt hàng thành công vào lúc 1 phút 30s , chúng tôi sẽ kiểm tra và gửi hàng ngay và luôn cho bạn');
					redirect(site_url());
				}
				if($payment=='visitshop'){
					$this->session->set_flashdata('message', 'Cảm ơn bạn đã quan tâm Shop ạ ! Shop sẽ gói sẵn hàng cho bạn , lưu ý : nếu quá 3 ngày bạn không đến shop nhận hàng thì đơn hàng sẽ hủy nhes hihi ^_^ ! ');
					redirect(site_url());
				}
				if($payment=='callphone'){
					$this->session->set_flashdata('message', 'Hãy nhắc phone lên và allo...anh à! phải anh hơm.... để đặt hàng nha hihi ^_^ ');
					redirect(site_url());
				}
				//neu thanh toan bang cong thanh toan 
               
                //chuyen tới trang danh sách quản trị viên
                redirect(site_url());
            }
        }
        
        
        //hiển thị ra view
        $this->data['temp'] = 'site/order/checkout';
        $this->load->view('site/layout', $this->data);
    }
	
	/*function result(){
		$this->load->model('trasaction_model');
		$transaction_id=$this->input->post('order_id');
		//Lay thong tin cua giao dich
		$transaction=$this->model->transaction_model->get_info($transaction_id);
		if(!$transaction){
			redirect();
		}
		
	}*/
	
	function sendmail($mail,$username){
		
		include('class.smtp.php');
		include "class.phpmailer.php"; 
		include "functions.php"; 
		$title = 'Hướng dẫn gửi mail bằng phpmailer';
		$content = 'Chúc mừng '.$username.'đã đặt hàng thành công ! Chúng tôi sẽ đem đên nhiều điều thú vị cho quý khách ! Xin chân thành cảm ơn  ';
		$nTo = $username;
		$mTo = $mail;
		$diachicc = 'duansupper@gmail.com';
		//test gui mail
		$mail = sendMail($title, $content, $nTo, $mTo,$diachicc='');
		/*if($mail==1)
		echo 'mail của bạn đã được gửi đi hãy kiếm tra hộp thư đến để xem kết quả. ';
		else echo 'Co loi!';*/
			
	
	
	}
}