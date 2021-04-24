@extends('Admin.layout.layout')

@section('title')
    {{$data['title']}}
@endsection
@section('css')
    <link href="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('js')
    <script src="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/crud/datatables/basic/basic.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/features/miscellaneous/sweetalert2.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/features/miscellaneous/dropify.min.js')}}"></script>
    <!--begin::Page scripts(used by this page) -->
    <script>

        $("body").on("click", "#delete", function () {
            var dataList = [];
            dataList = $("#kt_datatable input:checkbox:checked").map(function(){
                return $(this).val();
            }).get();

            if(dataList.length >0){
                Swal.fire({
                    title: "{{__('lang.delete_warrning')}}",
                    text: "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f64e60",
                    confirmButtonText: "{{__('lang.btn_yes')}}",
                    cancelButtonText: "{{__('lang.btn_no')}}",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }).then(function (result) {
                    if (result.value) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url:'{{url("admin/users/delete")}}',
                            type:"get",
                            data:{'id':dataList,_token: CSRF_TOKEN},
                            dataType:"JSON",
                            success: function (data) {
                                if(data.message == "Success")
                                {
                                    $("#kt_datatable .selected").hide();

                                    $('#delete').text("{{__('lang.deleted_successfully')}}");

                                    Swal.fire("{{__('lang.Success')}}", "{{__('lang.deleted_successfully')}}", "success");
                                    location.reload();
                                }else{
                                    Swal.fire("{{__('lang.Sorry')}}", "{{__('lang.Message_Fail_Delete')}}", "error");
                                }
                            },
                            fail: function(xhrerrorThrown){
                                Swal.fire("{{__('lang.Sorry')}}", "{{__('lang.Message_Fail_Delete')}}", "error");
                            }
                        });
                        // result.dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire("{{__('lang.Cancelled')}}", "{{__('lang.Message_Cancelled_Delete')}}", "error");
                    }
                });
            }
        });

    </script>
@endsection
@section('content')

        <!--begin::Container-->
        <div class="container">

            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">
                        {{$data['title']}}
                    </div>

                </div>
                <div class="card-header flex-wrap py-3">

                    <div class="card-toolbar">
                        <a href="{{url('admin/users/create')}}"
                           class="btn btn-primary font-weight-bolder">
          <span class="svg-icon svg-icon-md">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                 height="24px" viewBox="0 0 24 24" version="1.1">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <circle fill="#000000" cx="9" cy="15" r="6"/>
                <path
                    d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                    fill="#000000" opacity="0.3"/>
              </g>
            </svg>

              <!--end::Svg Icon-->
          </span> {{__('lang.create')}}</a>
                        &nbsp;&nbsp;
                        <!--begin::Button-->
                        <button id="delete" class="btn btn-danger font-weight-bolder"><span
                                class="svg-icon svg-icon-md"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Trash.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <rect x="0" y="0" width="24" height="24"/>
                  <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                  <path
                      d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z"
                      fill="#000000"/>
              </g>
          </svg><!--end::Svg Icon--></span>
                            {{__('lang.delete')}}</button>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">

                    <h3> {{$data['title']}}</h3>


                    <!--begin: Datatable-->
                    <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('lang.name')}} </th>
                            <th>{{__('lang.email')}} </th>
                            <th>{{__('lang.NumOrders')}} </th>
                             <th> {{__('lang.actions')}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $User)
                            <tr>
                                <td>
                                    <label class="checkbox checkbox-single">
                                        <input type="checkbox" value="{{$User->id}}" class="checkable" name="check_delete[]"/>
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="kt-user-card-v2">
                                        <div class="kt-user-card-v2__details">
                                            <span class="kt-user-card-v2__name"></span>
                                            {{$User->name}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="kt-user-card-v2">
                                        <div class="kt-user-card-v2__details">
                                            <span class="kt-user-card-v2__name"></span>
                                            {{$User->email}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="kt-user-card-v2">
                                        <div class="kt-user-card-v2__details">
                                            <span class="kt-user-card-v2__name"></span>
                                            <a href="#">
                                            {{$User->orders->count()}}
                                            </a>
                                        </div>
                                    </div>
                                </td>

                                <td nowrap="nowrap">
                                    <a  class="btn btn-icon btn-success btn-sm btn-clean btn-icon btn-icon-md edit-Advert"
                                       href="{{url('admin/users/edit/'.$User->id)}}">
                                        <i class="flaticon-edit icon-nm"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                    {{$users->links()}}

                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
@endsection
