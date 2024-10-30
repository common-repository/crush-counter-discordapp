<?php

class Crush_Counter_Discordapp_Bot {
	
	private $nome;
	
	private $avatar;
	
	private $conteudo;
	
	private $webhook_url;
	
	public function __construct( $nome="", $avatar="", $conteudo="", $webhook_url="" ){
		
		$this->nome = $nome;
		
		$this->avatar = $avatar;
		
		$this->conteudo = $conteudo;
		
		$this->webhook_url = $webhook_url;
		 
	}
	
	public function falar(){
		
		
		
		$data = array(
				"username" => $this->nome,
				"avatar_url" => $this->avatar,
				"content"=>$this->conteudo
		
		);
		
		
		$data_string = json_encode($data);
		
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $this->webhook_url);                                                                   
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
			'Accept: application/json',                                                                         
		    'Content-Type: application/json'
		));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result  = curl_exec($ch);
		
		
		
		
		if (FALSE === $result){
			throw new Exception(curl_error($ch), curl_errno($ch));
		}
		curl_close($ch);
		return $result;		
		
		
		curl_close($ch);
	}
	
}