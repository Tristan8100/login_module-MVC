<?php
    //session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    class controller {
        private $view;
        private $model;

        public function __construct ($v, $m){
            $this->view = $v;
            $this->model = $m;
        }

        public function processlogin($em, $pass){
            $compare = $this->model->loginselect($em);
            if($compare === false){
                echo "NO USER FOUND";
            } else {
                if(password_verify($pass, $compare['user_password'])){
                    if($compare['user_status'] != NULL){
                        $_SESSION['user_id'] = $compare['user_ID'];
                        header("Location: dashboard.php?logged='true'");
                        exit();
                    } else {
                        //not verified
                        $randomNumber = round(rand(1000, 9999) + rand() / getrandmax(), 4);
                        $rand = floor($randomNumber);
                        $inscode = $this->model->insertcode($rand, $compare['user_ID']);
                        if($inscode === true){
                            $this->sendmail($compare['user_email'], $rand);
                        }
                    }
                    
                } else {
                    echo "WRONG CREDENTIALS";
                }
            }
        }

        public function processcreate($uf, $us, $up){
            $hashedPassword = password_hash($up, PASSWORD_BCRYPT);

            $val = $this->model->createaccount($uf, $us, $hashedPassword);
            if($val === false){
                echo "SERVER ERROR ON CREATING ACCOUNT";
            } else {
                $randomNumber = round(rand(1000, 9999) + rand() / getrandmax(), 4);
                $rand = floor($randomNumber);
                $inscode = $this->model->insertcode($rand, $val['user_ID']);
                if($inscode === true){
                    $this->sendmail($val['user_email'], $rand);
                }
            }
        }

        public function sendmail($email, $rand){
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gtristan543@gmail.com';
            $mail->Password = 'beyd fvmz dhdl xkcb';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('gtristan543@gmail.com');
            $mail->addAddress($email); //marktristan260@gmail.com
            $mail->isHTML(true);
            $mail->Subject = "Verify Account";
            $mail->Body = "<a href='verify_account.php?codes=$rand'>Verify Account</a>";

            $mail->send();

            $message = 'Send Succesfully';

            header("Location: localhost/login_modulecreate_account.php?mess=" . urlencode($message));
        }

        public function verifyaccount($code){
            $val = $this->model->selectcode($code);
            echo "THE VALUE IS: ".$val['user_ID']."";
            $check = $this->model->updatestatus($val['user_ID']);
            if($check === true){
                header("location: login.php?verified='SUCCESS'");
            } else {
                echo "FAILED";
            }
        }

        public function forgorpass($em){
            $val = $this->model->loginselect($em);
            if($val){
                echo "yess";
                $randomNumber = round(rand(1000, 9999) + rand() / getrandmax(), 4);
                $rand = floor($randomNumber);
                $val2 = $this->model->insertcode($rand, $val['user_ID']);
                if($val2 === true){
                    $this->sendforgorpass($val['user_email'], $rand);
                } else {
                    echo "ERROR CODE";
                }
                
            } else {
                echo "WRONG EMAIL";
            }
        }

        public function sendforgorpass($email, $random){
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gtristan543@gmail.com';
            $mail->Password = 'beyd fvmz dhdl xkcb';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('gtristan543@gmail.com');
            $mail->addAddress($email); //marktristan260@gmail.com
            $mail->isHTML(true);
            $mail->Subject = "Forgor Password";
            $mail->Body = "<a href='localhost/login_module/forgot_password.php?codereset=$random'>Reset Password</a>";

            $mail->send();

            $message = 'Send Succesfully';
            header("location: forgot_password.php?messforgor='CHECK YOUR EMAIL'");
        }
        
        public function verifyreset($code){
            $check = $this->model->selectcode($code);
            if($check === false){
                echo "CHECK YOUR EMAIL AGAIN";
            } else {
                $_SESSION['user_id'] = $check['user_ID'];
                header("Location: dashboard.php?logged='true'");
            }
        }

    }

?>
