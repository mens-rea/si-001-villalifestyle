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
|	http://codeigniter.com/user_guide/general/routing.html
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

/*$route['default_controller'] = 'login';*/
/*POS*/
$route['default_controller'] = 'authenticate'; //aauth sample
$route['404_override'] = '';
$route['restricted'] = 'authenticate/user_restriction';

/*$route['(:any)'] = 'signed_in/$1';

$route['translate_uri_dashes'] = FALSE;*/


/*POS*/

//auth
$route['account-login'] = 'authenticate/user_login';
$route['logout'] = 'authenticate/logout';

//redirect controllers per account type
$route['admin'] = 'admin';
$route['tenant'] = 'tenant';
$route['cashier'] = 'cashier';

//admin actions
$route['admin/report-inventory'] = 'admin/view_inventory';
$route['admin/report-sales'] = 'admin/view_sales_report_all';
$route['admin/suggest-more-admin-sales-data'] = 'admin/suggest_more_admin_sales_data';
$route['admin/suggest-more-admin-all-sales-data'] = 'admin/suggest_more_admin_all_sales_data';
$route['admin/suggest-more-admin-fdate-sales-data'] = 'admin/suggest_more_admin_fdate_sales_data';
$route['admin/remove-item/(:any)'] = 'admin/remove_item/$1';
$route['admin/remove-delivery-item'] = 'admin/remove_delivery_item';
$route['remove-delivery-item'] = 'admin/remove_delivery_item';
$route['edit-delivery-item'] = 'admin/edit_delivery_item';
$route['admin/report-delivery'] = 'admin/view_delivery';
$route['admin/report-approved-delivery'] = 'admin/view_approved_delivery';
$route['admin/report-rejected-delivery'] = 'admin/view_rejected_delivery';
$route['admin/report-pullout'] = 'admin/view_pullout';
$route['admin/report-approved-pullout'] = 'admin/view_approved_pullout';
$route['admin/report-rejected-pullout'] = 'admin/view_rejected_pullout';
$route['admin/delivery-notification'] = 'admin/delivery_notification';
$route['admin/view-dt-details/(:any)'] = 'admin/view-dt-details/$1';
$route['admin/create-account'] = 'authenticate/create_account'; //view
$route['admin/create-user'] = 'authenticate/create_user'; //action
$route['admin/report-user'] = 'authenticate/view_user_list'; //action
$route['admin/user-update'] = 'authenticate/update_user'; //action
$route['admin/report-item-category'] = 'admin/view_item_category_list';
$route['admin/add-category'] = 'admin/add_item_category';
$route['admin/edit-item'] = 'admin/edit_item';
$route['admin/print-barcode/(:any)'] = 'admin/print_barcode/$1';

$route['admin/void_sales'] = 'admin/void_sales';
//$route['admin/pullout-item'] = 'admin/input_pullout_item';

//tenant actions
$route['tenant/add-items'] = 'tenant/add_items';
$route['tenant/report-inventory'] = 'tenant/view_inventory';
$route['tenant/report-sales'] = 'tenant/view_sales_report';
$route['tenant/add-delivery-items'] = 'tenant/add_delivery_items';
$route['tenant/remove-delivery-item'] = 'tenant/remove_delivery_item';
$route['tenant/edit-delivery-item'] = 'tenant/edit_delivery_item';
$route['tenant/print-barcode/(:any)'] = 'tenant/print_barcode/$1';
$route['tenant/report-delivery'] = 'tenant/view_delivery';
$route['tenant/view-dt-details/(:any)'] = 'tenant/view-dt-details/$1';
$route['tenant/report-pullout'] = 'tenant/view_pullout';
$route['tenant/pullout-item'] = 'tenant/input_pullout_item';
$route['tenant/edit-item'] = 'tenant/edit_item';
$route['tenant/edit-user-info'] = 'authenticate/edit_user_info';
$route['tenant/user-update'] = 'authenticate/update_user';

//$route['tenant/approve-pullout'] = 'tenant/approve_pullout/(:num)';

$route['add-delivery'] = 'tenant/add_delivery';
$route['add-delivery-transaction'] = 'tenant/add_delivery_transaction';

//cashier actions

$route['cashier/add-sales'] = 'cashier/add_sales';
$route['add-sales'] = 'cashier/add_sales';
$route['cashier/add-sales-transaction'] = 'cashier/add_sales_transaction';
$route['add-sales-transaction'] = 'cashier/add_sales_transaction';

$route['cashier/report-sales'] = 'cashier/view_sales_report_all';
$route['cashier/report-delivery'] = 'cashier/view_delivery';
$route['cashier/report-approved-delivery'] = 'cashier/view_approved_delivery';
$route['cashier/report-rejected-delivery'] = 'cashier/view_rejected_delivery';
$route['cashier/view-dt-details/(:any)'] = 'cashier/view-dt-details/$1';
$route['cashier/report-pullout'] = 'cashier/view_pullout';
$route['cashier/report-approved-pullout'] = 'cashier/view_approved_pullout';
$route['cashier/report-rejected-pullout'] = 'cashier/view_rejected_pullout';
$route['cashier/edit-user-info'] = 'authenticate/edit_user_info';
$route['cashier/user-update'] = 'authenticate/update_user';
$route['cashier/void_sales'] = 'cashier/void_sales';

$route['cashier/suggest-more-cashier-sales-data'] = 'cashier/suggest_more_cashier_sales_data';
$route['cashier/suggest-more-cashier-all-sales-data'] = 'cashier/suggest_more_cashier_all_sales_data';
$route['cashier/suggest-more-cashier-fdate-sales-data'] = 'cashier/suggest_more_cashier_fdate_sales_data';

//filter function
$route['filter-sales'] = 'Sales/filter_sales_date';
$route['filter-month'] = 'Sales/filter_month';
$route['cashier/filter-sales-month'] = 'cashier/filter_sales_month';
$route['admin/filter-sales-month'] = 'admin/filter_sales_month';
$route['tenant/filter-sales-month'] = 'tenant/filter_sales_month';

$route['admin/filter-inventory-item'] = 'admin/filter_inventory_item';

$route['admin/filter-pending-delivery-transaction'] = 'admin/filter_pending_delivery_transaction';
$route['admin/filter-approved-delivery-transaction'] = 'admin/filter_approved_delivery_transaction';
$route['admin/filter-rejected-delivery-transaction'] = 'admin/filter_rejected_delivery_transaction';

$route['cashier/filter-pending-delivery-transaction'] = 'cashier/filter_pending_delivery_transaction';
$route['cashier/filter-approved-delivery-transaction'] = 'cashier/filter_approved_delivery_transaction';
$route['cashier/filter-rejected-delivery-transaction'] = 'cashier/filter_rejected_delivery_transaction';


$route['admin/filter-pending-pullout-transaction'] = 'admin/filter_pending_pullout_transaction';
$route['admin/filter-approved-pullout-transaction'] = 'admin/filter_approved_pullout_transaction';
$route['admin/filter-rejected-pullout-transaction'] = 'admin/filter_rejected_pullout_transaction';


$route['cashier/filter-pending-pullout-transaction'] = 'cashier/filter_pending_pullout_transaction';
$route['cashier/filter-approved-pullout-transaction'] = 'cashier/filter_approved_pullout_transaction';
$route['cashier/filter-rejected-pullout-transaction'] = 'cashier/filter_rejected_pullout_transaction';

$route['pullout-item'] = 'pullout/input_pullout_item';
$route['delivery-transaction'] = 'tenant/add_delivery_transaction';

$route['report-delivery'] = 'delivery';
$route['report-sales'] = 'sales';
$route['verify-item'] = 'items/verify_item';

//ajax functions
$route['ajax-demo'] = 'ajax_demo';
$route['give-more-data'] = 'ajax_demo/give_more_data';
$route['suggest-more-data'] = 'ajax_demo/suggest_more_data';
$route['suggest-more-data-code'] = 'ajax_demo/suggest_more_data_code';

$route['tenant/deliver-more-data'] = 'tenant/deliver_more_data';
$route['deliver-more-data'] = 'tenant/deliver_more_data';
$route['cashier/sales-more-data'] = 'cashier/sales_more_data';
$route['sales-more-data'] = 'cashier/sales_more_data';

/*$route['default_controller'] = 'signup';*/
/*$route['default_controller'] = 'example'; --for aauth sample*//*
$route['(:any)'] = 'signed_in/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['main'] = 'signup';

$route['income-view'] = 'income';
$route['expense-view'] = 'expense';
$route['withdrawal-view'] = 'withdrawal';
$route['reporting-view'] = 'reporting';
$route['project-view'] = 'project';

$route['filter-report'] = 'reporting/filter_report_date';

$route['add-income'] = 'income/add_income';
$route['add-expense'] = 'expense/add_expense';
$route['add-withdrawal'] = 'withdrawal/add_withdrawal';
$route['add-project'] = 'project/add_project';

$route['filter-income'] = 'income/filter_income_date';
$route['filter-expense'] = 'expense/filter_expense_date';
$route['filter-withdrawal'] = 'withdrawal/filter_withdrawal_date';*/
