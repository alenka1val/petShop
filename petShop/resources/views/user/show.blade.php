@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="pt-3 pb-3">
            @if(Auth::user()->admin())
            <form method="POST" action="{{ route('user.edit') }}">
                @csrf
                <div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name"
                               type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Názov produktu"
                               autocomplete="name"
                               autofocus
                               required
                        >
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                    <label for="animal">Animal</label>
                    <div class="input-group">
                        <select class="custom-select" id="animal" name="animal">
                            <option selected>Choose...</option>
                            <option value="cat">Cat</option>
                            <option value="dog">Dog</option>
                            <option value="fish">Fish</option>
                        </select>
                    </div>
                    <label for="category" class="pt-2">Category</label>
                    <div class="input-group">
                        <select class="custom-select" id="category" name="category">
                            <option selected>Choose...</option>
                            <option value="toy">Toy</option>
                            <option value="food">Food</option>
                            <option value="stuff">Other</option>
                        </select>
                    </div>
                    <div class="form-group pt-2">
                        <label for="price">Price</label>
                        <div class="input-group">
                            <input id="price"
                                   type="number"
                                   step=0.01
                                   class="form-control @error('price') is-invalid @enderror"
                                   name="price"
                                   value="{{ old('price') }}"
                                   placeholder="Price"
                                   autocomplete="price"
                                   autofocus
                                   required
                            >
                            <div class="input-group-append">
                                <span class="input-group-text">€</span>
                            </div>
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="on_stock">On Stock</label>
                        <input id="on_stock"
                               type="number"
                               class="form-control @error('on_stock') is-invalid @enderror"
                               name="on_stock"
                               value="{{ old('on_stock') }}"
                               placeholder="On Stock"
                               autocomplete="on_stock"
                               autofocus
                               required
                        >
                        @error('on_stock')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class="profession-control">
                        <div class="entry">
                            @for ( $i=0 ; $i==0 ; $i++ )
                                <div class="parameter{{ $i }}'">
                                    <div class="form-group pt-3">
                                        <h4>Parameter</h4>
                                    </div>
                                    <div class="form-group col-form-label">
                                        <label for="parametere[{{ $i }}][type]">Parameter type</label>
                                        <input id="parameter[{{ $i }}][type]"
                                               type="text"
                                               class="form-control @error('parameter.'.$i.'.type') is-invalid @enderror"
                                               name="parameter[{{ $i }}][type]"
                                               value="{{ old('parameter.'.$i.'.type') }}"
                                               placeholder="Parameter type"
                                               autocomplete="parameter[{{ $i }}][type]"
                                               required
                                        >
                                        @error('parameter.'.$i.'.type')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="parameter[{{ $i }}][value]">Value</label>
                                        <input
                                            id="parameter[{{ $i }}][value]"
                                            type="text"
                                            class="form-control @error('parameter.'.$i.'.value') is-invalid @enderror"
                                            name="parameter[{{ $i }}][value]"
                                            value="{{ old('parameter.'.$i.'.value') }}"
                                            placeholder="Value"
                                            autocomplete="parameter[{{ $i }}][value]"
                                            required
                                        >
                                        @error('parameter.'.$i.'.value')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <div class="text-center">
                                <button class="btn btn-add-parameter">
                                    <div class="row">
                                        <span class="col-2"><i class="fa fa-plus-square"></i></span>
                                        <p class="col-9 my-0">Pridať Parameter</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
                @else
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-actions">
                            <div class="float-left">
                                <h1>
                                    {{ $user->name }} {{ $user->surname }}
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th scope="row">Email</th>
                                <td>{{ ($user->email)? $user->email:'not avaliable' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Phone</th>
                                <td>{{ ($user->phone)? $user->phone:'not avaliable' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <form method="get" action="{{ route('user.edit', $user->id) }}">
                            <button class="btn btn-primary submit float-left">
                                <i class="fas fa-user-edit"></i>
                                Edit
                            </button>
                        </form>
                        <button class="btn btn-outline-primary float-right">
                            <i class="fas fa-times"></i>
                            Delete Account
                        </button>
                    </div>
                </div>
            @endif
        </div>
        @if($user->oders)
            <div class="pt-3 pb-3">
                <table class="table" id="mydatatable">
                    <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            email
                        </th>
                        <th>
                            it
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            this
                        </td>
                        <td>
                            is
                        </td>
                        <td>
                            boring
                        </td>
                    </tr>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            email
                        </th>
                        <th>
                            it
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        $('#mydatatable').DataTable();
    </script>
    <script>
        var numCol = 1;
        $(function () {
            $(document).on('click', '.btn-add-parameter', function (e) {
                e.preventDefault();
                var controlDiv = $('.profession-control'),
                    currentEntry = $('.profession-control .entry:first'),
                    html='<div class="parameter'+numCol+'"><div class="form-group pt-3"><h4>Parameter</h4></div><div class="form-group col-form-label"><label for="parametere[number][type]">Parameter type</label><input id="parameter[number][type]" type="text" class="form-control @error('parameter.number.type') is-invalid @enderror" name="parameter[number][type]" value="{{ old('parameter.number.type') }}" placeholder="Parameter type" autocomplete="parameter[number][type]" required> @error('parameter.number.type')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror</div> <div class="form-group"><label for="parameter[number][value]">Value</label><input id="parameter[number][value]"type="text" class="form-control @error('parameter.number.value') is-invalid @enderror" name="parameter[number][value]" value="{{ old('parameter.number.value') }}" placeholder="Value" autocomplete="parameter[number][value]" required>@error('parameter.number.value')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror<div class="del_button"><span class="input-group-btn"><button class="btn btn-danger btn-remove-parameter '+numCol+'" type="button"><i class="fa fa-minus-square"></i></button></span></div></div></div>',
                    newEntry = $(currentEntry.append(html));

                newEntry.find('input').each(function () {
                    this.name=this.name.replace('number',''+numCol+'');
                    this.value=this.value.replace('number',''+numCol+'');
                    this.id=this.id.replace('number',''+numCol+'');
                    this.autocomplete=this.autocomplete.replace('number',''+numCol+'');
                }).end().appendTo('body',''+numCol+'');

                numCol++;

                newEntry.appendTo(controlDiv);
            }).on('click', '.btn-remove-parameter', function (e) {
                var num = $(this).attr('class').replace(/^\D+/g, '');
                $('div').parent('.parameter' + num).remove();
                e.preventDefault();
                return false;
            });
        });
    </script>
@endpush
