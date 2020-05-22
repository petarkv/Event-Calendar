<?php
    namespace App\Controllers;

    use App\Core\Controller;
    
    class ContactController extends Controller {
        
        public function getContact() {
                       
        }

        /*private function sendMail($user) {
            $userModel = new \App\Models\UserModel($this->getDatabaseConnection());
            $userLog = $userModel->getByFieldName('user_id');
            $userId = $this->getSession()->get('user_id');  
            
            $userModel = new \App\Models\UserModel($this->getDatabaseConnection());
            #$user = $userModel->getById
            
            $html = '<!doctype html><html><meta charset="utf-8"></head><body>';
            $html .= 'Gospodin ' . '{% name %}' . ' je postavio pitanje &quot;';
            $html .= \htmlspecialchars('{% message %}');
            #$html .= '&quot; sa iznosom ' . \sprintf("%.2f", $offer->price);
            $html .= '</body></html>';

            $mailer = new \PHPMailer\PHPMailer\PHPMailer();
            $mailer->isSMTP();
            $mailer->Host = \Configuration::MAIL_HOST;
            $mailer->Port = \Configuration::MAIL_PORT;
            $mailer->SMTPSecure = \Configuration::MAIL_PROTOCOL;
            $mailer->SMTPAuth = true;
            $mailer->Username = \Configuration::MAIL_USERNAME;
            $mailer->Password = \Configuration::MAIL_PASSWORD;

            $mailer->isHTML(true);
            $mailer->Body = $html;
            $mailer->Subject = '{% subject %}';
            $mailer->setFrom('{% email %}');

            $mailer->addAddress(\Configuration::MAIL_USERNAME);

            $mailer->send();
        }*/


        public function postContact() {

            
            
                $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);                
                $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
                $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);                
            
            #print_r([$name, $email, $subject, $message]);
            #exit; 
            
            /*$html = '<!doctype html><html><head><meta charset="utf-8"></head><body>';
            $html .= 'Gospodin ' . $name . ' je postavio pitanje &quot;';
            $html .= \htmlspecialchars($message);
            #$html .= '&quot; sa iznosom ' . \sprintf("%.2f", $offer->price);
            $html .= '</body></html>';*/

            $html = '<!doctype html><html><head><meta charset="utf-8"></head><body>';
            $html .= '<strong>Name: </strong>' . $name .'<br>';
            $html .= '<strong>Email: </strong>' . $email . '<br>';
            $html .= '<strong>Subject: </strong>' . $subject . '<br>';
            $html .= '<strong>Message</strong><br>';
            $html .= $message;

            $mailer = new \PHPMailer\PHPMailer\PHPMailer();
            $mailer->isSMTP();
            $mailer->Host = \Configuration::MAIL_HOST;
            $mailer->Port = \Configuration::MAIL_PORT;
            $mailer->SMTPSecure = \Configuration::MAIL_PROTOCOL;
            $mailer->SMTPAuth = true;
            $mailer->Username = \Configuration::MAIL_USERNAME;
            $mailer->Password = \Configuration::MAIL_PASSWORD;

            $mailer->isHTML(true);
            $mailer->Body = $html;
            $mailer->Subject = $subject;
            $mailer->setFrom($email);

            $mailer->addAddress('bookshareonline@gmail.com');

            
                $mailer->send();
            
                $this->set('message', 'Thank You for contacting us.');
        }
    }