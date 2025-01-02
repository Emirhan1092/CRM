function Industry() {

    "use strict";

    var self = this;

    this.initFilters = function () {
        $("#status").off();
        $("#status").change(function () {
            self.initIndustryDatatable();
        });
        $('.select2').select2();
    };

    this.initIndustryDatatable = function () {
        $('#industries_datatable').DataTable({
            "aaSorting": [[ 1, 'desc' ]],
            "columnDefs": [{"orderable": false, "targets": [3]}],
            "lengthMenu": [[10, 25, 50, 100000000], [10, 25, 50, "All"]],
            "searchDelay": 2000,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "type": "POST",
                "url": application.url+'/admin/industries/data',
                "data": function ( d ) {
                    d.status = $('#status').val();
                    d._token = application._token;
                },
                "complete": function (response) {
                    self.initIndustryCreateOrEditForm();
                    self.initIndustryChangeStatus();
                    self.initIndustryDelete();
                    $('.table-bordered').parent().attr('style', 'overflow:auto'); //For responsive
                },
            },
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'info': true,
            'autoWidth': false,
            'destroy':true,
            'stateSave': true,
            'responsive': false
        });
    };

    this.initIndustryCreateOrEditForm = function () {
        $('.create-or-edit-industry').off();
        $('.create-or-edit-industry').on('click', function () {
            var modal = '#modal-default';
            var id = $(this).data('id');
            id = id ? '/'+id : '';
            var modal_title = id ? lang['edit_industry'] : lang['create_industry'];
            $(modal).modal('show');
            $(modal+' .modal-title').html(modal_title);
            application.load('/admin/industries/create-or-edit'+id, modal+' .modal-body-container', function (result) {
                self.initIndustrySave();
            });
        });
    };

    this.initIndustrySave = function () {
        application.onSubmit('#admin_industries_create_update_form', function (result) {
            application.showLoader('admin_industries_create_update_form_button');
            application.post('/admin/industries/save', '#admin_industries_create_update_form', function (res) {
                var result = JSON.parse(application.response);
                if (result.success === 'true') {
                    $('#modal-default').modal('hide');
                    self.initIndustryDatatable();
                } else {
                    application.hideLoader('admin_industries_create_update_form_button');
                    application.showMessages(result.messages, 'admin_industries_create_update_form .modal-body');
                }
            });
        });
    };
    
    this.initIndustryChangeStatus = function () {
        $('.change-industry-status').off();
        $('.change-industry-status').on('click', function () {
            var button = $(this);
            var id = $(this).data('id');
            var status = parseInt($(this).data('status'));
            button.html("<i class='fa fa-spin fa-spinner'></i>");
            button.attr("disabled", true);
            application.load('/admin/industries/status/'+id+'/'+status, '', function (result) {
                button.removeClass('btn-success');
                button.removeClass('btn-danger');
                button.addClass(status === 1 ? 'btn-danger' : 'btn-success');
                button.html(status === 1 ? lang['inactive'] : lang['active']);
                button.data('status', status === 1 ? 0 : 1);
                button.attr("disabled", false);
                button.attr("title", status === 1 ? lang['click_to_activate'] : lang['click_to_deactivate']);
            });
        });
    };
    
    this.initIndustryDelete = function () {
        $('.delete-industry').off();
        $('.delete-industry').on('click', function () {
            var status = confirm(lang['are_u_sure']);
            var id = $(this).data('id');
            if (status === true) {
                application.load('/admin/industries/delete/'+id, '', function (result) {
                    self.initIndustryDatatable();
                });
            }
        });
    };
}

$(document).ready(function() {
    var industry = new Industry();
    industry.initFilters();
    industry.initIndustryDatatable();
});