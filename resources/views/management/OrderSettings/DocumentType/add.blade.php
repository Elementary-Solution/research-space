<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="create_questions">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Document Template</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('document_type.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="email_address1">Status</label>
                        <div class="row">
                            <div class="col-sm-3 col-lg-3">
                                <div class="form-check form-check-radio">
                                    <label>
                                        <input checked name="erp_status" class="erp_status" type="radio" value="1" />
                                        <span>Enable</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-lg-3x">
                                <div class="form-check form-check-radio">
                                    <label>
                                        <input name="erp_status" class="erp_status" type="radio" value="0" />
                                        <span>Disable</span>
                                    </label>
                                </div>
                            </div>

                        </div>
                        <label for="email_address1">Title</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="email_address1"
                                       class="form-control" name="erp_document_title"
                                       placeholder="Type title Here">
                            </div>
                        </div>
                        <label for="email_address1">Message</label>
                        <textarea name="erp_document_message"  class="form-control" id="comment_text" cols="30" rows="10"></textarea>
                        <br>
            <div class="file_upload">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">File Upload</h5>
                </div>
            </div>
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>File</span>
                                <input name="erp_document_file" type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" name="erp_document_file" type="text">
                            </div>
                        </div>

                        <br>
                        {{--                                            <button type="button"--}}
                        {{--                                                    class="btn btn-primary m-t-15 waves-effect">LOGIN</button>--}}
                        <div class="modal-footer">
                            <button type="" class="btn btn-danger waves-effect"
                                    data-dismiss="modal">Close</button>
                            {{--                                                        data-dismiss="modal" use in ajax--}}
                            <button type="submit"
                                    class="btn btn-info waves-effect">Create Document Type</button>
                        </div>
                    </form>
                </div> </div>
        </div>
    </div>
</div>
