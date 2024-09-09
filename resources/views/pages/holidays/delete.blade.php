

@extends('layout.master')
@section('content')

<div class="page-data">
    <div class="confirm-del">
        <div class="confirm-message">
            <div class="message-show">
                هل انت متأكد من عملية الحذف؟
                <div class="confirm-btn">
                    <form action="{{ route('holidays.delete',  $holiday->holiday_id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: red;">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>


                    <a href="{{ route('holidays.index') }}" class="btn btn-secondary">لا</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
