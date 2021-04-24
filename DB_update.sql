-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 24, 2021 at 02:02 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tripon`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabs`
--

CREATE TABLE `tabs` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tabs`
--

INSERT INTO `tabs` (`id`, `title`, `description`) VALUES
(1, 'Fleet Parent Type', 'In designing a re-usable seatmap, it is important to start by designing the available fleet types. Use this tab to view already designed fleet types or to create additional fleet types.'),
(2, 'Fleet Type', 'Operators typically reconfigure fleets, either to accommodate more passengers or enhance their safety and comfort. Rather than create a special configuration for each bus, use this tab to create your custom fleet types, each of which will subsequently be used to manage a set of similar buses. In each fleet type you will define the bus seat capacity and also configure the seatmap, by numbering every available seat on the defined fleet type. This will let customers make bookings as well as reserve their seats and tickets.'),
(3, 'Add Fleet Type', 'Use the form below to create new fleet type. Then you can configure and manage a seat map for the fleet type. This will let your customers to select specific bus seats on the seat map during the booking proc.'),
(5, 'Add new route', 'The route represents the starting point (departure) and the final point (arrival) location of a bus trip, and all intermediate stops. To create a route, complete the form below by choosing Route Name, Departure Date/Time and Arrival Date/Time; then click on the orange icon underneath the “Action” column to complete all information for stop points.'),
(6, 'Seat Map', 'At this point, we will automatically generate the seat map for your specific bus type (fleet type). But in order to do this, you will have to fill out\r\nthe form below, and click on “Generate SeatMap”. Once generated, you can re-number/re-order the seats so that they are reflective of the\r\nactual bus type; you can delete seats; and finally save the generated seatmap for the fleet type.'),
(7, 'Fleet', 'Your fleet represents a list of all the buses you operate. Before assigning a bus to a trip, such bus must be enrolled as part of the Operator’s fleet, and all relevant attributes of such bus including its make, model, registration number, odometer readings, etc must be\nregistered in the database. Use this page to register all buses that are members of your fleet.'),
(8, 'Trip List', 'Below is a list of all available trips, as well as the elements of each trip, including the assigned bus, the route on which the bus operates, the designated driver, the planned departure time, the estimated arrival time, and details of each intermediate stop.'),
(9, 'Add New Trip', 'Use the form below to create a trip. You will need to define a route that the specific bus operates on. Of course the bus must have already been associated with a bus type (fleet type) and seat map. Then you will need to define the departure time, the estimated arrival time at the final destination as well as at each stop point along the selected route. In the next tab that follows, you will need to define the schedule.'),
(10, 'Stop Points', 'Use the form below to display a list of all stop points associated with a route. Then define the estimated arrival time and departure time for each stop, and finally link this stop-point set including the time elements with a specific trip. This way it is possible for different trips operating on same route and same stop-point to arrive/depart at different\ntimes.'),
(11, 'Cancellation Policies', 'This page maintains the cancellation policy details with Operator name, refundable amount, duration details, and actions details. Data\r\nstored here for each Bus Operator is used in determining whether a user is entitled to a refund or not, and if such a user is entitled to a\r\nrefund, it is used in calculating the amount of refund due.'),
(12, 'Operators', 'This is operators.'),
(13, 'Users', 'This is users.'),
(14, 'Add Operators', 'Add Operators'),
(15, 'Add Users', 'Add Users'),
(16, 'Cities', 'This is cities.'),
(17, 'Add City', 'Add City'),
(18, 'Booking List', 'This is booking list.'),
(19, 'FAQ', 'This is FAQ.'),
(20, 'Add FAQ', 'Add FAQ.'),
(21, 'Edit FAQ', 'Edit FAQ.'),
(22, 'Amenity Gallery', 'Amenity Gallery.'),
(23, 'Add Fleet', 'Add Fleet Type.'),
(24, 'Update Operator', 'Update Operator'),
(25, 'Update User', 'Update User'),
(26, 'Update City', 'Update City');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabs`
--
ALTER TABLE `tabs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabs`
--
ALTER TABLE `tabs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
