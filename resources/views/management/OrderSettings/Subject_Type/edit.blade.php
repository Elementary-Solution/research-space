<div class="modal fade" id="exampleModal1{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="create_questions">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Edit Subject Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>

            <div class="academic_level">

                <div class="modal-body">
                    <form action="{{route('subject_type.update',$row->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <label for="email_address1">Status</label>
                        <div class="row">
                            <div class="col-sm-3 col-lg-3">
                                <div class="form-check form-check-radio">
                                    <label>
                                        <input name="erp_status" {{$row->erp_status == '1' ? 'checked' : ''}} type="radio" value="1" />
                                        <span>Enable</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-lg-3">
                                <div class="form-check form-check-radio">
                                    <label>
                                        <input name="erp_status" {{$row->erp_status == '0' ? 'checked' : ''}} type="radio" value="0" />
                                        <span>Disable</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                </div>



                <div class="academic_level">
                    <div class="modal-body">
                        <form>
                            <label for="email_address1">Edit Subject Type</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="email_address1" value="{{$row->erp_subject_name}}" class="form-control" name="erp_subject_name" placeholder="Enter Subject Type">
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info waves-effect">Update Subject Type</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
