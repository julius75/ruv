'use strict';
var KTDatatablesDataSourceAjaxClient = function() {
    var initTable1 = function() {
        var table = $('#kt_datatable');
        table.DataTable({
            responsive: true,
            ajax: {
                url: APP_URL +'/admin/datatables/get-app-transactions',
                type: 'GET',
                data: {
                    pagination: {
                        perpage: 50,
                    },
                },
            },
            order:[6, 'desc'],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'reference_number', name: 'reference_number'},
                {data: 'customer_details', name: 'customer_details'},
                {data: 'amount', name: 'amount'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'vendor_details', name: 'vendor_details'},
                {data: 'transaction_status', name: 'transaction_status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action'},
            ],
            columnDefs: [
            ],
        });
    };
    return {
        //main function to initiate the module
        init: function() {
            initTable1();
        },
    };
}();
jQuery(document).ready(function() {
    KTDatatablesDataSourceAjaxClient.init();
});
