@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
    <!--end::Notice-->
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">RUV Airtime Providers</h3>
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable" style="margin-top: 13px !important">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Date Created</th>
                </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->
@endsection
@section('scripts')
    <script>
        'use strict';
        var KTDatatablesDataSourceAjaxClient = function() {
            var initTable1 = function() {
                var table = $('#kt_datatable');
                // begin first table
                table.DataTable({
                    responsive: true,
                    ajax: {
                        url: '{{route('admin.get-providers')}}',
                        type: 'GET',
                        data: {
                            pagination: {
                                perpage: 1000,
                            },
                        },
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'image', name: 'image'},
                        {data: 'name', name: 'name'},
                        {data: 'created_at', name: 'created_at'},
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
    </script>
@endsection

