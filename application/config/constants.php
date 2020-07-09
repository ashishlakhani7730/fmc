<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



$fmc_language = (isset($_COOKIE["fmc_language"])) ? $_COOKIE["fmc_language"] :"english";

if($fmc_language == "english"){
	
	//Sidebar profile /sidebar.php
	define('SIDEBAR_PROFILE_TITLE', 'Welcome');
		//Sidebar profile popup menu /sidebar.php
		define('SIDEBAR_MY_PROFILE', 'My Profile');
		define('SIDEBAR_MESSAGES', 'Messages');
		define('SIDEBAR_POPUP_SETTINGS', 'Settings');
		define('SIDEBAR_LOGOUT', 'Logout');
		//End Sidebar profile popup menu /sidebar.php

	define('SIDEBAR_DASHBOARD', 'Dashboard');
	define('SIDEBAR_CLIENT_LOGIN', 'Client Login');
	define('SIDEBAR_CLIENT_LOGOUT', 'Client Logout');
	define('SIDEBAR_DEPARTMENTS', 'Departments');
	define('SIDEBAR_DIVISION', 'Division');
	define('SIDEBAR_FMC_USERS', 'FMC Users');
	define('SIDEBAR_CLIENTS', 'Clients');
	define('SIDEBAR_SETTINGS', 'Settings');
	define('SIDEBAR_DOCUMENT_CATEGORY', 'Document Category');
	define('SIDEBAR_COMPANY_STRUCTURE_TYPE', 'Company Structure Type');
	define('SIDEBAR_LEGAL_ENTITIES', 'Legal Entities');
	define('SIDEBAR_COUNTRIES', 'Countries');
	define('SIDEBAR_REGIONS', 'Regions');
	define('SIDEBAR_CITY', 'City');
	define('SIDEBAR_MAIN_ACTIVITIES', 'Main Activities');
	define('SIDEBAR_FMC_SALARY_COMPONENT', 'Salary Components');
	define('SIDEBAR_FMC_LEAVE_MANAGEMENT', 'Leave Management');
	define('SIDEBAR_CLIENT_REQUIRED_DOCUMENTS', 'Client Required Documents');
	define('SIDEBAR_MEDICAL_CATEGORIES', 'Medical Categories');
	define('SIDEBAR_WARNING_CATEGORY', 'Warning Category');

	//common delete msg
	define('R_U_SURE', 'Are you sure ?');
	define('RECOVER_RECORD', 'You will not be able to recover this record!');
	define('YES', 'Yes, delete it!');

	//company_sidebar  // company_sidebar.php
	define('COMPANY_SIDEBAR_DASHBOARD', 'HR Dashboard');
	define('COMPANY_SIDEBAR_COMP_ADMIN_SETTINGS', 'Company Admin Settings');
	define('COMPANY_SIDEBAR_SALARY_COMPONENTS', 'Salary Components');
	define('COMPANY_SIDEBAR_LEAVE_MANAGEMENT', 'Leave Management');
	define('COMPANY_SIDEBAR_COMPANY_STRUCTURE', 'Company Organisation Chart');
	define('COMPANY_SIDEBAR_COMPANY_DEPARTMENT', 'Company Departments');
	define('COMPANY_SIDEBAR_COMPANY_DESIGNATION', 'Position Titles');
	define('COMPANY_SIDEBAR_COMPANY_REQUEST_TYPE', 'Request Types');
	define('COMPANY_SIDEBAR_COMPANY_EMPLOYEE', 'Employees');
	define('COMPANY_SIDEBAR_COMPANY_PAYROLL', 'Payroll');
	define('COMPANY_SIDEBAR_COMPANY_GENERATE_PAYROLL', 'Generate Payroll');
	define('COMPANY_SIDEBAR_RECRUITMENT', 'Recruitment');
	define('COMPANY_SIDEBAR_JOB_POSITIONS', 'Job Positions');
	define('COMPANY_SIDEBAR_JOB_OPENINGS', 'Job Openings');
	define('COMPANY_SIDEBAR_ATTENDANCE', 'Attendance');
	define('COMPANY_SIDEBAR_MANAGE_ATTENDANCE', 'Manage Attendance');
	define('COMPANY_SIDEBAR_ASSETS', 'Assets');
	define('COMPANY_SIDEBAR_WARNING', 'Warning');
	define('COMPANY_SIDEBAR_COMPANY_DOCUMENTS', 'Company Documents');
	
	//Navbar  /navbar.php
	define('NAVBAR_START_CLIENT_LOGIN', 'Start Client Login');
	define('NAVBAR_QUICK_ACCESS', 'Quick Access');
		//Navbar Popup menu /navbar.php
		define('NAVBAR_CREATE_NEW_CLIENT', 'Create New Client');
		define('NAVBAR_CREATE_STAFF', 'Create Staff');
		define('NAVBAR_VIEW_PAYROLL', 'View Payroll');
		define('NAVBAR_LEAVE_MANAGEMENT', 'Leave Management');	
		define('NAVBAR_DASHBOARD', 'Dashboard');
		//End Navbar Popup menu /navbar.php

	define('NAVBAR_CALENDAR', 'Calendar');
	define('NAVBAR_NORTIFICATION', 'Notification');
	define('NAVBAR_LOGOUT', 'Logout');
	define('NAVBAR_LANGUAGE', 'Language');
	define('NAVBAR_SUPPORT', 'Support');

	//COMPANY_navbar  // company_navbar.php
	define('COMPANY_NAVBAR_START_CLIENT_LOGIN', 'Start Client Login');
	define('COMPANY_NAVBAR_QUICK_ACCESS', 'Quick Access');
	define('COMPANY_NAVBAR_CREATE_NEW_CLIENT', 'Create New Client');
	define('COMPANY_NAVBAR_CREATE_STAFF', 'Create Staff');
	define('COMPANY_NAVBAR_VIEW_PAYROLL', 'View Payroll');
	define('COMPANY_NAVBAR_LEAVE_MANAGEMENT', 'Leave Management');
	define('COMPANY_NAVBAR_DASHBOARD', 'Dashboard');
	define('COMPANY_NAVBAR_CALENDAR', 'Calendar');
	define('COMPANY_NAVBAR_NORTIFICATION', 'Notification');
	define('COMPANY_NAVBAR_NORTIFICATION_DETAIL', 'You have 4 new Notifications');
	define('COMPANY_NAVBAR_CAMPAIGN', 'Campaign');
	define('COMPANY_NAVBAR_HOLIDAY', 'Holiday Sale');
	define('COMPANY_NAVBAR_IS_NEARLY', 'is nearly reach budget limit.');
	define('COMPANY_NAVBAR_TODAY', '10:00 AM Today');
	define('COMPANY_NAVBAR_YOUR_NEW_CAMPAIGN', 'Your New Campaign');
	define('COMPANY_NAVBAR_HOLIDAY_SALE', 'Holiday Sale');
	define('COMPANY_NAVBAR_IS_APPROVED', 'is approved.');
	define('COMPANY_NAVBAR_TIME', '11:30 AM Today');
	define('COMPANY_NAVBAR_WEB', 'Website visits from Twitter is 27% higher than last week.');
	define('COMPANY_NAVBAR_PM', '04:00 PM Today.');
	define('COMPANY_NAVBAR_ERROR', 'Error on website analytics configurations');
	define('COMPANY_NAVBAR_YESTERDAY', 'Yesterday');
	define('COMPANY_NAVBAR_SEE_ALL', 'See all notifications');
	define('COMPANY_NAVBAR_LOGOUT', 'Logout');
	define('COMPANY_NAVBAR_SUPPORT', 'Support');
	 
	//company dashboard //company_dashboard.php
	define('COMPANY_DASHBOARD_TITLE', 'Dashboard');
	define('COMPANY_PENDING_REQUEST', 'Pending Request');	 

	//salary component //salary_component.php
	define('SALARY_COMPONENT', 'Salary Components');
	define('SALARY_COMPONENT_LIST', 'Salary Components list');
	define('SALARY_COMPONENT_ADD', 'Add Salary Component');
	define('SALARY_COMPONENT_NAME', 'Name');
	define('SALARY_COMPONENT_TYPE', 'Component Type');
	define('SALARY_COMPONENT_CALCULATION', 'Calculation Type');
	define('SALARY_COMPONENT_VALUE', 'Value');
	define('SALARY_COMPONENT_CREATE', 'Create Salary Component');
	define('SALARY_COMPONENT_EARNING', 'Earning');
	define('SALARY_COMPONENT_DEDUCTION', 'Deduction');
	define('SALARY_COMPONENT_NAME_IN_PAYSLIP', 'Name in Payslip');
	define('SALARY_COMPONENT_FLATE_AMOUNT', 'Flat Amount');
	define('SALARY_COMPONENT_PERCENTAGE', 'Percentage of Basic');
	define('SALARY_COMPONENT_ENTER_AMMOUNT', 'Enter Amount');
	define('SALARY_COMPONENT_ENTER_PER', 'Enter Percentage');
	define('SALARY_COMPONENT_CANCEL', 'Cancel');
	define('SALARY_COMPONENT_UPDATE', 'Update Salary Component');
	define('SALARY_COMPONENT_SAVE_SALARY', 'Save Salary Component');
	
	//leave management //leave_management.php
	define('LEAVE_MANAGEMENT_TITLE', 'Leave Management');
	define('LEAVE_MANAGEMENT_TYPES', 'Leave Types');
	define('LEAVE_MANAGEMENT_GROUPS', 'Leave Groups');
	define('LEAVE_MANAGEMENT_HOLIDAYS', 'Holidays');
	define('LEAVE_MANAGEMENT_HOLIDAYS_GROUP', 'Holiday Group');
	define('LEAVE_MANAGEMENT_WORK_WEEK', 'Work Week');
	define('LEAVE_MANAGEMENT_WORK_SHIFT', 'Work Shift');
	define('LEAVE_MANAGEMENT_ADD_NEW', 'Add New Leave Type');
	define('LEAVE_MANAGEMENT_NAME', 'Name');
	define('LEAVE_MANAGEMENT_COLOR', 'Color');
	define('LEAVE_MANAGEMENT_ADD_NEW_L_GROUP', 'Add New Leave Group');
	define('LEAVE_MANAGEMENT_ADD_NEW_HOLIDAY', 'Add New Holiday');
	define('LEAVE_MANAGEMENT_DATE', 'Date*');
	define('LEAVE_MANAGEMENT_ADD_NEW_H_GROUP', 'Add New Holiday Group');
	define('LEAVE_MANAGEMENT_ADD_NEW_WORK_WEEK', 'Add New Work Week');
	define('LEAVE_MANAGEMENT_WORK_WEEK_NAME', 'Work Week Name*');
	define('LEAVE_MANAGEMENT_DAY', 'Days');
	define('LEAVE_MANAGEMENT_ADD_WORK_SHIFT', 'Add New Work Shift');
	define('LEAVE_MANAGEMENT_WORK_SHIFT_NAME', 'Work Shift Name');
	define('LEAVE_MANAGEMENT_START_TIME', 'Start-Time');
	define('LEAVE_MANAGEMENT_END_TIME', 'End-Time');
	define('LEAVE_MANAGEMENT_LEAVE_TYPE_TITLE', 'Leave type title*');
	define('LEAVE_MANAGEMENT_LEAVE_DAYS', 'Leave Days*');
	define('LEAVE_MANAGEMENT_LEAVE_COLORS', 'Leave Colors');
	define('LEAVE_MANAGEMENT_ADD', 'Add');
	define('LEAVE_MANAGEMENT_CLOSE', 'Close');
	define('LEAVE_MANAGEMENT_UPDATE_LEAVE_TYPE', 'Update Leave Type');
	define('LEAVE_MANAGEMENT_SAVE', 'Save');
	define('LEAVE_MANAGEMENT_UPDATE_LEAVE_GROUP', 'Update Leave Group');
	define('LEAVE_MANAGEMENT_HOLIDAY_TITLE', 'Holiday Title*');
	define('LEAVE_MANAGEMENT_DESCRIPTION', 'Description');
	define('LEAVE_MANAGEMENT_UPDATE_HOLIDAY', 'Update Holiday');
	define('LEAVE_MANAGEMENT_UPDATE_H_GROUP', 'Update Holiday Group');
	define('LEAVE_MANAGEMENT_HOLIDAY_G_TITLE', 'Holiday Group Title*');
	define('LEAVE_MANAGEMENT_MONDAY', 'Monday');
	define('LEAVE_MANAGEMENT_THURSDAY', 'Thursday');
	define('LEAVE_MANAGEMENT_SUNDAY', 'Sunday');
	define('LEAVE_MANAGEMENT_TUESDAY', 'Tuesday');
	define('LEAVE_MANAGEMENT_FRIDAY', 'Friday');
	define('LEAVE_MANAGEMENT_WEDNESDAY', 'Wednesday');
	define('LEAVE_MANAGEMENT_SATURDAY', 'Saturday');
	define('LEAVE_MANAGEMENT_UPDATE_WORK_WEEK', 'Update Work Week');
	define('LEAVE_MANAGEMENT_STARTTIME', 'Start-Time (12 hour)');
	define('LEAVE_MANAGEMENT_PLACEHOLDER', 'Ex: 11:59 pm');
	define('LEAVE_MANAGEMENT_ENDTIME', 'End-Time (12 hour)');
	define('LEAVE_MANAGEMENT_SIFT_NAME', 'Shift-Name*');
	define('LEAVE_MANAGEMENT_UPDATE_WORK_SHIFT', 'Update Work Shift');
	define('LEAVE_MANAGEMENT_LEAVE_G_TITLE', 'Leave Group Title*');

	//company structure //company_structure.php
	define('COMPANY_STRUCTURE', 'Company Organisation Chart');
	define('COMPANY_STRUCTURE_LIST', 'List');
	define('COMPANY_STRUCTURE_ADD', 'Add Company Organisation Chart');
	define('COMPANY_STRUCTURE_LIST_VIEW', 'Company Organisation Chart List View');	
	define('COMPANY_STRUCTURE_TREE_VIEW', 'Company Organisation Chart Tree View');
	define('COMPANY_STRUCTURE_DESIGNATION_NAME', 'Designation Name');	
	define('COMPANY_STRUCTURE_PARENT', 'Parent');	
	define('COMPANY_STRUCTURE_CREATE', 'Create Company Organisation Chart');	
	define('COMPANY_STRUCTURE_TYPE', 'Type');	
	define('COMPANY_STRUCTURE_SELECT_TYPE', 'Select Type');	
	define('COMPANY_STRUCTURE_SELECT_PARENT', 'Select Parent');	
	define('COMPANY_STRUCTURE_DETAILS', 'Details');
	define('COMPANY_STRUCTURE_CANCEL', 'Cancel');
	define('COMPANY_STRUCTURE_UPDATES', 'Update Company Organisation Chart');
	define('COMPANY_STRUCTURE_SAVE', 'Save Company Organisation Chart');

	//company department //company_department.php
	define('COMPANY_DEPARTMENT_TITLE', 'Departments');
	define('COMPANY_DEPARTMENT_ADD_DEPARTMENT', 'Add Department');
	define('COMPANY_DEPARTMENT_NAME', 'Department Name');
	define('COMPANY_DEPARTMENT_PLSH_NAME', 'Department Name*');
	define('COMPANY_DEPARTMENT_ADD', 'Add');
	define('COMPANY_DEPARTMENT_CLOSE', 'CLOSE');
	define('COMPANY_DEPARTMENT_UPDATE', 'Update Department');
	define('COMPANY_DEPARTMENT_SAVE', 'Save');

	//designation //designation.php
	define('DESIGNATION_TITLE', 'Position Titles');
	define('DESIGNATION_LIST', 'List');
	define('DESIGNATION_ADD', 'Add Position Title');
	define('DESIGNATION_LIST_VIEW', 'Position Titles List View');
	define('DESIGNATION_TREE_VIEW', 'Position Titles Tree View');
	define('DESIGNATION_NAME', 'Position Title Name');
	define('DESIGNATION_PARENT', 'Parent');
	define('DESIGNATION_UPDATE', 'Update Position Title');
	define('DESIGNATION_DETAILS', 'Details');
	define('DESIGNATION_SELECT_PARENT', 'Select Parent');
	define('DESIGNATION_SAVE', 'Save Position Title');
	define('DESIGNATION_CANCEL', 'Cancel');
	define('DESIGNATION_CREATE', 'Create Position Title');
	
	//request type //request_type.php
	define('REQUEST_TYPE_TITLE', 'Request Types');
	define('REQUEST_TYPE_LIST', 'Request Type List');
	define('REQUEST_TYPE_ADD', 'Add Request Type');
	define('REQUEST_TYPE_NAME', 'Request Name');
	define('REQUEST_TYPE_PARENT', 'Parent');
	define('REQUEST_TYPE_CREATE', 'Create Request Type');
	define('REQUEST_TYPE_DESCRIPTION', 'Description');
	define('REQUEST_TYPE_SELECT_PARENT', 'Select Parent');
	define('REQUEST_TYPE__CANCEL', 'Cancel');
	define('REQUEST_TYPE_UPDATE', 'Update Request Type');
	define('REQUEST_TYPE_SAVE_REQUEST', 'Save Request Type');

	//payroll //payroll.php
	define('PAYROLL_TITLE', 'Payroll');
	define('PAYROLL_LIST', 'List');
	define('PAYROLL_GENERATE_NEW', 'Generate New Payroll');
	define('PAYROLL_EMPLOYEE_NAME', 'Employee Name');
	define('PAYROLL_PAYROLL_DATE', 'Payroll Date');
	define('PAYROLL_FINAL_SALARY', 'Final-Salary');
	define('PAYROLL_STATUS', 'Status');
	define('PAYROLL_CREATE', 'Create');
	define('PAYROLL_SELECT_EMPLOYEE', 'Select Employee');
	define('PAYROLL_FROM_DATE', 'From date');
	define('PAYROLL_TO_DATE', 'To date');
	define('PAYROLL_DETAILS', 'Details');
	define('PAYROLL_GENERATE', 'Generate Payroll');
	define('PAYROLL_CANCEL', 'Cancel');
	define('PAYROLL_UPDATE', 'Update');
	define('PAYROLL_UPDATE_PAYROLL', 'Update Payroll');
	
	//company documents //company_documents.php
	define('COMPANY_DOCUMENTS_TITLE', 'Company Documents');
	define('COMPANY_DOCUMENTS_LIST', 'Company Documents list');
	define('COMPANY_NEW_DOCUMENTS', 'Add new Company Documents');
	define('COMPANY_SELECT_CATEGORY', 'Select Category');
	define('COMPANY_SELECT_ALL', 'All');
	define('COMPANY_SEARCH', 'Search');
	define('COMPANY_DOC_CAT_NAME', 'Document Category Name');
	define('COMPANY_TITLE', 'Title');
	define('COMPANY_DESCRIPTIONS', 'Descriptions');
	define('COMPANY_EXPIRYDATE', 'ExpiryDate');
	define('COMPANY_DOC_CAT', 'Document Categories');
	define('COMPANY_TITLE_PLSH', 'Title of the company Documents');
	define('COMPANY_DRAG_DROP', 'Drag & Drop files here');
	define('COMPANY_DOC_FILE', 'Document File');
	define('COMPANY_SIZE_FILE', 'size : 200 x 200 px');
	define('COMPANY_FILE_TYPE', '.PDF .DOC .DOCX .JPG .JPEG .PNG');
	define('COMPANY_BROWSE_FILE', 'Browse Files');
	define('COMPANY_DATE_OF_EXPIRY', 'Date of expiry');
	define('COMPANY_ADD', 'Add');
	define('COMPANY_CLOSE', 'Close');
	define('COMPANY_UPDATE', 'Update Company Documents');
	
	//manage attendance //attandance_manage.php
	define('ATTANDANCE_TITLE', 'Manage Attendance');
	define('ATTANDANCE_PRESENT', 'P - Present');
	define('ATTANDANCE_ABSENT', 'A - Absent'); 
	define('ATTANDANCE_HALF_DAY', 'HL - Half Leave'); 
	define('ATTANDANCE_HOLIDAY', 'H - Holiday'); 
	define('ATTANDANCE_FULL_DAY', 'FL - Full Leave'); 
	define('ATTANDANCE_SELECT_YEAR', 'Select Year'); 
	define('ATTANDANCE_SELECT_MONTH', 'Select Month'); 
	define('ATTANDANCE_JANUARY', 'January'); 
	define('ATTANDANCE_FEBRUARY', 'February'); 
	define('ATTANDANCE_MARCH', 'March'); 
	define('ATTANDANCE_APRIL', 'April'); 
	define('ATTANDANCE_MAY', 'May'); 
	define('ATTANDANCE_JUNE', 'June'); 
	define('ATTANDANCE_JULY', 'July'); 
	define('ATTANDANCE_AUGUST', 'August'); 
	define('ATTANDANCE_SEPTEMBER', 'September'); 
	define('ATTANDANCE_OCTOMBER', 'Octomber'); 
	define('ATTANDANCE_NOVEMBER', 'November'); 
	define('ATTANDANCE_DECEMBER', 'December');
	define('ATTANDANCE_SELECT_DEPARTMENT', 'Select Departmemt'); 
	define('ATTANDANCE_SELECT_ALL', 'All'); 
	define('ATTANDANCE_SELECT_DESIGNATION', 'Select Designation'); 
	define('ATTANDANCE_SEARCH', 'Search');
	define('ATTANDANCE_EMPLOYEE', 'Employee');  
	define('ATTANDANCE_UPDATE', 'Update Attendance');  
	define('ATTANDANCE_SELECT_ATTANDANCE', 'Select Attendance');  
	define('ATTANDANCE_SELECT_ABSENT', 'Absent');  
	define('ATTANDANCE_SELECT_PRESENT', 'Present'); 
	define('ATTANDANCE_SELECT_HALF_DAY', 'Half-Leave'); 
	define('ATTANDANCE_SELECT_FULL_DAY', 'Full-Leave'); 
	define('ATTANDANCE_DATE', 'Date'); 
	define('ATTANDANCE_DESCRIPTION', 'Description'); 
	define('ATTANDANCE_DRAG', 'Drag &amp; Drop files here'); 
	define('ATTANDANCE_BROWSE_FILE', 'Browse File'); 
	define('ATTANDANCE_ADD', 'Add'); 
	define('ATTANDANCE_ADD_TITLE', 'Add Attendance'); 
	define('ATTANDANCE_ADD_BREADCRUMBS_TITLE_1', 'Attendance'); 
	define('ATTANDANCE_ADD_BREADCRUMBS_TITLE_2', 'Add'); 
	define('ATTANDANCE_ADD_SUBMIT_BTN', 'Submit'); 
	define('ATTANDANCE_ADD_CANCEL_BTN', 'Cancel'); 

	define('ATTANDANCE_ADD_CONFIRM_TITLE', 'Cofirm Attendance'); 
	define('ATTANDANCE_ADD_CONFIRM_BREADCRUMBS_TITLE_1', 'Attendance'); 
	define('ATTANDANCE_ADD_CONFIRM_BREADCRUMBS_TITLE_2', 'Add'); 
	define('ATTANDANCE_ADD_CONFIRM_BREADCRUMBS_TITLE_3', 'Confirm'); 

	define('ATTANDANCE_CLOSE', 'Close'); 

	//job positions job_positions.php
	define('JOB_POSITIONS_TITLE', 'Job Positions'); 
	define('JOB_POSITIONS_ADD', 'Add New Job-Position'); 
	define('JOB_POSITIONS_LIST_VIEW', 'Position list view');  
	define('JOB_POSITIONS_TREE_VIEW', 'Position tree view');  
	define('JOB_POSITIONS_JOB_TITLE', 'Job Title');
	define('JOB_POSITIONS_DESIGNATION', 'Designation');
	define('JOB_POSITIONS_EMPLOYEE_NAME', 'Employee Name');
	define('JOB_POSITIONS_UNDER_DESIGNATION', 'Under Designation/Person');
	define('JOB_POSITIONS_STATUS', 'Status');
	define('JOB_POSITIONS_CREATE', 'Create Job-Position');
	define('JOB_POSITIONS_SELECT', 'Select Designation');
	define('JOB_POSITIONS_PARENT_EMPLOYEE', 'Parent Employee');
	define('JOB_POSITIONS_SELECT_PARENT_EMPLOYEE', 'Select Parent Employee');
	define('JOB_POSITIONS_NO_OF_POSITIONS', 'No Of Positions');
	define('JOB_POSITIONS_DESCRIPTION', 'Descrotions');
	define('JOB_POSITIONS_CRATE_JOB', 'Create Job-Position');
	define('JOB_POSITIONS_CANCEL', 'Cancel');
	define('JOB_POSITIONS_UPDATE', 'Update Job-Position');
	define('JOB_POSITIONS_SAVE', 'Save Job-Position');

	//job opening //job_openings.php
	define('JOB_OPENIG_TITLE', 'Job Openings');
	define('JOB_OPENIG_ADD_JOB', 'Add New Job-Openings');
	define('JOB_OPENIG_CREATE_JOB', 'Create Job-Position');
	define('JOB_OPENIG_JOB_DESIGNATION', 'Job-Designation');
	define('JOB_OPENIG_SELECT_POSITION', 'Select Position');
	define('JOB_OPENIG_NO_OF_VACANCY', 'No Of Vacancy');
	define('JOB_OPENIG_DESCRIPTION', 'Description');
	define('JOB_OPENIG_STATUS', 'Status');
	define('JOB_OPENIG_SELECT_STATUS', 'Select Status');
	define('JOB_OPENIG_OPEN', 'Open');
	define('JOB_OPENIG_CLOSED', 'Closed');
	define('JOB_OPENIG_IN_PROGRESS', 'In-Progress');
	define('JOB_OPENIG_CREATE_JOB_OPEN', 'Create Job-Opening');
	define('JOB_OPENIG_CANCEL', 'Cancel');
	define('JOB_OPENIG_JOB_POSITIONS', 'Job-Positions');
	define('JOB_OPENIG_CREATE_JOB_POSITION', 'Create Job-Position');
	define('JOB_OPENIG_JOB_TITLE', 'Job Title');
	define('JOB_OPENIG_SELECT_DESIGNATION', 'Select Designation');
	define('JOB_OPENIG_SAVE_JOB_OPENING', 'Save Job-Opening');
	
	//assets //assets.php
	define('ASSETS_TITLE', 'Assets');
	define('ASSETS_LIST', 'Assets list');
	define('ASSETS_TYPE', 'Assets type');
	define('ASSETS_MANUFACTURER', 'Manufacturer');
	define('ASSETS_ITEM', 'Assets item');
	define('ASSETS_ASSIGNED', 'Assigned assets');
	define('ASSETS_RETURN', 'Retun assets');
	define('ASSETS_ADD_NEW', 'Add new assets type');
	define('ASSETS_TYPE_TITLE', 'Assets Type Title');
	define('ASSETS_NEW_MANUFACTURER', 'Add new manufacturer');
	define('ASSETS_MANUFACTURER_NAME', 'Manufacture Name');
	define('ASSETS_NOTES', 'Notes');
	define('ASSETS_ADD_NEW_ITEM', 'Add new item');
	define('ASSETS_ITEM_NAME', 'Item Name');
	define('ASSETS_ITEM_ID', 'Item ID');
	define('ASSETS_SERIAL_NUMBER', 'Serial Number');
	define('ASSETS_MODEL', 'Model');	
	define('ASSETS_CONDITIONS', 'Condition');
	define('ASSETS_STATUS', 'Is-Assigned');
	define('ASSETS_ASSIGN_ITEM', 'Assign item to user');	
	define('ASSETS_USER', 'User');	
	define('ASSETS_CONDITION', 'Asset Condition');	
	define('ASSETS_ASSIGNED_DATE', 'Assigned Date');	
	define('ASSETS_RETURN_ASSETS', 'Return assets');	
	define('ASSETS_ADD_RETURN_ITEM', 'Add return item');	
	define('ASSETS_RETURN_DATE', 'Return Date');	
	define('ASSETS_ADD_NEW_TYPE', 'Add new assets type');	
	define('ASSETS_ADD', 'Add');	
	define('ASSETS_CLOSE', 'Close');	
	define('ASSETS_UPDATE_TYPE', 'Update Assets type');
	define('ASSETS_SAVE', 'Save');
	define('ASSETS_CANCEL', 'Cancel');
	define('ASSETS_ADD_NEW_MANUFACTURER', 'Add new manufacturer');
	define('ASSETS_UPDATE_MANUFACTURER', 'Update manufacturer');
	define('ASSETS_SELECT_MANUFACTURER', 'Select Manufacturer');
	define('ASSETS_SELECT_TYPE', 'Select assets type');
	define('ASSETS_SELECT_CONDITIONS', 'Select condition');
	define('ASSETS_NEW', 'New');
	define('ASSETS_USED', 'Used');
	define('ASSETS_PARTIALLY_DAMAGED', 'Partially Damaged');
	define('ASSETS_FULLY_DAMAGED', 'Fully Damaged');
	define('ASSETS_DRAG_DROP', 'Drag & Drop files here');
	define('ASSETS_DOC_FILE', 'Document File');
	define('ASSETS_SIZE', 'size : 200 x 200 px');
	define('ASSETS_TYPES', 'PDF.DOC.DOCX.PNG.JPG.JPEG');
	define('ASSETS_BROWSE_FILE', 'Browse Files');
	define('ASSETS_UPDATE_ITEM', 'Update item');	
	define('ASSETS_RETURN_ASSIGN_TO_USER', 'Return assign to users');	
	define('ASSETS_SELECT_USER', 'Select User');	
	define('ASSETS_SELECT_ITEM', 'Select Item');	
	define('ASSETS_DATE_OF_RETURN', 'Date of Return');	
	define('ASSETS_UPDATE', 'Update');
	define('ASSETS_DATE_OF_ASSIGN', 'Date of Assign');	
	define('ASSETS_UPDATE_ASSIGN_ITEM_TO_USERS', 'Update Assign item to users');

	//assets //sssets_employee.php
	define('ASSETS_CURRENT', 'Current');
	define('ASSETS_PAST', 'Past');
	define('ASSETS_DETAILS', 'Asset Details');

	// Warning // warning.php
	define('WARNING_TITLE', 'Warning');
	define('WARNING_LIST', 'Warning List');
	define('WARNING_USER', 'User');
	define('WARNING_CATEGORY', 'Category');
	define('WARNING_TITLE_LIST', 'Title');
	define('WARNING_DESCRIPTION_LIST', 'Description');
	define('WARNING_DATE_TIME', 'Date & Time');
	define('WARNING_ADD_NEW', 'Add Warning');

	//employee //company_employee.php	
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK', 'Share Public Link');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_TITLE', 'Share Public Link');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_EXPIRY_DATE', 'Link Expiry Date');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_PUBLIC_URL', 'Share Link');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_CLOSE_BTN', 'Close');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_SUBMIT_BTN', 'Submit');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_RESEND_BTN', 'Save & Resend');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_EMAIL', 'Email');	

	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_TITLE', 'Personal Documents');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW', 'Add New Document');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_MODAL_POPUP_TITILE', 'Upload Document');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_UPDATE_MODAL_POPUP_TITILE', 'Update Document');

	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_TITLE', 'Document Title');

	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ISSUE_DATE', 'Date of Issue');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_EXPIRY_DATE', 'Date of Expire');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_DESCRIPTION', 'Description');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_DRAG_DROP', 'Drag & Drop files here');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_OR', 'or');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_SELECT_FILE', 'Select Document File');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_FILE_SIZE', 'size : 200 x 200 px');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_FILE_TYPES', '.PDF .DOC .DOCX .JPG .JPEG .PNG');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_BROWSE_BTN_TEXT', 'Browse Files 1');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ADD_BTN', 'Add');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_CLOSE_BTN', 'Close');
	

	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PAGE_TITLE', 'FMC Employee Details');	
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_FORM_SAVE', 'Save');	
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_FORM_SAVE_SUBMIT', 'Save & Submit');	

	define('COMPANY_EMPLOYEE_IMPORT_TITLE', 'Import Excel');
	define('COMPANY_EMPLOYEE_IMPORT_SELECT_FILE', 'Select Excel File');
	define('COMPANY_EMPLOYEE_IMPORT_SUB_BTN_TITLE', 'Import');
	define('COMPANY_EMPLOYEE_IMPORT_CAN_BTN_TITLE', 'Cancel');
	define('COMPANY_EMPLOYEE_IMPORT_CONFIRM_BTN_TITLE', 'Confirm');
	define('IMPORT_EMPLOYEE_CONFIRM_TITLE', 'Import Excel');

	define('COMPANY_EMPLOYEE_IMPORT_EMP_CODE', 'Employee Code');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_FULLNAME_ENG', 'Full-Name English');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_FULLNAME_ARA', 'Full-Name Arabic');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_MOBILE', 'Mobile');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_JOINING_DATE', 'Joining-Date');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_ATTENDANCE_START_DATE', 'Attendance Start Date');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_EMAIL', 'Email');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_PER_EMAIL', 'Personal Email');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_PER_MOBILE', 'Personal Mobile');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_GENDER', 'Gender');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_BIRTHDATE', 'Birthdate');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_NOTE', 'Note');

	define('COMPANY_EMPLOYEE_TITLE', 'Company Employees');
	define('COMPANY_EMPLOYEE_LIST', 'Company Employees list');
	define('COMPANY_EMPLOYEE_ADD', 'Add New Employee'); 
	define('COMPANY_EMPLOYEE_FULL_NAME', 'Full Name'); 
	define('COMPANY_EMPLOYEE_MOBILE', 'Mobile'); 
	define('COMPANY_EMPLOYEE_EMPLOYEE', 'Employees'); 
	define('COMPANY_EMPLOYEE_UPDATE_ACCOUNT', 'Update Account Details');  
	define('COMPANY_EMPLOYEE_CREATE_ACCOUNT', 'Create Account Details');  
	define('COMPANY_EMPLOYEE_ACCOUNT_DETAILS', 'Account Details');  
	define('COMPANY_EMPLOYEE_POSITIONAL_INFO', 'Positional Information');  
	define('COMPANY_EMPLOYEE_PERSONAL_INFO', 'Personal Information');  
	define('COMPANY_EMPLOYEE_EMERGENCY_CONTACT', 'Emergency Contact');  
	define('COMPANY_EMPLOYEE_QUALIFICATION', 'Qualification');  
	define('COMPANY_EMPLOYEE_WORK_EXP', 'Work Experience');  
	define('COMPANY_EMPLOYEE_LEAVE_DETAILS', 'Leave Details');  
	define('COMPANY_EMPLOYEE_SALARY_DETAILS', 'Salary Details');  
	define('COMPANY_EMPLOYEE_PROFILE_PIC', 'Profile Picture');  
	define('COMPANY_EMPLOYEE_PROFILE_PIC_SIZE', 'size : 200 x 200 px');  
	define('COMPANY_EMPLOYEE_PROFILE_PIC_TYPES', 'JPG , PNG , JPEG');  
	define('COMPANY_EMPLOYEE_BROWSE_FILE', 'Browse Files');  
	define('COMPANY_EMPLOYEE_DRAG_DROP', 'Drag & Drop files here');
	define('COMPANY_EMPLOYEE_CODE', 'Employee Code');
	define('COMPANY_EMPLOYEE_NAME_ENGLISH', 'Employee Full Name - English');  
	define('COMPANY_EMPLOYEE_NAME_ARABIC', 'Employee Full Name - Arabic');  
	define('COMPANY_EMPLOYEE_LOGIN_DETAILS', 'Login Details');  
	define('COMPANY_EMPLOYEE_EMAIL', 'Email');  
	define('COMPANY_EMPLOYEE_PASSWORD', 'Password');  
	define('COMPANY_EMPLOYEE_CONFIRM_PASS', 'Confirm Password');  
	define('COMPANY_EMPLOYEE_ENABLE_LOGIN', 'Enable Login');  
	define('COMPANY_EMPLOYEE_JOINING_DATE', 'Joining Date');  
	define('COMPANY_EMPLOYEE_ATTENDANCE_START_DATE', 'Attendance Start Date');  
	define('COMPANY_EMPLOYEE_SAVE', 'Save');  
	define('COMPANY_EMPLOYEE_NEXT', 'Next');  
	define('COMPANY_EMPLOYEE_DEPARTMENT', 'Departments');  
	define('COMPANY_EMPLOYEE_SELECT_DEPARTMENT', 'Select Department');  
	define('COMPANY_EMPLOYEE_DESIGNATION', 'Position Title');  
	define('COMPANY_EMPLOYEE_SELECT_DESIGNATION', 'Select Position Title');  
	define('COMPANY_EMPLOYEE_JOB_POSITIONS', 'Job Position');  
	define('COMPANY_EMPLOYEE_SELECT_JOB_POSITIONS', 'Select Job-Position');  
	define('COMPANY_EMPLOYEE_SKIP', 'Skip');  
	define('COMPANY_EMPLOYEE_PREVIOUS', 'Previous');  
	define('COMPANY_EMPLOYEE_PERSONAL_EMAIL', 'Personal Email');  
	define('COMPANY_EMPLOYEE_PERSONAL_MOBILE', 'Personal Mobile');  
	define('COMPANY_EMPLOYEE_GENDER', 'Gender');  
	define('COMPANY_EMPLOYEE_SELECT_GENDER', 'Select Gender');  
	define('COMPANY_EMPLOYEE_MALE', 'Male');  
	define('COMPANY_EMPLOYEE_FEMALE', 'FeMale');  
	define('COMPANY_EMPLOYEE_NATIONALITY', 'Nationality');  
	define('COMPANY_EMPLOYEE_SELECT_NATIONALITY', 'Select Nationality');  
	define('COMPANY_EMPLOYEE_SOSM', 'Son of Saudi Mother');  
	define('COMPANY_EMPLOYEE_NO_NATIONALITY', 'No Nationality');  
	define('COMPANY_EMPLOYEE_PASSPORT_NUMBER', 'Passport Number');  
	define('COMPANY_EMPLOYEE_PASSPORT_ISSUE_PLACE', 'Passport Issue Place');  
	define('COMPANY_EMPLOYEE_PASSPORT_EXPIRY_DATE', 'Passport Expiry Date');  
	define('COMPANY_EMPLOYEE_GOSI_NUMBER', 'GOSI Number');  
	define('COMPANY_EMPLOYEE_ID_NUMBER', 'ID Number');  
	define('COMPANY_EMPLOYEE_BORTHDATE', 'Birthdate');  
	define('COMPANY_EMPLOYEE_COUNTRY', 'Country');  
	define('COMPANY_EMPLOYEE_SELECT_COUNTRY', 'Select Country 1');  
	define('COMPANY_EMPLOYEE_SOCIAL_STATUS', 'Social Status');  
	define('COMPANY_EMPLOYEE_MARRIED', 'Married');  
	define('COMPANY_EMPLOYEE_SINGLE', 'Single');  
	define('COMPANY_EMPLOYEE_NO_OF_DEPENDENT', 'Number Of Dependent');  
	define('COMPANY_EMPLOYEE_RELIGION', 'Region');
	define('COMPANY_EMPLOYEE_KINGDOM_REGION', 'Region');    
	define('COMPANY_EMPLOYEE_SOCIAL_RELIGION', 'Social Religion');  
	define('COMPANY_EMPLOYEE_MUSLIM', 'Muslim');  
	define('COMPANY_EMPLOYEE_NON_MUSLIM', 'Non-Muslim');  
	define('COMPANY_EMPLOYEE_ADD_MOTHER_CITY', 'Address in mother city');  
	define('COMPANY_EMPLOYEE_ADDRESS', 'Address');  
	define('COMPANY_EMPLOYEE_CITY', 'City');  
	define('COMPANY_EMPLOYEE_STATE', 'State'); 
	
	define('COMPANY_EMPLOYEE_BANK_DETAIL', 'Bank Details'); 
	define('COMPANY_EMPLOYEE_BANK_NAME', 'Bank Name'); 
	define('COMPANY_EMPLOYEE_BANK_IBAN_NO', 'IBAN Number'); 
	define('COMPANY_EMPLOYEE_BANK_ACCOUNT_NO', 'Bank Account Number'); 
	define('COMPANY_EMPLOYEE_BANK_ID_NUMBER', 'ID Number'); 

	define('COMPANY_EMPLOYEE_EXTRA_BENIFIT', 'Employee Extra Benefits');
	define('COMPANY_EMPLOYEE_EXTRA_BENIFIT_TITLE', 'Title');
	define('COMPANY_EMPLOYEE_EXTRA_BENIFIT_NUMBER', 'Number');
	define('COMPANY_EMPLOYEE_EXTRA_BENIFIT_NOTE', 'Note');
	define('COMPANY_EMPLOYEE_EXTRA_BENIFIT_ADD_MORE', 'Add Employee Extra Benefits');

	define('COMPANY_EMPLOYEE_MEDICAL_DETAILS', 'Medical Details');
	define('COMPANY_EMPLOYEE_MEDICAL_COMPANY_NAME', 'Company Name');
	define('COMPANY_EMPLOYEE_MEDICAL_CATEGORY', 'Medical Category');
	define('COMPANY_EMPLOYEE_MEDICAL_EXPIRY_DATE', 'Expiry Date');
	define('COMPANY_EMPLOYEE_MEDICAL_DOCUMENTS', 'Medical Documents');

	define('COMPANY_EMPLOYEE_ADD_IN_KING', 'Address in Kingdom'); 
	define('COMPANY_EMPLOYEE_P_O_BOX', 'P,O,Box'); 
	define('COMPANY_EMPLOYEE_BUILDING_NO', 'Building No'); 
	define('COMPANY_EMPLOYEE_STREET_NAME', 'Street Name'); 
	define('COMPANY_EMPLOYEE_ZIP_CODE', 'Zip Code'); 
	define('COMPANY_EMPLOYEE_CONTACT_NAME', 'Contact Name'); 
	define('COMPANY_EMPLOYEE_RELATIONSHIP', 'Relationship'); 
	define('COMPANY_EMPLOYEE_ADD_MORE', 'Add More'); 
	define('COMPANY_EMPLOYEE_SPECIALIZATION', 'Specialization'); 
	define('COMPANY_EMPLOYEE_INSTITUTE', 'Institute/University Name'); 
	define('COMPANY_EMPLOYEE_FROM_YEAR', 'From Year'); 
	define('COMPANY_EMPLOYEE_SELECT_FROM_YEAR', 'Select From Year'); 
	define('COMPANY_EMPLOYEE_TO_YEAR', 'To Year'); 
	define('COMPANY_EMPLOYEE_SELECT_TO_YEAR', 'Select To Year'); 
	define('COMPANY_EMPLOYEE_POSITION', 'Position'); 
	define('COMPANY_EMPLOYER_NAME', 'Employer Name'); 
	define('COMPANY_EMPLOYEE_JOB_TASK', 'Job Task'); 
	define('COMPANY_EMPLOYEE_TOTAL_SALARY', 'Total Salary'); 
	define('COMPANY_EMPLOYEE_FROM_DATE', 'From Date'); 
	define('COMPANY_EMPLOYEE_TO_DATE', 'To Date'); 
	define('COMPANY_EMPLOYEE_LEAVE_WORK_DETAILS', 'Leave & Workshift Details '); 
	define('COMPANY_EMPLOYEE_SELECT_LEAVE_GROUP', 'Select Leave Group'); 
	define('COMPANY_EMPLOYEE_SELECT_HOLIDAY_GROUP', 'Select Holiday Group'); 
	define('COMPANY_EMPLOYEE_SELECT_WORK_WEEK_WORKSHIFT', 'Select Workweek & Workshift'); 
	define('COMPANY_EMPLOYEE_SELECT_WORK_WEEK', 'Select Workweek'); 
	define('COMPANY_EMPLOYEE_DAY', 'Day'); 
	define('COMPANY_EMPLOYEE_IS_WORKING', 'Is-Working'); 
	define('COMPANY_EMPLOYEE_SHIFT', 'Shift'); 
	define('COMPANY_EMPLOYEE_ANNUAL_CTC', 'Annual CTC:'); 
	define('COMPANY_EMPLOYEE_MONTHLY', 'Monthly:'); 
	define('COMPANY_EMPLOYEE_PREVIEW', 'Preview Salary Sleep'); 
	define('COMPANY_EMPLOYEE_EARNING_COMPONENTS', 'Earning Components'); 
	define('COMPANY_EMPLOYEE_EARNING_COMPO_WITH_SALARY', 'Earning component will add in salary'); 
	define('COMPANY_EMPLOYEE_NAME', 'Name');
	define('COMPANY_EMPLOYEE_COMMON_TYPE', 'Component Type');
	define('COMPANY_EMPLOYEE_AMOUNT', 'Amount');
	define('COMPANY_EMPLOYEE_VALUE', 'Value');
	define('COMPANY_EMPLOYEE_SAR', 'SAR');
	define('COMPANY_EMPLOYEE_DEDUCTION_COMPO', 'Deduction Components');
	define('COMPANY_EMPLOYEE_DEDUCTION_COMPO_SALARY', 'Deduction component will deduct from salary');
	define('COMPANY_EMPLOYEE_SAVE_CLOSE', 'Save & Close');
	define('COMPANY_EMPLOYEE_SALARY_SLEEP', 'Salary Sleep');
	define('COMPANY_EMPLOYEE_EARNINGS', 'Earnings');
	define('COMPANY_EMPLOYEE_DEDUCTION', 'Deductions');
	define('COMPANY_EMPLOYEE_TOTAL_EARNING', 'Total Earning');
	define('COMPANY_EMPLOYEE_TOTAL_DEDUCTION', 'Total Deduction');
	define('COMPANY_EMPLOYEE_NET_BALANCE', 'Net Balance');
	define('COMPANY_EMPLOYEE_CLOSE', 'Close');

	//full profile // company_employees_vie_full_profile.php
	define('EMPLOYEE_VIEW', 'Full Profile');
	define('EMPLOYEE_ACCOUNT_DETAILS', 'Account Details');
	define('EMPLOYEE_FULL_NAME_ENG', 'Employee Full Name - English:');
	define('EMPLOYEE_FULL_NAME_AREBIC', 'Employee Full Name - Arabic:');
	define('EMPLOYEE_EMAIL', 'Email:');
	define('EMPLOYEE_MOBILE', 'Mobile:');
	define('EMPLOYEE_PASSWORD', 'Password:');
	define('EMPLOYEE_POSITIONAL_INFO', 'Positional Information');
	define('EMPLOYEE_DEPARTMENT', 'Department:');
	define('EMPLOYEE_DESIGNATION', 'Position Title:');
	define('EMPLOYEE_JOB_POSITIONS', 'Job Position:');
	define('EMPLOYEE_PERSONAL_INFO', 'Personal Information');
	define('EMPLOYEE_PERSONAL_EMAIL', 'Personal Email:'); 
	define('EMPLOYEE_PERSONAL_MOBILE', 'Personal Mobile: '); 
	define('EMPLOYEE_GENDER', 'Gender:'); 
	define('EMPLOYEE_NATIONALITY', 'Nationality: '); 
	define('EMPLOYEE_COUNTRY_LABLE', 'Country: '); 
	define('EMPLOYEE_PASSPORT_NUMBER', 'Passport Number:'); 
	define('EMPLOYEE_PASSPORT_ISSUE_PALCE', 'Passport Issue Place:'); 
	define('EMPLOYEE_PASSPORT_EXPIRY_DATE', 'Passport Expiry Date:'); 
	define('EMPLOYEE_GOSI_NUMBER', 'GOSI Number: '); 
	define('EMPLOYEE_ID_NUMBER', 'ID Number:'); 
	define('EMPLOYEE_BIRTHDATE', 'Birtdate:'); 
	define('EMPLOYEE_SOCIAL_STATUS', 'Social Status:'); 
	define('EMPLOYEE_REGION', 'Religion:'); 
	define('EMPLOYEE_NUMBER_OF_DEPENDANT', 'Number Of Dependent:'); 
	define('EMPLOYEE_ADDRESS_MOTHER_CITY', 'Address in mother city'); 
	define('EMPLOYEE_ADDRESS', 'Address:'); 
	define('EMPLOYEE_CITY', 'City:'); 
	define('EMPLOYEE_STATE', 'State:');
	define('EMPLOYEE_ADDRESS_IN_MOTHER_KINGDOM', 'Address in mother Kingdom');
	define('EMPLOYEE_PO_BOX', 'P,O,Box:');
	define('EMPLOYEE_BUILDING_NO', 'Building No:');
	define('EMPLOYEE_STREET_NAME', 'Street Name:');
	define('EMPLOYEE_ZIP_CODE', 'Zip Code:');
	define('EMPLOYEE_EMERGENCY_CONTACTS', 'Emergency Contacts ');
	define('EMPLOYEE_CONTACT_NAME', 'Contact Name ');
	define('EMPLOYEE_RELATIONSHIP', 'Relationship'); 
	define('EMPLOYEE_QUALIFICATION', 'Qualification'); 
	define('EMPLOYEE_SPECIALIZATION', 'Specialization'); 
	define('EMPLOYEE_INSTITUTE', 'Institute/Univarsity Name'); 
	define('EMPLOYEE_FROM_YEAR', 'From Year'); 
	define('EMPLOYEE_TO_YEAR', 'To Year'); 
	define('EMPLOYEE_WORK_EXPERIANCE', 'Work Experience'); 
	define('EMPLOYEE_POSITIONS', 'Position: '); 
	define('EMPLOYEE_NAME', 'Employer Name:'); 
	define('EMPLOYEE_JOB_TASK', 'Job Task:'); 
	define('EMPLOYEE_TOTAL_SALARY', 'Total Salary:'); 
	define('EMPLOYEE_FROM_DATE', 'From Date:'); 
	define('EMPLOYEE_TO_DATE', 'To Date:'); 
	define('EMPLOYEE_LEAVE_DETAILS', ' Leave Details:'); 
	define('EMPLOYEE_LEAVE_GROUP', ' Leave Group:'); 
	define('EMPLOYEE_HOLIDAY_GROUP', ' Holiday Group: '); 
	define('EMPLOYEE_WORKWEEK_SHIFT', ' Workweek & Workshift:'); 
	define('EMPLOYEE_DAY', ' Day'); 
	define('EMPLOYEE_IS_WORKING', ' Is-Working'); 
	define('EMPLOYEE_SHIFT', ' Shift'); 
	define('EMPLOYEE_SALARY_DETAILS', ' Salary Details'); 
	define('EMPLOYEE_ANNUAL_CTC', ' Annual CTC:'); 
	define('EMPLOYEE_MONTHLY', ' Monthly:');
	define('EMPLOYEE_PREVIEW_SALARY_SLEEP', ' Preview Salary Sleep');
	define('EMPLOYEE_EARNING_COMPONENT', ' Earning Components');
	define('EMPLOYEE_EARNING_COMPONENT_WITH_SALARY', ' Earning component will add in salary');
	define('EMPLOYEE_NAMES', ' NAME ');
	define('EMPLOYEE_COMPONENT_TYPE', 'Component Type');
	define('EMPLOYEE_AMMOUNT', 'Amount');
	define('EMPLOYEE_VALUE', 'Value');
	define('EMPLOYEE_SAR', 'SAR');
	define('EMPLOYEE_DEDUCTUION_COMPONENT', 'Deduction Components');
	define('EMPLOYEE_DEDUCTUION_COMPONENT_WITH_SALARY', 'Deduction component will deduct from salary');
	define('EMPLOYEE_SALARY_SLEEP', 'Salary Sleep');
	define('EMPLOYEE_EARNING', 'Earnings');
	define('EMPLOYEE_DEDUCTION', 'Deductions');
	define('EMPLOYEE_TOTAL_EARNING', 'Total Earning');
	define('EMPLOYEE_TOTAL_DEDUCTION', 'Total Deduction');
	define('EMPLOYEE_NET_BALANCE', 'Net Balance');
	define('EMPLOYEE_CLOSE', 'CLOSE');
	
	//create event //create_event.php
	define('EVENTS_TITLE', 'Events');
	define('EVENTS_CREATE', 'Create event');
	define('EVENTS_START_DATE', 'Event start date');
	define('EVENTS_START_TIME', 'Event start time');
	define('EVENTS_END_DATE', 'Event end date');
	define('EVENTS_END_TIME', 'Event end time');
	define('EVENTS_TITLES', 'Event title');
	define('EVENTS_ATTACH_EVENT_DOC', 'Attach event document');
	define('EVENTS_EDITOR', 'WYSIWYG Editor');
	define('EVENTS_COLOR', 'Event Color');
	define('EVENTS_CANCEL', 'Cancel');

	//event details
	define('EVENTS_DETAIL_TITLE', 'Events');
	define('EVENTS_DETAIL_FMC_CALENDAR', 'Calendar');
	define('EVENTS_DETAIL_SUB_TITLE', 'Event Details');
	define('EVENTS_DETAIL_START_DATE', 'Event start date');
	define('EVENTS_DETAIL_START_TIME', 'Event start time');
	define('EVENTS_DETAIL_END_DATE', 'Event end date');
	define('EVENTS_DETAIL_END_TIME', 'Event end time');
	define('EVENTS_DETAIL_TITLES', 'Event title');
	define('EVENTS_DETAIL_DESCRIPTION', 'Event Description');
	define('EVENTS_DETAIL_ATTACH_EVENT_DOC', 'Document');
	define('EVENTS_DETAIL_COLOR', 'Event Color');
	define('EVENTS_DETAIL_CLICK_HERE_TO_DOWNLOAD', 'Click here to download');

	//employee profile view //company_employee_view.php
	define('EMPLOYEE_PROFILE', 'Employee');
	define('EMPLOYEE_PROFILE_PROFILE', 'Profile');
	define('EMPLOYEE_PROFILE_VIEW_FULL_PROFILE', 'View Full Profile');
	define('EMPLOYEE_PROFILE_LEAVE_BALANCE', 'Leave Balance');
	define('EMPLOYEE_PROFILE_NAME_ENGLISH', 'Name - English:');
	define('EMPLOYEE_PROFILE_NAME_AREBIC', 'Name - Arabic:');
	define('EMPLOYEE_PROFILE_EMAIL', 'Email:');
	define('EMPLOYEE_PROFILE_MOBILE', 'Mobile: ');
	define('EMPLOYEE_PROFILE_PASSWORD', 'Password:');
	define('EMPLOYEE_PROFILE_OVERTIME', 'Overtime');
	define('EMPLOYEE_PROFILE_LEAVES', 'Leaves');
	define('EMPLOYEE_PROFILE_BUSINESS_TRIP', 'Business Trip');
	define('EMPLOYEE_PROFILE_ECCR', 'ECCR');
	define('EMPLOYEE_PROFILE_GENERAL', 'General');
	define('EMPLOYEE_PROFILE_REQUEST_OVERTIME', 'Request Overtime');
	define('EMPLOYEE_PROFILE_REQUEST_BUSINESS_TRIP', 'Request Business Trip');
	define('EMPLOYEE_PROFILE_REQUEST_LEAVE', 'Request Leave');
	define('EMPLOYEE_PROFILE_REQUEST_ECCR', 'Request ECCR');
	define('EMPLOYEE_PROFILE_REQUEST_GENERAL', 'Request General');
	define('EMPLOYEE_PROFILE_REQUEST_EOS', 'Request EOS');
	define('EMPLOYEE_PROFILE_DATE', 'Date');
	define('EMPLOYEE_PROFILE_REQUEST_STATUS', 'Request Status');
	define('EMPLOYEE_PROFILE_CREATED_AT', 'Created At');
	define('EMPLOYEE_PROFILE_TITLE', 'Title');
	define('EMPLOYEE_PROFILE_DAY_DATE', 'Date/Days');
	
	//request overtime // request_overtime.php
	define('REQUEST_OVERTIME_TITLE', 'Request Overtime');
	define('REQUEST_OVERTIME_CREATE', 'Create');
	define('REQUEST_OVERTIME_SELECT_EMPLOYEE', 'Select Employee');
	define('REQUEST_OVERTIME_DATE', 'Date');
	define('REQUEST_OVERTIME_FROM_TIME', 'From-Time (12 hour)');
	define('REQUEST_OVERTIME_FROM_TIME_EX', 'Ex: 11:59 pm');
	define('REQUEST_OVERTIME_TO_TIME', 'To-Time (12 hour)');
	define('REQUEST_OVERTIME_DESCRIPTION', 'Description');
	define('REQUEST_OVERTIME_UPLOAD_DOC', 'Upload Document');
	define('REQUEST_OVERTIME_DRAG_DROP', 'Drag & Drop files here');
	define('REQUEST_OVERTIME_DOC_FILE', 'Document File');
	define('REQUEST_OVERTIME_DOC_TYPE', 'File Type : .PDF .DOC .DOCX .PNG .JPG');
	define('REQUEST_OVERTIME_BROWSE_FILE', 'Browse Files');
	define('REQUEST_OVERTIME_ASSIGN_USER', 'Assign User:');
	define('REQUEST_OVERTIME_SELECT_USER', 'Select FMC User');
	define('REQUEST_OVERTIME_CANCEL', 'Cancel');

	//request businesss trip //
	define('REQUEST_BUSINESS_TRIP', 'Request Bussiness Trip');
	define('REQUEST_BUSINESS_CREATE', 'Create');
	define('REQUEST_BUSINESS_EMPLOYEE', 'Employee');
	define('REQUEST_BUSINESS_SELECT_EMPLOYEE', 'Select Employee');
	define('REQUEST_BUSINESS_TITLE', 'Title');
	define('REQUEST_BUSINESS_FROM_DATE', 'From Date');
	define('REQUEST_BUSINESS_TO_DATE', 'To Date');
	define('REQUEST_BUSINESS_DESCRIPTION', 'Description');
	define('REQUEST_BUSINESS_TRIP_ROUTE', 'Trip Route');
	define('REQUEST_BUSINESS_PROJECT_NAME', 'Project Name');
	define('REQUEST_BUSINESS_DESTINATION', 'Destination');
	define('REQUEST_BUSINESS_ACCOMODATION', 'Accommodation');
	define('REQUEST_BUSINESS_ENTRY_VISA', 'Entry Visa');
	define('REQUEST_BUSINESS_EXIT_VISA', 'Exit Visa');
	define('REQUEST_BUSINESS_TRAVEL_TICKET', 'Travel Ticket');
	define('REQUEST_BUSINESS_ON_HAND_CASH', 'On Hand Cash');
	define('REQUEST_BUSINESS_ON_HAND_AMMOUNT', 'On Hand Cash Ammount');
	define('REQUEST_BUSINESS_CAR', 'Car');
	define('REQUEST_BUSINESS_ASSIGN_USER', 'Assign User:');
	define('REQUEST_BUSINESS_SELECT_USER', 'Select FMC User');
	define('REQUEST_BUSINESS_CANCEL', 'Cancel');
	
	//request leave //request_leave.php
	define('REQUEST_LEAVE', 'Request');
	define('REQUEST_LEAVE_LEAVE', 'Leave');
	define('REQUEST_LEAVE_EMPLOYEE', 'Employee');
	define('REQUEST_LEAVE_SELECT_EMPLOYEE', 'Select Employee');
	define('REQUESTS_LEAVE_LEAVE_TYPE', 'Leave Type');
	define('REQUESTS_LEAVE_SELECT_LEAVE_TYPE', 'Select Leave Type');
	define('REQUESTS_LEAVE_TITLE', 'Title');
	define('REQUESTS_LEAVE_FROM_DATE', 'From Date');
	define('REQUESTS_LEAVE_TO_DATE', 'To Date');	
	define('REQUESTS_LEAVE_DATE', 'Leave Date');	
	define('REQUESTS_LEAVE_DESCRIPTION', 'Description');	
	define('REQUESTS_LEAVE_ENTRY_VISA_REAUIRED', 'Entry-Visa required');	
	define('REQUESTS_LEAVE_EXIT_VISA_REAUIRED', 'Exit-Visa required');	
	define('REQUESTS_LEAVE_TRAVEL_TICKET', 'Travel ticket required');	
	define('REQUESTS_LEAVE_UPLOAD_DOC', 'Upload Document');	
	define('REQUESTS_LEAVE_DRAG_DROP', 'Drag & Drop files here');	
	define('REQUESTS_LEAVE_DOC_FILE', 'Document File');	
	define('REQUESTS_LEAVE_FILE_TYPE', 'File Type : .PDF .DOC .DOCX .PNG .JPG .JPEG  ');	
	define('REQUESTS_LEAVE_BROWSE_FILE', 'Browse Files');	
	define('REQUESTS_LEAVE_ASSIGN_USER', 'Assign User: ');	
	define('REQUESTS_LEAVE_SELECT_USER', 'Select FMC User');	
	define('REQUESTS_LEAVE_CREATE', 'Create');
	define('REQUESTS_LEAVE_CANCEL', 'Cancel');	

	//request eccr //request_eccr.php
	define('REQUESTS_ECCR', 'Employee Contract & Roll Change (ECCR)');	
	define('REQUESTS_ECCR_EMPLOYEE', 'Employee');
	define('REQUESTS_ECCR_SELECT_EMPLOYEE', 'Select Employee');		
	define('REQUESTS_ECCR_TYPE', 'Request Type');
	define('REQUESTS_ECCR_POSITION_CHANGE', 'Position Change');
	define('REQUESTS_ECCR_POSITION_ADD_ALLOWANCE', 'Add Allowances');
	define('REQUESTS_ECCR_DESCREASE_ALLOWANCE', 'Descrease Allowances');
	define('REQUESTS_ECCR_SALARY_INCREMENT', 'Salary Increment');
	define('REQUESTS_ECCR_LOCATION_CHANGE', 'Location Change');
	define('REQUESTS_ECCR_DEPARTMENT_CHANGE', 'Department Change');
	define('REQUESTS_ECCR_TEMPORARY_RELOACTION', 'Temporary Relocation');
	define('REQUESTS_ECCR_TITLE', 'Title');
	define('REQUESTS_ECCR_DESCRIPTION', 'Description');
	define('REQUESTS_ECCR_ASSIGN_USER', 'Assign User: ');
	define('REQUESTS_ECCR_SELECT_USER', 'Select FMC User');
	define('REQUESTS_ECCR_CREATE', 'Create');
	define('REQUESTS_ECCR_CANCEL', 'Cancel');

	//request general //reauest_general.php
	define('GENERAL_REQUEST', 'General Request');
	define('GENERAL_REQUEST_CREATE', 'Create General Request');
	define('GENERAL_REQUEST_EMPLOYEE', 'Employee');
	define('GENERAL_REQUEST_SELECT_EMPLOYEE', 'Select Employee');
	define('GENERAL_REQUEST_TYPE', 'Request Type');
	define('GENERAL_REQUEST_SELECT_TYPE', 'Select Request Type ');
	define('GENERAL_REQUEST_TITLE', 'Title ');
	define('GENERAL_REQUEST_DESCRIPTION', 'Description');
	define('GENERAL_REQUEST_ASSIGN_USER', 'Assign User:');
	define('GENERAL_REQUEST_SELECT_USER', 'Select FMC User');
	define('GENERAL_REQUEST_CREATES', 'Create');
	define('GENERAL_REQUEST_CANCEL', 'Cancel');

	//FMC Dashboard
	define('DASHBOARD_TITLE', 'Dashboard');
	define('DASHBOARD_REQUESTS', 'Requests');
	define('DASHBOARD_PRIMARY_REQUEST', 'Primary Requests');
	define('DASHBOARD_OTHER_REQUEST', 'Other Requests');
	define('DASHBOARD_APPROVED_REQUEST', 'Approved Requests');
	define('DASHBOARD_DECLINED_REQUEST', 'Declined Requests');
	define('DASHBOARD_REQUEST_TYPE', 'Request Type');
	define('DASHBOARD_REQUEST_TITLE', 'Title');
	define('DASHBOARD_COMPANY_NAME', 'Company Name');
	define('DASHBOARD_EMPLOYEE_NAME', 'Employee Name');
	define('DASHBOARD_CREATED_AT', 'Created At');
	
	//dashboard Client conform request //clients_confirm_request.php
	define('REQUEST_TITLE', 'Request');
	define('REQUEST_CONFORM_DETAILS', 'Confirm Client Details Request');
	define('REQUESTS_CONF_ALL_ABOVE', 'Confirm All Above Details');
	define('REQUESTS_NOTE', 'Request Note:');
	define('REQUESTS_CONFO_CLOSE', 'Confirm & Close');
	define('REQUESTS_DECLINE', 'Decline');
	define('REQUESTS_COMPANY_NAME_ENG', 'Company Name - English:');
	define('REQUESTS_COMPANY_NAME_ARABIC', 'Company Name - Arabic:');
	define('REQUESTS_ALL_CIS', 'All CIS:');
	define('REQUESTS_C_R_NUMBER', 'C.R Number:');
	define('REQUESTS_FROM', 'From:');
	define('REQUESTS_DATE_OF_ISSUE', 'Date of issue:');
	define('REQUESTS_DATE_OF_EXPAIRY', 'Date of expiry:');	
	define('REQUESTS_LEGAL_ENTITY', 'Legal entity:');
	define('REQUESTS_DATE_ESTABLISHED', 'Date established:');
	define('REQUESTS_MAIN_ACTIVITY', 'Main activity:');
	define('REQUESTS_COUNTRY_OF_ORIGIN', 'Country of Origin:');
	define('REQUESTS_ABOUT_COMPANY', 'About Company:');
	define('REQUESTS_CONTACT_NO', 'Contract No.:');
	define('REQUESTS_CONTACT_DATE', 'Contract date:');
	define('REQUESTS_CONTACT_START_DATE', 'Contract start date:');
	define('REQUESTS_CONTACT_END_DATE', 'Contract end date: ');
	define('REQUESTS_CONTACT_CREATED_BY', 'Contract created by');
	define('REQUESTS_CONTACT_SIGNED_BY_FMC', 'Contract signed by ( FMC )');
	define('REQUESTS_CONTACT_SIGNED_BY_CLIENT', 'Contract signed by ( Client)');
	define('REQUESTS_CONTACT_SIGNED_LOCATION', 'Contract signed location');
	define('REQUESTS_CONTACT_AGREEMENT_FILE', 'Contract Agreement File:');
	define('REQUESTS_CONTACT_NOTE', 'Contract Notes:');
	define('REQUESTS_PERCENTAGE', 'Percentage');
	define('REQUESTS_BIRTHDATE', 'Birthdate');
	define('REQUESTS_JOINING_DATE', 'Joining Date');
	define('REQUESTS_DETAIL', 'Details');
	define('REQUESTS_DETAILS', 'Request Details -');
	define('REQUESTS_COMPANY_NAME', 'Company Name:');
	define('REQUESTS_EMPLOYEE_NAME', 'Employee Name:');	
	define('REQUESTS_TITLE', 'Title:');	
	define('REQUESTS_DESCRIPTION', 'Description:');
	define('REQUESTS_FROM_DATE', 'From-Date:');
	define('REQUESTS_TO_DATE', 'To-Date:');
	define('REQUESTS_PROJECT_NAME', 'Project Name: ');
	define('REQUESTS_DESTINATION', 'Destination:');
	define('REQUESTS_TRIP_ROUTE', 'Trip Route:');
	define('REQUESTS_TRIP_ACCOMMODATION', 'Accommodation:');
	define('REQUESTS_ENTRY_VISA', 'Entry Visa:');
	define('REQUESTS_EXIT_VISA', 'Exit Visa:');
	define('REQUESTS_TRAVEL_TICKET', 'Travel Ticket: ');
	define('REQUESTS_ON_HAND_CASH', 'On Hand Cash:');
	define('REQUESTS_CAR', 'Car:');
	define('REQUESTS_CREATED_BY_FMC', 'Created By FMC:');
	define('REQUESTS_CREATED_BY_COMPANY', 'Created By Company:');
	define('REQUESTS_APPROVAL_CLOSE', 'Approve & Close');
	define('REQUESTS_CANCEL', 'Cancel');
	define('REQUESTS_TYPE', 'Request Type:');
	define('REQUESTS_LEAVE_TYPE', 'Leave Type:');
	define('REQUESTS_DATE', 'Date');
	define('REQUESTS_DURATION', 'Duration:');
	
	//FMC Department /departments.php
	define('DEPARTMENTS_TITLE', 'Departments');
	define('DEPARTMENTS_ADD_DEPARTMENT', 'Add Department');
	define('DEPARTMENTS_DEPARTMENT_NAME', 'Department Name');
	define('DEPARTMENTS_ACTION', 'Action');
	define('DEPARTMENTS_ADD', 'Add');
	define('DEPARTMENTS_CLOSE', 'Close');
	define('DEPARTMENTS_PLACEHOLDER_NAME', 'Department Name *');
	define('DEPARTMENTS_UPDATE', 'Update Department');
	define('DEPARTMENTS_SAVE', 'Save');

	//FMC Division division.php
	define('DIVISION_TITLE', 'Division');
	define('DIVISION_ADD_DIVISION', 'Add Division');
	define('DIVISION_DIVISION_NAME', 'Division Name');
	define('DIVISION_DEPARTMENT_NAME', 'Department Name');

	//FMC Department Division //Division create
	define('DEPARTMENT_DIVISION', 'Department Division');
	define('DEPARTMENT_CREATE_DIVISION', 'Create Division');
	define('DEPARTMENT_TITLE', 'Department');
	define('DEPARTMENT_SELECT_DEPARTMENT', 'Select Department');
	define('DEPARTMENT_DIVISION_NAME', 'Division Name');
	define('DEPARTMENT_CANCEL', 'Cancel');
	define('DEPARTMENT_PLACEHOLDER_NAME', 'Division Name');
	define('DEPARTMENT_UPDATE_DIVISION', 'Update Division');
	define('DEPARTMENT_SAVE_DIVISION', 'Save Division');
	
	//FMC USERS  //fmcusers.php
	define('FMC_TITLE', 'FMC Users');
	define('FMC_UPDATE_USER', 'Update User');
	define('FMC_ADD_USERS', 'Add User');
	define('FMC_EMPLOYEE_ID', 'Employee ID');
	define('FMC_CEO', 'CEO');
	define('FMC_HR', 'HR');
	define('FMC_COORDINATOR', 'Coordinator');
	define('FMC_FULL_NAME', 'Full Name');
	define('FMC_EMAIL', 'Email');
	define('FMC_DEPARTMENT_NAME', 'Department Name');

	//FMC USERS //fmc_users_create.php
	define('FMC_CREATE_USERS', 'Create Users');
	define('FMC_USER_TYPE', 'User Type');
	define('FMC_SELECT_USER_TYPE', 'Select User-Type');
	define('FMC_SELECT_DEPARTMENT', 'Departments');
	define('FMC_FIRST_NAME', 'First Name');
	define('FMC_MIDDLE_NAME', 'Middle Name');
	define('FMC_LAST_NAME', 'Last Name');
	define('FMC_SURNAME', 'Surname');
	define('FMC_PASSWORD', 'Password');
	define('FMC_PLS_PASSWORD', 'Enter Minimum 6 Charachter Inputes');
	define('FMC_CONFIRM_PASSWORD', 'Confirm Password');
	define('FMC_MOBILE', 'Mobile');
	define('FMC_ALTERNATIVE_MOBILE', 'Alternative Mobile');
	define('FMC_BIRTHDATE', 'Birthdate');
	define('FMC_ADDRESS', 'Address');
	define('FMC_CANCEL', 'Cancel');
	define('FMC_SAVE_USER', 'Save User');
	
	//FMC Clients //Clients.php
	define('CLIENTS_TITLE', 'Clients');	
	define('CLIENTS_ADD_NEW_CLIENTS', 'Add New Client');
	define('CLIENTS_NAME_ENGLISH', 'Name English');
	define('CLIENTS_NAME_ARABIC', 'Name Arabic');
	define('CLIENTS_STATUS', 'Status');

	//Client view //client_view.php
	define('CLIENTS_DETAILS', 'Clients Details');	
	define('CLIENTS_COMPANY_ALL_CIS', 'All CIS:');	
	define('CLIENTS_COMPANY_C_R_NUMBER', 'C.R Number:');
	define('CLIENTS_COMPANY_FROM', 'From:');
	define('CLIENTS_COMPANY_DATE_OF_ISSUE', 'Date of issue:');
	define('CLIENTS_COMPANY_DATE_OF_EXPIRY', 'Date of expiry: ');
	define('CLIENTS_COMPANY_LEGAL_ENTITY', 'Legal entity:');
	define('CLIENTS_COMPANY_DATE_ESTABLISHED', 'Date established:');
	define('CLIENTS_COMPANY_MAIN_ACTIVITY', 'Main activity:');
	define('CLIENTS_COMPANY_ABOUT_COMPANY', 'About Company:');
	define('CLIENTS_COMPANY_COUNTRY_OF_REGION', 'Country of Origin:');
	define('CLIENTS_COMPANY_CONTACT_DETAIL', 'Contract Detail');
	define('CLIENTS_COMPANY_CONTRACT', 'Contract No.:');
	define('CLIENTS_COMPANY_CONTRACT_DATE', 'Contract date:');
	define('CLIENTS_COMPANY_CONTRACT_START_DATE', 'Contract start date:');
	define('CLIENTS_COMPANY_CONTRACT_END_DATE', 'Contract end date:');
	define('CLIENTS_COMPANY_CONTRACT_CREATED_BY', 'Contract created by');
	define('CLIENTS_COMPANY_CONTRACT_CREATED_BY_FMC', 'Contract signed by ( FMC )');
	define('CLIENTS_COMPANY_CONTRACT_CREATED_BY_CLIENT', 'Contract signed by ( Client )');
	define('CLIENTS_COMPANY_CONTRACT_SIGNED_LOCATION', 'Contract signed location');
	define('CLIENTS_COMPANY_CONTRACT_NOTES', 'Contract Notes:');
	define('CLIENTS_COMPANY_CONTRACT_INFO', 'Contact Information');
	define('CLIENTS_COMPANY_P_O_BOX', 'P,O,Box:');
	define('CLIENTS_COMPANY_BUILDING_NO', 'Building No:');
	define('CLIENTS_COMPANY_STREET_NAME', 'Street Name:');
	define('CLIENTS_COMPANY_REGION', 'Region:');
	define('CLIENTS_COMPANY_CITY', 'City:');
	define('CLIENTS_COMPANY_ZIP_CODE', 'Zip Code:');
	define('CLIENTS_COMPANY_ADDITONAL_NO', 'Addional No:');
	define('CLIENTS_COMPANY_TEL', 'Tel:');
	define('CLIENTS_COMPANY_FAX', 'Fax:');
	define('CLIENTS_COMPANY_EMAIL', 'Email: ');
	define('CLIENTS_COMPANY_WELCOME', 'Website:');
	define('CLIENTS_COMPANY_CONTACT_PERSON_NAME', 'Contact person name:');
	define('CLIENTS_COMPANY_CONTACT_PERSON_NO', 'Contact person mobile number:');
	define('CLIENTS_COMPANY_CONTACT_PERSON_EMAIL', 'Contact person email:');
	define('CLIENTS_COMPANY_CONTACT_PERSON_TEL', 'Contact person Tel/ext:');
	define('CLIENTS_COMPANY_CONTACT_PROPERTY_INFORMATION', 'Property Information');
	define('CLIENTS_COMPANY_OWNER_NAME', 'Owner Name');
	define('CLIENTS_COMPANY_NATIONALITY', 'Nationality');
	define('CLIENTS_COMPANY_PERCENTAGE', 'Percentage');
	define('CLIENTS_COMPANY_EXPERIANCE', 'Experience');
	define('CLIENTS_COMPANY_BIRTHDATE', 'Birthdate');
	define('CLIENTS_COMPANY_EXECUTIVE', 'Executive Management');
	define('CLIENTS_COMPANY_EXECUTIVE_NAME', 'Executive Name');
	define('CLIENTS_COMPANY_JOB_POSSITIONS', 'Job-Position');
	define('CLIENTS_COMPANY_JOINING_DATE', 'Joining Date');
	define('CLIENTS_COMPANY_BRANCH', 'Branches / Subsidiary');
	define('CLIENTS_COMPANY_TRADING_NAME', 'Trading name:');
	define('CLIENTS_COMPANY_BRANCH_TYPE', 'Branch Type:');
	define('CLIENTS_COMPANY_WEBSITE', 'Website');
	define('CLIENTS_COMPANY_DOCUMENT_TITLE', 'Document title');
	define('CLIENTS_COMPANY_DOCUMENT_DATE', 'Document date');
	define('CLIENTS_COMPANY_DOCUMENT_EXPIRY_DATE', 'Document Expiary date');
	define('CLIENTS_COMPANY_ADDED_DOC', 'Added by / added date & time');
	define('CLIENTS_COMPANY_NOTES', 'Notes');

	//FMC CREATE CLIENTS //clients_create_step_1.php
	define('CLIENTS_PRIMARY_HR', 'Primary HR');
	define('CLIENTS_SELECT_PRIMARY_HR', 'Select Primary HR 1');	
	define('CLIENTS_GENERAL_INFORMATION', 'Client General Information');
	define('CLIENTS_GENERAL_INFO', 'General Information');
	define('CLIENTS_CONTRACT_DETAILS', 'Contract Details');
	define('CLIENTS_CONTACT_INFORMATIONS', 'Contact Information');
	define('CLIENTS_PROPERTY_INFORMATION', 'Property Information');
	define('CLIENTS_EXECUTIVE_MANAGEMENT', 'Executive Management');
	define('CLIENTS_BRANCH_SUBSIDIARIES', 'Branches / Subsidiaries');
	define('CLIENTS_COMPANY_DOCUMENTS', 'Company Document');
	define('CLIENTS_COMPANY_NAME_ENGLISH', 'Company Name - English');
	define('CLIENTS_COMPANY_NAME_AREBIC', 'Company Name - Arabic');
	define('CLIENTS_COMPANY_LOGO', 'Company Logo');
	define('CLIENTS_LOGO_SIZE', 'size : 200 x 200 px');
	define('CLIENTS_LOGO_EXTENSION', 'JPG , PNG , JPEG');
	define('CLIENTS_LOGO_UPLOAD', 'Drag & Drop files here');
	define('CLIENTS_OR', 'or'); 
	define('CLIENTS_BROWSE_FILES', 'Browse Files');
	define('CLIENTS_ALL_CIS', 'All CIS'); 
	define('CLIENTS_C_R_NUMBER', 'C.R Number'); 
	define('CLIENTS_FROM', 'From Date'); 
	define('CLIENTS_DATE_OF_ISSUE', 'Date of Issue');
	define('CLIENTS_DATE_OF_EXPIRY', 'Date of Expiry');
	define('CLIENTS_LEGAL_ENTITY', 'Legal Entity');
	define('CLIENTS_SELECT_LEGAL_ENTITY', 'Select Legal entity');
	define('CLIENTS_DATA_ESTABLISHED', 'Date Established');
	define('CLIENTS_MAIN_ACTIVITY', 'Main Activity');
	define('CLIENTS_SELECT_MAIN_ACTIVITY', 'Select Main activity');
	define('CLIENTS_COUNTRY_OF_ORIGIN', 'Country of Origin');
	define('CLIENTS_SELECT_COUNTRY_OF_ORIGIN', 'Select Country of Origin');
	define('CLIENTS_ABOUT_COMPANY', 'About Company');
	define('CLIENTS_SAVE', 'Save');
	define('CLIENTS_NEXT', 'Next');

	//FMC CREATE CLIENTS //clients_create_step_.php
	define('CLIENT_CONTRACT_DETAILS', 'Client Contract Details');
	define('CLIENTS_CONTRACT_NO', 'Contract No.');
	define('CLIENTS_CONTRACT_DATE', 'Contract Date');
	define('CLIENTS_COMPANY_AGREEMENT', 'Company Agreement');
	define('CLIENTS_CLICK_TODOWNLOAD', 'Click here to download');
	define('CLIENTS_MAX', 'Max : 15 MB');
	define('CLIENTS_PDF_DOC', 'PDF and Doc files');
	define('CLIENTS_DRAG_DROP', 'Drag & Drop files here');
	define('CLIENTS_CONTRACT_START_DATE', 'Contract Start Date');
	define('CLIENTS_CONTRACT_END_DATE', 'Contract End Date');
	define('CLIENTS_CONTRACT_CREATED_BY', 'Contract Created By');
	define('CLIENTS_CONTRACT_SIGNED_BY', 'Contract Signed By ( FMC )');
	define('CLIENTS_CONTRACT_SIGNED_BY_CLIENT', 'Contract Signed By ( Client )');
	define('CLIENTS_CONTRACT_SIGEN_LOCATION', 'Contract Signed Location');
	define('CLIENTS_CONTRACT_NOTES', 'Contract Notes');
	define('CLIENTS_CONTRACT_SKIP', 'Skip');
	define('CLIENTS_CONTRACT_PREVIOUS', 'Previous');

	//FMC CREATE CLIENTS //clients_create_step_3.php
	define('CLIENTS_CONTACT_INFO', 'Client Contact Information');
	define('CLIENTS_CONTACT_P_O_BOX', 'P,O,Box');
	define('CLIENTS_CONTACT_BUILDING_NO', 'Building No');
	define('CLIENTS_CONTACT_STREET_NAME', 'Street Name');
	define('CLIENTS_CONTACT_REGION', 'Regions');
	define('CLIENTS_CONTACT_CITY', 'City');
	define('CLIENTS_CONTACT_ZIP_CODE', 'Zip Code');
	define('CLIENTS_CONTACT_ADDITIONAL_NO', 'Addional No');
	define('CLIENTS_CONTACT_COORDINATES', 'Coordinates');
	define('CLIENTS_CONTACT_TEL', 'Tel.');
	define('CLIENTS_CONTACT_FAX', 'Fax');
	define('CLIENTS_CONTACT_EMAIL', 'Email');
	define('CLIENTS_CONTACT_WEBSITE', 'Website');
	define('CLIENTS_CONTACT_PERSON_NAME', 'Contact Person Name');
	define('CLIENTS_CONTACT_PERSON_MO_NO', 'Contact Person Mobile Number');
	define('CLIENTS_CONTACT_PERSON_EMAIL', 'Contact Person Email');
	define('CLIENTS_CONTACT_PERSON_TEL', 'Contact Person Tel/Ext');
	define('CLIENTS_CONTACT_SAVE', 'Save');

	//FMC CREATE CLIENTS //clients_create_step_4.php
	define('CLIENTS_PROPERTY', 'Client Property Information');
	define('CLIENTS_OWNER_NAME', 'Owner Name');
	define('CLIENTS_NATIONALITY', 'Nationality');
	define('CLIENTS_SELECT_NATIONALITY', 'Select Nationality');
	define('CLIENTS_COMPANY_STATUS', 'Company Status');
	define('CLIENTS_PROPERTY_PERCENTAGE', 'Property Percentage %');
	define('CLIENTS_EXPERIANCE', 'Experience');
	define('CLIENTS_DATE_OF_BIRTH', 'Date of Birth');
	define('CLIENTS_ADD_PROPERTY_INFORMATION', 'Add Property Information');
	

	//FMC CREATE CLIENTS //clients_create_step_5.php
	define('CLIENTS_EXICUTIVE_MANAGEMENT', 'Client Exucutive Management');
	define('CLIENTS_EXICUTIVE_NAME', 'Executive Name');
	define('CLIENTS_JOB_POSITION', 'Job Position');
	define('CLIENTS_YEAR_OF_EXPIRIANCE', 'Years of Experience');
	define('CLIENTS_DATE_OF_JOINING_COMPANY', 'Date of Joining the Company');
	define('CLIENTS_ADD_EXECUTIVE_INFORMATION', 'Add Executive Member');

	//FMC CREATE CLIENTS //clients_create_step_6.php
	define('CLIENTS_BRANCH_SUBSID', 'Client Branch/Subsidiary');
	define('CLIENTS_BRANCH_SUBSID_TRADING_NAME', 'Trading Name');
	define('CLIENTS_BRANCH_SUBSID_BRANCH_TYPE', 'Branch Type');
	define('CLIENTS_BRANCH_SUBSID_ADD_BRANCH', 'Add Branch / Subsidiaries');

	//FMC CREATE CLIENTS //clients_create_step_7.php
	define('CLIENTS_BRANCH', 'Create Client Branch/Subsidiary');
	define('CLIENTS_ADD_DOCUMENT', 'Add Document');
	define('CLIENTS_ADD_NEW_DOCUMENT', 'Add new document');
	define('CLIENTS_DREG_DROP', 'Drag &amp; Drop files here');
	define('CLIENTS_DOCUMENT_TITLE', 'Document Title');
	define('CLIENTS_DOCUMENT_DATA', 'Document Date');
	define('CLIENTS_DOCUMENT_EXPIARY_DATE', 'Document Expiry Date');
	define('CLIENTS_DOCUMENT_ADDED_DATE', 'Added by / added date & time');
	define('CLIENTS_DOCUMENT_NOTE', 'Note');
	define('CLIENTS_DOCUMENT_DATE', 'Date');
	define('CLIENTS_DOCUMENT_SELECTED', 'document selected');
	
	//Settings //Document_categories.php
	define('DOCUMENT_CATEGORY_TITLE', 'Document Categories');
	define('DOCUMENT_ADD_CATEGORY', 'Add Category');
	define('DOCUMENT_CATEGORY_NAME', 'Name');
	define('DOCUMENT_CATEGORY_DISPLAY_ORDER', 'Display Order');
	define('DOCUMENT_CATEGORY_DEFAULT', 'Default');
	define('DOCUMENT_CATEGORY_ADD', 'Add Document Category');
	define('DOCUMENT_CATEGORY_ISDEFAULT', 'Is Default');
	define('DOCUMENT_CATEGORY_UPDATE', 'Update Document Category');

	//Medical Categories
	define('MEDICAL_CATEGORY_TITLE', 'Medical Categories');
	define('MEDICAL_ADD_CATEGORY', 'Add Medical Categories');
	define('MEDICAL_CATEGORY_NAME', 'Name 1');
	define('MEDICAL_CATEGORY_DEFAULT', 'Default');
	define('MEDICAL_CATEGORY_ADD', 'Add Medical Category');
	define('MEDICAL_CATEGORY_ISDEFAULT', 'Is Default');
	define('MEDICAL_CATEGORY_UPDATE', 'Update Medical Category');

	//Settings //Company_structure_type.php
	define('COMPANY_STRUCTURE_TITLE', 'Company Structure Type');
	define('COMPANY_ADD_STRUCTURE', 'Add Company Structure');
	define('COMPANY_STRUCTURE_NAME', 'Name');
	define('COMPANY_STRUCTURE_DEFAULT', 'Default');
	define('COMPANY_ADD_COMPANY_STUC_TYPE', 'Add Company Structure type');
	define('COMPANY_STRUCTURE_ISDEFAULT', 'Is Default');
	define('COMPANY_STRUCTURE_UPDATE', 'Update Company Structure Type');
	
	//Settings //legal_entities.php
	define('LEGAL_ENTITIES_TITLE', 'Legal Entities');
	define('LEGAL_ENTITIES_ADD', 'Add Legal Entity');
	define('LEGAL_ENTITIES_NAME', 'Name');
	define('LEGAL_ENTITIES_DEFAULT', 'Default');
	define('LEGAL_ENTITIES_ADD_ENTITY', 'Add Legal Entity');
	define('LEGAL_ENTITIES_PLSHOLDER', 'Legal Entity Name');
	define('LEGAL_ENTITIES_ISDEFAULT', 'Is Default');
	define('LEGAL_ENTITIES_UPDATE', 'Update Legal Entity');

	//Settings //countries.php
	define('COUNTRIES_TITLE', 'Countries');
	define('COUNTRIES_ADD', 'Add Country');
	define('COUNTRIES_NAME', 'Name');
	define('COUNTRIES_DEFAULT', 'Default');
	define('COUNTRIES_ADD_CONTRIES', 'Add Country');
	define('COUNTRIES_COUNTRY_CODE', 'Country Code');
	define('COUNTRIES_ISDEFAULT', 'Is Default');
	define('COUNTRIES_UPDATE', 'Update Country');
	
	//Settings // regions.php
	define('REGIONS_TITLE', 'Regions');
	define('REGIONS_ADD', 'Add Regions');
	define('REGIONS_COUNTRY', 'Country');
	define('REGIONS_NAME', 'Name');
	define('REGIONS_DEFAULT', 'Default');
	define('REGIONS_ISDEFAULT', 'Is Default');
	define('REGIONS_UPDATE', 'Update Regions');
	define('REGIONS_SELECT_COUNTRY', 'Select Country');

	//Settings //cities.php
	define('CITY_TITLE', 'Cities');
	define('CITY_ADD', 'Add City');
	define('CITY_COUNTRY', 'Country');
	define('CITY_REGION', 'Region');
	define('CITY_NAME', 'Name');
	define('CITY_DEFAULT', 'Default');
	define('CITY_SELECT_REGION', 'Select Regions');
	define('CITY_ISDEFAULT', 'Is Default');
	define('CITY_UPDATE', 'Update City');
	define('CITY_SELECT_COUNTRY', 'Select Country');

	//settings //main_activity.php
	define('MAIN_ACTIVITY_TITLE', 'Main Activities');
	define('MAIN_ACTIVITY_ADD', 'Add Main Activity');
	define('MAIN_ACTIVITY_NAME', 'Name');
	define('MAIN_ACTIVITY_DEFAULT', 'Default');
	define('MAIN_ACTIVITY_MAIN', 'Main Activity Name');
	define('MAIN_ACTIVITY_ISDEFAULT', 'IS Default');
	define('MAIN_ACTIVITY_UPDATE', 'Update Main Activity');

	//Settings //Warning_categories.php
	define('WARNING_CATEGORY_TITLE', 'Warning Categories');
	define('WARNING_ADD_CATEGORY', 'Add Category');
	define('WARNING_CATEGORY_TITLE', 'Title');
	define('WARNING_CATEGORY_TITLE_ENG', 'Title Eng');
	define('WARNING_CATEGORY_TITLE_AR', 'Title Ar');
	define('WARNING_CATEGORY_ADD', 'Add Warning Category');
	define('WARNING_CATEGORY_UPDATE', 'Update Warning Category');
	
	//calander //calender.php
	define('CALENDER_TITLE', 'Brilliant Activity Calender');
	define('CALENDER_VIEW', 'Calender view');
	define('CALENDER_LIST_VIEW', 'Calender list view');
	define('CALENDER_ADD_NEW_EVENT', 'Add New Event');  
	define('CALENDER_EVENT_TITLE', 'Event Title');  
	define('CALENDER_START_DATE', 'Start date');  
	define('CALENDER_END_DATE', 'End date');  
	define('CALENDER_START_TIME', 'Start Time');  
	define('CALENDER_END_TIME', 'End Time');  
	define('CALENDER_CREATED_BY', 'Created by');  

	//support 
	define('SUPPORT_CREATE_TICKETS', 'Create Tickets');  
	define('SUPPORT_TITLE', 'Title');  
	define('SUPPORT_DESCRIPTION', 'Description');
	define('SUPPORT_CREATE', 'Create');
	define('SUPPORT_CANCEL', 'Cancel');
	define('SUPPORT_UPDATE_TICKET', 'Update Ticket');
		
}

if($fmc_language == "arabic"){
	
	//Sidebar profile /sidebar.php
	define('SIDEBAR_PROFILE_TITLE', 'Welcome 1');
		//Sidebar profile popup menu /sidebar.php
		define('SIDEBAR_MY_PROFILE', 'My profile 1');
		define('SIDEBAR_MESSAGES', 'Messages 1');
		define('SIDEBAR_POPUP_SETTINGS', 'Settings 1');
		define('SIDEBAR_LOGOUT', 'Logout 1');
		//End Sidebar profile popup menu /sidebar.php

	define('SIDEBAR_DASHBOARD', 'Dashboard 1');
	define('SIDEBAR_CLIENT_LOGIN', 'Client Login 1');
	define('SIDEBAR_CLIENT_LOGOUT', 'Client Logout 1');
	
	define('SIDEBAR_DEPARTMENTS', 'Departments 1');
	define('SIDEBAR_DIVISION', 'Division 1');
	define('SIDEBAR_FMC_USERS', 'FMC Users 1');
	define('SIDEBAR_CLIENTS', 'Clients 1');
	define('SIDEBAR_SETTINGS', 'Settings 1');
	define('SIDEBAR_DOCUMENT_CATEGORY', 'Document Category 1');
	define('SIDEBAR_COMPANY_STRUCTURE_TYPE', 'Company Structure Type 1');
	define('SIDEBAR_LEGAL_ENTITIES', 'Legal Entities 1');
	define('SIDEBAR_COUNTRIES', 'Countries 1');
	define('SIDEBAR_REGIONS', 'Regions 1');
	define('SIDEBAR_CITY', 'City 1');
	define('SIDEBAR_MAIN_ACTIVITIES', 'Main Activities 1');
	define('SIDEBAR_FMC_SALARY_COMPONENT', 'Salary Components 1');
	define('SIDEBAR_FMC_LEAVE_MANAGEMENT', 'Leave Management 1');
	define('SIDEBAR_CLIENT_REQUIRED_DOCUMENTS', 'Client Required Documents 1');
	define('SIDEBAR_MEDICAL_CATEGORIES', 'Medical Categories 1');
	define('SIDEBAR_WARNING_CATEGORY', 'Warning Category 1');

	//common delete msg
	define('R_U_SURE', 'Are you sure ? 1');
	define('RECOVER_RECORD', 'You will not be able to recover this record! 1');
	define('YES', 'Yes, delete it! 1');

	//company_sidebar  // company_sidebar.php
	define('COMPANY_SIDEBAR_DASHBOARD', 'HR Dashboard 1');
	define('COMPANY_SIDEBAR_COMP_ADMIN_SETTINGS', 'Company Admin Settings 1');
	define('COMPANY_SIDEBAR_SALARY_COMPONENTS', 'Salary Components 1');
	define('COMPANY_SIDEBAR_LEAVE_MANAGEMENT', 'Leave Management 1');
	define('COMPANY_SIDEBAR_COMPANY_STRUCTURE', 'Company Organisation Chart 1');
	define('COMPANY_SIDEBAR_COMPANY_DEPARTMENT', 'Company Departments 1');
	define('COMPANY_SIDEBAR_COMPANY_DESIGNATION', 'Position Titles 1');
	define('COMPANY_SIDEBAR_COMPANY_REQUEST_TYPE', 'Request Types 1');
	define('COMPANY_SIDEBAR_COMPANY_EMPLOYEE', 'Employees 1');
	define('COMPANY_SIDEBAR_COMPANY_PAYROLL', 'Payroll 1');
	define('COMPANY_SIDEBAR_COMPANY_GENERATE_PAYROLL', 'Generate Payroll 1');
	define('COMPANY_SIDEBAR_RECRUITMENT', 'Recruitment 1');
	define('COMPANY_SIDEBAR_JOB_POSITIONS', 'Job Positions 1');
	define('COMPANY_SIDEBAR_JOB_OPENINGS', 'Job Openings 1');
	define('COMPANY_SIDEBAR_ATTENDANCE', 'Attendance 1');
	define('COMPANY_SIDEBAR_MANAGE_ATTENDANCE', 'Manage Attendance 1');
	define('COMPANY_SIDEBAR_ASSETS', 'Assets 1');
	define('COMPANY_SIDEBAR_WARNING', 'Warning 1');
	define('COMPANY_SIDEBAR_COMPANY_DOCUMENTS', 'Company Documents 1');

	//Navbar  navbar.php
	define('NAVBAR_START_CLIENT_LOGIN', 'Start Client Login 1');
	define('NAVBAR_QUICK_ACCESS', 'Quick Access 1');
		//Navbar Popup menu /navbar.php
		define('NAVBAR_CREATE_NEW_CLIENT', 'Create New Client 1');
		define('NAVBAR_CREATE_STAFF', 'Create Staff 1');
		define('NAVBAR_VIEW_PAYROLL', 'View Payroll 1');
		define('NAVBAR_LEAVE_MANAGEMENT', 'Leave Management 1');
		define('NAVBAR_DASHBOARD', 'Dashboard 1');
		//End Navbar Popup menu /navbar.php

	define('NAVBAR_CALENDAR', 'Calendar 1');
	define('NAVBAR_NORTIFICATION', 'Notification 1');
	define('NAVBAR_LOGOUT', 'Logout 1');
	define('NAVBAR_LANGUAGE', 'Language 1');
	define('NAVBAR_SUPPORT', 'Support 1');

	//COMPANY_navbar  // company_navbar.php
	define('COMPANY_NAVBAR_START_CLIENT_LOGIN', 'Start Client Login 1');
	define('COMPANY_NAVBAR_QUICK_ACCESS', 'Quick Access 1');
	define('COMPANY_NAVBAR_CREATE_NEW_CLIENT', 'Create New Client 1');
	define('COMPANY_NAVBAR_CREATE_STAFF', 'Create Staff 1');
	define('COMPANY_NAVBAR_VIEW_PAYROLL', 'View Payroll 1');
	define('COMPANY_NAVBAR_LEAVE_MANAGEMENT', 'Leave Management  1');
	define('COMPANY_NAVBAR_DASHBOARD', 'Dashboard 1');
	define('COMPANY_NAVBAR_CALENDAR', 'Calendar 1');
	define('COMPANY_NAVBAR_NORTIFICATION', 'Notification 1');
	define('COMPANY_NAVBAR_NORTIFICATION_DETAIL', 'You have 4 new Notifications 1');
	define('COMPANY_NAVBAR_CAMPAIGN', 'Campaign 1');
	define('COMPANY_NAVBAR_HOLIDAY', 'Holiday Sale 1');
	define('COMPANY_NAVBAR_IS_NEARLY', 'is nearly reach budget limit. 1');
	define('COMPANY_NAVBAR_TODAY', '10:00 AM Today 1');
	define('COMPANY_NAVBAR_YOUR_NEW_CAMPAIGN', 'Your New Campaign 1');
	define('COMPANY_NAVBAR_HOLIDAY_SALE', 'Holiday Sale 1');
	define('COMPANY_NAVBAR_IS_APPROVED', 'is approved. 1');	
	define('COMPANY_NAVBAR_TIME', '11:30 AM Today 1');
	define('COMPANY_NAVBAR_WEB', 'Website visits from Twitter is 27% higher than last week. 1');
	define('COMPANY_NAVBAR_PM', '04:00 PM Today. 1');
	define('COMPANY_NAVBAR_ERROR', 'Error on website analytics configurations 1');
	define('COMPANY_NAVBAR_YESTERDAY', 'Yesterday 1');
	define('COMPANY_NAVBAR_SEE_ALL', 'See all notifications 1');
	define('COMPANY_NAVBAR_LOGOUT', 'Logout 1');
	define('COMPANY_NAVBAR_SUPPORT', 'Support 1');
	 
	//company dashboard //company_dashboard.php
	define('COMPANY_DASHBOARD_TITLE', 'Dashboard 1');
	define('COMPANY_PENDING_REQUEST', 'Pending Request 1');
	
	//salary component //salary_component.php
	define('SALARY_COMPONENT', 'Salary Components 1');
	define('SALARY_COMPONENT_LIST', 'Salary Components list 1');
	define('SALARY_COMPONENT_ADD', 'Add Salary Component 1');
	define('SALARY_COMPONENT_NAME', 'Name 1');
	define('SALARY_COMPONENT_TYPE', 'Component Type 1');
	define('SALARY_COMPONENT_CALCULATION', 'Calculation Type 1');
	define('SALARY_COMPONENT_VALUE', 'Value 1');
	define('SALARY_COMPONENT_CREATE', 'Create Salary Component 1');
	define('SALARY_COMPONENT_EARNING', 'Earning 1');
	define('SALARY_COMPONENT_DEDUCTION', 'Deduction 1');
	define('SALARY_COMPONENT_NAME_IN_PAYSLIP', 'Name in Payslip 1');
	define('SALARY_COMPONENT_FLATE_AMOUNT', 'Flat Amount 1');
	define('SALARY_COMPONENT_PERCENTAGE', 'Percentage of Basic 1');
	define('SALARY_COMPONENT_ENTER_AMMOUNT', 'Enter Amount 1');
	define('SALARY_COMPONENT_ENTER_PER', 'Enter Percentage 1');
	define('SALARY_COMPONENT_CANCEL', 'Cancel 1');
	define('SALARY_COMPONENT_UPDATE', 'Update Salary Component 1');
	define('SALARY_COMPONENT_SAVE_SALARY', 'Save Salary Component 1');
	
	//leave management //leave_management.php
	define('LEAVE_MANAGEMENT_TITLE', 'Leave Management 1');
	define('LEAVE_MANAGEMENT_TYPES', 'Leave Types 1');
	define('LEAVE_MANAGEMENT_GROUPS', 'Leave Groups 1');
	define('LEAVE_MANAGEMENT_HOLIDAYS', 'Holidays 1');
	define('LEAVE_MANAGEMENT_HOLIDAYS_GROUP', 'Holiday Group 1');
	define('LEAVE_MANAGEMENT_WORK_WEEK', 'Work Week 1');
	define('LEAVE_MANAGEMENT_WORK_SHIFT', 'Work Shift 1');
	define('LEAVE_MANAGEMENT_ADD_NEW', 'Add New Leave Type 1');
	define('LEAVE_MANAGEMENT_NAME', 'Name 1');
	define('LEAVE_MANAGEMENT_COLOR', 'Color 1');
	define('LEAVE_MANAGEMENT_ADD_NEW_L_GROUP', 'Add New Leave Group 1');
	define('LEAVE_MANAGEMENT_ADD_NEW_HOLIDAY', 'Add New Holiday 1');
	define('LEAVE_MANAGEMENT_DATE', 'Date 1*');
	define('LEAVE_MANAGEMENT_ADD_NEW_H_GROUP', 'Add New Holiday Group 1');
	define('LEAVE_MANAGEMENT_ADD_NEW_WORK_WEEK', 'Add New Work Week 1');
	define('LEAVE_MANAGEMENT_WORK_WEEK_NAME', 'Work Week Name 1*');
	define('LEAVE_MANAGEMENT_DAY', 'Days 1');
	define('LEAVE_MANAGEMENT_ADD_WORK_SHIFT', 'Add New Work Shift 1');
	define('LEAVE_MANAGEMENT_WORK_SHIFT_NAME', 'Work Shift Name 1');
	define('LEAVE_MANAGEMENT_START_TIME', 'Start-Time 1');
	define('LEAVE_MANAGEMENT_END_TIME', 'End-Time 1');	
	define('LEAVE_MANAGEMENT_LEAVE_TYPE_TITLE', 'Leave type title 1*');
	define('LEAVE_MANAGEMENT_LEAVE_DAYS', 'Leave Days 1*');
	define('LEAVE_MANAGEMENT_LEAVE_COLORS', 'Leave Colors 1');
	define('LEAVE_MANAGEMENT_ADD', 'Add 1');
	define('LEAVE_MANAGEMENT_CLOSE', 'Close 1');
	define('LEAVE_MANAGEMENT_UPDATE_LEAVE_TYPE', 'Update Leave Type 1');
	define('LEAVE_MANAGEMENT_SAVE', 'Save 1');
	define('LEAVE_MANAGEMENT_UPDATE_LEAVE_GROUP', 'Update Leave Group 1');
	define('LEAVE_MANAGEMENT_HOLIDAY_TITLE', 'Holiday Title 1*');
	define('LEAVE_MANAGEMENT_DESCRIPTION', 'Description 1');
	define('LEAVE_MANAGEMENT_UPDATE_HOLIDAY', 'Update Holiday 1');
	define('LEAVE_MANAGEMENT_UPDATE_H_GROUP', 'Update Holiday Group 1');
	define('LEAVE_MANAGEMENT_HOLIDAY_G_TITLE', 'Holiday Group Title 1*');
	define('LEAVE_MANAGEMENT_MONDAY', 'Monday 1');
	define('LEAVE_MANAGEMENT_THURSDAY', 'Thursday 1');
	define('LEAVE_MANAGEMENT_SUNDAY', 'Sunday 1');
	define('LEAVE_MANAGEMENT_TUESDAY', 'Tuesday 1');
	define('LEAVE_MANAGEMENT_FRIDAY', 'Friday 1');
	define('LEAVE_MANAGEMENT_WEDNESDAY', 'Wednesday 1');
	define('LEAVE_MANAGEMENT_SATURDAY', 'Saturday 1');
	define('LEAVE_MANAGEMENT_UPDATE_WORK_WEEK', 'Update Work Week 1');
	define('LEAVE_MANAGEMENT_STARTTIME', 'Start-Time (12 hour) 1');
	define('LEAVE_MANAGEMENT_PLACEHOLDER', 'Ex: 11:59 pm 1');
	define('LEAVE_MANAGEMENT_ENDTIME', 'End-Time (12 hour) 1');
	define('LEAVE_MANAGEMENT_SIFT_NAME', 'Shift-Name 1*');
	define('LEAVE_MANAGEMENT_UPDATE_WORK_SHIFT', 'Update work shift 1');
	define('LEAVE_MANAGEMENT_LEAVE_G_TITLE', 'Leave Group Title 1*');

	//company structure //company_structure.php
	define('COMPANY_STRUCTURE', 'Company Organisation Chart 1');
	define('COMPANY_STRUCTURE_LIST', 'List 1');
	define('COMPANY_STRUCTURE_ADD', 'Add Company Organisation Chart 1');	
	define('COMPANY_STRUCTURE_LIST_VIEW', 'Company Organisation Chart List View 1');	
	define('COMPANY_STRUCTURE_TREE_VIEW', 'Company Organisation Chart Tree View 1');	
	define('COMPANY_STRUCTURE_DESIGNATION_NAME', 'Designation Name 1');	
	define('COMPANY_STRUCTURE_PARENT', 'Parent 1');	
	define('COMPANY_STRUCTURE_CREATE', 'Create Company Organisation Chart 1');	
	define('COMPANY_STRUCTURE_TYPE', 'Type 1');	
	define('COMPANY_STRUCTURE_SELECT_TYPE', 'Select Type 1');	
	define('COMPANY_STRUCTURE_SELECT_PARENT', 'Select Parent 1');	
	define('COMPANY_STRUCTURE_DETAILS', 'Details 1');
	define('COMPANY_STRUCTURE_CANCEL', 'Cancel 1');
	define('COMPANY_STRUCTURE_UPDATES', 'Update Company Organisation Chart 1');
	define('COMPANY_STRUCTURE_SAVE', 'Save Company Organisation Chart 1');
	
	//company department //company_department.php
	define('COMPANY_DEPARTMENT_TITLE', 'Departments 1');
	define('COMPANY_DEPARTMENT_ADD_DEPARTMENT', 'Add Department 1');
	define('COMPANY_DEPARTMENT_NAME', 'Department Name 1');
	define('COMPANY_DEPARTMENT_PLSH_NAME', 'Department Name 1*');
	define('COMPANY_DEPARTMENT_ADD', 'Add 1');
	define('COMPANY_DEPARTMENT_CLOSE', 'CLOSE 1');
	define('COMPANY_DEPARTMENT_UPDATE', 'Update Department 1');
	define('COMPANY_DEPARTMENT_SAVE', 'Save 1');
	

	//designation //designation.php
	define('DESIGNATION_TITLE', 'Position Titles 1');
	define('DESIGNATION_LIST', 'List 1');
	define('DESIGNATION_ADD', 'Add Position Title 1');
	define('DESIGNATION_LIST_VIEW', 'Position Titles List View 1');
	define('DESIGNATION_TREE_VIEW', 'Position Titles Tree View 1');
	define('DESIGNATION_NAME', 'Position Title Name 1');
	define('DESIGNATION_PARENT', 'Parent 1');
	define('DESIGNATION_UPDATE', 'Update Position Title 1');
	define('DESIGNATION_DETAILS', 'Details 1');
	define('DESIGNATION_SELECT_PARENT', 'Select Parent 1');
	define('DESIGNATION_SAVE', 'Save Position Title 1');
	define('DESIGNATION_CANCEL', 'Cancel 1');
	define('DESIGNATION_CREATE', 'Create Position Title 1');

	//request type //request_type.php
	define('REQUEST_TYPE_TITLE', 'Request Types 1');
	define('REQUEST_TYPE_LIST', 'Request Type List 1');
	define('REQUEST_TYPE_ADD', 'Add Request Type 1');
	define('REQUEST_TYPE_NAME', 'Request Name 1');
	define('REQUEST_TYPE_PARENT', 'Parent 1');
	define('REQUEST_TYPE_CREATE', 'Create Request Type 1');
	define('REQUEST_TYPE_DESCRIPTION', 'Description 1');
	define('REQUEST_TYPE_SELECT_PARENT', 'Select Parent 1');
	define('REQUEST_TYPE__CANCEL', 'Cancel 1');
	define('REQUEST_TYPE_UPDATE', 'Update Request Type 1');
	define('REQUEST_TYPE_SAVE_REQUEST', 'Save Request Type 1');

	//payroll //payroll.php
	define('PAYROLL_TITLE', 'Payroll 1');
	define('PAYROLL_LIST', 'List 1');
	define('PAYROLL_GENERATE_NEW', 'Generate New Payroll 1');
	define('PAYROLL_EMPLOYEE_NAME', 'Employee Name 1');
	define('PAYROLL_PAYROLL_DATE', 'Payroll Date 1');
	define('PAYROLL_FINAL_SALARY', 'Final-Salary 1');
	define('PAYROLL_STATUS', 'Status 1');
	define('PAYROLL_CREATE', 'Create 1');
	define('PAYROLL_SELECT_EMPLOYEE', 'Select Employee 1');
	define('PAYROLL_FROM_DATE', 'From date 1');
	define('PAYROLL_TO_DATE', 'To date 1');
	define('PAYROLL_DETAILS', 'Details 1');
	define('PAYROLL_GENERATE', 'Generate Payroll 1');
	define('PAYROLL_CANCEL', 'Cancel 1');
	define('PAYROLL_UPDATE', 'Update 1');
	define('PAYROLL_UPDATE_PAYROLL', 'Update Payroll 1');

	//company documents //company_documents.php
	define('COMPANY_DOCUMENTS_TITLE', 'Company Documents 1');
	define('COMPANY_DOCUMENTS_LIST', 'Company Documents list 1');
	define('COMPANY_NEW_DOCUMENTS', 'Add new Company Documents 1');
	define('COMPANY_SELECT_CATEGORY', 'Select Category 1');
	define('COMPANY_SELECT_ALL', 'All 1');
	define('COMPANY_SEARCH', 'Search 1');
	define('COMPANY_DOC_CAT_NAME', 'Document Category Name 1');
	define('COMPANY_TITLE', 'Title 1');
	define('COMPANY_DESCRIPTIONS', 'Descriptions 1');
	define('COMPANY_EXPIRYDATE', 'ExpiryDate 1');
	define('COMPANY_DOC_CAT', 'Document Categories 1');
	define('COMPANY_TITLE_PLSH', 'Title of the company Documents 1');
	define('COMPANY_DRAG_DROP', 'Drag & Drop files here 1');
	define('COMPANY_DOC_FILE', 'Document File 1');
	define('COMPANY_SIZE_FILE', 'size : 200 x 200 px 1');
	define('COMPANY_FILE_TYPE', '.PDF .DOC .DOCX .JPG .JPEG .PNG 1');
	define('COMPANY_BROWSE_FILE', 'Browse Files 1');
	define('COMPANY_DATE_OF_EXPIRY', 'Date of expiry 1');
	define('COMPANY_ADD', 'Add 1');
	define('COMPANY_CLOSE', 'Close 1');
	define('COMPANY_UPDATE', 'Update Company Documents 1');

	//manage attendance //attandance_manage.php
	define('ATTANDANCE_TITLE', 'Manage Attendance 1');
	define('ATTANDANCE_PRESENT', 'P - Present 1'); 
	define('ATTANDANCE_ABSENT', 'A - Absent 1'); 
	define('ATTANDANCE_HALF_DAY', 'HL - Half Leave 1'); 
	define('ATTANDANCE_HOLIDAY', 'H - Holiday'); 
	define('ATTANDANCE_FULL_DAY', 'FL - Full Leave 1'); 
	define('ATTANDANCE_SELECT_YEAR', 'Select Year 1'); 
	define('ATTANDANCE_SELECT_MONTH', 'Select Month 1'); 
	define('ATTANDANCE_JANUARY', 'January 1'); 
	define('ATTANDANCE_FEBRUARY', 'February 1'); 
	define('ATTANDANCE_MARCH', 'March 1'); 
	define('ATTANDANCE_APRIL', 'April 1'); 
	define('ATTANDANCE_MAY', 'May 1'); 
	define('ATTANDANCE_JUNE', 'June 1'); 
	define('ATTANDANCE_JULY', 'July 1'); 
	define('ATTANDANCE_AUGUST', 'August 1'); 
	define('ATTANDANCE_SEPTEMBER', 'September 1'); 
	define('ATTANDANCE_OCTOMBER', 'Octomber 1'); 
	define('ATTANDANCE_NOVEMBER', 'November 1'); 
	define('ATTANDANCE_DECEMBER', 'December 1'); 
	define('ATTANDANCE_SELECT_DEPARTMENT', 'Select Departmemt 1'); 
	define('ATTANDANCE_SELECT_ALL', 'All 1'); 
	define('ATTANDANCE_SELECT_DESIGNATION', 'Select Designation 1'); 
	define('ATTANDANCE_SEARCH', 'Search 1'); 
	define('ATTANDANCE_EMPLOYEE', 'Employee 1'); 
	define('ATTANDANCE_UPDATE', 'Update Attendance 1');  
	define('ATTANDANCE_SELECT_ATTANDANCE', 'Select Attendance 1');  
	define('ATTANDANCE_SELECT_ABSENT', 'Absent 1'); 
	define('ATTANDANCE_SELECT_PRESENT', 'Present 1'); 
	define('ATTANDANCE_SELECT_HALF_DAY', 'Half-Leave 1'); 
	define('ATTANDANCE_SELECT_FULL_DAY', 'Full-Leave 1'); 
	define('ATTANDANCE_DATE', 'Date 1'); 
	define('ATTANDANCE_DESCRIPTION', 'Description 1'); 
	define('ATTANDANCE_DRAG', 'Drag &amp; Drop files here 1'); 
	define('ATTANDANCE_BROWSE_FILE', 'Browse File 1'); 
	define('ATTANDANCE_ADD', 'Add 1'); 
	define('ATTANDANCE_ADD_TITLE', 'Add Attendance 1'); 
	define('ATTANDANCE_ADD_BREADCRUMBS_TITLE_1', 'Attendance'); 
	define('ATTANDANCE_ADD_BREADCRUMBS_TITLE_2', 'Add'); 

	define('ATTANDANCE_ADD_CONFIRM_TITLE', 'Confirm Attendance 1'); 
	define('ATTANDANCE_ADD_CONFIRM_BREADCRUMBS_TITLE_1', 'Attendance 1'); 
	define('ATTANDANCE_ADD_CONFIRM_BREADCRUMBS_TITLE_2', 'Add 1'); 
	define('ATTANDANCE_ADD_CONFIRM_BREADCRUMBS_TITLE_3', 'Confirm 1'); 

	define('ATTANDANCE_CLOSE', 'Close 1'); 

	//job positions job_positions.php
	define('JOB_POSITIONS_TITLE', 'Job Positions 1'); 
	define('JOB_POSITIONS_ADD', 'Add New Job-Position 1');  
	define('JOB_POSITIONS_LIST_VIEW', 'Position list view 1');  
	define('JOB_POSITIONS_TREE_VIEW', 'Position tree view 1');  
	define('JOB_POSITIONS_JOB_TITLE', 'Job Title 1');
	define('JOB_POSITIONS_DESIGNATION', 'Designation 1');
	define('JOB_POSITIONS_EMPLOYEE_NAME', 'Employee Name 1');
	define('JOB_POSITIONS_UNDER_DESIGNATION', 'Under Designation/Person 1');
	define('JOB_POSITIONS_STATUS', 'Status 1');
	define('JOB_POSITIONS_CREATE', 'Create Job-Position 1');
	define('JOB_POSITIONS_SELECT', 'Select Designation 1');
	define('JOB_POSITIONS_PARENT_EMPLOYEE', 'Parent Employee 1');
	define('JOB_POSITIONS_SELECT_PARENT_EMPLOYEE', 'Select Parent Employee 1');
	define('JOB_POSITIONS_NO_OF_POSITIONS', 'No Of Positions 1');
	define('JOB_POSITIONS_DESCRIPTION', 'Descriptions 1');
	define('JOB_POSITIONS_CRATE_JOB', 'Create Job-Position 1');
	define('JOB_POSITIONS_CANCEL', 'Cancel 1');
	define('JOB_POSITIONS_UPDATE', 'Update Job-Position 1');
	define('JOB_POSITIONS_SAVE', 'Save Job-Position 1');
	
	//job opening //job_openings.php
	define('JOB_OPENIG_TITLE', 'Job Openings 1');
	define('JOB_OPENIG_ADD_JOB', 'Add New Job-Openings 1');
	define('JOB_OPENIG_CREATE_JOB', 'Create Job-Position 1');
	define('JOB_OPENIG_JOB_DESIGNATION', 'Job-Designation 1');
	define('JOB_OPENIG_SELECT_POSITION', 'Select Position 1');
	define('JOB_OPENIG_NO_OF_VACANCY', 'No Of Vacancy 1');
	define('JOB_OPENIG_DESCRIPTION', 'Description 1');
	define('JOB_OPENIG_STATUS', 'Status 1');
	define('JOB_OPENIG_SELECT_STATUS', 'Select Status 1');
	define('JOB_OPENIG_OPEN', 'Open 1');
	define('JOB_OPENIG_CLOSED', 'Closed 1');
	define('JOB_OPENIG_IN_PROGRESS', 'In-Progress 1');
	define('JOB_OPENIG_CREATE_JOB_OPEN', 'Create Job-Opening 1');
	define('JOB_OPENIG_CANCEL', 'Cancel 1');
	define('JOB_OPENIG_JOB_POSITIONS', 'Job-Positions 1');
	define('JOB_OPENIG_CREATE_JOB_POSITION', 'Create Job-Position 1');
	define('JOB_OPENIG_JOB_TITLE', 'Job Title 1');
	define('JOB_OPENIG_SELECT_DESIGNATION', 'Select Designation 1');
	define('JOB_OPENIG_SAVE_JOB_OPENING', 'Save Job-Opening 1');
	
	//assets //assets.php
	define('ASSETS_TITLE', 'Assets 1');
	define('ASSETS_LIST', 'Assets list 1');
	define('ASSETS_TYPE', 'Assets type 1');
	define('ASSETS_MANUFACTURER', 'Manufacturer 1');
	define('ASSETS_ITEM', 'Assets item 1');
	define('ASSETS_ASSIGNED', 'Assigned assets 1');
	define('ASSETS_RETURN', 'Retun assets 1');
	define('ASSETS_ADD_NEW', 'Add new assets type 1');
	define('ASSETS_TYPE_TITLE', 'Assets Type Title 1');
	define('ASSETS_NEW_MANUFACTURER', 'Add new manufacturer 1');
	define('ASSETS_MANUFACTURER_NAME', 'Manufacture Name 1');
	define('ASSETS_NOTES', 'Notes 1');
	define('ASSETS_ADD_NEW_ITEM', 'Add new item 1');
	define('ASSETS_ITEM_NAME', 'Item Name 1');
	define('ASSETS_ITEM_ID', 'Item ID 1');
	define('ASSETS_SERIAL_NUMBER', 'Serial Number 1');	
	define('ASSETS_MODEL', 'Model 1');	
	define('ASSETS_CONDITIONS', 'Condition 1');	
	define('ASSETS_ASSIGN_ITEM', 'Assign item to user 1');	
	define('ASSETS_STATUS', 'Is-Assigned 1');
	define('ASSETS_USER', 'User 1');	
	define('ASSETS_CONDITION', 'Asset Condition 1');	
	define('ASSETS_ASSIGNED_DATE', 'Assigned Date 1');	
	define('ASSETS_RETURN_ASSETS', 'Return assets 1');	
	define('ASSETS_ADD_RETURN_ITEM', 'Add return item 1');	
	define('ASSETS_RETURN_DATE', 'Return Date 1');	
	define('ASSETS_ADD_NEW_TYPE', 'Add new assets type 1');	
	define('ASSETS_ADD', 'Add 1');	
	define('ASSETS_CLOSE', 'Close 1');
	define('ASSETS_UPDATE_TYPE', 'Update Assets type 1');
	define('ASSETS_SAVE', 'Save 1');
	define('ASSETS_CANCEL', 'Cancel 1');
	define('ASSETS_ADD_NEW_MANUFACTURER', 'Add new manufacturer 1');
	define('ASSETS_UPDATE_MANUFACTURER', 'Update manufacturer 1');
	define('ASSETS_SELECT_MANUFACTURER', 'Select Manufacturer 1');
	define('ASSETS_SELECT_TYPE', 'Select assets type 1');
	define('ASSETS_SELECT_CONDITIONS', 'Select condition 1');
	define('ASSETS_NEW', 'New 1');
	define('ASSETS_USED', 'Used 1');
	define('ASSETS_PARTIALLY_DAMAGED', 'Partially Damaged 1');
	define('ASSETS_FULLY_DAMAGED', 'Fully Damaged 1');
	define('ASSETS_DRAG_DROP', 'Drag & Drop files here 1');
	define('ASSETS_DOC_FILE', 'Document File 1');
	define('ASSETS_SIZE', 'size : 200 x 200 px 1');
	define('ASSETS_TYPES', 'PDF.DOC.DOCX.PNG.JPG.JPEG  1');
	define('ASSETS_BROWSE_FILE', 'Browse Files 1');	
	define('ASSETS_UPDATE_ITEM', 'Update item 1');	
	define('ASSETS_RETURN_ASSIGN_TO_USER', 'Return assign to users1');	
	define('ASSETS_SELECT_USER', 'Select User 1');	
	define('ASSETS_SELECT_ITEM', 'Select Item 1');	
	define('ASSETS_DATE_OF_RETURN', 'Date of Return 1');	
	define('ASSETS_UPDATE', 'Update 1');	
	define('ASSETS_DATE_OF_ASSIGN', 'Date of Assign 1');	
	define('ASSETS_UPDATE_ASSIGN_ITEM_TO_USERS', 'Update Assign item to users 1');	

	//assets //sssets_employee.php
	define('ASSETS_CURRENT', 'Current 1');
	define('ASSETS_PAST', 'Past  1');
	define('ASSETS_DETAILS', 'Asset Details 1');
	
	// Warning // warning.php
	define('WARNING_TITLE', 'Warning 1');
	define('WARNING_LIST', 'Warning List 1');
	define('WARNING_USER', 'User 1');
	define('WARNING_CATEGORY', 'Category 1');
	define('WARNING_TITLE_LIST', 'Title 1');
	define('WARNING_DESCRIPTION_LIST', 'Description 1');
	define('WARNING_DATE_TIME', 'Date & Time 1');
	define('WARNING_ADD_NEW', 'Add Warning 1');

	//employee //company_employee.php
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PAGE_TITLE', 'FMC Employee Details');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK', 'Share Public Link 1');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_TITLE', 'Share Public Link 1');	
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_EXPIRY_DATE', 'Link Expiry Date');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_PUBLIC_URL', 'Share Link 1');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_CLOSE_BTN', 'Close 1');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_SUBMIT_BTN', 'Submit 1');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_RESEND_BTN', 'Save & Resend 1');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_EMAIL', 'Email 1');	
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_FORM_SAVE', 'Save 1');	
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_FORM_SAVE_SUBMIT', 'Save & Submit');	

	define('COMPANY_EMPLOYEE_IMPORT_TITLE', 'Import Excel 1');
	define('COMPANY_EMPLOYEE_IMPORT_SELECT_FILE', 'Select Excel File 1');
	define('COMPANY_EMPLOYEE_IMPORT_SUB_BTN_TITLE', 'Import 1');
	define('COMPANY_EMPLOYEE_IMPORT_CAN_BTN_TITLE', 'Cancel 1');
	define('COMPANY_EMPLOYEE_IMPORT_CONFIRM_BTN_TITLE', 'Confirm 1');
	define('IMPORT_EMPLOYEE_CONFIRM_TITLE', 'Import Excel 1');

	define('COMPANY_EMPLOYEE_IMPORT_EMP_CODE', 'Employee Code 1');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_FULLNAME_ENG', 'Full-Name English 1');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_FULLNAME_ARA', 'Full-Name Arabic 1');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_MOBILE', 'Mobile 1');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_JOINING_DATE', 'Joining-Date 1');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_ATTENDANCE_START_DATE', 'Attendance Start Date 1');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_EMAIL', 'Email 1');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_PER_EMAIL', 'Personal Email 1');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_PER_MOBILE', 'Personal Mobile 1');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_GENDER', 'Gender 1');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_BIRTHDATE', 'Birthdate 1');
	define('COMPANY_EMPLOYEE_IMPORT_EMP_NOTE', 'Note 1');
	

	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_TITLE', 'Personal Documents 1');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW', 'Add New Document');

	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_MODAL_POPUP_TITILE', 'Upload Document 1');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_UPDATE_MODAL_POPUP_TITILE', 'Update Document 1');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_TITLE', 'Document Title 1');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ISSUE_DATE', 'Date of Issue');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_EXPIRY_DATE', 'Date of Expire');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_DESCRIPTION', 'Description');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_DRAG_DROP', 'Drag & Drop files here');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_OR', 'or');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_SELECT_FILE', 'Select Document File');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_FILE_SIZE', 'size : 200 x 200 px');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_FILE_TYPES', '.PDF .DOC .DOCX .JPG .JPEG .PNG');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_BROWSE_BTN_TEXT', 'Browse Files 1');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ADD_BTN', 'Add');
	define('COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_CLOSE_BTN', 'Close');
	

	define('COMPANY_EMPLOYEE_TITLE', 'Company Employees 1');
	define('COMPANY_EMPLOYEE_LIST', 'Company Employees list 1');
	define('COMPANY_EMPLOYEE_ADD', 'Add New Employee 1');
	define('COMPANY_EMPLOYEE_FULL_NAME', 'Full Name 1'); 
	define('COMPANY_EMPLOYEE_LOGIN_DETAILS', 'Login Details 1');  
	define('COMPANY_EMPLOYEE_EMAIL', 'Email 1'); 
	define('COMPANY_EMPLOYEE_MOBILE', 'Mobile 1');
	define('COMPANY_EMPLOYEE_ENABLE_LOGIN', 'Enable Login 1');
	define('COMPANY_EMPLOYEE_EMPLOYEE', 'Employees 1'); 
	define('COMPANY_EMPLOYEE_UPDATE_ACCOUNT', 'Update Account Details 1'); 
	define('COMPANY_EMPLOYEE_CREATE_ACCOUNT', 'Create Account Details 1');  
	define('COMPANY_EMPLOYEE_ACCOUNT_DETAILS', 'Account Details 1');  
	define('COMPANY_EMPLOYEE_POSITIONAL_INFO', 'Positional Information 1');  
	define('COMPANY_EMPLOYEE_PERSONAL_INFO', 'Personal Information 1');  
	define('COMPANY_EMPLOYEE_EMERGENCY_CONTACT', 'Emergency Contact 1');  
	define('COMPANY_EMPLOYEE_QUALIFICATION', 'Qualification 1');  
	define('COMPANY_EMPLOYEE_WORK_EXP', 'Work Experience 1');  
	define('COMPANY_EMPLOYEE_LEAVE_DETAILS', 'Leave Details 1');  
	define('COMPANY_EMPLOYEE_SALARY_DETAILS', 'Salary Details 1');  
	define('COMPANY_EMPLOYEE_PROFILE_PIC', 'Profile Picture 1');  
	define('COMPANY_EMPLOYEE_PROFILE_PIC_SIZE', 'size : 200 x 200 px  1');  
	define('COMPANY_EMPLOYEE_PROFILE_PIC_TYPES', 'JPG , PNG , JPEG 1');  
	define('COMPANY_EMPLOYEE_DRAG_DROP', 'Drag & Drop files here 1');  
	define('COMPANY_EMPLOYEE_BROWSE_FILE', 'Browse Files 1');  
	define('COMPANY_EMPLOYEE_CODE', 'Employee Code 1');
	define('COMPANY_EMPLOYEE_NAME_ENGLISH', 'Employee Full Name - English 1');  
	define('COMPANY_EMPLOYEE_NAME_ARABIC', 'Employee Full Name - Arabic  1');  
	define('COMPANY_EMPLOYEE_PASSWORD', 'Password 1');  
	define('COMPANY_EMPLOYEE_CONFIRM_PASS', 'Confirm Password 1');  
	define('COMPANY_EMPLOYEE_JOINING_DATE', 'Joining Date  1');  
	define('COMPANY_EMPLOYEE_ATTENDANCE_START_DATE', 'Attendance Start Date 1');  
	define('COMPANY_EMPLOYEE_SAVE', 'Save 1');  
	define('COMPANY_EMPLOYEE_NEXT', 'Next 1');  
	define('COMPANY_EMPLOYEE_DEPARTMENT', 'Departments 1');  
	define('COMPANY_EMPLOYEE_SELECT_DEPARTMENT', 'Select Department 1');
	define('COMPANY_EMPLOYEE_DESIGNATION', 'Position Title 1');  
	define('COMPANY_EMPLOYEE_SELECT_DESIGNATION', 'Select Position Title 1');  
	define('COMPANY_EMPLOYEE_JOB_POSITIONS', 'Job Position 1');  
	define('COMPANY_EMPLOYEE_SELECT_JOB_POSITIONS', 'Select Job-Position 1');  
	define('COMPANY_EMPLOYEE_SKIP', 'Skip 1');  
	define('COMPANY_EMPLOYEE_PREVIOUS', 'Previous 1');  
	define('COMPANY_EMPLOYEE_PERSONAL_EMAIL', 'Personal Email 1');  
	define('COMPANY_EMPLOYEE_PERSONAL_MOBILE', 'Personal Mobile 1');  
	define('COMPANY_EMPLOYEE_GENDER', 'Gender 1');  
	define('COMPANY_EMPLOYEE_SELECT_GENDER', 'Select Gender');
	define('COMPANY_EMPLOYEE_MALE', 'Male 1');  
	define('COMPANY_EMPLOYEE_FEMALE', 'FeMale 1');  
	define('COMPANY_EMPLOYEE_NATIONALITY', 'Nationality 1');  
	define('COMPANY_EMPLOYEE_SELECT_NATIONALITY', 'Select Nationality 1');  
	define('COMPANY_EMPLOYEE_SOSM', 'Son of Saudi Mother 1');  
	define('COMPANY_EMPLOYEE_NO_NATIONALITY', 'No Nationality 1');  
	define('COMPANY_EMPLOYEE_PASSPORT_NUMBER', 'Passport Number 1');  
	define('COMPANY_EMPLOYEE_PASSPORT_ISSUE_PLACE', 'Passport Issue Place 1');  
	define('COMPANY_EMPLOYEE_PASSPORT_EXPIRY_DATE', 'Passport Expiry Date 1');  
	define('COMPANY_EMPLOYEE_GOSI_NUMBER', 'GOSI Number 1');  
	define('COMPANY_EMPLOYEE_ID_NUMBER', 'ID Number 1');  
	define('COMPANY_EMPLOYEE_BORTHDATE', 'Birthdate 1');  
	define('COMPANY_EMPLOYEE_COUNTRY', 'Country 1');  
	define('COMPANY_EMPLOYEE_SELECT_COUNTRY', 'Select Country 1');  
	define('COMPANY_EMPLOYEE_SOCIAL_STATUS', 'Social Status 1');  
	define('COMPANY_EMPLOYEE_MARRIED', 'Married 1');  
	define('COMPANY_EMPLOYEE_SINGLE', 'Single 1');  
	define('COMPANY_EMPLOYEE_NO_OF_DEPENDENT', 'Number Of Dependent 1');  
	define('COMPANY_EMPLOYEE_RELIGION', 'Region 1');  
	define('COMPANY_EMPLOYEE_KINGDOM_REGION', 'Region');  
	define('COMPANY_EMPLOYEE_SOCIAL_RELIGION', 'Social Religion 1');  
	define('COMPANY_EMPLOYEE_MUSLIM', 'Muslim 1');  
	define('COMPANY_EMPLOYEE_NON_MUSLIM', 'Non-Muslim 1');  
	define('COMPANY_EMPLOYEE_ADD_MOTHER_CITY', 'Address in mother city 1');  
	define('COMPANY_EMPLOYEE_ADDRESS', 'Address 1');  
	define('COMPANY_EMPLOYEE_CITY', 'City 1');  
	define('COMPANY_EMPLOYEE_STATE', 'State 1'); 

	define('COMPANY_EMPLOYEE_BANK_DETAIL', 'Bank Details 1');
	define('COMPANY_EMPLOYEE_BANK_NAME', 'Bank Name 1');
	define('COMPANY_EMPLOYEE_BANK_IBAN_NO', 'IBAN Number 1');
	define('COMPANY_EMPLOYEE_BANK_ACCOUNT_NO', 'Bank Account Number 1');
	define('COMPANY_EMPLOYEE_BANK_ID_NUMBER', 'ID Number 1');

	define('COMPANY_EMPLOYEE_MEDICAL_DETAILS', 'Medical Details');
	define('COMPANY_EMPLOYEE_MEDICAL_COMPANY_NAME', 'Company Name 1');
	define('COMPANY_EMPLOYEE_MEDICAL_CATEGORY', 'Medical Category 1');
	define('COMPANY_EMPLOYEE_MEDICAL_EXPIRY_DATE', 'Expiry Date 1');
	define('COMPANY_EMPLOYEE_MEDICAL_DOCUMENTS', 'Medical Documents 1');

	define('COMPANY_EMPLOYEE_EXTRA_BENIFIT', 'Employee Extra Benefit');
	define('COMPANY_EMPLOYEE_EXTRA_BENIFIT_TITLE', 'Title');
	define('COMPANY_EMPLOYEE_EXTRA_BENIFIT_NUMBER', 'Number');
	define('COMPANY_EMPLOYEE_EXTRA_BENIFIT_NOTE', 'Note');
	define('COMPANY_EMPLOYEE_EXTRA_BENIFIT_ADD_MORE', 'Add Employee Extra Benefits');

	define('COMPANY_EMPLOYEE_ADD_IN_KING', 'Address in Kingdom 1'); 
	define('COMPANY_EMPLOYEE_P_O_BOX', 'P,O,Box 1'); 
	define('COMPANY_EMPLOYEE_BUILDING_NO', 'Building No 1'); 
	define('COMPANY_EMPLOYEE_STREET_NAME', 'Street Name 1'); 
	define('COMPANY_EMPLOYEE_ZIP_CODE', 'Zip Code 1'); 
	define('COMPANY_EMPLOYEE_CONTACT_NAME', 'Contact Name 1'); 
	define('COMPANY_EMPLOYEE_RELATIONSHIP', 'Relationship 1'); 
	define('COMPANY_EMPLOYEE_ADD_MORE', 'Add More 1'); 
	define('COMPANY_EMPLOYEE_SPECIALIZATION', 'Specialization 1'); 
	define('COMPANY_EMPLOYEE_INSTITUTE', 'Institute/University Name 1'); 
	define('COMPANY_EMPLOYEE_FROM_YEAR', 'From Year 1'); 
	define('COMPANY_EMPLOYEE_SELECT_FROM_YEAR', 'Select From Year 1'); 
	define('COMPANY_EMPLOYEE_TO_YEAR', 'To Year 1'); 
	define('COMPANY_EMPLOYEE_SELECT_TO_YEAR', 'Select To Year 1'); 
	define('COMPANY_EMPLOYEE_POSITION', 'Position 1'); 
	define('COMPANY_EMPLOYER_NAME', 'Employer Name 1'); 
	define('COMPANY_EMPLOYEE_JOB_TASK', 'Job Task 1'); 
	define('COMPANY_EMPLOYEE_TOTAL_SALARY', 'Total Salary 1'); 
	define('COMPANY_EMPLOYEE_FROM_DATE', 'From Date 1'); 
	define('COMPANY_EMPLOYEE_TO_DATE', 'To Date 1'); 
	define('COMPANY_EMPLOYEE_LEAVE_WORK_DETAILS', 'Leave & Workshift Details 1'); 
	define('COMPANY_EMPLOYEE_SELECT_LEAVE_GROUP', 'Select Leave Group 1'); 
	define('COMPANY_EMPLOYEE_SELECT_HOLIDAY_GROUP', 'Select Holiday Group 1'); 
	define('COMPANY_EMPLOYEE_SELECT_WORK_WEEK_WORKSHIFT', 'Select Workweek & Workshift 1'); 
	define('COMPANY_EMPLOYEE_SELECT_WORK_WEEK', 'Select Workweek 1'); 
	define('COMPANY_EMPLOYEE_DAY', 'Day 1'); 
	define('COMPANY_EMPLOYEE_IS_WORKING', 'Is-Working 1'); 
	define('COMPANY_EMPLOYEE_SHIFT', 'Shift 1'); 
	define('COMPANY_EMPLOYEE_ANNUAL_CTC', 'Annual CTC: 1'); 
	define('COMPANY_EMPLOYEE_MONTHLY', 'Monthly: 1'); 
	define('COMPANY_EMPLOYEE_PREVIEW', 'Preview Salary Sleep 1'); 
	define('COMPANY_EMPLOYEE_EARNING_COMPONENTS', 'Earning Components 1'); 
	define('COMPANY_EMPLOYEE_EARNING_COMPO_WITH_SALARY', 'Earning component will add in salary 1');
	define('COMPANY_EMPLOYEE_NAME', 'Name 1');
	define('COMPANY_EMPLOYEE_COMMON_TYPE', 'Component Type 1');
	define('COMPANY_EMPLOYEE_AMOUNT', 'Amount 1');
	define('COMPANY_EMPLOYEE_VALUE', 'Value 1');
	define('COMPANY_EMPLOYEE_SAR', 'SAR 1');
	define('COMPANY_EMPLOYEE_DEDUCTION_COMPO', 'Deduction Components 1');
	define('COMPANY_EMPLOYEE_DEDUCTION_COMPO_SALARY', 'Deduction component will deduct from salary 1');
	define('COMPANY_EMPLOYEE_SAVE_CLOSE', 'Save & Close 1');
	define('COMPANY_EMPLOYEE_SALARY_SLEEP', 'Salary Sleep 1');
 	define('COMPANY_EMPLOYEE_EARNINGS', 'Earnings 1');
 	define('COMPANY_EMPLOYEE_DEDUCTION', 'Deductions 1');
 	define('COMPANY_EMPLOYEE_TOTAL_EARNING', 'Total Earning 1');
 	define('COMPANY_EMPLOYEE_TOTAL_DEDUCTION', 'Total Deduction 1');
 	define('COMPANY_EMPLOYEE_NET_BALANCE', 'Net Balance 1');
 	define('COMPANY_EMPLOYEE_CLOSE', 'Close 1');

 	//full profile // company_employees_vie_full_profile.php
	define('EMPLOYEE_VIEW', 'Full Profile 1');
	define('EMPLOYEE_ACCOUNT_DETAILS', 'Account Details 1');
	define('EMPLOYEE_FULL_NAME_ENG', 'Employee Full Name - English: 1');
	define('EMPLOYEE_FULL_NAME_AREBIC', 'Employee Full Name - Arabic: 1');
	define('EMPLOYEE_EMAIL', 'Email: 1');
	define('EMPLOYEE_MOBILE', 'Mobile: 1');
	define('EMPLOYEE_PASSWORD', 'Password: 1');
	define('EMPLOYEE_POSITIONAL_INFO', 'Positional Information 1');
	define('EMPLOYEE_DEPARTMENT', 'Department: 1');
	define('EMPLOYEE_DESIGNATION', 'Position Title: 1');
	define('EMPLOYEE_JOB_POSITIONS', 'Job Position: 1');
	define('EMPLOYEE_PERSONAL_INFO', 'Personal Information 1');
	define('EMPLOYEE_PERSONAL_EMAIL', 'Personal Email: 1');
	define('EMPLOYEE_PERSONAL_MOBILE', 'Personal Mobile: 1'); 
	define('EMPLOYEE_GENDER', 'Gender: 1'); 
	define('EMPLOYEE_NATIONALITY', 'Nationality: 1'); 
	define('EMPLOYEE_COUNTRY_LABLE', 'Country 1: '); 
	define('EMPLOYEE_PASSPORT_NUMBER', 'Passport Number: 1'); 
	define('EMPLOYEE_PASSPORT_ISSUE_PALCE', 'Passport Issue Place: 1'); 
	define('EMPLOYEE_PASSPORT_EXPIRY_DATE', 'Passport Expiry Date: 1'); 
	define('EMPLOYEE_GOSI_NUMBER', 'GOSI Number:  1'); 
	define('EMPLOYEE_ID_NUMBER', 'ID Number: 1'); 
	define('EMPLOYEE_BIRTHDATE', 'Birtdate:  1'); 
	define('EMPLOYEE_SOCIAL_STATUS', 'Social Status: 1'); 
	define('EMPLOYEE_REGION', 'Religion: 1'); 
	define('EMPLOYEE_NUMBER_OF_DEPENDANT', 'Number Of Dependent: 1'); 
	define('EMPLOYEE_ADDRESS_MOTHER_CITY', 'Address in mother city 1'); 
	define('EMPLOYEE_ADDRESS', 'Address: 1'); 
	define('EMPLOYEE_CITY', 'City: 1');
	define('EMPLOYEE_STATE', 'State:  1');
	define('EMPLOYEE_ADDRESS_IN_MOTHER_KINGDOM', 'Address in mother Kingdom 1');
	define('EMPLOYEE_PO_BOX', 'P,O,Box: 1');
	define('EMPLOYEE_BUILDING_NO', 'Building No: 1');
	define('EMPLOYEE_STREET_NAME', 'Street Name: 1');
	define('EMPLOYEE_ZIP_CODE', 'Zip Code: 1');
	define('EMPLOYEE_EMERGENCY_CONTACTS', 'Emergency Contacts 1');
	define('EMPLOYEE_CONTACT_NAME', 'Contact Name 1'); 
	define('EMPLOYEE_RELATIONSHIP', 'Relationship 1'); 
	define('EMPLOYEE_QUALIFICATION', 'Qualification 1'); 
	define('EMPLOYEE_SPECIALIZATION', 'Specialization 1'); 
	define('EMPLOYEE_INSTITUTE', 'Institute/Univarsity Name 1'); 
	define('EMPLOYEE_FROM_YEAR', 'From Year 1'); 
	define('EMPLOYEE_TO_YEAR', 'To Year 1'); 
	define('EMPLOYEE_WORK_EXPERIANCE', 'Work Experience 1'); 
	define('EMPLOYEE_POSITIONS', 'Position: 1'); 
	define('EMPLOYEE_NAME', 'Employer Name: 1'); 
	define('EMPLOYEE_JOB_TASK', 'Job Task: 1'); 
	define('EMPLOYEE_TOTAL_SALARY', 'Total Salary:  1'); 
	define('EMPLOYEE_FROM_DATE', 'From Date: 1'); 
	define('EMPLOYEE_TO_DATE', 'To Date: 1'); 
	define('EMPLOYEE_LEAVE_DETAILS', ' Leave Details: 1'); 
	define('EMPLOYEE_LEAVE_GROUP', ' Leave Group: 1'); 
	define('EMPLOYEE_HOLIDAY_GROUP', ' Holiday Group: 1'); 
	define('EMPLOYEE_WORKWEEK_SHIFT', ' Workweek & Workshift: 1'); 
	define('EMPLOYEE_DAY', ' Day 1'); 
	define('EMPLOYEE_IS_WORKING', ' Is-Working 1'); 
	define('EMPLOYEE_SHIFT', ' Shift 1'); 
	define('EMPLOYEE_SALARY_DETAILS', ' Salary Details 1'); 
	define('EMPLOYEE_ANNUAL_CTC', ' Annual CTC: 1');  
	define('EMPLOYEE_MONTHLY', ' Monthly: 1');
	define('EMPLOYEE_PREVIEW_SALARY_SLEEP', ' Preview Salary Sleep 1');
	define('EMPLOYEE_EARNING_COMPONENT', ' Earning Components 1');
	define('EMPLOYEE_EARNING_COMPONENT_WITH_SALARY', ' Earning component will add in salary 1');
	define('EMPLOYEE_NAMES', ' NAME 1');
	define('EMPLOYEE_COMPONENT_TYPE', 'Component Type 1');
	define('EMPLOYEE_AMMOUNT', 'Amount 1');
	define('EMPLOYEE_VALUE', 'Value 1');
	define('EMPLOYEE_SAR', 'SAR 1');
	define('EMPLOYEE_DEDUCTUION_COMPONENT', 'Deduction Components 1');
	define('EMPLOYEE_DEDUCTUION_COMPONENT_WITH_SALARY', 'Deduction component will deduct from salary 1');
	define('EMPLOYEE_SALARY_SLEEP', 'Salary Sleep 1');
	define('EMPLOYEE_EARNING', 'Earnings 1');
	define('EMPLOYEE_DEDUCTION', 'Deductions 1');
	define('EMPLOYEE_TOTAL_EARNING', 'Total Earning 1');
	define('EMPLOYEE_TOTAL_DEDUCTION', 'Total Deduction 1');
	define('EMPLOYEE_NET_BALANCE', 'Net Balance 1');
	define('EMPLOYEE_CLOSE', 'CLOSE 1');

	//create event //create_event.php
	define('EVENTS_TITLE', 'Events 1');
	define('EVENTS_CREATE', 'Create event 1');
	define('EVENTS_START_DATE', 'Event start date 1');
	define('EVENTS_START_TIME', 'Event start time 1');
	define('EVENTS_END_DATE', 'Event end date 1');
	define('EVENTS_END_TIME', 'Event end time 1');
	define('EVENTS_TITLES', 'Event title 1');
	define('EVENTS_ATTACH_EVENT_DOC', 'Attach event document 1');
	define('EVENTS_EDITOR', 'WYSIWYG Editor 1');
	define('EVENTS_CANCEL', 'Cancel 1');

	//event details
	define('EVENTS_DETAIL_TITLE', 'Events');
	define('EVENTS_DETAIL_FMC_CALENDAR', 'Calendar');
	define('EVENTS_DETAIL_SUB_TITLE', 'Event Details');
	define('EVENTS_DETAIL_START_DATE', 'Event start date');
	define('EVENTS_DETAIL_START_TIME', 'Event start time');
	define('EVENTS_DETAIL_END_DATE', 'Event end date');
	define('EVENTS_DETAIL_END_TIME', 'Event end time');
	define('EVENTS_DETAIL_TITLES', 'Event title');
	define('EVENTS_DETAIL_DESCRIPTION', 'Event Description');
	define('EVENTS_DETAIL_ATTACH_EVENT_DOC', 'Document');
	define('EVENTS_DETAIL_COLOR', 'Event Color');
	define('EVENTS_DETAIL_CLICK_HERE_TO_DOWNLOAD', 'Click here to download');
	
 	//employee profile view //company_employee_view.php
	define('EMPLOYEE_PROFILE', 'Employee 1');
	define('EMPLOYEE_PROFILE_PROFILE', 'Profile 1');
	define('EMPLOYEE_PROFILE_VIEW_FULL_PROFILE', 'View Full Profile 1');
	define('EMPLOYEE_PROFILE_LEAVE_BALANCE', 'Leave Balance 1');
	define('EMPLOYEE_PROFILE_NAME_ENGLISH', 'Name - English: 1');
	define('EMPLOYEE_PROFILE_NAME_AREBIC', 'Name - Arabic: 1');
	define('EMPLOYEE_PROFILE_EMAIL', 'Email: 1');
	define('EMPLOYEE_PROFILE_MOBILE', 'Mobile: 1');
	define('EMPLOYEE_PROFILE_PASSWORD', 'Password: 1');
	define('EMPLOYEE_PROFILE_OVERTIME', 'Overtime 1');
	define('EMPLOYEE_PROFILE_LEAVES', 'Leaves 1');
	define('EMPLOYEE_PROFILE_BUSINESS_TRIP', 'Business Trip 1');
	define('EMPLOYEE_PROFILE_ECCR', 'ECCR 1');
	define('EMPLOYEE_PROFILE_GENERAL', 'General 1');
	define('EMPLOYEE_PROFILE_REQUEST_OVERTIME', 'Request Overtime 1');
	define('EMPLOYEE_PROFILE_REQUEST_BUSINESS_TRIP', 'Request Business Trip 1');
	define('EMPLOYEE_PROFILE_REQUEST_LEAVE', 'Request Leave 1');
	define('EMPLOYEE_PROFILE_REQUEST_ECCR', 'Request ECCR 1');
	define('EMPLOYEE_PROFILE_REQUEST_GENERAL', 'Request General 1');
	define('EMPLOYEE_PROFILE_REQUEST_EOS', 'Request EOS 1');
	define('EMPLOYEE_PROFILE_DATE', 'Date 1');
	define('EMPLOYEE_PROFILE_REQUEST_STATUS', 'Request Status 1');
	define('EMPLOYEE_PROFILE_CREATED_AT', 'Created At 1');
	define('EMPLOYEE_PROFILE_TITLE', 'Title 1');
	define('EMPLOYEE_PROFILE_DAY_DATE', 'Date/Days 1');

	//request overtime // request_overtime.php
	define('REQUEST_OVERTIME_TITLE', 'Request Overtime 1');
	define('REQUEST_OVERTIME_CREATE', 'Create 1');
	define('REQUEST_OVERTIME_SELECT_EMPLOYEE', 'Select Employee 1');
	define('REQUEST_OVERTIME_DATE', 'Date 1');
	define('REQUEST_OVERTIME_FROM_TIME', 'From-Time (12 hour) 1');
	define('REQUEST_OVERTIME_FROM_TIME_EX', 'Ex: 11:59 pm 1');
	define('REQUEST_OVERTIME_TO_TIME', 'To-Time (12 hour) 1');
	define('REQUEST_OVERTIME_DESCRIPTION', 'Description 1');
	define('REQUEST_OVERTIME_UPLOAD_DOC', 'Upload Document 1');
	define('REQUEST_OVERTIME_DRAG_DROP', 'Drag & Drop files here 1');
	define('REQUEST_OVERTIME_DOC_FILE', 'Document File 1');
	define('REQUEST_OVERTIME_DOC_TYPE', 'File Type : .PDF .DOC .DOCX .PNG .JPG  1');
	define('REQUEST_OVERTIME_BROWSE_FILE', 'Browse Files 1');
	define('REQUEST_OVERTIME_ASSIGN_USER', 'Assign User: 1');
	define('REQUEST_OVERTIME_SELECT_USER', 'Select FMC User 1');
	define('REQUEST_OVERTIME_CANCEL', 'Cancel 1');
	
	//request businesss trip //
	define('REQUEST_BUSINESS_TRIP', 'Request Bussiness Trip 1');
	define('REQUEST_BUSINESS_CREATE', 'Create 1');
	define('REQUEST_BUSINESS_EMPLOYEE', 'Employee 1');
	define('REQUEST_BUSINESS_SELECT_EMPLOYEE', 'Select Employee 1');
	define('REQUEST_BUSINESS_TITLE', 'Title 1');
	define('REQUEST_BUSINESS_FROM_DATE', 'From Date 1');
	define('REQUEST_BUSINESS_TO_DATE', 'To Date 1');
	define('REQUEST_BUSINESS_DESCRIPTION', 'Description 1');
	define('REQUEST_BUSINESS_TRIP_ROUTE', 'Trip Route 1');
	define('REQUEST_BUSINESS_PROJECT_NAME', 'Project Name 1');
	define('REQUEST_BUSINESS_DESTINATION', 'Destination 1');
	define('REQUEST_BUSINESS_ACCOMODATION', 'Accommodation 1');
	define('REQUEST_BUSINESS_ENTRY_VISA', 'Entry Visa 1');
	define('REQUEST_BUSINESS_EXIT_VISA', 'Exit Visa 1');
	define('REQUEST_BUSINESS_TRAVEL_TICKET', 'Travel Ticket 1');
	define('REQUEST_BUSINESS_ON_HAND_CASH', 'On Hand Cash 1');
	define('REQUEST_BUSINESS_ON_HAND_AMMOUNT', 'On Hand Cash Ammount 1');
	define('REQUEST_BUSINESS_CAR', 'Car 1');
	define('REQUEST_BUSINESS_ASSIGN_USER', 'Assign User: 1');
	define('REQUEST_BUSINESS_SELECT_USER', 'Select FMC User 1');
	define('REQUEST_BUSINESS_CANCEL', 'Cancel 1');

	//request leave //request_leave.php
	define('REQUEST_LEAVE', 'Request 1');
	define('REQUEST_LEAVE_LEAVE', 'Leave 1');
	define('REQUEST_LEAVE_EMPLOYEE', 'Employee 1');
	define('REQUEST_LEAVE_SELECT_EMPLOYEE', 'Select Employee 1');
	define('REQUESTS_LEAVE_LEAVE_TYPE', 'Leave Type 1');
	define('REQUESTS_LEAVE_SELECT_LEAVE_TYPE', 'Select Leave Type 1');
	define('REQUESTS_LEAVE_TITLE', 'Title 1');
	define('REQUESTS_LEAVE_FROM_DATE', 'From Date 1');
	define('REQUESTS_LEAVE_TO_DATE', 'To Date 1');
	define('REQUESTS_LEAVE_DATE', 'Leave Date 1');	
	define('REQUESTS_LEAVE_DESCRIPTION', 'Description 1');	
	define('REQUESTS_LEAVE_ENTRY_VISA_REAUIRED', 'Entry-Visa required 1');	
	define('REQUESTS_LEAVE_EXIT_VISA_REAUIRED', 'Exit-Visa required 1');	
	define('REQUESTS_LEAVE_TRAVEL_TICKET', 'Travel ticket required 1');	
	define('REQUESTS_LEAVE_UPLOAD_DOC', 'Upload Document 1');	
	define('REQUESTS_LEAVE_DRAG_DROP', 'Drag & Drop files here 1');	
	define('REQUESTS_LEAVE_DOC_FILE', 'Document File 1');	
	define('REQUESTS_LEAVE_FILE_TYPE', 'File Type : .PDF .DOC .DOCX .PNG .JPG .JPEG 1');	
	define('REQUESTS_LEAVE_BROWSE_FILE', 'Browse Files 1');	
	define('REQUESTS_LEAVE_ASSIGN_USER', 'Assign User: 1');		
	define('REQUESTS_LEAVE_SELECT_USER', 'Select FMC User 1');	
	define('REQUESTS_LEAVE_CREATE', 'Create 1');	
	define('REQUESTS_LEAVE_CANCEL', 'Cancel 1');	
	
	//request eccr //request_eccr.php
	define('REQUESTS_ECCR', 'Employee Contract & Roll Change (ECCR) 1');	
	define('REQUESTS_ECCR_EMPLOYEE', 'Employee 1');	
	define('REQUESTS_ECCR_SELECT_EMPLOYEE', 'Select Employee 1');	
	define('REQUESTS_ECCR_TYPE', 'Request Type 1');
	define('REQUESTS_ECCR_POSITION_CHANGE', 'Position Change 1');
	define('REQUESTS_ECCR_POSITION_ADD_ALLOWANCE', 'Add Allowances 1');
	define('REQUESTS_ECCR_DESCREASE_ALLOWANCE', 'Descrease Allowances 1');
	define('REQUESTS_ECCR_SALARY_INCREMENT', 'Salary Increment 1');
	define('REQUESTS_ECCR_LOCATION_CHANGE', 'Location Change 1');
	define('REQUESTS_ECCR_DEPARTMENT_CHANGE', 'Department Change 1');
	define('REQUESTS_ECCR_TEMPORARY_RELOACTION', 'Temporary Relocation 1');
	define('REQUESTS_ECCR_TITLE', 'Title 1');
	define('REQUESTS_ECCR_DESCRIPTION', 'Description 1');
	define('REQUESTS_ECCR_ASSIGN_USER', 'Assign User: 1');
	define('REQUESTS_ECCR_SELECT_USER', 'Select FMC User 1');
	define('REQUESTS_ECCR_CREATE', 'Create 1');
	define('REQUESTS_ECCR_CANCEL', 'Cancel 1');
	
	//request general //reauest_general.php
	define('GENERAL_REQUEST', 'General Request 1');
	define('GENERAL_REQUEST_CREATE', 'Create General Request 1');
	define('GENERAL_REQUEST_EMPLOYEE', 'Employee 1');
	define('GENERAL_REQUEST_SELECT_EMPLOYEE', 'Select Employee 1');
	define('GENERAL_REQUEST_TYPE', 'Request Type 1');
	define('GENERAL_REQUEST_SELECT_TYPE', 'Select Request Type 1');
	define('GENERAL_REQUEST_TITLE', 'Title 1');
	define('GENERAL_REQUEST_DESCRIPTION', 'Description 1');
	define('GENERAL_REQUEST_ASSIGN_USER', 'Assign User: 1');
	define('GENERAL_REQUEST_SELECT_USER', 'Select FMC User 1');
	define('GENERAL_REQUEST_CREATES', 'Create 1');
	define('GENERAL_REQUEST_CANCEL', 'Cancel 1');

	//FMC Dashboard
	define('DASHBOARD_TITLE', 'Dashboard 1');
	define('DASHBOARD_REQUESTS', 'Requests 1');
	define('DASHBOARD_PRIMARY_REQUEST', 'Primary Requests 1');
	define('DASHBOARD_OTHER_REQUEST', 'Other Requests 1');
	define('DASHBOARD_APPROVED_REQUEST', 'Approved Requests 1');
	define('DASHBOARD_DECLINED_REQUEST', 'Declined Requests 1');
	define('DASHBOARD_REQUEST_TYPE', 'Request Type 1');
	define('DASHBOARD_REQUEST_TITLE', 'Title 1');
	define('DASHBOARD_COMPANY_NAME', 'Company Name 1');
	define('DASHBOARD_EMPLOYEE_NAME', 'Employee Name 1');
	define('DASHBOARD_CREATED_AT', 'Created At 1');

	//dashboard Client conform request //clients_confirm_request.php
	define('REQUEST_TITLE', 'Request 1');
	define('REQUEST_CONFORM_DETAILS', 'Confirm Client Details Request 1');
	define('REQUESTS_CONF_ALL_ABOVE', 'Confirm All Above Details 1');
	define('REQUESTS_NOTE', 'Request Note: 1');
	define('REQUESTS_CONFO_CLOSE', 'Confirm & Close 1');
	define('REQUESTS_DECLINE', 'Decline 1');
	define('REQUESTS_COMPANY_NAME_ENG', 'Company Name - English:  1');
	define('REQUESTS_COMPANY_NAME_ARABIC', 'Company Name - Arabic: 1');
	define('REQUESTS_ALL_CIS', 'All CIS: 1');
	define('REQUESTS_C_R_NUMBER', 'C.R Number: 1');
	define('REQUESTS_FROM', 'From: 1');
	define('REQUESTS_DATE_OF_ISSUE', 'Date of issue: 1');
	define('REQUESTS_DATE_OF_EXPAIRY', 'Date of expiry:  1');
	define('REQUESTS_LEGAL_ENTITY', 'Legal entity: 1');
	define('REQUESTS_DATE_ESTABLISHED', 'Date established:1');
	define('REQUESTS_MAIN_ACTIVITY', 'Main activity: 1');
	define('REQUESTS_COUNTRY_OF_ORIGIN', 'Country of Origin:  1');
	define('REQUESTS_ABOUT_COMPANY', 'About Company: 1');
	define('REQUESTS_CONTACT_NO', 'Contract No.: 1');
	define('REQUESTS_CONTACT_DATE', 'Contract date: 1');
	define('REQUESTS_CONTACT_START_DATE', 'Contract start date: 1');
	define('REQUESTS_CONTACT_END_DATE', 'Contract end date: 1');
	define('REQUESTS_CONTACT_CREATED_BY', 'Contract created by 1');
	define('REQUESTS_CONTACT_SIGNED_BY_FMC', 'Contract signed by ( FMC ) 1');
	define('REQUESTS_CONTACT_SIGNED_BY_CLIENT', 'Contract signed by ( Client ) 1');
	define('REQUESTS_CONTACT_SIGNED_LOCATION', 'Contract signed location 1');
	define('REQUESTS_CONTACT_NOTE', 'Contract Notes:  1');
	define('REQUESTS_CONTACT_AGREEMENT_FILE', 'Contract Agreement File 1:');
	define('REQUESTS_PERCENTAGE', 'Percentage 1');
	define('REQUESTS_BIRTHDATE', 'Birthdate 1');
	define('REQUESTS_JOINING_DATE', 'Joining Date 1');
	define('REQUESTS_DETAIL', 'Details 1');
	define('REQUESTS_DETAILS', 'Request Details - 1');
	define('REQUESTS_COMPANY_NAME', 'Company Name: 1');
	define('REQUESTS_EMPLOYEE_NAME', 'Employee Name: 1');
	define('REQUESTS_TITLE', 'Title: 1');
	define('REQUESTS_DESCRIPTION', 'Description: 1');
	define('REQUESTS_FROM_DATE', 'From-Date: 1');
	define('REQUESTS_TO_DATE', 'To-Date: 1');
	define('REQUESTS_PROJECT_NAME', 'Project Name: 1');
	define('REQUESTS_DESTINATION', 'Destination: 1');
	define('REQUESTS_TRIP_ROUTE', 'Trip Route: 1');
	define('REQUESTS_TRIP_ACCOMMODATION', 'Accommodation: 1');
	define('REQUESTS_ENTRY_VISA', 'Entry Visa: 1');
	define('REQUESTS_EXIT_VISA', 'Exit Visa: 1');
	define('REQUESTS_TRAVEL_TICKET', 'Travel Ticket: 1');
	define('REQUESTS_ON_HAND_CASH', 'On Hand Cash:  1');
	define('REQUESTS_CAR', 'Car: 1');
	define('REQUESTS_CREATED_BY_FMC', 'Created By FMC: 1');
	define('REQUESTS_CREATED_BY_COMPANY', 'Created By Company: 1');
	define('REQUESTS_APPROVAL_CLOSE', 'Approve & Close 1');
	define('REQUESTS_CANCEL', 'Cancel 1');
	define('REQUESTS_TYPE', 'Request Type:  1');
	define('REQUESTS_LEAVE_TYPE', 'Leave Type:  1');
	define('REQUESTS_DATE', 'Date 1');
	define('REQUESTS_DURATION', 'Duration: 1');

	//FMC Department /departments.php
	define('DEPARTMENTS_TITLE', 'Departments 1');
	define('DEPARTMENTS_ADD_DEPARTMENT', 'Add Department 1');
	define('DEPARTMENTS_DEPARTMENT_NAME', 'Department Name 1');
	define('DEPARTMENTS_ACTION', 'Action 1');
	define('DEPARTMENTS_ADD', 'Add 1');
	define('DEPARTMENTS_CLOSE', 'Close 1');
	define('DEPARTMENTS_PLACEHOLDER_NAME', 'Department Name * 1');
	define('DEPARTMENTS_UPDATE', 'Update Department 1');
	define('DEPARTMENTS_SAVE', 'Save 1');

	//FMC Division division.php
	define('DIVISION_TITLE', 'Division 1');
	define('DIVISION_ADD_DIVISION', 'Add Division 1');
	define('DIVISION_DIVISION_NAME', 'Division Name 1');
	define('DIVISION_DEPARTMENT_NAME', 'Department Name 1');

	//FMC Department Division //Division create
	define('DEPARTMENT_DIVISION', 'Department Division 1');
	define('DEPARTMENT_CREATE_DIVISION', 'Create Division 1');
	define('DEPARTMENT_TITLE', 'Department 1');
	define('DEPARTMENT_SELECT_DEPARTMENT', 'Select Department 1');
	define('DEPARTMENT_DIVISION_NAME', 'Division Name 1');
	define('DEPARTMENT_CANCEL', 'Cancel 1');
	define('DEPARTMENT_PLACEHOLDER_NAME', 'Division Name 1');
	define('DEPARTMENT_UPDATE_DIVISION', 'Update Division 1');
	define('DEPARTMENT_SAVE_DIVISION', 'Save Division 1');
	
	//FMC USERS  //fmcusers.php
	define('FMC_TITLE', 'FMC Users 1');
	define('FMC_UPDATE_USER', 'Update User 1');
	define('FMC_ADD_USERS', 'Add User 1');
	define('FMC_EMPLOYEE_ID', 'Employee ID 1');
	define('FMC_CEO', 'CEO 1');
	define('FMC_HR', 'HR 1');
	define('FMC_COORDINATOR', 'Coordinator 1');
	define('FMC_FULL_NAME', 'Full Name 1');
	define('FMC_EMAIL', 'Email 1');
	define('FMC_DEPARTMENT_NAME', 'Department Name 1');
	
	//FMC USERS //fmc_users_create.php
	define('FMC_CREATE_USERS', 'Create Users 1');
	define('FMC_USER_TYPE', 'User Type 1');
	define('FMC_SELECT_USER_TYPE', 'Select User-Type 1');
	define('FMC_SELECT_DEPARTMENT', 'Departments 1');
	define('FMC_FIRST_NAME', 'First Name 1');
	define('FMC_MIDDLE_NAME', 'Middle Name 1');
	define('FMC_LAST_NAME', 'Last Name 1');
	define('FMC_SURNAME', 'Surname 1');
	define('FMC_PASSWORD', 'Password 1');
	define('FMC_PLS_PASSWORD', 'Enter Minimum 6 Charachter Inputes 1');
	define('FMC_CONFIRM_PASSWORD', 'Confirm Password 1');
	define('FMC_MOBILE', 'Mobile 1');
	define('FMC_ALTERNATIVE_MOBILE', 'Alternative Mobile 1');
	define('FMC_BIRTHDATE', 'Birthdate 1');
	define('FMC_ADDRESS', 'Address 1');
	define('FMC_CANCEL', 'Cancel 1');
	define('FMC_SAVE_USER', 'Save User 1');
	
	//FMC Clients //Clients.php
	define('CLIENTS_TITLE', 'Clients 1');
	define('CLIENTS_ADD_NEW_CLIENTS', 'Add New Client 1');
	define('CLIENTS_NAME_ENGLISH', 'Name English 1');
	define('CLIENTS_NAME_ARABIC', 'Name Arabic 1');
	define('CLIENTS_STATUS', 'Status 1');

	//Client view //client_view.php
	define('CLIENTS_DETAILS', 'Clients Details 1');	
	define('CLIENTS_COMPANY_ALL_CIS', 'All CIS: 1');	
	define('CLIENTS_COMPANY_C_R_NUMBER', 'C.R Number: 1');
	define('CLIENTS_COMPANY_FROM', 'From: 1');
	define('CLIENTS_COMPANY_DATE_OF_ISSUE', 'Date of issue: 1');
	define('CLIENTS_COMPANY_DATE_OF_EXPIRY', 'Date of expiry: 1');
	define('CLIENTS_COMPANY_LEGAL_ENTITY', 'Legal entity: 1');
	define('CLIENTS_COMPANY_DATE_ESTABLISHED', 'Date established: 1');
	define('CLIENTS_COMPANY_MAIN_ACTIVITY', 'Main activity: 1');
	define('CLIENTS_COMPANY_ABOUT_COMPANY', 'About Company: 1');
	define('CLIENTS_COMPANY_COUNTRY_OF_REGION', 'Country of Origin:   1');
	define('CLIENTS_COMPANY_CONTACT_DETAIL', 'Contract Detail 1');
	define('CLIENTS_COMPANY_CONTRACT', 'Contract No.: 1');
	define('CLIENTS_COMPANY_CONTRACT_DATE', 'Contract date: 1');
	define('CLIENTS_COMPANY_CONTRACT_START_DATE', 'Contract start date:  1');
	define('CLIENTS_COMPANY_CONTRACT_END_DATE', 'Contract end date: 1');
	define('CLIENTS_COMPANY_CONTRACT_CREATED_BY', 'Contract created by 1');
	define('CLIENTS_COMPANY_CONTRACT_CREATED_BY_FMC', 'Contract signed by ( FMC ) 1');
	define('CLIENTS_COMPANY_CONTRACT_CREATED_BY_CLIENT', 'Contract signed by ( Client ) 1');
	define('CLIENTS_COMPANY_CONTRACT_SIGNED_LOCATION', 'Contract signed location 1');
	define('CLIENTS_COMPANY_CONTRACT_NOTES', 'Contract Notes: 1');
	define('CLIENTS_COMPANY_CONTRACT_INFO', 'Contact Information 1');
	define('CLIENTS_COMPANY_P_O_BOX', 'P,O,Box:  1');
	define('CLIENTS_COMPANY_BUILDING_NO', 'Building No: 1');
	define('CLIENTS_COMPANY_STREET_NAME', 'Street Name: 1');
	define('CLIENTS_COMPANY_REGION', 'Region: 1');
	define('CLIENTS_COMPANY_CITY', 'City: 1');
	define('CLIENTS_COMPANY_ZIP_CODE', 'Zip Code: 1');
	define('CLIENTS_COMPANY_ADDITONAL_NO', 'Addional No: 1');
	define('CLIENTS_COMPANY_TEL', 'Tel: 1');
	define('CLIENTS_COMPANY_FAX', 'Fax: 1');
	define('CLIENTS_COMPANY_EMAIL', 'Email: 1');
	define('CLIENTS_COMPANY_WELCOME', 'Website:  1');
	define('CLIENTS_COMPANY_CONTACT_PERSON_NAME', 'Contact person name: 1');
	define('CLIENTS_COMPANY_CONTACT_PERSON_NO', 'Contact person mobile number:  1');
	define('CLIENTS_COMPANY_CONTACT_PERSON_EMAIL', 'Contact person email: 1');
	define('CLIENTS_COMPANY_CONTACT_PERSON_TEL', 'Contact person Tel/ext:  1');
	define('CLIENTS_COMPANY_CONTACT_PROPERTY_INFORMATION', 'Property Information 1');
	define('CLIENTS_COMPANY_OWNER_NAME', 'Owner Name 1');
	define('CLIENTS_COMPANY_NATIONALITY', 'Nationality 1');
	define('CLIENTS_COMPANY_PERCENTAGE', 'Percentage 1');
	define('CLIENTS_COMPANY_EXPERIANCE', 'Experience 1');
	define('CLIENTS_COMPANY_BIRTHDATE', 'Birthdate 1');
	define('CLIENTS_COMPANY_EXECUTIVE', 'Executive Management 1');
	define('CLIENTS_COMPANY_EXECUTIVE_NAME', 'Executive Name 1');
	define('CLIENTS_COMPANY_JOB_POSSITIONS', 'Job-Position 1');
	define('CLIENTS_COMPANY_JOINING_DATE', 'Joining Date 1');
	define('CLIENTS_COMPANY_BRANCH', 'Branches / Subsidiary 1');
	define('CLIENTS_COMPANY_TRADING_NAME', 'Trading name: 1');
	define('CLIENTS_COMPANY_BRANCH_TYPE', 'Branch Type: 1');
	define('CLIENTS_COMPANY_WEBSITE', 'Website 1');
	define('CLIENTS_COMPANY_DOCUMENT_TITLE', 'Document title 1');
	define('CLIENTS_COMPANY_DOCUMENT_DATE', 'Document date 1');
	define('CLIENTS_COMPANY_DOCUMENT_EXPIRY_DATE', 'Document Expiary date 1');
	define('CLIENTS_COMPANY_ADDED_DOC', 'Added by / added date & time 1');
	define('CLIENTS_COMPANY_NOTES', 'Notes 1');

	//FMC CREATE CLIENTS //clients_create_step_1.php
	define('CLIENTS_PRIMARY_HR', 'Primary HR 1');
	define('CLIENTS_SELECT_PRIMARY_HR', 'Select Primary HR 1');	
	define('CLIENTS_GENERAL_INFORMATION', 'Client General Information 1');
	define('CLIENTS_GENERAL_INFO', 'General Information 1');
	define('CLIENTS_CONTRACT_DETAILS', 'Contract details 1');
	define('CLIENTS_CONTACT_INFORMATIONS', 'Contact Information 1');
	define('CLIENTS_PROPERTY_INFORMATION', 'Property Information 1');
	define('CLIENTS_EXECUTIVE_MANAGEMENT', 'Executive Management 1');
	define('CLIENTS_BRANCH_SUBSIDIARIES', 'Branches / Subsidiaries 1');
	define('CLIENTS_COMPANY_DOCUMENTS', 'Company Document 1');
	define('CLIENTS_COMPANY_NAME_ENGLISH', 'Company Name - English  1');
	define('CLIENTS_COMPANY_NAME_AREBIC', 'Company Name - Arabic 1');
	define('CLIENTS_COMPANY_LOGO', 'Company Logo 1');
	define('CLIENTS_LOGO_SIZE', 'size : 200 x 200 px 1');
	define('CLIENTS_LOGO_EXTENSION', 'JPG , PNG , JPEG  1');
	define('CLIENTS_LOGO_UPLOAD', 'Drag & Drop files here 1'); 
	define('CLIENTS_OR', 'or 1'); 
	define('CLIENTS_BROWSE_FILES', 'Browse Files 1'); 
	define('CLIENTS_ALL_CIS', 'All CIS 1'); 
	define('CLIENTS_C_R_NUMBER', 'C.R Number 1'); 
	define('CLIENTS_FROM', 'From Date 1'); 
	define('CLIENTS_DATE_OF_ISSUE', 'Date of Issue 1');
	define('CLIENTS_DATE_OF_EXPIRY', 'Date of Expiry 1');
	define('CLIENTS_LEGAL_ENTITY', 'Legal Entity 1');
	define('CLIENTS_SELECT_LEGAL_ENTITY', 'Select Legal entity 1');
	define('CLIENTS_DATA_ESTABLISHED', 'Date Established 1');
	define('CLIENTS_MAIN_ACTIVITY', 'Main Activity 1');
	define('CLIENTS_SELECT_MAIN_ACTIVITY', 'Select Main activity 1');
	define('CLIENTS_COUNTRY_OF_ORIGIN', 'Country of Origin 1');
	define('CLIENTS_SELECT_COUNTRY_OF_ORIGIN', 'Select Country of Origin 1');
	define('CLIENTS_ABOUT_COMPANY', 'About Company 1');
	define('CLIENTS_SAVE', 'Save 1');
	define('CLIENTS_NEXT', 'Next 1');
	
	//FMC CREATE CLIENTS //clients_create_step_2.php
	define('CLIENT_CONTRACT_DETAILS', 'Client Contract Details 1');
	define('CLIENTS_CONTRACT_NO', 'Contract No. 1');
	define('CLIENTS_CONTRACT_DATE', 'Contract Date 1');
	define('CLIENTS_COMPANY_AGREEMENT', 'Company Agreement 1');
	define('CLIENTS_CLICK_TODOWNLOAD', 'Click here to download 1');
	define('CLIENTS_MAX', 'Max : 15 MB 1');
	define('CLIENTS_PDF_DOC', 'PDF and Doc files 1');
	define('CLIENTS_DRAG_DROP', 'Drag & Drop files here 1');
	define('CLIENTS_CONTRACT_START_DATE', 'Contract Start Date 1');
	define('CLIENTS_CONTRACT_END_DATE', 'Contract End Date 1');
	define('CLIENTS_CONTRACT_CREATED_BY', 'Contract Created By 1');
	define('CLIENTS_CONTRACT_SIGNED_BY', 'Contract Signed By ( FMC ) 1');
	define('CLIENTS_CONTRACT_SIGNED_BY_CLIENT', 'Contract Signed By ( Client ) 1');
	define('CLIENTS_CONTRACT_SIGEN_LOCATION', 'Contract Signed Location 1');
	define('CLIENTS_CONTRACT_NOTES', 'Contract Notes 1');
	define('CLIENTS_CONTRACT_SKIP', 'Skip 1');
	define('CLIENTS_CONTRACT_PREVIOUS', 'Previous 1');
	
	//FMC CREATE CLIENTS //clients_create_step_3.php
	define('CLIENTS_CONTACT_INFO', 'Client Contact Information 1');
	define('CLIENTS_CONTACT_P_O_BOX', 'P,O,Box 1');
	define('CLIENTS_CONTACT_BUILDING_NO', 'Building No 1');
	define('CLIENTS_CONTACT_STREET_NAME', 'Street Name 1');
	define('CLIENTS_CONTACT_REGION', 'Regions 1');
	define('CLIENTS_CONTACT_CITY', 'City 1');
	define('CLIENTS_CONTACT_ZIP_CODE', 'Zip Code 1');
	define('CLIENTS_CONTACT_ADDITIONAL_NO', 'Addional No 1');
	define('CLIENTS_CONTACT_COORDINATES', 'Coordinates 1');
	define('CLIENTS_CONTACT_TEL', 'Tel. 1');
	define('CLIENTS_CONTACT_FAX', 'Fax 1');
	define('CLIENTS_CONTACT_EMAIL', 'Email 1');
	define('CLIENTS_CONTACT_WEBSITE', 'Website 1');
	define('CLIENTS_CONTACT_PERSON_NAME', 'Contact Person Name 1');
	define('CLIENTS_CONTACT_PERSON_MO_NO', 'Contact Person Mobile Number 1');
	define('CLIENTS_CONTACT_PERSON_EMAIL', 'Contact Person Email 1');
	define('CLIENTS_CONTACT_PERSON_TEL', 'Contact Person Tel/Ext 1');
	define('CLIENTS_CONTACT_SAVE', 'Save 1');

	//FMC CREATE CLIENTS //clients_create_step_4.php
	define('CLIENTS_PROPERTY', 'Client Property Information 1');
	define('CLIENTS_OWNER_NAME', 'Owner Name 1');
	define('CLIENTS_NATIONALITY', 'Nationality 1');
	define('CLIENTS_SELECT_NATIONALITY', 'Select Nationality 1');
	define('CLIENTS_COMPANY_STATUS', 'Company Status 1');
	define('CLIENTS_PROPERTY_PERCENTAGE', 'Property Percentage % 1');
	define('CLIENTS_EXPERIANCE', 'Experience 1');
	define('CLIENTS_DATE_OF_BIRTH', 'Date of Birth 1');
	define('CLIENTS_ADD_PROPERTY_INFORMATION', 'Add Property Information');
	
	//FMC CREATE CLIENTS //clients_create_step_5.php
	define('CLIENTS_EXICUTIVE_MANAGEMENT', 'Client Exucutive Management 1');
	define('CLIENTS_EXICUTIVE_NAME', 'Executive Name 1');
	define('CLIENTS_JOB_POSITION', 'Job Position 1');
	define('CLIENTS_YEAR_OF_EXPIRIANCE', 'Years of Experience 1');
	define('CLIENTS_DATE_OF_JOINING_COMPANY', 'Date of Joining the Company 1');
	define('CLIENTS_ADD_EXECUTIVE_INFORMATION', 'Add Exucutive Member 1');

	//FMC CREATE CLIENTS //clients_create_step_6.php
	define('CLIENTS_BRANCH_SUBSID', 'Client Branch/Subsidiary 1');
	define('CLIENTS_BRANCH_SUBSID_TRADING_NAME', 'Trading name 1');
	define('CLIENTS_BRANCH_SUBSID_BRANCH_TYPE', 'Branch Type 1');
	define('CLIENTS_BRANCH_SUBSID_ADD_BRANCH', 'Add Branch / Subsidiaries 1');

	//FMC CREATE CLIENTS //clients_create_step_7.php
	define('CLIENTS_BRANCH', 'Create Client Branch/Subsidiary 1');
	define('CLIENTS_ADD_DOCUMENT', 'Add Document 1');
	define('CLIENTS_ADD_NEW_DOCUMENT', 'Add new document 1');
	define('CLIENTS_DREG_DROP', 'Drag &amp; Drop files here 1');
	define('CLIENTS_DOCUMENT_TITLE', 'Document title 1');
	define('CLIENTS_DOCUMENT_DATA', 'Document date 1');
	define('CLIENTS_DOCUMENT_EXPIARY_DATE', 'Document Expiary date 1');
	define('CLIENTS_DOCUMENT_ADDED_DATE', 'Added by / added date & time 1');
	define('CLIENTS_DOCUMENT_NOTE', 'Note 1');
	define('CLIENTS_DOCUMENT_DATE', 'Date 1');
	define('CLIENTS_DOCUMENT_SELECTED', 'document selected 1');

	//Settings //Document_categories.php
	define('DOCUMENT_CATEGORY_TITLE', 'Document Categories 1');
	define('DOCUMENT_ADD_CATEGORY', 'Add Category 1');
	define('DOCUMENT_CATEGORY_NAME', 'Name 1');
	define('DOCUMENT_CATEGORY_DISPLAY_ORDER', 'Display Order 1');
	define('DOCUMENT_CATEGORY_DEFAULT', 'Default 1');
	define('DOCUMENT_CATEGORY_ADD', 'Add Document Category 1');
	define('DOCUMENT_CATEGORY_ISDEFAULT', 'Is Default 1');
	define('DOCUMENT_CATEGORY_UPDATE', 'Update Document Category 1');

	//Settings //Medical Categories
	define('MEDICAL_CATEGORY_TITLE', 'Medical Categories 1');
	define('MEDICAL_ADD_CATEGORY', 'Add Medical 1');
	define('MEDICAL_CATEGORY_NAME', 'Name 1');
	define('MEDICAL_CATEGORY_DISPLAY_ORDER', 'Display Order 1');
	define('MEDICAL_CATEGORY_DEFAULT', 'Default 1');
	define('MEDICAL_CATEGORY_ADD', 'Add Medical Category 1');
	define('MEDICAL_CATEGORY_ISDEFAULT', 'Is Default 1');
	define('MEDICAL_CATEGORY_UPDATE', 'Update Medical Category 1');

	//Settings //Company_structure_type.php
	define('COMPANY_STRUCTURE_TITLE', 'Company Structure Type 1');
	define('COMPANY_ADD_STRUCTURE', 'Add Company Structure 1');
	define('COMPANY_STRUCTURE_NAME', 'Name 1');
	define('COMPANY_STRUCTURE_DEFAULT', 'Default 1');
	define('COMPANY_ADD_COMPANY_STUC_TYPE', 'Add Company Structure type 1');
	define('COMPANY_STRUCTURE_ISDEFAULT', 'Is Default 1');
	define('COMPANY_STRUCTURE_UPDATE', 'Update Company Structure Type 1');
	
	//Settings //legal_entities.php
	define('LEGAL_ENTITIES_TITLE', 'Legal Entities 1');
	define('LEGAL_ENTITIES_ADD', 'Add Legal Entity 1');
	define('LEGAL_ENTITIES_NAME', 'Name 1');
	define('LEGAL_ENTITIES_DEFAULT', 'Default 1');
	define('LEGAL_ENTITIES_ADD_ENTITY', 'Add Legal Entity 1');
	define('LEGAL_ENTITIES_PLSHOLDER', 'Legal Entity Name 1');
	define('LEGAL_ENTITIES_ISDEFAULT', 'Is Default 1');
	define('LEGAL_ENTITIES_UPDATE', 'Update Legal Entity 1');
	
	//Settings //countries.php
	define('COUNTRIES_TITLE', 'Countries 1');
	define('COUNTRIES_ADD', 'Add Country 1');
	define('COUNTRIES_NAME', 'Name 1');
	define('COUNTRIES_DEFAULT', 'Default 1');
	define('COUNTRIES_ADD_CONTRIES', 'Add Country 1');
	define('COUNTRIES_COUNTRY_CODE', 'Country Code 1');
	define('COUNTRIES_ISDEFAULT', 'Is Default 1');
	define('COUNTRIES_UPDATE', 'Update Country 1');

	//Settings //Warning_categories.php
	define('WARNING_CATEGORY_TITLE', 'Warning Categories 1');
	define('WARNING_ADD_CATEGORY', 'Add Category 1');
	define('WARNING_CATEGORY_TITLE', 'Title 1');
	define('WARNING_CATEGORY_TITLE_ENG', 'Title Eng 1');
	define('WARNING_CATEGORY_TITLE_AR', 'Title Ar 1');
	define('WARNING_CATEGORY_ADD', 'Add Warning Category 1');
	define('WARNING_CATEGORY_UPDATE', 'Update Warning Category 1');

	//Settings // regions.php
	define('REGIONS_TITLE', 'Regions 1');
	define('REGIONS_ADD', 'Add Regions 1');
	define('REGIONS_COUNTRY', 'Country 1');
	define('REGIONS_NAME', 'Name 1');
	define('REGIONS_DEFAULT', 'Default 1');
	define('REGIONS_ISDEFAULT', 'Is Default 1');
	define('REGIONS_UPDATE', 'Update Regions 1');
	define('REGIONS_SELECT_COUNTRY', 'Select Country 1');

	//Settings //cities.php
	define('CITY_TITLE', 'Cities 1');
	define('CITY_ADD', 'Add City 1');
	define('CITY_COUNTRY', 'Country 1');
	define('CITY_REGION', 'Region 1');
	define('CITY_NAME', 'Name 1');	
	define('CITY_DEFAULT', 'Default 1');
	define('CITY_SELECT_REGION', 'Select Regions 1');
	define('CITY_ISDEFAULT', 'Is Default 1');
	define('CITY_UPDATE', 'Update City 1');
	define('CITY_SELECT_COUNTRY', 'Select Country 1');
	
	//settings //main_activity.php
	define('MAIN_ACTIVITY_TITLE', 'Main Activities 1');
	define('MAIN_ACTIVITY_ADD', 'Add Main Activity 1');
	define('MAIN_ACTIVITY_NAME', 'Name 1');
	define('MAIN_ACTIVITY_DEFAULT', 'Default 1');
	define('MAIN_ACTIVITY_MAIN', 'Main Activity Name 1');
	define('MAIN_ACTIVITY_ISDEFAULT', 'IS Default 1');
	define('MAIN_ACTIVITY_UPDATE', 'Update Main Activity 1');
	
	//calander //calender.php
	define('CALENDER_TITLE', 'Brilliant Activity Calender 1');
	define('CALENDER_VIEW', 'Calender view 1');
	define('CALENDER_LIST_VIEW', 'Calender list view 1'); 
	define('CALENDER_ADD_NEW_EVENT', 'Add New Event 1'); 
	define('CALENDER_EVENT_TITLE', 'Event Title 1');  
	define('CALENDER_START_DATE', 'Start date 1');  
	define('CALENDER_END_DATE', 'End date 1');  
	define('CALENDER_START_TIME', 'Start Time 1');  
	define('CALENDER_END_TIME', 'End Time 1');  
	define('CALENDER_CREATED_BY', 'Created by 1');  
	
	//support 
	define('SUPPORT_CREATE_TICKETS', 'Create Tickets 1');  
	define('SUPPORT_TITLE', 'Title 1');  
	define('SUPPORT_DESCRIPTION', 'Description 1');
	define('SUPPORT_CREATE', 'Create 1');
	define('SUPPORT_CANCEL', 'Cancel 1');
	define('SUPPORT_UPDATE_TICKET', 'Update Ticket 1');
	

}
