<!-- Plugins Js -->
<script src="{{asset('management/js/app.min.js')}}"></script>
<script src="{{asset('management/js/chart.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('management/js/admin.js')}}"></script>
<script src="{{asset('management/js/pages/index.js')}}"></script>
<script src="{{asset('management/js/pages/charts/jquery-knob.js')}}"></script>
<script src="{{asset('management/js/pages/sparkline/sparkline-data.js')}}"></script>
<script src="{{asset('management/js/pages/medias/carousel.js')}}"></script>
<script src="{{asset('management/js/pages/forms/basic-form-elements.js')}}"></script>
<script src="{{asset('management/js/form.min.js')}}"></script>
<script  src="{{asset('management/js/jquery.dataTables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
<script src="https://cdn.tiny.cloud/1/4j9bq6sx1bfvu1ttvrzaiuyh0vum4x410pyov0w8w46sv6cf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


{{--<script src="{{asset('management/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>--}}
{{--<script src="{{asset('management/js/app.min.js')}}"></script>--}}

{{--<script src="{{asset('management/js/form.min.js')}}"></script>--}}
{{--<script src="{{asset('management/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>--}}
{{--<script src="{{asset('management/js/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js')}}"></script>--}}
{{--<!-- Custom Js -->--}}
{{--<script src="{{asset('management/js/admin.js')}}"></script>--}}
{{--<script src="{{asset('management/js/pages/forms/advanced-form-elements.js')}}"></script>--}}




<script>

    $(document).ready( function () {
        $('#myTable').DataTable({
            order: [[0, 'desc']],
        });
        $('#myTable2').DataTable(
            {
                pageLength : 25,
                lengthMenu: [[5, 10, 25, 50,100], [5, 10, 25, 50,100]]
            }
        );
        $('#myTable3').DataTable(
            {
                pageLength : 25,
                lengthMenu: [[5, 10, 25, 50,100], [5, 10, 25, 50,100]]
            }
        );
        $('#myTable4').DataTable(
            {
                pageLength : 25,
                lengthMenu: [[5, 10, 25, 50,100], [5, 10, 25, 50,100]]
            }
        );
    } );


{{--Question Checkbox Adding--}}





</script>
<script>




</script>
@yield('script')






<script  src="//cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
{{--Text editor--}}
<script src="https://cdn.tiny.cloud/1/gkvyt9df3d1o1tzdwtfp9rz10d1i3uu54lylmdwadcdcbx9d/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.ckeditor',

        image_class_list: [
            {title: 'img-responsive', value: 'img-responsive'},
        ],
        height: 200,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
        },
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste imagetools"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",

        image_title: true,
        automatic_uploads: true,
        images_upload_url: './js/tinymce/postAcceptor.php',

        file_picker_types: 'image',
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function() {
                var file = this.files[0];

                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    var id = 'blog' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                };
            };
            input.click();
        }
    });
    // setTimeout(function (){
    //     $('.ckeditor').show();
    // }, 5000);









    $(document).ready(function () {
        if (window.File && window.FileList && window.FileReader) {
            $(document).on("change",'.main_file', function (e) {

                var img = $(this).parents(".imagebox").find(".img-thumb");
                var btn = $(this);
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    btn.parents(".main_container").find(".remove").css({ display: "flex" });
                    var f = files[i];
                    var fileReader = new FileReader();
                    fileReader.onload = function (e) {
                        var file = e.target;
                        console.log(file);
                        $(img).html(
                            `<img class="main_img d-block w-100 h-100 position-absolute" src="${e.target.result}">`
                        );
                        // $(".remove").click(function () {
                        //     this.style.display = "none";
                        //     $(this).parents(".main_container").find(".main_img").remove();
                        //     file.value = "";
                        // });
                    };
                    fileReader.readAsDataURL(f);
                }
                console.log(files);
            });
        } else {
            alert("Your browser doesn't support to File API");
        }
    });









</script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.remove_lol', function () {
            var likeaction = $(this).data('id');

            var actionperformer = $(this);
            $.ajax({
                type: 'POST',
                url: "{{url('image-delete')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: likeaction,
                },
                dataType: "json",
                beforeSend: function () {
                    $(".ajaxpreload").show();
                },
                success: function (data) {
                    if(data){
                        $(actionperformer).parents('.image-box').find('img').remove()
                    }

                }
            });



        });
    });

</script>


<style>

    .main_img {
        top: 0;
        left: 0;
        z-index: inherit;
        object-fit: contain;
        background: white;
    }

    .select_img {
        /* width: 300px; */
        height: 300px;
        background: #eee !important;
    }

    .select_img .select_btn {
        padding: 3px 7px;
        border-radius: 7px;
        background-color: #3b589d1c;
        color: #3b589d;
        font-size: 14px;
        font-weight: 600;
    }

    .main_file {
        top: 0;
        left: 0;
        z-index: 5;
        opacity: 0 !important;
        background:  transparent;
    }


    .main {
        transition: .3s;
        border: 2px dotted #8f8f8f82;
        width: 100%;
    }

    .main:hover {
        border-radius: 7px;
        border: 2px dotted #3b589d;
        background-color: #3b589d0e;
    }

    .remove {
        display: none;
    }

    .btn {
        color: #3b589d;
    }
</style>





@yield('script')
</body>
</html>
