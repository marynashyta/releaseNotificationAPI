CREATE TABLE IF NOT EXISTS subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    repo VARCHAR(255) NOT NULL,
    confirmed TINYINT(1) NOT NULL DEFAULT 0,
    confirm_token VARCHAR(64) NOT NULL,
    unsubscribe_token VARCHAR(64) NOT NULL,
    last_seen_tag VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_email_repo (email, repo),
    UNIQUE KEY unique_confirm_token (confirm_token),
    UNIQUE KEY unique_unsubscribe_token (unsubscribe_token)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
