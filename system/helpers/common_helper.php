<?php

if ( ! function_exists('get_request_type_string'))
{

	function get_request_type_string($request_type){
		return $request_type;
	}

	function get_request_url($request_type,$request_id,$record_id){
		if($request_type == 'confirm_client'){
			return "clients/confirm_client_details_request/".base64_encode($request_id)."/".base64_encode($record_id);
		}
	}

	

}

?>