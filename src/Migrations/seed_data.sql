-- -- ================================================
-- -- Insert sample supervisors
-- -- ================================================
-- INSERT INTO supervisors (name, email, department, phone, password, created_at, updated_at)
-- VALUES
--   ('Supervisor 1', 'supervisor1@example.com', 'Department A', '111-111-1111', 'hashed_password1', NOW(), NOW()),
--   ('Supervisor 2', 'supervisor2@example.com', 'Department B', '111-111-1112', 'hashed_password2', NOW(), NOW()),
--   ('Supervisor 3', 'supervisor3@example.com', 'Department C', '111-111-1113', 'hashed_password3', NOW(), NOW()),
--   ('Supervisor 4', 'supervisor4@example.com', 'Department A', '111-111-1114', 'hashed_password4', NOW(), NOW()),
--   ('Supervisor 5', 'supervisor5@example.com', 'Department B', '111-111-1115', 'hashed_password5', NOW(), NOW()),
--   ('Supervisor 6', 'supervisor6@example.com', 'Department C', '111-111-1116', 'hashed_password6', NOW(), NOW()),
--   ('Supervisor 7', 'supervisor7@example.com', 'Department A', '111-111-1117', 'hashed_password7', NOW(), NOW()),
--   ('Supervisor 8', 'supervisor8@example.com', 'Department B', '111-111-1118', 'hashed_password8', NOW(), NOW()),
--   ('Supervisor 9', 'supervisor9@example.com', 'Department C', '111-111-1119', 'hashed_password9', NOW(), NOW()),
--   ('Supervisor 10', 'supervisor10@example.com', 'Department A', '111-111-1120', 'hashed_password10', NOW(), NOW());

-- -- ================================================
-- -- Insert sample trainees
-- -- ================================================
-- INSERT INTO trainees (name, email, major, phone, password, created_at, updated_at)
-- VALUES
--   ('Trainee 1', 'trainee1@example.com', 'Major X', '222-222-2221', 'hashed_password1', NOW(), NOW()),
--   ('Trainee 2', 'trainee2@example.com', 'Major Y', '222-222-2222', 'hashed_password2', NOW(), NOW()),
--   ('Trainee 3', 'trainee3@example.com', 'Major Z', '222-222-2223', 'hashed_password3', NOW(), NOW()),
--   ('Trainee 4', 'trainee4@example.com', 'Major X', '222-222-2224', 'hashed_password4', NOW(), NOW()),
--   ('Trainee 5', 'trainee5@example.com', 'Major Y', '222-222-2225', 'hashed_password5', NOW(), NOW()),
--   ('Trainee 6', 'trainee6@example.com', 'Major Z', '222-222-2226', 'hashed_password6', NOW(), NOW()),
--   ('Trainee 7', 'trainee7@example.com', 'Major X', '222-222-2227', 'hashed_password7', NOW(), NOW()),
--   ('Trainee 8', 'trainee8@example.com', 'Major Y', '222-222-2228', 'hashed_password8', NOW(), NOW()),
--   ('Trainee 9', 'trainee9@example.com', 'Major Z', '222-222-2229', 'hashed_password9', NOW(), NOW()),
--   ('Trainee 10', 'trainee10@example.com', 'Major X', '222-222-2230', 'hashed_password10', NOW(), NOW());

-- -- ================================================
-- -- Insert sample tickets
-- -- ================================================
-- -- Note: creator_id is the trainee who created the ticket.
-- -- The assigned_supervisor_id is initially set to NULL.
-- INSERT INTO tickets (title, details, status, created_date, creator_id, assigned_supervisor_id, created_at, updated_at)
-- VALUES
--   ('Ticket 1', 'Details for ticket 1', 'Open', NOW(), 1, NULL, NOW(), NOW()),
--   ('Ticket 2', 'Details for ticket 2', 'Pending', NOW(), 2, NULL, NOW(), NOW()),
--   ('Ticket 3', 'Details for ticket 3', 'Closed', NOW(), 3, NULL, NOW(), NOW()),
--   ('Ticket 4', 'Details for ticket 4', 'Open', NOW(), 4, NULL, NOW(), NOW()),
--   ('Ticket 5', 'Details for ticket 5', 'Open', NOW(), 5, NULL, NOW(), NOW()),
--   ('Ticket 6', 'Details for ticket 6', 'Pending', NOW(), 6, NULL, NOW(), NOW()),
--   ('Ticket 7', 'Details for ticket 7', 'Closed', NOW(), 7, NULL, NOW(), NOW()),
--   ('Ticket 8', 'Details for ticket 8', 'Open', NOW(), 8, NULL, NOW(), NOW()),
--   ('Ticket 9', 'Details for ticket 9', 'Open', NOW(), 9, NULL, NOW(), NOW()),
--   ('Ticket 10', 'Details for ticket 10', 'Pending', NOW(), 10, NULL, NOW(), NOW());

-- -- ================================================
-- -- Insert sample contents
-- -- ================================================
-- -- Note: Each content now links to the supervisor who created it.
-- INSERT INTO contents (type, content, creator_supervisor_id, created_at, updated_at)
-- VALUES
--   ('Type A', 'Content for Ticket 1', 1, NOW(), NOW()),
--   ('Type B', 'Content for Ticket 2', 2, NOW(), NOW()),
--   ('Type A', 'Content for Ticket 3', 3, NOW(), NOW()),
--   ('Type C', 'Content for Ticket 4', 4, NOW(), NOW()),
--   ('Type B', 'Content for Ticket 5', 5, NOW(), NOW()),
--   ('Type A', 'Content for Ticket 6', 6, NOW(), NOW()),
--   ('Type C', 'Content for Ticket 7', 7, NOW(), NOW()),
--   ('Type B', 'Content for Ticket 8', 8, NOW(), NOW()),
--   ('Type A', 'Content for Ticket 9', 9, NOW(), NOW()),
--   ('Type C', 'Content for Ticket 10', 10, NOW(), NOW());

-- -- ================================================
-- -- Insert sample comments
-- -- ================================================
-- -- Note: Comments now use a polymorphic structure.
-- -- In these examples, comments are created by trainees.
-- INSERT INTO comments (text, date, ticket_id, creator_id, creator_type, created_at, updated_at)
-- VALUES
--   ('Comment 1 on Ticket 1', NOW(), 1, 1, 'trainee', NOW(), NOW()),
--   ('Comment 2 on Ticket 2', NOW(), 2, 2, 'trainee', NOW(), NOW()),
--   ('Comment 3 on Ticket 3', NOW(), 3, 3, 'trainee', NOW(), NOW()),
--   ('Comment 4 on Ticket 4', NOW(), 4, 4, 'trainee', NOW(), NOW()),
--   ('Comment 5 on Ticket 5', NOW(), 5, 5, 'trainee', NOW(), NOW()),
--   ('Comment 6 on Ticket 6', NOW(), 6, 6, 'trainee', NOW(), NOW()),
--   ('Comment 7 on Ticket 7', NOW(), 7, 7, 'trainee', NOW(), NOW()),
--   ('Comment 8 on Ticket 8', NOW(), 8, 8, 'trainee', NOW(), NOW()),
--   ('Comment 9 on Ticket 9', NOW(), 9, 9, 'trainee', NOW(), NOW()),
--   ('Comment 10 on Ticket 10', NOW(), 10, 10, 'trainee', NOW(), NOW());




-- ================================================
-- Insert sample supervisors
-- ================================================
INSERT INTO supervisors (name, email, department, phone, password, created_at, updated_at)
VALUES
  ('Supervisor 1', 'supervisor1@example.com', 'Department A', '111-111-1111', 'hashed_password1', NOW(), NOW()),
  ('Supervisor 2', 'supervisor2@example.com', 'Department B', '111-111-1112', 'hashed_password2', NOW(), NOW()),
  ('Supervisor 3', 'supervisor3@example.com', 'Department C', '111-111-1113', 'hashed_password3', NOW(), NOW()),
  ('Supervisor 4', 'supervisor4@example.com', 'Department A', '111-111-1114', 'hashed_password4', NOW(), NOW()),
  ('Supervisor 5', 'supervisor5@example.com', 'Department B', '111-111-1115', 'hashed_password5', NOW(), NOW()),
  ('Supervisor 6', 'supervisor6@example.com', 'Department C', '111-111-1116', 'hashed_password6', NOW(), NOW()),
  ('Supervisor 7', 'supervisor7@example.com', 'Department A', '111-111-1117', 'hashed_password7', NOW(), NOW()),
  ('Supervisor 8', 'supervisor8@example.com', 'Department B', '111-111-1118', 'hashed_password8', NOW(), NOW()),
  ('Supervisor 9', 'supervisor9@example.com', 'Department C', '111-111-1119', 'hashed_password9', NOW(), NOW()),
  ('Supervisor 10', 'supervisor10@example.com', 'Department A', '111-111-1120', 'hashed_password10', NOW(), NOW());

-- ================================================
-- Insert sample trainees
-- ================================================
INSERT INTO trainees (name, email, major, phone, password, created_at, updated_at)
VALUES
  ('Trainee 1', 'trainee1@example.com', 'Major X', '222-222-2221', 'hashed_password1', NOW(), NOW()),
  ('Trainee 2', 'trainee2@example.com', 'Major Y', '222-222-2222', 'hashed_password2', NOW(), NOW()),
  ('Trainee 3', 'trainee3@example.com', 'Major Z', '222-222-2223', 'hashed_password3', NOW(), NOW()),
  ('Trainee 4', 'trainee4@example.com', 'Major X', '222-222-2224', 'hashed_password4', NOW(), NOW()),
  ('Trainee 5', 'trainee5@example.com', 'Major Y', '222-222-2225', 'hashed_password5', NOW(), NOW()),
  ('Trainee 6', 'trainee6@example.com', 'Major Z', '222-222-2226', 'hashed_password6', NOW(), NOW()),
  ('Trainee 7', 'trainee7@example.com', 'Major X', '222-222-2227', 'hashed_password7', NOW(), NOW()),
  ('Trainee 8', 'trainee8@example.com', 'Major Y', '222-222-2228', 'hashed_password8', NOW(), NOW()),
  ('Trainee 9', 'trainee9@example.com', 'Major Z', '222-222-2229', 'hashed_password9', NOW(), NOW()),
  ('Trainee 10', 'trainee10@example.com', 'Major X', '222-222-2230', 'hashed_password10', NOW(), NOW());

-- ================================================
-- Insert sample tickets
-- ================================================
INSERT INTO tickets (title, details, status, created_date, creator_id, assigned_supervisor_id, created_at, updated_at)
VALUES
  ('System Bug Report', 'Details for ticket 1', 'Open', NOW(), 1, NULL, NOW(), NOW()),
  ('Feature Request', 'Details for ticket 2', 'Pending', NOW(), 2, NULL, NOW(), NOW()),
  ('Account Issue', 'Details for ticket 3', 'Closed', NOW(), 3, NULL, NOW(), NOW()),
  ('Login Problem', 'Details for ticket 4', 'Open', NOW(), 4, NULL, NOW(), NOW()),
  ('App Crash', 'Details for ticket 5', 'Open', NOW(), 5, NULL, NOW(), NOW()),
  ('Database Error', 'Details for ticket 6', 'Pending', NOW(), 6, NULL, NOW(), NOW()),
  ('Payment Issue', 'Details for ticket 7', 'Closed', NOW(), 7, NULL, NOW(), NOW()),
  ('Slow Performance', 'Details for ticket 8', 'Open', NOW(), 8, NULL, NOW(), NOW()),
  ('UI/UX Feedback', 'Details for ticket 9', 'Open', NOW(), 9, NULL, NOW(), NOW()),
  ('Other', 'Details for ticket 10', 'Pending', NOW(), 10, NULL, NOW(), NOW());

-- ================================================
-- Insert sample contents (Now includes Title)
-- ================================================
INSERT INTO contents (title, type, content, creator_supervisor_id, created_at, updated_at)
VALUES
  ('Bug Fix Instructions', 'Type A', 'Content for Ticket 1', 1, NOW(), NOW()),
  ('Feature Development Guide', 'Type B', 'Content for Ticket 2', 2, NOW(), NOW()),
  ('Account Recovery Process', 'Type A', 'Content for Ticket 3', 3, NOW(), NOW()),
  ('Login Troubleshooting', 'Type C', 'Content for Ticket 4', 4, NOW(), NOW()),
  ('Crash Debugging Steps', 'Type B', 'Content for Ticket 5', 5, NOW(), NOW()),
  ('Database Optimization Tips', 'Type A', 'Content for Ticket 6', 6, NOW(), NOW()),
  ('Payment Resolution Guide', 'Type C', 'Content for Ticket 7', 7, NOW(), NOW()),
  ('Performance Tuning', 'Type B', 'Content for Ticket 8', 8, NOW(), NOW()),
  ('UI/UX Best Practices', 'Type A', 'Content for Ticket 9', 9, NOW(), NOW()),
  ('Miscellaneous Solutions', 'Type C', 'Content for Ticket 10', 10, NOW(), NOW());

-- ================================================
-- Insert sample comments
-- ================================================
INSERT INTO comments (text, date, ticket_id, creator_id, creator_type, created_at, updated_at)
VALUES
  ('Comment 1 on Ticket 1', NOW(), 1, 1, 'trainee', NOW(), NOW()),
  ('Comment 2 on Ticket 2', NOW(), 2, 2, 'trainee', NOW(), NOW()),
  ('Comment 3 on Ticket 3', NOW(), 3, 3, 'trainee', NOW(), NOW()),
  ('Comment 4 on Ticket 4', NOW(), 4, 4, 'trainee', NOW(), NOW()),
  ('Comment 5 on Ticket 5', NOW(), 5, 5, 'supervisor', NOW(), NOW()),
  ('Comment 6 on Ticket 6', NOW(), 6, 6, 'trainee', NOW(), NOW()),
  ('Comment 7 on Ticket 7', NOW(), 7, 7, 'trainee', NOW(), NOW()),
  ('Comment 8 on Ticket 8', NOW(), 8, 8, 'trainee', NOW(), NOW()),
  ('Comment 9 on Ticket 9', NOW(), 9, 9, 'trainee', NOW(), NOW()),
  ('Comment 10 on Ticket 10', NOW(), 10, 10, 'trainee', NOW(), NOW());
