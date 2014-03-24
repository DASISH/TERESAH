<?php

function render_flash_message($flash) {
	
	$message = '';

	if(isset($flash['success']))
	{
		$message .= '<div class="alert alert-success text-center">';
		$message .= '<strong>Success! </strong>';
		$message .= $flash['success'];
		$message .= '</div>';
	}

	if(isset($flash['info']))
	{
		$message .= '<div class="alert alert-info text-center">';
		$message .= '<strong>Info. </strong>';
		$message .= $flash['info'];
		$message .= '</div>';
	}

	if(isset($flash['warning']))
	{
		$message .= '<div class="alert alert-warning text-center">';
		$message .= '<strong>Warning! </strong>';
		$message .= $flash['warning'];
		$message .= '</div>';
	}
	
	if(isset($flash['danger']))
	{
		$message .= '<div class="alert alert-danger text-center">';
		$message .= '<strong>Error! </strong>';
		$message .= $flash['danger'];
		$message .= '</div>';
	}
	return $message;
}
?>