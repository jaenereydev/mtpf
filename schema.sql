-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 10:46 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sims`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_no` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `active` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `c_no` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `telno` varchar(45) DEFAULT NULL,
  `imglink` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`c_no`, `name`, `address`, `telno`, `imglink`) VALUES
(1, 'Tindahan ni lia', 'sipocot', '123456', 'images/company/tnllogo.png');

-- --------------------------------------------------------

--
-- Table structure for table `creditduedate`
--

CREATE TABLE `creditduedate` (
  `cdd_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `ref_no` varchar(45) DEFAULT NULL,
  `duedate` varchar(45) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `amountpayed` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `transaction_t_no` int(11) DEFAULT NULL,
  `customer_c_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `creditduedate`
--


--
-- Table structure for table `creditduedateline`
--

CREATE TABLE `creditduedateline` (
  `cddl_no` int(11) NOT NULL,
  `customerpayment_cp_no` int(11) NOT NULL,
  `creditduedate_cdd_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `creditduedateline`
--

--
-- Table structure for table `creditloanline`
--

CREATE TABLE `creditloanline` (
  `cll_no` int(11) NOT NULL,
  `unitcost` varchar(45) DEFAULT NULL,
  `totalunitcost` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  `discountamount` varchar(45) DEFAULT NULL,
  `totalamount` varchar(45) DEFAULT NULL,
  `product_p_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `credit_loan_cl_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `creditloanline`
--

-- --------------------------------------------------------

--
-- Table structure for table `credit_loan`
--

CREATE TABLE `credit_loan` (
  `cl_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `maturity` varchar(45) DEFAULT NULL,
  `principal_balance` varchar(255) DEFAULT NULL,
  `downpayment` varchar(425) DEFAULT NULL,
  `amount_balance` varchar(255) DEFAULT NULL,
  `termsbymonth` varchar(45) DEFAULT NULL,
  `percentage` varchar(45) DEFAULT NULL,
  `due_amount` varchar(255) DEFAULT NULL,
  `grandtotalbalance` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `outstanding_balance` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `customer_c_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credit_loan`

-- --------------------------------------------------------

--
-- Table structure for table `credit_loan_payment`
--

CREATE TABLE `credit_loan_payment` (
  `clp_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `due_date` varchar(45) DEFAULT NULL,
  `due_amount` varchar(45) DEFAULT NULL,
  `penalty` varchar(45) DEFAULT NULL,
  `amount_payed` varchar(45) DEFAULT NULL,
  `credit_loan_cl_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_no` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `telno` varchar(45) DEFAULT NULL,
  `credit_limit` varchar(45) DEFAULT NULL,
  `balance` varchar(45) DEFAULT NULL,
  `terms` varchar(45) DEFAULT NULL,
  `active` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `customer_category_cc_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--


--
-- Table structure for table `customerbalance_history`
--

CREATE TABLE `customerbalance_history` (
  `cbh_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `ci_amount` varchar(45) DEFAULT NULL,
  `ci_payment` varchar(45) DEFAULT NULL,
  `ref_no` varchar(45) DEFAULT NULL,
  `balance` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `customer_c_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerbalance_history`
--


--
-- Table structure for table `customerpayment`
--

CREATE TABLE `customerpayment` (
  `cp_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `totalcredit` varchar(45) DEFAULT NULL,
  `totalpayment` varchar(45) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `post` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `customer_c_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerpayment`
--

-- --------------------------------------------------------

--
-- Table structure for table `customerpaymentline`
--

CREATE TABLE `customerpaymentline` (
  `cpl_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `customerpayment_cp_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerpaymentline`
--


CREATE TABLE `customersales_history` (
  `csh_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `customer_c_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_t_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customersales_history`
--


--
-- Table structure for table `customer_category`
--

CREATE TABLE `customer_category` (
  `cc_no` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_category`
--
-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `d_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `ref_no` varchar(45) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  `totalamount` varchar(45) DEFAULT NULL,
  `post` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `supplier_s_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `deliveryline`
--

CREATE TABLE `deliveryline` (
  `dl_no` int(11) NOT NULL,
  `unitcost` varchar(45) DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `delivery_d_no` int(11) NOT NULL,
  `product_p_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliveryline`
--

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `d_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deposit`
--
--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `e_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--
-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `i_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `ref_no` varchar(45) DEFAULT NULL,
  `totalamount` varchar(45) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `post` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--


-- --------------------------------------------------------

--
-- Table structure for table `inventoryline`
--

CREATE TABLE `inventoryline` (
  `il_no` int(11) NOT NULL,
  `unitcost` varchar(45) DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `oldqty` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `product_p_no` int(11) NOT NULL,
  `inventory_i_no` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventoryline`
--


--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_no` int(11) NOT NULL,
  `barcode` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `unitcost` varchar(45) DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `srpprice` varchar(45) DEFAULT NULL,
  `price2` varchar(45) DEFAULT NULL,
  `price3` varchar(45) DEFAULT NULL,
  `active` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `supplier_s_no` int(11) NOT NULL,
  `category_c_no` int(11) NOT NULL,
  `inventory` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_history`
--

CREATE TABLE `product_history` (
  `ph_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `ref_no` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `inqty` varchar(45) DEFAULT NULL,
  `outqty` varchar(45) DEFAULT NULL,
  `bal` varchar(45) DEFAULT NULL,
  `product_p_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_history`
--


CREATE TABLE `repayment` (
  `r_no` int(11) NOT NULL,
  `customer_c_no` int(11) NOT NULL,
  `credit_loan_cl_no` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `due_date` varchar(45) DEFAULT NULL,
  `due_amount` varchar(45) DEFAULT NULL,
  `penalty` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `amount_payed` varchar(45) DEFAULT NULL,
  `date_payed` varchar(45) DEFAULT NULL,
  `post` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repayment`
--

-- --------------------------------------------------------

--
-- Table structure for table `returnstock`
--

CREATE TABLE `returnstock` (
  `rs_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `totalqty` varchar(45) DEFAULT NULL,
  `discountamount` varchar(45) DEFAULT NULL,
  `totalamount` varchar(45) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `returnstockline`
--

CREATE TABLE `returnstockline` (
  `rsl_no` int(11) NOT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `discountamount` varchar(45) DEFAULT NULL,
  `returnstock_rs_no` int(11) NOT NULL,
  `product_p_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `returntransaction`
--

CREATE TABLE `returntransaction` (
  `rt_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `totalamount` varchar(45) DEFAULT NULL,
  `totalqty` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `creditduedate_cdd_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returntransaction`
--

--
-- Table structure for table `returntransactionline`
--

CREATE TABLE `returntransactionline` (
  `rtl_no` int(11) NOT NULL,
  `unitcost` varchar(45) DEFAULT NULL,
  `totalunitcost` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  `discountamount` varchar(45) DEFAULT NULL,
  `totalamount` varchar(45) DEFAULT NULL,
  `returntransaction_rt_no` int(11) DEFAULT NULL,
  `product_p_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returntransactionline`
--

--
-- Table structure for table `salesreport`
--

CREATE TABLE `salesreport` (
  `sr_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `cashonhand` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesreport`
--

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `s_no` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `salesman` varchar(45) DEFAULT NULL,
  `terms` varchar(45) DEFAULT NULL,
  `active` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_no` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `schedule` varchar(45) DEFAULT NULL,
  `schedule_date` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `assign_user_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

--
-- Table structure for table `task_result`
--

CREATE TABLE `task_result` (
  `taskresult_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `task_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `t_no` int(11) NOT NULL,
  `date` varchar(45) DEFAULT NULL,
  `ref_no` varchar(45) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  `totalqty` varchar(45) DEFAULT NULL,
  `totaldiscount` varchar(45) DEFAULT NULL,
  `totalamount` varchar(45) DEFAULT NULL,
  `cashonhand` varchar(45) DEFAULT NULL,
  `change` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `customer_c_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--


--
-- Table structure for table `transactionline`
--

CREATE TABLE `transactionline` (
  `tl_no` int(11) NOT NULL,
  `unitcost` varchar(45) DEFAULT NULL,
  `totalunitcost` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `returnqty` varchar(45) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  `discountamount` varchar(45) DEFAULT NULL,
  `totalamount` varchar(45) DEFAULT NULL,
  `transaction_t_no` int(11) DEFAULT NULL,
  `product_p_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactionline`
--


--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `percentage` varchar(45) NOT NULL,
  `collectable_commission` varchar(45) NOT NULL,
  `uncollectable_commission` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `position`, `status`, `percentage`, `collectable_commission`, `uncollectable_commission`) VALUES
(1, 'Apo Lasat', 'apo', 'apo', 'Admin', 'ACTIVE', '0', '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_no`),
  ADD KEY `fk_category_user1_idx` (`user_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`c_no`);

--
-- Indexes for table `creditduedate`
--
ALTER TABLE `creditduedate`
  ADD PRIMARY KEY (`cdd_no`),
  ADD KEY `fk_creditduedate_transaction1_idx` (`transaction_t_no`),
  ADD KEY `fk_creditduedate_customer1_idx` (`customer_c_no`);

--
-- Indexes for table `creditduedateline`
--
ALTER TABLE `creditduedateline`
  ADD PRIMARY KEY (`cddl_no`),
  ADD KEY `fk_creditduedateline_customerpayment1_idx` (`customerpayment_cp_no`),
  ADD KEY `fk_creditduedateline_creditduedate1_idx` (`creditduedate_cdd_no`);

--
-- Indexes for table `creditloanline`
--
ALTER TABLE `creditloanline`
  ADD PRIMARY KEY (`cll_no`),
  ADD KEY `fk_transactionline_product1_idx` (`product_p_no`),
  ADD KEY `fk_transactionline_user1_idx` (`user_id`),
  ADD KEY `fk_creditloanline_credit_loan1_idx` (`credit_loan_cl_no`);

--
-- Indexes for table `credit_loan`
--
ALTER TABLE `credit_loan`
  ADD PRIMARY KEY (`cl_no`),
  ADD KEY `fk_credit_loan_user1_idx` (`user_id`),
  ADD KEY `fk_credit_loan_user2_idx` (`agent_id`),
  ADD KEY `fk_credit_loan_customer1_idx` (`customer_c_no`);

--
-- Indexes for table `credit_loan_payment`
--
ALTER TABLE `credit_loan_payment`
  ADD PRIMARY KEY (`clp_no`),
  ADD KEY `fk_credit_loan_payment_credit_loan1_idx` (`credit_loan_cl_no`),
  ADD KEY `fk_credit_loan_payment_user1_idx` (`user_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_no`),
  ADD KEY `fk_customer_user1_idx` (`user_id`),
  ADD KEY `fk_customer_customer_category1_idx` (`customer_category_cc_no`);

--
-- Indexes for table `customerbalance_history`
--
ALTER TABLE `customerbalance_history`
  ADD PRIMARY KEY (`cbh_no`),
  ADD KEY `fk_customerbalance_history_customer1_idx` (`customer_c_no`),
  ADD KEY `fk_customerbalance_history_user1_idx` (`user_id`);

--
-- Indexes for table `customerpayment`
--
ALTER TABLE `customerpayment`
  ADD PRIMARY KEY (`cp_no`),
  ADD KEY `fk_customerpayment_user1_idx` (`user_id`),
  ADD KEY `fk_customerpayment_customer1_idx` (`customer_c_no`);

--
-- Indexes for table `customerpaymentline`
--
ALTER TABLE `customerpaymentline`
  ADD PRIMARY KEY (`cpl_no`),
  ADD KEY `fk_customerpaymentline_customerpayment1_idx` (`customerpayment_cp_no`),
  ADD KEY `fk_customerpaymentline_user1_idx` (`user_id`);

--
-- Indexes for table `customersales_history`
--
ALTER TABLE `customersales_history`
  ADD PRIMARY KEY (`csh_no`),
  ADD KEY `fk_customer_history_customer1_idx` (`customer_c_no`),
  ADD KEY `fk_customer_history_user1_idx` (`user_id`),
  ADD KEY `fk_customer_history_transaction1_idx` (`transaction_t_no`);

--
-- Indexes for table `customer_category`
--
ALTER TABLE `customer_category`
  ADD PRIMARY KEY (`cc_no`),
  ADD KEY `fk_customer_category_user1_idx` (`user_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`d_no`),
  ADD KEY `fk_delivery_user1_idx` (`user_id`),
  ADD KEY `fk_delivery_supplier1_idx` (`supplier_s_no`);

--
-- Indexes for table `deliveryline`
--
ALTER TABLE `deliveryline`
  ADD PRIMARY KEY (`dl_no`),
  ADD KEY `fk_deliveryline_delivery1_idx` (`delivery_d_no`),
  ADD KEY `fk_deliveryline_product1_idx` (`product_p_no`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`d_no`),
  ADD KEY `fk_deposit_user1_idx` (`user_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`e_no`),
  ADD KEY `fk_expenses_user1_idx` (`user_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`i_no`),
  ADD KEY `fk_delivery_user1_idx` (`user_id`);

--
-- Indexes for table `inventoryline`
--
ALTER TABLE `inventoryline`
  ADD PRIMARY KEY (`il_no`),
  ADD KEY `fk_deliveryline_product1_idx` (`product_p_no`),
  ADD KEY `fk_inventoryline_inventory1_idx` (`inventory_i_no`),
  ADD KEY `fk_inventoryline_user1_idx` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_no`),
  ADD KEY `fk_product_user1_idx` (`user_id`),
  ADD KEY `fk_product_supplier1_idx` (`supplier_s_no`),
  ADD KEY `fk_product_category1_idx` (`category_c_no`);

--
-- Indexes for table `product_history`
--
ALTER TABLE `product_history`
  ADD PRIMARY KEY (`ph_no`),
  ADD KEY `fk_product_history_product1_idx` (`product_p_no`),
  ADD KEY `fk_product_history_user1_idx` (`user_id`);

--
-- Indexes for table `repayment`
--
ALTER TABLE `repayment`
  ADD PRIMARY KEY (`r_no`),
  ADD KEY `fk_repayment_customer1_idx` (`customer_c_no`),
  ADD KEY `fk_repayment_credit_loan1_idx` (`credit_loan_cl_no`),
  ADD KEY `fk_repayment_user1_idx` (`user_id`);

--
-- Indexes for table `returnstock`
--
ALTER TABLE `returnstock`
  ADD PRIMARY KEY (`rs_no`),
  ADD KEY `fk_returnstock_user1_idx` (`user_id`);

--
-- Indexes for table `returnstockline`
--
ALTER TABLE `returnstockline`
  ADD PRIMARY KEY (`rsl_no`),
  ADD KEY `fk_returnstockline_returnstock1_idx` (`returnstock_rs_no`),
  ADD KEY `fk_returnstockline_product1_idx` (`product_p_no`);

--
-- Indexes for table `returntransaction`
--
ALTER TABLE `returntransaction`
  ADD PRIMARY KEY (`rt_no`),
  ADD KEY `fk_returntransaction_creditduedate1_idx` (`creditduedate_cdd_no`),
  ADD KEY `fk_returntransaction_user1_idx` (`user_id`);

--
-- Indexes for table `returntransactionline`
--
ALTER TABLE `returntransactionline`
  ADD PRIMARY KEY (`rtl_no`),
  ADD KEY `fk_returntransactionline_returntransaction1_idx` (`returntransaction_rt_no`),
  ADD KEY `fk_returntransactionline_product1_idx` (`product_p_no`),
  ADD KEY `fk_returntransactionline_user1_idx` (`user_id`);

--
-- Indexes for table `salesreport`
--
ALTER TABLE `salesreport`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `fk_salesreport_user1_idx` (`user_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `fk_supplier_user_idx` (`user_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_no`),
  ADD KEY `fk_task_user1_idx` (`assign_user_id`),
  ADD KEY `fk_task_user2_idx` (`user_id`);

--
-- Indexes for table `task_result`
--
ALTER TABLE `task_result`
  ADD PRIMARY KEY (`taskresult_no`),
  ADD KEY `fk_task_result_user1_idx` (`user_id`),
  ADD KEY `fk_task_result_task1_idx` (`task_no`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`t_no`),
  ADD KEY `fk_transaction_user1_idx` (`user_id`),
  ADD KEY `fk_transaction_customer1_idx` (`customer_c_no`);

--
-- Indexes for table `transactionline`
--
ALTER TABLE `transactionline`
  ADD PRIMARY KEY (`tl_no`),
  ADD KEY `fk_transactionline_transaction1_idx` (`transaction_t_no`),
  ADD KEY `fk_transactionline_product1_idx` (`product_p_no`),
  ADD KEY `fk_transactionline_user1_idx` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `c_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `creditduedate`
--
ALTER TABLE `creditduedate`
  MODIFY `cdd_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `creditduedateline`
--
ALTER TABLE `creditduedateline`
  MODIFY `cddl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `creditloanline`
--
ALTER TABLE `creditloanline`
  MODIFY `cll_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_loan`
--
ALTER TABLE `credit_loan`
  MODIFY `cl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_loan_payment`
--
ALTER TABLE `credit_loan_payment`
  MODIFY `clp_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customerbalance_history`
--
ALTER TABLE `customerbalance_history`
  MODIFY `cbh_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customerpayment`
--
ALTER TABLE `customerpayment`
  MODIFY `cp_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customerpaymentline`
--
ALTER TABLE `customerpaymentline`
  MODIFY `cpl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customersales_history`
--
ALTER TABLE `customersales_history`
  MODIFY `csh_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_category`
--
ALTER TABLE `customer_category`
  MODIFY `cc_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `d_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliveryline`
--
ALTER TABLE `deliveryline`
  MODIFY `dl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `d_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `e_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `i_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventoryline`
--
ALTER TABLE `inventoryline`
  MODIFY `il_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_history`
--
ALTER TABLE `product_history`
  MODIFY `ph_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repayment`
--
ALTER TABLE `repayment`
  MODIFY `r_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returnstock`
--
ALTER TABLE `returnstock`
  MODIFY `rs_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returnstockline`
--
ALTER TABLE `returnstockline`
  MODIFY `rsl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returntransaction`
--
ALTER TABLE `returntransaction`
  MODIFY `rt_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returntransactionline`
--
ALTER TABLE `returntransactionline`
  MODIFY `rtl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salesreport`
--
ALTER TABLE `salesreport`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `t_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactionline`
--
ALTER TABLE `transactionline`
  MODIFY `tl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_category_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `creditduedate`
--
ALTER TABLE `creditduedate`
  ADD CONSTRAINT `fk_creditduedate_customer1` FOREIGN KEY (`customer_c_no`) REFERENCES `customer` (`c_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_creditduedate_transaction1` FOREIGN KEY (`transaction_t_no`) REFERENCES `transaction` (`t_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `creditduedateline`
--
ALTER TABLE `creditduedateline`
  ADD CONSTRAINT `fk_creditduedateline_creditduedate1` FOREIGN KEY (`creditduedate_cdd_no`) REFERENCES `creditduedate` (`cdd_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_creditduedateline_customerpayment1` FOREIGN KEY (`customerpayment_cp_no`) REFERENCES `customerpayment` (`cp_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `creditloanline`
--
ALTER TABLE `creditloanline`
  ADD CONSTRAINT `fk_creditloanline_credit_loan1` FOREIGN KEY (`credit_loan_cl_no`) REFERENCES `credit_loan` (`cl_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transactionline_product10` FOREIGN KEY (`product_p_no`) REFERENCES `product` (`p_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transactionline_user10` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `credit_loan`
--
ALTER TABLE `credit_loan`
  ADD CONSTRAINT `fk_credit_loan_customer1` FOREIGN KEY (`customer_c_no`) REFERENCES `customer` (`c_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_credit_loan_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_credit_loan_user2` FOREIGN KEY (`agent_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `credit_loan_payment`
--
ALTER TABLE `credit_loan_payment`
  ADD CONSTRAINT `fk_credit_loan_payment_credit_loan1` FOREIGN KEY (`credit_loan_cl_no`) REFERENCES `credit_loan` (`cl_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_credit_loan_payment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_customer_category1` FOREIGN KEY (`customer_category_cc_no`) REFERENCES `customer_category` (`cc_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customerbalance_history`
--
ALTER TABLE `customerbalance_history`
  ADD CONSTRAINT `fk_customerbalance_history_customer1` FOREIGN KEY (`customer_c_no`) REFERENCES `customer` (`c_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customerbalance_history_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customerpayment`
--
ALTER TABLE `customerpayment`
  ADD CONSTRAINT `fk_customerpayment_customer1` FOREIGN KEY (`customer_c_no`) REFERENCES `customer` (`c_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customerpayment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customerpaymentline`
--
ALTER TABLE `customerpaymentline`
  ADD CONSTRAINT `fk_customerpaymentline_customerpayment1` FOREIGN KEY (`customerpayment_cp_no`) REFERENCES `customerpayment` (`cp_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customerpaymentline_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customersales_history`
--
ALTER TABLE `customersales_history`
  ADD CONSTRAINT `fk_customer_history_customer1` FOREIGN KEY (`customer_c_no`) REFERENCES `customer` (`c_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_history_transaction1` FOREIGN KEY (`transaction_t_no`) REFERENCES `transaction` (`t_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_history_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customer_category`
--
ALTER TABLE `customer_category`
  ADD CONSTRAINT `fk_customer_category_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `fk_delivery_supplier1` FOREIGN KEY (`supplier_s_no`) REFERENCES `supplier` (`s_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_delivery_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `deliveryline`
--
ALTER TABLE `deliveryline`
  ADD CONSTRAINT `fk_deliveryline_delivery1` FOREIGN KEY (`delivery_d_no`) REFERENCES `delivery` (`d_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_deliveryline_product1` FOREIGN KEY (`product_p_no`) REFERENCES `product` (`p_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `fk_deposit_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `fk_expenses_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `fk_delivery_user10` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inventoryline`
--
ALTER TABLE `inventoryline`
  ADD CONSTRAINT `fk_deliveryline_product10` FOREIGN KEY (`product_p_no`) REFERENCES `product` (`p_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inventoryline_inventory1` FOREIGN KEY (`inventory_i_no`) REFERENCES `inventory` (`i_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inventoryline_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_c_no`) REFERENCES `category` (`c_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_supplier1` FOREIGN KEY (`supplier_s_no`) REFERENCES `supplier` (`s_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_history`
--
ALTER TABLE `product_history`
  ADD CONSTRAINT `fk_product_history_product1` FOREIGN KEY (`product_p_no`) REFERENCES `product` (`p_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_history_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `repayment`
--
ALTER TABLE `repayment`
  ADD CONSTRAINT `fk_repayment_credit_loan1` FOREIGN KEY (`credit_loan_cl_no`) REFERENCES `credit_loan` (`cl_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_repayment_customer1` FOREIGN KEY (`customer_c_no`) REFERENCES `customer` (`c_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_repayment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `returnstock`
--
ALTER TABLE `returnstock`
  ADD CONSTRAINT `fk_returnstock_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `returnstockline`
--
ALTER TABLE `returnstockline`
  ADD CONSTRAINT `fk_returnstockline_product1` FOREIGN KEY (`product_p_no`) REFERENCES `product` (`p_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_returnstockline_returnstock1` FOREIGN KEY (`returnstock_rs_no`) REFERENCES `returnstock` (`rs_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `returntransaction`
--
ALTER TABLE `returntransaction`
  ADD CONSTRAINT `fk_returntransaction_creditduedate1` FOREIGN KEY (`creditduedate_cdd_no`) REFERENCES `creditduedate` (`cdd_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_returntransaction_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `returntransactionline`
--
ALTER TABLE `returntransactionline`
  ADD CONSTRAINT `fk_returntransactionline_product1` FOREIGN KEY (`product_p_no`) REFERENCES `product` (`p_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_returntransactionline_returntransaction1` FOREIGN KEY (`returntransaction_rt_no`) REFERENCES `returntransaction` (`rt_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_returntransactionline_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `salesreport`
--
ALTER TABLE `salesreport`
  ADD CONSTRAINT `fk_salesreport_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `fk_supplier_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `fk_task_user1` FOREIGN KEY (`assign_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_user2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `task_result`
--
ALTER TABLE `task_result`
  ADD CONSTRAINT `fk_task_result_task1` FOREIGN KEY (`task_no`) REFERENCES `task` (`task_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_result_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_transaction_customer1` FOREIGN KEY (`customer_c_no`) REFERENCES `customer` (`c_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaction_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transactionline`
--
ALTER TABLE `transactionline`
  ADD CONSTRAINT `fk_transactionline_product1` FOREIGN KEY (`product_p_no`) REFERENCES `product` (`p_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transactionline_transaction1` FOREIGN KEY (`transaction_t_no`) REFERENCES `transaction` (`t_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transactionline_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
