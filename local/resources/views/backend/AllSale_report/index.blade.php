@extends('layouts.backend.app_new')
@section('head')
@endsection

@section('head_text')
    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">รายงาน</a></li>
            <li class="breadcrumb-item active" aria-current="page"> All Sale Report</li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="intro-y box p-5 mt-5">
    <div class="flex flex-col sm:flex-row sm:items-end xl:items-start mb-2">
        <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">

            <div class="sm:flex items-center sm:mr-4">
                <div class="col-span-12 sm:col-span-6"> <label for="modal-datepicker-1"
                        class="form-label">รหัสสมาชิก</label> <input type="text" id="user_name"
                        class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="รหัสสมาชิก"> </div>
            </div>


            <div class="sm:flex items-center sm:mr-4">
                <div class="col-span-12 sm:col-span-6"> <label for="modal-datepicker-1" class="form-label">ปี</label>
                    <select id="s_date" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0 form-select">
                        <option value="2022" @if (date('Y') == '2022') selected @endif>2022</option>
                        <option value="2023" @if (date('Y') == '2023') selected @endif>2023</option>
                        <option value="2024" @if (date('Y') == '2024') selected @endif>2024</option>

                    </select>
                </div>
                <div class="col-span-12 sm:col-span-6"> <label for="modal-datepicker-2" class="form-label">เดือน</label>
                    <?php
                    //$strtime = strtotime(date('m'));
                    $m = date('m');

                    // dd($m);

                    ?>
                    <select id="e_date" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0 form-select">

                        <option value="01" @if ($m == '01') selected @endif>01</option>
                        <option value="02" @if ($m == '02') selected @endif>02</option>
                        <option value="03" @if ($m == '03') selected @endif>03</option>
                        <option value="04" @if ($m == '04') selected @endif>04</option>
                        <option value="05" @if ($m == '05') selected @endif>05</option>
                        <option value="06" @if ($m == '06') selected @endif>06</option>
                        <option value="07" @if ($m == '07') selected @endif>07</option>
                        <option value="08" @if ($m == '08') selected @endif>08</option>
                        <option value="09" @if ($m == '09') selected @endif>09</option>
                        <option value="10" @if ($m == '10') selected @endif>10</option>
                        <option value="11" @if ($m == '11') selected @endif>11</option>
                        <option value="12" @if ($m == '12') selected @endif>12</option>


                    </select>
                </div>
            </div>


            <div class="mt-2 xl:mt-0">
                <div class="col-span-12 sm:col-span-6 mt-6"><button id="search-form" type="button"
                        class="btn btn-primary w-full sm:w-16">ค้นหา</button>
                </div>
                {{-- <button id="tabulator-html-filter-reset" type="button"
                        class="btn btn-secondary w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1">Reset</button> --}}
            </div>
        </form>

    </div>
    <div class="overflow-x-auto">
        <div class="table-responsive">
            <table id="workL" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">


            </table>

        </div>
    </div>

    {{-- <table id="workL" class="table table-bordered nowrap mt-2">

        </table> --}}
</div
@endsection

@section('script')

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>


    <script>
        $('#linkMenuTop .nav-item').eq(1).addClass('active');
    </script>
    <script>
        $('.page-content').css({
            'min-height': $(window).height() - $('.navbar').height()
        });
    </script>


    <script type="text/javascript">
        function numberWithCommas(x) {
            // x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            rs = parseFloat(x).toFixed(2);
            return rs;

        }
        $(function() {
            table_order = $('#workL').DataTable({
                dom: 'Bfrtip',
                buttons: ['excel'],
                searching: false,
                ordering: true,
                lengthChange: false,
                responsive: true,
                paging: false,
                pageLength: 100,
                processing: true,
                serverSide: true,
                "language": {
                    "lengthMenu": "แสดง _MENU_ แถว",
                    "zeroRecords": "ไม่พบข้อมูล",
                    "info": "แสดงหน้า _PAGE_ จาก _PAGES_ หน้า",
                    "search": "ค้นหา",
                    "infoEmpty": "",
                    "infoFiltered": "",
                    "paginate": {
                        "first": "หน้าแรก",
                        "previous": "ย้อนกลับ",
                        "next": "ถัดไป",
                        "last": "หน้าสุดท้าย"
                    },
                    'processing': "กำลังโหลดข้อมูล",
                },
                ajax: {
                    url: '{{ route('allsale_report_datable') }}',
                    data: function(d) {
                        d.user_name = $('#user_name').val();
                        d.s_date = $('#s_date').val();
                        d.e_date = $('#e_date').val();

                    },
                },


                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'w-10 text-center',
                        title: "ลำดับ",
                    },
                    {
                        data: "date",
                        title: "วันที่",
                        className: "w-10",
                    },
                    {
                        data: "user_name",
                        title: "รหัสสมาชิก",
                        className: "w-10",
                    },

                    {
                        data: "name",
                        title: "ชื่อ-นามสกุล",
                        className: "w-10",

                    },
                    {
                        data: "id_card",
                        title: "เลขบัตรประชาชน",
                        className: "w-10",

                    },


                    {
                        data: "qualification",
                        title: "ตำแหน่ง",
                        className: "w-10",

                    },
                    {
                        data: "active_date",
                        title: "สถานะ",
                        className: "w-5",

                    },
                    // {
                    //     data: "bonus_total",
                    //     title: "รวมรายได้",
                    //     className: "w-5 text-end",

                    // },
                    // {
                    //     data: "bonus_type_7",
                    //     title: "ช่วยเพื่อน",
                    //     className: "w-5 text-end",
                    // },

                    // {
                    //     data: "bonus_type_9",
                    //     title: "เจ้าของลิขสิทธ์",
                    //     className: "w-5 text-end",
                    // },
                    // {
                    //     data: "bonus_type_10",
                    //     title: "FastStart",
                    //     className: "w-5 text-end",
                    // },

                    // {
                    //     data: "bonus_type_11",
                    //     title: "XVVIP Team",
                    //     className: "w-5 text-end",
                    // },
                    {
                        data: "lv_1_mb",
                        title: "MB(1)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_1_mo",
                        title: "MO(1)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_1_vip",
                        title: "VIP(1)",
                        className: "w-5 text-end",
                    },

                    {
                        data: "lv_1_vvip",
                        title: "VVIP(1)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_1_xvvip_up",
                        title: "XVVIP UP(1)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_2_mb",
                        title: "MB(2)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_2_mo",
                        title: "MO(2)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_2_vip",
                        title: "VIP(2)",
                        className: "w-5 text-end",
                    },

                    {
                        data: "lv_2_vvip",
                        title: "VVIP(2)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_2_xvvip_up",
                        title: "XVVIP UP(3)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_4_mb",
                        title: "MB(3)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_3_mo",
                        title: "MO(3)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_3_vip",
                        title: "VIP(3)",
                        className: "w-5 text-end",
                    },

                    {
                        data: "lv_3_vvip",
                        title: "VVIP(3)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_3_xvvip_up",
                        title: "XVVIP UP(3)",
                        className: "w-5 text-end",
                    },

                    {
                        data: "lv_4_mb",
                        title: "MB(4)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_4_mo",
                        title: "MO(4)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_4_vip",
                        title: "VIP(4)",
                        className: "w-5 text-end",
                    },

                    {
                        data: "lv_4_vvip",
                        title: "VVIP(4)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_4_xvvip_up",
                        title: "XVVIP UP(4)",
                        className: "w-5 text-end",
                    },

                    {
                        data: "lv_5_mb",
                        title: "MB(5)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_5_mo",
                        title: "MO(5)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_5_vip",
                        title: "VIP(5)",
                        className: "w-5 text-end",
                    },

                    {
                        data: "lv_5_vvip",
                        title: "VVIP(5)",
                        className: "w-5 text-end",
                    },
                    {
                        data: "lv_5_xvvip_up",
                        title: "XVVIP UP(5)",
                        className: "w-5 text-end",
                    },

                ],
                order: [
                    [4, 'DESC']
                ],



            });
            $('#search-form').on('click', function(e) {
                table_order.draw();
                e.preventDefault();
            });

        });
    </script>
@endsection
