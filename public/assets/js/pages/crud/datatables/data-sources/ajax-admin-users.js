'use strict';
var KTDatatablesDataSourceAjaxClient = function() {

    var initTable1 = function() {
        var table = $('#kt_datatable');

        // begin first table
        table.DataTable({
            responsive: true,
            ajax: {
                url: APP_URL +'/admin/datatables/get-app-admins',
                type: 'GET',
                data: {
                    pagination: {
                        perpage: 50,
                    },
                },
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'},
            ],
            columnDefs: [
                {
                    width: '75px',
                    targets: -2,
                    render: function(data, type, full, meta) {
                        var is_active = {
                            0: {'title': 'Suspended', 'class': ' label-light-danger'},
                            1: {'title': 'Active', 'class': ' label-light-success'},
                            3: {'title': 'Direct', 'state': 'success'},
                        };

                        if (typeof is_active[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-lg font-weight-bold' + is_active[data].class + ' label-inline">' + is_active[data].title + '</span>';

                    },
                },
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
