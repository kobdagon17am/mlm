@extends('layouts.backend.app')



@section('head')
@endsection

@section('css')
@endsection

@section('conten')
    @include('backend.navbar.navbar_mobile')
    <div class="flex overflow-hidden">

        @include('backend.navbar.navbar')
        <div class="content">
            @include('backend.navbar.top_bar')
            <h2 class="text-lg font-medium mr-auto mt-2">สาขา</h2>

            <div class="grid grid-cols-12">
                <div class="col-start-4 col-span-6">
                    <form id="form_branch" method="post">
                        @csrf
                        <div class="box p-3 mt-3  text-xs">
                            <div class="grid grid-cols-12 gap-5">
                                <div class="col-span-6">
                                    <label for="regular-form-1" class="form-label">รหัสคลัง</label>
                                    <span class="form-label text-danger b_code_err _err"></span>
                                    <input id="regular-form-1" type="text" class="form-control  text-xs" name="b_code"
                                        placeholder="รหัสคลัง">
                                </div>
                                <div class="col-span-6">
                                    <label for="regular-form-1" class="form-label">ชื่อคลัง</label>
                                    <span class="form-label text-danger b_name_err _err"></span>
                                    <input id="regular-form-1" type="text" class="form-control text-xs" name="b_name"
                                        placeholder="ชื่อคลัง">
                                </div>
                                <div class="col-span-12 mx-auto">
                                    <label for="regular-form-1" class="form-label">รายละเอียด</label>
                                    <span class="form-label text-danger b_details_err _err"></span>
                                    <textarea class="form-control text-xs p-2" name="b_details" id="" cols="150" rows="5"
                                        placeholder="รายละเอียด..."></textarea>
                                </div>
                                <div class="col-span-6">
                                    <label for="regular-form-1" class="form-label">ที่อยู่</label>
                                    <span class="form-label text-danger home_name_err _err"></span>
                                    <input id="regular-form-1" type="text" class="form-control text-xs" name="home_name"
                                        placeholder="ที่อยู่">
                                </div>
                                <div class="col-span-3">
                                    <label for="regular-form-1" class="form-label">หมู่ที่</label>
                                    <span class="form-label text-danger moo_err _err"></span>
                                    <input id="regular-form-1" type="text" class="form-control text-xs" name="moo"
                                        placeholder="หมู่ที่">
                                </div>
                                <div class="col-span-3">
                                    <label for="regular-form-1" class="form-label">ซอย</label>
                                    <span class="form-label text-danger soi_err _err"></span>
                                    <input id="regular-form-1" type="text" class="form-control text-xs" name="soi"
                                        placeholder="ซอย">
                                </div>
                                <div class="col-span-4">
                                    <label for="regular-form-1" class="form-label">ถนน</label>
                                    <span class="form-label text-danger road_err _err"></span>
                                    <input id="regular-form-1" type="text" class="form-control text-xs" name="road"
                                        placeholder="ถนน">
                                </div>

                                <div class="col-span-4">
                                    <label for="province" class="form-label">จังหวัด</label>
                                    <span class="form-label text-danger province_err _err"></span>
                                    <select class="form-select text-xs" name="province" id="province">
                                        <option value="">--กรุณาเลือก--</option>
                                        @foreach ($province as $item)
                                            <option value="{{ $item->province_id }}">
                                                {{ $item->province_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-span-4">
                                    <label for="district" class="form-label">อำเภอ/เขต</label>
                                    <span class="form-label text-danger district_err _err"></span>
                                    <select class="form-select text-xs " name="district" id="district" disabled>
                                        <option value="">--กรุณาเลือก--</option>
                                    </select>
                                </div>
                                <div class="col-span-4">
                                    <label for="tambon" class="form-label">ตำบล</label>
                                    <span class="form-label text-danger tambon_err _err"></span>
                                    <select class="form-select text-xs " name="tambon" id="tambon" disabled>
                                        <option value="">--กรุณาเลือก--</option>
                                    </select>
                                </div>
                                <div class="col-span-4">
                                    <label for="" class="form-label">รหัสไปรษณีย์ <span
                                            class="text-danger zipcode_err _err"></span></label>
                                    <input id="zipcode" name="zipcode" type="text" class="form-control text-xs"
                                        id="">
                                </div>
                                <div class="col-span-4">
                                    <label for="" class="form-label">เบอร์โทรศัพท์ <span
                                            class="text-danger tel_err _err"></span></label>
                                    <input id="zipcode" name="tel" type="text" class="form-control text-xs"
                                        id="">
                                </div>
                            </div>
                            <div class="mt-2">
                                <label>สถานะ ปิด/เปิด</label>
                                <div class="form-switch mt-2">
                                    <input type="checkbox" name="status" class="form-check-input" value="1">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary">บันทึกข้อมูล</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
            <hr class=" mt-3">
            <div class="grid grid-cols-12 gap-5">
                <div class="col-span-12">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-4">

                        <div class="">
                            <div class="form-inline ">
                                <label for="" class="mr-2 text-slate-500 ">สถานะ : </label>
                                <select name="status" class="w-32 form-select box mt-3 sm:mt-0 myWhere">
                                    <option value="">ทั้งหมด</option>
                                    <option value="1">เปิดใช้งาน</option>
                                    <option value="99">ไม่เปิดการใช้งาน</option>
                                </select>
                            </div>
                        </div>
                        <div class="hidden md:block mx-auto text-slate-500"></div>
                        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">

                            <div class=" relative text-slate-500">
                                <div class="form-inline">
                                    <label for="" class="mr-2">ค้นหารหัสคลัง</label>
                                    <input type="text" name="b_code" class="form-control w-56 box pr-10 myLike"
                                        placeholder="ค้นหา...">
                                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                    <table id="table_branch" class="table table-report">
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection



@section('script')
    {{-- BEGIN จังหวัด แขต แขวง --}}
    <script>
        // BEGIN province
        $("#province").change(function() {
            let province_id = $(this).val();
            $.ajax({
                url: '{{ route('getDistrict') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    province_id: province_id,
                },
                success: function(data) {
                    $("#district").children().remove();
                    $("#tambon").children().remove();
                    $("#district").append(` <option value="">--กรุณาเลือก--</option>`);
                    $("#tambon").append(` <option value="">--กรุณาเลือก--</option>`);
                    $("#zipcode").val("");
                    data.forEach((item) => {
                        $("#district").append(
                            `<option value="${item.district_id}">${item.district_name}</option>`
                        );
                        $("#same_district").append(
                            `<option value="${item.district_id}">${item.district_name}</option>`
                        );
                    });
                    $("#district").attr('disabled', false);
                    $("#tambon").attr('disabled', true);
                },
                error: function() {}
            })
        });
        // END province

        // BEGIN district
        $("#district").change(function() {
            let district_id = $(this).val();
            $.ajax({
                url: '{{ route('getTambon') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    district_id: district_id,
                },
                success: function(data) {
                    $("#tambon").children().remove();
                    $("#tambon").append(` <option value="">--กรุณาเลือก--</option>`);
                    $("#zipcode").val("");
                    data.forEach((item) => {
                        $("#tambon").append(
                            `<option value="${item.tambon_id}">${item.tambon_name}</option>`
                        );
                        $("#same_tambon").append(
                            `<option value="${item.tambon_id}">${item.tambon_name}</option>`
                        );
                    });
                    $("#tambon").attr('disabled', false);
                },
                error: function() {}
            })
        });
        // BEGIN district

        //  BEGIN tambon
        $("#tambon").change(function() {
            let tambon_id = $(this).val();
            $.ajax({
                url: '{{ route('getZipcode') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    tambon_id: tambon_id,
                },
                success: function(data) {
                    $("#zipcode").val(data.zipcode);
                },
                error: function() {}
            })
        });
        //  END tambon
    </script>
    {{-- END จังหวัด แขต แขวง --}}




    {{-- BEGIN print err input --}}
    <script>
        function printErrorMsg(msg) {

            $('._err').text('');
            $.each(msg, function(key, value) {
                $('.' + key + '_err').text(`*${value}*`);
            });
        }

        function resetForm() {
            $('#form_branch')[0].reset();
            $('._err').text('');
        }
    </script>
    {{-- END print err input --}}



    //BEGIN form_register
    <script>
        $('#form_branch').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '{{ route('store_branch') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if ($.isEmptyObject(data.error) || data.status == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกสำเร็จ',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'ปิด',

                        }).then((result) => {
                            resetForm();
                            table_branch.draw();
                        })
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });
        });
    </script>
    //END form_register

    {{-- BEGIN data_table_branch --}}
    @include('backend.stock.branch.data_table_branch')
    {{-- END data_table_branch --}}
@endsection
