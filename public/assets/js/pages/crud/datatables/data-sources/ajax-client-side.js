'use strict';
var KTDatatablesDataSourceAjaxClient = function() {

    var initTable1 = function() {
        var table = $('#kt_datatable');

        // begin first table
        table.DataTable({
            responsive: true,
            ajax: {
                url: APP_URL +'/admin/get-users',
                type: 'GET',
                data: {
                    pagination: {
                        perpage: 50,
                    },
                },
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'is_active', name: 'is_active'},
                {data: 'action', name: 'action'},


            ],
            columnDefs: [
                {
                    width: '75px',
                    targets: -2,
                    render: function(data, type, full, meta) {
                        var is_active = {
                            false: {'title': 'Online', 'state': 'danger'},
                            true: {'title': 'Active', 'state': 'primary'},
                            3: {'title': 'Direct', 'state': 'success'},
                        };

                        if (typeof is_active[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-' + is_active[data].state + ' label-dot mr-2"></span>' +
                            '<span class="font-weight-bold text-' + is_active[data].state + '">' + is_active[data].title + '</span>';
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
