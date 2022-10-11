<style>
    body {
        font-size: .9rem;
    }

    @page {
        header: page-header;
        footer: page-footer;
        /* margin-top: 2.54cm;
        margin-bottom: 2.54cm; */
        /* margin-left: 2.54cm; */
        /* margin-right: 2.54cm; */
    }

    .row {
        width: 100%;
    }

    .col-1,
    .col-2,
    .col-3,
    .col-4,
    .col-5,
    .col-6,
    .col-7,
    .col-8,
    .col-9,
    .col-10,
    .col-11,
    .col-12 {
        float: left;
    }

    .col-12 {
        width: 100%;
    }

    .col-11 {
        width: 91.66666667%;
    }

    .col-10 {
        width: 83.33333333%;
    }

    .col-9 {
        width: 75%;
    }

    .col-8 {
        width: 66.66666667%;
    }

    .col-7 {
        width: 58.33333333%;
    }

    .col-6 {
        width: 50%;
    }

    .col-5 {
        width: 41.66666667%;
    }

    .col-4 {
        width: 33.33333333%;
    }

    .col-3 {
        width: 25%;
    }

    .col-2 {
        width: 16.66666667%;
    }

    .col-1 {
        width: 8.33333333%;
    }

    #dataTable_OrderDetail {
        margin-top: .5rem;
    }

    table tr td,
    table tr th {
        padding: .3rem .7rem;
    }

    table,
    th,
    td {
        border-collapse: collapse;
    }

    th,
        {
        background-color: #f5f5f5;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
    }

    tfoot tr td {
        background-color: #f5f5f5;
        padding: .3rem;
    }

    tbody td {
        padding: .2rem 0;
        border-bottom: 1px solid #ddd;
    }

    p {
        padding: 0;
        margin: 0;
    }

    .text-center {
        text-align: center;
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    .box_address_company {
        margin-top: 30px;
    }

    .border-right {
        border-right: 1px solid #888888;
    }

    .pl {
        padding-left: 1rem;
    }

    .mb {
        margin-bottom: 1rem;
    }

    .address {
        height: 75px !important;
    }

    .text-header {
        font-weight: bold;
        margin-bottom: .5rem;
    }

    .footer {
        background: #F5F5F5;
        padding: .5rem;
    }

    .text_head {
        font-weight: bold;
    }

    .text_info {
        font-weight: normal;
    }


    .grid-container {
        display: grid;
        grid-template-columns: auto auto;
        gap: 10px;
    }


    .box_item {

        width: 100%;
        border: 0.4px solid rgb(20, 20, 20);
        padding-bottom: 5px;
        padding-top: 10px;
        padding-left: 10px;


    }

    .test {
        background: red;

    }

    .rrrr {
        text-align: right;
        background: rgb(64, 255, 0);
    }

    .box_number {

        text-align: center
    }
</style>





<div class="grid-container">

    @foreach ($orders_detail as $key => $item)
        @if ($key % 8 == 0 && $key != 0)
            <div style="page-break-before: always;"></div>
        @endif


        <div class="test">
            <span class="text_head">รหัสการสั่งซื้อ :
                <span class="text_info"> {{ $item->code_order }}</span>
                <span class="text_info">
                    {{ $item->customers_user_name }}
                    {{ $item->customers_name }}
                    {{ $item->customers_last_name }}
                    ({{ $item->position }})
                    เบอร์โทร : <span class="text_info"> {{ $item->tel != null ? $item->tel : '-' }} </span>
                </span>
            </span>
        </div>
        <div class="rrrr">
            <span class="box_number">{{ $key + 1 }}</span>
        </div>
    @endforeach
</div>





<div class="col-12">
    <div class="box_item">

        <div class="row">
            <div class="col-12">
                <span class="text_head">ที่อยู่จัดส่ง :

                    <span class="text_info"> {{ $item->name }} </span>
                    <span class="text_info"> {{ $item->house_no }}</span>
                    <span class="text_info">ตำบล {{ $item->tambon }}</span>
                    <span class="text_info">อำเภอ {{ $item->district }}</span>
                    <span class="text_info"> {{ $item->province }} {{ $item->zipcode }}</span>

                </span>
            </div>
        </div>

    </div>
</div>
