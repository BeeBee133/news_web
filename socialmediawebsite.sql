-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 04:46 PM
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
-- Database: `socialmediawebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phNo` varchar(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `user_id`, `phNo`, `content`, `date`) VALUES
(20, 2, '09222334323', 'asdfasdf', '2025-01-06 16:03:21'),
(21, 2, '09222334323', 'hello this is testing', '2025-01-06 17:06:27'),
(22, 12, '09222334323', 'hi admin', '2025-01-06 17:06:56'),
(23, 12, '09444334343', 'Hello This is Testing Message from mya\r\n', '2025-01-07 14:15:03'),
(24, 8, '09444334343', 'Hello This is Testing Message from mya\r\n', '2025-01-07 14:18:45'),
(25, 8, '09222334323', 'Hello this is testing contact', '2025-01-10 11:27:03'),
(26, 14, '09222334323', 'Hello This is testing contact', '2025-01-10 11:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `howparentcanhelp`
--

CREATE TABLE `howparentcanhelp` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `image` varchar(500) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `howparentcanhelp`
--

INSERT INTO `howparentcanhelp` (`id`, `title`, `image`, `content`, `date`) VALUES
(28, 'Setting Up Parental Controls for Safer Browsing', '../uploads/parental-control-software-blocked-prohibited-or-inappropriate-content-for-kids-access-restrict-online-safe-internet-flat-modern-illustration-vector.jpg', 'Setting up parental controls is an essential part of protecting children from the vast array of risks they may face online, including exposure to inappropriate content, cyberbullying, and other dangers. Parental controls allow parents to regulate the websites and apps their children can access, filter out harmful content, and monitor screen time. The first step is for parents to ensure that the devices their children use have built-in parental control settings enabled. For instance, most operating systems, such as Windows, macOS, and iOS, offer features like content filters, time limits, and activity monitoring tools. Parents can restrict access to certain websites or categories of content that are not appropriate for their child’s age group, such as adult material or violent games. Another important feature of parental controls is screen time management, which helps set limits on how long a child can use a device each day. Setting time limits ensures that children don\'t spend excessive hours on screens, which can affect their physical and mental well-being. In addition to device settings, parents can also use third-party parental control apps or software that offer more comprehensive monitoring. These tools allow parents to track their children\'s online activities, view their browsing history, and even block apps or games that may not align with family values. It’s also important for parents to regularly review and update the settings as their children grow older and their online activities evolve. While parental controls can be a helpful safeguard, they should not be the only method used. Parents must also engage in regular communication with their kids about the dangers of the internet and encourage them to come forward if they encounter anything that makes them uncomfortable. A balance of technology tools and open dialogue is key to ensuring that children can enjoy a safe and positive online experience.', '2025-01-07 14:17:46'),
(29, 'Teaching Kids About Phishing and Scams', '../uploads/digcit-lesson-social-share-62-dont-feed-the-phish.jpg', 'Phishing scams, where cybercriminals impersonate legitimate organizations to steal personal information, are one of the most common threats children face online. Because children may lack the experience to recognize these types of scams, it’s crucial for parents to educate them about the dangers of phishing and how to spot suspicious emails, messages, or websites. The first step in this education is to explain the concept of phishing in simple terms. Parents should describe how scammers often pretend to be trusted companies, such as banks or popular online services, to trick people into giving away sensitive information like passwords, credit card numbers, or social security details. Parents should stress that no reputable company will ever ask for sensitive data through email or text messages. Teaching children to be wary of unsolicited messages that ask for personal information or direct them to unfamiliar websites is key. Parents can also demonstrate how to verify the legitimacy of a message by checking the sender’s email address, looking for spelling errors or unusual language, and contacting the company directly if in doubt. Another important lesson is to never click on suspicious links or download attachments from unknown sources. Scammers often disguise malicious links as something enticing, such as a free prize or an urgent alert, to lure people into clicking. Parents can also guide their children on the proper use of security tools, such as antivirus software and email filtering, which can help block malicious messages. In addition, parents should encourage their kids to report phishing attempts to a trusted adult or authority figure. By educating children on how to recognize, avoid, and report phishing scams, parents can reduce the likelihood of their children falling victim to these harmful tactics.\r\n\r\n', '2025-01-07 14:17:59'),
(30, 'Encouraging Safe Social Media Practices', '../uploads/102258236_767576940_Social_Media_400.jpg', 'Social media has become an integral part of children’s lives, offering both positive and negative experiences. While these platforms can foster creativity and social interaction, they also pose significant risks, such as exposure to inappropriate content, cyberbullying, and privacy violations. Parents must guide their children on how to use social media safely and responsibly. The first step is to have an open conversation about the potential dangers of social media. Parents should explain the importance of privacy settings, ensuring that children understand how to restrict who can see their posts and who can contact them. By setting their profiles to private, children can control who views their content, which helps reduce exposure to strangers or unwanted attention. Parents should also advise their children to think carefully before sharing personal information, such as their location, phone number, or family details. It’s essential that kids understand that even harmless-seeming posts can have long-term consequences, such as affecting future college or job opportunities. In addition to privacy, parents should talk to their kids about the impact of online interactions, including the risks of cyberbullying and how to handle negative comments or harmful behavior. Children should know that it’s important to report inappropriate behavior, block users who are abusive, and avoid responding to online harassment. Parents can also set time limits for social media use to ensure that their children aren’t spending excessive hours on these platforms, which can affect their mental health and well-being. Lastly, parents should stay involved in their child’s online life by regularly discussing their social media experiences and keeping an eye on their accounts to spot any red flags. By fostering responsible social media practices, parents can help their children navigate the digital world safely.', '2025-01-07 14:18:11'),
(31, 'Teaching Kids to Create Strong Passwords', '../uploads/images (1).jpg', 'In an era where digital security is a top concern, teaching kids how to create and manage strong passwords is one of the most important things parents can do. Many children may be tempted to use simple, easy-to-remember passwords like \"123456\" or their birthdate, which can be easily guessed by hackers. Parents should emphasize the importance of using complex passwords with a combination of letters, numbers, and special characters. It\'s also helpful to teach kids the significance of using different passwords for each account rather than reusing the same one across multiple sites. One effective way to help children manage multiple passwords is by introducing them to password managers—secure tools that can store and generate complex passwords. Parents should explain the risks associated with weak passwords, like identity theft or unauthorized access to personal information, and ensure their kids understand that strong passwords are the first line of defense against cybercriminals. Another aspect is encouraging children to update their passwords regularly, especially if they suspect any of their accounts may have been compromised. Additionally, parents should explain the importance of not sharing passwords with friends or acquaintances, even if they trust them. Teaching kids about two-factor authentication (2FA) is another way to boost security. Parents can show children how enabling 2FA can add an extra layer of protection to accounts, especially for services like email, social media, and online banking. By instilling these habits early on, parents can empower their children to be proactive about their online security and build good digital hygiene practices that will last a lifetime.\r\n\r\n', '2025-01-07 15:49:18'),
(32, 'Test1', '../uploads/global-data-security-personal-data-security-cyber-data-security-online-concept-illustration-internet-security-information-privacy-protection_1150-37373.avif', 'Test1', '2025-01-10 11:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phNo` varchar(255) NOT NULL,
  `password` varchar(8) NOT NULL,
  `usertype` int(11) NOT NULL,
  `subscription` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `phNo`, `password`, `usertype`, `subscription`) VALUES
(2, 'Su Su', 'susu@gmail.com', '09333223982', '12345', 1, 1),
(3, 'Kyaw Kyaw ', 'kyawkyaw@gmail.com', '09333223982', '12345', 1, 1),
(4, 'admin', 'admin@gmail.com', '09333223982', '12345', 0, 0),
(5, 'admin1', 'admin1@gmail.com', '09333223982', '12345', 0, 0),
(7, 'Bunny', 'jad123@gmail.com', '09444776234', '123', 0, 0),
(8, 'Jadson', 'admin123@gmail.com', '09444776517', '123', 0, 0),
(9, 'MinMinOo', 'min@gmail.com', '09333665267', '123', 1, 1),
(10, 'BeeBee', 'bee@gmail.com', '09333223424', '123', 0, 0),
(11, 'BeeBEE133', 'bee133@gmail.com', '09444776517', '123', 1, 0),
(12, 'MyaMya', 'mya@gmail.com', '09333442345', '123', 1, 1),
(13, 'Thiri', 'thiri123@gmail.com', '09444776517', '123', 1, 0),
(14, 'MyatMyat', 'Myat@gmail.com', '09444776234', '123', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `image1` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `authorname` varchar(500) NOT NULL,
  `publisheddate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `title`, `image1`, `content`, `authorname`, `publisheddate`) VALUES
(38, 'CyberKids Weekly', '../uploads/1736182984_images (2).png', 'A family-friendly newsletter designed to educate children and parents about safe internet habits. Each edition covers simple tips for secure browsing, gaming safely, and identifying online threats like phishing or scams. With puzzles, stories, and interactive challenges, CyberKids Weekly makes learning about cybersecurity fun and engaging. Perfect for young learners aged 8–14.', '', '2025-01-06 17:03:04'),
(39, 'Digital Safety Digest for Families', '../uploads/1736182994_images (1).png', 'This newsletter provides actionable advice to protect kids online while teaching them responsible digital citizenship. Articles include how to manage screen time, understanding social media privacy, and avoiding online predators. Parents will find tools to monitor activity, while kids get easy guides to staying secure on apps and games they love.', '', '2025-01-06 17:03:14'),
(40, 'KidSecure Alert', '../uploads/1736183005_images (2).jpg', 'A bi-weekly newsletter focused on keeping children informed about the latest online safety issues. Topics range from safe social media use to recognizing malicious links in emails and games. Featuring contributions from cybersecurity experts, KidSecure Alert ensures children understand the risks of sharing personal information online in a digestible way.', '', '2025-01-06 17:03:25'),
(41, 'SafeWeb Jr', '../uploads/1736183017_images (1).png', 'Designed for tech-savvy kids and cautious parents, SafeWeb Jr. tackles current internet threats impacting young users. Its colorful, easy-to-read format includes safety tips for online gaming, avoiding malware, and protecting personal data. Includes expert interviews and advice on building healthy digital habits for a balanced lifestyle.', '', '2025-01-06 17:03:37'),
(42, ' Cyber Explorers Monthly', '../uploads/images (2).png', 'Aimed at inspiring the next generation of cybersecurity professionals, this newsletter introduces kids to ethical hacking basics, cybersecurity careers, and how to protect themselves online. With games, quizzes, and step-by-step projects, Cyber Explorers Monthly makes cybersecurity exciting and relevant to young minds.', '', '2025-01-10 12:15:51'),
(45, 'test', '../uploads/1736510926_identification-illustration-of-identity-card-with-photo-document-and-information-in-face-id-system-flat-cartoon-hand-drawn-templates-vector.jpg', 'test', '', '2025-01-10 12:08:46'),
(46, '123', '../uploads/global-data-security-personal-data-security-cyber-data-security-online-concept-illustration-internet-security-information-privacy-protection_1150-37373.avif', '123', '', '2025-01-10 12:15:29');

-- --------------------------------------------------------

--
-- Table structure for table `socialmediaapp`
--

CREATE TABLE `socialmediaapp` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `loginlink` varchar(1000) NOT NULL,
  `privacylink` varchar(1500) NOT NULL,
  `risk` varchar(5000) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `socialmediaapp`
--

INSERT INTO `socialmediaapp` (`id`, `name`, `loginlink`, `privacylink`, `risk`, `image`) VALUES
(54, 'FaceBook', 'https://www.facebook.com/login', 'https://www.facebook.com/policy.php', '', '../uploads/1736182317_images (1).jpg'),
(55, 'instragram', 'https://www.instagram.com/accounts/login/', 'https://help.instagram.com/519522125107875', '', '../uploads/1736182332_images (2).jpg'),
(56, 'Twitter', 'https://twitter.com/login', 'https://twitter.com/en/privacy', '', '../uploads/1736182421_images.png'),
(57, 'LinkIn', ' https://www.linkedin.com/login', 'https://www.linkedin.com/legal/privacy-policy', '', '../uploads/1736182838_images (1).png'),
(58, 'Snap chat', 'https://accounts.snapchat.com/accounts/login', 'https://snap.com/en-US/privacy/privacy-policy', '', '../uploads/1736182875_images (2).png'),
(61, 'MinMin', 'link', 'link', '', '../uploads/images (2).png'),
(62, 'test', 'test', 'test', '', '../uploads/global-data-security-personal-data-security-cyber-data-security-online-concept-illustration-internet-security-information-privacy-protection_1150-37373.avif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `howparentcanhelp`
--
ALTER TABLE `howparentcanhelp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socialmediaapp`
--
ALTER TABLE `socialmediaapp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `howparentcanhelp`
--
ALTER TABLE `howparentcanhelp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `socialmediaapp`
--
ALTER TABLE `socialmediaapp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
