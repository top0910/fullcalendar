<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

require(FCPATH.('vendor/autoload.php'));

class Email extends MY_Controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model('global_model');

    }


    public function index() {

// 4. argument is the directory into which attachments are to be saved:
$mailbox = new PhpImap\Mailbox('{mail.strata365.com:993/imap/ssl/novalidate-cert}INBOX', 'info@strata365.com', '0ashu@GARG0', FCPATH."assets/email_files");

// Read all messaged into an array:
$mailsIds = $mailbox->searchMailbox('ALL');
if(!$mailsIds) {
    die('Mailbox is empty');
}

$mbox = imap_open ("{mail.strata365.com:993/imap/ssl/novalidate-cert}INBOX",  'info@strata365.com', '0ashu@GARG0' );
$check = imap_check($mbox);

$last_message = $check->Nmsgs-1;
echo "<pre>";
echo "Msg Count: ". $last_message . "\n";

// Get the first message and save its attachment(s) to disk:
$mail = $mailbox->getMail($mailsIds[$last_message]);
echo $mail->textHtml;

echo "\n\nAttachments:\n";
print_r($mail->getAttachments());

echo "<br/>";

$status = imap_status($mbox, "{mail.strata365.com}INBOX", SA_ALL);
if ($status) {
  echo "Messages:   " . $status->messages    . "<br />\n";
  echo "Recent:     " . $status->recent      . "<br />\n";
  echo "Unseen:     " . $status->unseen      . "<br />\n";
  echo "UIDnext:    " . $status->uidnext     . "<br />\n";
  echo "UIDvalidity:" . $status->uidvalidity . "<br />\n";
} else {
  echo "imap_status failed: " . imap_last_error() . "\n";
}

// imap_clearflag_full($mbox, 1 ,"//Seen");    // TO  SET THE STATUS OF THE EMAIL

echo "***************************************************************<br/>";
echo "****************  WRITTEN BY ASHWANI GARG *********************<br/>";
echo "***************************************************************<br/>";

// for ($i=0; $i <2 ; $i++) { 
// $mail = $mailbox->getMail($mailsIds[$i]);
// echo "<pre>";
// print_r($mail);
// echo $mail->textPlain;
// echo $mail->textHtml;
// echo "\n\nAttachments:\n";
// print_r($mail->getAttachments());
// }


    }





    public function quickemail()
    {
    

        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'mail.nsekey.com',
        'smtp_port' =>  587,
        'smtp_user' => 'strata@nsekey.com',    //email id
        'smtp_pass' => 'Jaimatadi@08',            // password
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1'
        );  
        
        $this->load->library('email', $config);      
    
    
        $to = $this->input->post('emailto');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

            $from_email = 'strata@nsekey.com';
            $this->email->set_newline("\r\n");
            $this->email->from($from_email, 'Strata365.com'); 
            $this->email->to($to);
            $this->email->subject($subject); 
            $this->email->message($message); 
            $this->email->set_mailtype('html');
            $sendmail = $this->email->send();

                      
            
            if($sendmail) 
            {
                $this->_msg('msg', 'Email sent successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();               
            } 
            else 
            {
                $this->_msg('msg', 'Email sent Unsuccessfull,Please try again');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();                   
            }      


    }

}
?>