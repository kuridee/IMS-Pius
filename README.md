Architectural Overview
This system is engineered with a strict Layered Architecture (MVC-Repository Pattern) to ensure high maintainability, testability, and defensive security:

Controllers (HTTP Layer): Handles incoming client requests, manages input validation, and dictates response delivery without mixing business logic or database queries.

Services (Business Logic Layer): Orchestrates core application rules, user authentication flows, and transactional processes.

Repositories (Data Access Layer): Centralizes all data persistence logic using secure, prepared SQL statements via PHP Data Objects (PDO).

Multi-Layered Security Architecture
Your application implements a defense-in-depth strategy across three critical security pillars:

1. Network-Based Access Control (IP-Based)
Restricts system access by validating device IP addresses during authentication.

Prevents unauthorized access even from compromised credentials if the request originates outside trusted workstations, office subnets, or lab terminals.

2. User & Role-Based Access Control (User-Based)
Ensures that authenticated users can only interact with data and perform actions explicitly permitted by their assigned roles (e.g., separating instructor grade encoding from administrative controls).

3. Secure Session Token Management (session_token)
State & Concurrency Control: Tracks active user sessions directly at the database layer via unique session_token columns in the users table.

Single Active Session Enforcement: Invalidates old session tokens upon a new login, mitigating session hijacking and preventing concurrent multi-device logins using the same credentials.

Token Invalidation: Ensures that upon logout or account lockdown, the session token is immediately nullified in the database.

🔍 Immutable Audit Logging ("Black Box")
Captures unalterable audit trails for high-risk actions (e.g., user provisioning, grade modifications, and authentication blocks), recording:

Associated User ID & Role

Specific System Action (CREATE_USER, UPDATE_GRADES, LOGIN_BLOCKED_IP)

Client Device IP Address

Exact Timestamp