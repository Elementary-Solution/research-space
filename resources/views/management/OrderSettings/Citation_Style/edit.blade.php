<div class="modal fade" id="exampleModal1{{$row->id}}" tabindex="-1" role="dialog"
     aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="create_questions">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Post a New Announcement</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('citation_style.update',$row->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label for="email_address1">Status</label>
                        <div class="row">
                            <div class="col-sm-3 col-lg-3">
                                <div class="form-check form-check-radio">
                                    <label>
                                        <input name="erp_status" {{$row->erp_status == '1' ? 'checked' : ''}} class="erp_status" type="radio"  value="1" />
                                        <span>Enable</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-lg-3">
                                <div class="form-check form-check-radio">
                                    <label>
                                        <input name="erp_status" {{$row->erp_status == '0' ? 'checked' : ''}} class="erp_status" type="radio" value="0" />
                                        <span>Disable</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label for="email_address1">Title </label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="erp_question_text"
                                       class="form-control" name="erp_title"  value="{{$row->erp_title}}"
                                       placeholder="Type title Here">
                            </div>
                        </div>
                            <div class="erp_comment_text">
                                <label for="email_address1">Message</label>
                                <textarea name="erp_citation_message"  class="form-control" id="erp_comment_text" cols="30" rows="10">{{$row->erp_title}}</textarea>
                            </div>
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>File</span>
                                <input    name="erp_file_type" type="file">
                            </div>

                            <div class="file-path-wrapper">
                                <input  value="{{$row->erp_file_type}}" class="file-path validate" name="erp_file_type" type="text">
                            </div>

                            <div class=" container d-flex justify-content-center" >
                                @if (in_array($extension = pathinfo($row['erp_file_type'], PATHINFO_EXTENSION), ['jpg', 'png', 'bmp','jpeg','PNG',]))


                                    <img style="" src="{{asset('citation'.'/'.$row->erp_file_type)}}" height="200px" width="200px">
                                @elseif($row->erp_file_type == "")

                                @else
                                    <i class="fa fa-file fa-3x" aria-hidden="true" height="200px" width="200px"> </i>
                                @endif
                            </div>


                </div>
                                <label for="email_address1">Select timing of posting</label>
                                <div class="test">
                                    <select class="form-control select2 test" name="erp_datetime"  data-placeholder="Select">
                                        <option {{$row->erp_datetime == 'immediate' ? 'selected' : ''}} value="immediate">immediately</option>
                                        <option {{$row->erp_datetime == 'date' ? 'selected' : ''}} value="erp_date">Date & Time</option>
                                    </select>
                                <div class="mt-4 dte" id="">
                                    <input value="{{$row->erp_datetime =='date' ? $row->erp_datetime : '' }}" type="date"  name="erp_date">
                                </div></div>
                </div>
                <div class="modal-footer">
                    <button type="" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel
                    </button>
                    <button type="submit" class="btn btn-info waves-effect" >
                        Update Citation Style
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
