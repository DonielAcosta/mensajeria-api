<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;

class Welcome extends CI_Controller {

	public function index(){
   
		$this->load->view('welcome_message');

    // $sid = 'ACbb39d3c009896c990791cca070073524';
    // $token = 'a349af80027a4935985ceea4f740f349';

    // $number = "+14256007380";

    // $client = new Client($sid, $token);
    // $client->messages->create(
    //     '+584120749550',
    //     array(
    //         'from' => $number,
    //         'body' => 'probando drocerca!'
    //     )
    // );
	}

  public function hola(){
    echo "por aqui pase";
  }
/**
 * It takes a POST request with two parameters, cliente and id, and sends an SMS to the cliente's phone
 * number using the id as the message
 */
  // public function sendSMS($cliente,$id_templade) {
  public function sendSMS() {

    $cliente = $_POST['cliente'];   //option de prueba 
    $id_templade = $_POST['id'];    //option de prueba
    
    $this->load->model('mensajeria_model');
    $sms = $this->mensajeria_model->datacli($cliente);
    $templade = $this->mensajeria_model->templade($id_templade);
    //validaciones
    $cli =  $sms[0]->cliente;  // cliente en base de datos
    $cliNombre =  $sms[0]->nombre; 
    $numberCLI = $sms[0]->telefon2;   //numero del cliente a enviar mensaje 
    $templade = $templade[0]->templade;
    $smsDroc = $this->mensajeria_model->smsDroc($numberCLI,$templade);

    // print_r($smsDroc);
  }
}

