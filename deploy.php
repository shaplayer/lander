<?php
// Simple deployment webhook listener

// Define a secure secret token (make sure it matches what you put in GitHub)
$secret = 'BICKSTOCKS_SECRET';

// Validate GitHub signature
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$payload = file_get_contents('php://input');
$expectedSignature = 'sha256=' . hash_hmac('sha256', $payload, $secret);

if (!hash_equals($expectedSignature, $signature)) {
    http_response_code(403);
    exit('Invalid signature.');
}

// Check if push is to the main branch
$data = json_decode($payload, true);
if (($data['ref'] ?? '') === 'refs/heads/main') {
    $repoPath = '/var/www/landers';
    
    // Execute git pull as www-data and capture output/errors
    $output = shell_exec("cd {$repoPath} && git pull origin main 2>&1");
    
    // Optional: Add build steps, composer install, or cache clearing here if needed
    // $output .= shell_exec("cd {$repoPath} && composer install --no-dev --optimize-autoloader 2>&1");

    http_response_code(200);
    echo "Deployment successful:\n{$output}";
} else {
    http_response_code(200);
    echo "Ignored branch.";
}
