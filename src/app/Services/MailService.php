<?php

namespace App\Services;

use Core\Logger;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    private $mailer;
    private $fromAddress;
    private $fromName;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->fromAddress = $_ENV['MAIL_FROM_ADDRESS'];
        $this->fromName = $_ENV['MAIL_FROM_NAME'];
        $this->configure();
    }

    /**
     * Configure SMTP settings
     */
    private function configure()
    {
        try {
            // Server settings
            $this->mailer->isSMTP();
            $this->mailer->Host = $_ENV['MAIL_HOST'];
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $_ENV['MAIL_USER'];
            $this->mailer->Password = $_ENV['MAIL_PASS'];
            $this->mailer->SMTPSecure = $_ENV['MAIL_ENCRYPTION'] === 'ssl'
                ? PHPMailer::ENCRYPTION_SMTPS
                : PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = $_ENV['MAIL_PORT'];

            // Content settings
            $this->mailer->CharSet = 'UTF-8';
            $this->mailer->setFrom($this->fromAddress, $this->fromName);
        } catch (Exception $e) {
            $this->logError("Mail configuration error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Send email with HTML content
     *
     * @param string $to Recipient email
     * @param string $subject Email subject
     * @param string $body HTML content
     * @param string|null $altBody Plain text alternative
     * @return bool
     */
    public function send($to, $subject, $body, $altBody = null)
    {
        try {
            // Recipients
            $this->mailer->addAddress($to);

            // Content
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;

            if ($altBody) {
                $this->mailer->AltBody = $altBody;
            }

            $result = $this->mailer->send();

            // Clear addresses for next email
            $this->mailer->clearAddresses();

            return $result;
        } catch (Exception $e) {
            $this->logError("Mail send error: " . $this->mailer->ErrorInfo);
            return false;
        }
    }

    /**
     * Send email using template
     *
     * @param string $to Recipient email
     * @param string $subject Email subject
     * @param string $template Template name (without .php)
     * @param array $data Data to pass to template
     * @return bool
     */
    public function sendWithTemplate($to, $subject, $template, $data = [])
    {
        $body = $this->renderTemplate($template, $data);
        return $this->send($to, $subject, $body);
    }

    /**
     * Render email template
     *
     * @param string $template Template name
     * @param array $data Data for template
     * @return string
     */
    private function renderTemplate($template, $data)
    {
        $templatePath = __DIR__ . "/../Views/emails/{$template}.php";

        if (!file_exists($templatePath)) {
            throw new \Exception("Email template not found: {$template}");
        }

        extract($data);
        ob_start();
        include $templatePath;
        return ob_get_clean();
    }

    /**
     * Log errors to file
     *
     * @param string $message
     */
    private function logError($message)
    {
        Logger::error('Mail error', ['message' => $message]);
    }

    /**
     * Send verification email
     *
     * @param string $to
     * @param string $name
     * @param string $verificationLink
     * @return bool
     */
    public function sendVerificationEmail($to, $fullname, $activeLink)
    {
        return $this->sendWithTemplate($to, 'Xác thực tài khoản', 'verification', [
            'fullname' => $fullname,
            'activeLink' => $activeLink
        ]);
    }

    /**
     * Send password reset email
     *
     * @param string $to
     * @param string $name
     * @param string $resetLink
     * @return bool
     */
    public function sendPasswordResetEmail($to, $fullName, $resetLink)
    {
        return $this->sendWithTemplate($to, 'Đặt lại mật khẩu', 'reset-password', [
            'fullname' => $fullName,
            'resetLink' => $resetLink
        ]);
    }
    /**
     * Send password changed success email
     *
     * @param string $to  
     * @param string $fullName
     * @return bool
     */
    public function sendPasswordChangedEmail($to, $fullName)
    {
        return $this->sendWithTemplate($to, 'Đổi mật khẩu thành công', 'password-changed', [
            'fullname' => $fullName
        ]);
    }
}
