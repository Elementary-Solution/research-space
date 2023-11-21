
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="create_questions">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Create Announcement</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="" action="{{route('announcement.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="email_address1">Status</label>
                        <div class="row">
                            <div class="col-sm-3 col-lg-3">
                                <div class="form-check form-check-radio">
                                    <label>
                                        <input name="erp_status" class="erp_status" type="radio"  value="1" />
                                        <span>Enable</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-lg-3">
                                <div class="form-check form-check-radio">
                                    <label>
                                        <input name="erp_status" class="erp_status" type="radio" value="0" />
                                        <span>Disable</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label for="email_address1">Title </label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="erp_question_text"
                                       class="form-control" name="erp_title"
                                       placeholder="Type title Here">
                            </div>
                        </div>
                        <div class="erp_comment_text">
                            <div class="erp_comment_text">
                                <label for="email_address1">Message</label>
                                <textarea name="erp_message"  class="form-control" id="erp_comment_text" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>File</span>
                                <input name="erp_file" type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" name="erp_file" type="text">
                            </div>
                        </div>
                        <label for="email_address1">Select timing of posting</label>
                        <div class="mt-4">
                            <div class="test">
                                <select class="form-control select2 " id="" name="erp_timetype" data-placeholder="Select">
                                    <option value="immediate">immediately</option>
                                    <option value="date">Date & Time</option>
                                </select>
                                <div class="mt-4 ic " id="">
                                    <input type="date"  name="Date">
                                </div>
                            </div>
                        </div>
                </div>
            
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel
                </button>
                <button type="submit" class="btn btn-info waves-effect" >
                    Create Announcement
                </button>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
