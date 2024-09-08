@extends('layout.master')
@section('content')

<div class="page-data">
    <div class="confirm-del">
        <div class="confirm-message">
            <div class="message-show">
                هل انت متأكد من عملية الحذف؟
                <div class="confirm-btn">
                    <form action="{{ route('delete_department', $department->dept_id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: red;">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>


                    <a href="{{ route('index_department') }}" class="btn btn-secondary">لا</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
