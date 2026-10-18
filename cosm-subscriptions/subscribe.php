<?php
// Forwards signups as JSON to the URL in the LEAD_WEBHOOK_URL environment
// variable (a Zapier/Make hook or your email/SMS provider's endpoint).

function back(string $status): void
{
    header('Location: ./?signup=' . $status . '#signup-top', true, 303);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    back('');
}

// Honeypot: bots fill the hidden field, people don't.
if (!empty($_POST['website'])) {
    back('ok');
}

$email = trim($_POST['email'] ?? '');
$phone = preg_replace('/[^\d+]/', '', $_POST['phone'] ?? '');
$smsConsent = ($_POST['sms_consent'] ?? '') === '1';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    back('invalid');
}
// Texts only go to people who gave a number and checked the consent box.
if ($smsConsent && strlen(preg_replace('/\D/', '', $phone)) < 10) {
    back('invalid');
}
if (!$smsConsent) {
    $phone = '';
}

$webhook = getenv('LEAD_WEBHOOK_URL') ?: ($_SERVER['LEAD_WEBHOOK_URL'] ?? '');
if ($webhook === '') {
    error_log('cosm-subscriptions: LEAD_WEBHOOK_URL is not set; signup not saved');
    back('error');
}

$lead = [
    'email' => $email,
    'phone' => $phone,
    'sms_consent' => $smsConsent,
    'sms_consent_text' => $smsConsent ? 'I agree to receive recurring automated marketing text messages from BigStocks at the number provided. Consent is not a condition of purchase. Msg frequency varies. Msg & data rates may apply. Reply STOP to cancel, HELP for help.' : '',
    'source' => 'cosm-subscriptions',
    'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
    'submitted_at' => gmdate('c'),
];

$context = stream_context_create(['http' => [
    'method' => 'POST',
    'header' => "Content-Type: application/json\r\n",
    'content' => json_encode($lead),
    'timeout' => 8,
    'ignore_errors' => true,
]]);
$response = @file_get_contents($webhook, false, $context);
$code = isset($http_response_header[0]) && preg_match('/\s(\d{3})\s/', $http_response_header[0], $m) ? (int) $m[1] : 0;

if ($response === false || $code < 200 || $code >= 300) {
    error_log("cosm-subscriptions: webhook failed (HTTP $code)");
    back('error');
}

back('ok');
