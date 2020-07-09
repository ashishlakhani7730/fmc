<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['fmc-policy'] = 'login/fmc_policy';
$route['forgot-password'] = 'login/forgot_password';
$route['reset-password/(.+)'] = 'login/reset_password/$1';
$route['login-verify-otp/(.+)'] = 'login/login_verify_otp/$1';
$route['verify-otp/(.+)'] = 'login/verify_otp/$1';

$route['medical-categories'] = 'medical_categories';

$route['fmc-salary-components'] = 'fmc_salarycomponents';
$route['fmc-salary-components/create'] = 'fmc_salarycomponents/create';
$route['fmc-salary-components/update/(:any)'] = 'fmc_salarycomponents/update/$1';

$route['fmc-leave-management'] = 'fmc_leave_management';
$route['fmc-leave-group'] = 'fmc_leavegroup';
$route['fmc-holidays'] = 'fmc_holidays';
$route['fmc-holiday-group'] = 'fmc_holidaygroup';
$route['fmc-work-week'] = 'fmc_workweek';
$route['fmc-work-shift'] = 'fmc_workshift';

$route['assets-assign'] = 'assets_assign';
$route['assets-assign/create'] = 'assets_assign/create';
$route['assets-assign/update/(:any)'] = 'assets_assign/update/$1';

$route['assets-return'] = 'assets_return';
$route['assets-return/create'] = 'assets_return/create';
$route['assets-return/update/(:any)'] = 'assets_return/update/$1';

$route['assets-management'] = 'assets';
$route['company-organization-chart'] = 'Company_structure';
$route['company-organization-chart/create'] = 'Company_structure/create';
$route['company-organization-chart/update/(:any)'] = 'Company_structure/update/$1';

$route['position-titles'] = 'designation';
$route['position-titles/create'] = 'designation/create';
$route['position-titles/update/(:any)'] = 'designation/update/$1';

//Employee Login
$route['my-profile'] = 'myprofile';
$route['my-profile/emergency-contacts'] = 'myprofile/emergency_contacts';
$route['my-profile/work-experience'] = 'myprofile/work_experience';
$route['my-profile/add-work-experience'] = 'myprofile/add_work_experience';
$route['my-profile/qualification'] = 'myprofile/qualification';
$route['my-profile/add-qualification'] = 'myprofile/add_qualification';
$route['my-profile/documents'] = 'myprofile/documents';
$route['leave-balance'] = 'myprofile/leave_balance';

$route['salary-details'] = 'myprofile/salary_details';

$route['overtime-requests'] = 'myprofile_requests/overtime_requests';
$route['overtime-requests/create'] = 'myprofile_requests/create_overtime_request';
$route['overtime-request/details/(.+)'] = 'myprofile_requests/overtime_request_details/$1';

$route['leave-requests'] = 'myprofile_requests/leave_requests';
$route['leave-requests/create'] = 'myprofile_requests/create_leave_request';
$route['leave-request/details/(.+)'] = 'myprofile_requests/leave_request_details/$1';

$route['business-trip-requests'] = 'myprofile_requests/business_trip_requests';
$route['business-trip-requests/create'] = 'myprofile_requests/create_business_trip_requests';
$route['business-trip-request/details/(.+)'] = 'myprofile_requests/business_trip_request_details/$1';

$route['eccr-requests'] = 'myprofile_requests/eccr_requests';
$route['eccr-requests/create'] = 'myprofile_requests/create_eccr_request';
$route['eccr-request/details/(.+)'] = 'myprofile_requests/eccr_request_details/$1';

$route['general-requests'] = 'myprofile_requests/general_requests';
$route['general-requests/create'] = 'myprofile_requests/create_general_request';
$route['general-request/details/(.+)'] = 'myprofile_requests/general_request_details/$1';


$route['job-opening'] = 'myprofile/job_opening';
$route['annoucement'] = 'myprofile/annoucement';

$route['employee-request/(.+)'] = 'myprofile_requests/request_details/$1';

$route['employee-calendar'] = 'employee_calendar';
$route['employee-calendar/create-event'] = 'employee_calendar/create_event';




//Employee Public Share Link
$route['employee-public-link/(.+)'] = 'Sharelink/index/$1';


//FMC LOGIN
$route['confirm-client-request-details/(.+)'] = 'requests/confirm_client_details_request/$1';
$route['client-request-details/(.+)'] = 'requests/client_request_details/$1';
$route['confirm-company-payroll-request/(.+)'] = 'requests/payroll_request_details/$1';

$route['compnay-request-details/(.+)'] = 'requests/fmc_request_details/$1';
$route['employees/send-for-approval/(.+)'] = 'employees/send_for_approval/$1';


//FMC LOGIN Setting
$route['client-required-documents'] = 'client_required_documents/index';
$route['client-required-documents/create'] = 'client_required_documents/create';
$route['client-required-documents/update/(.+)'] = 'client_required_documents/update/$1';

