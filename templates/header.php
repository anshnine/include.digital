<?php
class ControllerExtensionModuleCakeorder extends Controller {
    private $error = array();

    public function index() {

        $this->language->load('extension/module/cakeorder');
        $json = array();
        $data['describe'] = $this->language->get('describe');
        if ($this->request->server['REQUEST_METHOD'] == 'POST' && isset($this->request->post['action'])) {

            if ($this->validate()) {

                $data = array();
                if (isset($this->request->post['name'])) {
                    $data['name'] = $this->request->post['name'];
                } else {
                    $data['name'] = '';
                }
                if (isset($this->request->post['phone'])) {
                    $data['phone'] = $this->request->post['phone'];
                } else {
                    $data['phone'] = '';
                }
                if (isset($this->request->post['comment'])) {
                    $data['comment'] = $this->request->post['comment'];
                } else {
                    $data['comment'] = '';
                }

                if (isset($this->request->post['file'])) {


                    $data['file'] = $this->request->post['file'];
                } else {
                    $data['file'] = '';
                }





                $this->sendMail($data,$this->request->post);


                $json['success'] = $this->language->get('ok');
            } else{

                $json['warning'] = $this->error;}


            return $this->response->setOutput(json_encode($json));




        }

    }
    private function validate() {


        $this->language->load('extension/module/cakeOrder');
        if ((strlen(utf8_decode($this->request->post['name'])) < 1) || (strlen(utf8_decode($this->request->post['name'])) > 32)) {

            $this->error['name'] = $this->language->get('mister');
        }
        if ((strlen(utf8_decode($this->request->post['phone'])) < 3) || (strlen(utf8_decode($this->request->post['phone'])) > 32)) {

            $this->error['phone'] = $this->language->get('wrongnumber');
        }

        if ((strlen(utf8_decode($this->request->post['comment'])) < 3))  {

            $this->error['comment'] = $this->language->get('wrongdescription');
        }


        if($this->request->post['file']!=''){


            $this->load->model('tool/upload');
            $upload_info = $this->model_tool_upload->getUploadByCode($this->request->post['file']);
            $info = new SplFileInfo($upload_info["name"]);
            $ext=$info->getExtension();

            if($ext != 'png' && $ext != 'jpeg'  && $ext != 'jpeg'  && $ext != 'jpg'  && $ext != 'bmp'  && $ext != 'svg'  && $ext != 'pdf'){

                $this->error['file'] = $this->language->get('wrongextension');
            }

        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function debug($object)
    {
        ob_start();
        print_r($object);
        $contents = ob_get_contents();
        ob_end_clean();
        error_log($contents, 3, "debug.log");
    }


    private function sendMail($data,$post) {

        // $subject = $this->language->get('subject');
        // $text 	= $this->language->get('text_1');
        // $text 	.= $this->language->get('cake') . ":\n";
        // $text 	.= $this->language->get('name').' '. $data['name'] . "\n";
        // $text 	.= $this->language->get('phone') . $data['phone'] . "\n";
        // $text 	.= $this->language->get('comment') . $data['comment'] . "\n";
        $subject = 'Вы получили описание нового торта от клиента';
        $text 	= "Вы получили заказ на новый торт."."\n" . "Имя клиента:"." ".$data['name']. "\n" . "Телефон клиента:".$data['phone']. "\n" . "Описание торта:".$data['comment'];



        $mail = new Mail($this->config->get('config_mail_engine'));
        $mail->parameter = $this->config->get('config_mail_parameter');
        $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
        $mail->smtp_username = $this->config->get('config_mail_smtp_username');
        $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
        $mail->smtp_port = $this->config->get('config_mail_smtp_port');
        $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
        $mail->setTo($this->config->get('config_email'));
        $mail->setFrom($this->config->get('config_email'));
        $mail->setSender($this->config->get('config_name'));
        $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
        $mail->setText(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));

        if($data['file']!=''){
            $this->load->model('tool/upload');
            $upload_info = $this->model_tool_upload->getUploadByCode($post['file']);

            $this->load->model('tool/upload');
            $upload_info = $this->model_tool_upload->getUploadByCode($post['file']);

            $phyname = DIR_UPLOAD.$upload_info['filename'];


            $temp_name = DIR_UPLOAD.$upload_info['name'];
            $this->debug("1");

            copy($phyname,$temp_name);
            $this->debug("2");
            $mail->AddAttachment($temp_name);

        }
        try{
            $mail->send();
            $this->debug("All is good");
        } catch (Exception $e) {
            $this->debug($mail->ErrorInfo);}
    }

if(isset($temp_name)){
unlink($temp_name);
}




}







}

class ControllerExtensionModuleCakeorder extends Controller
{
    private $error = array();

    public function index()
    {

        $this->language->load('extension/module/cakeorder');
        $json = array();
        $data['describe'] = $this->language->get('describe');
        if ($this->request->server['REQUEST_METHOD'] == 'POST' && isset($this->request->post['action'])) {

            if ($this->validate()) {

                $data = array();
                if (isset($this->request->post['name'])) {
                    $data['name'] = $this->request->post['name'];
                } else {
                    $data['name'] = '';
                }
                if (isset($this->request->post['phone'])) {
                    $data['phone'] = $this->request->post['phone'];
                } else {
                    $data['phone'] = '';
                }
                if (isset($this->request->post['comment'])) {
                    $data['comment'] = $this->request->post['comment'];
                } else {
                    $data['comment'] = '';
                }

                if (isset($this->request->post['file'])) {


                    $data['file'] = $this->request->post['file'];
                } else {
                    $data['file'] = '';
                }


                $this->sendMail($data, $this->request->post);


                $json['success'] = $this->language->get('ok');
            } else {

                $json['warning'] = $this->error;
            }


            return $this->response->setOutput(json_encode($json));


        }

    }

    private function validate()
    {


        $this->language->load('extension/module/cakeOrder');
        if ((strlen(utf8_decode($this->request->post['name'])) < 1) || (strlen(utf8_decode($this->request->post['name'])) > 32)) {

            $this->error['name'] = $this->language->get('mister');
        }
        if ((strlen(utf8_decode($this->request->post['phone'])) < 3) || (strlen(utf8_decode($this->request->post['phone'])) > 32)) {

            $this->error['phone'] = $this->language->get('wrongnumber');
        }

        if ((strlen(utf8_decode($this->request->post['comment'])) < 3)) {

            $this->error['comment'] = $this->language->get('wrongdescription');
        }


        if ($this->request->post['file'] != '') {


            $this->load->model('tool/upload');
            $upload_info = $this->model_tool_upload->getUploadByCode($this->request->post['file']);
            $info = new SplFileInfo($upload_info["name"]);
            $ext = $info->getExtension();

            if ($ext != 'png' && $ext != 'jpeg' && $ext != 'jpeg' && $ext != 'jpg' && $ext != 'bmp' && $ext != 'svg' && $ext != 'pdf') {

                $this->error['file'] = $this->language->get('wrongextension');
            }

        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function debug($object)
    {
        ob_start();
        print_r($object);
        $contents = ob_get_contents();
        ob_end_clean();
        error_log($contents, 3, "debug.log");
    }


    private function sendMail($data, $post)
    {

        // $subject = $this->language->get('subject');
        // $text 	= $this->language->get('text_1');
        // $text 	.= $this->language->get('cake') . ":\n";
        // $text 	.= $this->language->get('name').' '. $data['name'] . "\n";
        // $text 	.= $this->language->get('phone') . $data['phone'] . "\n";
        // $text 	.= $this->language->get('comment') . $data['comment'] . "\n";
        $subject = 'Вы получили описание нового торта от клиента';
        $text = "Вы получили заказ на новый торт." . "\n" . "Имя клиента:" . " " . $data['name'] . "\n" . "Телефон клиента:" . $data['phone'] . "\n" . "Описание торта:" . $data['comment'];


        $mail = new Mail($this->config->get('config_mail_engine'));
        $mail->parameter = $this->config->get('config_mail_parameter');
        $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
        $mail->smtp_username = $this->config->get('config_mail_smtp_username');
        $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
        $mail->smtp_port = $this->config->get('config_mail_smtp_port');
        $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
        $mail->setTo($this->config->get('config_email'));
        $mail->setFrom($this->config->get('config_email'));
        $mail->setSender($this->config->get('config_name'));
        $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
        $mail->setText(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));

        if ($data['file'] != '') {
            $this->load->model('tool/upload');
            $upload_info = $this->model_tool_upload->getUploadByCode($post['file']);

            $this->load->model('tool/upload');
            $upload_info = $this->model_tool_upload->getUploadByCode($post['file']);

            $phyname = DIR_UPLOAD . $upload_info['filename'];


            $temp_name = DIR_UPLOAD . $upload_info['name'];
            $this->debug("1");

            copy($phyname, $temp_name);
            $this->debug("2");
            $mail->AddAttachment($temp_name);

        }
            $mail->send();



if (isset($temp_name))
{
unlink($temp_name);
}


}


}