<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test email to verify email configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? $this->ask('Enter email address to send test to');

        $this->info('Sending test email to: ' . $email);

        try {
            Mail::raw('This is a test email from your Laravel Todo Management System. If you received this, email is working correctly!', function ($message) use ($email) {
                $message->to($email)
                        ->subject('Test Email - Laravel Todo System');
            });

            $this->info('✅ Test email sent successfully!');
            $this->info('Check your email inbox (and spam folder) for the test message.');
        } catch (\Exception $e) {
            $this->error('❌ Failed to send email: ' . $e->getMessage());
            $this->info('Make sure your email configuration is correct.');
        }
    }
}
