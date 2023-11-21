
<div class="modal fade" id="exampleModal2{{$announcements->id}}" tabindex="-1" role="dialog"
     aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="create_questions">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Edit Announcement</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form action="{{route('announcement.update',$announcements->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <label for="">Status</label>
                        <div class="row">
                            <div class="col-sm-3 col-lg-3">
                                <div class="form-check form-check-radio">
                                    <label>
                                        <input {{$announcements->erp_status == '1' ? 'checked' : ''}} name="erp_status" class="erp_status" type="radio"  value="1" />
                                        <span>Enable</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-lg-3">
                                <div class="form-check form-check-radio">
                                    <label>
                                        <input {{$announcements->erp_status == '0' ? 'checked' : ''}} name="erp_status" class="erp_status" type="radio" value="0" />
                                        <span>Disable</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <label for="">Title </label>
                        <div class="form-group">
                            <div class="form-line">
                            </div>
                            <input  value=" {{$announcements->erp_title}}"  type="text" id="erp_question_text"
                                    class="form-control" name="erp_title"
                                    placeholder="Type title Here">
                        </div>



                        <div class="">
                            <label for="email_address1">Message</label>
                            <textarea  name="erp_message"  class="form-control" id="erp_comment_text" cols="30" rows="10">  {{$announcements->erp_message}}</textarea>
                        </div>



                        <div class="file-field input-field">
                            <div class="btn">
                                <span>File</span>
                                <input    name="erp_file" type="file">
                            </div>

                            <div class="file-path-wrapper">
                                <input  value=" {{$announcements->erp_file}}" class="file-path validate" name="erp_file" type="text">
                            </div>

                            <div class=" container d-flex justify-content-center" >
                                @if (in_array($extension = pathinfo($announcements['erp_file'], PATHINFO_EXTENSION), ['jpg', 'png', 'bmp','jpeg','PNG',]))


                                    <img style="" src="{{asset('image/announcement'.'/'.$announcements->erp_file)}}" height="200px" width="200px">
                                @elseif($announcements->erp_file == "")

                                @else
                                    <i class="fa fa-file fa-3x" aria-hidden="true" height="200px" width="200px"> </i>
                                @endif
                            </div> </div>



                        <div class="time mt-2">
                            <label for="email_address1">Select timing of posting</label>
                            <div class="mt-4 test">


                                <select class="form-control select2 " name="erp_timetype"  data-placeholder="Select">

                                    <option {{$announcements->erp_timetype == 'immediate' ? 'selected' : ''}} value="immediate">immediately</option>
                                    <option {{$announcements->erp_timetype == 'date' ? 'selected' : ''}} value="date">Date & Time</option>

                                </select>



                            <div class="mt-4 ic" >

                                <input value="{{$announcements->erp_timetype =='date' ? $announcements->erp_timetype : '' }}" type="date"  name="Date">
                            </div>

                        </div>





                </div>
            </div>
            <div class="modal-footer">
                <button type="" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel
                </button>
                <button type="submit" class="btn btn-info waves-effect" >
                    update Announcement
                </button>
            </div>
        </div>
    </div>
    </form>
</div>
</div>



