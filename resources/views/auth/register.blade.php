@extends('layouts.app')

@section('content')

        

    <div class="cards d-flex align-items-center justify-content-center flex-column">
        <div class=" row w-100 pt-4 d-flex justify-content-center gap-3 text-center ">
            <h1 class="titleReg fw-bold">Register now</h1>
            <h3 class=" titleReg" >Join us and take your restaurant to the next level !</h3>
            <!-- colonna 1 -->
            <div class="my-col col-12 col-lg-3  text-center ">
                
                <div class="containerIm">
                <img src="{{ asset('storage/branding/more-orders.svg') }}" alt="Descrizione immagine" class="img-fluid mb-2">
                </div>
                <h5 class="fw-bolder"> Deliveboo</h5>
                <p class="text-muted">"It is the meeting point between you and your potential customers, loyal to our platform thanks to farsighted investments in marketing campaigns and an ever richer offer of products and services.</p>
            </div>

            <!-- Colonna 3-->
            <div class="my-col col-12 col-lg-3 text-center ">

                <div class="containerIm">
                <img src="{{ asset('storage/branding/more-control.svg') }}" alt="Descrizione immagine" class="img-fluid mb-2">
            </div>
                <h5 class="fw-bolder">Zero risks</h5>
                <p class="text-muted">There are no fixed membership fees. Our revenue depends on commissions, and therefore on the success of your business. Additionally, we regularly offer deals, discounts, and competitive prices on packaging, delivery bags, and rider apparel.</p>
            </div>

            <!-- Colonna 3 -->
            <div class="my-col col-12 col-lg-3 text-center ">

                <div class="containerIm">
                <img src="{{ asset('storage/branding/consegne.svg') }}" alt="Descrizione immagine" class="img-fluid mb-2">
            </div>
                <h5 class="fw-bolder">Customized deliveries</h5>
                <p class="text-muted">Our services, the opportunities provided by delivery options, and our smart support can be beneficial to businesses like yours, which are the cornerstone of our business.</p>
            </div>
        </div>
    </div>    

    <div class="register-box container">

        <div class="row justify-content-center">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Register</h1>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" onsubmit="comparePwd()">
                            @csrf
                            <div class="rov d-flex flex-column flex-lg-row align-items-start position-relative pb-5 justify-content-center">
                                <div class="col-12 col-lg-6">
                                    <h3 class="mb-4">User data</h3>
                                    <div class="mb-4 row">
                                        
                                        
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name *</label>
            
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="mb-4 row">
                                        <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname *') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>
            
                                            @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="mb-4 row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address *') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="mb-4 row">
                                        <label for="vat_number" class="col-md-4 col-form-label text-md-right">{{ __('P.IVA *') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="vat_number" type="numerable" class="form-control @error('vat_number') is-invalid @enderror" name="vat_number" value="{{ old('vat_number') }}" required autocomplete="vat_number" autofocus minlength="11" maxlength="11">
            
                                            @error('vat_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="mb-4 row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password *') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="mb-4 row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password *') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                        <div id="match-text" class="text-danger d-none">Passwords do not match</div>
                                    </div>
                
                                </div>
                                <div class="col-12 col-lg-6 position-absolute d-flex flex-column bottom-0 justify-content-end align-items-center ">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-success px-4" onclick="validate()">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <h3 class="mb-4">Restaurant data</h3>
                                
        
                                    <div class="mb-4 row">
                                        <label for="name_res" class="col-md-4 col-form-label text-md-right">{{ __('Restaurant Name *') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="name_res" type="text" class="form-control @error('name_res') is-invalid @enderror" name="name_res" value="{{ old('name_res') }}" required maxlength="100" autocomplete="name_res" autofocus>
            
                                            @error('name_res')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
        
        
                                    <div class="mb-4 row">
                                        <label for="address_res" class="col-md-4 col-form-label text-md-right">{{ __('Address *') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="address_res" type="text" class="form-control @error('address_res') is-invalid @enderror" name="address_res" value="{{ old('address_res') }}" required maxlength="100" autocomplete="address_res" autofocus>
            
                                            @error('address_res')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="mb-4 row">
                                        <label for="img_res" class="col-md-4 col-form-label text-md-right">{{ __('Image *') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="img_res" type="file" class="form-control @error('img_res') is-invalid @enderror" name="img_res" value="{{ old('img_res') }}" required accept=".jpg, .bpm, .png, .svg" autocomplete="img_res" autofocus>
            
                                            @error('img_res')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="mb-4 row">
                                        <label for="img_res" class="col-md-4 col-form-label text-md-right">{{ __('Category *') }}</label>
            
                                        <div class="col-md-6">
                                            <div class="d-flex gap-3 flex-wrap ">
                                                @foreach($categories as $category)
                                                <div class="form-check">
            
                                                    <input 
                                                        type="checkbox" 
                                                        name="categories[]" 
                                                        value="{{$category->id}}" 
                                                        class="form-check-input checkbox" 
                                                        id="category-{{$category->id}}"
                                                        {{in_array($category->id, old('categories', [])) ? 'checked' : ''}}
                                                        required
                                                    >
                                                    <label 
                                                        class="form-check-label" 
                                                        for="category-{{$category->id}}"
                                                    >{{$category->name}}</label>
                                                </div>
                                                @endforeach
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class=" fw-bold my-5   justify-content-between">
                                        <strong>* Required field</strong>
                                    </div>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    const checkBoxes = document.querySelectorAll('.checkbox');
    console.log(checkBoxes);
    
    function validate(){
        let marked_checkboxes = [];
        checkBoxes.forEach((checkBox, index) => {
            if(checkBox.checked){
                marked_checkboxes.push(checkBox)
            }
        });
        
        if(marked_checkboxes.length > 0){
            checkBoxes.forEach(checkBox =>{
                checkBox.required = false;
            })
        }else{
            checkBoxes.forEach(checkBox =>{
                checkBox.required = true;
            })
        }
    }

    const passwordInput = document.querySelector('#password');
    const confirmPasswordInput = document.querySelector('#password-confirm');
    const matchText = document.querySelector('#match-text');

    console.log('pwd', passwordInput)
    console.log('confirmPwd', confirmPasswordInput)

    function comparePwd(){
        if(passwordInput.value != confirmPasswordInput.value){
            console.log('not matching')
            event.preventDefault()
            matchText.classList.remove('d-none');
            return false
        }
    }
</script>
@endsection


