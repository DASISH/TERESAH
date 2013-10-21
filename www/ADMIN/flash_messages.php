<?php

function render_flash_message($flash) {
	
	$message = '';

	if(isset($flash['success']))
	{
		$message = '<div class="alert alert-success">';
		$message .= $flash['success'];
		$message .= '</div>';
	}

	if(isset($flash['info']))
	{
		$message = '<div class="alert alert-info">';
		$message .= $flash['info'];
		$message .= '</div>';
	}

	if(isset($flash['warning']))
	{
		$message = '<div class="alert alert-warning">';
		$message .= $flash['warning'];
		$message .= '</div>';
	}
	
	if(isset($flash['danger']))
	{
		$message = '<div class="alert alert-danger">';
		$message .= $flash['danger'];
		$message .= '</div>';
	}
	return $message;
}
?>