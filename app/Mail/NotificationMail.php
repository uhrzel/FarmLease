<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $messageContent;

    public function __construct($subject, $messageContent)
    {
        $this->subject = $subject;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject($this->subject)
            ->html($this->generateEmailTemplate());
    }

    private function generateEmailTemplate()
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Email Notification</title>
            <style>
                body {
                    font-family: "Arial", sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background: #ffffff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                .content {
                    padding: 20px;
                    font-size: 16px;
                    color: #333;
                    line-height: 1.6;
                }
                .content p {
                    margin-bottom: 15px;
                }
                .footer {
                    background-color: #2d572c;
                    color: #ffffff;
                    text-align: center;
                    padding: 15px;
                    margin-top: 20px;
                    border-radius: 0 0 8px 8px;
                    font-size: 14px;
                }
                .footer p {
                    margin: 5px 0;
                }
                .farmlease-info {
                    font-style: italic;
                    font-size: 14px;
                    color: #eeeeee;
                    margin-top: 10px;
                }
                .highlight {
                    font-weight: bold;
                    color: #ffcc00;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="content">
                    ' . nl2br(htmlspecialchars($this->messageContent)) . '
                </div>
                <div class="footer">
                    <p>&copy; ' . date('Y') . ' FarmLease. All rights reserved.</p>
                    <p class="farmlease-info">
                        <span class="highlight">FarmLease</span> is a trusted platform connecting 
                        <b>landowners</b>, <b>lessees</b>, and <b>tenants</b> to create seamless agricultural partnerships. 
                        Whether you are looking to lease your farmland or find the perfect land for farming, 
                        FarmLease helps build sustainable and profitable relationships.
                    </p>
                </div>
            </div>
        </body>
        </html>
    ';
    }
}
