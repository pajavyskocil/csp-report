CREATE TABLE csp (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_agent TEXT DEFAULT NULL,
	referrer TEXT DEFAULT NULL,
	ip VARCHAR(255) DEFAULT NULL,
	report TEXT DEFAULT NULL,
	report_blocked_uri TEXT DEFAULT NULL,
	report_disposition TEXT DEFAULT NULL,
	report_document_uri TEXT DEFAULT NULL,
	report_effective_directive TEXT DEFAULT NULL,
	report_original_policy TEXT DEFAULT NULL,
	report_referrer TEXT DEFAULT NULL,
	report_script_sample TEXT DEFAULT NULL,
	report_status_code TEXT DEFAULT NULL,
	report_violated_directive TEXT DEFAULT NULL,
	`time` timestamp DEFAULT CURRENT_TIMESTAMP
);
