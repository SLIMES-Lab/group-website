@section('styles')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ 'assets/css/academicons.min.css' }}">
    <link href="{{ asset('assets/css/summernote-lite.min.css') }}" rel="stylesheet">
@endsection

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex flex-col sm:flex-row sm:space-x-6">
            <div class="flex-1">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input disabled id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name', $user->name)" autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="flex-1">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input disabled id="email" name="email" type="email" class="mt-1 block w-full"
                    :value="old('email', $user->email)" autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>
        <div>
            <x-input-label for="photo" :value="__('Photo (1:1 ratio)')" />
            @if ($user->photo)
                <img src="{{ URL::to('/') }}{{ $user->photo }}" id="previousImg" style="height: 150px; width: auto;"
                    class="mt-1 mb-3" alt="{{ $user->name }}">
            @else
                <img src="{{ URL::to('/') }}/assets/images/avatar-default.png" id="previousImg"
                    style="height: 150px; width: auto;" class="mt-1 mb-3" alt="Default Image">
            @endif
            <img id="newImg" src="#" alt="New Image" class="mt-1 mb-3"
                style="display: none; height: 150px; width: auto;" />
            <input type="file" name="photo" class="form-control mt-1" id="imgInp" />
        </div>
        <div class="flex flex-col sm:flex-row sm:space-x-6">
            <div class="flex-1">
                <x-input-label for="type" :value="__('Position Type')" />
                <select class="mt-1 block w-full" name="type">
                    <option value="" {{ old('type', $user->type) == '' ? 'selected' : '' }}>Select...</option>
                    <option value="bachelors" {{ old('type', $user->type) == 'bachelors' ? 'selected' : '' }}>
                        Bachelor's</option>
                    <option value="masters" {{ old('type', $user->type) == 'masters' ? 'selected' : '' }}>Masters
                    </option>
                    <option value="phd" {{ old('type', $user->type) == 'phd' ? 'selected' : '' }}>PhD</option>
                    <option value="postdoc" {{ old('type', $user->type) == 'postdoc' ? 'selected' : '' }}>Post Doc
                    </option>
                    @if (Auth::user()->is_super_admin)
                        <option value="guide" {{ old('type', $user->type) == 'guide' ? 'selected' : '' }}>Supervisor
                        </option>
                    @endif
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('type')" />
            </div>

            <div class="flex-1">
                <x-input-label for="starting_year" :value="__('Starting Year')" />
                <x-text-input id="starting_year" name="starting_year" type="text" class="mt-1 block w-full"
                    :value="old('starting_year', $user->starting_year)" autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('starting_year')" />
            </div>
        </div>
        <div class="flex flex-col">
            <x-input-label for="position" :value="__('Position')" />
            <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position', $user->position)"
                autocomplete="position" />
            <x-input-error class="mt-2" :messages="$errors->get('position')" />
        </div>
        <div class="flex flex-col">
            <x-input-label for="research_title" :value="__('Research Title')" />
            <x-text-input id="research_title" name="research_title" type="text" class="mt-1 block w-full"
                :value="old('research_title', $user->research_title)" autocomplete="research_title" />
            <x-input-error class="mt-2" :messages="$errors->get('research_title')" />
        </div>
        <div class="flex flex-col">
            <x-input-label for="biography" :value="__('Short Biography')" />
            <textarea id="biographyEditor" name="biography" type="text" rows="5" style="resize: none;"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('biography', $user->biography) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('biography')" />
        </div>
        <div class="flex flex-col">
            <x-input-label for="socials" :value="__('Social Links')" />

            <div class="flex flex-col sm:flex-row sm:space-x-6">
                <div class="flex-1 flex items-center">
                    <i class="fa fa-globe" style="color: #374151; margin-right: 10px;" aria-hidden="true"></i>
                    <x-text-input id="website" name="website" type="url" class="mt-1 block w-full"
                        :value="old('website', $user->website)" autocomplete="website" />
                    <x-input-error class="mt-2" :messages="$errors->get('website')" />
                </div>

                <div class="flex-1 flex items-center">
                    <i class="ai ai-google-scholar" style="color: #374151; margin-right: 10px; font-size:20px;"
                        aria-hidden="true"></i>
                    <x-text-input id="google_scholar" name="google_scholar" type="url" class="mt-1 block w-full"
                        :value="old('google_scholar', $user->google_scholar)" autocomplete="google_scholar" />
                    <x-input-error class="mt-2" :messages="$errors->get('google_scholar')" />
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:space-x-6">
                <div class="flex-1 flex items-center">
                    <i class="ai ai-researchgate" style="color: #374151; margin-right: 10px; font-size:20px;"
                        aria-hidden="true"></i>
                    <x-text-input id="researchgate" name="researchgate" type="url" class="mt-1 block w-full"
                        :value="old('researchgate', $user->researchgate)" autocomplete="researchgate" />
                    <x-input-error class="mt-2" :messages="$errors->get('researchgate')" />
                </div>
                <div class="flex-1 flex items-center">
                    <i class="fab fa-github" style="color: #374151; margin-right: 10px;" aria-hidden="true"></i>
                    <x-text-input id="github" name="github" type="url" class="mt-1 block w-full"
                        :value="old('github', $user->github)" autocomplete="github" />
                    <x-input-error class="mt-2" :messages="$errors->get('github')" />
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:space-x-6">
                <div class="flex-1 flex items-center">
                    <i class="fab fa-linkedin-in" style="color: #374151; margin-right: 10px;" aria-hidden="true"></i>
                    <x-text-input id="linkedin" name="linkedin" type="url" class="mt-1 block w-full"
                        :value="old('linkedin', $user->linkedin)" autocomplete="linkedin" />
                    <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
                </div>
                <div class="flex-1 flex items-center">
                    <i class="fab fa-twitter" style="color: #374151; margin-right: 10px;" aria-hidden="true"></i>
                    <x-text-input id="github" name="github" type="url" class="mt-1 block w-full"
                        :value="old('github', $user->github)" autocomplete="github" />
                    <x-input-error class="mt-2" :messages="$errors->get('github')" />
                </div>
            </div>

        </div>
        <div class="flex flex-col">
            <div class="flex items-center">
                <x-input-label for="hobbies" :value="__('Hobby')" />
                <i class="fas fa-info-circle ml-1" style="color: red; font-size: 14px;"
                    title="1. Give 'None' when you don't have any hobby&#13;2. Use comma to separate hobbies"></i>
            </div>
            <select class="hobbies form-control mt-1 block w-full" name="hobbies[]" multiple="multiple">
                @foreach ($user->hobbies as $item)
                    <option vlaue="{{ $item->id }}" selected>{{ $item->hobby }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('hobbies')" />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
@section('scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote-lite.min.js') }}"></script>
    <script type="text/javascript">
        const imgInp = document.getElementById('imgInp');
        const previousImg = document.getElementById('previousImg');
        const newImg = document.getElementById('newImg');
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                previousImg.style.display = "none";
                newImg.src = URL.createObjectURL(file)
                newImg.style.display = "flex"
            }
        }
        $(document).ready(function() {
            $('.hobbies').select2({
                maximumSelectionLength: 6,
                placeholder: "Use comma (\",\") to separate hobbies",
                tags: true,
                tokenSeparators: [',']
            });
        })

        $(document).ready(function() {
            $('#biographyEditor').summernote({
                placeholder: 'Write your post here...',
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                ],
            });
        });
    </script>
@endsection
