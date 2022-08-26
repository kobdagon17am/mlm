@extends('layouts.frontend.app')
@section('conten')
    <div class="bg-whiteLight page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
                            <li class="breadcrumb-item active" aria-current="page">สมัครสมาชิก</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form id="form_register">
                        @csrf
                        <div class="card card-box borderR10 mb-2 mb-md-0">
                            <div class="card-body">
                                <h4 class="card-title">สมัครสมาชิก</h4>
                                <hr>
                                <div class="borderR10 py-2 px-3 bg-purple3 bg-opacity-50 h5 mb-3">ผู้แนะนำ</div>
                                <div class="row g-3">
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <label for="" class="form-label">รหัสผู้แนะนำ <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-lg-2 col-xxl-1">
                                        <label for="" class="form-label d-none d-md-block">&nbsp;</label>
                                        <button class="btn btn-p1 rounded-pill">ตรวจ</button>
                                        <button class="btn btn-outline-dark rounded-circle btn-icon"><i
                                                class="bx bx-x"></i></button>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xxl-8 mb-3">
                                        <label for="" class="form-label">ชื่อผู้แนะนำ <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="" disabled>
                                    </div>
                                </div>
                                <div class="borderR10 py-2 px-3 bg-purple3 bg-opacity-50 h5 mb-3">ข้อมูลส่วนตัว</div>
                                <div class="row g-3">
                                    <div class="col-md-6 col-xl-3">
                                        <label for="" class="form-label">คำนำหน้า <span
                                                class="text-danger prefix_name_err _err">*</span></label>
                                        <select naem="prefix_name"class="form-select" id="">
                                            <option selected disabled>เลือกคำนำหน้า</option>
                                            <option value="นาย">นาย</option>
                                            <option value="นาง">นาง</option>
                                            <option value="นางสาว">นางสาว</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-xl-6">
                                        <label for="" class="form-label">ชื่อ - นามสกุล <span
                                                class="text-danger">*</span></label>
                                        <input name="customers_name" type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <label for="" class="form-label">เพศ <span
                                                class="text-danger">*</span></label>
                                        <select name="gender" class="form-select" id="">
                                            <option selected disabled>เลือกเพศ</option>
                                            <option value="ชาย">ชาย</option>
                                            <option value="หญิง">หญิง</option>
                                            <option vlaue="ไม่ระบุ">ไม่ระบุ</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-xl-6">
                                        <label for="" class="form-label">ชื่อทางธุรกิจ <span
                                                class="text-danger">*</span></label>
                                        <input name="business_name" type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-2">
                                        <label for="" class="form-label">วันเกิด <span
                                                class="text-danger">*</span></label>
                                        <select name="day" class="form-select" id="">
                                            <option selected disabled>วัน</option>

                                            @foreach ($day as $val)
                                                <option val="{{ $val }}">{{ $val }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6 col-xl-2">
                                        <label for="" class="form-label d-none d-md-block">&nbsp;</label>
                                        <select name="month" class="form-select" id="">
                                            <option selected disabled>เดือน</option>
                                            <option value="01">มกราคม</option>
                                            <option value="02">กุมภาพันธ์</option>
                                            <option value="03">มีนาคม</option>
                                            <option value="04">เมษายน</option>
                                            <option value="05">พฤษภาคม</option>
                                            <option value="06">มิถุนายน</option>
                                            <option value="07">กรกฎาคม</option>
                                            <option value="08">สิงหาคม</option>
                                            <option value="09">กันยายน</option>
                                            <option value="10">ตุลาคม</option>
                                            <option value="11">พฤศจิกายน</option>
                                            <option value="12">ธันวาคม</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-xl-2">
                                        <label for="" class="form-label d-none d-md-block">&nbsp;</label>
                                        <select class="form-select" id="">
                                            <option name="year" selected disabled>ปี</option>
                                            @foreach ($arr_year as $val)
                                                <option val="{{ $val }}">{{ $val }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                    <div class="col-md-6 col-xl-2">
                                        <label for="" class="form-label">สัญชาติ <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="">
                                            <option>เลือกสัญชาติ</option>
                                            <option value="ไทย">ไทย</option>

                                        </select>
                                    </div>
                                    <div class="col-md-6 col-xl-5">
                                        <label for="" class="form-label">เลขบัตรประชาชน <span
                                                class="text-danger">*</span></label>
                                        <input name="id_card" type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-5">
                                        <label for="" class="form-label">โทรศัพท์ <span
                                                class="text-danger">*</span></label>
                                        <input name="phone" type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">E-mail</label>
                                        <input name="email" type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">Line ID</label>
                                        <input name="line_id" type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4 mb-3">
                                        <label for="" class="form-label">Facebook</label>
                                        <input name="fackbook" type="text" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="borderR10 py-2 px-3 bg-purple3 bg-opacity-50 h5 mb-3">ที่อยู่ตามบัตรประชาชน
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="file-upload">
                                            <label for="upload" class="file-upload__label"><i class='bx bx-upload'></i>
                                                อัพโหลดเอกสาร</label>
                                            <input id="upload" class="file-upload__input" type="file"
                                                name="file-upload">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-5">
                                        <label for="" class="form-label">ที่อยู่ <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <label for="" class="form-label">หมู่ที่ <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">ซอย <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">ถนน <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">ตำบล/แขวง <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">อำเภอ/เขต <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">จังหวัด <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">รหัสไปรษณีย์ <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4 mb-3">
                                        <label for="" class="form-label">เบอร์มือถือ</label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="borderR10 py-2 px-3 bg-purple3 bg-opacity-50 h5 mb-3">
                                    ที่อยู่จัดส่ง
                                    <div class="form-check form-check-inline h6 fw-normal">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            ใช้ที่อยู่เดียวกันบัตรประชาชน
                                        </label>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6 col-xl-5">
                                        <label for="" class="form-label">ที่อยู่ <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <label for="" class="form-label">หมู่ที่ <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">ซอย <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">ถนน <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">ตำบล/แขวง <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">อำเภอ/เขต <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">จังหวัด <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">รหัสไปรษณีย์ <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4 mb-3">
                                        <label for="" class="form-label">เบอร์มือถือ</label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="borderR10 py-2 px-3 bg-purple3 bg-opacity-50 h5 mb-3">
                                    ข้อมูลบัญชีธนาคารเพื่อรับรายได้</div>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <i class='bx bxs-error me-2'></i>
                                            <div>
                                                สมาชิกจะใส่หรือไม่ใส่ก็ได้ หากไม่ได้ใส่จะมีผลกับการโอนเงินให้สมาชิก
                                            </div>
                                        </div>
                                        <div class="file-upload">
                                            <label for="upload" class="file-upload__label"><i class='bx bx-upload'></i>
                                                อัพโหลดเอกสาร</label>
                                            <input id="upload" class="file-upload__input" type="file"
                                                name="file-upload">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">ธนาคาร</label>
                                        <select class="form-select" id="">
                                            <option>เลือกธนาคาร</option>
                                            <option></option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">สาขา</label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">เลขที่บัญชี <span
                                                class="text-danger small">* (ใส่เฉพาะตัวเลขเท่านั้น)</span></label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-12 col-xl-12 mb-3">
                                        <label for="" class="form-label">ชื่อบัญชี</label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="borderR10 py-2 px-3 bg-purple3 bg-opacity-50 h5 mb-3">ผู้รีบผลประโยชน์</div>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger d-flex align-items-center mb-0" role="alert">
                                            <i class='bx bxs-error me-2'></i>
                                            <div>
                                                ถ้าไม่กรอกถือว่าผู้รับผลประโยชน์จะเป็นผู้รับผลประโยชน์ตามกฎหมาย
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">ชื่อ</label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4">
                                        <label for="" class="form-label">นามสกุล</label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6 col-xl-4 mb-3">
                                        <label for="" class="form-label">เกี่ยวข้องเป็น</label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-12 text-center">
                                        <hr>
                                        <button type="submit" class="btn btn-success rounded-pill">บันทึกข้อมูล</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $('#linkMenuTop .nav-item').eq(0).addClass('active');
    </script>



    <script>
        function printErrorMsg(msg) {
            console.log(msg);
            $('._err').text('');
            $.each(msg, function(key, value) {
                $('.' + key + '_err').text(`*${value}*`);
            });
        }


        //BEGIN form_register
        $('#form_register').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '{{ route('store_register') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if ($.isEmptyObject(data.error) || data.status == "success") {
                        console.log(data.status);
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });
        });
        //END form_register
    </script>
@endsection
