CREATE OR REPLACE VIEW v_complete_user_details AS
SELECT 
    u.id AS user_id,
    u.Username,
    u.Password,
    u.failed_attempts,
    u.lockout_until,
    u.created_at AS account_created,
    p.Profile_ID,
    p.Firstname,
    p.Lastname,
    p.Middlename,
    p.Address,
    p.Contact
FROM users u
LEFT JOIN user_profile p ON u.id = p.User_ID;