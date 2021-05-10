@extends('home')
@section('content_Plan')
<div class="col-sm">

    <h3 class="text-center">{{__('Plans')}}</h3>
    @if(session("status"))
    <div class="alert alert-success" role="alert">
        {{ session("status") }}
    </div>
    @endif

    <div class="row">
        <div class="col-6 col-md-4">
            <form action="{{route('plan.createOrUpdate')}}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">{{__('Choose')." ".__('Task')}}</label>
                    </div>
                    <select class="custom-select" name="id_task" id="inputGroupSelect01">
                        @foreach($listTask as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                @foreach($listMember as $item)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="member_{{ $item->id }}" value="{{ $item->id }}" id="id_{{ $item->id }}">
                    <label class="form-check-label" for="id_{{ $item->id }}">
                        {{ $item->name }}
                    </label>
                </div>
                @endforeach
                <button type="submit" class="btn btn-dark text-secondary bg-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>{{__('Add')." ".__('Plan')}}</button>
            </form>
        </div>
        <div class="col-12 col-md-8">
            <table class="table  table-striped ">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID {{__('Plan')}}</th>
                        <th scope="col">{{__('Name')." ".__('Task')}}</th>
                        <th scope="col">{{__('Members')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listPlan as $items)
                    <tr>
                        <th scope="row">{{$items['id_task']}}</th>
                        <th scope="row">{{$items['name_task']}}</th>
                        <td>
                            @foreach($items['memberOfTask'] as $item)
                            {{'- '. $item}}
                            @php
                            echo "<br>";
                            @endphp
                            @endforeach
                        </td>
                        <td>
                            <form action="{{ route('plan.delete',$items['id_task'])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                    {{__('Delete')}}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>
@endsection
