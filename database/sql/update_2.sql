
INSERT INTO db_version
(db_id,name,descr)
VALUES
(2,'database version 0.1','static table.. countries table for drop down')
;


ALTER TABLE `mission`
ADD `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
ADD `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP AFTER `created_at`;

CREATE TABLE `countries` (
  `countries_id` int(11) NOT NULL,
  `iso_2` varchar(2) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` varchar(255) NOT NULL,
  `iso_3` varchar(3) NOT NULL,
  `dotw_nationality` varchar(10) NOT NULL,
  `country_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`countries_id`, `iso_2`, `name`, `phonecode`, `iso_3`, `dotw_nationality`, `country_status`) VALUES
(1, 'AF', 'Afghanistan', '93', 'AFG', '26', 1),
(2, 'AL', 'Albania', '355', 'ALB', '90', 1),
(3, 'DZ', 'Algeria', '213', 'DZA', '187', 1),
(4, 'AS', 'American Samoa', '1684', 'ASM', '34', 1),
(5, 'AD', 'Andorra', '376', 'AND', '55', 1),
(6, 'AO', 'Angola', '244', 'AGO', '200', 1),
(7, 'AI', 'Anguilla', '1264', 'AIA', '151', 1),
(8, 'AQ', 'Antarctica', '0', 'ATA', '295', 1),
(9, 'AG', 'Antigua And Barbuda', '1268', 'ATG', '137', 1),
(10, 'AR', 'Argentina', '54', 'ARG', '107', 1),
(11, 'AM', 'Armenia', '374', 'ARM', '153', 1),
(12, 'AW', 'Aruba', '297', 'ABW', '138', 1),
(13, 'AU', 'Australia', '61', 'AUS', '28', 1),
(14, 'AT', 'Austria', '43', 'AUT', '56', 1),
(15, 'AZ', 'Azerbaijan', '994', 'AZE', '154', 1),
(16, 'BS', 'Bahamas The', '1242', 'BHS', '108', 1),
(17, 'BH', 'Bahrain', '973', 'BHR', '1', 1),
(18, 'BD', 'Bangladesh', '880', 'BGD', '19', 1),
(19, 'BB', 'Barbados', '1246', 'BRB', '139', 1),
(20, 'BY', 'Belarus', '375', 'BLR', '57', 1),
(21, 'BE', 'Belgium', '32', 'BEL', '58', 1),
(22, 'BZ', 'Belize', '501', 'BLZ', '136', 1),
(23, 'BJ', 'Benin', '229', 'BEN', '201', 1),
(24, 'BM', 'Bermuda', '1441', 'BMU', '103', 1),
(25, 'BT', 'Bhutan', '975', 'BTN', '27', 1),
(26, 'BO', 'Bolivia', '591', 'BOL', '124', 1),
(27, 'BA', 'Bosnia and Herzegovina', '387', 'BIH', '59', 1),
(28, 'BW', 'Botswana', '267', 'BWA', '202', 1),
(29, 'BV', 'Bouvet Island', '0', 'BVT', '315', 1),
(30, 'BR', 'Brazil', '55', 'BRA', '109', 1),
(31, 'IO', 'British Indian Ocean Territory', '246', 'IOT', '181', 1),
(32, 'BN', 'Brunei', '673', 'BRN', '166', 1),
(33, 'BG', 'Bulgaria', '359', 'BGR', '60', 1),
(34, 'BF', 'Burkina Faso', '226', 'BFA', '203', 1),
(35, 'BI', 'Burundi', '257', 'BDI', '204', 1),
(36, 'KH', 'Cambodia', '855', 'KHM', '167', 1),
(37, 'CM', 'Cameroon', '237', 'CMR', '206', 1),
(38, 'CA', 'Canada', '1', 'CAN', '100', 1),
(39, 'CV', 'Cape Verde', '238', 'CPV', '205', 1),
(40, 'KY', 'Cayman Islands', '1345', 'CYM', '149', 1),
(41, 'CF', 'Central African Republic', '236', 'CAF', '207', 1),
(42, 'TD', 'Chad', '235', 'TCD', '208', 1),
(43, 'CL', 'Chile', '56', 'CHL', '110', 1),
(44, 'CN', 'China', '86', 'CHN', '168', 1),
(45, 'CX', 'Christmas Island', '61', 'CXR', '52', 1),
(46, 'CC', 'Cocos (Keeling) Islands', '672', 'CCK', '53', 1),
(47, 'CO', 'Colombia', '57', 'COL', '111', 1),
(48, 'KM', 'Comoros', '269', 'COM', '211', 1),
(49, 'CG', 'Republic Of The Congo', '242', 'COG', '210', 1),
(50, 'CD', 'Democratic Republic Of The Congo', '242', 'COD', '209', 1),
(51, 'CK', 'Cook Islands', '682', 'COK', '35', 1),
(52, 'CR', 'Costa Rica', '506', 'CRI', '125', 1),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', '225', '', '212', 1),
(54, 'HR', 'Croatia (Hrvatska)', '385', 'HRV', '61', 1),
(55, 'CU', 'Cuba', '53', 'CUB', '112', 1),
(56, 'CY', 'Cyprus', '357', 'CYP', '62', 1),
(57, 'CZ', 'Czech Republic', '420', 'CZE', '63', 1),
(58, 'DK', 'Denmark', '45', 'DNK', '64', 1),
(59, 'DJ', 'Djibouti', '253', 'DJI', '213', 1),
(60, 'DM', 'Dominica', '1767', 'DMA', '142', 1),
(61, 'DO', 'Dominican Republic', '1809', 'DOM', '143', 1),
(62, 'TP', 'East Timor', '670', 'TPE', '', 1),
(63, 'EC', 'Ecuador', '593', 'ECU', '114', 1),
(64, 'EG', 'Egypt', '20', 'EGY', '7', 1),
(65, 'SV', 'El Salvador', '503', 'SLV', '126', 1),
(66, 'GQ', 'Equatorial Guinea', '240', 'GNQ', '215', 1),
(67, 'ER', 'Eritrea', '291', 'ERI', '214', 1),
(68, 'EE', 'Estonia', '372', 'EST', '155', 1),
(69, 'ET', 'Ethiopia', '251', 'ETH', '198', 1),
(70, 'XA', 'External Territories of Australia', '61', '', '', 1),
(71, 'FK', 'Falkland Islands', '500', 'FLK', '150', 1),
(72, 'FO', 'Faroe Islands', '298', 'FRO', '96', 1),
(73, 'FJ', 'Fiji Islands', '679', 'FJI', '29', 1),
(74, 'FI', 'Finland', '358', 'FIN', '65', 1),
(75, 'FR', 'France', '33', 'FRA', '66', 1),
(76, 'GF', 'French Guiana', '594', 'GUF', '134', 1),
(77, 'PF', 'French Polynesia', '689', 'PYF', '30', 1),
(78, 'TF', 'French Southern Territories', '0', 'TEI', '182', 1),
(79, 'GA', 'Gabon', '241', 'GAB', '216', 1),
(80, 'GM', 'Gambia The', '220', 'GMB', '217', 1),
(81, 'GE', 'Georgia', '995', 'GEO', '156', 1),
(82, 'DE', 'Germany', '49', 'DEU', '67', 1),
(83, 'GH', 'Ghana', '233', 'GHA', '218', 1),
(84, 'GI', 'Gibraltar', '350', 'GIB', '68', 1),
(85, 'GR', 'Greece', '30', 'GRC', '69', 1),
(86, 'GL', 'Greenland', '299', 'GRL', '105', 1),
(87, 'GD', 'Grenada', '1473', 'GRD', '141', 1),
(88, 'GP', 'Guadeloupe', '590', 'GLP', '135', 1),
(89, 'GU', 'Guam', '1671', 'GUM', '46', 1),
(90, 'GT', 'Guatemala', '502', 'GTM', '127', 1),
(91, 'XU', 'Guernsey and Alderney', '44', '', '', 1),
(92, 'GN', 'Guinea', '224', 'GIN', '219', 1),
(93, 'GW', 'Guinea-Bissau', '245', 'GNB', '220', 1),
(94, 'GY', 'Guyana', '592', 'GUY', '145', 1),
(95, 'HT', 'Haiti', '509', 'HTI', '130', 1),
(96, 'HM', 'Heard and McDonald Islands', '0', 'HMD', '345', 1),
(97, 'HN', 'Honduras', '504', 'HND', '115', 1),
(98, 'HK', 'Hong Kong S.A.R.', '852', 'HKG', '169', 1),
(99, 'HU', 'Hungary', '36', 'HUN', '70', 1),
(100, 'IS', 'Iceland', '354', 'ISL', '89', 1),
(101, 'IN', 'India', '91', 'IND', '20', 1),
(102, 'ID', 'Indonesia', '62', 'IDN', '170', 1),
(103, 'IR', 'Iran', '98', 'IRN', '8', 1),
(104, 'IQ', 'Iraq', '964', 'IRQ', '16', 1),
(105, 'IE', 'Ireland', '353', 'IRL', '71', 1),
(106, 'IL', 'Israel', '972', 'ISR', '17', 1),
(107, 'IT', 'Italy', '39', 'ITA', '72', 1),
(108, 'JM', 'Jamaica', '1876', 'JAM', '116', 1),
(109, 'JP', 'Japan', '81', 'JPN', '171', 1),
(110, 'XJ', 'Jersey', '44', '', '', 1),
(111, 'JO', 'Jordan', '962', 'JOR', '9', 1),
(112, 'KZ', 'Kazakhstan', '7', 'KAZ', '157', 1),
(113, 'KE', 'Kenya', '254', 'KEN', '188', 1),
(114, 'KI', 'Kiribati', '686', 'KIR', '36', 1),
(115, 'KP', 'Korea North', '850', '', '183', 1),
(116, 'KR', 'Korea South', '82', 'KOR', '176', 1),
(117, 'KW', 'Kuwait', '965', 'KWT', '2', 1),
(118, 'KG', 'Kyrgyzstan', '996', 'KGZ', '158', 1),
(119, 'LA', 'Laos', '856', '', '172', 1),
(120, 'LV', 'Latvia', '371', 'LVA', '73', 1),
(121, 'LB', 'Lebanon', '961', 'LBN', '10', 1),
(122, 'LS', 'Lesotho', '266', 'LSO', '189', 1),
(123, 'LR', 'Liberia', '231', 'LBR', '221', 1),
(124, 'LY', 'Libya', '218', 'LBY', '190', 1),
(125, 'LI', 'Liechtenstein', '423', 'LIE', '92', 1),
(126, 'LT', 'Lithuania', '370', 'LTU', '74', 1),
(127, 'LU', 'Luxembourg', '352', 'LUX', '75', 1),
(128, 'MO', 'Macau S.A.R.', '853', 'MAC', '185', 1),
(129, 'MK', 'Macedonia', '389', 'MKD', '91', 1),
(130, 'MG', 'Madagascar', '261', 'MDG', '199', 1),
(131, 'MW', 'Malawi', '265', 'MWI', '222', 1),
(132, 'MY', 'Malaysia', '60', 'MYS', '173', 1),
(133, 'MV', 'Maldives', '960', 'MDV', '21', 1),
(134, 'ML', 'Mali', '223', 'MLI', '223', 1),
(135, 'MT', 'Malta', '356', 'MLT', '76', 1),
(136, 'XM', 'Man (Isle of)', '44', '', '', 1),
(137, 'MH', 'Marshall Islands', '692', 'MHL', '37', 1),
(138, 'MQ', 'Martinique', '596', 'MTQ', '131', 1),
(139, 'MR', 'Mauritania', '222', 'MRT', '224', 1),
(140, 'MU', 'Mauritius', '230', 'MUS', '191', 1),
(141, 'YT', 'Mayotte', '269', 'MYT', '225', 1),
(142, 'MX', 'Mexico', '52', 'MEX', '117', 1),
(143, 'FM', 'Micronesia', '691', 'FSM', '38', 1),
(144, 'MD', 'Moldova', '373', 'MDA', '159', 1),
(145, 'MC', 'Monaco', '377', 'MCO', '97', 1),
(146, 'MN', 'Mongolia', '976', 'MNG', '184', 1),
(147, 'MS', 'Montserrat', '1664', 'MSR', '152', 1),
(148, 'MA', 'Morocco', '212', 'MAR', '11', 1),
(149, 'MZ', 'Mozambique', '258', 'MOZ', '226', 1),
(150, 'MM', 'Myanmar', '95', 'MMR', '22', 1),
(151, 'NA', 'Namibia', '264', 'NAM', '227', 1),
(152, 'NR', 'Nauru', '674', 'NRU', '39', 1),
(153, 'NP', 'Nepal', '977', 'NPL', '23', 1),
(154, 'AN', 'Netherlands Antilles', '599', 'ANT', '255', 1),
(155, 'NL', 'Netherlands The', '31', 'NLD', '77', 1),
(156, 'NC', 'New Caledonia', '687', 'NCL', '40', 1),
(157, 'NZ', 'New Zealand', '64', 'NZL', '31', 1),
(158, 'NI', 'Nicaragua', '505', 'NIC', '128', 1),
(159, 'NE', 'Niger', '227', 'NER', '228', 1),
(160, 'NG', 'Nigeria', '234', 'NGA', '192', 1),
(161, 'NU', 'Niue', '683', 'NIU', '41', 1),
(162, 'NF', 'Norfolk Island', '672', 'NFK', '42', 1),
(163, 'MP', 'Northern Mariana Islands', '1670', 'MNP', '43', 1),
(164, 'NO', 'Norway', '47', 'NOR', '78', 1),
(165, 'OM', 'Oman', '968', 'OMN', '5', 1),
(166, 'PK', 'Pakistan', '92', 'PAK', '24', 1),
(167, 'PW', 'Palau', '680', 'PLW', '180', 1),
(168, 'PS', 'Palestinian Territory Occupied', '970', 'PSE', '18', 1),
(169, 'PA', 'Panama', '507', 'PAN', '129', 1),
(170, 'PG', 'Papua new Guinea', '675', 'PNG', '44', 1),
(171, 'PY', 'Paraguay', '595', 'PRY', '118', 1),
(172, 'PE', 'Peru', '51', 'PER', '119', 1),
(173, 'PH', 'Philippines', '63', 'PHL', '174', 1),
(174, 'PN', 'Pitcairn Island', '0', 'PCN', '45', 1),
(175, 'PL', 'Poland', '48', 'POL', '79', 1),
(176, 'PT', 'Portugal', '351', 'PRT', '80', 1),
(177, 'PR', 'Puerto Rico', '1787', 'PRI', '133', 1),
(178, 'QA', 'Qatar', '974', 'QAT', '3', 1),
(179, 'RE', 'Reunion', '262', 'REU', '238', 1),
(180, 'RO', 'Romania', '40', 'ROU', '81', 1),
(181, 'RU', 'Russia', '70', 'RUS', '160', 1),
(182, 'RW', 'Rwanda', '250', 'RWA', '229', 1),
(183, 'SH', 'Saint Helena', '290', 'SHN', '239', 1),
(184, 'KN', 'Saint Kitts And Nevis', '1869', 'KNA', '144', 1),
(185, 'LC', 'Saint Lucia', '1758', 'LCA', '120', 1),
(186, 'PM', 'Saint Pierre and Miquelon', '508', 'SPM', '104', 1),
(187, 'VC', 'Saint Vincent And The Grenadines', '1784', 'VCT', '147', 1),
(188, 'WS', 'Samoa', '684', 'WSM', '54', 1),
(189, 'SM', 'San Marino', '378', 'SMR', '95', 1),
(190, 'ST', 'Sao Tome and Principe', '239', 'STP', '230', 1),
(191, 'SA', 'Saudi Arabia', '966', 'SAU', '4', 1),
(192, 'SN', 'Senegal', '221', 'SEN', '231', 1),
(193, 'RS', 'Serbia', '381', 'SRB', '98', 1),
(194, 'SC', 'Seychelles', '248', 'SYC', '193', 1),
(195, 'SL', 'Sierra Leone', '232', 'SLE', '232', 1),
(196, 'SG', 'Singapore', '65', 'SGP', '175', 1),
(197, 'SK', 'Slovakia', '421', 'SVK', '82', 1),
(198, 'SI', 'Slovenia', '386', 'SVN', '83', 1),
(199, 'XG', 'Smaller Territories of the UK', '44', '', '', 1),
(200, 'SB', 'Solomon Islands', '677', 'SLB', '32', 1),
(201, 'SO', 'Somalia', '252', 'SOM', '233', 1),
(202, 'ZA', 'South Africa', '27', 'ZAF', '194', 1),
(203, 'GS', 'South Georgia', '0', 'SGS', '405', 1),
(204, 'SS', 'South Sudan', '211', '', '415', 1),
(205, 'ES', 'Spain', '34', 'ESP', '84', 1),
(206, 'LK', 'Sri Lanka', '94', 'LKA', '25', 1),
(207, 'SD', 'Sudan', '249', 'SDN', '12', 1),
(208, 'SR', 'Suriname', '597', 'SUR', '146', 1),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', '47', 'SJM', '93', 1),
(210, 'SZ', 'Swaziland', '268', 'SWZ', '234', 1),
(211, 'SE', 'Sweden', '46', 'SWE', '85', 1),
(212, 'CH', 'Switzerland', '41', 'CHE', '86', 1),
(213, 'SY', 'Syria', '963', 'SYR', '13', 1),
(214, 'TW', 'Taiwan', '886', 'TWN', '177', 1),
(215, 'TJ', 'Tajikistan', '992', 'TJK', '161', 1),
(216, 'TZ', 'Tanzania', '255', 'TZA', '195', 1),
(217, 'TH', 'Thailand', '66', 'THA', '178', 1),
(218, 'TG', 'Togo', '228', 'TGO', '235', 1),
(219, 'TK', 'Tokelau', '690', 'TKL', '47', 1),
(220, 'TO', 'Tonga', '676', 'TON', '48', 1),
(221, 'TT', 'Trinidad And Tobago', '1868', 'TTO', '140', 1),
(222, 'TN', 'Tunisia', '216', 'TUN', '14', 1),
(223, 'TR', 'Turkey', '90', 'TUR', '87', 1),
(224, 'TM', 'Turkmenistan', '7370', 'TKM', '162', 1),
(225, 'TC', 'Turks And Caicos Islands', '1649', 'TCA', '121', 1),
(226, 'TV', 'Tuvalu', '688', 'TUV', '49', 1),
(227, 'UG', 'Uganda', '256', 'UGA', '236', 1),
(228, 'UA', 'Ukraine', '380', 'UKR', '163', 1),
(229, 'AE', 'United Arab Emirates', '971', 'ARE', '6', 1),
(230, 'GB', 'United Kingdom', '44', 'GBR', '88', 1),
(231, 'US', 'United States', '1', 'USA', '102', 1),
(232, 'UM', 'United States Minor Outlying Islands', '1', 'UMI', '425', 1),
(233, 'UY', 'Uruguay', '598', 'URY', '122', 1),
(234, 'UZ', 'Uzbekistan', '998', 'UZB', '164', 1),
(235, 'VU', 'Vanuatu', '678', 'VUT', '50', 1),
(236, 'VA', 'Vatican City State (Holy See)', '39', 'VAT', '94', 1),
(237, 'VE', 'Venezuela', '58', 'VEN', '123', 1),
(238, 'VN', 'Vietnam', '84', 'VNM', '179', 1),
(239, 'VG', 'Virgin Islands (British)', '1284', '', '148', 1),
(240, 'VI', 'Virgin Islands (US)', '1340', 'VIR', '132', 1),
(241, 'WF', 'Wallis And Futuna Islands', '681', 'WLF', '51', 1),
(242, 'EH', 'Western Sahara', '212', 'ESH', '237', 1),
(243, 'YE', 'Yemen', '967', 'YEM', '15', 1),
(244, 'YU', 'Yugoslavia', '38', 'YUG', '', 1),
(245, 'ZM', 'Zambia', '260', 'ZMB', '196', 1),
(246, 'ZW', 'Zimbabwe', '263', 'ZWE', '197', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countries_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `countries_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
  

  
  


