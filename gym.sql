-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26-Fev-2017 às 23:27
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `exercise`
--

CREATE TABLE `exercise` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `exercise_workout`
--

CREATE TABLE `exercise_workout` (
  `id` int(11) NOT NULL,
  `Exercise_Id` int(11) NOT NULL,
  `Workout_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `plan_workout`
--

CREATE TABLE `plan_workout` (
  `id` int(11) NOT NULL,
  `Plan_Id` int(11) NOT NULL,
  `Workout_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `First_Name` text NOT NULL,
  `Last_Name` text NOT NULL,
  `Email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_plan`
--

CREATE TABLE `user_plan` (
  `id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Plan_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `workout`
--

CREATE TABLE `workout` (
  `id` int(11) NOT NULL,
  `Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercise_workout`
--
ALTER TABLE `exercise_workout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Exercise_Id` (`Exercise_Id`),
  ADD KEY `Workout_Id` (`Workout_Id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_workout`
--
ALTER TABLE `plan_workout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_plan`
--
ALTER TABLE `user_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout`
--
ALTER TABLE `workout`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `exercise_workout`
--
ALTER TABLE `exercise_workout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `plan_workout`
--
ALTER TABLE `plan_workout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user_plan`
--
ALTER TABLE `user_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `workout`
--
ALTER TABLE `workout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
