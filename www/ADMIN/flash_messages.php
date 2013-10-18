<?php

	$flash_result = $app->view()->getData('flash');
	$message = '';
	
	if(isset($flash_result['success']))
	{
		$message = '<div class="alert alert-success">';
		$message .= $flash_result['success'];
		$message .= '</div>';
	}

	if(isset($flash_result['info']))
	{
		$message = '<div class="alert alert-info">';
		$message .= $flash_result['info'];
		$message .= '</div>';
	}

	if(isset($flash_result['warning']))
	{
		$message = '<div class="alert alert-warning">';
		$message .= $flash_result['warning'];
		$message .= '</div>';
	}
	
	if(isset($flash_result['danger']))
	{
		$message = '<div class="alert alert-danger">';
		$message .= $flash_result['danger'];
		$message .= '</div>';
	}
	
?>