@extends('management.layouts.master')
@section('title')
    Orders
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

    <form method="POST" id="manageStatus">
        @csrf
        @method('POST')
        <div class="container-fluid px-4">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100 d-flex justify-content-between align-items-center">
                                <ul class="breadcrumb breadcrumb-style ">
                                    <li class="breadcrumb-item">
                                        <h4 class="page-title">Update Configuration</h4>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="header">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    </div>
                                    <div class="body table-responsive">
                                        <div class="row">


                                            <div class="col-12 py-4 d-none">
                                                <label for="email_address1"> <strong>Maximum Price Per Page
                                                    </strong></label>
                                                <div class="form-line">
                                                    <input type="text" name="max_price" value=""
                                                        placeholder="Maximum Price Per Page *">
                                                </div>
                                            </div>
                                            <div class="col-12 py-4">
                                                <label for="email_address1"> <strong>Default Price Per Page
                                                    </strong></label>
                                                <div class="form-line">
                                                    <input type="text" name="min_page_page_price"
                                                        value="{{ $order->minimum_price_per_page }}"
                                                        placeholder="Default Minimum Price Per Page *">
                                                </div>
                                            </div>
                                            <div class="col-12 py-4 d-none">
                                                <label for="email_address1"> <strong>Default Maximum Price Per Page
                                                    </strong></label>
                                                <div class="form-line">
                                                    <input type="text" name="max_page_page_price"
                                                        value="{{ $order->maximum_price_per_page }}"
                                                        placeholder="Default Maximum Price Per Page *">
                                                </div>
                                            </div>
                                            <div class="col-12 py-4">
                                                <label for="email_address1"> <strong> Minimum Pages Allowed
                                                    </strong></label>
                                                <div class="form-line">
                                                    <input type="text" name="min_pages"
                                                        value="{{ $order->minimum_pages_allowed }}"
                                                        placeholder="Minimum Pages Allowed *">
                                                </div>
                                            </div>
                                            <div class="col-12 py-4">
                                                <label for="email_address1"> <strong> Maximum Pages Allowed
                                                    </strong></label>
                                                <div class="form-line">
                                                    <input type="text" name="max_pages"
                                                        value="{{ $order->maximum_pages_allowed }}"
                                                        placeholder="Maximum Pages Allowed *">
                                                </div>
                                            </div>








                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="header">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    </div>
                                    <div class="body table-responsive">
                                        <div class="row">
                                            <div class="col-12 py-4">
                                                <label for="email_address1"> <strong>Select Deadline *</strong></label>
                                                <div class="form-line">
                                                    <select class="form-control" placeholder='Select an option'
                                                        name="order_json">
                                                        <option value="" selected hidden>Select an option</option>
                                                        @foreach (json_decode($order->min_max) as $item)
                                                            <option value="{{ $item->value }}">
                                                                {{ $item->label }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 py-4">
                                                <label for="email_address1"> <strong>Price Per Page
                                                    </strong></label>
                                                <div class="form-line">
                                                    <input type="text" name="min_price" value=""
                                                           placeholder="Minimum Price Per Page *">
                                                </div>
                                            </div>
                                            <div class="col-12 py-2">
                                                <button type="submit" class="btn btn-primary">Update</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <script>
        window.addEventListener('load', function() {


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




            var min_price = document.querySelector('input[name="min_price"]');
            var max_price = document.querySelector('input[name="max_price"]');
            // var close = document.querySelector('button[aria-label="Close"]');

            var data = JSON.parse({!! json_encode($order, JSON_HEX_TAG) !!}.min_max);

            document.querySelector('select[name="order_json"]').addEventListener('change', (e) => {
                data.map((item) => {
                    if (item.value === e.target.value) {
                        console.log(item);
                        min_price.value = item.minimum_price_per_page;
                        max_price.value = item.maximum_price_per_page;
                    }
                })

            });

            manageStatus.addEventListener("submit", handlePostStatus, false);


            function handlePostStatus(e) {

                e.preventDefault();

                manageStatus.querySelector('button[type="submit"]').innerHTML = `<div class="preloader pl-size-xs">
                    <div class="spinner-layer pl-grey">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div> Updating`;

                const data = new FormData(e.target);

                fetch('https://eliteblue.net/research-space/api/webs/update-config', {
                        method: 'POST',
                        body: data,
                    })
                    .then((res) => res.json())
                    .then((data) => {
                        manageStatus.querySelector('button[type="submit"]').innerHTML = `Update`;
                        if (data.success) {
                            showToast(data.message);
                            manageStatus.reset();
                        } else {

                            showToast('Something went wrong!');
                        }
                    })
                    .catch((err) => {
                        showToast('Something went wrong!');

                        manageStatus.querySelector('button[type="submit"]').innerHTML = `Update`;
                        console.log(err);
                    });
            }
        })
    </script>
@endsection
