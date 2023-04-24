@extends('layouts.backend.app')



@section('head')
<meta charset="UTF-8">
@endsection

@section('css')
    <link href='https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css' rel='stylesheet'>
    <link href='https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css' rel='stylesheet'>
@endsection

@section('conten')
    @include('backend.navbar.navbar_mobile')
    <div class="flex overflow-hidden">

        @include('backend.navbar.navbar')
        <div class="content">
            @include('backend.navbar.top_bar')
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    รายงานโบนัสลิขสิทธิ์
                </h2>
            </div>


            <div class="intro-y box p-5 mt-5">
                <div class="flex flex-col sm:flex-row sm:items-end xl:items-start mb-2">
                    <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">
                        <div class="sm:flex items-center sm:mr-4">
                            {{-- <div class="col-span-12 sm:col-span-6">
                                <label for="modal-datepicker-1" class="form-label">ตำแหน่ง</label>
                            <select id="position"  class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0 form-select">
                                <option value="">ทั้งหมด</option>
                                <option value="MB">MB</option>
                                <option value="MO">MO</option>
                                <option value="VIP">VIP</option>
                                <option value="VVIP">VVIP</option>
                                <option value="XVVIP">XVVIP</option>
                                <option value="SVVIP">SVVIP</option>
                                <option value="MG">MG</option>
                                <option value="MR">MR</option>
                                <option value="ME">ME</option>
                                <option value="MD">MD</option>
                            </select>
                        </div> --}}
                        {{-- <div class="col-span-12 sm:col-span-6">
                            <label for="modal-datepicker-1" class="form-label">ประเภท</label>
                        <select id="type"  class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0 form-select">
                            <option value="">ทั้งหมด</option>
                            <option value="register">สมัครไหม่</option>
                            <option value="jangpv_vvip">แจง PV ปกติ</option>
                            <option value="jangpv_1200">แจง PV 1200</option>

                        </select>
                    </div> --}}


                        </div>

                        <div class="sm:flex items-center sm:mr-4">


                        <div class="col-span-12 sm:col-span-6"> <label for="modal-datepicker-1" class="form-label">รหัสสมาชิก</label> <input type="text"  id="user_name" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="รหัสสมาชิก"> </div>



                        </div>

                        <div class="sm:flex items-center sm:mr-4">
                                <div class="col-span-12 sm:col-span-6"> <label for="modal-datepicker-1" class="form-label">วันที่ทำรายการ</label> <input type="date" id="s_date" class="form-control" value="{{date('Y-m-d')}}"> </div>
                                <div class="col-span-12 sm:col-span-6"> <label for="modal-datepicker-2" class="form-label">ถึง</label> <input type="date" id="e_date" class="form-control"  value="{{date('Y-m-d')}}"> </div>
                        </div>


                        <div class="mt-2 xl:mt-0">
                            <div class="col-span-12 sm:col-span-6 mt-6"><button id="search-form" type="button"
                                class="btn btn-primary w-full sm:w-16">ค้นหา</button>
                            </div>
                            {{-- <button id="tabulator-html-filter-reset" type="button"
                                class="btn btn-secondary w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1">Reset</button> --}}
                        </div>
                    </form>
                    {{-- <div class="flex mt-5 sm:mt-0">

                        <div class="dropdown w-1/2 sm:w-auto">
                            <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false"
                                data-tw-toggle="dropdown"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" icon-name="file-text"
                                    data-lucide="file-text" class="lucide lucide-file-text w-4 h-4 mr-2">
                                    <path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <line x1="10" y1="9" x2="8" y2="9"></line>
                                </svg> Export <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down"
                                    data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 ml-auto sm:ml-2">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg> </button>
                            <div class="dropdown-menu w-40">
                                <ul class="dropdown-content">


                                    <li>
                                        <a id="tabulator-export-xlsx" href="javascript:;" class="dropdown-item"> <svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                icon-name="file-text" data-lucide="file-text"
                                                class="lucide lucide-file-text w-4 h-4 mr-2">
                                                <path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z">
                                                </path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13">
                                                </line>
                                                <line x1="16" y1="17" x2="8" y2="17">
                                                </line>
                                                <line x1="10" y1="9" x2="8" y2="9">
                                                </line>
                                            </svg> Export XLSX </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="overflow-x-auto">
                <div class="table-responsive">
                    <table id="workL" class="table table-striped table-hover dt-responsive display nowrap"
                        cellspacing="0">

                        {{-- <tfoot>
                            <tr>

                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: end;"></td>
                                <td></td>
                                <td></td>

                            </tr>
                        </tfoot> --}}
                    </table>

                </div>
                </div>

                {{-- <table id="workL" class="table table-bordered nowrap mt-2">

                </table> --}}
            </div>
        </div>
    @endsection

    @section('script')


        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
                    ordering: false,
                    lengthChange: false,
                    responsive: true,
                    paging: false,
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
                        url: '{{ route('report_copyright_datable') }}',
                        data: function(d) {
                        d.user_name = $('#user_name').val();
                        d.s_date = $('#s_date').val();
                        d.e_date = $('#e_date').val();
                        // d.position = $('#position').val();
                        // d.type = $('#type').val();

                        },
                    },


                    columns: [
                        // {
                        //     data: "id",
                        //     title: "ลำดับ",
                        //     className: "w-10 text-center",
                        // },
                        {
                            data: "created_at",
                            title: "วันที่ทำรายการ",
                            className: "w-10",
                        },
                        {
                            data: "customer_user",
                            title: "รหัสสมาชิก",
                            className: "w-10",
                        },

                        {
                            data: "name",
                            title: "ชื่อ",
                            className: "w-10",
                        },

                        {
                            data: "tax_percen",
                            title: "tax_percen",
                            className: "w-10",
                        },



                        {
                            data: "tax_total",
                            title: "tax_total",
                            className: "w-10",

                        },

                        {
                            data: "bonus_full",
                            title: "bonus_full",
                            className: "w-10",

                        },

                        {
                            data: "total_bonus",
                            title: "total_bonus",
                            className: "w-10",

                        },
                        {
                            data: "date_active",
                            title: "วันที่ได้รับโบนัส",
                            className: "w-10",

                        },

                        {
                            data: "status",
                            title: "status",
                            className: "w-10",

                        },



                    ],

            // "footerCallback": function(row, data, start, end, display) {
            //     var api = this.api(),
            //         data;

            //     // Remove the formatting to get integer data for summation
            //     var intVal = function(i) {
            //         return typeof i === 'string' ?
            //             i.replace(/[\$,]/g, '') * 1 :
            //             typeof i === 'number' ?
            //             i : 0;
            //     };

            //     pv = api
            //         .column(6, {
            //             page: 'current'
            //         })
            //         .data()
            //         .reduce(function(a, b) {
            //             return intVal(a) + intVal(b);
            //         }, 0);



            //     // Update footer
            //     $(api.column(5).footer()).html('Total');
            //     $(api.column(6).footer()).html(numberWithCommas(pv));

            // }

                });
                $('#search-form').on('click', function(e) {
                table_order.draw();
                e.preventDefault();
            });

            });
        </script>
    @endsection