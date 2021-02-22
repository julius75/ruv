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
            columns: [
                {data: 'id', name: 'id'},
                {data: 'customer_name', name: 'customer_name'},
                {data: 'amount', name: 'amount'},
                {data: 'phone_number', name: 'phone_number'},
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
