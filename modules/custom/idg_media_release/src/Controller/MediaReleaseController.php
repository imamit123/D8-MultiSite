<?php
//use Drupal\Core\Database\Database;
namespace Drupal\idg_media_release\Controller;
use Drupal\Core\Controller\ControllerBase;
class MediaReleaseController  {
  public function idg_media_release_mail(){
    $config = \Drupal::config('idg_media_release.settings');
    $idg_mailbox = $config->get('idg_media_release.idg_mail_box');
    $idg_username = $config->get('idg_media_release.idg_username');
    $idg_password = $config->get('idg_media_release.idg_password');
    $mbox=$imap = imap_open( "{imap.gmail.com:993/imap/ssl}IDGPR", $idg_username, $idg_password) or die(imap_last_error()."<br>Connection Faliure!");
      $message_count = imap_num_msg($imap);
    if ($message_count == 0 ){
      return  array(
        '#markup' => '<p class="media-status">No new mails in pr@idgindia.com</p>', );
    }

    for ($msgno = 1; $msgno <= $message_count; $msgno++) {
      $header = imap_header($imap, $msgno); 
      $from = $header->from;
      $Name = $from[0]->personal;
      $email = $from[0]->mailbox . '@' . $from[0]->host;
      $author = $Name . "[" . $email . "]";
      $sub = $header->subject;
      //Add dummy subject if empty
      if(empty(trim($sub))){
        $sub = 'PLEASE INSERT SUBJECT';
      }
      
      //Subject goes as title
      $title =  htmlspecialchars($sub);
      
      // GET HTML BODY
      $dataTxt = $this->get_mail_part($mbox, $msgno, "TEXT/PLAIN");
      $dataHtml = $this->get_mail_part($mbox, $msgno, "TEXT/HTML");
      if ($dataHtml != "") {
        $msgBody = $dataHtml;
        $mailformat = "html/text";
      } else {
        $msgBody = preg_replace("\n","",$dataTxt);
        $mailformat = "html/text";
      }

      //Add dummy body text if empty
      if (empty(trim($msgBody))) {
        $msgBody = 'PLEASE INSERT BODY';
      }

      // To out put the message body to the user simply print $msgBody like this.
      if ($mailformat == "text") {
        $msgBody = "<html><head><title>Messagebody</title></head><body    bgcolor=\"white\">$msgBody</body></html>";
      }

      $values = array(
        'nid' => NULL,
        'type' => 'common_content',
        'status' => 0,
        'uid' => 1,
        'title' => $title,
        'body' => ['value' => $msgBody, 'format' => 'full_html'],
        'created'=> time(),
        'field_author_name' => $authour,
        'content_category' => 160
      );

      $node = entity_create('node', $values);
      $node->save();
    }
    for($msgno = 1; $msgno <= $message_count; $msgno++){
      imap_mail_move($mbox,$msgno,'MOVE_IDGPR'); 
    }
    imap_expunge($mbox);
    imap_close($mbox);
    return array (
      '#markup' => $message_count . " mails imported",
    );
  }

  //Function to get body text of mail
  public function get_mail_part($stream, $msg_number, $mime_type, $structure = false,$part_number    = false) { 
    if(!$structure) {
      $structure = imap_fetchstructure($stream, $msg_number);
    }
    if($structure) {
      if($mime_type == $this->get_mail_mime_type($structure)) {
        if(!$part_number) {
          $part_number = "1";
        }
        $text = imap_fetchbody($stream, $msg_number, $part_number);
        if($structure->encoding == 3) {
          return imap_base64($text);
        } else if($structure->encoding == 4) {
          return imap_qprint($text);
        } else {
        return $text;
      }
    }
    if($structure->type == 1) /* multipart */ {
      while(list($index, $sub_structure) = each($structure->parts)) {
        if($part_number) {
          $prefix = $part_number . '.';
        }else {
          $prefix =  '';
        }
        $data = $this->get_mail_part($stream, $msg_number, $mime_type, $sub_structure,$prefix .    ($index + 1));
        if($data) {
          return $data;
        }
      } // END OF WHILE
    } // END OF MULTIPART
  } // END OF STRUTURE
  return false;
  } // END OF FUNCTION 
  public function get_mail_mime_type(&$structure) {
    $primary_mime_type = array("TEXT", "MULTIPART","MESSAGE", "APPLICATION", "AUDIO","IMAGE", "VIDEO", "OTHER");
    if($structure->subtype) {
      return $primary_mime_type[(int) $structure->type] . '/' .$structure->subtype;
    }
    return "TEXT/PLAIN";
  }
}