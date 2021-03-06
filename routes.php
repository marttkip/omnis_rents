<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "auth";
$route['404_override'] = '';

/*
*	Auth Routes
*/
$route['login'] = 'auth/login_user';
$route['logout-admin'] = 'auth/logout';

/*
*	Admin Routes
*/
$route['dashboard'] = 'admin/dashboard';
$route['change-password'] = 'admin/users/change_password';

/*
*	administration Routes
*/
$route['administration/configuration'] = 'admin/configuration';
$route['administration/edit-configuration'] = 'admin/edit_configuration';
$route['administration/edit-configuration/(:num)'] = 'admin/edit_configuration/$1';
$route['administration/sections'] = 'admin/sections/index';
$route['administration/sections/(:any)/(:any)/(:num)'] = 'admin/sections/index/$1/$2/$3';
$route['administration/add-section'] = 'admin/sections/add_section';
$route['administration/edit-section/(:num)'] = 'admin/sections/edit_section/$1';

$route['administration/edit-section/(:num)/(:num)'] = 'admin/sections/edit_section/$1/$2';
$route['administration/delete-section/(:num)'] = 'admin/sections/delete_section/$1';
$route['administration/delete-section/(:num)/(:num)'] = 'admin/sections/delete_section/$1/$2';
$route['administration/activate-section/(:num)'] = 'admin/sections/activate_section/$1';
$route['administration/activate-section/(:num)/(:num)'] = 'admin/sections/activate_section/$1/$2';
$route['administration/deactivate-section/(:num)'] = 'admin/sections/deactivate_section/$1';
$route['administration/deactivate-section/(:num)/(:num)'] = 'admin/sections/deactivate_section/$1/$2';

#$route['administration/company-profile'] = 'admin/contacts/show_contacts';
$route['administration/branches'] = 'admin/branches/index';
$route['administration/branches/(:any)/(:any)/(:num)'] = 'admin/branches/index/$1/$2/$3';
$route['administration/branches/(:any)/(:any)'] = 'admin/branches/index/$1/$2';
$route['administration/add-branch'] = 'admin/branches/add_branch';
$route['administration/edit-branch/(:num)'] = 'admin/branches/edit_branch/$1';
$route['administration/edit-branch/(:num)/(:num)'] = 'admin/branches/edit_branch/$1/$2';
$route['administration/delete-branch/(:num)'] = 'admin/branches/delete_branch/$1';
$route['administration/delete-branch/(:num)/(:num)'] = 'admin/branches/delete_branch/$1/$2';
$route['administration/activate-branch/(:num)'] = 'admin/branches/activate_branch/$1';
$route['administration/activate-branch/(:num)/(:num)'] = 'admin/branches/activate_branch/$1/$2';
$route['administration/deactivate-branch/(:num)'] = 'admin/branches/deactivate_branch/$1';
$route['administration/deactivate-branch/(:num)/(:num)'] = 'admin/branches/deactivate_branch/$1/$2';

/*
*	HR Routes
*/
$route['human-resource/my-account'] = 'admin/dashboard';
$route['human-resource/my-account/edit-about/(:num)'] = 'hr/personnel/my_account/update_personnel_about_details/$1';
$route['human-resource/edit-personnel-account/(:num)'] = 'hr/personnel/update_personnel_account_details/$1';
$route['human-resource/configuration'] = 'hr/configuration';
$route['human-resource/add-job-title'] = 'hr/add_job_title';
$route['human-resource/edit-job-title/(:num)'] = 'hr/edit_job_title/$1';
$route['human-resource/delete-job-title/(:num)'] = 'hr/delete_job_title/$1';
$route['human-resource/personnel'] = 'hr/personnel/index';
$route['human-resource/personnel/(:any)/(:any)/(:num)'] = 'hr/personnel/index/$1/$2/$3';
$route['human-resource/add-personnel'] = 'hr/personnel/add_personnel';
$route['human-resource/edit-personnel/(:num)'] = 'hr/personnel/edit_personnel/$1';
$route['human-resource/edit-personnel-about/(:num)'] = 'hr/personnel/update_personnel_about_details/$1';
$route['human-resource/edit-personnel-account/(:num)'] = 'hr/personnel/update_personnel_account_details/$1';
$route['human-resource/edit-personnel/(:num)/(:num)'] = 'hr/personnel/edit_personnel/$1/$2';
$route['human-resource/delete-personnel/(:num)'] = 'hr/personnel/delete_personnel/$1';
$route['human-resource/delete-personnel/(:num)/(:num)'] = 'hr/personnel/delete_personnel/$1/$2';
$route['human-resource/activate-personnel/(:num)'] = 'hr/personnel/activate_personnel/$1';
$route['human-resource/activate-personnel/(:num)/(:num)'] = 'hr/personnel/activate_personnel/$1/$2';
$route['human-resource/deactivate-personnel/(:num)'] = 'hr/personnel/deactivate_personnel/$1';
$route['human-resource/deactivate-personnel/(:num)/(:num)'] = 'hr/personnel/deactivate_personnel/$1/$2';
$route['human-resource/reset-password/(:num)'] = 'hr/personnel/reset_password/$1';
$route['human-resource/update-personnel-roles/(:num)'] = 'hr/personnel/update_personnel_roles/$1';
$route['human-resource/add-emergency-contact/(:num)'] = 'hr/personnel/add_emergency_contact/$1';
$route['human-resource/activate-emergency-contact/(:num)/(:num)'] = 'hr/personnel/activate_emergency_contact/$1/$2';
$route['human-resource/deactivate-emergency-contact/(:num)/(:num)'] = 'hr/personnel/deactivate_emergency_contact/$1/$2';
$route['human-resource/delete-emergency-contact/(:num)/(:num)'] = 'hr/personnel/delete_emergency_contact/$1/$2';

$route['human-resource/add-dependant-contact/(:num)'] = 'hr/personnel/add_dependant_contact/$1';
$route['human-resource/activate-dependant-contact/(:num)/(:num)'] = 'hr/personnel/activate_dependant_contact/$1/$2';
$route['human-resource/deactivate-dependant-contact/(:num)/(:num)'] = 'hr/personnel/deactivate_dependant_contact/$1/$2';
$route['human-resource/delete-dependant-contact/(:num)/(:num)'] = 'hr/personnel/delete_dependant_contact/$1/$2';

$route['human-resource/add-personnel-job/(:num)'] = 'hr/personnel/add_personnel_job/$1';
$route['human-resource/activate-personnel-job/(:num)/(:num)'] = 'hr/personnel/activate_personnel_job/$1/$2';
$route['human-resource/deactivate-personnel-job/(:num)/(:num)'] = 'hr/personnel/deactivate_personnel_job/$1/$2';
$route['human-resource/delete-personnel-job/(:num)/(:num)'] = 'hr/personnel/delete_personnel_job/$1/$2';

$route['human-resource/leave'] = 'hr/leave/calender';
$route['human-resource/leave/(:any)/(:any)'] = 'hr/leave/calender/$1/$2';
$route['human-resource/view-leave/(:any)'] = 'hr/leave/view_leave/$1';
$route['human-resource/add-personnel-leave/(:num)'] = 'hr/personnel/add_personnel_leave/$1';
$route['human-resource/add-leave/(:any)'] = 'hr/leave/add_leave/$1';
$route['human-resource/add-calender-leave'] = 'hr/leave/add_calender_leave';
$route['human-resource/activate-leave/(:num)/(:any)'] = 'hr/leave/activate_leave/$1/$2';
$route['human-resource/deactivate-leave/(:num)/(:any)'] = 'hr/leave/deactivate_leave/$1/$2';
$route['human-resource/delete-leave/(:num)/(:any)'] = 'hr/leave/delete_leave/$1/$2';
$route['human-resource/activate-personnel-leave/(:num)/(:num)'] = 'hr/personnel/activate_personnel_leave/$1/$2';
$route['human-resource/deactivate-personnel-leave/(:num)/(:num)'] = 'hr/personnel/deactivate_personnel_leave/$1/$2';
$route['human-resource/delete-personnel-leave/(:num)/(:num)'] = 'hr/personnel/delete_personnel_leave/$1/$2';

$route['human-resource/delete-personnel-role/(:num)/(:num)'] = 'hr/personnel/delete_personnel_role/$1/$2';

/*
*	Hospital administration
*/
$route['hospital-administration/import-pharmacy-charges/(:num)'] = 'hospital_administration/services/import_pharmacy_charges/$1';
$route['hospital-administration/import-lab-charges/(:num)'] = 'hospital_administration/services/import_lab_charges/$1';
$route['hospital-administration/dashboard'] = 'administration/index';
$route['hospital-administration/services'] = 'hospital_administration/services/index';
$route['hospital-administration/services/(:any)/(:any)/(:num)'] = 'hospital_administration/services/index/$1/$2/$3';
$route['hospital-administration/services/(:any)/(:any)'] = 'hospital_administration/services/index/$1/$2';
$route['hospital-administration/add-service'] = 'hospital_administration/services/add_service';
$route['hospital-administration/edit-service/(:num)'] = 'hospital_administration/services/edit_service/$1';
$route['hospital-administration/edit-service/(:num)/(:num)'] = 'hospital_administration/services/edit_service/$1/$2';
$route['hospital-administration/delete-service/(:num)'] = 'hospital_administration/services/delete_service/$1';
$route['hospital-administration/delete-service/(:num)/(:num)'] = 'hospital_administration/services/delete_service/$1/$2';
$route['hospital-administration/activate-service/(:num)'] = 'hospital_administration/services/activate_service/$1';
$route['hospital-administration/activate-service/(:num)/(:num)'] = 'hospital_administration/services/activate_service/$1/$2';
$route['hospital-administration/deactivate-service/(:num)'] = 'hospital_administration/services/deactivate_service/$1';
$route['hospital-administration/deactivate-service/(:num)/(:num)'] = 'hospital_administration/services/deactivate_service/$1/$2';
$route['hospital-administration/import-services-template'] = 'hospital_administration/services/import_charges_template';
$route['hospital-administration/import-services/(:num)'] = 'hospital_administration/services/do_charges_import/$1';
$route['hospital-administration/import-charges/(:num)'] = 'hospital_administration/services/import_charges/$1';

$route['hospital-administration/service-charges/(:num)'] = 'hospital_administration/services/service_charges/$1';
$route['hospital-administration/service-charges/(:num)/(:any)/(:any)/(:num)'] = 'hospital_administration/services/service_charges/$1/$2/$3/$4';
$route['hospital-administration/service-charges/(:num)/(:any)/(:any)'] = 'hospital_administration/services/service_charges/$1/$2/$3';
$route['hospital-administration/add-service-charge/(:num)'] = 'hospital_administration/services/add_service_charge/$1';
$route['hospital-administration/edit-service-charge/(:num)/(:num)'] = 'hospital_administration/services/edit_service_charge/$1/$2';
$route['hospital-administration/delete-service-charge/(:num)/(:num)'] = 'hospital_administration/services/delete_service_charge/$1/$2';
$route['hospital-administration/activate-service-charge/(:num)/(:num)'] = 'hospital_administration/services/activate_service_charge/$1/$2';
$route['hospital-administration/deactivate-service-charge/(:num)/(:num)'] = 'hospital_administration/services/deactivate_service_charge/$1/$2';

$route['hospital-administration/visit-types'] = 'hospital_administration/visit_types/index';
$route['hospital-administration/visit-types/(:any)/(:any)/(:num)'] = 'hospital_administration/visit_types/index/$1/$2/$3';
$route['hospital-administration/visit-types/(:any)/(:any)'] = 'hospital_administration/visit_types/index/$1/$2';
$route['hospital-administration/add-visit-type'] = 'hospital_administration/visit_types/add_visit_type';
$route['hospital-administration/edit-visit-type/(:num)'] = 'hospital_administration/visit_types/edit_visit_type/$1';
$route['hospital-administration/delete-visit-type/(:num)'] = 'hospital_administration/visit_types/delete_visit_type/$1';
$route['hospital-administration/activate-visit-type/(:num)'] = 'hospital_administration/visit_types/activate_visit_type/$1';
$route['hospital-administration/deactivate-visit-type/(:num)'] = 'hospital_administration/visit_types/deactivate_visit_type/$1';

$route['hospital-administration/departments'] = 'hospital_administration/departments/index';
$route['hospital-administration/departments/(:any)/(:any)/(:num)'] = 'hospital_administration/departments/index/$1/$2/$3';
$route['hospital-administration/departments/(:any)/(:any)'] = 'hospital_administration/departments/index/$1/$2';
$route['hospital-administration/add-department'] = 'hospital_administration/departments/add_department';
$route['hospital-administration/edit-department/(:num)'] = 'hospital_administration/departments/edit_department/$1';
$route['hospital-administration/delete-department/(:num)'] = 'hospital_administration/departments/delete_department/$1';
$route['hospital-administration/activate-department/(:num)'] = 'hospital_administration/departments/activate_department/$1';
$route['hospital-administration/deactivate-department/(:num)'] = 'hospital_administration/departments/deactivate_department/$1';

$route['hospital-administration/wards'] = 'hospital_administration/wards/index';
$route['hospital-administration/wards/(:any)/(:any)/(:num)'] = 'hospital_administration/wards/index/$1/$2/$3';
$route['hospital-administration/wards/(:any)/(:any)'] = 'hospital_administration/wards/index/$1/$2';
$route['hospital-administration/add-ward'] = 'hospital_administration/wards/add_ward';
$route['hospital-administration/edit-ward/(:num)'] = 'hospital_administration/wards/edit_ward/$1';
$route['hospital-administration/delete-ward/(:num)'] = 'hospital_administration/wards/delete_ward/$1';
$route['hospital-administration/activate-ward/(:num)'] = 'hospital_administration/wards/activate_ward/$1';
$route['hospital-administration/deactivate-ward/(:num)'] = 'hospital_administration/wards/deactivate_ward/$1';

$route['hospital-administration/rooms/(:num)'] = 'hospital_administration/rooms/index/$1';
$route['hospital-administration/rooms/(:num)/(:any)/(:any)/(:num)'] = 'hospital_administration/rooms/index/$1/$2/$3/$4';
$route['hospital-administration/rooms/(:num)/(:any)/(:any)'] = 'hospital_administration/rooms/index/$1/$2/$3';
$route['hospital-administration/add-room/(:num)'] = 'hospital_administration/rooms/add_room/$1';
$route['hospital-administration/edit-room/(:num)/(:num)'] = 'hospital_administration/rooms/edit_room/$1/$2';
$route['hospital-administration/delete-room/(:num)/(:num)'] = 'hospital_administration/rooms/delete_room/$1/$2';
$route['hospital-administration/activate-room/(:num)/(:num)'] = 'hospital_administration/rooms/activate_room/$1/$2';
$route['hospital-administration/deactivate-room/(:num)/(:num)'] = 'hospital_administration/rooms/deactivate_room/$1/$2';

$route['hospital-administration/beds/(:num)'] = 'hospital_administration/beds/index/$1';
$route['hospital-administration/beds/(:num)/(:any)/(:any)/(:num)'] = 'hospital_administration/beds/index/$1/$2/$3/$4';
$route['hospital-administration/beds/(:num)/(:any)/(:any)'] = 'hospital_administration/beds/index/$1/$2/$3';
$route['hospital-administration/add-bed/(:num)'] = 'hospital_administration/beds/add_bed/$1';
$route['hospital-administration/edit-bed/(:num)/(:num)'] = 'hospital_administration/beds/edit_bed/$1/$2';
$route['hospital-administration/delete-bed/(:num)/(:num)'] = 'hospital_administration/beds/delete_bed/$1/$2';
$route['hospital-administration/activate-bed/(:num)/(:num)'] = 'hospital_administration/beds/activate_bed/$1/$2';
$route['hospital-administration/deactivate-bed/(:num)/(:num)'] = 'hospital_administration/beds/deactivate_bed/$1/$2';

$route['hospital-administration/insurance-companies'] = 'hospital_administration/companies/index';
$route['hospital-administration/insurance-companies/(:any)/(:any)/(:num)'] = 'hospital_administration/companies/index/$1/$2/$3';
$route['hospital-administration/insurance-companies/(:any)/(:any)'] = 'hospital_administration/companies/index/$1/$2';
$route['hospital-administration/add-insurance-company'] = 'hospital_administration/companies/add_company';
$route['hospital-administration/edit-insurance-company/(:num)'] = 'hospital_administration/companies/edit_company/$1';
$route['hospital-administration/delete-insurance-company/(:num)'] = 'hospital_administration/companies/delete_company/$1';
$route['hospital-administration/activate-insurance-company/(:num)'] = 'hospital_administration/companies/activate_company/$1';
$route['hospital-administration/deactivate-insurance-company/(:num)'] = 'hospital_administration/companies/deactivate_company/$1';

/*
*	Accounts Routes
*/
$route['accounts/closed-visits'] = 'accounts/payroll/accounts_closed_visits';
$route['accounts/un-closed-visits'] = 'accounts/payroll/accounts_unclosed_queue';
$route['accounts/change-branch'] = 'accounts/payroll/change_branch';

$route['accounts/print-paye-report/(:num)'] = 'accounts/payroll/print_paye_report/$1';
$route['accounts/print-nhif-report/(:num)'] = 'accounts/payroll/print_nhif_report/$1';
$route['accounts/print-nssf-report/(:num)'] = 'accounts/payroll/print_nssf_report/$1';
$route['accounts/print-payroll/(:num)'] = 'accounts/payroll/print_payroll/$1';
$route['accounts/print-month-payslips/(:num)'] = 'accounts/payroll/print_monthly_payslips/$1';
$route['accounts/export-payroll/(:num)'] = 'accounts/payroll/export_payroll/$1';
$route['accounts/print-payroll-pdf/(:num)'] = 'accounts/payroll/print_payroll_pdf/$1';
$route['accounts/payroll/print-payslip/(:num)/(:num)'] = 'accounts/payroll/print_payslip/$1/$2';
$route['accounts/payroll/download-payslip/(:num)/(:num)'] = 'accounts/payroll/download_payslip/$1/$2';
$route['accounts/payroll-payslips/(:num)'] = 'accounts/payroll/payroll_payslips/$1';
$route['accounts/salary-data'] = 'accounts/payroll/salaries';
$route['accounts/search-payroll'] = 'accounts/payroll/search_payroll';
$route['accounts/close-payroll-search'] = 'accounts/payroll/close_payroll_search';
$route['accounts/create-payroll'] = 'accounts/payroll/create_payroll';
$route['accounts/deactivate-payroll/(:num)'] = 'accounts/payroll/deactivate_payroll/$1';
$route['accounts/print-payslips'] = 'accounts/payroll/print_payslips';
$route['accounts/payroll/edit-payment-details/(:num)'] = 'accounts/payroll/edit_payment_details/$1';
$route['accounts/payroll/edit_allowance/(:num)'] = 'accounts/payroll/edit_allowance/$1';
$route['accounts/payroll/delete_allowance/(:num)'] = 'accounts/payroll/delete_allowance/$1';
$route['accounts/payroll/edit_deduction/(:num)'] = 'accounts/payroll/edit_deduction/$1';
$route['accounts/payroll/delete_deduction/(:num)'] = 'accounts/payroll/delete_deduction/$1';
$route['accounts/payroll/edit_saving/(:num)'] = 'accounts/payroll/edit_saving/$1';
$route['accounts/payroll/delete_saving/(:num)'] = 'accounts/payroll/delete_saving/$1';
$route['accounts/payroll/edit_loan_scheme/(:num)'] = 'accounts/payroll/edit_loan_scheme/$1';
$route['accounts/payroll/delete_loan_scheme/(:num)'] = 'accounts/payroll/delete_loan_scheme/$1';
$route['accounts/payroll'] = 'accounts/payroll/payrolls';
$route['accounts/all-payroll'] = 'accounts/payroll/all_payrolls';
$route['accounts/payment-details/(:num)'] = 'accounts/payroll/payment_details/$1';
$route['accounts/save-payment-details/(:num)'] = 'accounts/payroll/save_payment_details/$1';
$route['accounts/update-savings/(:num)'] = 'accounts/payroll/update_savings/$1';
$route['accounts/update-loan-schemes/(:num)'] = 'accounts/payroll/update_loan_schemes/$1';
$route['payroll/configuration'] = 'accounts/payroll/payroll_configuration';
$route['accounts/payroll-configuration'] = 'accounts/payroll/payroll_configuration';
$route['accounts/payroll/edit-nssf/(:num)'] = 'accounts/payroll/edit_nssf/$1';
$route['accounts/payroll/edit-nhif/(:num)'] = 'accounts/payroll/edit_nhif/$1';
$route['accounts/payroll/delete-nhif/(:num)'] = 'accounts/payroll/delete_nhif/$1';
$route['accounts/payroll/edit-paye/(:num)'] = 'accounts/payroll/edit_paye/$1';
$route['accounts/payroll/delete-paye/(:num)'] = 'accounts/payroll/delete_paye/$1';
$route['accounts/payroll/edit-payment/(:num)'] = 'accounts/payroll/edit_payment/$1';
$route['accounts/payroll/delete-payment/(:num)'] = 'accounts/payroll/delete_payment/$1';
$route['accounts/payroll/edit-benefit/(:num)'] = 'accounts/payroll/edit_benefit/$1';
$route['accounts/payroll/delete-benefit/(:num)'] = 'accounts/payroll/delete_benefit/$1';
$route['accounts/payroll/edit-allowance/(:num)'] = 'accounts/payroll/edit_allowance/$1';
$route['accounts/payroll/delete-allowance/(:num)'] = 'accounts/payroll/delete_allowance/$1';
$route['accounts/payroll/edit-deduction/(:num)'] = 'accounts/payroll/edit_deduction/$1';
$route['accounts/payroll/edit-relief/(:num)'] = 'accounts/payroll/edit_relief/$1';
$route['accounts/payroll/delete-deduction/(:num)'] = 'accounts/payroll/delete_deduction/$1';
$route['accounts/payroll/edit-other-deduction/(:num)'] = 'accounts/payroll/edit_other_deduction/$1';
$route['accounts/payroll/delete-other-deduction/(:num)'] = 'accounts/payroll/delete_other_deduction/$1';
$route['accounts/payroll/edit-loan-scheme/(:num)'] = 'accounts/payroll/edit_loan_scheme/$1';
$route['accounts/payroll/delete-loan-scheme/(:num)'] = 'accounts/payroll/delete_loan_scheme/$1';
$route['accounts/payroll/edit-saving/(:num)'] = 'accounts/payroll/edit_saving/$1';
$route['accounts/payroll/delete-saving/(:num)'] = 'accounts/payroll/delete_saving/$1';
$route['accounts/payroll/edit-personnel-payments/(:num)'] = 'accounts/payroll/edit_personnel_payments/$1';
$route['accounts/payroll/edit-personnel-allowances/(:num)'] = 'accounts/payroll/edit_personnel_allowances/$1';
$route['accounts/payroll/edit-personnel-benefits/(:num)'] = 'accounts/payroll/edit_personnel_benefits/$1';
$route['accounts/payroll/edit-personnel-deductions/(:num)'] = 'accounts/payroll/edit_personnel_deductions/$1';
$route['accounts/payroll/edit-personnel-other-deductions/(:num)'] = 'accounts/payroll/edit_personnel_other_deductions/$1';
$route['accounts/payroll/edit-personnel-savings/(:num)'] = 'accounts/payroll/edit_personnel_savings/$1';
$route['accounts/payroll/edit-personnel-loan-schemes/(:num)'] = 'accounts/payroll/edit_personnel_loan_schemes/$1';
$route['accounts/payroll/edit-personnel-relief/(:num)'] = 'accounts/payroll/edit_personnel_relief/$1';
$route['accounts/payroll/view-payslip/(:num)'] = 'accounts/payroll/view_payslip/$1';
$route['accounts/payroll/generate-batch-payroll/(:num)/(:num)/(:num)'] = 'accounts/payroll/generate_payroll/$1/$2/$3';
$route['accounts/payroll/generate-batch-payroll/(:num)/(:num)/(:num)/(:num)'] = 'accounts/payroll/generate_payroll/$1/$2/$3/$4';
$route['accounts/payroll/view-batch-payslip/(:num)/(:num)'] = 'accounts/payroll/view_batch_payslip/$1/$2';
$route['accounts/payroll/send-batch-payslip/(:num)/(:num)'] = 'accounts/payroll/send_batch_payslip/$1/$2';
$route['accounts/print-month-summary/(:num)/(:num)'] = 'accounts/payroll/month_summary/$1/$2';
$route['accounts/print-month-payslips2/(:num)'] = 'accounts/payroll/print_monthly_payslips2/$1';
$route['payroll/add-overtime-hours/(:num)'] = 'accounts/payroll/add_overtime_hours/$1';
$route['accounts/create-data-file/(:num)/(:num)'] = 'accounts/payroll/create_data_file/$1/$2';
$route['accounts/list-batches/(:num)/(:num)'] = 'accounts/payroll/list_batches/$1/$2';
$route['accounts/list-batches/(:num)/(:num)/(:num)'] = 'accounts/payroll/list_batches/$1/$2/$3';

//import personnel routes
$route['import/personnel'] = 'hr/personnel/import_personnel';
$route['import/personnel-template'] = 'hr/personnel/import_personnel_template';
$route['import/import-personnel'] = 'hr/personnel/do_personnel_import';

//import personnel emails
$route['import/personnel-emails'] = 'hr/personnel/import_personnel_emails';
$route['import/personnel-emails-template'] = 'hr/personnel/import_personnel_emails_template';
$route['import/import-personnel-emails'] = 'hr/personnel/do_personnel_emails_import';

//import branches routes
$route['import/branches'] = 'admin/branches/import_branches';
$route['import/branches-template'] = 'admin/branches/import_branches_template';
$route['import/import-branches'] = 'admin/branches/do_branches_import';

//payroll data import
$route['import/payroll-data'] = 'hr/import_payroll';
$route['import/payroll-template'] = 'hr/import_payroll_template';
$route['import/import-payroll']= 'hr/do_payroll_import';

//import salary advances
$route['salary-advance/import-salary-advance'] = 'accounts/salary_advance/import_salary_advance';
$route['import/import-salary-advances'] = 'accounts/salary_advance/do_advance_import';
$route['import/advance-template'] = 'accounts/salary_advance/advances_template';
$route['download-salary-advance'] = 'accounts/salary_advance/download_salary_advance';

// p9 form
$route['my-account/p9'] = 'accounts/payroll/generate_p9_form';
$route['accounts/generate_p9_form'] = 'accounts/payroll/p9_form';

//p10 form
$route['accounts/p10'] = 'accounts/payroll/generate_p10_form';
$route['accounts/generate_p10_form'] = 'accounts/payroll/p10_form';

//timesheets
$route['timesheets/add-timesheet'] = 'hr/personnel/add_personnel_timesheet';

//bank reports
$route['accounts/bank'] = 'accounts/payroll/bank';
$route['accounts/generate-bank-report/(:num)'] = 'accounts/payroll/generate_bank_report/$1';
//petty cash
$route['accounts/petty-cash'] = 'accounts/petty_cash/index';
$route['accounts/petty-cash/(:any)/(:any)'] = 'accounts/petty_cash/index/$1/$2';
$route['accounts/petty-cash/(:any)'] = 'accounts/petty_cash/index/$1';
//salary advances
$route['salary-advance'] = 'accounts/salary_advance/index';
$route['accounts/search-advances'] = 'accounts/salary_advance/search_salary_advance';
$route['close-salary-advance-search'] = 'accounts/salary_advance/close_advance_search';
$route['salary-advance/(:any)/(:any)'] = 'accounts/salary_advance/index/$1/$2';

//creditors
$route['accounts/creditors'] = 'accounts/creditors/index';
//payroll reports routes
$route['accounts/payroll-reports'] = 'accounts/payroll/payroll_report';
$route['accounts/search-payroll-reports'] = 'accounts/payroll/search_payroll_reports';

//import overtime-hours
$route['import/overtime'] = 'accounts/payroll/import_overtime';
$route['import/overtime-template'] = 'accounts/payroll/import_overtime_template';
$route['import/import-overtime'] = 'accounts/payroll/do_overtime_import';

//send payslips to the specific personnel
$route['accounts/send-month-payslips/(:num)'] = 'accounts/payroll/send_monthly_payslips/$1';
$route['accounts/payroll/access-payslip/(:num)/(:num)'] = 'accounts/payroll/access_payslip/$1/$2';

//payslips per duration
$route['my-account/payslips'] = 'accounts/payroll/generate_duration_payslips';
$route['accounts/generate-personnel-payslips-duration'] = 'accounts/payroll/generate_personnel_payslip_for_duration';


//Always comes last
$route['accounts/payroll/(:any)/(:any)'] = 'accounts/payroll/payrolls/$1/$2';
$route['accounts/payroll/(:any)/(:any)/(:num)'] = 'accounts/payroll/payrolls/$1/$2/$3';
$route['accounts/salary-data/(:any)/(:any)'] = 'accounts/payroll/salaries/$1/$2';
$route['accounts/salary-data/(:any)/(:any)/(:num)'] = 'accounts/payroll/salaries/$1/$2/$3';


/*
*	Inventory Routes
*/
$route['inventory/units-of-measurement'] = 'inventory/unit/index';
$route['inventory/units-of-measurement/(:any)/(:any)/(:num)'] = 'inventory/unit/index/$1/$2/$3';
$route['inventory/add-personnel'] = 'inventory/personnel/add_personnel';
$route['inventory/edit-personnel/(:num)'] = 'inventory/personnel/edit_personnel/$1';
$route['inventory/edit-personnel/(:num)/(:num)'] = 'inventory/personnel/edit_personnel/$1/$2';
$route['inventory/delete-personnel/(:num)'] = 'inventory/personnel/delete_personnel/$1';
$route['inventory/delete-personnel/(:num)/(:num)'] = 'inventory/personnel/delete_personnel/$1/$2';
$route['inventory/activate-personnel/(:num)'] = 'inventory/personnel/activate_personnel/$1';
$route['inventory/activate-personnel/(:num)/(:num)'] = 'inventory/personnel/activate_personnel/$1/$2';
$route['inventory/deactivate-personnel/(:num)'] = 'inventory/personnel/deactivate_personnel/$1';
$route['inventory/deactivate-personnel/(:num)/(:num)'] = 'inventory/personnel/deactivate_personnel/$1/$2';

/*
*	Microfinance Routes
*/
$route['microfinance/individual'] = 'microfinance/individual/index';
$route['microfinance/individual/(:any)/(:any)/(:num)'] = 'microfinance/individual/index/$1/$2/$3';
$route['microfinance/add-individual'] = 'microfinance/individual/add_individual';
$route['microfinance/edit-individual/(:num)'] = 'microfinance/individual/edit_individual/$1';
$route['microfinance/update-individual/(:num)'] = 'microfinance/individual/edit_about/$1';
$route['microfinance/update-individual-document/(:num)'] = 'microfinance/individual/upload_indivudual_documents/$1';
$route['microfinance/update-individual-other-document/(:num)'] = 'microfinance/individual/upload_indivudual_other_documents/$1';
$route['microfinance/update-emergency/(:num)'] = 'microfinance/individual/edit_emergency/$1';
$route['microfinance/add-position/(:num)'] = 'microfinance/individual/add_position/$1';
$route['microfinance/add-nok/(:num)'] = 'microfinance/individual/add_emergency/$1';
$route['microfinance/delete-individual/(:num)'] = 'microfinance/individual/delete_individual/$1';
$route['microfinance/delete-individual/(:num)/(:num)'] = 'microfinance/individual/delete_individual/$1/$2';
$route['microfinance/activate-individual/(:num)'] = 'microfinance/individual/activate_individual/$1';
$route['microfinance/activate-individual/(:num)/(:num)'] = 'microfinance/individual/activate_individual/$1/$2';
$route['microfinance/deactivate-individual/(:num)'] = 'microfinance/individual/deactivate_individual/$1';
$route['microfinance/deactivate-individual/(:num)/(:num)'] = 'microfinance/individual/deactivate_individual/$1/$2';
$route['microfinance/activate-position/(:num)/(:num)'] = 'microfinance/individual/activate_position/$1/$2';
$route['microfinance/deactivate-position/(:num)/(:num)'] = 'microfinance/individual/deactivate_position/$1/$2';
$route['microfinance/delete-emergency/(:num)/(:num)'] = 'microfinance/individual/delete_emergency/$1/$2';

/*
*	Microfinance Routes
*/
$route['microfinance/groups'] = 'microfinance/group/index';
$route['microfinance/group/(:any)/(:any)/(:num)'] = 'microfinance/group/index/$1/$2/$3';
$route['microfinance/add-group'] = 'microfinance/group/add_group';
$route['microfinance/edit-group/(:num)'] = 'microfinance/group/edit_group/$1';
$route['microfinance/edit-about/(:num)'] = 'microfinance/group/edit_about/$1';
$route['microfinance/add-member/(:num)'] = 'microfinance/group/add_member/$1';
$route['microfinance/edit-group/(:num)/(:num)'] = 'microfinance/group/edit_group/$1/$2';
$route['microfinance/delete-group/(:num)'] = 'microfinance/group/delete_group/$1';
$route['microfinance/delete-group/(:num)/(:num)'] = 'microfinance/group/delete_group/$1/$2';
$route['microfinance/activate-group/(:num)'] = 'microfinance/group/activate_group/$1';
$route['microfinance/activate-group/(:num)/(:num)'] = 'microfinance/group/activate_group/$1/$2';
$route['microfinance/deactivate-group/(:num)'] = 'microfinance/group/deactivate_group/$1';
$route['microfinance/deactivate-group/(:num)/(:num)'] = 'microfinance/group/deactivate_group/$1/$2';

$route['microfinance/savings-plan'] = 'microfinance/savings_plan/index';
$route['microfinance/savings-plan/(:any)/(:any)/(:num)'] = 'microfinance/savings_plan/index/$1/$2/$3';
$route['microfinance/add-savings-plan'] = 'microfinance/savings_plan/add_savings_plan';
$route['microfinance/edit-savings-plan/(:num)'] = 'microfinance/savings_plan/edit_savings_plan/$1';
$route['microfinance/edit-savings-plan/(:num)/(:num)'] = 'microfinance/savings_plan/edit_savings_plan/$1/$2';
$route['microfinance/delete-savings-plan/(:num)'] = 'microfinance/savings_plan/delete_savings_plan/$1';
$route['microfinance/delete-savings-plan/(:num)/(:num)'] = 'microfinance/savings_plan/delete_savings_plan/$1/$2';
$route['microfinance/activate-savings-plan/(:num)'] = 'microfinance/savings_plan/activate_savings_plan/$1';
$route['microfinance/activate-savings-plan/(:num)/(:num)'] = 'microfinance/savings_plan/activate_savings_plan/$1/$2';
$route['microfinance/deactivate-savings-plan/(:num)'] = 'microfinance/savings_plan/deactivate_savings_plan/$1';
$route['microfinance/deactivate-savings-plan/(:num)/(:num)'] = 'microfinance/savings_plan/deactivate_savings_plan/$1/$2';

$route['microfinance/add-individual-plan/(:num)'] = 'microfinance/individual/add_individual_plan/$1';
$route['microfinance/activate-individual-plan/(:num)/(:num)'] = 'microfinance/individual/activate_individual_plan/$1/$2';
$route['microfinance/deactivate-individual-plan/(:num)/(:num)'] = 'microfinance/individual/deactivate_individual_plan/$1/$2';

/**
 * Loans Plan
 */
$route['microfinance/loans'] = 'microfinance/loans_plan/index';
$route['microfinance/add-loans-plan'] = 'microfinance/loans_plan/add_loans_plan';
$route['microfinance/edit-loans-plan/(:num)'] = 'microfinance/loans_plan/edit_loans_plan/$1';

/**
 * Individual Payments
 */
$route['microfinance/individual-payments'] = 'microfinance/payments/list_individuals';
$route['microfinance/show-individual-payment'] = 'microfinance/payments/show_individual_payment';
$route['microfinance/show-individual-payment/(:num)'] = 'microfinance/payments/show_individual_payment/$1';
$route['microfinance/add-individual-payment'] = 'microfinance/payments/add_individual_payment';
$route['microfinance/edit-individual-payment/(:num)'] = 'microfinance/payments/edit_individual_payment/$1';
$route['microfinance/delete-individual-payment/(:num)'] = 'microfinance/payments/delete_individual_payment/$1';

/**
 * Group Payments
 */
$route['microfinance/group-payments'] = 'microfinance/payments/list_group';
$route['microfinance/add-group-payment'] = 'microfinance/payments/add_group_payment';
$route['microfinance/show-group-payment'] = 'microfinance/payments/show_group_payment';
$route['microfinance/show-group-payment/(:num)'] = 'microfinance/payments/show_group_payment/$1';
$route['microfinance/edit-group-payment/'] = 'microfinance/payments/edit_group_payment';
$route['microfinance/edit-group-payment/(:num)'] = 'microfinance/payments/edit_group_payment/$1';
$route['microfinance/list-group-payments'] = 'microfinance/payments/list_group';
// $route['microfinance/edit-group-payment/(:num)'] = 'microfinance/payments/edit_payment/$1';
$route['microfinance/delete-group-payment/(:num)'] = 'microfinance/payments/delete_group_payment/$1';

/* End of file routes.php */
/* Location: ./system/application/config/routes.php */



/*
*	reception Routes
*/
$route['reception'] = 'reception/index';
$route['reception/dashboard'] = 'reception/index';
$route['reception/patients-list'] = 'reception/patients';
$route['reception/deleted-visits'] = 'reception/visit_list/2';
$route['reception/visit-history'] = 'reception/visit_list/1';
$route['reception/general-queue'] = 'reception/general_queue/reception';
$route['reception/appointments-list'] = 'reception/appointment_list';
$route['reception/register-other-patient'] = 'reception/register_other_patient';
$route['reception/add-patient'] = 'reception/add_patient';
$route['reception/validate-import'] = 'reception/do_patients_import';
$route['reception/import-template'] = 'reception/import_template';
$route['reception/import-patients'] = 'reception/import_patients';
$route['reception/print-invoice/(:num)/(:any)'] = 'accounts/print_invoice_new/$1/$2';


/*
*	nurse Routes
*/
$route['nurse'] = 'nurse/index';
$route['nurse/dashboard'] = 'nurse/index';
$route['nurse/nurse-queue'] = 'nurse/nurse_queue';
$route['nurse/general-queue'] = 'reception/general_queue/nurse';
$route['nurse/visit-history'] = 'reception/visit_list/1/nurse';


/*
*	doctor Routes
*/
$route['doctor'] = 'doctor/index';
$route['doctor/dashboard'] = 'doctor/index';
$route['doctor/doctors-queue'] = 'doctor/doctor_queue';
$route['doctor/general-queue'] = 'reception/general_queue/doctor';
$route['doctor/visit-history'] = 'reception/visit_list/1/doctor';
$route['doctor/patient-treatment'] = 'nurse/patient_treatment_statement/doctor';



/*
*	doctor Routes
*/
$route['dental'] = 'dental/index';
$route['dental/dashboard'] = 'dental/index';
$route['dental/dental-queue'] = 'dental/dental_queue';
$route['dental/general-queue'] = 'reception/general_queue/dental';
$route['dental/visit-history'] = 'reception/visit_list/1/dental';
$route['dental/patient-treatment'] = 'nurse/patient_treatment_statement/dental';


/*
*	doctor Routes
*/
$route['hospital-reports'] = 'hospital-reports/index';
$route['hospital-reports/patient-statements'] = 'administration/patient_statement';
$route['hospital-reports/all-transactions'] = 'administration/reports/all_transactions/admin';
$route['hospital-reports/cash-report'] = 'administration/reports/all_transactions/admin';
$route['hospital-reports/debtors-report'] = 'administration/reports/debtors_report_data/0';
$route['hospital-reports/department-report'] = 'administration/reports/department_reports';
$route['hospital-reports/doctors-report'] = 'administration/reports/doctor_reports';


/*
*	doctor Routes
*/
$route['laboratory'] = 'laboratory/index';
$route['laboratory/dashboard'] = 'laboratory/index';
$route['laboratory/lab-queue'] = 'laboratory/lab_queue/12';
$route['laboratory/general-queue'] = 'reception/general_queue/laboratory';


/*
*	laboratory setup Routes
*/
$route['laboratory-setup/classes'] = 'lab_charges/classes';
$route['laboratory-setup/tests'] = 'lab_charges/test_list';
$route['laboratory-setup/tests/(:num)'] = 'lab_charges/test_list/lab_test_name/ASC/__/$1';
$route['laboratory-setup/tests/(:any)/(:any)/(:any)/(:num)'] = 'lab_charges/test_list/$1/$2/$3/$4';
$route['laboratory-setup/tests/(:any)/(:any)'] = 'lab_charges/test_list/$1/$2';



/*
*	pharmacy Routes
*/
$route['pharmacy'] = 'pharmacy/index';
$route['pharmacy/dashboard'] = 'pharmacy/index';
$route['pharmacy/pharmacy-queue'] = 'pharmacy/pharmacy_queue/12';
$route['pharmacy/general-queue'] = 'reception/general_queue/pharmacy';


/*
*	pharmacy setup Routes
*/
$route['pharmacy-setup/classes'] = 'pharmacy/classes';
$route['pharmacy-setup/inventory'] = 'pharmacy/inventory';
$route['pharmacy-setup/brands'] = 'pharmacy/brands';
$route['pharmacy-setup/generics'] = 'pharmacy/generics';
$route['pharmacy-setup/containers'] = 'pharmacy/containers';
$route['pharmacy-setup/types'] = 'pharmacy/types';


/*
*	Inventory Routes
*/
$route['accounts'] = 'accounts/index';
$route['accounts/dashboard'] = 'accounts/index';
$route['accounts/accounts-queue'] = 'accounts/accounts_queue/12';
$route['accounts/general-queue'] = 'reception/general_queue/accounts';


/*
*	Cloud Routes
*/
$route['cloud/sync-tables'] = 'cloud/sync_tables/index';
$route['cloud/sync-tables/(:any)/(:any)/(:num)'] = 'cloud/sync_tables/index/$1/$2/$3';
$route['cloud/sync-tables/(:any)/(:any)'] = 'cloud/sync_tables/index/$1/$2';
$route['cloud/add-sync-table'] = 'cloud/sync_tables/add_sync_table';
$route['cloud/edit-sync-table/(:num)'] = 'cloud/sync_tables/edit_sync_table/$1';
$route['cloud/delete-sync-table/(:num)'] = 'cloud/sync_tables/delete_sync_table/$1';
$route['cloud/activate-sync-table/(:num)'] = 'cloud/sync_tables/activate_sync_table/$1';
$route['cloud/deactivate-sync-table/(:num)'] = 'cloud/sync_tables/deactivate_sync_table/$1';

$route['pharmacy/validate-import'] = 'pharmacy/do_drugs_import';
$route['pharmacy/import-template'] = 'pharmacy/import_template';
$route['pharmacy/import-drugs'] = 'pharmacy/import_drugs';



/*
*	Messaging Routes
*/

$route['messaging/dashboard'] = 'messagin/dashboard';
$route['messages'] = 'messaging/unsent_messages';
$route['messaging/unsent-messages'] = 'messaging/unsent_messages';
$route['messaging/unsent-messages/(:num)'] = 'messaging/unsent_messages/$1';
$route['messaging/sent-messages'] = 'messaging/sent_messages';
$route['messaging/sent-messages/(:num)'] = 'messaging/sent_messages/$1';
$route['messaging/spoilt-messages'] = 'messaging/spoilt_messages';
$route['messaging/spoilt-messages/(:num)'] = 'messaging/spoilt_messages/$1';
// import functions of messages
$route['messaging/validate-import/(:num)'] = 'messaging/do_messages_import/$1';
$route['messaging/import-template'] = 'messaging/import_template';
$route['messaging/import-messages'] = 'messaging/import_messages';

$route['messaging/send-messages'] = 'messaging/send_messages';

$route['messaging/emails'] = 'messaging/emails';
$route['messaging/emails/(:num)'] = 'messaging/emails/$1';
$route['messaging/sms'] = 'messaging/sms';
$route['messaging/sms/(:num)'] = 'messaging/sms/$1';


/*
*	Land Owners Routes
*/

$route['real-estate-administration/property-owners'] = 'real_estate_administration/property_owners/index';
$route['real-estate-administration/property-owners/(:num)'] = 'real_estate_administration/property_owners/index/$1';
$route['real-estate-administration/property-owners/(:any)/(:any)/(:num)'] = 'real_estate_administration/property_owners/index/$1/$2/$3';
$route['real-estate-administration/property-owners/add-property-owner'] = 'real_estate_administration/property_owners/add_property_owner';
$route['real-estate-administration/property-owners/edit-property-owner/(:num)'] = 'real_estate_administration/property_owners/edit_property_owner_details/$1';
$route['real-estate-administration/property-owners/delete-property-owner/(:num)'] = 'real_estate_administration/property_owners/delete_property_owner/$1';
$route['real-estate-administration/property-owners/activate-property-owner/(:num)'] = 'real_estate_administration/property_owners/activate_property_owner/$1';
$route['real-estate-administration/property-owners/deactivate-property-owner/(:num)'] = 'real_estate_administration/property_owners/deactivate_property_owner/$1';


$route['real-estate-administration/properties'] = 'real_estate_administration/property/index';
$route['real-estate-administration/properties/(:any)/(:any)/(:num)'] = 'real_estate_administration/property/index/$1/$2/$3';
$route['real-estate-administration/properties/(:any)/(:any)'] = 'real_estate_administration/property/index/$1/$2';
$route['real-estate-administration/add-property'] = 'real_estate_administration/property/add_property';
$route['edit-property/(:num)'] = 'real_estate_administration/property/edit_property/$1';
$route['edit-property/(:num)/(:num)'] = 'real_estate_administration/property/edit_property/$1/$2';
$route['real-estate-administration/delete-property/(:num)'] = 'real_estate_administration/property/delete_property/$1';
$route['real-estate-administration/delete-property/(:num)/(:num)'] = 'real_estate_administration/property/delete_property/$1/$2';
$route['activate-property/(:num)'] = 'real_estate_administration/property/activate_property/$1';
$route['activate-property/(:num)/(:num)'] = 'real_estate_administration/property/activate_property/$1/$2';
$route['deactivate-property/(:num)'] = 'real_estate_administration/property/deactivate_property/$1';
$route['deactivate-property/(:num)/(:num)'] = 'real_estate_administration/property/deactivate_property/$1/$2';

$route['real-estate-administration/import-property-template'] = 'real_estate_administration/property/import_charges_template';
$route['real-estate-administration/import-property/(:num)'] = 'real_estate_administration/property/do_charges_import/$1';
$route['real-estate-administration/import-charges/(:num)'] = 'real_estate_administration/property/import_charges/$1';

$route['water-management/property-readings'] = 'water_management/index';
$route['import-water-readings-template'] = 'water_management/import_water_readings_template';
$route['import-water-readings'] = 'water_management/do_water_readings_import';
$route['print-water-readings/(:any)'] = 'water_management/print_water_readings/$1';
$route['add-property-readings'] = 'water_management/add_property_invoice';
$route['delete-property-invoices/(:num)'] = 'water_management/delete_property_invoice/$1';


$route['rental-units/(:num)'] = 'real_estate_administration/rental_unit/index/$1';
$route['rental-units/(:num)'] = 'real_estate_administration/rental_unit/index/$1';
$route['rental-units/(:any)/(:any)/(:num)'] = 'real_estate_administration/rental_unit/index/$1/$2/$3';
$route['rental-units/(:any)/(:any)'] = 'real_estate_administration/rental_unit/index/$1/$2';
$route['add-unit'] = 'real_estate_administration/rental_unit/add_unit';
$route['edit-rental-unit/(:num)'] = 'real_estate_administration/rental_unit/edit_rental_unit/$1';
$route['edit-rental-unit/(:num)/(:num)'] = 'real_estate_administration/rental_unit/edit_rental_unit/$1/$2';
$route['real-estate-administration/delete-unit/(:num)'] = 'real_estate_administration/rental_unit/delete_unit/$1';
$route['real-estate-administration/delete-unit/(:num)/(:num)'] = 'real_estate_administration/rental_unit/delete_unit/$1/$2';
$route['activate-rental-unit/(:num)'] = 'real_estate_administration/rental_unit/activate_rental_unit/$1';
$route['activate-rental-unit/(:num)/(:num)'] = 'real_estate_administration/rental_unit/activate_rental_unit/$1/$2';
$route['deactivate-rental-unit/(:num)'] = 'real_estate_administration/rental_unit/deactivate_rental_unit/$1';
$route['deactivate--rental-unit/(:num)/(:num)'] = 'real_estate_administration/rental_unit/deactivate_rental_unit/$1/$2';
$route['rental-management/rental-units'] = 'real_estate_administration/rental_unit/rental_units';
$route['rental-management/rental-units/(:num)'] = 'real_estate_administration/rental_unit/rental_units/$1';
$route['add-rental-unit'] = 'real_estate_administration/rental_unit/add_rental_unit';

$route['search-rental-units'] = 'real_estate_administration/rental_unit/search_rental_units';
$route['close_search_rental_units'] = 'real_estate_administration/rental_unit/close_tenants_search';



$route['tenants'] = 'real_estate_administration/tenants/index';
$route['tenants/(:num)'] = 'real_estate_administration/tenants/all_tenants/$1';
$route['rental-management/tenants'] = 'real_estate_administration/tenants/all_tenants';
$route['rental-management/tenants/(:num)'] = 'real_estate_administration/tenants/all_tenants/$1';
$route['tenants/(:num)'] = 'real_estate_administration/tenants/index/$1';
$route['activate-tenant/(:num)'] = 'real_estate_administration/tenants/activate_tenant/$1';
$route['deactivate-tenant/(:num)'] = 'real_estate_administration/tenants/deactivate_tenant/$1';
$route['edit-tenant/(:num)'] = 'real_estate_administration/tenants/edit_tenant/$1';
$route['tenants/(:num)/(:num)'] = 'real_estate_administration/tenants/index/$1/$2';
$route['tenants/(:any)/(:any)/(:num)'] = 'real_estate_administration/tenants/index/$1/$2/$3';
$route['tenants/(:any)/(:any)'] = 'real_estate_administration/tenants/index/$1/$2';


$route['add-tenant'] = 'real_estate_administration/tenants/add_tenant';
$route['add-tenant/(:num)'] = 'real_estate_administration/tenants/add_tenant/$1';
$route['add-tenant-unit/(:num)'] = 'real_estate_administration/tenants/allocate_tenant_to_unit/$1';
$route['search-tenants'] = 'real_estate_administration/tenants/search_tenants';
$route['close_search_tenants'] = 'real_estate_administration/tenants/close_tenants_search';





// leases

$route['create-new-lease/(:num)/(:num)'] = 'real_estate_administration/leases/add_lease/$1/$2';
$route['lease-management/leases'] = 'real_estate_administration/leases/index';



// cash office

$route['cash-office/accounts'] = 'accounts/index';
$route['cash-office/accounts/(:num)'] = 'accounts/index/$1';
$route['cash-office/accounts/(:num)/(:num)'] = 'accounts/index/$1/$2';
$route['search-accounts'] = 'accounts/search_accounts';
$route['search-owners-home'] = 'accounts/search_home_owners';


$route['close_search_accounts'] = 'accounts/close_accounts_search';
$route['cash-office/payments/(:num)/(:num)'] = 'accounts/payments/$1/$2';
$route['owners-payments/(:num)/(:num)'] = 'accounts/owners_payments/$1/$2';

$route['reports/all-transactions'] = 'administration/reports/all_transactions';
$route['reports/list-of-debtors'] = 'administration/reports/all_defaulters';
$route['reports/list-of-debtors/(:num)'] = 'administration/reports/all_defaulters/$1';
$route['reports/list-of-debtors-owners'] = 'administration/reports/all_defaulters_owners';
$route['reports/list-of-debtors-owners/(:num)'] = 'administration/reports/all_defaulters_owners/$1';

$route['export-defaulters'] = 'administration/reports/export_defaulters';
$route['export-defaulters-owners'] = 'administration/reports/export_defaulters_owners';
$route['export-transactions'] = 'administration/reports/export_transactions';

$route['search-transactions/(:any)'] = 'administration/reports/search_transactions/$1';
$route['search-defaulters'] = 'administration/reports/search_defaulters';
$route['search-defaulters-owners'] = 'administration/reports/search_defaulters_owners';
$route['reports/income-and-expense'] = 'administration/reports/income_and_expense';
$route['reports/income-and-expense/(:any)/(:num)'] = 'administration/reports/income_and_expense/$1/$2';



$route['real-estate-administration/points-categories'] = 'real_estate_administration/points_category/index';
$route['real-estate-administration/points-categories/(:any)/(:any)/(:num)'] = 'real_estate_administration/points_category/index/$1/$2/$3';
$route['real-estate-administration/points-categories/(:any)/(:any)'] = 'real_estate_administration/points_category/index/$1/$2';
$route['real-estate-administration/add-points-category'] = 'real_estate_administration/points_category/add_points_category';
$route['edit-points-category/(:num)'] = 'real_estate_administration/points_category/edit_points_category/$1';
$route['edit-points-category/(:num)/(:num)'] = 'real_estate_administration/points_category/edit_points_category/$1/$2';
$route['real-estate-administration/delete-points-category/(:num)'] = 'real_estate_administration/points_category/delete_points_category/$1';
$route['real-estate-administration/delete-points-category/(:num)/(:num)'] = 'real_estate_administration/points_category/delete_points_category/$1/$2';
$route['activate-points-category/(:num)'] = 'real_estate_administration/points_category/activate_points_category/$1';
$route['activate-points-category/(:num)/(:num)'] = 'real_estate_administration/points_category/activate_points_category/$1/$2';
$route['deactivate-points-category/(:num)'] = 'real_estate_administration/points_category/deactivate_points_category/$1';
$route['deactivate-points-category/(:num)/(:num)'] = 'real_estate_administration/points_category/deactivate_points_category/$1/$2';


$route['import/tenants'] = 'real_estate_administration/tenants/import_tenants';
$route['import/tenants-template'] = 'real_estate_administration/tenants/tenants_import_template';
$route['import/import-tenants'] = 'real_estate_administration/tenants/tenants_import';


$route['import/tenant-units'] = 'real_estate_administration/leases/import_tenant_units';
$route['import/tenants-units-template'] = 'real_estate_administration/leases/tenant_units_import_template';
$route['import/import-tenants-units'] = 'real_estate_administration/leases/tenant_units_import';


$route['import/home-owners'] = 'real_estate_administration/leases/import_home_owners';
$route['import/home-owners-template'] = 'real_estate_administration/leases/home_owners_import_template';
$route['import/import-home-owners'] = 'real_estate_administration/leases/home_owners_import';




$route['import/payments'] = 'accounts/import_payments';
$route['import/payments-template'] = 'accounts/payments_import_template';
$route['import/import-payments'] = 'accounts/payments_import';
$route['import/update-payment-item/(:num)'] = 'accounts/update_payment_item/$1';

$route['send-arrears/(:num)'] = 'accounts/send_arrears/$1';
$route['send-water-invoices/(:num)'] = 'water_management/send_invoices/$1';
$route['cash-office/print-receipt/(:num)/(:num)/(:num)'] = 'accounts/print_receipt/$1/$2/$3';
$route['cash-office/print-owners-receipt/(:num)/(:num)/(:num)'] = 'accounts/print_owners_receipt/$1/$2/$3';
$route['lease-statement/(:num)'] = 'accounts/print_lease_statement/$1';
$route['lease-invoices/(:num)'] = 'accounts/lease_invoices/$1';
$route['lease-invoices/(:num)/(:num)'] = 'accounts/lease_invoices/$1/$2';
$route['lease-payments/(:num)'] = 'accounts/lease_payments/$1';
$route['lease-payments/(:num)/(:num)'] = 'accounts/lease_payments/$1/$2';
$route['invoice/(:num)/(:any)/(:num)'] = 'accounts/print_invoice/$1/$2/$3';
$route['edit-invoice/(:num)/(:any)/(:num)'] = 'accounts/edit_invoice/$1/$2/$3';
$route['owners-invoice/(:num)/(:num)/(:any)/(:num)'] = 'accounts/print_owners_invoice/$1/$2/$3/$4';
$route['cash-office/send-sms/(:num)/(:num)/(:num)/(:any)/(:any)'] = 'accounts/send_sms/$1/$2/$3/$4/$5';

$route['send-owners-receipt/(:num)/(:num)/(:num)'] = 'accounts/send_owners_receipt/$1/$2/$3';

// beeee

$route['cash-office/owners'] = 'accounts/owners';
$route['cash-office/owners/(:num)'] = 'accounts/owners/$1';
$route['cash-office/owners/(:num)/(:num)'] = 'accounts/owners/$1/$2';
$route['search-owners'] = 'accounts/search_owners';
$route['close_search_owners'] = 'accounts/close_owners_search';
$route['cash-office/payments/(:num)/(:num)'] = 'accounts/payments/$1/$2';
$route['send-owners/(:num)/(:num)'] = 'accounts/send_owners/$1/$2';



$route['invoices-&-payments/tenants-invoices'] = 'accounts/tenants_invoices';
$route['invoices-&-payments/tenants-invoices/(:num)'] = 'accounts/tenants_invoices/$1';

$route['invoices-&-payments/tenants-payments'] = 'accounts/tenants_payments';
$route['invoices-&-payments/tenants-payments/(:num)'] = 'accounts/tenants_payments/$1';


$route['property-billing/(:num)'] = 'real_estate_administration/property/property_billing/$1';
$route['property-billing/(:num)/(:num)'] = 'real_estate_administration/property/property_billing/$1/$2';

$route['add-biliing/(:num)'] = 'real_estate_administration/property/add_billing/$1';
$route['add-biliing/(:num)/(:num)'] = 'real_estate_administration/property/add_billing/$1/$2';



$route['property-invoicing/(:num)'] = 'real_estate_administration/property/property_invoicing/$1';
$route['property-invoicing/(:num)/(:num)'] = 'real_estate_administration/property/property_invoicing/$1/$2';

$route['add-invoice-structure/(:num)'] = 'real_estate_administration/property/add_property_invoicing/$1';
$route['add-invoice-structure/(:num)/(:num)'] = 'real_estate_administration/property/add_property_invoicing/$1/$2';



$route['rental-management/home-owners'] = 'real_estate_administration/home_owners/all_home_owners';
$route['rental-management/home-owners/(:num)'] = 'real_estate_administration/home_owners/all_home_owners/$1';
$route['home-owners/(:num)'] = 'real_estate_administration/home_owners/index/$1';
$route['activate-home-owner/(:num)'] = 'real_estate_administration/home_owners/activate_home_owner/$1';
$route['deactivate-home-owner/(:num)'] = 'real_estate_administration/home_owners/deactivate_home_owner/$1';
$route['edit-home-owner/(:num)'] = 'real_estate_administration/home_owners/edit_home_owner/$1';
$route['home-owners/(:num)/(:num)'] = 'real_estate_administration/home_owners/index/$1/$2';
$route['home-owners/(:any)/(:any)/(:num)'] = 'real_estate_administration/home_owners/index/$1/$2/$3';
$route['home-owners/(:any)/(:any)'] = 'real_estate_administration/home_owners/index/$1/$2';

$route['add-home-owner'] = 'real_estate_administration/home_owners/add_home_owner';
$route['add-home-owner/(:num)'] = 'real_estate_administration/home_owners/add_home_owner/$1';
$route['add-home-owner-unit/(:num)'] = 'real_estate_administration/home_owners/allocate_home_owner_to_unit/$1';
$route['search-home-owners'] = 'real_estate_administration/home_owners/search_home_owners';
$route['close_search_home_owners'] = 'real_estate_administration/home_owners/close_home_owners_search';


$route['update-tenant-invoice/(:num)/(:num)/(:any)/(:num)/(:num)'] = 'accounts/update_account_invoice/$1/$2/$3/$4/$5';
$route['update-tenant-payment/(:num)/(:num)/(:num)'] = 'accounts/update_account_payment/$1/$2/$3';
$route['update-payment-detail/(:num)/(:num)'] = 'accounts/update_payment_detail/$1/$2';


$route['send-tenants-receipt/(:num)/(:num)/(:num)'] = 'accounts/send_tenants_receipt/$1/$2/$3';
