<?php

// Quick email test script for Laravel Todo Management System
// Run with: php test_email.php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;

try {
    echo "Testing email configuration...\n";

    // Check current mail configuration
    $mailer = config('mail.default');
    echo "Current mailer: $mailer\n";

    if ($mailer === 'log') {
        echo "❌ Emails are being LOGGED, not sent!\n";
        echo "📝 Update your .env file to use SMTP or another mailer.\n";
        echo "📖 See MAIL_CONFIG_README.md for setup instructions.\n";
    } else {
        echo "✅ Mailer is configured to send emails.\n";

        // Test email sending
        echo "📧 Sending test email...\n";

        Mail::raw('Test email from Laravel Todo Management System', function($message) {
            $message->to('test@example.com') // Change this to your email
                    ->subject('Test Email - Laravel Todo System');
        });

        echo "✅ Test email sent successfully!\n";
        echo "📬 Check your email inbox (and spam folder).\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "💡 Check your mail configuration in .env file.\n";
}
