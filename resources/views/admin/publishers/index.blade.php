@extends('theme.default')

@section('head')
<link href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('heading')
عرض الناشرين
@endsection

@section('content')
<a class="btn btn-primary" href="{{ route('publishers.create') }}"><i class="fas fa-plus"></i> أضف ناشرًا جديدًا</a>
<hr>
<div class="row">
    <div class="col-md-12">
        <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>العنوان</th>
                    <th>خيارات</th>
                </tr>
            </thead>

            <tbody>
                @foreach($publishers as $publisher)
                    <tr>
                        <td>{{ $publisher->name }}</td>
                        <td>{{ $publisher->address }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('publishers.edit', $publisher) }}"><i class="fa fa-edit"></i> تعديل</a>
                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#delete{{ $publisher->id }}"><i class="fa fa-trash"></i> حذف</button>
                            <div class="modal fade" id="delete{{ $publisher->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                هل أنت متأكد من عملية الحذف
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('publishers.destroy', $publisher) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $publisher->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">إلغاء الأمر</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">تأكيد على الحذف</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<!-- Page level plugins -->
<script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#books-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
            }
        });
    });
</script>
@endsection
