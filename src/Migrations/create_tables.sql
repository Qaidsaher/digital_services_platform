-- DROP TABLES IF THEY EXIST
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS contents;
DROP TABLE IF EXISTS tickets;
DROP TABLE IF EXISTS trainees;
DROP TABLE IF EXISTS supervisors;
DROP TABLE IF EXISTS admins;

-- ================================================
-- Create admins table
-- ================================================
CREATE TABLE admins (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- ================================================
-- Create supervisors table
-- ================================================
CREATE TABLE supervisors (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    department VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- Create trainees table
-- ================================================
CREATE TABLE trainees (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    major VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- Create tickets table
-- ================================================
CREATE TABLE tickets (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    details TEXT NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'pending',
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    -- The creator of the ticket is a trainee:
    creator_id BIGINT UNSIGNED NOT NULL,
    -- The ticket is assigned to a supervisor; allow NULL for unassigned tickets:
    assigned_supervisor_id BIGINT UNSIGNED DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_tickets_creator FOREIGN KEY (creator_id) REFERENCES trainees(id) ON DELETE CASCADE,
    CONSTRAINT fk_tickets_assigned_supervisor FOREIGN KEY (assigned_supervisor_id) REFERENCES supervisors(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- Create contents table
-- ================================================
CREATE TABLE contents (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(255) NOT NULL,
    title VARCHAR(255)  NULL,
    content TEXT NOT NULL,
    -- Instead of linking to a ticket, we store the supervisor (creator) who added the content:
    creator_supervisor_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_contents_supervisor FOREIGN KEY (creator_supervisor_id) REFERENCES supervisors(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- Create comments table
-- ================================================
CREATE TABLE comments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    text TEXT NOT NULL,
    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    -- Link to the ticket that this comment belongs to:
    ticket_id BIGINT UNSIGNED NOT NULL,
    -- Polymorphic creator: can be a supervisor or a trainee.
    creator_id BIGINT UNSIGNED NOT NULL,
    creator_type ENUM('supervisor','trainee') NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_comments_ticket FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- password of admin is admin12345
INSERT INTO admins (name, email, password, created_at, updated_at)
VALUES 
  ('Admin', 'admin@gmail.com', '$2y$10$igtLs5glGI4TMeGoqGYTBeDn39Jn.1z/SZO7ZFDvygtWXmml8Lm.i', NOW(), NOW());