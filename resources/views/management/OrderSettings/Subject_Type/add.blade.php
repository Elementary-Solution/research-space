<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="create_questions">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Add New Subject</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>





            <div class="academic_level">

                <div class="modal-body">
                    <form action="{{route('subject_type.store')}}" method="post">
                        @csrf
                        <label for="email_address1">Status</label>
                        <div class="row">
                            <div class="col-sm-3 col-lg-3">
                                <div class="form-check form-check-radio">
                                    <label>
                                        <input checked name="erp_status" type="radio" value="1" />
                                        <span>Enable</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-lg-3">
                                <div class="form-check form-check-radio">
                                    <label>
                                        <input name="erp_status" type="radio" value="0" />
                                        <span>Disable</span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <label for="email_address1">New Subject:</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="email_address1"
                                       class="form-control" name="erp_subject_name"
                                       placeholder="Type Subject type name Here">
                            </div>
                        </div>



                        <br>
                        {{--                                            <button type="button"--}}
                        {{--                                                    class="btn btn-primary m-t-15 waves-effect">LOGIN</button>--}}

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger waves-effect"
                                    data-dismiss="modal">Close</button>
                            <button type="submit"
                                    class="btn btn-info waves-effect" >Create New Subject</button>
                        </div>
                    </form>


                </div>
            </div>




        </div>
    </div>

</div>
