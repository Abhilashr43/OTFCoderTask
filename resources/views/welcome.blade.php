@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employee List') }}</div>

                <div class="card-body">
                    <form action="{{ url('/') }}" method="GET" class="form-group">

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" name="user_name" placeholder="Employee Name"
                                            class="form-control" @if(!empty($request['user_name']))
                                            value="{{ $request['user_name'] }}" @endif>
                                    </td>
                                    <td>
                                        <select name="country_id" class="form-control">

                                            <option value="">
                                                Select Country
                                            </option>

                                            @forelse($country_list as $country)
                                            <option @if(!empty($request['country_id']) && $country->id ==
                                                $request['country_id']) selected @endif value="{{ $country->id }}">
                                                {{ $country->name }}
                                            </option>
                                            @empty
                                            <option value="">
                                                No Country
                                            </option>
                                            @endforelse

                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" value="{{ __('Search') }}" class="btn btn-primary">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <table class="table">
                        <thead>
                            <th scope="">
                                {{ __('Name') }}
                            </th>
                            <th scope="">
                                {{ __('Company Name') }}
                            </th>
                        </thead>

                        <tbody>
                            @forelse($user_list as $e)
                            <tr>
                                <td>
                                    {{ $e->name }}
                                </td>
                                <td>
                                    @foreach ($e->company as $c )
                                    <span> {{ $c->name }}</span> -
                                    <span>{{ \Carbon\Carbon::parse( $c->pivot->created_at )->diffForHumans() }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" align="center">No Records</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection