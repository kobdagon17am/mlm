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

            <h2 class="intro-y text-lg font-medium mt-5 mb-5">
                ข้อมูลสมาชิก
            </h2>
            <hr>
            {{-- BRGIN  ผู้แนะนำ --}}
            <div class="grid grid-cols-12 gap-4 mt-5">
                <div class="col-span-12 bg-green-700/75 rounded-full p-1 ">
                    <h2 class="intro-y text-lg font-medium text-white ml-5 ">
                        ผู้แนะนำ
                    </h2>
                </div>
                <div class="col-span-4">
                    <label for="regular-form-1" class="form-label">รหัสผู้แนะนำ</label>
                    <div class="form-inline">

                        <input id="regular-form-1" type="text" class="form-control">
                        <button class="btn bg-green-700 text-white ml-3 mr-1 rounded-full">ตรวจ</button>
                        <button class="btn btn-outline-danger rounded-full  ">
                            <p class="my-auto"> <i class="fa-solid fa-xmark w-4 h-4"></i> </p>
                        </button>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="regular-form-1" class="form-label">ชื่อผู้แนะนำ</label>
                    <div class="form-inline">
                        <input id="regular-form-1" type="text" class="form-control">
                    </div>
                </div>
            </div>
            {{-- END  ผู้แนะนำ --}}


            {{-- BEGIN ข้อมูลส่วนตัว --}}
            <form id="form_info_card" method="post">
                @csrf
                <input type="hidden" name="customers_id" value="{{ $customers_info->id }}">
                <div class="grid grid-cols-12 gap-4 mt-5">

                    <div class="col-span-3">
                        <label for="" class="form-label">คำนำหน้า <span
                                class="text-danger prefix_name_err _err">*</span></label>
                        <select name="prefix_name" class="form-select disabled_select" id="">
                            <option disabled>เลือกคำนำหน้า</option>
                            <option {{ $customers_info->prefix_name == 'นาย' ? 'selected' : '' }} value="นาย">นาย
                            </option>
                            <option {{ $customers_info->prefix_name == 'นาง' ? 'selected' : '' }} value="นาง">นาง
                            </option>
                            <option {{ $customers_info->prefix_name == 'นางสาว' ? 'selected' : '' }} value="นางสาว">นางสาว
                            </option>
                        </select>
                    </div>
                    <div class="col-span-3">
                        <label for="" class="form-label">ชื่อ <span
                                class="text-danger name_err _err">*</span></label>
                        <input name="name" type="text" class="form-control" id=""
                            value="{{ $customers_info->name }}">

                    </div>
                    <div class="col-span-3">
                        <label for="" class="form-label">นามสกุล <span
                                class="text-danger last_name_err _err">*</span></label>
                        <input name="last_name" type="text" class="form-control" id=""
                            value="{{ $customers_info->last_name }}">
                    </div>
                    <div class="col-span-3">
                        <label for="" class="form-label">เพศ <span
                                class="text-danger gender_err _err">*</span></label>
                        <select name="gender" class="form-select disabled_select" id="">
                            <option selected disabled>เลือกเพศ</option>
                            <option {{ $customers_info->gender == 'ชาย' ? 'selected' : '' }} value="ชาย">
                                ชาย</option>
                            <option {{ $customers_info->gender == 'หญิง' ? 'selected' : '' }} value="หญิง">
                                หญิง</option>
                            <option {{ $customers_info->gender == 'ไม่ระบุ' ? 'selected' : '' }} vlaue="ไม่ระบุ">ไม่ระบุ
                            </option>
                        </select>
                    </div>
                    <div class="col-span-6">
                        <label for="" class="form-label">ชื่อทางธุรกิจ <span
                                class="text-danger business_name_err _err">*</span></label>
                        <input name="business_name" type="text" class="form-control" id=""
                            value="{{ $customers_info->business_name }}">
                    </div>
                    <div class="col-span-2">
                        <label for="" class="form-label">วันเกิด <span
                                class="text-danger day_err _err">*</span></label>
                        <input name="day" type="text" class="form-control" id=""
                            value="{{ $customers_day }}">

                    </div>
                    <div class="col-span-2">
                        <label for=""
                            class=" text-danger form-label d-none d-md-block month_err _err">&nbsp;</label>
                        <select name="month" class="form-select disabled_select" id="">
                            <option disabled>เดือน</option>
                            <option {{ $customers_month == '01' ? 'selected' : '' }} value="01">มกราคม
                            </option>
                            <option {{ $customers_month == '02' ? 'selected' : '' }} value="02">
                                กุมภาพันธ์</option>
                            <option {{ $customers_month == '03' ? 'selected' : '' }} value="03">มีนาคม
                            </option>
                            <option {{ $customers_month == '04' ? 'selected' : '' }} value="04">เมษายน
                            </option>
                            <option {{ $customers_month == '05' ? 'selected' : '' }} value="05">
                                พฤษภาคม
                            </option>
                            <option {{ $customers_month == '06' ? 'selected' : '' }} value="06">
                                มิถุนายน
                            </option>
                            <option {{ $customers_month == '07' ? 'selected' : '' }} value="07">
                                กรกฎาคม
                            </option>
                            <option {{ $customers_month == '08' ? 'selected' : '' }} value="08">
                                สิงหาคม
                            </option>
                            <option {{ $customers_month == '09' ? 'selected' : '' }} value="09">
                                กันยายน
                            </option>
                            <option {{ $customers_month == '10' ? 'selected' : '' }} value="10">ตุลาคม
                            </option>
                            <option {{ $customers_month == '11' ? 'selected' : '' }} value="11">
                                พฤศจิกายน</option>
                            <option {{ $customers_month == '12' ? 'selected' : '' }} value="12">
                                ธันวาคม
                            </option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for=""
                            class="text-danger form-label d-none d-md-block year_err _err">&nbsp;</label>
                        <input name="year" type="text" class="form-control" id=""
                            value="{{ $customers_year }}">
                    </div>
                    <div class="col-span-2">
                        <label for="" class="form-label">สัญชาติ <span
                                class="text-danger nation_id_err _err">*</span></label>
                        <select class="form-select disabled_select" name="nation_id" id="">
                            <option disabled>เลือกสัญชาติ</option>
                            <option {{ $customers_info->nation_id == 'ไทย' ? 'selected' : '' }} value="ไทย">ไทย
                            </option>

                        </select>
                    </div>
                    <div class="col-span-5">
                        <label for="" class="form-label">เลขบัตรประชาชน <span
                                class="text-danger id_card_err _err">*</span></label>
                        <input name="id_card" type="text" class="form-control" maxlength="13" id=""
                            value="{{ $customers_info->id_card }}">
                    </div>
                    <div class="col-span-5">
                        <label for="" class="form-label">โทรศัพท์ <span
                                class="text-danger phone_err _err">*</span></label>
                        <input name="phone" type="text" class="form-control" id=""
                            value="{{ $customers_info->phone }}">
                    </div>
                    <div class="col-span-4">
                        <label for="" class="form-label">E-mail <span
                                class="text-danger email_err _err"></span></label>
                        <input name="email" type="text" class="form-control" id=""
                            value="{{ $customers_info->email }}">
                    </div>
                    <div class="col-span-4">
                        <label for="" class="form-label">Line ID</label>
                        <input name="line_id" type="text" class="form-control" id=""
                            value="{{ $customers_info->line_id }}">
                    </div>
                    <div class="col-span-4">
                        <label for="" class="form-label">Facebook</label>
                        <input name="facebook" type="text" class="form-control" id=""
                            value="{{ $customers_info->facebook }}">
                    </div>


                </div>
                <div class="grid grid-cols-12 text-center mb-2 mt-2 ">
                    <div class="col-span-12 flex justify-center ">
                        <button type="submit" class="btn bg-green-700 text-white rounded-pill mr-2">บันทึกข้อมูล</button>
                        <a class="btn btn-danger rounded-pill ">ยกเลิก</a>

                    </div>

                </div>

            </form>

            {{-- BEGIN ข้อมูลส่วนตัว --}}



            {{-- BEGIN ที่อยู่ตามบัตรประชาชน --}}
            <div class="grid grid-cols-12 gap-4 mt-5">
                <div class="col-span-12 bg-green-700/75 rounded-full p-1">
                    <h2 class="intro-y text-lg font-medium text-white ml-5">
                        ที่อยู่ตามบัตรประชาชน
                    </h2>
                </div>
                <div class="col-span-4 mx-auto">
                    @if (@$address_card->url)
                        <img width="250" height="300" id="img_card"
                            src="{{ asset('') . @$address_card->url . '/' . @$address_card->img_card }}" />
                        {{-- src="{{ @$address_card->url . '/' . @$address_card->img_card }}" /> --}}
                    @else
                        <img width="250" height="300" id="img_bank" accept="image/*"
                            src="https://via.placeholder.com/250x300.png?text=Bank">
                    @endif
                </div>
                <div class="col-span-8">
                    <div class="grid grid-cols-12 gap-4 ">
                        <div class="col-span-12">
                            <label for="" class="form-label">ที่อยู่ <span
                                    class="text-danger card_address_err _err">*</span></label>
                            <input type="text" name="card_address" value="{{ @$address_card->address }}"
                                class="form-control card_address" id="">
                        </div>
                        <div class="col-span-4">
                            <label for="" class="form-label">หมู่ที่ <span
                                    class="text-danger card_moo_err _err">*</span></label>
                            <input type="text" name="card_moo" class="form-control card_address" id=""
                                value="{{ @$address_card->moo }}">
                        </div>
                        <div class="col-span-4">
                            <label for="" class="form-label">ซอย <span
                                    class="text-danger card_soi_err _err">*</span></label>
                            <input type="text" name="card_soi" class="form-control card_address" id=""
                                value="{{ @$address_card->soi }}">
                        </div>
                        <div class="col-span-4">
                            <label for="" class="form-label">ถนน <span
                                    class="text-danger card_road_err _err">*</span></label>
                            <input type="text" name="card_road" class="form-control card_address" id=""
                                value="{{ @$address_card->road }}">
                        </div>
                        <div class="col-span-4">
                            <label for="province" class="form-label">จังหวัด</label>
                            <label class="form-label text-danger card_province_err _err"></label>
                            <select class="form-select card_address province  " name="card_province" id="province">
                                <option value="">--กรุณาเลือก--</option>
                                @foreach ($province as $item)
                                    <option {{ @$address_card->province == $item->province_id ? 'selected' : '' }}
                                        value="{{ $item->province_id }}">
                                        {{ $item->province_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-4">

                            <label for="district" class="form-label">อำเภอ/เขต</label>
                            <label class="form-label text-danger card_district_err _err"></label>
                            <select class="form-select card_address district " name="card_district" id="district">
                                <option value="">--กรุณาเลือก--</option>
                            </select>
                        </div>
                        <div class="col-span-4">
                            <label for="tambon" class="form-label">ตำบล</label>
                            <label class="form-label text-danger tambon_err _err"></label>
                            <select class="form-select card_address  tambon" name="card_tambon" id="tambon">
                                <option value="">--กรุณาเลือก--</option>
                            </select>
                        </div>
                        <div class="col-span-4">
                            <label for="" class="form-label">รหัสไปรษณีย์ <span
                                    class="text-danger card_zipcode_err _err">*</span></label>
                            <input id="zipcode" name="card_zipcode " type="text"
                                class="form-control card_address zipcode" id="">
                        </div>
                        <div class="col-span-4">
                            <label for="" class="form-label">เบอร์มือถือ</label>
                            <input type="text" name="card_phone" class="form-control card_address" id=""
                                value="{{ @$address_card->phone }}">
                        </div>
                    </div>
                </div>
            </div>
            {{-- END ข้อมูลธนาคาร --}}


            {{-- BEGIN ที่อยู่จัดส่ง --}}
            <div class="grid grid-cols-12 gap-4 mt-5">
                <div class="col-span-12 bg-green-700/75 rounded-full p-1">
                    <h2 class="intro-y text-lg font-medium text-white ml-5 ">
                        ที่อยู่จัดส่ง
                        <input class="form-check-input ml-2" type="checkbox" name="status_address" id="status_address">
                        <label class="form-check-label text-white" for="status_address">
                            ใช้ที่อยู่เดียวกันบัตรประชาชน
                        </label>
                    </h2>
                </div>


                <div class="col-span-12">
                    <label for="" class="form-label">ที่อยู่ <span
                            class="text-danger same_address_err _err">*</span></label>
                    <input type="text" name="same_address" class="form-control address_same_card" id=""
                        value="{{ @$address_delivery->address }}">
                </div>
                <div class="col-span-4">
                    <label for="" class="form-label">หมู่ที่ <span
                            class="text-danger same_moo_err _err">*</span></label>
                    <input type="text" name="same_moo" class="form-control address_same_card" id=""
                        value="{{ @$address_delivery->moo }}">
                </div>
                <div class="col-span-4">
                    <label for="" class="form-label">ซอย <span
                            class="text-danger same_soi_err _err">*</span></label>
                    <input type="text" name="same_soi" class="form-control address_same_card" id=""
                        value="{{ @$address_delivery->soi }}">
                </div>
                <div class="col-span-4">
                    <label for="" class="form-label">ถนน <span
                            class="text-danger same_road_err _err">*</span></label>
                    <input type="text" name="same_road" class="form-control address_same_card" id=""
                        value="{{ @$address_delivery->road }}">
                </div>
                <div class="col-span-4">
                    <label for="province" class="form-label">จังหวัด</label>
                    <label class="form-label text-danger same_province_err _err"></label>
                    <select class="form-select address_same_card select_same" name="same_province" id="same_province">
                        <option selected disabled value="">--กรุณาเลือก--</option>
                        @foreach ($province as $item)
                            <option {{ @$address_delivery->province == $item->province_id ? 'selected' : '' }}
                                value="{{ $item->province_id }}">
                                {{ $item->province_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-4">

                    <label for="district" class="form-label">อำเภอ/เขต</label>
                    <label class="form-label text-danger same_district_err _err"></label>
                    <select class="form-select address_same_card select_same" name="same_district" id="same_district"
                        disabled>
                        <option value="">--กรุณาเลือก--</option>
                    </select>
                </div>
                <div class="col-span-4">
                    <label for="tambon" class="form-label">ตำบล</label>
                    <label class="form-label text-danger same_tambon_err _err"></label>
                    <select class="form-select address_same_card select_same" name="same_tambon" id="same_tambon"
                        disabled>
                        <option value="">--กรุณาเลือก--</option>
                    </select>
                </div>
                <div class="col-span-4">
                    <label for="" class="form-label">รหัสไปรษณีย์ <span
                            class="text-danger same_zipcode_err _err ">*</span></label>
                    <input id="same_zipcode" name="same_zipcode" type="text" class="form-control address_same_card"
                        id="">
                </div>
                <div class="col-span-4">

                    <label for="" class="form-label">เบอร์มือถือ</label>
                    <input type="text" name="same_phone" class="form-control address_same_card" id=""
                        value="{{ @$address_delivery->phone }}">
                </div>
            </div>
            {{-- END ที่อยู่จัดส่ง --}}

            {{-- BEGIN ข้อมูลบัญชีธนาคาร --}}

            <div class="grid grid-cols-12 gap-4 mt-5">
                <div class="col-span-12 bg-green-700/75 rounded-full p-1">
                    <h2 class="intro-y text-lg font-medium text-white ml-5">
                        ข้อมูลบัญชีธนาคารเพื่อรับรายได้
                    </h2>
                </div>

                <div class="col-span-4 mx-auto">
                    <img src="https://via.placeholder.com/300x300.png?text=bank" alt="">
                </div>
                <div class="col-span-8">
                    <div class="grid grid-cols-12 gap-4 ">
                        <div class="col-span-4">

                            <label for="" class="form-label">ธนาคาร <span
                                    class="text-danger bank_name_err _err "></span></label>
                            <select name="bank_name" class="form-select disabled_select" id="">
                                <option disabled>เลือกธนาคาร</option>
                                @foreach ($bank as $value_bank)
                                    <option {{ @$info_bank->bank_id_fk == $value_bank->id ? 'selected' : '' }}
                                        value="{{ $value_bank->id }}">
                                        {{ $value_bank->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-4">

                            <label for="" class="form-label">สาขา <span
                                    class="text-danger bank_branch_err _err "></span></label>
                            <input type="text" name="bank_branch" class="form-control" id=""
                                value="{{ @$info_bank->bank_branch }}">
                        </div>
                        <div class="col-span-4">
                            <label for="" class="form-label">เลขที่บัญชี </label>
                            <input type="text" name="bank_no" class="form-control" id=""
                                value="{{ @$info_bank->bank_no }}">
                        </div>
                        <div class="col-span-4">
                            <label for="" class="form-label">ชื่อบัญชี <span
                                    class="text-danger account_name_err _err "></span></label>
                            <input type="text" name="account_name" class="form-control" id=""
                                value="{{ @$info_bank->account_name }}">
                        </div>

                    </div>
                </div>
            </div>
            {{-- END ข้อมูลบัญชีธนาคาร --}}

            {{-- BEGIN ผู้รับผลประโยชน์ --}}
            <div class="grid grid-cols-12 gap-4 mt-5">
                <div class="col-span-12 bg-green-700/75 rounded-full p-1">
                    <h2 class="intro-y text-lg font-medium text-white ml-5">
                        ผู้รับผลประโยชน์
                    </h2>
                </div>
                <div class="col-span-4">
                    <label for="" class="form-label">ชื่อ <span
                            class="text-danger name_benefit_err _err "></span></label>
                    <input type="text" name="name_benefit" class="form-control" id=""
                        value="{{ @$info_benefit->name }}">
                </div>
                <div class="col-span-4">
                    <label for="" class="form-label">นามสกุล <span
                            class="text-danger last_name_benefit_err _err "></span></label>
                    <input type="text" name="last_name_benefit" class="form-control" id=""
                        value="{{ @$info_benefit->last_name }}">
                </div>
                <div class="col-span-4">
                    <label for="" class="form-label">เกี่ยวข้องเป็น <span
                            class="text-danger involved_err _err "></span></label>
                    <input type="text" name="involved" class="form-control" id=""
                        value="{{ @$info_benefit->involved }}">
                </div>
            </div>
            {{-- END ผู้รับผลประโยชน์ --}}
        </div>
    @endsection



    @section('script')
        {{-- --------------------- Address --------------------- --}}
        {{-- --------------------- Address Edit --------------------- --}}
        <script>
            // BEGIN province
            $(document).ready(function() {

                $('.province').val(`{{ @$address_card->province }}`);
                $('.province').change();

                $('.district').val(`{{ @$address_card->district }}`);
                $('.district').change();

                $('.tambon').val(`{{ @$address_card->tambon }}`);
                $('.tambon').change();
            });

            $(".province").change(function() {
                let province_id = $(this).val();
                $.ajax({
                    url: '{{ route('getDistrict') }}',
                    type: 'GET',
                    dataType: 'json',
                    async: false,
                    data: {
                        province_id: province_id,
                    },
                    success: function(data) {
                        $(".district").children().remove();
                        $(".tambon").children().remove();
                        $(".district").append(` <option value="">--กรุณาเลือก--</option>`);
                        $(".tambon").append(` <option value="">--กรุณาเลือก--</option>`);
                        $(".zipcode").val("");
                        data.forEach((item) => {
                            $(".district").append(
                                `<option value="${item.district_id}">${item.district_name}</option>`
                            );
                        });
                        $(".district").attr('disabled', false);
                        $(".tambon").attr('disabled', true);
                    },
                    error: function() {}
                })
            });
            // END province
            // BEGIN district
            $(".district").change(function() {
                let district_id = $(this).val();
                $.ajax({
                    url: '{{ route('getTambon') }}',
                    type: 'GET',
                    dataType: 'json',
                    async: false,
                    data: {
                        district_id: district_id,
                    },
                    success: function(data) {
                        $(".tambon").children().remove();
                        $(".tambon").append(` <option value="">--กรุณาเลือก--</option>`);
                        $(".zipcode").val("");
                        data.forEach((item) => {
                            $(".tambon").append(
                                `<option value="${item.tambon_id}">${item.tambon_name}</option>`
                            );
                        });
                        $(".tambon").attr('disabled', false);
                    },
                    error: function() {}
                })
            });
            // BEGIN district
            //  BEGIN tambon
            $(".tambon").change(function() {
                let tambon_id = $(this).val();
                $.ajax({
                    url: '{{ route('getZipcode') }}',
                    type: 'GET',
                    dataType: 'json',
                    async: false,
                    data: {
                        tambon_id: tambon_id,
                    },
                    success: function(data) {
                        $(".zipcode").val(data.zipcode);
                    },
                    error: function() {}
                })
            });
            //  END tambon
        </script>
        {{-- --------------------- Address Edit --------------------- --}}



        <script>
            $('#status_address').click(function() {

                if (this.checked) {

                    $('#province').change();
                    $('#district').change();
                    $('#tambon').change();
                    $('.card_address').each(function(key) {
                        $('.address_same_card').eq(key).val($(this).val()).attr('', true);
                        $("#same_district").attr('disabled', false);
                        $("#same_tambon").attr('disabled', false);
                        $('#same_district,#same_tambon,#same_province').addClass('disabled_select')
                    });
                } else {

                    $('.address_same_card').val('').attr('', false);
                    $("#same_district").attr('disabled', true);
                    $("#same_tambon").attr('disabled', true);
                    $('#same_district,#same_tambon,#same_province').removeClass('disabled_select')

                }
            });
        </script>
        {{-- END Action same_address --}}




        <script>
            function printErrorMsg(msg) {

                $('._err').text('');
                $.each(msg, function(key, value) {
                    $('.' + key + '_err').text(`*${value}*`);
                });
            }
        </script>

        {{-- form_approve --}}
        <script>
            $('#form_info_card').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('admin_edit_form_info_card') }}',
                    type: 'POST',
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
                                location.reload();
                            })
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            });
        </script>
        {{-- form_approve --}}
    @endsection
