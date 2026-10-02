-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2026 at 10:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_study_center_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `seat_id` int(11) DEFAULT NULL,
  `slot_id` int(11) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `plane_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `payment_status` enum('pending','paid','cancelled') DEFAULT 'pending',
  `booking_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `seat_id`, `slot_id`, `student_id`, `plane_id`, `status`, `payment_status`, `booking_at`) VALUES
(12, 720, 52, 4, 8, 'Booked', 'pending', '2026-07-23 19:33:10'),
(13, 620, 50, 4, 9, 'Booked', 'pending', '2026-07-23 19:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `complaint_no` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `status` enum('pending','in_progress','resolved') DEFAULT 'pending',
  `resolve_note` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `complaint_no`, `student_id`, `category`, `file`, `description`, `status`, `resolve_note`, `created_at`) VALUES
(23, 927740002, 2, 'TimeSlot', NULL, 'eving', 'pending', NULL, '2026-07-17 14:29:29'),
(24, 168902769, 4, 'TimeSlot', NULL, '🙏🏼  Create 5pm to 7pm time slot', 'pending', NULL, '2026-07-23 12:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `seat` varchar(50) DEFAULT NULL,
  `membership` varchar(50) DEFAULT NULL,
  `environment` varchar(50) DEFAULT NULL,
  `electronics` varchar(50) DEFAULT NULL,
  `internet` varchar(50) DEFAULT NULL,
  `rating` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `student_id`, `seat`, `membership`, `environment`, `electronics`, `internet`, `rating`, `message`, `created_at`) VALUES
(1, 1, 'Very Good', 'Very Good', 'Very Good', 'Very Good', 'Very Good', 'Good', 'hiiii', '2026-05-18 03:34:54'),
(4, 4, 'Very Good', 'Very Good', 'Very Good', 'Average', 'Good', 'Very Good', '', '2026-07-26 13:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `library_info`
--

CREATE TABLE `library_info` (
  `library_id` int(11) NOT NULL,
  `library_name` varchar(150) NOT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `opening_time` time DEFAULT NULL,
  `closing_time` time DEFAULT NULL,
  `total_seats` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `library_info`
--

INSERT INTO `library_info` (`library_id`, `library_name`, `address`, `city`, `state`, `country`, `pincode`, `contact_number`, `email`, `opening_time`, `closing_time`, `total_seats`, `created_at`, `updated_at`) VALUES
(1, 'Study Hard', 'muzaffarpur,bihar', 'muzaffarpur', 'bihar', 'india', '843113', '7033670125', 'studyhard.s@gmail.com', '06:00:00', '09:00:00', 50, '2026-04-15 15:19:58', '2026-04-15 15:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `login_auth`
--

CREATE TABLE `login_auth` (
  `id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` int(11) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_auth`
--

INSERT INTO `login_auth` (`id`, `user_type`, `email_id`, `password`, `token`, `token_expiry`, `created_at`, `updated_at`) VALUES
(10, 1, 'admin1.library@gmail.com', '$2y$10$RmrgVVF1HxA8sjJCtbeFVuEoJ89/QWQr3fYJkokpyNuhJtUHlSxlS', NULL, NULL, '2026-05-02 08:56:34', '2026-05-13 12:44:20'),
(14, 2, 'golu703.k@gmail.com', '$2y$10$EQmuqT0B7NbvoBb4PX5wbe//OnCrM02g9KqMql1hMEet8W2SX/sti', 424905, '2026-07-26 18:00:23', '2026-07-23 12:34:06', '2026-07-26 12:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `notification`, `created_at`) VALUES
(1, 'Closed', 'Today closode center\r\n', '2026-07-17 19:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `duration_days` int(11) DEFAULT NULL,
  `features` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`plan_id`, `plan_name`, `amount`, `duration_days`, `features`, `created_at`) VALUES
(7, 'regular', 50, 1, 'all\r\n', '2026-05-02 11:42:49'),
(8, 'Monthly', 999, 30, '', '2026-07-23 14:05:43'),
(9, 'Quarterly  Plan', 2899, 90, '', '2026-07-23 14:07:27'),
(11, 'yearly', 10999, 365, '', '2026-07-23 14:09:37'),
(12, 'bi-yearly', 5699, 180, '', '2026-07-23 14:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `library_id` int(11) DEFAULT NULL,
  `slot_id` int(11) DEFAULT NULL,
  `seat_number` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `library_id`, `slot_id`, `seat_number`, `created_at`, `updated_at`) VALUES
(601, 1, 50, '1', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(602, 1, 50, '2', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(603, 1, 50, '3', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(604, 1, 50, '4', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(605, 1, 50, '5', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(606, 1, 50, '6', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(607, 1, 50, '7', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(608, 1, 50, '8', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(609, 1, 50, '9', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(610, 1, 50, '10', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(611, 1, 50, '11', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(612, 1, 50, '12', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(613, 1, 50, '13', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(614, 1, 50, '14', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(615, 1, 50, '15', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(616, 1, 50, '16', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(617, 1, 50, '17', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(618, 1, 50, '18', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(619, 1, 50, '19', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(620, 1, 50, '20', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(621, 1, 50, '21', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(622, 1, 50, '22', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(623, 1, 50, '23', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(624, 1, 50, '24', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(625, 1, 50, '25', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(626, 1, 50, '26', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(627, 1, 50, '27', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(628, 1, 50, '28', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(629, 1, 50, '29', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(630, 1, 50, '30', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(631, 1, 50, '31', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(632, 1, 50, '32', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(633, 1, 50, '33', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(634, 1, 50, '34', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(635, 1, 50, '35', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(636, 1, 50, '36', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(637, 1, 50, '37', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(638, 1, 50, '38', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(639, 1, 50, '39', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(640, 1, 50, '40', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(641, 1, 50, '41', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(642, 1, 50, '42', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(643, 1, 50, '43', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(644, 1, 50, '44', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(645, 1, 50, '45', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(646, 1, 50, '46', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(647, 1, 50, '47', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(648, 1, 50, '48', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(649, 1, 50, '49', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(650, 1, 50, '50', '2026-07-23 08:20:18', '2026-07-23 08:20:18'),
(651, 1, 51, '1', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(652, 1, 51, '2', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(653, 1, 51, '3', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(654, 1, 51, '4', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(655, 1, 51, '5', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(656, 1, 51, '6', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(657, 1, 51, '7', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(658, 1, 51, '8', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(659, 1, 51, '9', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(660, 1, 51, '10', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(661, 1, 51, '11', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(662, 1, 51, '12', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(663, 1, 51, '13', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(664, 1, 51, '14', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(665, 1, 51, '15', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(666, 1, 51, '16', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(667, 1, 51, '17', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(668, 1, 51, '18', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(669, 1, 51, '19', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(670, 1, 51, '20', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(671, 1, 51, '21', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(672, 1, 51, '22', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(673, 1, 51, '23', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(674, 1, 51, '24', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(675, 1, 51, '25', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(676, 1, 51, '26', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(677, 1, 51, '27', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(678, 1, 51, '28', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(679, 1, 51, '29', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(680, 1, 51, '30', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(681, 1, 51, '31', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(682, 1, 51, '32', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(683, 1, 51, '33', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(684, 1, 51, '34', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(685, 1, 51, '35', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(686, 1, 51, '36', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(687, 1, 51, '37', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(688, 1, 51, '38', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(689, 1, 51, '39', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(690, 1, 51, '40', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(691, 1, 51, '41', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(692, 1, 51, '42', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(693, 1, 51, '43', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(694, 1, 51, '44', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(695, 1, 51, '45', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(696, 1, 51, '46', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(697, 1, 51, '47', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(698, 1, 51, '48', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(699, 1, 51, '49', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(700, 1, 51, '50', '2026-07-23 08:24:02', '2026-07-23 08:24:02'),
(701, 1, 52, '1', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(702, 1, 52, '2', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(703, 1, 52, '3', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(704, 1, 52, '4', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(705, 1, 52, '5', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(706, 1, 52, '6', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(707, 1, 52, '7', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(708, 1, 52, '8', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(709, 1, 52, '9', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(710, 1, 52, '10', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(711, 1, 52, '11', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(712, 1, 52, '12', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(713, 1, 52, '13', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(714, 1, 52, '14', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(715, 1, 52, '15', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(716, 1, 52, '16', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(717, 1, 52, '17', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(718, 1, 52, '18', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(719, 1, 52, '19', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(720, 1, 52, '20', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(721, 1, 52, '21', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(722, 1, 52, '22', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(723, 1, 52, '23', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(724, 1, 52, '24', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(725, 1, 52, '25', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(726, 1, 52, '26', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(727, 1, 52, '27', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(728, 1, 52, '28', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(729, 1, 52, '29', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(730, 1, 52, '30', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(731, 1, 52, '31', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(732, 1, 52, '32', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(733, 1, 52, '33', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(734, 1, 52, '34', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(735, 1, 52, '35', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(736, 1, 52, '36', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(737, 1, 52, '37', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(738, 1, 52, '38', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(739, 1, 52, '39', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(740, 1, 52, '40', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(741, 1, 52, '41', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(742, 1, 52, '42', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(743, 1, 52, '43', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(744, 1, 52, '44', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(745, 1, 52, '45', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(746, 1, 52, '46', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(747, 1, 52, '47', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(748, 1, 52, '48', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(749, 1, 52, '49', '2026-07-23 08:24:38', '2026-07-23 08:24:38'),
(750, 1, 52, '50', '2026-07-23 08:24:38', '2026-07-23 08:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(50) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `student_email` varchar(100) DEFAULT NULL,
  `student_phone` varchar(15) DEFAULT NULL,
  `student_gender` varchar(20) DEFAULT NULL,
  `student_dob` date NOT NULL,
  `identity_type` varchar(50) NOT NULL,
  `student_id_proof` varchar(255) DEFAULT NULL,
  `student_image` varchar(255) DEFAULT NULL,
  `corresponding_address` varchar(255) DEFAULT NULL,
  `tem_city` varchar(50) DEFAULT NULL,
  `tem_state` varchar(50) DEFAULT NULL,
  `tem_pincode` varchar(10) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `p_city` varchar(50) DEFAULT NULL,
  `p_state` varchar(50) DEFAULT NULL,
  `p_pincode` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`student_id`, `student_name`, `firstname`, `lastname`, `student_email`, `student_phone`, `student_gender`, `student_dob`, `identity_type`, `student_id_proof`, `student_image`, `corresponding_address`, `tem_city`, `tem_state`, `tem_pincode`, `permanent_address`, `p_city`, `p_state`, `p_pincode`, `created_at`) VALUES
(4, 'Golu Kumar', 'Golu', 'Kumar', 'golu703.k@gmail.com', '7033670192', 'Male', '2004-05-16', 'Aadhar Card', '6a61bce642a35.pdf', '6a61bce642e07.jpg', 'pakri jalal, post-shubhankarpur, p.s-kanti,marwan, Muzaffarpur', 'muzaffarpur', 'Bihar', '843113', 'pakri jalal, post-shubhankarpur, p.s-kanti,marwan, Muzaffarpur', 'muzaffarpur', 'Bihar', '843113', '2026-07-23 12:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `id` int(11) NOT NULL,
  `slot_name` varchar(255) DEFAULT NULL,
  `start_time` varchar(10) DEFAULT NULL,
  `end_time` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`id`, `slot_name`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(50, 'morning', '06:00:AM', '10:00:AM', '2026-07-23 13:50:12', '2026-07-23 13:50:12'),
(51, 'morning', '10:00:AM', '02:00:PM', '2026-07-23 13:53:57', '2026-07-23 13:53:57'),
(52, 'afternonn', '02:00:PM', '06:00:PM', '2026-07-23 13:54:33', '2026-07-23 13:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_logs`
--

CREATE TABLE `user_activity_logs` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `device_info` text NOT NULL,
  `activity` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_activity_logs`
--

INSERT INTO `user_activity_logs` (`id`, `student_id`, `login_time`, `logout_time`, `device_info`, `activity`, `created_at`) VALUES
(73, 4, '2026-07-23 12:34:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'login', '2026-07-23 12:34:48'),
(74, 4, '2026-07-23 12:36:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'Booked seat', '2026-07-23 12:36:34'),
(75, 4, '2026-07-23 12:39:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'Student  Registered Complaint', '2026-07-23 12:39:28'),
(76, 4, NULL, '2026-07-23 01:43:00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'logout', '2026-07-23 13:43:07'),
(77, 4, '2026-07-23 01:50:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'login', '2026-07-23 13:50:59'),
(78, 4, '2026-07-23 02:14:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'Booked seat', '2026-07-23 14:14:44'),
(79, 4, NULL, '2026-07-23 02:16:00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'logout', '2026-07-23 14:16:15'),
(80, 4, '2026-07-23 06:50:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'login', '2026-07-23 18:50:02'),
(81, 4, '2026-07-23 06:57:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'Booked seat', '2026-07-23 18:57:06'),
(82, 4, '2026-07-23 07:06:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'Booked seat', '2026-07-23 19:06:21'),
(83, 4, NULL, '2026-07-23 07:14:00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'logout', '2026-07-23 19:14:05'),
(84, 4, '2026-07-23 07:32:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'login', '2026-07-23 19:32:02'),
(85, 4, '2026-07-23 07:32:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'Booked seat', '2026-07-23 19:32:10'),
(86, 4, '2026-07-23 07:33:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'Booked seat', '2026-07-23 19:33:10'),
(87, 4, '2026-07-23 07:33:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'Booked seat', '2026-07-23 19:33:29'),
(88, 4, NULL, '2026-07-23 07:35:00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'logout', '2026-07-23 19:35:01'),
(89, 4, '2026-07-26 06:14:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'login', '2026-07-26 18:14:08'),
(90, 4, NULL, '2026-07-26 06:14:00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'logout', '2026-07-26 18:14:19'),
(91, 4, '2026-07-26 06:38:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'login', '2026-07-26 18:38:30'),
(92, 4, '2026-07-26 06:39:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'Submit Feedback', '2026-07-26 18:39:04'),
(93, 4, NULL, '2026-07-26 06:39:00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'logout', '2026-07-26 18:39:14'),
(94, 4, '2026-08-08 08:52:00', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'login', '2026-08-08 20:52:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_booking` (`slot_id`,`seat_id`),
  ADD UNIQUE KEY `seat_id` (`seat_id`,`slot_id`),
  ADD KEY `fk_bookings_plane_id` (`plane_id`),
  ADD KEY `fk_user_book` (`student_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD UNIQUE KEY `complaint_no` (`complaint_no`),
  ADD KEY `fk_user` (`student_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library_info`
--
ALTER TABLE `library_info`
  ADD PRIMARY KEY (`library_id`);

--
-- Indexes for table `login_auth`
--
ALTER TABLE `login_auth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_slot_seat` (`slot_id`,`seat_number`),
  ADD UNIQUE KEY `slot_id` (`slot_id`,`seat_number`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_email` (`student_email`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_activity` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `library_info`
--
ALTER TABLE `library_info`
  MODIFY `library_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_auth`
--
ALTER TABLE `login_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=751;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`slot_id`) REFERENCES `time_slot` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bookings_plane_id` FOREIGN KEY (`plane_id`) REFERENCES `plans` (`plan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_book` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`student_id`);

--
-- Constraints for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  ADD CONSTRAINT `fk_user_activity` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`student_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
