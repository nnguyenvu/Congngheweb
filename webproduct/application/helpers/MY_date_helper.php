<?php 
//Lay ngay tu dang int 
function get_date($time,$full_time=true){
	$fomat='%D-%M-%Y';
	if($full_time){
		$fomat=$fomat.' - %H:%i:%s';
	}
	$date=mdate($fomat,$time);
	return $date;
}