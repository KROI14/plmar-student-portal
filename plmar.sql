-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2021 at 11:49 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plmar`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `StudentID` varchar(50) NOT NULL,
  `HouseNo` varchar(50) NOT NULL,
  `Street` varchar(50) NOT NULL,
  `Barangay` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Province` varchar(50) NOT NULL,
  `Residency` varchar(20) NOT NULL DEFAULT 'n/a'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`StudentID`, `HouseNo`, `Street`, `Barangay`, `City`, `Province`, `Residency`) VALUES
('ST-0001', '168-354', 'Sed Rd.', 'Pinagbuhatan', 'Pasig City', 'Metro Manila', 'non-marikina'),
('ST-0002', 'Ap #998-1692', 'Sem. Road', 'Barangka', 'Marikina City', 'Metro Manila', 'marikina'),
('ST-0003', '746-1629', 'Quisque Ave', 'San Roque', 'Cainta', 'Rizal', 'non-marikina'),
('ST-0004', '8510', 'Per Street', 'Caniogan', 'Pasig City', 'Metro Manila', 'non-marikina');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` varchar(50) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Birthdate` date NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Department` varchar(20) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Firstname`, `Lastname`, `Birthdate`, `Role`, `Department`, `Username`, `Password`, `Image`) VALUES
('AD-0001', 'Marcy', 'Teodoro', '1970-08-02', 'admin', 'REGISTRAR', 'teodoro.adm@plmar', '12345678', 'marcy.jpg'),
('AD-0002', 'Bill', 'Gates', '1995-10-28', 'dean', 'IT', 'gates.dean@plmar', '12345678', 'Bill-Gates-2011.jpg'),
('AD-0003', 'Marion', 'Andres', '1958-07-28', 'admin', 'BURSAR', 'andres.adm@plmar', '12345678', 'Cf6b2vgUkAAefSf.jpg'),
('AD-0004', 'Sigmund', 'Freud', '1939-09-23', 'dean', 'PSYCH', 'freud.dean@plmar', '12345678', 'Sigmund_Freud,_by_Max_Halberstadt_(cropped).jpg'),
('AD-0005', 'Oprah', 'Winfrey', '1954-01-29', 'dean', 'COMM', 'winfrey.dean@plmar', '12345678', 'image.jfif'),
('AD-0006', 'Randy', 'Dellosa', '1969-02-04', 'faculty', 'PSYCH', 'dellosa.faculty@plmar', '12345678', 'randy-dellosa-73761a92-2e92-4cd9-a8b5-1cf83d49c88-resize-750.jpeg'),
('AD-0007', 'John', 'Anderson', '1948-03-31', 'faculty', 'PSYCH', 'anderson.faculty@plmar', '12345678', 'John Anderson.jpg'),
('AD-0008', 'Dan', 'Ariely', '1988-02-05', 'faculty', 'PSYCH', 'ariely.faculty@plmar', '12345678', 'Ariely2.jpg'),
('AD-0009', 'Elliot', 'Aronson', '1988-05-12', 'faculty', 'PSYCH', 'aronson.faculty@plmar', '12345678', 'qzamdu7ku5tmrmsfibq2.png'),
('AD-0010', 'Alan', 'Baddeley', '2021-07-06', 'faculty', 'PSYCH', 'baddeley.faculty@plmar', '12345678', 'unnamed.jpg'),
('AD-0011', 'James', 'Gosling', '1955-05-19', 'faculty', 'IT', 'gosling.faculty@plmar', '12345678', 'Oj2V9k6Y.jpg'),
('AD-0012', 'Rasmus', 'Lerdorf', '1968-11-22', 'faculty', 'IT', 'lerdorf.faculty@plmar', '12345678', 'Rasmus_Lerdorf_August_2014_(cropped).jfif'),
('AD-0013', 'Elon', 'Musk', '1971-06-28', 'faculty', 'IT', 'musk.faculty@plmar', '12345678', 'gettyimages-1229892983-square.jpg'),
('AD-0014', 'Mark', 'Zuckerberg', '1984-05-14', 'faculty', 'IT', 'zuckerberg.faculty@plmar', '12345678', 'GettyImages-945005812.jpg'),
('AD-0015', 'Gabe', 'Newell', '1962-11-03', 'faculty', 'IT', 'newell.faculty@plmar', '12345678', 'Gabe_Newell_in_the_Oval_Office.png'),
('AD-0016', 'Ellen', 'Degeneres', '1958-01-26', 'faculty', 'COMM', 'degeneres.faculty@plmar', '12345678', 'Ellen_DeGeneres.jpg'),
('AD-0017', 'Al', 'Roker', '2021-07-21', 'faculty', 'COMM', 'roker.faculty@plmar', '12345678', 'al-roker-suit-t.jpg'),
('AD-0018', 'Rachel', 'Velasquez', '1978-12-03', 'dean', 'EDUC', 'velasquez.dean@plmar', '12345678', '1517545830151.jfif'),
('AD-0019', 'Axel', 'Compton', '1988-02-05', 'faculty', 'EDUC', 'compton.faculty@plmar', '12345678', 'maxresdefault.jpg'),
('AD-0020', 'Gail', 'Bell', '1988-10-15', 'faculty', 'EDUC', 'bell.faculty@plmar', '12345678', '8496522-1x1-large.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admission_info`
--

CREATE TABLE `admission_info` (
  `AdmissionID` varchar(50) NOT NULL,
  `StudentID` varchar(50) NOT NULL,
  `Entry` varchar(20) NOT NULL,
  `PreferredCourse` varchar(100) NOT NULL,
  `ControlNo` int(7) NOT NULL,
  `EnrollStatus` varchar(20) NOT NULL DEFAULT 'none',
  `AdmissionStatus` varchar(20) NOT NULL DEFAULT 'on process',
  `SchoolYear` varchar(20) NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admission_info`
--

INSERT INTO `admission_info` (`AdmissionID`, `StudentID`, `Entry`, `PreferredCourse`, `ControlNo`, `EnrollStatus`, `AdmissionStatus`, `SchoolYear`, `CreatedAt`) VALUES
('AD-0000', 'ST-0000', '', '', 0, 'payment', 'approved', '', '2021-06-28 12:06:26'),
('AD-0001', 'ST-0001', 'old', 'BACHELOR IN ELEMENTARY EDUCATION', 5087146, 'finish', 'finish', '2021 - 2022', '2021-07-28 12:31:26'),
('AD-0002', 'ST-0002', 'old', 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 4729821, 'finish', 'finish', '2021 - 2022', '2021-07-30 15:29:29'),
('AD-0003', 'ST-0003', 'old', 'BACHELOR OF ARTS IN COMMUNICATION', 7189414, 'finish', 'finish', '2021 - 2022', '2021-07-30 15:44:14'),
('AD-0004', 'ST-0004', 'old', 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 5875521, 'finish', 'finish', '2021 - 2022', '2021-08-02 09:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `AnnounceID` int(11) NOT NULL,
  `AdminID` varchar(50) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Content` text NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `Type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`AnnounceID`, `AdminID`, `Title`, `Content`, `CreatedAt`, `Type`) VALUES
(14, 'AD-0001', 'Test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi malesuada cursus odio nec elementum. Morbi id risus purus. Maecenas tristique scelerisque consequat. Nunc quis odio tortor. Nam sem metus, tempus in quam nec, pretium cursus eros. Mauris ac porttitor neque, nec elementum tellus. Suspendisse potenti. Morbi sit amet arcu molestie, hendrerit lacus vitae, molestie enim. Nunc nec tellus eros. Nullam ut enim ac turpis sodales lobortis sed eget tortor. Quisque leo lorem, fermentum non velit vel, faucibus lobortis tellus. Mauris ut sollicitudin velit. Fusce urna tellus, vehicula sit amet urna in, eleifend fringilla massa. In maximus ornare orci, nec pellentesque neque dignissim nec.', '2021-07-11 21:56:49', 'school'),
(15, 'AD-0003', 'Test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt consequat nisl, in placerat risus gravida vitae. Nulla porta sed magna blandit cursus. Curabitur et gravida nunc, ac placerat lectus. Pellentesque sed risus efficitur, bibendum ipsum non, varius urna. Nam a justo mauris. Phasellus sed eros id enim vestibulum posuere. Nullam quis gravida magna.\n\nNullam feugiat eget urna at cursus. Phasellus eros nunc, convallis ac porta maximus, mattis a est. Nam lobortis justo sit amet ex pretium, in elementum purus blandit. Duis elementum augue nec lacus finibus imperdiet. Curabitur placerat sem in dignissim porta. Mauris semper accumsan mi id vestibulum. Cras viverra sapien a nunc sagittis dapibus. Aliquam mattis ut urna nec tincidunt. Ut non auctor dolor, ac sodales dui. Sed sagittis aliquet ultricies. Proin tincidunt pharetra porta. Donec vehicula ligula eu neque sollicitudin tempor. Vestibulum vel consectetur turpis. Phasellus sit amet nunc magna. Aenean cursus auctor cursus.', '2021-07-11 22:43:02', 'school'),
(17, 'AD-0002', 'Test Department of IT', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque facilisis erat sem, quis commodo tellus interdum sed. Nam id mi libero. Ut sed varius turpis. Nulla condimentum, enim ut elementum efficitur, lectus enim euismod urna, a lacinia erat est sit amet felis. Integer augue libero, lacinia non dolor at, ultrices suscipit nunc. Etiam pellentesque purus sit amet eleifend dictum. Aliquam sagittis, augue a gravida lobortis, ligula elit placerat lacus, vel condimentum lacus tortor a velit. Pellentesque a metus purus. Pellentesque sem magna, dignissim a metus eget, suscipit ultrices turpis. Aenean eleifend justo a justo accumsan, ut rhoncus odio condimentum. Aliquam sagittis, sem a consectetur feugiat, ex dolor facilisis velit, at lacinia purus purus sed ex. Quisque et sollicitudin ipsum, gravida accumsan sapien. Morbi in sodales metus. Nam mattis, est eget pulvinar consectetur, arcu tellus vulputate neque, nec vulputate mi risus non neque. Aliquam interdum vestibulum ultrices. Phasellus ut lorem finibus, imperdiet massa non, eleifend risus.', '2021-07-12 07:54:48', 'department'),
(18, 'AD-0013', 'Elon class announce', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque facilisis erat sem, quis commodo tellus interdum sed. Nam id mi libero. Ut sed varius turpis. Nulla condimentum, enim ut elementum efficitur, lectus enim euismod urna, a lacinia erat est sit amet felis. Integer augue libero, lacinia non dolor at, ultrices suscipit nunc. Etiam pellentesque purus sit amet eleifend dictum. Aliquam sagittis, augue a gravida lobortis, ligula elit placerat lacus, vel condimentum lacus tortor a velit. Pellentesque a metus purus. Pellentesque sem magna, dignissim a metus eget, suscipit ultrices turpis. Aenean eleifend justo a justo accumsan, ut rhoncus odio condimentum. Aliquam sagittis, sem a consectetur feugiat, ex dolor facilisis velit, at lacinia purus purus sed ex. Quisque et sollicitudin ipsum, gravida accumsan sapien. Morbi in sodales metus. Nam mattis, est eget pulvinar consectetur, arcu tellus vulputate neque, nec vulputate mi risus non neque. Aliquam interdum vestibulum ultrices. Phasellus ut lorem finibus, imperdiet massa non, eleifend risus.', '2021-07-12 08:06:33', 'class'),
(19, 'AD-0004', 'Test Freud', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque facilisis facilisis lacinia. Phasellus fermentum eros rutrum ex finibus, non interdum justo tempus. Nulla consectetur arcu non nibh lobortis ornare. Etiam maximus nisl quis blandit pharetra. Nullam sit amet tristique justo, sed rhoncus risus. Vivamus interdum fringilla eros nec egestas. Nulla luctus vel tellus vitae lobortis. Nam commodo, metus nec mollis maximus, purus ligula pulvinar felis, ac eleifend felis ante et ex. Mauris augue lectus, sodales eget feugiat a, finibus a est. Nam feugiat quam ac elementum sodales. Morbi luctus eu nisl non faucibus. Cras non ligula quam. Nulla pharetra, neque eu hendrerit tristique, turpis felis semper mi, quis luctus nisl dui vel diam. Etiam rhoncus, nisi in ullamcorper pulvinar, mauris erat fringilla nisl, nec faucibus felis libero eget urna.', '2021-07-12 12:31:35', 'department');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_due`
--

CREATE TABLE `assessment_due` (
  `AssessmentID` varchar(50) NOT NULL,
  `AcademicID` varchar(50) NOT NULL,
  `Assessment` varchar(50) NOT NULL,
  `TuitionFee` decimal(10,2) NOT NULL,
  `MiscFee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assessment_due`
--

INSERT INTO `assessment_due` (`AssessmentID`, `AcademicID`, `Assessment`, `TuitionFee`, `MiscFee`) VALUES
('AS-0000', 'ACD-0000', '', '0.00', '0.00'),
('AS-0001', 'ACD-0001', 'Midterm Assessment', '3320.00', '1766.00'),
('AS-0002', 'ACD-0001', 'Final Assessment', '3320.00', '1766.00'),
('AS-0003', 'ACD-0002', 'Midterm Assessment', '0.00', '0.00'),
('AS-0004', 'ACD-0002', 'Final Assessment', '0.00', '0.00'),
('AS-0005', 'ACD-0003', 'Midterm Assessment', '0.00', '0.00'),
('AS-0006', 'ACD-0003', 'Final Assessment', '0.00', '0.00'),
('AS-0007', 'ACD-0004', 'Midterm Assessment', '3680.00', '1766.00'),
('AS-0008', 'ACD-0004', 'Final Assessment', '3680.00', '1766.00');

-- --------------------------------------------------------

--
-- Table structure for table `class_miscellaneous`
--

CREATE TABLE `class_miscellaneous` (
  `CourseID` varchar(50) NOT NULL,
  `YearLevel` varchar(20) NOT NULL,
  `Semester` varchar(20) NOT NULL,
  `MiscID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_miscellaneous`
--

INSERT INTO `class_miscellaneous` (`CourseID`, `YearLevel`, `Semester`, `MiscID`) VALUES
('CO1-0009', '1st Year', '1st Semester', 'MISC-0001'),
('CO1-0009', '1st Year', '1st Semester', 'MISC-0002'),
('CO1-0009', '1st Year', '1st Semester', 'MISC-0003'),
('CO1-0009', '1st Year', '1st Semester', 'MISC-0004'),
('CO1-0009', '1st Year', '1st Semester', 'MISC-0005'),
('CO1-0009', '1st Year', '2nd Semester', 'MISC-0001'),
('CO1-0009', '1st Year', '2nd Semester', 'MISC-0002'),
('CO1-0009', '1st Year', '2nd Semester', 'MISC-0003'),
('CO1-0009', '1st Year', '2nd Semester', 'MISC-0004'),
('CO1-0009', '1st Year', '2nd Semester', 'MISC-0005'),
('CO1-0009', '2nd Year', '1st Semester', 'MISC-0001'),
('CO1-0009', '2nd Year', '1st Semester', 'MISC-0002'),
('CO1-0009', '2nd Year', '1st Semester', 'MISC-0003'),
('CO1-0009', '2nd Year', '1st Semester', 'MISC-0004'),
('CO1-0009', '2nd Year', '1st Semester', 'MISC-0005'),
('CO1-0009', '2nd Year', '2nd Semester', 'MISC-0001'),
('CO1-0009', '2nd Year', '2nd Semester', 'MISC-0002'),
('CO1-0009', '2nd Year', '2nd Semester', 'MISC-0003'),
('CO1-0009', '2nd Year', '2nd Semester', 'MISC-0004'),
('CO1-0009', '2nd Year', '2nd Semester', 'MISC-0005'),
('CO1-0009', '3rd Year', '1st Semester', 'MISC-0001'),
('CO1-0009', '3rd Year', '1st Semester', 'MISC-0002'),
('CO1-0009', '3rd Year', '1st Semester', 'MISC-0003'),
('CO1-0009', '3rd Year', '1st Semester', 'MISC-0004'),
('CO1-0009', '3rd Year', '1st Semester', 'MISC-0005'),
('CO1-0009', '3rd Year', '2nd Semester', 'MISC-0001'),
('CO1-0009', '3rd Year', '2nd Semester', 'MISC-0002'),
('CO1-0009', '3rd Year', '2nd Semester', 'MISC-0003'),
('CO1-0009', '3rd Year', '2nd Semester', 'MISC-0004'),
('CO1-0009', '3rd Year', '2nd Semester', 'MISC-0005'),
('CO1-0009', '4th Year', '1st Semester', 'MISC-0001'),
('CO1-0009', '4th Year', '1st Semester', 'MISC-0002'),
('CO1-0009', '4th Year', '1st Semester', 'MISC-0003'),
('CO1-0009', '4th Year', '1st Semester', 'MISC-0004'),
('CO1-0009', '4th Year', '1st Semester', 'MISC-0005'),
('CO1-0009', '4th Year', '2nd Semester', 'MISC-0001'),
('CO1-0009', '4th Year', '2nd Semester', 'MISC-0002'),
('CO1-0009', '4th Year', '2nd Semester', 'MISC-0003'),
('CO1-0009', '4th Year', '2nd Semester', 'MISC-0004'),
('CO1-0009', '4th Year', '2nd Semester', 'MISC-0005'),
('CO1-0013', '1st Year', '1st Semester', 'MISC-0001'),
('CO1-0013', '1st Year', '1st Semester', 'MISC-0002'),
('CO1-0013', '1st Year', '1st Semester', 'MISC-0003'),
('CO1-0013', '1st Year', '1st Semester', 'MISC-0004'),
('CO1-0013', '1st Year', '1st Semester', 'MISC-0005'),
('CO1-0013', '1st Year', '2nd Semester', 'MISC-0001'),
('CO1-0013', '1st Year', '2nd Semester', 'MISC-0002'),
('CO1-0013', '1st Year', '2nd Semester', 'MISC-0003'),
('CO1-0013', '1st Year', '2nd Semester', 'MISC-0004'),
('CO1-0013', '1st Year', '2nd Semester', 'MISC-0005'),
('CO1-0013', '2nd Year', '1st Semester', 'MISC-0001'),
('CO1-0013', '2nd Year', '1st Semester', 'MISC-0002'),
('CO1-0013', '2nd Year', '1st Semester', 'MISC-0003'),
('CO1-0013', '2nd Year', '1st Semester', 'MISC-0004'),
('CO1-0013', '2nd Year', '1st Semester', 'MISC-0005'),
('CO1-0013', '2nd Year', '2nd Semester', 'MISC-0001'),
('CO1-0013', '2nd Year', '2nd Semester', 'MISC-0002'),
('CO1-0013', '2nd Year', '2nd Semester', 'MISC-0003'),
('CO1-0013', '2nd Year', '2nd Semester', 'MISC-0004'),
('CO1-0013', '2nd Year', '2nd Semester', 'MISC-0005'),
('CO1-0013', '3rd Year', '1st Semester', 'MISC-0001'),
('CO1-0013', '3rd Year', '1st Semester', 'MISC-0002'),
('CO1-0013', '3rd Year', '1st Semester', 'MISC-0003'),
('CO1-0013', '3rd Year', '1st Semester', 'MISC-0004'),
('CO1-0013', '3rd Year', '1st Semester', 'MISC-0005'),
('CO1-0013', '3rd Year', '2nd Semester', 'MISC-0001'),
('CO1-0013', '3rd Year', '2nd Semester', 'MISC-0002'),
('CO1-0013', '3rd Year', '2nd Semester', 'MISC-0003'),
('CO1-0013', '3rd Year', '2nd Semester', 'MISC-0004'),
('CO1-0013', '3rd Year', '2nd Semester', 'MISC-0005'),
('CO1-0013', '4th Year', '1st Semester', 'MISC-0001'),
('CO1-0013', '4th Year', '1st Semester', 'MISC-0002'),
('CO1-0013', '4th Year', '1st Semester', 'MISC-0003'),
('CO1-0013', '4th Year', '1st Semester', 'MISC-0004'),
('CO1-0013', '4th Year', '1st Semester', 'MISC-0005'),
('CO1-0013', '4th Year', '2nd Semester', 'MISC-0001'),
('CO1-0013', '4th Year', '2nd Semester', 'MISC-0002'),
('CO1-0013', '4th Year', '2nd Semester', 'MISC-0003'),
('CO1-0013', '4th Year', '2nd Semester', 'MISC-0004'),
('CO1-0013', '4th Year', '2nd Semester', 'MISC-0005'),
('CO1-0012', '1st Year', '1st Semester', 'MISC-0001'),
('CO1-0012', '1st Year', '1st Semester', 'MISC-0002'),
('CO1-0012', '1st Year', '1st Semester', 'MISC-0003'),
('CO1-0012', '1st Year', '1st Semester', 'MISC-0004'),
('CO1-0012', '1st Year', '1st Semester', 'MISC-0005'),
('CO1-0012', '1st Year', '2nd Semester', 'MISC-0001'),
('CO1-0012', '1st Year', '2nd Semester', 'MISC-0002'),
('CO1-0012', '1st Year', '2nd Semester', 'MISC-0003'),
('CO1-0012', '1st Year', '2nd Semester', 'MISC-0004'),
('CO1-0012', '1st Year', '2nd Semester', 'MISC-0005'),
('CO1-0012', '2nd Year', '1st Semester', 'MISC-0001'),
('CO1-0012', '2nd Year', '1st Semester', 'MISC-0002'),
('CO1-0012', '2nd Year', '1st Semester', 'MISC-0003'),
('CO1-0012', '2nd Year', '1st Semester', 'MISC-0004'),
('CO1-0012', '2nd Year', '1st Semester', 'MISC-0005'),
('CO1-0012', '2nd Year', '2nd Semester', 'MISC-0001'),
('CO1-0012', '2nd Year', '2nd Semester', 'MISC-0002'),
('CO1-0012', '2nd Year', '2nd Semester', 'MISC-0003'),
('CO1-0012', '2nd Year', '2nd Semester', 'MISC-0004'),
('CO1-0012', '2nd Year', '2nd Semester', 'MISC-0005'),
('CO1-0012', '3rd Year', '1st Semester', 'MISC-0001'),
('CO1-0012', '3rd Year', '1st Semester', 'MISC-0002'),
('CO1-0012', '3rd Year', '1st Semester', 'MISC-0003'),
('CO1-0012', '3rd Year', '1st Semester', 'MISC-0004'),
('CO1-0012', '3rd Year', '1st Semester', 'MISC-0005'),
('CO1-0012', '3rd Year', '2nd Semester', 'MISC-0001'),
('CO1-0012', '3rd Year', '2nd Semester', 'MISC-0002'),
('CO1-0012', '3rd Year', '2nd Semester', 'MISC-0003'),
('CO1-0012', '3rd Year', '2nd Semester', 'MISC-0004'),
('CO1-0012', '3rd Year', '2nd Semester', 'MISC-0005'),
('CO1-0001', '1st Year', '1st Semester', 'MISC-0001'),
('CO1-0001', '1st Year', '1st Semester', 'MISC-0002'),
('CO1-0001', '1st Year', '1st Semester', 'MISC-0003'),
('CO1-0001', '1st Year', '1st Semester', 'MISC-0004'),
('CO1-0001', '1st Year', '1st Semester', 'MISC-0005'),
('CO1-0001', '1st Year', '2nd Semester', 'MISC-0001'),
('CO1-0001', '1st Year', '2nd Semester', 'MISC-0002'),
('CO1-0001', '1st Year', '2nd Semester', 'MISC-0003'),
('CO1-0001', '1st Year', '2nd Semester', 'MISC-0004'),
('CO1-0001', '1st Year', '2nd Semester', 'MISC-0005'),
('CO1-0001', '2nd Year', '1st Semester', 'MISC-0001'),
('CO1-0001', '2nd Year', '1st Semester', 'MISC-0002'),
('CO1-0001', '2nd Year', '1st Semester', 'MISC-0003'),
('CO1-0001', '2nd Year', '1st Semester', 'MISC-0004'),
('CO1-0001', '2nd Year', '1st Semester', 'MISC-0005'),
('CO1-0001', '2nd Year', '2nd Semester', 'MISC-0001'),
('CO1-0001', '2nd Year', '2nd Semester', 'MISC-0002'),
('CO1-0001', '2nd Year', '2nd Semester', 'MISC-0003'),
('CO1-0001', '2nd Year', '2nd Semester', 'MISC-0004'),
('CO1-0001', '2nd Year', '2nd Semester', 'MISC-0005'),
('CO1-0001', '3rd Year', '1st Semester', 'MISC-0001'),
('CO1-0001', '3rd Year', '1st Semester', 'MISC-0002'),
('CO1-0001', '3rd Year', '1st Semester', 'MISC-0003'),
('CO1-0001', '3rd Year', '1st Semester', 'MISC-0004'),
('CO1-0001', '3rd Year', '1st Semester', 'MISC-0005'),
('CO1-0001', '3rd Year', '2nd Semester', 'MISC-0001'),
('CO1-0001', '3rd Year', '2nd Semester', 'MISC-0002'),
('CO1-0001', '3rd Year', '2nd Semester', 'MISC-0003'),
('CO1-0001', '3rd Year', '2nd Semester', 'MISC-0004'),
('CO1-0001', '3rd Year', '2nd Semester', 'MISC-0005'),
('CO1-0001', '4th Year', '1st Semester', 'MISC-0001'),
('CO1-0001', '4th Year', '1st Semester', 'MISC-0002'),
('CO1-0001', '4th Year', '1st Semester', 'MISC-0003'),
('CO1-0001', '4th Year', '1st Semester', 'MISC-0004'),
('CO1-0001', '4th Year', '1st Semester', 'MISC-0005'),
('CO1-0001', '4th Year', '2nd Semester', 'MISC-0001'),
('CO1-0001', '4th Year', '2nd Semester', 'MISC-0002'),
('CO1-0001', '4th Year', '2nd Semester', 'MISC-0003'),
('CO1-0001', '4th Year', '2nd Semester', 'MISC-0004'),
('CO1-0001', '4th Year', '2nd Semester', 'MISC-0005');

-- --------------------------------------------------------

--
-- Table structure for table `contact_person`
--

CREATE TABLE `contact_person` (
  `StudentID` varchar(50) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `ContactNo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_person`
--

INSERT INTO `contact_person` (`StudentID`, `Firstname`, `Lastname`, `Email`, `ContactNo`) VALUES
('ST-0001', 'Laurel', 'Chang', '.consequat@ultricesposuerecubilia.ca', '9663942145'),
('ST-0002', 'Dennis', 'Goff', 'dolor@velitdui.ca', '9646226656'),
('ST-0003', 'Octavius', 'Santana', '@euarcuMorbi.org', '9192538113'),
('ST-0004', 'Yuli', 'Jackson', 'ante@ultricies.co', '9544837147');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `CourseID` varchar(50) NOT NULL,
  `Course` varchar(100) NOT NULL,
  `Duration` varchar(50) NOT NULL,
  `Admission` varchar(100) NOT NULL,
  `TuitionFee` varchar(100) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Abbreviation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseID`, `Course`, `Duration`, `Admission`, `TuitionFee`, `Department`, `Abbreviation`) VALUES
('CO1-0001', 'BACHELOR IN ELEMENTARY EDUCATION', '4 Years', 'Freshmen | Transferees', '4,000 - 8,000 per semester', 'EDUC', 'BEED'),
('CO1-0002', 'BACHELOR IN SECONDARY EDUCATION', '4 Years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'EDUC', 'BSED'),
('CO1-0003', 'BACHELOR IN PHYSICAL EDUCATION', '4 Years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'EDUC', 'BP ED'),
('CO1-0004', 'BACHELOR OF SCIENCE IN ACCOUNTANCY', '5 Years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'ACC', 'BS/ACC'),
('CO1-0005', 'BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION', '4 years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'ACC', 'BSBA'),
('CO1-0006', 'BACHELOR OF SCIENCE IN CRIMINOLOGY', '4 years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'CRIM', 'BSCRIM'),
('CO1-0007', 'BACHELOR OF SCIENCE IN ENTREPRENEUR', '4 years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'ACC', 'BS-ENTREP'),
('CO1-0008', 'BACHELOR OF SCIENCE IN HOSPITALITY MANAGEMENT', '4 years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'HM', 'BSHM'),
('CO1-0009', 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', '4 years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'IT', 'BSIT'),
('CO1-0010', 'BACHELOR OF SCIENCE IN NURSING', '4 years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'NURSE', 'BSN'),
('CO1-0011', 'BACHELOR OF SCIENCE IN TOURISM MANAGEMENT', '4 years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'HM', 'BSTM'),
('CO1-0012', 'BACHELOR OF ARTS IN COMMUNICATION', '4 years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'COMM', 'BA Comm'),
('CO1-0013', 'BACHELOR OF ARTS IN PSYCHOLOGY, Minor in Social Work', '4 years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'PSYCH', 'BA Psych'),
('CO1-0014', 'BACHELOR OF ARTS IN PUBLIC ADMINISTRATION', '4 years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'COMM', 'BPA'),
('CO1-0015', 'BACHELOR OF SCIENCE IN HOTEL AND RESTAURANT MANAGEMENT', '4 years', 'Freshmen | Transferees', '4,000-8,000 per semester', 'HM', 'BSHRM'),
('CO1-0016', 'BACHELOR OF SCIENCE IN PSYCHOLOGY', '4 years', 'Freshmen | Transferees', '4,000 - 8,000 per semester', 'PSYCH', 'BS Psych'),
('CO2-0001', 'Master of Arts in Education major in Educational Management (MAEd)', '', '', '', 'EDUC', 'MAED'),
('CO2-0002', 'Master in Business Administration (MBA)', '', '', '', 'ACC', 'MBA'),
('CO2-0003', 'Master in Public Administration (MPA)', '', '', '', 'COMM', 'MPA'),
('CO2-0004', 'Master of Arts in Filipinology (MAFil)', '', '', '', 'COMM', 'MAFil'),
('CO2-0005', 'Doctor of Philosophy in Business Management (PhDBM)', '', '', '', 'ACC', 'PhDBM'),
('CO2-0006', 'Doctor of Philosophy in Public Administration (PhDPA)', '', '', '', 'COMM', 'PhDPA'),
('CO2-0007', 'Doctor of Philosophy in Education major in Educational Leadership and Management (PhDELM)', '', '', '', 'EDUC', 'PhDELM'),
('CO3-0001', 'Science Technology Engineering Mathematics(STEM)', '2 Years', '', '', 'SHS', 'STEM'),
('CO3-0002', 'Accountancy, Business and Management(ABM)', '2 Years', '', '', 'SHS', 'ABM'),
('CO3-0003', 'Humanities and Social Sciences (HUMSS)', '2 Years', '', '', 'SHS', 'HUMSS');

-- --------------------------------------------------------

--
-- Table structure for table `downpayment`
--

CREATE TABLE `downpayment` (
  `AcademicID` varchar(50) NOT NULL,
  `AmountPaid` decimal(10,2) NOT NULL,
  `PaymentMode` varchar(50) NOT NULL,
  `DatePaid` date NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `downpayment`
--

INSERT INTO `downpayment` (`AcademicID`, `AmountPaid`, `PaymentMode`, `DatePaid`, `CreatedAt`) VALUES
('ACD-0001', '2543.00', 'Installment', '0000-00-00', '2021-07-28 12:41:10'),
('ACD-0002', '300.00', 'Full Payment', '0000-00-00', '2021-07-30 15:32:09'),
('ACD-0003', '2223.00', 'Full Payment', '0000-00-00', '2021-07-30 15:46:09'),
('ACD-0004', '2723.00', 'Installment', '0000-00-00', '2021-08-02 12:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `downpayment_approval`
--

CREATE TABLE `downpayment_approval` (
  `ApprovalID` varchar(50) NOT NULL,
  `AcademicID` varchar(50) NOT NULL,
  `PaymentMode` varchar(50) NOT NULL,
  `Bank` varchar(50) NOT NULL,
  `File` text NOT NULL,
  `Filename` text NOT NULL,
  `Status` varchar(50) NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `downpayment_approval`
--

INSERT INTO `downpayment_approval` (`ApprovalID`, `AcademicID`, `PaymentMode`, `Bank`, `File`, `Filename`, `Status`, `CreatedAt`) VALUES
('DP-0000', 'ACD-0000', '', '', '', '', '', '2021-07-05 22:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_control`
--

CREATE TABLE `enrollment_control` (
  `Control` varchar(50) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollment_control`
--

INSERT INTO `enrollment_control` (`Control`, `Status`) VALUES
('enrollment-school-year', '2021 - 2022'),
('enrollment-semester', '1st Semester'),
('enrollment-status', 'Open'),
('subject-encode', 'Close');

-- --------------------------------------------------------

--
-- Table structure for table `grades_encode_sched`
--

CREATE TABLE `grades_encode_sched` (
  `ScheduleID` int(11) NOT NULL,
  `StartingDateTime` varchar(50) NOT NULL,
  `EndingDateTime` varchar(50) NOT NULL,
  `SchoolYear` varchar(20) NOT NULL,
  `Semester` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades_encode_sched`
--

INSERT INTO `grades_encode_sched` (`ScheduleID`, `StartingDateTime`, `EndingDateTime`, `SchoolYear`, `Semester`) VALUES
(1, '2021-07-16 11:55:00am', '2021-07-16 03:00:00pm', '2020 - 2021', '1st Semester'),
(2, '2021-07-19 06:10:00am', '2021-07-20 06:10:00am', '2020 - 2021', '1st Semester'),
(3, '2021-07-20 12:04:00pm', '2021-07-21 12:04:00pm', '2020 - 2021', '1st Semester'),
(4, '2021-08-02 11:49:00am', '2021-08-02 12:49:00pm', '2021 - 2022', '1st Semester');

-- --------------------------------------------------------

--
-- Table structure for table `grade_dictionary`
--

CREATE TABLE `grade_dictionary` (
  `Grade` varchar(20) NOT NULL,
  `Remarks` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grade_dictionary`
--

INSERT INTO `grade_dictionary` (`Grade`, `Remarks`) VALUES
('1.00', 'Passed'),
('1.25', 'Passed'),
('1.50', 'Passed'),
('1.75', 'Passed'),
('2.00', 'Passed'),
('2.25', 'Passed'),
('2.50', 'Passed'),
('2.75', 'Passed'),
('3.00', 'Passed'),
('4.00', 'Incomplete'),
('5.00', 'Failed'),
('no grades', 'no grades');

-- --------------------------------------------------------

--
-- Table structure for table `miscellaneous`
--

CREATE TABLE `miscellaneous` (
  `MiscID` varchar(50) NOT NULL,
  `Miscellaneous` varchar(100) NOT NULL,
  `Fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `miscellaneous`
--

INSERT INTO `miscellaneous` (`MiscID`, `Miscellaneous`, `Fee`) VALUES
('MISC-0001', 'Developmental Fee', '850.00'),
('MISC-0002', 'Medical & Dental', '630.00'),
('MISC-0003', 'Guidance & Counsel', '690.00'),
('MISC-0004', 'Student Council', '245.00'),
('MISC-0005', 'Library Fund', '2000.00');

-- --------------------------------------------------------

--
-- Table structure for table `old_student_enrollment`
--

CREATE TABLE `old_student_enrollment` (
  `EncodeID` varchar(50) NOT NULL,
  `StudentID` varchar(50) NOT NULL,
  `EnrollmentStatus` varchar(50) NOT NULL,
  `SchoolYear` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `old_student_enrollment`
--

INSERT INTO `old_student_enrollment` (`EncodeID`, `StudentID`, `EnrollmentStatus`, `SchoolYear`) VALUES
('EN-0000', 'ST-0000', '', ''),
('EN-0001', 'ST-0002', 'finish', '2020 - 2021'),
('EN-0002', 'ST-0001', 'finish', '2020 - 2021');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentID` varchar(50) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Middlename` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Gender` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `ContactNo` varchar(10) NOT NULL,
  `Birthdate` date NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentID`, `Firstname`, `Middlename`, `Lastname`, `Gender`, `Email`, `ContactNo`, `Birthdate`, `Image`) VALUES
('ST-0000', '', '', '', '', '', '0', '0000-00-00', ''),
('ST-0001', 'Giselle', 'Price', 'Raymond', 'Female', 'id@massaSuspendisseeleifend.com', '9314530992', '2001-06-03', '6100dd9e7ca72-MV5BMWVlM2I5NmItNGMxNy00YmIyLTg1MmUtYmU4MzUzMTA3MmI0XkEyXkFqcGdeQXVyMTI0MzEwMDc2._V1_UY1200_CR265,0,630,1200_AL_.jpg'),
('ST-0002', 'Tobias', 'Small', 'Brooks', 'Male', 'libero@necante.net', '9370329758', '2001-01-28', '6103aa59b5475-TobyBrooks.jfif'),
('ST-0003', 'Neville', 'Bowman', 'Meyer', 'Male', 'fringilla@libero.ca', '9908522340', '2002-02-04', '6103adce35247-5d94ea2354248.image.jpg'),
('ST-0004', 'Zenia', 'Meadows', 'Mendez', 'Female', 'cubilia@ultricesiaculisodio', '9211596470', '2005-11-27', '6107453e88f39-image-asset.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `student_academic_info`
--

CREATE TABLE `student_academic_info` (
  `AcademicID` varchar(50) NOT NULL,
  `StudentID` varchar(50) NOT NULL,
  `CourseID` varchar(50) NOT NULL,
  `YearLevel` varchar(20) NOT NULL,
  `Semester` varchar(20) NOT NULL,
  `SchoolYear` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_academic_info`
--

INSERT INTO `student_academic_info` (`AcademicID`, `StudentID`, `CourseID`, `YearLevel`, `Semester`, `SchoolYear`) VALUES
('ACD-0000', 'ST-0000', 'CO1-0009', 'n/a', 'n/a', 'n/a'),
('ACD-0001', 'ST-0001', 'CO1-0001', '1st Year', '1st Semester', '2021 - 2022'),
('ACD-0002', 'ST-0002', 'CO1-0009', '1st Year', '1st Semester', '2021 - 2022'),
('ACD-0003', 'ST-0003', 'CO1-0012', '1st Year', '1st Semester', '2021 - 2022'),
('ACD-0004', 'ST-0004', 'CO1-0009', '1st Year', '1st Semester', '2021 - 2022');

-- --------------------------------------------------------

--
-- Table structure for table `student_account`
--

CREATE TABLE `student_account` (
  `StudentID` varchar(50) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_account`
--

INSERT INTO `student_account` (`StudentID`, `Username`, `Password`) VALUES
('ST-0001', 'raymond.stud@plmar', '12345678'),
('ST-0002', 'brooks.stud@plmar', '12345678'),
('ST-0003', 'meyer.stud@plmar', '12345678'),
('ST-0004', 'mendez.stud@plmar', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `student_class`
--

CREATE TABLE `student_class` (
  `ClassID` varchar(50) NOT NULL,
  `StudentID` varchar(50) NOT NULL,
  `SubjectID` varchar(50) NOT NULL,
  `Day` varchar(50) NOT NULL,
  `Time` varchar(50) NOT NULL,
  `Section` varchar(50) NOT NULL,
  `AdminID` varchar(50) DEFAULT NULL,
  `SchoolYear` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_class`
--

INSERT INTO `student_class` (`ClassID`, `StudentID`, `SubjectID`, `Day`, `Time`, `Section`, `AdminID`, `SchoolYear`) VALUES
('CID-0000', 'ST-0000', 'SUB-0001', '', '', '', NULL, ''),
('CID-0001', 'ST-0001', 'SUB-0146', 'TUE', 'AM 10:30 - 1:30', 'Section 1', NULL, '2021 - 2022'),
('CID-0002', 'ST-0001', 'SUB-0147', 'THU', 'PM 5:30 - 8:30', 'Section 1', NULL, '2021 - 2022'),
('CID-0003', 'ST-0001', 'SUB-0148', 'SAT', 'PM 2:00 - 5:00', 'Section 1', NULL, '2021 - 2022'),
('CID-0004', 'ST-0001', 'SUB-0149', 'SAT', 'AM 7:30 - 10:30', 'Section 1', NULL, '2021 - 2022'),
('CID-0005', 'ST-0001', 'SUB-0150', 'WED', 'PM 2:00 - 5:00', 'Section 1', NULL, '2021 - 2022'),
('CID-0006', 'ST-0001', 'SUB-0151', 'SUN', 'PM 5:00 - 8:00', 'Section 1', NULL, '2021 - 2022'),
('CID-0007', 'ST-0001', 'SUB-0152', 'TUE', 'PM 5:00 - 8:00', 'Section 1', NULL, '2021 - 2022'),
('CID-0008', 'ST-0001', 'SUB-0153', 'FRI', 'PM 2:00 - 4:00', 'Section 1', NULL, '2021 - 2022'),
('CID-0009', 'ST-0002', 'SUB-0001', 'MON', 'AM 7:30 - 10:30', 'Section 1', 'AD-0006', '2021 - 2022'),
('CID-0010', 'ST-0002', 'SUB-0002', 'THU', 'PM 5:00 - 8:00', 'Section 1', 'AD-0006', '2021 - 2022'),
('CID-0011', 'ST-0002', 'SUB-0003', 'FRI', 'PM 2:00 - 5:00', 'Section 1', 'AD-0006', '2021 - 2022'),
('CID-0012', 'ST-0002', 'SUB-0004', 'WED', 'PM 5:00 - 8:00', 'Section 1', 'AD-0008', '2021 - 2022'),
('CID-0013', 'ST-0002', 'SUB-0005', 'TUE', 'PM 5:00 - 8:00', 'Section 1', 'AD-0011', '2021 - 2022'),
('CID-0014', 'ST-0002', 'SUB-0006', 'SAT', 'PM 5:30 - 8:30', 'Section 1', 'AD-0011', '2021 - 2022'),
('CID-0015', 'ST-0002', 'SUB-0007', 'SUN', 'PM 5:00 - 8:00', 'Section 1', 'AD-0011', '2021 - 2022'),
('CID-0016', 'ST-0002', 'SUB-0008', 'THU', 'PM 5:30 - 8:30', 'Section 1', 'AD-0008', '2021 - 2022'),
('CID-0017', 'ST-0002', 'SUB-0009', 'TUE', 'AM 10:00 - 12:00', 'Section 1', 'AD-0008', '2021 - 2022'),
('CID-0018', 'ST-0003', 'SUB-0099', 'TUE', 'AM 7:30 - 10:30', 'Section 1', NULL, '2021 - 2022'),
('CID-0019', 'ST-0003', 'SUB-0100', 'WED', 'AM 10:30 - 1:30', 'Section 1', NULL, '2021 - 2022'),
('CID-0020', 'ST-0003', 'SUB-0101', 'THU', 'PM 5:00 - 8:00', 'Section 1', NULL, '2021 - 2022'),
('CID-0021', 'ST-0003', 'SUB-0102', 'THU', 'PM 5:00 - 8:00', 'Section 1', NULL, '2021 - 2022'),
('CID-0022', 'ST-0003', 'SUB-0103', 'WED', 'PM 2:00 - 5:00', 'Section 1', NULL, '2021 - 2022'),
('CID-0023', 'ST-0003', 'SUB-0104', 'SUN', 'PM 2:00 - 4:00', 'Section 1', NULL, '2021 - 2022'),
('CID-0024', 'ST-0003', 'SUB-0105', 'TUE', 'AM 10:30 - 1:30', 'Section 1', NULL, '2021 - 2022'),
('CID-0025', 'ST-0004', 'SUB-0001', 'MON', 'AM 7:30 - 10:30', 'Section 1', 'AD-0006', '2021 - 2022'),
('CID-0026', 'ST-0004', 'SUB-0002', 'THU', 'PM 5:00 - 8:00', 'Section 1', 'AD-0006', '2021 - 2022'),
('CID-0027', 'ST-0004', 'SUB-0003', 'FRI', 'PM 2:00 - 5:00', 'Section 1', 'AD-0006', '2021 - 2022'),
('CID-0028', 'ST-0004', 'SUB-0004', 'WED', 'PM 5:00 - 8:00', 'Section 1', 'AD-0008', '2021 - 2022'),
('CID-0029', 'ST-0004', 'SUB-0005', 'TUE', 'PM 5:00 - 8:00', 'Section 1', 'AD-0011', '2021 - 2022'),
('CID-0030', 'ST-0004', 'SUB-0006', 'SAT', 'PM 5:30 - 8:30', 'Section 1', 'AD-0011', '2021 - 2022'),
('CID-0031', 'ST-0004', 'SUB-0007', 'SUN', 'PM 5:00 - 8:00', 'Section 1', 'AD-0011', '2021 - 2022'),
('CID-0032', 'ST-0004', 'SUB-0008', 'THU', 'PM 5:30 - 8:30', 'Section 1', 'AD-0008', '2021 - 2022'),
('CID-0033', 'ST-0004', 'SUB-0009', 'TUE', 'AM 10:00 - 12:00', 'Section 1', 'AD-0008', '2021 - 2022');

-- --------------------------------------------------------

--
-- Table structure for table `student_files`
--

CREATE TABLE `student_files` (
  `FileID` varchar(50) NOT NULL,
  `AdmissionID` varchar(50) NOT NULL,
  `Filename` text NOT NULL,
  `File` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_files`
--

INSERT INTO `student_files` (`FileID`, `AdmissionID`, `Filename`, `File`) VALUES
('FI-0000', 'AD-0000', '', ''),
('FI-0001', 'AD-0001', 'F138.jfif', '6100dd9ee4680-F138.jfif'),
('FI-0002', 'AD-0001', 'GoodMoral.jfif', '6100dd9ef1c2b-GoodMoral.jfif'),
('FI-0003', 'AD-0001', 'meralco.jpg', '6100dd9f17d2c-meralco.jpg'),
('FI-0004', 'AD-0001', 'AdmissionEssay.pdf', '6100dd9f203c4-AdmissionEssay.pdf'),
('FI-0005', 'AD-0002', 'F138.jfif', '6103aa5a03925-F138.jfif'),
('FI-0006', 'AD-0002', 'GoodMoral.jfif', '6103aa5a14eb8-GoodMoral.jfif'),
('FI-0007', 'AD-0002', 'meralco.jpg', '6103aa5a20c73-meralco.jpg'),
('FI-0008', 'AD-0002', 'AdmissionEssay.pdf', '6103aa5a3eb2b-AdmissionEssay.pdf'),
('FI-0009', 'AD-0003', 'F138.jfif', '6103adcea0445-F138.jfif'),
('FI-0010', 'AD-0003', 'GoodMoral.jfif', '6103adceab92c-GoodMoral.jfif'),
('FI-0011', 'AD-0003', 'meralco.jpg', '6103adcec057e-meralco.jpg'),
('FI-0012', 'AD-0003', 'AdmissionEssay.pdf', '6103adcecd9e4-AdmissionEssay.pdf'),
('FI-0013', 'AD-0004', 'F138.jfif', '6107453eed728-F138.jfif'),
('FI-0014', 'AD-0004', 'GoodMoral.jfif', '6107453f15761-GoodMoral.jfif'),
('FI-0015', 'AD-0004', 'meralco.jpg', '6107453f1d057-meralco.jpg'),
('FI-0016', 'AD-0004', 'AdmissionEssay.pdf', '6107453f2cec2-AdmissionEssay.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `student_grades`
--

CREATE TABLE `student_grades` (
  `GradeID` varchar(50) NOT NULL,
  `StudentID` varchar(50) NOT NULL,
  `SubjectCode` varchar(50) NOT NULL,
  `Grade` varchar(50) NOT NULL,
  `SchoolYear` varchar(20) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_grades`
--

INSERT INTO `student_grades` (`GradeID`, `StudentID`, `SubjectCode`, `Grade`, `SchoolYear`, `Status`) VALUES
('G-0000', 'ST-0000', 'GED111', 'no grades', '2020 - 2021', '');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SubjectCode` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Units` decimal(10,2) NOT NULL,
  `SubjectFee` decimal(10,2) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SubjectCode`, `Description`, `Units`, `SubjectFee`, `Type`, `Department`) VALUES
('Com101', 'Intro to Communication Media', '3.00', '1200.00', 'major', 'COMM'),
('Com112', 'Communication Theory', '3.00', '2000.00', 'major', 'COMM'),
('Com115', 'Broadcasting Principles & Practices', '3.00', '1200.00', 'major', 'COMM'),
('Com118', 'Intro to Theater Arts', '3.00', '2000.00', 'major', 'COMM'),
('Com123', 'Peace and Communication', '3.00', '2000.00', 'major', 'COMM'),
('Com127', 'Risk, Disaster, and Humanitarian Communication', '3.00', '1400.00', 'major', 'COMM'),
('Com130', 'Journalism Principles & Practices', '3.00', '1500.00', 'major', 'COMM'),
('Com134', 'Development Communication', '3.00', '2000.00', 'major', 'COMM'),
('Com137', 'Public Information Principles and Practices', '3.00', '1130.00', 'major', 'COMM'),
('Com140', 'Multimedia Storytelling', '3.00', '1240.00', 'major', 'COMM'),
('Com145', 'Integrated Marketing Communication', '3.00', '1800.00', 'major', 'COMM'),
('Com148', 'Communication in the ASEAN Setting', '3.00', '1900.00', 'major', 'COMM'),
('Com151', 'Communication, Culture and Society', '3.00', '1290.00', 'major', 'COMM'),
('Com156', 'Knowledge Management', '3.00', '1760.00', 'major', 'COMM'),
('Com159', 'Perfomrance Media', '3.00', '1200.00', 'major', 'COMM'),
('Com162', 'Social Media and Mobile Technology for Communication Campaigns', '3.00', '2600.00', 'major', 'COMM'),
('Com167', 'Behavioral and Scial Change Communication', '3.00', '2700.00', 'major', 'COMM'),
('Com170', 'Communication Planning', '3.00', '1000.00', 'major', 'COMM'),
('Com173', 'Comm, Media Laws and Ethics', '3.00', '1200.00', 'major', 'COMM'),
('Com178', 'Intro to Film', '3.00', '2300.00', 'major', 'COMM'),
('Com181', 'Communication Management', '3.00', '1250.00', 'major', 'COMM'),
('Com184', 'Organizational Culture and Communication', '3.00', '1270.00', 'major', 'COMM'),
('EDE101', 'Elective 1', '3.00', '1000.00', 'major', 'EDUC'),
('EDE102', 'Elective 2', '3.00', '1000.00', 'major', 'EDUC'),
('EDU101', 'The Child and Adolescent Learners and Learning Princilples', '3.00', '1300.00', 'major', 'EDUC'),
('EDU102', 'The Teacher and the Community, School Culture and Organizational Leadership', '3.00', '1500.00', 'major', 'EDUC'),
('EDU103', 'The Teaching Profession', '3.00', '1530.00', 'major', 'EDUC'),
('EDU104', 'Foundation of Special and Inclusive', '3.00', '1200.00', 'major', 'EDUC'),
('EDU105', 'Facilitating Learner-Centered Teaching', '3.00', '1200.00', 'major', 'EDUC'),
('EDU106', 'Assessment in Learning 1', '3.00', '1200.00', 'major', 'EDUC'),
('EDU107', 'Assessment in Learning 2', '3.00', '1000.00', 'major', 'EDUC'),
('EDU108', 'Technology for Teaching and Learning', '3.00', '1200.00', 'major', 'EDUC'),
('EDU109', 'The Teacher and the School Curriculum', '3.00', '1900.00', 'major', 'EDUC'),
('EDU110', 'Building and Enhancing New Literacies Across the Curriculum', '3.00', '1800.00', 'major', 'EDUC'),
('EDU111', 'Field Study 1', '3.00', '1700.00', 'major', 'EDUC'),
('EDU112', 'Field Study 2', '3.00', '1000.00', 'major', 'EDUC'),
('EDU113', 'Teaching Internship', '5.00', '4000.00', 'major', 'EDUC'),
('FIL153', 'Teorya at Praktika ng Pagsasalin', '3.00', '1100.00', 'major', 'EDUC'),
('GED111', 'Understanding the Self', '3.00', '1000.00', 'minor', 'PSYCH'),
('GED121', 'Readings in Phi. History', '3.00', '1000.00', 'minor', 'PSYCH'),
('GED131', 'Contemporary World', '3.00', '1000.00', 'minor', 'PSYCH'),
('GED141', 'Mathematics in Modern World', '3.00', '1000.00', 'minor', 'PSYCH'),
('GED151', 'Purposive Communication', '3.00', '1000.00', 'minor', 'PSYCH'),
('GED152', 'Kontekswalisasyon ng Wikang Filipino', '3.00', '1000.00', 'minor', 'PSYCH'),
('GED153', 'Teorya at Praktika ng Pagsasalin', '3.00', '1000.00', 'minor', 'PSYCH'),
('GED161', 'Art Appreciation', '3.00', '1000.00', 'minor', 'PSYCH'),
('GED171', 'Sceince, Technology and Society', '3.00', '800.00', 'minor', 'PSYCH'),
('GED172', 'People and Earth\'s Ecosystem', '3.00', '1000.00', 'minor', 'PSYCH'),
('GED181', 'Ethics', '3.00', '1000.00', 'minor', 'PSYCH'),
('GED182', 'Gender and Society', '3.00', '1000.00', 'minor', 'PSYCH'),
('GED183', 'Great Books', '3.00', '800.00', 'minor', 'PSYCH'),
('GED191', 'Philippine Government and Constitution', '3.00', '900.00', 'minor', 'PSYCH'),
('GED192', 'Rizal', '3.00', '1230.00', 'major', 'IT'),
('IT101', 'Information Technology Fundamentals', '3.00', '1300.00', 'major', 'IT'),
('IT102', 'Intermediate Computer Programming', '3.00', '1200.00', 'major', 'IT'),
('IT103', 'Discrete Mathematics', '3.00', '1200.00', 'major', 'IT'),
('IT104', 'Object-Oriented Programming', '3.00', '1000.00', 'major', 'IT'),
('IT105', 'Data Structure and Algorithms', '3.00', '1200.00', 'major', 'IT'),
('IT106', 'Introduction to Human-Computer Interaction', '3.00', '1200.00', 'major', 'IT'),
('IT201', 'Fundamentals of Database System', '3.00', '1200.00', 'major', 'IT'),
('IT202', 'Social and Professional Issues in IT', '3.00', '1300.00', 'major', 'IT'),
('IT203', 'Fundamentals of Information Management', '3.00', '1200.00', 'major', 'IT'),
('IT204', 'Introduction to Network Technologies and Processes', '3.00', '1200.00', 'major', 'IT'),
('IT205', 'Quantitative Methods', '3.00', '1200.00', 'major', 'IT'),
('IT206', 'Fundamentals of System Integration and Architecture', '3.00', '1200.00', 'major', 'IT'),
('IT301', 'Intermediate Network Technologies and Processes', '3.00', '1200.00', 'major', 'IT'),
('IT302', 'Integrative Programming Techonologies', '3.00', '1200.00', 'major', 'IT'),
('IT303', 'Information Assurance and Security', '3.00', '1300.00', 'major', 'IT'),
('IT304', 'Application Development and Emerging Technologies', '3.00', '2000.00', 'major', 'IT'),
('IT401', 'Information Assurance and Security 2', '3.00', '1000.00', 'major', 'IT'),
('IT402', 'System Administration and Maintenance', '3.00', '1200.00', 'major', 'IT'),
('IT403', 'Capstone Project 1', '3.00', '1300.00', 'major', 'IT'),
('IT404', 'Capstone 2', '3.00', '2000.00', 'major', 'IT'),
('ITC101', 'Business Intelligence for IT', '3.00', '1200.00', 'major', 'IT'),
('ITC201', 'Intermediate Web Systems Technologies', '3.00', '1200.00', 'major', 'IT'),
('ITC301', 'Internet of Things', '3.00', '1200.00', 'major', 'IT'),
('ITC302', 'Cloud Computing', '3.00', '1230.00', 'major', 'IT'),
('ITC303', 'Event Driven Programming', '3.00', '1400.00', 'major', 'IT'),
('ITC401', 'Seminars in Current IT Trend', '3.00', '1500.00', 'major', 'IT'),
('ITE201', 'Multimedia Technology', '3.00', '1200.00', 'major', 'IT'),
('ITE202', 'Platform Technologies', '3.00', '1220.00', 'major', 'IT'),
('ITE301', 'System Integration and Architecture 2', '3.00', '1200.00', 'major', 'IT'),
('ITE302', 'Human Computer Interaction 2', '3.00', '1200.00', 'major', 'IT'),
('NSTP1', 'National Service Training Program 1', '3.00', '1000.00', 'minor', 'PSYCH'),
('NSTP2', 'National Service Training Program 2', '3.00', '1000.00', 'minor', 'PSYCH'),
('OJT', 'Internship/On the job training(600hrs)', '9.00', '3000.00', 'major', 'IT'),
('OJT101', 'On the Job Training(300hrs)', '3.00', '3200.00', 'major', 'COMM'),
('PED101', 'Physical Education 1', '2.00', '700.00', 'minor', 'PSYCH'),
('PED102', 'Physical Education 2', '2.00', '1000.00', 'minor', 'PSYCH'),
('PED103', 'Physical Education 3', '2.00', '900.00', 'minor', 'PSYCH'),
('PED104', 'Physical Education 4', '2.00', '900.00', 'minor', 'PSYCH'),
('PSY101', 'Introduction to Psychology', '3.00', '1200.00', 'major', 'PSYCH'),
('PSY102', 'Psychological Statistics', '5.00', '2000.00', 'major', 'PSYCH'),
('PSY103', 'Experimental Psychology', '5.00', '2000.00', 'major', 'PSYCH'),
('PSY104', 'Theories of Personality', '3.00', '1200.00', 'major', 'PSYCH'),
('PSY105', 'Biological Psychology', '3.00', '1200.00', 'major', 'PSYCH'),
('PSY106', 'Developmental Psychology', '3.00', '1200.00', 'major', 'PSYCH'),
('PSY107', 'Field Methods', '5.00', '2500.00', 'major', 'PSYCH'),
('PSY108', 'Social Psychology with Group Dynamics', '3.00', '1200.00', 'major', 'PSYCH'),
('PSY109', 'Cognitive Psychology', '3.00', '1000.00', 'major', 'PSYCH'),
('PSY110', 'Psychological Assessment', '5.00', '2500.00', 'major', 'PSYCH'),
('PSY111', 'Abnormal Psychology', '3.00', '1200.00', 'major', 'PSYCH'),
('PSY112', 'Culture and Psychology/Sikolohiyang Philipno/Filipino Psychology', '3.00', '1000.00', 'major', 'PSYCH'),
('PSY113', 'Industrial/Organization Psychology', '3.00', '1200.00', 'major', 'PSYCH'),
('PSY114', 'Introduction to Counseling', '3.00', '1000.00', 'major', 'PSYCH'),
('PSY115', 'Research in Psychology 1', '3.00', '1100.00', 'major', 'PSYCH'),
('PSY116', 'Research in Psychology 2', '3.00', '1200.00', 'minor', 'PSYCH'),
('PSY117', 'Educational Psychology', '3.00', '1300.00', 'minor', 'PSYCH'),
('PSY118', 'Current Issues', '3.00', '1200.00', 'major', 'PSYCH'),
('PSY119', 'Practicum in Psychology', '3.00', '3000.00', 'major', 'PSYCH'),
('Res100', 'Communication Research', '3.00', '2000.00', 'major', 'COMM'),
('Res101', 'Thesis 1 (Proposal Defense)', '3.00', '1800.00', 'major', 'COMM'),
('Res102', 'Thesis 2 (Final Defense)', '3.00', '2500.00', 'major', 'COMM'),
('SPED101', 'Fundamentals of SPED', '3.00', '1250.00', 'major', 'EDUC'),
('SPED102', 'Psychology of Children with Special Needs', '3.00', '1000.00', 'major', 'EDUC'),
('SPED103', 'Observational Child Study', '3.00', '1200.00', 'major', 'EDUC'),
('SPED104', 'Assessment of Children with Special Needs', '3.00', '800.00', 'major', 'EDUC'),
('SPED105', 'Curriculum for SPED', '3.00', '1200.00', 'major', 'EDUC'),
('SPED106', 'Preparation of Instructional Materials for SPED', '3.00', '1000.00', 'major', 'EDUC'),
('SPED107', 'Psychological and Physical Knowledge Approaches', '3.00', '1260.00', 'major', 'EDUC'),
('SPED108', 'Inclusive Education', '3.00', '1900.00', 'major', 'EDUC'),
('SPED109', 'ICT and SPED', '3.00', '1500.00', 'major', 'EDUC'),
('SPED110', 'Therapeutic Interventions', '3.00', '1900.00', 'major', 'EDUC'),
('SPED111', 'SPED Classroom Management', '3.00', '1100.00', 'major', 'EDUC'),
('SPED112', 'Movement, Arts & Music for Children', '3.00', '1560.00', 'major', 'EDUC'),
('SPED113', 'Individualized Education Program', '3.00', '1145.00', 'major', 'EDUC'),
('SPED114', 'Research Method', '3.00', '1300.00', 'major', 'EDUC'),
('SPED115', 'Behavioral Management', '3.00', '1100.00', 'major', 'EDUC'),
('SPED116', 'Home & Family Life of Children with Exceptionalities', '3.00', '1700.00', 'major', 'EDUC'),
('SPED117', 'Guidance and Counselling for Children with Special Needs', '3.00', '1000.00', 'major', 'EDUC'),
('SPED118', 'Research in SPED', '3.00', '1000.00', 'major', 'EDUC'),
('SPED119', 'Effective Communication with Professionals and Families', '3.00', '1000.00', 'major', 'EDUC'),
('SW1', 'Knowledge and Philosophical Foundations of the Social Work Profession', '3.00', '1100.00', 'major', 'PSYCH'),
('SW2', 'Philippine Social Realities and Social Welfare', '3.00', '1100.00', 'major', 'PSYCH'),
('SW3', 'Social Work Practice with Individuals and Families', '3.00', '900.00', 'major', 'PSYCH'),
('SW4', 'Social Work Community Education and Training', '3.00', '700.00', 'minor', 'PSYCH');

-- --------------------------------------------------------

--
-- Table structure for table `subject_course`
--

CREATE TABLE `subject_course` (
  `SubjectID` varchar(50) NOT NULL,
  `SubjectCode` varchar(50) NOT NULL,
  `CourseID` varchar(50) NOT NULL,
  `YearLevel` varchar(50) NOT NULL,
  `Semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_course`
--

INSERT INTO `subject_course` (`SubjectID`, `SubjectCode`, `CourseID`, `YearLevel`, `Semester`) VALUES
('SUB-0001', 'GED111', 'CO1-0009', '1st Year', '1st Semester'),
('SUB-0002', 'GED141', 'CO1-0009', '1st Year', '1st Semester'),
('SUB-0003', 'GED151', 'CO1-0009', '1st Year', '1st Semester'),
('SUB-0004', 'GED171', 'CO1-0009', '1st Year', '1st Semester'),
('SUB-0005', 'IT101', 'CO1-0009', '1st Year', '1st Semester'),
('SUB-0006', 'IT102', 'CO1-0009', '1st Year', '1st Semester'),
('SUB-0007', 'ITC101', 'CO1-0009', '1st Year', '1st Semester'),
('SUB-0008', 'NSTP1', 'CO1-0009', '1st Year', '1st Semester'),
('SUB-0009', 'PED101', 'CO1-0009', '1st Year', '1st Semester'),
('SUB-0010', 'IT104', 'CO1-0009', '1st Year', '2nd Semester'),
('SUB-0011', 'IT105', 'CO1-0009', '1st Year', '2nd Semester'),
('SUB-0012', 'IT106', 'CO1-0009', '1st Year', '2nd Semester'),
('SUB-0013', 'GED121', 'CO1-0009', '1st Year', '2nd Semester'),
('SUB-0014', 'GED181', 'CO1-0009', '1st Year', '2nd Semester'),
('SUB-0015', 'GED131', 'CO1-0009', '1st Year', '2nd Semester'),
('SUB-0016', 'GED161', 'CO1-0009', '1st Year', '2nd Semester'),
('SUB-0017', 'PED102', 'CO1-0009', '1st Year', '2nd Semester'),
('SUB-0018', 'NSTP2', 'CO1-0009', '1st Year', '2nd Semester'),
('SUB-0019', 'IT201', 'CO1-0009', '2nd Year', '1st Semester'),
('SUB-0020', 'ITE201', 'CO1-0009', '2nd Year', '1st Semester'),
('SUB-0021', 'ITE202', 'CO1-0009', '2nd Year', '1st Semester'),
('SUB-0022', 'GED182', 'CO1-0009', '2nd Year', '1st Semester'),
('SUB-0023', 'IT103', 'CO1-0009', '2nd Year', '1st Semester'),
('SUB-0024', 'IT202', 'CO1-0009', '2nd Year', '1st Semester'),
('SUB-0025', 'GED152', 'CO1-0009', '2nd Year', '1st Semester'),
('SUB-0026', 'PED103', 'CO1-0009', '2nd Year', '1st Semester'),
('SUB-0027', 'IT203', 'CO1-0009', '2nd Year', '2nd Semester'),
('SUB-0028', 'IT204', 'CO1-0009', '2nd Year', '2nd Semester'),
('SUB-0029', 'IT205', 'CO1-0009', '2nd Year', '2nd Semester'),
('SUB-0030', 'ITC201', 'CO1-0009', '2nd Year', '2nd Semester'),
('SUB-0031', 'IT206', 'CO1-0009', '2nd Year', '2nd Semester'),
('SUB-0032', 'GED172', 'CO1-0009', '2nd Year', '2nd Semester'),
('SUB-0033', 'GED153', 'CO1-0009', '2nd Year', '2nd Semester'),
('SUB-0034', 'PED104', 'CO1-0009', '2nd Year', '2nd Semester'),
('SUB-0035', 'ITE301', 'CO1-0009', '3rd Year', '1st Semester'),
('SUB-0036', 'IT301', 'CO1-0009', '3rd Year', '1st Semester'),
('SUB-0037', 'ITE302', 'CO1-0009', '3rd Year', '1st Semester'),
('SUB-0038', 'IT302', 'CO1-0009', '3rd Year', '1st Semester'),
('SUB-0039', 'ITC301', 'CO1-0009', '3rd Year', '1st Semester'),
('SUB-0040', 'GED191', 'CO1-0009', '3rd Year', '1st Semester'),
('SUB-0041', 'GED192', 'CO1-0009', '3rd Year', '2nd Semester'),
('SUB-0042', 'ITC302', 'CO1-0009', '3rd Year', '2nd Semester'),
('SUB-0043', 'IT303', 'CO1-0009', '3rd Year', '2nd Semester'),
('SUB-0044', 'ITC303', 'CO1-0009', '3rd Year', '2nd Semester'),
('SUB-0045', 'IT304', 'CO1-0009', '3rd Year', '2nd Semester'),
('SUB-0046', 'GED183', 'CO1-0009', '3rd Year', '2nd Semester'),
('SUB-0047', 'IT401', 'CO1-0009', '4th Year', '1st Semester'),
('SUB-0048', 'IT402', 'CO1-0009', '4th Year', '1st Semester'),
('SUB-0049', 'IT403', 'CO1-0009', '4th Year', '1st Semester'),
('SUB-0050', 'ITC401', 'CO1-0009', '4th Year', '1st Semester'),
('SUB-0051', 'OJT', 'CO1-0009', '4th Year', '2nd Semester'),
('SUB-0052', 'IT404', 'CO1-0009', '4th Year', '2nd Semester'),
('SUB-0054', 'PSY101', 'CO1-0013', '1st Year', '1st Semester'),
('SUB-0055', 'GED111', 'CO1-0013', '1st Year', '1st Semester'),
('SUB-0056', 'GED141', 'CO1-0013', '1st Year', '1st Semester'),
('SUB-0057', 'GED171', 'CO1-0013', '1st Year', '1st Semester'),
('SUB-0058', 'GED151', 'CO1-0013', '1st Year', '1st Semester'),
('SUB-0059', 'NSTP1', 'CO1-0013', '1st Year', '1st Semester'),
('SUB-0060', 'PED101', 'CO1-0013', '1st Year', '1st Semester'),
('SUB-0061', 'PSY102', 'CO1-0013', '1st Year', '2nd Semester'),
('SUB-0062', 'GED121', 'CO1-0013', '1st Year', '2nd Semester'),
('SUB-0063', 'GED161', 'CO1-0013', '1st Year', '2nd Semester'),
('SUB-0064', 'GED181', 'CO1-0013', '1st Year', '2nd Semester'),
('SUB-0065', 'GED131', 'CO1-0013', '1st Year', '2nd Semester'),
('SUB-0066', 'NSTP2', 'CO1-0013', '1st Year', '2nd Semester'),
('SUB-0067', 'PED102', 'CO1-0013', '1st Year', '2nd Semester'),
('SUB-0068', 'PSY103', 'CO1-0013', '2nd Year', '1st Semester'),
('SUB-0069', 'PSY104', 'CO1-0013', '2nd Year', '1st Semester'),
('SUB-0070', 'PSY105', 'CO1-0013', '2nd Year', '1st Semester'),
('SUB-0071', 'PSY106', 'CO1-0013', '2nd Year', '1st Semester'),
('SUB-0072', 'GED182', 'CO1-0013', '2nd Year', '1st Semester'),
('SUB-0073', 'GED152', 'CO1-0013', '2nd Year', '1st Semester'),
('SUB-0074', 'PED103', 'CO1-0013', '2nd Year', '1st Semester'),
('SUB-0075', 'PSY107', 'CO1-0013', '2nd Year', '2nd Semester'),
('SUB-0076', 'PSY108', 'CO1-0013', '2nd Year', '2nd Semester'),
('SUB-0077', 'PSY109', 'CO1-0013', '2nd Year', '2nd Semester'),
('SUB-0078', 'GED172', 'CO1-0013', '2nd Year', '2nd Semester'),
('SUB-0079', 'SW1', 'CO1-0013', '2nd Year', '2nd Semester'),
('SUB-0080', 'GED153', 'CO1-0013', '2nd Year', '2nd Semester'),
('SUB-0081', 'PED104', 'CO1-0013', '2nd Year', '2nd Semester'),
('SUB-0082', 'PSY110', 'CO1-0013', '3rd Year', '1st Semester'),
('SUB-0083', 'PSY111', 'CO1-0013', '3rd Year', '1st Semester'),
('SUB-0084', 'PSY112', 'CO1-0013', '3rd Year', '1st Semester'),
('SUB-0085', 'SW2', 'CO1-0013', '3rd Year', '1st Semester'),
('SUB-0086', 'GED191', 'CO1-0013', '3rd Year', '1st Semester'),
('SUB-0087', 'PSY113', 'CO1-0013', '3rd Year', '2nd Semester'),
('SUB-0088', 'PSY113', 'CO1-0013', '3rd Year', '2nd Semester'),
('SUB-0089', 'PSY114', 'CO1-0013', '3rd Year', '2nd Semester'),
('SUB-0090', 'PSY115', 'CO1-0013', '3rd Year', '2nd Semester'),
('SUB-0091', 'GED192', 'CO1-0013', '3rd Year', '2nd Semester'),
('SUB-0092', 'GED183', 'CO1-0013', '3rd Year', '2nd Semester'),
('SUB-0093', 'SW3', 'CO1-0013', '3rd Year', '2nd Semester'),
('SUB-0094', 'PSY116', 'CO1-0013', '4th Year', '1st Semester'),
('SUB-0095', 'PSY117', 'CO1-0013', '4th Year', '1st Semester'),
('SUB-0096', 'SW4', 'CO1-0013', '4th Year', '1st Semester'),
('SUB-0097', 'PSY118', 'CO1-0013', '4th Year', '2nd Semester'),
('SUB-0098', 'PSY119', 'CO1-0013', '4th Year', '2nd Semester'),
('SUB-0099', 'GED111', 'CO1-0012', '1st Year', '1st Semester'),
('SUB-0100', 'GED151', 'CO1-0012', '1st Year', '1st Semester'),
('SUB-0101', 'GED171', 'CO1-0012', '1st Year', '1st Semester'),
('SUB-0102', 'GED141', 'CO1-0012', '1st Year', '1st Semester'),
('SUB-0103', 'Com101', 'CO1-0012', '1st Year', '1st Semester'),
('SUB-0104', 'PED101', 'CO1-0012', '1st Year', '1st Semester'),
('SUB-0105', 'NSTP1', 'CO1-0012', '1st Year', '1st Semester'),
('SUB-0106', 'GED161', 'CO1-0012', '1st Year', '2nd Semester'),
('SUB-0107', 'GED121', 'CO1-0012', '1st Year', '2nd Semester'),
('SUB-0108', 'GED181', 'CO1-0012', '1st Year', '2nd Semester'),
('SUB-0109', 'GED131', 'CO1-0012', '1st Year', '2nd Semester'),
('SUB-0110', 'Com112', 'CO1-0012', '1st Year', '2nd Semester'),
('SUB-0111', 'PED102', 'CO1-0012', '1st Year', '2nd Semester'),
('SUB-0112', 'NSTP2', 'CO1-0012', '1st Year', '2nd Semester'),
('SUB-0113', 'Com115', 'CO1-0012', '2nd Year', '1st Semester'),
('SUB-0114', 'Com118', 'CO1-0012', '2nd Year', '1st Semester'),
('SUB-0115', 'Com123', 'CO1-0012', '2nd Year', '1st Semester'),
('SUB-0116', 'Com127', 'CO1-0012', '2nd Year', '1st Semester'),
('SUB-0117', 'GED152', 'CO1-0012', '2nd Year', '1st Semester'),
('SUB-0118', 'GED182', 'CO1-0012', '2nd Year', '1st Semester'),
('SUB-0119', 'PED103', 'CO1-0012', '2nd Year', '1st Semester'),
('SUB-0120', 'Com130', 'CO1-0012', '2nd Year', '2nd Semester'),
('SUB-0121', 'Com134', 'CO1-0012', '2nd Year', '2nd Semester'),
('SUB-0122', 'Com137', 'CO1-0012', '2nd Year', '2nd Semester'),
('SUB-0123', 'Com140', 'CO1-0012', '2nd Year', '2nd Semester'),
('SUB-0124', 'GED153', 'CO1-0012', '2nd Year', '2nd Semester'),
('SUB-0125', 'GED172', 'CO1-0012', '2nd Year', '2nd Semester'),
('SUB-0126', 'PED104', 'CO1-0012', '2nd Year', '2nd Semester'),
('SUB-0127', 'Res100', 'CO1-0012', '3rd Year', '1st Semester'),
('SUB-0128', 'Com145', 'CO1-0012', '3rd Year', '1st Semester'),
('SUB-0129', 'Com148', 'CO1-0012', '3rd Year', '1st Semester'),
('SUB-0130', 'Com151', 'CO1-0012', '3rd Year', '1st Semester'),
('SUB-0131', 'Com156', 'CO1-0012', '3rd Year', '1st Semester'),
('SUB-0132', 'GED191', 'CO1-0012', '3rd Year', '1st Semester'),
('SUB-0133', 'Com159', 'CO1-0012', '3rd Year', '2nd Semester'),
('SUB-0134', 'Com162', 'CO1-0012', '3rd Year', '2nd Semester'),
('SUB-0135', 'Res101', 'CO1-0012', '3rd Year', '2nd Semester'),
('SUB-0136', 'Com167', 'CO1-0012', '3rd Year', '2nd Semester'),
('SUB-0137', 'GED192', 'CO1-0012', '3rd Year', '2nd Semester'),
('SUB-0138', 'GED183', 'CO1-0012', '3rd Year', '2nd Semester'),
('SUB-0139', 'Com170', 'CO1-0012', '4th Year', '1st Semester'),
('SUB-0140', 'Com173', 'CO1-0012', '4th Year', '1st Semester'),
('SUB-0141', 'Com178', 'CO1-0012', '4th Year', '1st Semester'),
('SUB-0142', 'Res102', 'CO1-0012', '4th Year', '1st Semester'),
('SUB-0143', 'Com181', 'CO1-0012', '4th Year', '2nd Semester'),
('SUB-0144', 'Com184', 'CO1-0012', '4th Year', '2nd Semester'),
('SUB-0145', 'OJT101', 'CO1-0012', '4th Year', '2nd Semester'),
('SUB-0146', 'GED111', 'CO1-0001', '1st Year', '1st Semester'),
('SUB-0147', 'GED141', 'CO1-0001', '1st Year', '1st Semester'),
('SUB-0148', 'GED151', 'CO1-0001', '1st Year', '1st Semester'),
('SUB-0149', 'GED171', 'CO1-0001', '1st Year', '1st Semester'),
('SUB-0150', 'EDU101', 'CO1-0001', '1st Year', '1st Semester'),
('SUB-0151', 'EDU102', 'CO1-0001', '1st Year', '1st Semester'),
('SUB-0152', 'NSTP1', 'CO1-0001', '1st Year', '1st Semester'),
('SUB-0153', 'PED101', 'CO1-0001', '1st Year', '1st Semester'),
('SUB-0154', 'GED121', 'CO1-0001', '1st Year', '2nd Semester'),
('SUB-0155', 'GED131', 'CO1-0001', '1st Year', '2nd Semester'),
('SUB-0156', 'GED161', 'CO1-0001', '1st Year', '2nd Semester'),
('SUB-0157', 'GED181', 'CO1-0001', '1st Year', '2nd Semester'),
('SUB-0158', 'EDU103', 'CO1-0001', '1st Year', '2nd Semester'),
('SUB-0159', 'SPED101', 'CO1-0001', '1st Year', '2nd Semester'),
('SUB-0160', 'NSTP2', 'CO1-0001', '1st Year', '2nd Semester'),
('SUB-0161', 'PED102', 'CO1-0001', '1st Year', '2nd Semester'),
('SUB-0162', 'GED152', 'CO1-0001', '2nd Year', '1st Semester'),
('SUB-0163', 'EDU104', 'CO1-0001', '2nd Year', '1st Semester'),
('SUB-0164', 'SPED102', 'CO1-0001', '2nd Year', '1st Semester'),
('SUB-0165', 'SPED103', 'CO1-0001', '2nd Year', '1st Semester'),
('SUB-0166', 'SPED104', 'CO1-0001', '2nd Year', '1st Semester'),
('SUB-0167', 'SPED105', 'CO1-0001', '2nd Year', '1st Semester'),
('SUB-0168', 'GED182', 'CO1-0001', '2nd Year', '1st Semester'),
('SUB-0169', 'PED103', 'CO1-0001', '2nd Year', '1st Semester'),
('SUB-0170', 'FIL153', 'CO1-0001', '2nd Year', '2nd Semester'),
('SUB-0171', 'EDU105', 'CO1-0001', '2nd Year', '2nd Semester'),
('SUB-0172', 'EDU106', 'CO1-0001', '2nd Year', '2nd Semester'),
('SUB-0173', 'SPED107', 'CO1-0001', '2nd Year', '2nd Semester'),
('SUB-0174', 'SPED108', 'CO1-0001', '2nd Year', '2nd Semester'),
('SUB-0175', 'GED172', 'CO1-0001', '2nd Year', '2nd Semester'),
('SUB-0176', 'PED104', 'CO1-0001', '2nd Year', '2nd Semester'),
('SUB-0177', 'SPED106', 'CO1-0001', '2nd Year', '2nd Semester'),
('SUB-0178', 'EDU107', 'CO1-0001', '3rd Year', '1st Semester'),
('SUB-0179', 'EDU108', 'CO1-0001', '3rd Year', '1st Semester'),
('SUB-0180', 'SPED109', 'CO1-0001', '3rd Year', '1st Semester'),
('SUB-0181', 'SPED110', 'CO1-0001', '3rd Year', '1st Semester'),
('SUB-0182', 'SPED111', 'CO1-0001', '3rd Year', '1st Semester'),
('SUB-0183', 'SPED112', 'CO1-0001', '3rd Year', '1st Semester'),
('SUB-0184', 'SPED113', 'CO1-0001', '3rd Year', '1st Semester'),
('SUB-0185', 'GED191', 'CO1-0001', '3rd Year', '1st Semester'),
('SUB-0187', 'EDU109', 'CO1-0001', '3rd Year', '2nd Semester'),
('SUB-0188', 'EDU110', 'CO1-0001', '3rd Year', '2nd Semester'),
('SUB-0189', 'EDU111', 'CO1-0001', '3rd Year', '2nd Semester'),
('SUB-0190', 'SPED114', 'CO1-0001', '3rd Year', '2nd Semester'),
('SUB-0191', 'SPED115', 'CO1-0001', '3rd Year', '2nd Semester'),
('SUB-0192', 'SPED116', 'CO1-0001', '3rd Year', '2nd Semester'),
('SUB-0193', 'GED192', 'CO1-0001', '3rd Year', '2nd Semester'),
('SUB-0194', 'GED183', 'CO1-0001', '3rd Year', '2nd Semester'),
('SUB-0195', 'EDU112', 'CO1-0001', '4th Year', '1st Semester'),
('SUB-0196', 'SPED117', 'CO1-0001', '4th Year', '1st Semester'),
('SUB-0197', 'SPED118', 'CO1-0001', '4th Year', '1st Semester'),
('SUB-0198', 'SPED119', 'CO1-0001', '4th Year', '1st Semester'),
('SUB-0199', 'EDE101', 'CO1-0001', '4th Year', '1st Semester'),
('SUB-0200', 'EDE102', 'CO1-0001', '4th Year', '1st Semester'),
('SUB-0201', 'EDU113', 'CO1-0001', '4th Year', '2nd Semester');

-- --------------------------------------------------------

--
-- Table structure for table `subject_pre_requisites`
--

CREATE TABLE `subject_pre_requisites` (
  `SubjectCode` varchar(50) NOT NULL,
  `Subject` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_pre_requisites`
--

INSERT INTO `subject_pre_requisites` (`SubjectCode`, `Subject`) VALUES
('IT104', 'IT102'),
('IT105', 'IT102'),
('IT106', 'IT101'),
('IT201', 'IT104'),
('ITE201', 'IT106'),
('ITE202', 'IT101'),
('GED182', 'GED141'),
('IT202', 'IT101'),
('PED103', 'PED102'),
('IT203', 'IT201'),
('IT204', 'ITE202'),
('IT205', 'IT201'),
('ITC201', 'ITE201'),
('IT206', 'IT201'),
('GED153', 'GED152'),
('PED104', 'PED103'),
('ITE301', 'IT206'),
('IT301', 'IT204'),
('ITE302', 'IT106'),
('IT302', 'IT102'),
('IT302', 'IT201'),
('IT301', 'IT101'),
('IT301', 'IT204'),
('ITC302', 'IT301'),
('IT303', 'IT301'),
('ITC303', 'IT302'),
('IT304', 'ITE302'),
('IT401', 'IT303'),
('IT402', 'IT303'),
('IT403', 'ITE301'),
('IT404', 'IT403');

-- --------------------------------------------------------

--
-- Table structure for table `subject_reference`
--

CREATE TABLE `subject_reference` (
  `ReferenceID` varchar(50) NOT NULL,
  `SubjectCode` varchar(50) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_reference`
--

INSERT INTO `subject_reference` (`ReferenceID`, `SubjectCode`, `Title`, `Link`) VALUES
('REF-0001', 'GED141', 'Mathematics in the Modern World Preliminaries', 'https://ched.gov.ph/wp-content/uploads/2017/10/KWF-Mathematics-in-the-Modern-World.pdf'),
('REF-0002', 'GED111', 'Understanding the self preliminaries', 'https://ched.gov.ph/wp-content/uploads/2017/10/Understanding-the-Self.pdf'),
('REF-0003', 'GED151', 'Purposive Communication Preliminaries', 'https://ched.gov.ph/wp-content/uploads/2017/10/Purposive-Communication.pdf'),
('REF-0004', 'GED171', 'Science, Technology and Society', 'https://www.pitzer.edu/academics/field-groups/science-technology-society/'),
('REF-0005', 'IT101', 'IT Fundamentals', 'https://www.youscience.com/ohio/files/standards-pdfs/ks_801.pdf'),
('REF-0006', 'IT101', 'Information Technology Fundamentals', 'https://study.com/academy/course/computer-science-102-fundamentals-of-information-technology.html'),
('REF-0007', 'ITC101', 'Overview of Business Intelligence', 'https://www.cio.com/article/2439504/business-intelligence-definition-and-solutions.html'),
('REF-0008', 'GED171', 'Science Technology and Society By CHED', 'https://ched.gov.ph/wp-content/uploads/2017/10/Science-Technology-and-Society.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `admission_info`
--
ALTER TABLE `admission_info`
  ADD PRIMARY KEY (`AdmissionID`),
  ADD KEY `admission_info_ibfk_1` (`StudentID`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`AnnounceID`),
  ADD KEY `announcement_ibfk_1` (`AdminID`);

--
-- Indexes for table `assessment_due`
--
ALTER TABLE `assessment_due`
  ADD PRIMARY KEY (`AssessmentID`),
  ADD KEY `assessment_due_ibfk_1` (`AcademicID`);

--
-- Indexes for table `class_miscellaneous`
--
ALTER TABLE `class_miscellaneous`
  ADD KEY `MiscID` (`MiscID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `contact_person`
--
ALTER TABLE `contact_person`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `downpayment`
--
ALTER TABLE `downpayment`
  ADD PRIMARY KEY (`AcademicID`);

--
-- Indexes for table `downpayment_approval`
--
ALTER TABLE `downpayment_approval`
  ADD PRIMARY KEY (`ApprovalID`),
  ADD KEY `downpayment_approval_ibfk_1` (`AcademicID`);

--
-- Indexes for table `enrollment_control`
--
ALTER TABLE `enrollment_control`
  ADD PRIMARY KEY (`Control`);

--
-- Indexes for table `grades_encode_sched`
--
ALTER TABLE `grades_encode_sched`
  ADD PRIMARY KEY (`ScheduleID`);

--
-- Indexes for table `grade_dictionary`
--
ALTER TABLE `grade_dictionary`
  ADD PRIMARY KEY (`Grade`);

--
-- Indexes for table `miscellaneous`
--
ALTER TABLE `miscellaneous`
  ADD PRIMARY KEY (`MiscID`);

--
-- Indexes for table `old_student_enrollment`
--
ALTER TABLE `old_student_enrollment`
  ADD PRIMARY KEY (`EncodeID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `student_academic_info`
--
ALTER TABLE `student_academic_info`
  ADD PRIMARY KEY (`AcademicID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `student_academic_info_ibfk_1` (`StudentID`);

--
-- Indexes for table `student_account`
--
ALTER TABLE `student_account`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `student_class`
--
ALTER TABLE `student_class`
  ADD PRIMARY KEY (`ClassID`),
  ADD KEY `AdminID` (`AdminID`),
  ADD KEY `SubjectID` (`SubjectID`),
  ADD KEY `student_class_ibfk_2` (`StudentID`);

--
-- Indexes for table `student_files`
--
ALTER TABLE `student_files`
  ADD PRIMARY KEY (`FileID`),
  ADD KEY `student_files_ibfk_1` (`AdmissionID`);

--
-- Indexes for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD PRIMARY KEY (`GradeID`),
  ADD KEY `SubjectCode` (`SubjectCode`),
  ADD KEY `Grade` (`Grade`),
  ADD KEY `student_grades_ibfk_1` (`StudentID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`SubjectCode`);

--
-- Indexes for table `subject_course`
--
ALTER TABLE `subject_course`
  ADD PRIMARY KEY (`SubjectID`),
  ADD KEY `subject_course_ibfk_1` (`CourseID`),
  ADD KEY `subject_course_ibfk_2` (`SubjectCode`);

--
-- Indexes for table `subject_pre_requisites`
--
ALTER TABLE `subject_pre_requisites`
  ADD KEY `SubjectCode` (`SubjectCode`);

--
-- Indexes for table `subject_reference`
--
ALTER TABLE `subject_reference`
  ADD PRIMARY KEY (`ReferenceID`),
  ADD KEY `subject_reference_ibfk_1` (`SubjectCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `AnnounceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `grades_encode_sched`
--
ALTER TABLE `grades_encode_sched`
  MODIFY `ScheduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON DELETE CASCADE;

--
-- Constraints for table `admission_info`
--
ALTER TABLE `admission_info`
  ADD CONSTRAINT `admission_info_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON DELETE CASCADE;

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`) ON DELETE CASCADE;

--
-- Constraints for table `assessment_due`
--
ALTER TABLE `assessment_due`
  ADD CONSTRAINT `assessment_due_ibfk_1` FOREIGN KEY (`AcademicID`) REFERENCES `student_academic_info` (`AcademicID`) ON DELETE CASCADE;

--
-- Constraints for table `class_miscellaneous`
--
ALTER TABLE `class_miscellaneous`
  ADD CONSTRAINT `class_miscellaneous_ibfk_1` FOREIGN KEY (`MiscID`) REFERENCES `miscellaneous` (`MiscID`),
  ADD CONSTRAINT `class_miscellaneous_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`);

--
-- Constraints for table `contact_person`
--
ALTER TABLE `contact_person`
  ADD CONSTRAINT `contact_person_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON DELETE CASCADE;

--
-- Constraints for table `downpayment`
--
ALTER TABLE `downpayment`
  ADD CONSTRAINT `downpayment_ibfk_1` FOREIGN KEY (`AcademicID`) REFERENCES `student_academic_info` (`AcademicID`) ON DELETE CASCADE;

--
-- Constraints for table `downpayment_approval`
--
ALTER TABLE `downpayment_approval`
  ADD CONSTRAINT `downpayment_approval_ibfk_1` FOREIGN KEY (`AcademicID`) REFERENCES `student_academic_info` (`AcademicID`) ON DELETE CASCADE;

--
-- Constraints for table `old_student_enrollment`
--
ALTER TABLE `old_student_enrollment`
  ADD CONSTRAINT `old_student_enrollment_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `plmarproject`.`student` (`StudentID`) ON DELETE CASCADE;

--
-- Constraints for table `student_academic_info`
--
ALTER TABLE `student_academic_info`
  ADD CONSTRAINT `student_academic_info_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_academic_info_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`);

--
-- Constraints for table `student_account`
--
ALTER TABLE `student_account`
  ADD CONSTRAINT `student_account_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON DELETE CASCADE;

--
-- Constraints for table `student_class`
--
ALTER TABLE `student_class`
  ADD CONSTRAINT `student_class_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`),
  ADD CONSTRAINT `student_class_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_class_ibfk_3` FOREIGN KEY (`SubjectID`) REFERENCES `subject_course` (`SubjectID`);

--
-- Constraints for table `student_files`
--
ALTER TABLE `student_files`
  ADD CONSTRAINT `student_files_ibfk_1` FOREIGN KEY (`AdmissionID`) REFERENCES `admission_info` (`AdmissionID`) ON DELETE CASCADE;

--
-- Constraints for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD CONSTRAINT `student_grades_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_grades_ibfk_2` FOREIGN KEY (`SubjectCode`) REFERENCES `subject` (`SubjectCode`),
  ADD CONSTRAINT `student_grades_ibfk_3` FOREIGN KEY (`Grade`) REFERENCES `grade_dictionary` (`Grade`);

--
-- Constraints for table `subject_course`
--
ALTER TABLE `subject_course`
  ADD CONSTRAINT `subject_course_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`),
  ADD CONSTRAINT `subject_course_ibfk_2` FOREIGN KEY (`SubjectCode`) REFERENCES `subject` (`SubjectCode`);

--
-- Constraints for table `subject_pre_requisites`
--
ALTER TABLE `subject_pre_requisites`
  ADD CONSTRAINT `subject_pre_requisites_ibfk_1` FOREIGN KEY (`SubjectCode`) REFERENCES `subject` (`SubjectCode`);

--
-- Constraints for table `subject_reference`
--
ALTER TABLE `subject_reference`
  ADD CONSTRAINT `subject_reference_ibfk_1` FOREIGN KEY (`SubjectCode`) REFERENCES `subject` (`SubjectCode`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
