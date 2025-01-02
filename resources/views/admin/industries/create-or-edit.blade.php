<form id="admin_industries_create_update_form">
    <input type="hidden" name="industry_id" value="{{ $industry['industry_id'] }}" />
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{__('message.title') }}</label>
                    <input type="text" class="form-control" name="title" value="{{ $industry['title'] }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __('message.status') }}</label>
                    <select class="form-control" name="status">
                        <option value="0" {{ sel($industry['status'], '0') }}>{{ __('message.no') }}</option>
                        <option value="1" {{ sel($industry['status'], '1') }}>{{ __('message.yes') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{__('message.close') }}</button>
        <button type="submit" class="btn btn-primary btn-blue" id="admin_industries_create_update_form_button">{{__('message.save') }}</button>
    </div>
</form>