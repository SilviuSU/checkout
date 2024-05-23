-- Random user seed query
--
-- insert into customers set
--     uuid = uuid(),
--     email = CONCAT(LEFT(MD5(RAND()), 8), '@gmail.com'),
--     first_name = CONCAT('fname_', LEFT(MD5(RAND()), 8)),
--     last_name = CONCAT('lname_', LEFT(MD5(RAND()), 8)),
--     date_of_birth = '1990-01-01';


INSERT INTO `customers` (`uuid`, `email`, `first_name`, `last_name`, `date_of_birth`, `is_broker`, `created_at`, `updated_at`)
VALUES
    ('193b01c4-184b-11ef-9bf3-b3f8c3e5334e', 'aee08f9c@gmail.com', 'Person With', 'Incomplete Address', '1992-01-01', 0, '2024-05-22 17:58:23', '2024-05-22 19:30:19'),
    ('1953521a-184b-11ef-9bf3-b3f8c3e5334e', '4e656f64@gmail.com', 'I am broker', '', '1993-01-01', 1, '2024-05-22 17:58:23', '2024-05-22 19:30:22'),
    ('196ab874-184b-11ef-9bf3-b3f8c3e5334e', 'cac91cef@gmail.com', 'Another person', 'With Incomplete Addr', '1994-01-01', 0, '2024-05-22 17:58:23', '2024-05-22 19:30:25'),
    ('1982b6e0-184b-11ef-9bf3-b3f8c3e5334e', '6bc20aff@gmail.com', 'Another broker', '', '1994-01-01', 1, '2024-05-22 17:58:23', '2024-05-22 19:30:28'),
    ('2112b6e0-184b-11ef-9bf3-b3f8c3e5334e', 'test@gmail.com', 'Broker', 'No appllications', '1995-03-04', 1, '2024-05-22 17:58:23', '2024-05-22 19:30:39'),
    ('16700446-1862-11ef-9bf3-b3f8c3e5334e', '663d7bcc@gmail.com', 'Some user', 'Random name', '1981-01-01', 0, '2024-05-22 18:38:23', '2024-05-22 18:39:19'),
    ('18dd0f38-184b-11ef-9bf3-b3f8c3e5334e', 'ebde85a0@gmail.com', 'fname_deead745', 'lname_849e7268', '1991-01-01', 0, '2024-05-22 18:38:23', '2024-05-22 19:29:55');

INSERT INTO `products` (`uuid`, `name`, `interest_rate`, `term_months`, `created_at`, `updated_at`)
VALUES
    ('cdcb2476-185e-11ef-9bf3-b3f8c3e5334e', 'loan product 1', 3.50, 360, '2024-05-22 18:14:08', '2024-05-22 18:14:53'),
    ('cdcb28b8-185e-11ef-9bf3-b3f8c3e5334e', 'loan product 2', 5.00, 1234, '2024-05-22 18:14:08', '2024-05-22 18:15:18');

INSERT INTO `address_history` (`uuid`, `customer_id`, `address_line_1`, `address_line_2`, `city`, `state`, `postal_code`, `country_code`, `start_date`, `end_date`, `created_at`, `updated_at`)
VALUES
    ('71b0c3cc-1862-11ef-9bf3-b3f8c3e5334e', '193b01c4-184b-11ef-9bf3-b3f8c3e5334e', '10 Haldon Road', 'Incomplete', 'London', NULL, 'sw181qf', 'UK', '2021-02-01 00:00:00', NULL, '2024-05-22 19:13:49', '2024-05-22 19:13:49'),
    ('71b0c7aa-1862-11ef-9bf3-b3f8c3e5334e', '18dd0f38-184b-11ef-9bf3-b3f8c3e5334e', '10 Southfield Gardens', 'Complete', 'London', NULL, 'tw14sz', 'UK', '2019-01-02 00:00:00', '2022-01-01 00:00:00', '2024-05-22 19:13:49', '2024-05-22 19:13:49'),
    ('71b0c9da-1862-11ef-9bf3-b3f8c3e5334e', '1953521a-184b-11ef-9bf3-b3f8c3e5334e', '15 Company Address', 'Broker Address', 'Manchester', NULL, 'mn13ef', 'UK', '2021-03-02 00:00:00', NULL, '2024-05-22 19:13:49', '2024-05-22 19:13:49'),
    ('71b0cb74-1862-11ef-9bf3-b3f8c3e5334e', '18dd0f38-184b-11ef-9bf3-b3f8c3e5334e', '1 Cusack Close', 'Complete', 'London', NULL, 'tw14tb', 'UK', '2022-01-02 00:00:00', NULL, '2024-05-22 19:13:49', '2024-05-22 19:13:49'),
    ('71b0cce6-1862-11ef-9bf3-b3f8c3e5334e', '196ab874-184b-11ef-9bf3-b3f8c3e5334e', '14 Random Addr', 'Incomplete', 'bath', NULL, 'bt13gb', 'UK', '2019-08-05 00:00:00', NULL, '2024-05-22 19:13:49', '2024-05-22 19:13:49'),
    ('71b0ce62-1862-11ef-9bf3-b3f8c3e5334e', '16700446-1862-11ef-9bf3-b3f8c3e5334e', '21 Street name', ' Ap 40', 'Liverpool', NULL, 'lv101gb', 'UK', '2012-01-01 00:00:00', NULL, '2024-05-22 19:13:49', '2024-05-22 19:13:49');

INSERT INTO `applications` (`uuid`, `customer_id`, `broker_id`, `product_id`, `loan_amount`, `monthly_payment`, `status`, `created_at`, `updated_at`)
VALUES
    ('4a5f66f4-1860-11ef-9bf3-b3f8c3e5334e', '18dd0f38-184b-11ef-9bf3-b3f8c3e5334e', '1953521a-184b-11ef-9bf3-b3f8c3e5334e', 'cdcb2476-185e-11ef-9bf3-b3f8c3e5334e', 100000.00, 29166.67, 'NEW', '2024-05-22 19:17:49', '2024-05-22 19:17:49'),
    ('aaaf66f4-1860-11ef-9bf3-b3f8c3e5334e', '18dd0f38-184b-11ef-9bf3-b3f8c3e5334e', '18dd0f38-184b-11ef-9bf3-b3f8c3e5334e', 'cdcb28b8-185e-11ef-9bf3-b3f8c3e5334e', 30000.00, 12500.00, 'APPROVED', '2024-05-22 19:17:49', '2024-05-22 19:17:49'),
    ('bbb66f4-1860-11ef-9bf3-b3f8c3e5334e', '16700446-1862-11ef-9bf3-b3f8c3e5334e', '1982b6e0-184b-11ef-9bf3-b3f8c3e5334e', 'cdcb28b8-185e-11ef-9bf3-b3f8c3e5334e', 30000.00, 12500.00, 'NEW', '2024-05-22 19:17:49', '2024-05-22 19:17:49'),
    ('cccf66f4-1860-11ef-9bf3-b3f8c3e5334e', '16700446-1862-11ef-9bf3-b3f8c3e5334e', '1982b6e0-184b-11ef-9bf3-b3f8c3e5334e', 'cdcb2476-185e-11ef-9bf3-b3f8c3e5334e', 200000.00, 58333.33, 'PROCESSING', '2024-05-22 19:17:49', '2024-05-22 19:17:49');

INSERT INTO `application_history` (`uuid`, `application_id`, `new_status`, `created_at`, `updated_at`)
VALUES
    ('78a3f91a-1867-11ef-9bf3-b3f8c3e5334e', 'cccf66f4-1860-11ef-9bf3-b3f8c3e5334e', 'NEW', '2024-05-22 19:22:01', '2024-05-22 19:24:47'),
    ('78a3f91a-1867-11ef-9bf3-b3f8c3e5334g', 'cccf66f4-1860-11ef-9bf3-b3f8c3e5334e', 'PROCESSING', '2024-05-22 19:22:02', '2024-05-22 19:24:47'),
    ('78a3fd84-1867-11ef-9bf3-b3f8c3e5334b', 'aaaf66f4-1860-11ef-9bf3-b3f8c3e5334e', 'NEW', '2024-05-22 19:22:03', '2024-05-22 19:24:47'),
    ('78a3fd84-1867-11ef-9bf3-b3f8c3e5334e', 'aaaf66f4-1860-11ef-9bf3-b3f8c3e5334e', 'PROCESSING', '2024-05-22 19:22:04', '2024-05-22 19:24:47'),
    ('78a3ff82-1867-11ef-9bf3-b3f8c3e5334e', 'aaaf66f4-1860-11ef-9bf3-b3f8c3e5334e', 'APPROVED', '2024-05-22 19:22:05', '2024-05-22 19:24:47'),
    ('78a400fe-1867-11ef-9bf3-b3f8c3e5334e', '4a5f66f4-1860-11ef-9bf3-b3f8c3e5334e', 'NEW', '2024-05-22 19:22:06', '2024-05-22 19:24:47'),
    ('78a402b6-1867-11ef-9bf3-b3f8c3e5334e', 'bbb66f4-1860-11ef-9bf3-b3f8c3e5334e', 'NEW', '2024-05-22 19:22:07', '2024-05-22 19:24:47');
