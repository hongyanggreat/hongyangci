<?php 
	function privilege($gr){
		if($gr == 'G'){
			redirect('/');
		}elseif($gr == 'M'){
			return 'm';
		}else{
			return 'a';
		}
	}