@extends('management.layouts.master')
@section('title')
    Manage Order
@endsection
@section('content')
    <style>
        button[type='submit'] {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
        }

        #toast {
            display: none;
            position: fixed;
            top: 100px;
            left: 85%;
            padding: 20px;
            border-radius: 3px;
            background: #353c48;
            font-family: Montserrat, sans-serif;
            font-weight: 500;
            color: white;
        }

        #toast.show-toast {
            display: inline-block;
        }

        .show-toast {
            animation: showToast 0.3s ease-out;
        }

        .hide-toast {
            animation: hideToast 0.3s ease-in;
        }

        @keyframes showToast {
            from {
                top: 170px;
                opacity: 0;
            }

            to {
                top: 100px;
                opacity: 1;
            }
        }

        @keyframes hideToast {
            from {
                top: 100px;
                opacity: 1;
            }

            to {
                top: 20px;
                opacity: 0;
            }
        }
    </style>
    <div class="container-fluid px-4">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-12">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item d-flex align-items-center justify-content-between w-100">
                                <h4 class="page-title">Manage Order</h4>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <div class="">
                            <h3 class="mb-4">
                                Paper Details:
                            </h3>
                        </div>
                        <form class="row" id="createOrder" method="POST">
                            <div class="col-12">
                                <p>
                                    Subject or Discipline: "If the required type of paper is missing, feel free to pick
                                    “Other”
                                    and write your specific type of paper in the appeared tab."
                                </p>
                                <p class="">
                                    Subject or Discipline:
                                </p>

                                <select name="erp_subject_name" class="form-control other" data-other-name='erp_sub'
                                    required>
                                    <option value="" selected hidden>Select an option</option>
                                    @foreach ($data['subject_type'] as $item)
                                        <option value="{{ $item->value }}">{{ $item->label }}</option>
                                    @endforeach
                                    <option value="other">other</option>
                                </select>

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>

                            <div class="col-12">
                                <p>
                                    Topic: "Please provide us with a clear topic of your assignment up to 300 symbols. If
                                    you don’t have a specific topic, use the default writer’s choice option or use the
                                    “Subject or Discipline” chosen above."
                                </p>
                                <p class="">
                                    Topic:
                                </p>

                                <select name="erp_order_topic" class="form-control other" data-other-name='erp_order_text'
                                    required>
                                    <option value="" selected hidden>Select an option</option>
                                    <option value="Computer">Computer</option>
                                    <option value="Physics">Physics</option>
                                    <option value="Urdu">Urdu</option>
                                    <option value="other">other</option>
                                </select>

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>

                            <div class="col-12">
                                <p>
                                    Academic Level: "Please select the option that is the closest to your next obtainable
                                    degree."
                                </p>
                                <p class="">
                                    Academic Level:
                                </p>

                                <select name="erp_academic_name" class="form-control other" required
                                    data-other-name='erp_academic_description'>
                                    <option value="" selected hidden>Select an option</option>
                                    @foreach ($data['academic_level'] as $item)
                                        <option value="{{ $item->value }}">{{ $item->label }}</option>
                                    @endforeach
                                    <option value="other">other</option>
                                </select>

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    Type of Paper: "If the required type of paper is missing, feel free to pick “Other” and
                                    write your specific type of paper in the appeared tab."
                                </p>
                                <p class="">
                                    Type of Paper:
                                </p>

                                <select name="erp_paper_type" class="form-control" required>
                                    <option value="" selected hidden>Select an option</option>
                                    @foreach ($data['paper_type'] as $item)
                                        <option value="{{ $item->value }}">{{ $item->label }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    Paper Format: "Format of your in-text citations, references and title page. The
                                    format/citation style also applies to any Works Cited and/or References pages."
                                </p>
                                <p class="">
                                    Paper Format:
                                </p>

                                <select name="erp_paper_format" class="form-control" required>
                                    <option value="" selected hidden>Select an option</option>
                                    @foreach ($data['paper_format'] as $item)
                                        <option value="{{ $item->value }}">{{ $item->label }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    Language and spelling style:
                                </p>

                                <select name="erp_language_name" class="form-control" required>
                                    <option value="" selected hidden>Select an option</option>
                                    @foreach ($data['language_style'] as $item)
                                        <option value="{{ $item->value }}">{{ $item->label }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    Will you provide any resource materials:
                                </p>

                                <select name="erp_resource_materials" class="form-control other file"
                                    data-other-name='erp_resource_file' required>
                                    <option value="" selected hidden>Select an option</option>
                                    <option value="no">No</option>
                                    <option value="other">Yes</option>
                                </select>

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    Number of Pages: "Select the number of pages needed. Do not include Bibliography, Works
                                    Cited, or References pages because they are free."
                                </p>
                                <p>
                                    Number of Pages:
                                </p>

                                <input type="number" name="erp_number_Pages" placeholder="Type Here..." required
                                    class="form-control">

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    Spacing: “Double spaced pages contain approximately 300 words each, while single-spaced
                                    have 600.”
                                </p>
                                <p>
                                    Spacing:
                                </p>

                                <input type="number" name="erp_spacing" placeholder="Type Here..." class="form-control"
                                    required>


                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    PowerPoint Slides: "The number of Power Point slides that will be delivered to you
                                    separately from your paper. Useful for those who need to present in front of class."
                                </p>
                                <p>
                                    PowerPoint Slides:
                                </p>

                                <input type="number" name="erp_powerPoint_slides" placeholder="Type Here..." required
                                    class="form-control">

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    <strong> Sources:</strong> "This number of entries will be in your reference list or
                                    bibliography page.”

                                    <strong> FREE SOURCES:</strong> If needed, you may request one (1) free source for every
                                    one (1) page of text that you order. For example, if you order 20 pages of text, you can
                                    request up to 20 sources for free.”

                                    <strong> EXTRA SOURCES:</strong> There is an additional cost of $1 per each extra source
                                    that exceeds the number of pages that you order. For example, if you order 10 pages and
                                    request 15 sources, there will be a total additional cost of $5 for the 5 extra sources.

                                </p>
                                <p>
                                    No. of EXTRA SOURCES:
                                </p>

                                <input type="number" name="erp_extra_source" placeholder="Type Here..." required
                                    class="form-control">


                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    Deadline: "The time in which you will receive your completed paper. The countdown starts
                                    when we receive payment for your order. Please note that revision requests may exceed
                                    your deadline."
                                </p>
                                <p>
                                    Deadline:
                                </p>

                                <select name="erp_deadline" class="form-control" required>
                                    <option value="" selected hidden>Select an option</option>
                                    <option value="erp_eight_hrs">8 hours</option>
                                    <option value="erp_tf_hrs">24 hours</option>
                                    <option value="erp_fe_hrs">48 hours</option>
                                    <option value="erp_three_days">3 days</option>
                                    <option value="erp_five_days">5 days</option>
                                    <option value="erp_seven_days">7 days</option>
                                    <option value="erp_fourteen_days">14 days</option>
                                    <option value="erp_fourteen_plus_days">14+ days</option>
                                </select>

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    Copy of Sources:
                                </p>

                                <select name="erp_copy_sources" class="form-control" required>
                                    <option value="" selected hidden>Select an option</option>

                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    1 Page Summary:
                                </p>

                                <select name="erp_page_summary" class="form-control" required>
                                    <option value="" selected hidden>Select an option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    Paper Outline in Bullets:
                                </p>

                                <select name="erp_paper_outline" class="form-control" required>
                                    <option value="" selected hidden>Select an option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    Abstract Page:
                                </p>

                                <select name="erp_abstract_page" class="form-control" required>
                                    <option value="" selected hidden>Select an option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p>
                                    Statistical Analysis: If your order requires statistical analysis or a significant
                                    amount of mathematical calculations, there will be an additional charge of 15%. To see a
                                    list of features that qualify as "statistical analysis," click here.
                                </p>
                                <p>
                                    Statistical Analysis:
                                </p>

                                <select name="erp_statistical_analysis" class="form-control" required>
                                    <option value="" selected hidden>Select an option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>

                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">

                                <p>
                                    Status:
                                </p>

                                <select name="erp_status" class="form-control" required>
                                    <option value="" selected hidden>Select an option</option>
                                    <option value="0">Pending</option>
                                    <option value="2">Progress</option>
                                    <option value="3">Completed</option>
                                    <option value="4">Canceled</option>
                                </select>

                            </div>
                            <div class="col-12 mt-4">
                                <input type="hidden" name="erp_user_id" value="{{ auth()->user()->user_token }}">
                                <button type="submit" class="btn btn-primary">Create Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let elements = document.querySelectorAll('select.other')
        createOrder.addEventListener("submit", handlePostOrder, false);

        for (var i = 0; i < elements.length; i++) {
            elements[i].addEventListener("change", function() {

                if (this.closest('.col-12').querySelector('input')) {
                    this.closest('.col-12').querySelector('input').remove();
                }

                if (this.value === 'other') {
                    let input = document.createElement("input");
                    input.type = this.classList.contains('file') ? "file" : "text";
                    input.name = this.getAttribute('data-other-name');
                    input.required = true;
                    input.className = this.classList.contains('file') ? 'form-control mt-3' : 'form-control';
                    this.closest('.col-12').appendChild(input);

                }
            });
        }

        function createToast(message) {
            const toast = document.createElement('div');
            toast.innerHTML = message;
            toast.setAttribute('id', 'toast');
            document.body.appendChild(toast);
            return toast;
        }



        function showToast(msg) {
            const toast = createToast(msg);
            toast.classList.add('show-toast');
            setTimeout(() => {
                hideToast(toast);
            }, 3000);
        }

        function hideToast(toast) {
            toast.classList.add('hide-toast');
            setTimeout(() => {
                removeToast(toast);
            }, 300);
        }

        function removeToast(toast) {
            toast.remove();
        }

        function handlePostOrder(e) {
            e.preventDefault();
            createOrder.querySelector('button[type="submit"]').innerHTML = `<div class="preloader pl-size-xs">
                                    <div class="spinner-layer pl-grey">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div> Creating...`;
            const data = new FormData(e.target);

            console.log(data);

            fetch('https://eliteblue.net/research-space/api/webs/create-order', {
                    method: 'POST',
                    body: data,
                })
                .then((res) => res.json())
                .then((data) => {
                    createOrder.querySelector('button[type="submit"]').innerHTML = `Create Order`;
                    if (data.success) {

                        showToast(data.message);
                    } else {

                        showToast('Something went wrong!');
                    }
                })
                .catch((err) => {
                    createOrder.querySelector('button[type="submit"]').innerHTML = `Create Order`;
                    console.log(err);
                    showToast('Something went wrong!');
                });

        }
    </script>
@endsection
