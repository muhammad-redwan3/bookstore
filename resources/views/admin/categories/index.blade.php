@extends('theme.default')

@section('head')
<link href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('heading')
عرض التصنيفات
@endsection

@section('content')
<a class="btn btn-primary" href="{{ route('categories.create') }}"><i class="fas fa-plus"></i> أضف تصنيفًا جديدًا</a>
<hr>
<div class="row">
    <div class="col-md-12">
        <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>الاسم اللطيف</th>
                    <th>الوصف</th>
                    <th>خيارات</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('categories.edit', $category) }}"><i class="fa fa-edit"></i> تعديل</a>
                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#delete{{ $category->id }}"><i class="fa fa-trash"></i> حذف</button>
                            <div class="modal fade" id="delete{{ $category->id }}" tabindex="-1" role="dialog"
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
                                            <form method="POST" action="{{ route('categories.destroy', $category) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $category->id }}">
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
