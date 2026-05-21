-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 20, 2025 at 07:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

CREATE DATABASE IF NOT EXISTS `blog`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE `blog`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `post_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `post_count`, `created_at`, `updated_at`) VALUES
(1, 'PHP Development', 'Hướng dẫn lập trình PHP từ cơ bản đến nâng cao, design patterns, best practices và PHP frameworks', 5, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(2, 'JavaScript', 'Tất tần tật về JavaScript, ES6+, async programming, và các kỹ thuật lập trình JavaScript hiện đại', 4, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(3, 'Laravel Framework', 'Laravel tutorials, tips & tricks, best practices, packages và cách xây dựng ứng dụng Laravel professional', 4, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(4, 'React', 'React.js tutorials, hooks, state management, React 19 features và ecosystem', 3, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(5, 'Vue.js', 'Vue.js framework, Composition API, Vuex, Vue Router và Vue ecosystem', 3, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(6, 'Node.js', 'Node.js backend development, Express.js, performance optimization và scalability', 3, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(7, 'MySQL & Databases', 'MySQL optimization, query tuning, database design, indexing strategies và performance', 3, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(8, 'Web Development', 'General web development, HTML, CSS, responsive design và modern web technologies', 3, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(9, 'Docker & DevOps', 'Containerization, CI/CD pipelines, orchestration với Kubernetes và cloud infrastructure', 2, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(10, 'Python Programming', 'Python từ cơ bản đến nâng cao, Django, FastAPI, data science và machine learning', 2, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(11, 'Mobile Development', 'React Native, Flutter, iOS Swift, Android Kotlin và cross-platform development', 2, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(12, 'Security & Testing', 'Web security, penetration testing, OWASP, secure coding practices và automation testing', 2, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(13, 'Cloud Computing', 'AWS, Azure, Google Cloud Platform, serverless architecture và cloud-native development', 2, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(14, 'AI & Machine Learning', 'Artificial Intelligence, Machine Learning, Deep Learning, TensorFlow và PyTorch', 1, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(15, 'UI/UX Design', 'User Interface Design, User Experience, Figma, Adobe XD và design systems', 1, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(16, 'Git & Version Control', 'Git workflows, branching strategies, GitHub, GitLab và collaboration best practices', 1, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(17, 'API Development', 'RESTful APIs, GraphQL, API design patterns, authentication và rate limiting', 1, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(18, 'TypeScript', 'TypeScript fundamentals, advanced types, decorators và integration với frameworks', 1, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(19, 'Microservices', 'Microservices architecture, service mesh, API gateway và distributed systems', 1, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(20, 'Performance Optimization', 'Web performance, caching strategies, CDN, lazy loading và performance monitoring', 1, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(21, 'Blockchain & Web3', 'Blockchain development, Smart Contracts, Solidity, DApps và cryptocurrency', 0, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(22, 'Game Development', 'Unity, Unreal Engine, game design patterns và multiplayer networking', 0, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(23, 'Data Science', 'Data analysis, visualization, Pandas, NumPy, R programming và statistical analysis', 0, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(24, 'Agile & Scrum', 'Agile methodologies, Scrum framework, sprint planning và team collaboration', 0, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(25, 'Content Strategy', 'Technical writing, documentation, SEO, content marketing và copywriting', 0, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(26, 'Networking', 'Computer networking, protocols, TCP/IP, DNS, load balancing và network security', 0, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(27, 'Linux & System Admin', 'Linux administration, shell scripting, system monitoring và server management', 0, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(28, 'E-commerce', 'Online store development, payment gateways, WooCommerce, Shopify và marketplace', 0, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(29, 'Cybersecurity', 'Information security, encryption, firewalls, intrusion detection và compliance', 0, '2025-11-20 06:00:00', '2025-11-20 06:00:00'),
(30, 'Soft Skills', 'Communication, leadership, time management, problem-solving và career development', 0, '2025-11-20 06:00:00', '2025-11-20 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `author_name` varchar(100) DEFAULT NULL,
  `author_email` varchar(100) DEFAULT NULL,
  `content` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `parent_id`, `author_name`, `author_email`, `content`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 1, 4, NULL, 'Lê Văn Minh', 'minhdev@gmail.com', 'Bài viết rất chi tiết và dễ hiểu. Cảm ơn bạn đã chia sẻ!', '192.168.1.10', 'Mozilla/5.0', '2025-11-18 09:30:00', '2025-11-18 09:30:00'),
(2, 1, 5, 1, 'Phạm Thu Hà', 'thudev@gmail.com', 'Mình cũng đồng ý. Laravel 11 có nhiều cải tiến đáng chú ý.', '192.168.1.11', 'Mozilla/5.0', '2025-11-18 10:15:00', '2025-11-18 10:15:00'),
(3, 1, NULL, NULL, 'Nguyễn Văn B', 'nguyenvanb@gmail.com', 'Cho mình hỏi về phần cấu hình database với PostgreSQL được không?', '192.168.1.12', 'Mozilla/5.0', '2025-11-18 14:20:00', '2025-11-18 14:20:00'),
(4, 2, 3, NULL, 'Nguyễn Văn A', 'editor@devblog.com', 'Design patterns là kiến thức rất quan trọng. Bài viết hay!', '192.168.1.13', 'Mozilla/5.0', '2025-11-17 11:45:00', '2025-11-17 11:45:00'),
(5, 2, 4, NULL, 'Lê Văn Minh', 'minhdev@gmail.com', 'Mình thích Factory Pattern nhất, rất linh hoạt.', '192.168.1.10', 'Mozilla/5.0', '2025-11-17 13:20:00', '2025-11-17 13:20:00'),
(6, 2, NULL, NULL, 'Trần Thị C', 'tranthic@gmail.com', 'Có thể giải thích thêm về Decorator Pattern không ạ?', '192.168.1.14', 'Mozilla/5.0', '2025-11-17 15:30:00', '2025-11-17 15:30:00'),
(7, 2, 5, 6, 'Phạm Thu Hà', 'thudev@gmail.com', 'Decorator Pattern cho phép thêm behavior mới vào object mà không thay đổi structure.', '192.168.1.11', 'Mozilla/5.0', '2025-11-17 16:00:00', '2025-11-17 16:00:00'),
(8, 2, NULL, NULL, 'Developer X', 'devx@example.com', 'Bài hay nhưng có thể thêm code examples không?', '192.168.1.15', 'Mozilla/5.0', '2025-11-17 17:45:00', '2025-11-17 17:45:00'),
(9, 3, 4, NULL, 'Lê Văn Minh', 'minhdev@gmail.com', 'React Hooks thực sự thay đổi cách viết React components!', '192.168.1.10', 'Mozilla/5.0', '2025-11-16 15:30:00', '2025-11-16 15:30:00'),
(10, 3, NULL, NULL, 'Nguyễn D', 'nguyend@gmail.com', 'useEffect còn nhiều điều cần học. Bài viết giúp ích nhiều!', '192.168.1.16', 'Mozilla/5.0', '2025-11-16 18:20:00', '2025-11-16 18:20:00'),
(11, 4, 3, NULL, 'Nguyễn Văn A', 'editor@devblog.com', 'Indexing strategy rất quan trọng cho performance. Bài viết chất lượng!', '192.168.1.13', 'Mozilla/5.0', '2025-11-15 10:30:00', '2025-11-15 10:30:00'),
(12, 4, 5, NULL, 'Phạm Thu Hà', 'thudev@gmail.com', 'Composite index nên được dùng như thế nào cho đúng?', '192.168.1.11', 'Mozilla/5.0', '2025-11-15 11:45:00', '2025-11-15 11:45:00'),
(13, 4, 4, 12, 'Lê Văn Minh', 'minhdev@gmail.com', 'Composite index nên đặt column thường xuyên query nhất ở đầu tiên.', '192.168.1.10', 'Mozilla/5.0', '2025-11-15 13:00:00', '2025-11-15 13:00:00'),
(14, 4, NULL, NULL, 'DBA Pro', 'dba@example.com', 'Đừng quên analyze query với EXPLAIN!', '192.168.1.17', 'Mozilla/5.0', '2025-11-15 14:20:00', '2025-11-15 14:20:00'),
(15, 5, 5, NULL, 'Phạm Thu Hà', 'thudev@gmail.com', 'ES2024 có nhiều tính năng hay quá! Đặc biệt là Temporal API.', '192.168.1.11', 'Mozilla/5.0', '2025-11-14 17:30:00', '2025-11-14 17:30:00'),
(16, 6, 4, NULL, 'Lê Văn Minh', 'minhdev@gmail.com', 'Node.js cluster mode giúp tận dụng multi-core rất tốt.', '192.168.1.10', 'Mozilla/5.0', '2025-11-13 12:15:00', '2025-11-13 12:15:00'),
(17, 8, 3, NULL, 'Nguyễn Văn A', 'editor@devblog.com', 'RESTful API design principles rất quan trọng cho mọi backend developer.', '192.168.1.13', 'Mozilla/5.0', '2025-11-11 11:30:00', '2025-11-11 11:30:00'),
(18, 10, 2, NULL, 'Trần Gia Huy', 'trgiahuy14@gmail.com', 'PHP 8.3 mang lại nhiều cải tiến về performance và developer experience!', '192.168.1.20', 'Mozilla/5.0', '2025-11-09 10:45:00', '2025-11-09 10:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `author_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `views` int(10) UNSIGNED DEFAULT 0,
  `comment_count` int(10) UNSIGNED DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `thumbnail`, `author_id`, `category_id`, `views`, `comment_count`, `created_at`, `updated_at`) VALUES
(1, 'Hướng dẫn cài đặt Laravel 11 từ đầu', '<h2>Giới thiệu</h2><p>Laravel 11 là phiên bản mới nhất của framework PHP phổ biến nhất hiện nay. Bài viết này sẽ hướng dẫn bạn cài đặt Laravel 11 từ đầu một cách chi tiết.</p><h3>Yêu cầu hệ thống</h3><ul><li>PHP >= 8.2</li><li>Composer</li><li>MySQL hoặc PostgreSQL</li></ul><h3>Các bước cài đặt</h3><p>1. Cài đặt Composer<br>2. Tạo project Laravel mới<br>3. Cấu hình database<br>4. Chạy migration</p>', NULL, 2, 3, 156, 3, '2025-11-18 08:00:00', '2025-11-20 06:00:00'),
(2, 'Top 10 Design Patterns quan trọng trong PHP', '<h2>Design Patterns là gì?</h2><p>Design Patterns là các giải pháp tổng quát cho những vấn đề thường gặp trong lập trình. Bài viết này giới thiệu 10 patterns quan trọng nhất.</p><h3>1. Singleton Pattern</h3><p>Đảm bảo một class chỉ có duy nhất một instance...</p><h3>2. Factory Pattern</h3><p>Tạo objects mà không cần chỉ định exact class...</p>', NULL, 2, 1, 243, 5, '2025-11-17 10:30:00', '2025-11-20 06:00:00'),
(3, 'React Hooks: Từ cơ bản đến nâng cao', '<h2>Giới thiệu React Hooks</h2><p>React Hooks được giới thiệu từ React 16.8, thay đổi hoàn toàn cách chúng ta viết React components.</p><h3>useState Hook</h3><p>Hook cơ bản nhất để quản lý state trong functional components...</p><h3>useEffect Hook</h3><p>Xử lý side effects như fetch data, subscriptions...</p>', NULL, 5, 4, 189, 2, '2025-11-16 14:20:00', '2025-11-20 06:00:00'),
(4, 'Tối ưu hiệu năng MySQL: Indexing Strategy', '<h2>Tầm quan trọng của Index</h2><p>Index là yếu tố quyết định hiệu năng của database. Bài viết này sẽ hướng dẫn cách sử dụng index hiệu quả.</p><h3>Các loại Index</h3><ul><li>Primary Key Index</li><li>Unique Index</li><li>Composite Index</li><li>Full-text Index</li></ul>', NULL, 4, 7, 312, 7, '2025-11-15 09:15:00', '2025-11-20 06:00:00'),
(5, 'JavaScript ES2024: Những tính năng mới', '<h2>ES2024 có gì mới?</h2><p>ECMAScript 2024 mang đến nhiều tính năng mới hứa hẹn cải thiện đáng kể trải nghiệm lập trình JavaScript.</p><h3>1. Pattern Matching</h3><p>Syntax mới cho việc so khớp patterns...</p><h3>2. Temporal API</h3><p>API mới để làm việc với date và time...</p>', NULL, 5, 2, 278, 4, '2025-11-14 16:45:00', '2025-11-20 06:00:00'),
(6, 'Node.js Performance: Best Practices 2025', '<h2>Tối ưu hiệu năng Node.js</h2><p>Node.js là platform mạnh mẽ nhưng cần hiểu rõ để tối ưu hiệu năng. Dưới đây là các best practices.</p><h3>1. Sử dụng Cluster Mode</h3><p>Tận dụng multi-core CPU...</p><h3>2. Caching Strategy</h3><p>Redis, Memory cache...</p>', NULL, 4, 6, 425, 9, '2025-11-13 11:20:00', '2025-11-20 06:00:00'),
(7, 'Vue 3 Composition API: Complete Guide', '<h2>Composition API vs Options API</h2><p>Vue 3 Composition API là cách tiếp cận mới để tổ chức logic trong components.</p><h3>Setup Function</h3><p>Entry point của Composition API...</p><h3>Reactive & Ref</h3><p>Hai cách tạo reactive state...</p>', NULL, 5, 5, 198, 3, '2025-11-12 13:30:00', '2025-11-20 06:00:00'),
(8, 'RESTful API Design: Principles & Best Practices', '<h2>Nguyên tắc thiết kế RESTful API</h2><p>RESTful API là tiêu chuẩn phổ biến nhất để xây dựng web services. Bài viết này tổng hợp các best practices.</p><h3>HTTP Methods</h3><ul><li>GET - Lấy dữ liệu</li><li>POST - Tạo mới</li><li>PUT - Cập nhật toàn bộ</li><li>PATCH - Cập nhật một phần</li></ul>', NULL, 2, 1, 367, 6, '2025-11-11 10:00:00', '2025-11-20 06:00:00'),
(9, 'Responsive Web Design với CSS Grid & Flexbox', '<h2>CSS Grid vs Flexbox</h2><p>Cả Grid và Flexbox đều là công cụ mạnh mẽ cho responsive design. Bài viết này so sánh và hướng dẫn khi nào dùng tool nào.</p><h3>CSS Grid</h3><p>Phù hợp cho layout 2 chiều...</p><h3>Flexbox</h3><p>Tốt nhất cho layout 1 chiều...</p>', NULL, 5, 8, 234, 4, '2025-11-10 15:40:00', '2025-11-20 06:00:00'),
(10, 'PHP 8.3: New Features & Improvements', '<h2>PHP 8.3 có gì mới?</h2><p>PHP 8.3 được release với nhiều cải tiến về hiệu năng và tính năng mới.</p><h3>Typed Class Constants</h3><p>Giờ đây có thể type hint cho class constants...</p><h3>Dynamic Class Constant Fetch</h3><p>Fetch constant một cách dynamic...</p>', NULL, 2, 1, 412, 8, '2025-11-09 09:25:00', '2025-11-20 06:00:00'),
(11, 'Docker Compose: Orchestrating Multi-Container Apps', '<h2>Docker Compose Overview</h2><p>Docker Compose giúp định nghĩa và chạy multi-container applications. Hướng dẫn từ cơ bản đến nâng cao.</p><h3>Docker Compose File Structure</h3><p>YAML syntax, services, networks, volumes...</p><h3>Best Practices</h3><p>Environment variables, secrets management...</p>', NULL, 1, 9, 287, 0, '2025-11-08 10:15:00', '2025-11-20 06:00:00'),
(12, 'Laravel Eloquent: Advanced Query Techniques', '<h2>Eloquent ORM Mastery</h2><p>Eloquent là ORM mạnh mẽ của Laravel. Bài viết này tập trung vào các kỹ thuật query nâng cao.</p><h3>Eager Loading</h3><p>N+1 problem và cách giải quyết...</p><h3>Query Scopes</h3><p>Local và Global scopes...</p>', NULL, 2, 3, 195, 0, '2025-11-07 14:30:00', '2025-11-20 06:00:00'),
(13, 'Python Django: Building REST APIs', '<h2>Django REST Framework</h2><p>Django REST framework là toolkit mạnh mẽ để build Web APIs. Tutorial từ setup đến deployment.</p><h3>Serializers</h3><p>ModelSerializer, validation...</p><h3>ViewSets & Routers</h3><p>Automatic URL routing...</p>', NULL, 3, 10, 342, 0, '2025-11-06 11:20:00', '2025-11-20 06:00:00'),
(14, 'React Server Components: The Future', '<h2>React Server Components Explained</h2><p>Server Components là tương lai của React, mang lại hiệu năng tốt hơn và developer experience tuyệt vời.</p><h3>Server vs Client Components</h3><p>Khi nào dùng loại nào...</p><h3>Data Fetching</h3><p>Async Server Components...</p>', NULL, 5, 4, 218, 0, '2025-11-05 16:45:00', '2025-11-20 06:00:00'),
(15, 'Vue Router: Navigation Guards Deep Dive', '<h2>Vue Router Navigation Guards</h2><p>Navigation Guards cho phép control navigation trong Vue apps. Chi tiết về từng loại guard.</p><h3>Global Guards</h3><p>beforeEach, beforeResolve, afterEach...</p><h3>Per-Route Guards</h3><p>beforeEnter...</p>', NULL, 5, 5, 167, 0, '2025-11-04 13:10:00', '2025-11-20 06:00:00'),
(16, 'Node.js Streams: Processing Large Data', '<h2>Understanding Node.js Streams</h2><p>Streams cho phép xử lý large data efficiently. Hướng dẫn chi tiết về Readable, Writable, Transform streams.</p><h3>Readable Streams</h3><p>Reading data chunk by chunk...</p><h3>Pipe & Pipeline</h3><p>Composing streams...</p>', NULL, 4, 6, 294, 0, '2025-11-03 09:35:00', '2025-11-20 06:00:00'),
(17, 'PostgreSQL vs MySQL: Performance Comparison', '<h2>Database Performance Showdown</h2><p>So sánh chi tiết về performance, features và use cases của PostgreSQL và MySQL.</p><h3>Query Performance</h3><p>Benchmarks, indexing strategies...</p><h3>Advanced Features</h3><p>JSON, Full-text search...</p>', NULL, 4, 7, 401, 0, '2025-11-02 15:20:00', '2025-11-20 06:00:00'),
(18, 'Tailwind CSS: Utility-First Framework', '<h2>Tailwind CSS for Rapid Development</h2><p>Tailwind CSS là utility-first CSS framework giúp build UI nhanh chóng. Complete guide với best practices.</p><h3>Setup & Configuration</h3><p>Installation, tailwind.config.js...</p><h3>Responsive Design</h3><p>Breakpoints, mobile-first...</p>', NULL, 5, 8, 326, 0, '2025-11-01 12:40:00', '2025-11-20 06:00:00'),
(19, 'Kubernetes: Container Orchestration 101', '<h2>Getting Started with Kubernetes</h2><p>Kubernetes là platform phổ biến nhất cho container orchestration. Tutorial từ basic đến production.</p><h3>Pods & Deployments</h3><p>Creating and managing workloads...</p><h3>Services & Ingress</h3><p>Exposing applications...</p>', NULL, 1, 9, 445, 0, '2025-10-31 08:15:00', '2025-11-20 06:00:00'),
(20, 'FastAPI: Modern Python Web Framework', '<h2>FastAPI for High Performance APIs</h2><p>FastAPI là modern framework cho building APIs với Python 3.7+. Automatic docs, type hints và async support.</p><h3>Type Hints</h3><p>Pydantic models, validation...</p><h3>Async Operations</h3><p>Async/await, background tasks...</p>', NULL, 3, 10, 298, 0, '2025-10-30 14:50:00', '2025-11-20 06:00:00'),
(21, 'React Native: Cross-Platform Mobile Apps', '<h2>Building Mobile Apps with React Native</h2><p>React Native cho phép build native mobile apps bằng JavaScript. Complete guide từ setup đến publish.</p><h3>Core Components</h3><p>View, Text, Image, ScrollView...</p><h3>Navigation</h3><p>React Navigation setup...</p>', NULL, 5, 11, 372, 0, '2025-10-29 11:25:00', '2025-11-20 06:00:00'),
(22, 'OWASP Top 10: Web Security Essentials', '<h2>Web Security Best Practices</h2><p>OWASP Top 10 là danh sách các vulnerability phổ biến nhất. Hướng dẫn identify và prevent.</p><h3>Injection Attacks</h3><p>SQL injection, XSS prevention...</p><h3>Authentication</h3><p>Broken authentication, session management...</p>', NULL, 3, 12, 419, 0, '2025-10-28 16:30:00', '2025-11-20 06:00:00'),
(23, 'AWS Lambda: Serverless Computing', '<h2>Serverless with AWS Lambda</h2><p>AWS Lambda cho phép run code without managing servers. Tutorial về function creation, triggers và best practices.</p><h3>Lambda Functions</h3><p>Writing handlers, environment variables...</p><h3>Event Sources</h3><p>API Gateway, S3, DynamoDB...</p>', NULL, 2, 13, 356, 0, '2025-10-27 10:45:00', '2025-11-20 06:00:00'),
(24, 'TensorFlow 2.0: Deep Learning Guide', '<h2>Deep Learning with TensorFlow</h2><p>TensorFlow 2.0 simplifies deep learning development. Hướng dẫn build và train neural networks.</p><h3>Keras API</h3><p>Sequential và Functional API...</p><h3>Model Training</h3><p>Optimizers, loss functions...</p>', NULL, 4, 14, 267, 0, '2025-10-26 13:20:00', '2025-11-20 06:00:00'),
(25, 'Figma for Developers: Design to Code', '<h2>Bridging Design and Development</h2><p>Figma là design tool mạnh mẽ. Hướng dẫn developers làm việc với Figma designs và convert to code.</p><h3>Inspect Mode</h3><p>Reading CSS, dimensions...</p><h3>Auto Layout</h3><p>Understanding constraints...</p>', NULL, 5, 15, 189, 0, '2025-10-25 15:55:00', '2025-11-20 06:00:00'),
(26, 'Git Workflow: Feature Branch Strategy', '<h2>Git Branching Best Practices</h2><p>Feature branch workflow là phổ biến nhất trong teams. Chi tiết về branching, merging và conflicts.</p><h3>Branch Naming</h3><p>Conventions, feature/bugfix...</p><h3>Pull Requests</h3><p>Code review process...</p>', NULL, 2, 16, 223, 0, '2025-10-24 09:10:00', '2025-11-20 06:00:00'),
(27, 'GraphQL: Modern API Development', '<h2>GraphQL vs REST</h2><p>GraphQL là query language for APIs. Tutorial về schema definition, resolvers và client integration.</p><h3>Schema Design</h3><p>Types, queries, mutations...</p><h3>Apollo Server</h3><p>Setting up GraphQL server...</p>', NULL, 3, 17, 312, 0, '2025-10-23 14:35:00', '2025-11-20 06:00:00'),
(28, 'TypeScript Decorators: Meta Programming', '<h2>Advanced TypeScript Features</h2><p>Decorators là experimental feature trong TypeScript. Hướng dẫn sử dụng class, method và property decorators.</p><h3>Class Decorators</h3><p>Modifying class behavior...</p><h3>Metadata</h3><p>reflect-metadata package...</p>', NULL, 5, 18, 198, 0, '2025-10-22 11:50:00', '2025-11-20 06:00:00'),
(29, 'Microservices Communication Patterns', '<h2>Inter-Service Communication</h2><p>Communication patterns trong microservices architecture. Synchronous vs Asynchronous messaging.</p><h3>REST APIs</h3><p>HTTP/gRPC for sync communication...</p><h3>Message Queues</h3><p>RabbitMQ, Kafka for async...</p>', NULL, 2, 19, 387, 0, '2025-10-21 16:15:00', '2025-11-20 06:00:00'),
(30, 'Web Performance: Core Web Vitals', '<h2>Optimizing Core Web Vitals</h2><p>Core Web Vitals là metrics quan trọng cho user experience. Hướng dẫn improve LCP, FID, CLS.</p><h3>Largest Contentful Paint</h3><p>Image optimization, lazy loading...</p><h3>Cumulative Layout Shift</h3><p>Preventing layout shifts...</p>', NULL, 4, 20, 276, 0, '2025-10-20 12:40:00', '2025-11-20 06:00:00'),
(31, 'PHP Attributes: Modern Metadata', '<h2>PHP 8 Attributes Explained</h2><p>Attributes là tính năng mới trong PHP 8 thay thế docblock annotations. Clean syntax và type-safe.</p><h3>Built-in Attributes</h3><p>#[Deprecated], #[Override]...</p><h3>Custom Attributes</h3><p>Creating và using custom attributes...</p>', NULL, 1, 1, 154, 0, '2025-10-19 08:25:00', '2025-11-20 06:00:00'),
(32, 'JavaScript Generators: Async Iteration', '<h2>Understanding Generators</h2><p>Generator functions cho phép pause và resume execution. Powerful tool cho async programming.</p><h3>yield Keyword</h3><p>Yielding values, two-way communication...</p><h3>Async Generators</h3><p>for await...of loops...</p>', NULL, 5, 2, 211, 0, '2025-10-18 13:50:00', '2025-11-20 06:00:00'),
(33, 'Laravel Queue: Background Processing', '<h2>Laravel Queue System</h2><p>Queue system trong Laravel giúp defer time-consuming tasks. Tutorial về jobs, workers và monitoring.</p><h3>Creating Jobs</h3><p>Job classes, dispatching...</p><h3>Queue Drivers</h3><p>Database, Redis, SQS...</p>', NULL, 3, 3, 329, 0, '2025-10-17 10:15:00', '2025-11-20 06:00:00'),
(34, 'Next.js 14: App Router Deep Dive', '<h2>Next.js App Router</h2><p>App Router là routing system mới trong Next.js 13+. Server Components, layouts và data fetching.</p><h3>File-based Routing</h3><p>app directory structure...</p><h3>Server Actions</h3><p>Mutations without API routes...</p>', NULL, 5, 4, 445, 0, '2025-10-16 15:30:00', '2025-11-20 06:00:00'),
(35, 'Vuex vs Pinia: State Management', '<h2>Vue State Management Comparison</h2><p>Pinia là state management library mới cho Vue 3. So sánh với Vuex và migration guide.</p><h3>Pinia Stores</h3><p>Defining stores, composition API...</p><h3>Migration from Vuex</h3><p>Step by step guide...</p>', NULL, 4, 5, 267, 0, '2025-10-15 11:45:00', '2025-11-20 06:00:00'),
(36, 'Express.js Middleware: Complete Guide', '<h2>Understanding Express Middleware</h2><p>Middleware functions là core concept trong Express.js. Tutorial về built-in, third-party và custom middleware.</p><h3>Middleware Types</h3><p>Application, router, error-handling...</p><h3>Custom Middleware</h3><p>Writing reusable middleware...</p>', NULL, 4, 6, 318, 0, '2025-10-14 14:20:00', '2025-11-20 06:00:00'),
(37, 'MongoDB Aggregation Pipeline', '<h2>Advanced MongoDB Queries</h2><p>Aggregation pipeline cho phép process data và return computed results. Powerful alternative to MapReduce.</p><h3>Pipeline Stages</h3><p>$match, $group, $project...</p><h3>Performance Tips</h3><p>Index usage, $lookup optimization...</p>', NULL, 3, 7, 392, 0, '2025-10-13 09:35:00', '2025-11-20 06:00:00'),
(38, 'CSS Grid Layout: Complete Tutorial', '<h2>Mastering CSS Grid</h2><p>CSS Grid là powerful layout system. Comprehensive guide về grid containers, items và responsive design.</p><h3>Grid Template</h3><p>Rows, columns, areas...</p><h3>Grid Auto Placement</h3><p>Auto-flow, dense packing...</p>', NULL, 5, 8, 256, 0, '2025-10-12 16:50:00', '2025-11-20 06:00:00'),
(39, 'CI/CD with GitHub Actions', '<h2>Automating Workflows</h2><p>GitHub Actions là built-in CI/CD platform. Tutorial về workflows, actions và deployment automation.</p><h3>Workflow Syntax</h3><p>YAML configuration, triggers...</p><h3>Custom Actions</h3><p>Docker, JavaScript actions...</p>', NULL, 2, 9, 378, 0, '2025-10-11 12:15:00', '2025-11-20 06:00:00'),
(40, 'Flutter: Building Beautiful Apps', '<h2>Flutter Cross-Platform Development</h2><p>Flutter cho phép build natively compiled applications. Dart language, widgets và state management.</p><h3>Widget Tree</h3><p>StatelessWidget, StatefulWidget...</p><h3>State Management</h3><p>Provider, Riverpod, BLoC...</p>', NULL, 1, 11, 423, 0, '2025-10-10 08:40:00', '2025-11-20 06:00:00');

--
-- Triggers `posts`
--
DELIMITER $$
CREATE TRIGGER `after_post_delete` AFTER DELETE ON `posts` FOR EACH ROW BEGIN
    IF OLD.category_id IS NOT NULL THEN
        UPDATE categories 
        SET post_count = post_count - 1 
        WHERE id = OLD.category_id;
    END IF;
END$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_post_insert` AFTER INSERT ON `posts` FOR EACH ROW BEGIN
    IF NEW.category_id IS NOT NULL THEN
        UPDATE categories 
        SET post_count = post_count + 1 
        WHERE id = NEW.category_id;
    END IF;
END$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_post_update` AFTER UPDATE ON `posts` FOR EACH ROW BEGIN
    -- Chỉ cập nhật khi category_id thay đổi
    IF OLD.category_id != NEW.category_id OR (OLD.category_id IS NULL AND NEW.category_id IS NOT NULL) OR (OLD.category_id IS NOT NULL AND NEW.category_id IS NULL) THEN
        -- Giảm count ở category cũ
        IF OLD.category_id IS NOT NULL THEN
            UPDATE categories 
            SET post_count = post_count - 1 
            WHERE id = OLD.category_id;
        END IF;
        
        -- Tăng count ở category mới
        IF NEW.category_id IS NOT NULL THEN
            UPDATE categories 
            SET post_count = post_count + 1 
            WHERE id = NEW.category_id;
        END IF;
    END IF;
    END$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `role` enum('admin','editor','author') DEFAULT 'author',
  `status` enum('active','inactive','banned') DEFAULT 'active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_token` varchar(100) DEFAULT NULL,
  `verification_token_expires` timestamp NULL DEFAULT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_token_expires` timestamp NULL DEFAULT NULL,
  `post_count` int(10) UNSIGNED DEFAULT 0,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `fullname`, `avatar`, `phone`, `bio`, `role`, `status`, `email_verified_at`, `verification_token`, `verification_token_expires`, `reset_token`, `reset_token_expires`, `post_count`, `last_login_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@devblog.com', '$2y$10$e8zDz3p3OPnS7fgxk1ZGHeVKqL7H5mhI9nxB7M9IqKqj5Q5yQZLRO', 'Admin DevBlog', 'default-avatar.jpg', '0901234567', 'Quản trị viên hệ thống DevBlog CMS', 'admin', 'active', '2025-11-20 06:00:00', NULL, NULL, NULL, NULL, 5, '2025-11-20 10:30:00', '2025-11-19 02:00:00', '2025-11-20 06:00:00'),
(2, 'trgiahuy14', 'trgiahuy14@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Trần Gia Huy', 'default-avatar.jpg', '0912345678', 'Full-stack Developer, chuyên về PHP & JavaScript', 'admin', 'active', '2025-11-20 06:00:00', NULL, NULL, NULL, NULL, 10, '2025-11-20 09:15:00', '2025-11-19 03:00:00', '2025-11-20 06:00:00'),
(3, 'editor01', 'editor@devblog.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Văn A', 'default-avatar.jpg', '0923456789', 'Editor chính, phụ trách review và chỉnh sửa bài viết', 'editor', 'active', '2025-11-20 06:00:00', NULL, NULL, NULL, NULL, 5, '2025-11-20 08:45:00', '2025-11-19 04:00:00', '2025-11-20 06:00:00'),
(4, 'author_minh', 'minhdev@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lê Văn Minh', 'default-avatar.jpg', '0934567890', 'Backend Developer, yêu thích Laravel và Node.js', 'author', 'active', '2025-11-20 06:00:00', NULL, NULL, NULL, NULL, 8, '2025-11-20 07:20:00', '2025-11-19 05:00:00', '2025-11-20 06:00:00'),
(5, 'author_thu', 'thudev@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Phạm Thu Hà', 'default-avatar.jpg', '0945678901', 'Frontend Developer, chuyên về React và Vue', 'author', 'active', '2025-11-20 06:00:00', NULL, NULL, NULL, NULL, 12, '2025-11-20 06:50:00', '2025-11-19 06:00:00', '2025-11-20 06:00:00'),
(6, 'coder_nam', 'namdev@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Phạm Quốc Nam', 'default-avatar.jpg', '0956789012', 'DevOps Engineer, Docker & Kubernetes enthusiast', 'author', 'active', '2025-11-19 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-19 14:30:00', '2025-11-18 02:00:00', '2025-11-19 06:00:00'),
(7, 'designer_linh', 'linhdesign@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Thùy Linh', 'default-avatar.jpg', '0967890123', 'UI/UX Designer & Frontend Developer', 'author', 'active', '2025-11-18 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-19 11:20:00', '2025-11-17 03:00:00', '2025-11-18 06:00:00'),
(8, 'dbmaster', 'dbexpert@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Trần Văn Đức', 'default-avatar.jpg', '0978901234', 'Database Administrator, PostgreSQL & MySQL expert', 'author', 'active', '2025-11-17 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-18 16:45:00', '2025-11-16 04:00:00', '2025-11-17 06:00:00'),
(9, 'security_pro', 'security@devblog.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lê Thanh Tùng', 'default-avatar.jpg', '0989012345', 'Security Researcher & Penetration Tester', 'author', 'active', '2025-11-16 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-17 09:30:00', '2025-11-15 05:00:00', '2025-11-16 06:00:00'),
(10, 'mobile_dev', 'mobiledev@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hoàng Minh Tuấn', 'default-avatar.jpg', '0990123456', 'Mobile Developer - React Native & Flutter', 'author', 'active', '2025-11-15 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-16 13:15:00', '2025-11-14 06:00:00', '2025-11-15 06:00:00'),
(11, 'ai_enthusiast', 'aidev@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Hoàng Long', 'default-avatar.jpg', '0912345670', 'AI/ML Engineer, Python & TensorFlow', 'author', 'active', '2025-11-14 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-15 10:20:00', '2025-11-13 02:00:00', '2025-11-14 06:00:00'),
(12, 'cloud_architect', 'cloudexpert@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vũ Đức Anh', 'default-avatar.jpg', '0923456781', 'Cloud Solutions Architect - AWS & Azure', 'author', 'active', '2025-11-13 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-14 15:40:00', '2025-11-12 03:00:00', '2025-11-13 06:00:00'),
(13, 'data_scientist', 'datascience@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Phạm Thị Hương', 'default-avatar.jpg', '0934567892', 'Data Scientist, R & Python', 'author', 'active', '2025-11-12 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-13 08:25:00', '2025-11-11 04:00:00', '2025-11-12 06:00:00'),
(14, 'blockchain_dev', 'blockchain@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Đặng Minh Khoa', 'default-avatar.jpg', '0945678903', 'Blockchain Developer - Solidity & Web3', 'author', 'active', '2025-11-11 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-12 12:50:00', '2025-11-10 05:00:00', '2025-11-11 06:00:00'),
(15, 'game_developer', 'gamedev@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Trương Văn Hải', 'default-avatar.jpg', '0956789014', 'Game Developer - Unity & Unreal Engine', 'author', 'active', '2025-11-10 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-11 17:10:00', '2025-11-09 06:00:00', '2025-11-10 06:00:00'),
(16, 'fullstack_js', 'fullstackjs@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lý Thanh Tùng', 'default-avatar.jpg', '0967890125', 'Full-stack JavaScript Developer - MERN Stack', 'author', 'active', '2025-11-09 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-10 09:35:00', '2025-11-08 02:00:00', '2025-11-09 06:00:00'),
(17, 'python_guru', 'pythonguru@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Bùi Văn Thành', 'default-avatar.jpg', '0978901236', 'Python Developer - Django & FastAPI', 'author', 'active', '2025-11-08 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-09 14:20:00', '2025-11-07 03:00:00', '2025-11-08 06:00:00'),
(18, 'ios_developer', 'iosdev@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ngô Minh Đức', 'default-avatar.jpg', '0989012347', 'iOS Developer - Swift & SwiftUI', 'author', 'active', '2025-11-07 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-08 11:45:00', '2025-11-06 04:00:00', '2025-11-07 06:00:00'),
(19, 'android_pro', 'androidpro@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Đỗ Công Minh', 'default-avatar.jpg', '0990123458', 'Android Developer - Kotlin & Jetpack Compose', 'author', 'active', '2025-11-06 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-07 15:30:00', '2025-11-05 05:00:00', '2025-11-06 06:00:00'),
(20, 'qa_tester', 'qaexpert@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Phan Thị Mai', 'default-avatar.jpg', '0912345671', 'QA Engineer - Automation Testing Expert', 'author', 'active', '2025-11-05 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-06 10:15:00', '2025-11-04 06:00:00', '2025-11-05 06:00:00'),
(21, 'tech_writer', 'techwriter@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lâm Thị Hà', 'default-avatar.jpg', '0923456782', 'Technical Writer & Documentation Specialist', 'author', 'active', '2025-11-04 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-05 13:40:00', '2025-11-03 02:00:00', '2025-11-04 06:00:00'),
(22, 'scrum_master', 'scrummaster@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Võ Văn Tâm', 'default-avatar.jpg', '0934567893', 'Scrum Master & Agile Coach', 'author', 'active', '2025-11-03 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-04 16:25:00', '2025-11-02 03:00:00', '2025-11-03 06:00:00'),
(23, 'product_owner', 'productowner@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Đinh Thị Lan', 'default-avatar.jpg', '0945678904', 'Product Owner & Business Analyst', 'author', 'active', '2025-11-02 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-03 09:50:00', '2025-11-01 04:00:00', '2025-11-02 06:00:00'),
(24, 'sys_admin', 'sysadmin@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Trịnh Văn Kiên', 'default-avatar.jpg', '0956789015', 'System Administrator - Linux & Networking', 'author', 'active', '2025-11-01 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-02 14:30:00', '2025-10-31 05:00:00', '2025-11-01 06:00:00'),
(25, 'web_designer', 'webdesigner@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hồ Thị Ngọc', 'default-avatar.jpg', '0967890126', 'Web Designer - Figma & Adobe XD', 'author', 'active', '2025-10-31 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-11-01 11:15:00', '2025-10-30 06:00:00', '2025-10-31 06:00:00'),
(26, 'seo_expert', 'seoexpert@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dương Văn Thắng', 'default-avatar.jpg', '0978901237', 'SEO Specialist & Digital Marketing', 'author', 'active', '2025-10-30 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-10-31 16:40:00', '2025-10-29 02:00:00', '2025-10-30 06:00:00'),
(27, 'content_creator', 'contentcreator@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lương Thị Huyền', 'default-avatar.jpg', '0989012348', 'Content Creator & Social Media Manager', 'author', 'active', '2025-10-29 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-10-30 08:20:00', '2025-10-28 03:00:00', '2025-10-29 06:00:00'),
(28, 'video_editor', 'videoeditor@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Cao Văn Dũng', 'default-avatar.jpg', '0990123459', 'Video Editor - Adobe Premiere & After Effects', 'author', 'active', '2025-10-28 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-10-29 12:35:00', '2025-10-27 04:00:00', '2025-10-28 06:00:00'),
(29, 'graphic_designer', 'graphicdesign@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Mai Thị Thảo', 'default-avatar.jpg', '0912345672', 'Graphic Designer - Photoshop & Illustrator', 'author', 'active', '2025-10-27 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-10-28 15:50:00', '2025-10-26 05:00:00', '2025-10-27 06:00:00'),
(30, 'copywriter', 'copywriter@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lưu Văn Hùng', 'default-avatar.jpg', '0923456783', 'Copywriter & Creative Writer', 'author', 'active', '2025-10-26 06:00:00', NULL, NULL, NULL, NULL, 0, '2025-10-27 09:10:00', '2025-10-25 06:00:00', '2025-10-26 06:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_post_id` (`post_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_parent_id` (`parent_id`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_author_id` (`author_id`),
  ADD KEY `posts_ibfk_2` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_role` (`role`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
