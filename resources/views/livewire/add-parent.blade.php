<div>
    @if ($show_table)
        @include('livewire.parent_table')
    @else
    <div class="my-3">
        @if (!empty($successMessage))
            <div class="alert alert-success d-flex align-items-center animated fadeInDown" role="alert">
                <div class="flex-00-auto">
                    <i class="fa fa-fw fa-check"></i>
                </div>
                <div class="flex-fill ml-3">
                    <p class="mb-0 text-capitalize">{{ $successMessage }}</p>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if($catchError)
            <div class="alert alert-danger d-flex align-items-center animated fadeInDown" role="alert">
                <div class="flex-00-auto">
                    <i class="far fa-sad-tear fa-fw"></i>
                </div>
                <div class="flex-fill ml-3">
                    <p class="mb-0 text-capitalize">{{ $catchError }}</p>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
    </div>

    <!-- Steps Content -->
    <div class="tab-content" style="min-height: 303px;">

        <!-- Step Tabs -->
        <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ ($class_active == 'father_active') ? 'active' : '' }}" href="#step1">1. {{ trans('Parent_trans.Step1') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($class_active == 'mother_active') ? 'active' : '' }}" href="#step2">2. {{ trans('Parent_trans.Step2') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($class_active == 'confirm_active') ? 'active' : '' }}" href="#step3">3. {{ trans('Parent_trans.Step3') }}</a>
            </li>
        </ul>
        <!-- END Step Tabs -->

        <!-- Step 1 -->
        @include('livewire.father_form')
        <!-- END Step 1 -->

        <!-- Step 2 -->
        @include('livewire.mother_form')
        <!-- END Step 2 -->

        <!-- Step 3 -->
        <div class="tab-pane {{ ($class_active == 'confirm_active') ? 'active' : '' }} block-content" id="step3" role="tabpanel">
            <div class="my-7">
                <label>{{trans('Parent_trans.Attachments')}}</label>
                <div class="form-group">
                    <input type="file" wire:model="photos" accept="image/*" multiple>
                </div>
                <input type="hidden" wire:model="Parent_id">
            </div>
        </div>
        <!-- END Step 3 -->
    </div>
    <!-- END Steps Content -->

    <!-- Steps Navigation -->
    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
        <div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-alt-primary" data-wizard="prev" wire:click='getMeBack'>
                    <i class="fa fa-angle-left mr-1"></i> Previous
                </button>
            </div>
            @if ($updateMode)
                <div class="col-6 text-right">
                    @if ($class_active == 'father_active')
                        <button type="button" class="btn btn-alt-primary" data-wizard="next" wire:click='firstStepSubmit_edit'>
                            Next <i class="fa fa-angle-right ml-1"></i>
                        </button>
                    @elseif ($class_active == 'mother_active')
                        <button type="button" class="btn btn-alt-primary" data-wizard="next" wire:click='secondStepSubmit_edit'>
                            Next <i class="fa fa-angle-right ml-1"></i>
                        </button>
                    @elseif ($class_active == 'confirm_active')
                        <button type="button" class="btn btn-primary" data-wizard="finish" wire:click='submitForm_edit'>
                            <i class="fa fa-check mr-1"></i> Submit
                        </button>
                    @endif
                </div>
            @else
                <div class="col-6 text-right">
                    @if ($class_active == 'father_active')
                        <button type="button" class="btn btn-alt-primary" data-wizard="next" wire:click='firstStepSubmit'>
                            Next <i class="fa fa-angle-right ml-1"></i>
                        </button>
                    @elseif ($class_active == 'mother_active')
                        <button type="button" class="btn btn-alt-primary" data-wizard="next" wire:click='secondStepSubmit'>
                            Next <i class="fa fa-angle-right ml-1"></i>
                        </button>
                    @elseif ($class_active == 'confirm_active')
                        <button type="button" class="btn btn-primary" data-wizard="finish" wire:click='submitForm'>
                            <i class="fa fa-check mr-1"></i> Submit
                        </button>
                    @endif
                </div>
            @endif

        </div>
    </div>
    <!-- END Steps Navigation -->
    @endif
</div>


