 <!-- Step 1 -->
<div class="tab-pane block-content  {{ ($class_active == 'father_active') ? 'active' : '' }}" id="step1" role="tabpanel">
    <div class="form-row my-3">
        <div class="col">
            <label for="email">{{trans('Parent_trans.Email')}}</label>
            <input type="email" wire:model="Email"  class="form-control" id="email">
            @error('Email')
                <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <label for="password">{{trans('Parent_trans.Password')}}</label>
            <input id="password" type="password" wire:model="Password" class="form-control" >
            @error('Password')
            <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row mb-3">
        <div class="col">
            <label for="Name_Father">{{trans('Parent_trans.Name_Father')}}</label>
            <input id="Name_Father" type="text" wire:model="Name_Father" class="form-control" >
            @error('Name_Father')
                <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <label for="Name_Father_en">{{trans('Parent_trans.Name_Father_en')}}</label>
            <input id="Name_Father_en" type="text" wire:model="Name_Father_en" class="form-control" >
            @error('Name_Father_en')
                <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row mb-3">
        <div class="col-md-3 mt-3">
            <label for="title">{{trans('Parent_trans.Job_Father')}}</label>
            <input type="text" wire:model="Job_Father" class="form-control">
            @error('Job_Father')
            <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3 mt-3">
            <label for="title">{{trans('Parent_trans.Job_Father_en')}}</label>
            <input type="text" wire:model="Job_Father_en" class="form-control">
            @error('Job_Father_en')
            <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col mt-3">
            <label for="title">{{trans('Parent_trans.National_ID_Father')}}</label>
            <input type="text" wire:model="National_ID_Father" class="form-control">
            @error('National_ID_Father')
                <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="col mt-3">
            <label for="title">{{trans('Parent_trans.Passport_ID_Father')}}</label>
            <input type="text" wire:model="Passport_ID_Father" class="form-control">
            @error('Passport_ID_Father')
                <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col mt-3">
            <label for="title">{{trans('Parent_trans.Phone_Father')}}</label>
            <input type="text" wire:model="Phone_Father" class="form-control">
            @error('Phone_Father')
                <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputCity">{{trans('Parent_trans.Nationality_Father_id')}}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="Nationality_Father_id">
                <option selected>{{trans('Parent_trans.Choose')}}...</option>
                @foreach($Nationalities as $National)
                    <option value="{{$National->id}}">{{$National->name}}</option>
                @endforeach
            </select>
            @error('Nationality_Father_id')
                <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="inputState">{{trans('Parent_trans.Blood_Type_Father_id')}}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="Blood_Type_Father_id">
                <option selected>{{trans('Parent_trans.Choose')}}...</option>
                @foreach($Type_Bloods as $Type_Blood)
                    <option value="{{$Type_Blood->id}}">{{$Type_Blood->name}}</option>
                @endforeach
            </select>
            @error('Blood_Type_Father_id')
            <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="inputZip">{{trans('Parent_trans.Religion_Father_id')}}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="Religion_Father_id">
                <option selected>{{trans('Parent_trans.Choose')}}...</option>
                @foreach($Religions as $Religion)
                    <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                @endforeach
            </select>
            @error('Religion_Father_id')
                <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="father_address">{{trans('Parent_trans.Address_Father')}}</label>
        <textarea class="form-control" wire:model="Address_Father" id="father_address" rows="4"></textarea>
        @error('Address_Father')
            <div class="alert alert-danger my-2">{{ $message }}</div>
        @enderror
    </div>
</div>
<!-- END Step 1 -->
