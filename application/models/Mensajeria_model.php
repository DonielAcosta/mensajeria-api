<?php
use Twilio\Rest\Client;

class Mensajeria_model extends CI_Model {

  public function __construct() {
      $this->load->database(); 
  }
    
  /**
   * It returns a query object
   * 
   * @return The query result.
   */
  public function datacli($cliente){
      
    $this->db->select(array('cliente','telefon2','nombre'));
    $this->db->from('scli');
    $this->db->where('cliente', $cliente);
    $query = $this->db->get();
    return $query->result();
    // $datCli = $this->db->query("SELECT cliente,telefon2 FROM scli Where cliente $cliente");
    
    // return $datCli;
  }

  /**
   * It returns a query object
   */
  public function templade($id_templade){
    
    $this->db->select(array('id','templade'));
    $this->db->from('plantilla');
    $this->db->where('id', $id_templade);
    $temp = $this->db->get();
    return $temp->result();
  }

 /**
  * The above function sends an SMS to the number that is passed as a parameter.
  * 
  * @param numberCLI The phone number you want to send the message to.
  * @param templade The message you want to send, up to 160 characters.
  */
  public function smsDroc($numberCLI,$templade){

    $numberCLI =str_replace(' ', '', $numberCLI); // para que no tenga espacios en blanco
    $numberCLI = preg_replace('/-/', '', $numberCLI); // para que no tenga -
    $numberCLI = substr($numberCLI, 1); // empiece desde primera posicion ejemplo 4120749550
    
    $sid = 'AC74b37b5b168fe4404c0bad64653dd083';
    $token = '5cd9b457c52b8b933996b951853da487';

    $number = "+15139606320"; // numero asignado por plataforma

    $client = new Client($sid, $token);
    $client->messages->create(
      '+58'.$numberCLI,
        array(
            'from' =>$number,
            'body' => $templade
        )
    );
    print('enviando con exito '); // mensaje para visualizar en posman terminal o web pruebas 
  }
}
?>
