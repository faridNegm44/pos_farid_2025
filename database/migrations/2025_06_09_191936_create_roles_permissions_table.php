<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_permissions', function (Blueprint $table) {
            /////////////////////////////////////////// start first  ///////////////////////////////////////////
            /////////////////////////////////////////// start first  ///////////////////////////////////////////
                $table->id();
                // financialYears
                $table->tinyInteger("financialYears_create")->default(0);
                $table->tinyInteger("financialYears_update")->default(0);
                $table->tinyInteger("financialYears_view")->default(0);
                // stores
                $table->tinyInteger("stores_create")->default(0);
                $table->tinyInteger("stores_update")->default(0);
                $table->tinyInteger("stores_view")->default(0);
                $table->tinyInteger("stores_delete")->default(0);
                // financial_treasury
                $table->tinyInteger("financial_treasury_create")->default(0);
                $table->tinyInteger("financial_treasury_update")->default(0);
                $table->tinyInteger("financial_treasury_view")->default(0);
                $table->tinyInteger("financial_treasury_delete")->default(0);
                // units
                $table->tinyInteger("units_create")->default(0);
                $table->tinyInteger("units_update")->default(0);
                $table->tinyInteger("units_view")->default(0);
                $table->tinyInteger("units_delete")->default(0);
                // companies
                $table->tinyInteger("companies_create")->default(0);
                $table->tinyInteger("companies_update")->default(0);
                $table->tinyInteger("companies_view")->default(0);
                $table->tinyInteger("companies_delete")->default(0);
                // productsCategories
                $table->tinyInteger("productsCategories_create")->default(0);
                $table->tinyInteger("productsCategories_update")->default(0);
                $table->tinyInteger("productsCategories_view")->default(0);
                $table->tinyInteger("productsCategories_delete")->default(0);
                // products_sub_category
                $table->tinyInteger("products_sub_category_create")->default(0);
                $table->tinyInteger("products_sub_category_update")->default(0);
                $table->tinyInteger("products_sub_category_view")->default(0);
                $table->tinyInteger("products_sub_category_delete")->default(0);
                // products
                $table->tinyInteger("products_create")->default(0);
                $table->tinyInteger("products_update")->default(0);
                $table->tinyInteger("products_view")->default(0);
                $table->tinyInteger("products_delete")->default(0);
                // products_report
                $table->tinyInteger("products_report_view")->default(0);
                // taswea_products
                $table->tinyInteger("taswea_products_create")->default(0);
                $table->tinyInteger("taswea_products_view")->default(0);
                // transfer_between_stores
                $table->tinyInteger("transfer_between_stores_create")->default(0);
                $table->tinyInteger("transfer_between_stores_view")->default(0);
                // clients
                $table->tinyInteger("clients_create")->default(0);
                $table->tinyInteger("clients_update")->default(0);
                $table->tinyInteger("clients_view")->default(0);
                $table->tinyInteger("clients_delete")->default(0);
                // clients_report
                $table->tinyInteger("clients_report_view")->default(0);
                // clients_account_statement
                $table->tinyInteger("clients_account_statement_view")->default(0);
                // suppliers
                $table->tinyInteger("suppliers_create")->default(0);
                $table->tinyInteger("suppliers_update")->default(0);
                $table->tinyInteger("suppliers_view")->default(0);
                $table->tinyInteger("suppliers_delete")->default(0);
                // suppliers_report
                $table->tinyInteger("suppliers_report_view")->default(0);
                // suppliers_account_statement
                $table->tinyInteger("suppliers_account_statement_view")->default(0);
                // taswea_client_supplier
                $table->tinyInteger("taswea_client_supplier_create")->default(0);
                $table->tinyInteger("taswea_client_supplier_view")->default(0);
                // partners
                $table->tinyInteger("partners_create")->default(0);
                $table->tinyInteger("partners_update")->default(0);
                $table->tinyInteger("partners_view")->default(0);
                $table->tinyInteger("partners_delete")->default(0);
                // partners_report
                $table->tinyInteger("partners_report_view")->default(0);
                // partners_account_statement
                $table->tinyInteger("partners_account_statement_view")->default(0);
                // taswea_partners
                $table->tinyInteger("taswea_partners_create")->default(0);
                $table->tinyInteger("taswea_partners_view")->default(0);
                // sales
                $table->tinyInteger("sales_create")->default(0);
                $table->tinyInteger("sales_return")->default(0);
                $table->tinyInteger("sales_view")->default(0);
                // sales_return
                $table->tinyInteger("sales_return_view")->default(0);
                // products_stock_alert
                $table->tinyInteger("products_stock_alert_view")->default(0);
                // purchases
                $table->tinyInteger("purchases_create")->default(0);
                $table->tinyInteger("purchases_return")->default(0);
                $table->tinyInteger("purchases_view")->default(0);
                // purchases_return
                $table->tinyInteger("purchases_return_view")->default(0);
                // treasury_bills
                $table->tinyInteger("treasury_bills_create")->default(0);
                $table->tinyInteger("treasury_bills_view")->default(0);
                // treasury_bills_report
                $table->tinyInteger("treasury_bills_report_view")->default(0);
                // transfer_between_storages
                $table->tinyInteger("transfer_between_storages_create")->default(0);
                $table->tinyInteger("transfer_between_storages_view")->default(0);
                // expenses
                $table->tinyInteger("expenses_create")->default(0);
                $table->tinyInteger("expenses_view")->default(0);
                $table->tinyInteger("expenses_delete")->default(0);
                // expenses_report
                $table->tinyInteger("expenses_report_view")->default(0);
                // users
                $table->tinyInteger("users_create")->default(0);
                $table->tinyInteger("users_update")->default(0);
                $table->tinyInteger("users_view")->default(0);
                $table->tinyInteger("users_delete")->default(0);
                // settings
                $table->tinyInteger("settings_update")->default(0);
                $table->tinyInteger("settings_view")->default(0);
                // roles_permissions
                $table->tinyInteger("roles_permissions_create")->default(0);
                $table->tinyInteger("roles_permissions_update")->default(0);
                $table->tinyInteger("roles_permissions_view")->default(0);
                $table->tinyInteger("roles_permissions_delete")->default(0);
                
                $table->timestamps();
            /////////////////////////////////////////// end first  ///////////////////////////////////////////
            /////////////////////////////////////////// end first  ///////////////////////////////////////////
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_permissions');
    }
};
