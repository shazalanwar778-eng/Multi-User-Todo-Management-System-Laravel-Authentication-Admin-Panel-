# Email Configuration Guide for Laravel Todo Management System

## Current Issue
Your Laravel application is configured to **log emails** instead of sending them. This is why you don't receive signup verification emails.

## Quick Fix - Option 1: Use Mailtrap (Recommended for Development)

1. **Create a free account at [Mailtrap](https://mailtrap.io)**

2. **Get your SMTP credentials:**
   - Go to your Mailtrap inbox
   - Click on "SMTP Settings"
   - Copy the credentials

3. **Update your `.env` file:**
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=your_mailtrap_username
   MAIL_PASSWORD=your_mailtrap_password
   MAIL_ENCRYPTION=null
   MAIL_FROM_ADDRESS="noreply@yourapp.com"
   MAIL_FROM_NAME="${APP_NAME}"
   ```

## Option 2: Use Gmail SMTP

**⚠️ WARNING:** Gmail has strict security policies. For production, use a proper email service.

1. **Enable 2-Factor Authentication** on your Gmail account
2. **Generate an App Password:**
   - Go to Google Account settings
   - Security → 2-Step Verification → App passwords
   - Generate a password for "Mail"

3. **Update your `.env` file:**
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your_gmail@gmail.com
   MAIL_PASSWORD=your_app_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="your_gmail@gmail.com"
   MAIL_FROM_NAME="${APP_NAME}"
   ```

## Option 3: Use Local Mail Server (For Advanced Users)

If you have a local mail server or want to use sendmail:

```env
MAIL_MAILER=sendmail
MAIL_FROM_ADDRESS="noreply@yourapp.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## Option 4: Use Cloud Email Services

### SendGrid
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your_sendgrid_api_key
MAIL_ENCRYPTION=tls
```

### Mailgun
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your_domain.mailgun.org
MAILGUN_SECRET=your_mailgun_secret
MAILGUN_ENDPOINT=api.mailgun.net
```

## Testing Email Configuration

After updating your `.env` file:

1. **Clear config cache:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

2. **Test email sending:**
   ```bash
   php artisan tinker
   ```
   Then in tinker:
   ```php
   Mail::raw('Test email', function($message) {
       $message->to('your-email@example.com')->subject('Test');
   });
   ```

3. **Check mail logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

## Troubleshooting

### Common Issues:

1. **"Connection refused" error:**
   - Check MAIL_HOST and MAIL_PORT
   - Verify firewall settings

2. **"Authentication failed" error:**
   - Double-check username/password
   - For Gmail, use App Password, not your regular password

3. **Emails still going to logs:**
   - Make sure MAIL_MAILER is set to 'smtp', not 'log'
   - Run `php artisan config:clear`

### For Production:

- Use services like SendGrid, Mailgun, or AWS SES
- Never use Gmail for production applications
- Set up proper SPF, DKIM, and DMARC records

## Current Status

Your emails are currently being logged to `storage/logs/laravel.log`. Once you configure a proper mailer, emails will be sent instead of logged.
